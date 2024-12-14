@extends('bank.base')

@section('basecontent')

    <div class="form-group">
        Id #
        {{$pokemon->id}}
    </div>
    <div class="form-group">
        Nombre:
        {{$pokemon->name}}
    </div>
    <div class="form-group">
        Peso:
        {{$pokemon->weight}} kg
    </div>
    <div class="form-group">
        Altura:
        {{$pokemon->height}} m
    </div>
    <div class="form-group">
        Tipo:
        {{$pokemon->type}}
    </div>
    <div class="form-group">
        Número de evoluciones:
        {{$pokemon->evolution}}
    </div>
    <div class="form-group">
        <a href="{{url()->previous()}}">volver</a>
    </div>

@endsection