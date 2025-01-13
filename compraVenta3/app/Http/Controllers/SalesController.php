<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Image;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Mostrar una lista de ventas.
     */
    public function index()
    {
        $sales = Sale::with('images')->get();
        return view('welcome', compact('sales'));
    }

    /**
     * Mostrar el formulario para crear una nueva venta.
     */
    public function create()
    {
        return view('sales.create');
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
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Crear la venta
        $sale = Sale::create([
            'product' => $validated['nombre'],
            'description' => $validated['descripcion'],
            'price' => $validated['precio'],
            'issold' => false, // Inicialmente no está vendida
            'user_id' => "2",
            'category_id' => 1, // Ajusta según las categorías disponibles
        ]);

        // Subir las imágenes y asociarlas con la venta
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $image) {
                $path = $image->store('sales', 'public');
                Image::create([
                    'sale_id' => $sale->id,
                    'route' => $path,
                ]);
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
        return view('sales.edit', compact('sale'));
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
        ]);

        $sale->update([
            'product' => $validated['nombre'],
            'description' => $validated['descripcion'],
            'price' => $validated['precio'],
        ]);

        return redirect()->route('sales.index')->with('success', 'Venta actualizada correctamente.');
    }

    /**
     * Eliminar una venta.
     */
    public function destroy(Sale $sale)
    {
        // Eliminar las imágenes asociadas
        foreach ($sale->images as $image) {
            \Storage::disk('public')->delete($image->route);
            $image->delete();
        }

        $sale->delete();

        return redirect()->route('sales.index')->with('success', 'Venta eliminada correctamente.');
    }
}
