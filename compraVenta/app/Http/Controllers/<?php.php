<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Models\Sale;

class HomeController extends BaseController 
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');  //Excepción de autenticación para el método home se aplica a todos los métodos
        $this->middleware('auth')->except(['index']);  //Excepción de autenticación para el método index se aplica a todos los métodos excepto el introducido
        //$this->middleware('auth')->only();  //Excepción de autenticación para el método index solo se aplica al método introducido
        $this->middleware('verified')->only(['verify']);  //Excepción de verificación de correo para el método verify solo se aplica al método introducido
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('index', compact('sales'));
    }

    public function crearProducto()
    {
        return view('createnewproduct');
    }
    public function edit($id)
    {
        $sale = Sale::find($id);
        $categories = Category::all();
        return view('editproduct', compact('sale', 'categories'));
    }

    public function index()
    {
        $sales = Sale::where('issold', '')->get();
        $images = null;
        foreach($sales as $sale) {
            $images = Image::where('sale_id', $sale->id)->get();
        }
        return view('index', compact('sales', 'images'));
    }

    function verificado() {
        return view('verificado');
    }

    function userManager() {
        $users = User::all();
        return view('usermanager', ['users' => $users]);
    }
}


<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesController;

Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::resource('sales', SalesController::class);
Route::get('/createnewproduct', [App\Http\Controllers\HomeController::class, 'crearProducto'])->name('createnewproduct');
Route::post('/sales/{sale}/buy', [SalesController::class, 'buy'])->name('buy');
Route::get('/editproduct/{id}', action: [App\Http\Controllers\HomeController::class, 'edit'])->name('editproduct');
Route::delete('/deleteproduct/{sale}', [App\Http\Controllers\SalesController::class, 'destroy'])->name('deleteproduct');


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
        $images = null;
        foreach($sales as $sale) {
            $images = Image::where('sale_id', $sale->id)->get();
        }
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


<!-- FILE: compraVenta3/resources/views/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if ($sales->isEmpty())
            <div class="col-md-12">
                <p>No hay productos disponibles</p>
            </div>
        @else
            @foreach ($sales as $sale)
                <div class="col-md-4">
                    <div class="card mb-4">
                        @if($images->where('sale_id', $sale->id))
                            <img src="{{ asset('storage/' . $images->where('sale_id', $sale->id)->first()->route) }}" class="card-img-top" alt="{{ $sale->product }}">
                        @else
                            <img src="{{ asset('storage/default.jpg') }}" class="card-img-top" alt="Imagen no disponible">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $sale->product }}</h5>
                            <p class="card-text">{{ $sale->description }}</p>
                            <p class="card-text">{{ number_format($sale->price, 2) }} €</p>
                            <p class="card-text">{{ $sale->category->name }}</p>
                            <div class="buttons" style="display: flex; justify-content: space-between;">
                                <form action="{{ route('buy', $sale) }}" method="POST">
                                    @csrf
                                    @if(Auth::user() && Auth::user()->email_verified_at)
                                        <button type="submit" class="btn btn-primary">Comprar</button>
                                    @endif
                                </form>
                                <form action="{{ route('deleteproduct', $sale->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE') <!-- Esto es importante -->
                                    @if(Auth::check() && (Auth::user()->id == $sale->user_id || Auth::user()->role == "admin" || Auth::user()->role == "superadmin"))
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                                            Eliminar
                                        </button>
                                    @endif
                                </form>
    
                                <form action="{{ route('editproduct', $sale->id) }}" method="GET">
                                    @csrf
                                    @if(Auth::user() && Auth::user()->id == $sale->user_id)
                                        <button type="submit" class="btn btn-warning">
                                            <a style="text-decoration: none; color: white;"
                                                href="{{ route('editproduct', $sale->id) }}">Editar</a>
                                        </button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@if(Auth::user() == null || Auth::user()->email_verified_at == null)
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>Verifícate o registrate y verifícate para poder publicar productos o comprar productos</p>
            </div>
        </div>
    </div>
@endif
@endsection

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
        }

        .form-container input,
        .form-container textarea,
        .form-container select {
            width: 94%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #218838;
        }
    </style>
</head>
<div class="form-container">
    <h2>Editar Producto</h2>
    <form action="{{ route('sales.update', $sale->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="{{ $sale->product }}" required>

        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" rows="4" required>{{ $sale->description }}</textarea>

        <label for="precio">Precio</label>
        <input type="number" id="precio" name="precio" step="0.01" value="{{ $sale->price }}" required>

        <label for="categoria">Categoria</label>
        <select id="categoria" name="categoria" class="categories" required>
            <option value="">Selecciona una categoría</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $sale->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>

        <button type="submit">Actualizar Producto</button>
    </form>
</div>


<!-- FILE: compraVenta3/resources/views/index.blade.php -->

<style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
        }

        .form-container input,
        .form-container textarea {
            width: 94%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #218838;
        }

        .form-container .img-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
        }

        .form-container .img-container img {
            border-radius: 4px;
            padding: 1px;
            width: 30%;
            height: 30%;
        }

        textarea {
            resize: unset;
        }

        .categories {
            margin-bottom: 10px;
            width: 100%;
        }
</style>

<body>
    @if (Auth::user()->email_verified_at) 
        <div class="form-container">
            <h2>Crear Producto</h2>
            <form action="{{ route('sales.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>
    
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
    
                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" step="0.01" required>
    
                <label for="categoria">Categoria</label>
                <select id="categoria" name="categoria" class="categories" required>
                    <option value="">Selecciona una categoría</option>
                    @php
                        $categories = App\Models\Category::all();
                    @endphp
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
    
                <label for="imagenes">Imágenes</label>
                <input type="file" id="imagenes" name="imagenes[]" multiple required>
                <div class="img-container"></div>
                <button type="submit">Crear Producto</button>
            </form>
            <script>
                // cuando se suba una imagen, añadirlo al container de imagenes
                document.getElementById('imagenes').addEventListener('change', function (e) {
                    const container = document.querySelector('.img-container');
                    container.innerHTML = '';
                    for (let i = 0; i < e.target.files.length; i++) {
                        const img = document.createElement('img');
                        img.src = URL.createObjectURL(e.target.files[i]);
                        container.appendChild(img);
                    }
                });
            </script>
        </div>
    @else
        <p>Debes verificar tu email para poder publicar productos</p>
    @endif

</body>

</html>