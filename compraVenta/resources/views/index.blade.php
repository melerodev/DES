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