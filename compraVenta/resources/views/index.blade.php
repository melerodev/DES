<!-- FILE: compraVenta3/resources/views/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($sales as $sale)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('storage/' . $sale->image) }}" class="card-img-top" alt="{{ $sale->product }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $sale->product }}</h5>
                        <p class="card-text">{{ $sale->description }}</p>
                        <p class="card-text">${{ number_format($sale->price, 2) }}</p>
                        <form action="{{ route('sales.buy', $sale) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Comprar</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@if(Auth::user())
    <button href="{{ route('createnewproduct') }}" class="btn btn-primary">Crear un nuevo producto</button>
@else
    <a href="{{ route('login') }}">Iniciar sesión</a><br>
    <a href="{{ route('register') }}">Registrarse</a>
@endif
@endsection