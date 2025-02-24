@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if ($sales->isEmpty() && Auth::check())
        <div class="col-md-12 d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
                <p><b>No hay productos disponibles</b></p>
                <img style="border-radius: 10px;" src="https://c.tenor.com/obu5x3kCUZ4AAAAd/tenor.gif" alt="Bart">
            </div>
        @else
            @foreach ($sales as $sale)
                <div class="col-md-4">
                    <div class="card mb-4">
                        @php
                            $image = $images->where('sale_id', $sale->id)->first();
                        @endphp
                        <img src="{{ asset($image ? 'storage/' . $image->route : 'storage/default.jpg') }}" class="card-img-top" alt="{{ $sale->product }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $sale->product }}</h5>
                            <p class="card-text">Description: {{ $sale->description }}</p>
                            <p class="card-text">Price: {{ number_format($sale->price, 2) }} €</p>
                            <p class="card-text">Category: {{ $sale->category->name }}</p>

                            <div class="buttons" style="display: flex; justify-content: space-between;">
                                <!-- Botón Comprar -->
                                @if(Auth::check() && Auth::user()->email_verified_at)
                                    <form action="{{ route('buy', $sale) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Comprar</button>
                                    </form>
                                @endif

                                <!-- Botón Eliminar -->
                                <form action="{{ route('deleteproduct', $sale->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    @if(Auth::check() && (Auth::user()->id == $sale->user_id || Auth::user()->role == "admin" || Auth::user()->role == "superadmin"))
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                                            Eliminar
                                        </button>
                                    @endif
                                </form>

                                <!-- Botón Editar -->
                                @if(Auth::check() && Auth::user()->id == $sale->user_id)
                                    
                                    <a href="{{ route('editproduct', $sale->id) }}" class="btn btn-warning">
                                        Editar
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

@if(!Auth::check())
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <p>Regístrate o inicia sesión con tu cuenta para poder publicar o comprar productos.</p>
            </div>
        </div>
    </div>
@endif
@endsection