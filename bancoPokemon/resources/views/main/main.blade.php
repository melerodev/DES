@extends('base')

@section('title', 'Pokèmon, peso, altura, tipo y número de evoluciones')

@section('content')

    @if(session('user'))
        <a href="{{url('logout')}}" class="btn btn-success">log out</a>
    @else
        <a href="{{url('login')}}" class="btn btn-success">log in</a>
    @endif
    &nbsp;
    <a href="{{url('pokemon')}}" class="btn btn-success">banco</a>

@endsection