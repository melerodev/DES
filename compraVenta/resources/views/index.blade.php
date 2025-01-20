<!-- FILE: compraVenta3/resources/views/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if ($sales == 0)
            <div class="col-md-12">
                <p>No hay productos disponibles</p>
            </div>
        @else
            @foreach ($sales as $sale)
                <div class="col-md-4">
                    <div class="card mb-4">
                        @php
                            $image = \App\Models\Image::where('sale_id', $sale->id)->first();
                        @endphp
                        @if($image)
                            <img src="{{ asset('storage/' . $image->route) }}" class="card-img-top" alt="{{ $sale->product }}">
                        @else
                            <img src="{{ asset('storage/default.jpg') }}" class="card-img-top" alt="Imagen no disponible">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $sale->product }}</h5>
                            <p class="card-text">{{ $sale->description }}</p>
                            <p class="card-text">${{ number_format($sale->price, 2) }}</p>
                            <p class="card-text">{{ $sale->category->name }}</p>
                            <form action="{{ route('sales.buy', $sale) }}" method="POST">
                                @csrf
                                @if(Auth::user())
                                    <button type="submit" class="btn btn-primary">Comprar</button>
                                @endif
                                <form action="sales.destroy">
                                    @csrf
                                    @if(Auth::user() && Auth::user()->id == $sale->user_id)
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                                        <a href="" style="text-decoration: none; color: white;">Eliminar</a>
                                    </button>
                                    @endif
                                </form>
                                <form action="sales.edit">
                                    @csrf
                                    @if(Auth::user() && Auth::user()->id == $sale->user_id)
                                    <button type="submit" class="btn btn-warning"><a style="text-decoration: none; color: white;" href="{{ route('editproduct', $sale->id) }}">Editar</a></button>                                @endif
                                </form>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@if(Auth::user() == null)
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>Regístrate para poder publicar productos o comprar productos</p>
            </div>
        </div>
    </div>
@endif
@endsection