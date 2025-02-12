@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Hola
                </div>
                <div class="card-body">
                    <a href="{{ url('login') }}">Login</a>
                    <br>
                    <a href="{{ route('verificado') }}">Verificado</a>
                    <br>
                    @if(Auth::user() && Auth::user()->email_verified_at)
                        <a href="{{ route('home') }}">Estás verificado</a>
                    @else
                        <a href="{{ route('home') }}">No estás verificado</a>
                    @endif
                    @if(Auth::user() && Auth::user()->role == 'admin' or Auth::user() && Auth::user()->role == 'superadmin')
                        <a href="{{ route('usermanager') }}">Administrar usuarios</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
