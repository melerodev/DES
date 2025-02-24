<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SalesController extends Controller
{
    public function index()
    {
        $sales = Sale::where('issold', '')->get();
        $images = Image::whereIn('sale_id', $sales->pluck('id'))->get();
        return view('index', compact('sales', 'images'));
    }
    

    /**
     * Mostrar el formulario para crear una nueva venta.
     */
    public function create()
    {
        return view('sales.create');
    }

    public function buy(Sale $sale)
    {
        $sale->update(attributes: ['issold' => true]);
        return redirect()->route('sales.index')->with('success', 'Producto comprado correctamente.');
    }

    /**
     * Almacenar una nueva venta.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'categoria' => 'required|string',
        ]);

        $path = null;
        // Subir las imágenes y asociarlas con la venta
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $image) {
                $path = $image->store('sales', 'public');
            }
        }
        
        // Crear la venta
        $sale = Sale::create([
            'product' => $validated['nombre'],
            'description' => $validated['descripcion'],
            'price' => $validated['precio'],
            'issold' => false, // Inicialmente no está vendida
            'user_id' => $request->user()->id,
            'category_id' => $validated['categoria'],
        ]);

        $image = Image::create([
            'sale_id' => $sale->id,
            'route' => $path,
        ]);
        
        // Subir las imágenes y asociarlas con la venta
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $image) {
                $path = $image->store('sales', 'public');
                Sale::find($sale->id)->image = $path;
            }
        }

        return redirect()->route('sales.index')->with('success', 'Venta creada correctamente.');
    }

    /**
     * Mostrar los detalles de una venta.
     */
    public function show(Sale $sale)
    {
        $sale->load('images');
        return view('sales.show', compact('sale'));
    }

    /**
     * Mostrar el formulario para editar una venta existente.
     */
    public function edit(Sale $sale)
    {
        $categories = Category::all();
        return view('editproduct', compact('sale', 'categories'));
    }

    /**
     * Actualizar una venta existente.
     */
    public function update(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'categoria' => 'required|exists:categories,id',
        ]);

        $sale->update([
            'product' => $validated['nombre'],
            'description' => $validated['descripcion'],
            'price' => $validated['precio'],
            'category_id' => $validated['categoria'],
        ]);

        return redirect()->route('sales.index')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Eliminar una venta.
     */
public function destroy(Sale $sale)
{
    // Eliminar imágenes asociadas antes de borrar la venta
    if ($sale->images) {
        foreach ($sale->images as $image) {
            Storage::disk('public')->delete($image->route);
            $image->delete();
        }
    }

    // Eliminar la venta
    $sale->delete();

    return redirect()->route('sales.index')->with('success', 'Venta eliminada correctamente.');
}

}
