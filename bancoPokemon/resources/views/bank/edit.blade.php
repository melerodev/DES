@extends('bank.base')

@section('basecontent')

    <form action="{{url('pokemon/' . $pokemon->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name">Nombre</label>
            <input value="{{ old('name', $pokemon->name) }}" required type="text" class="form-control" id="name" name="name" placeholder="nombre">
        </div>
        <div class="form-group">
            <label for="weight">Peso (kg)</label>
            <input value="{{ old('weight', $pokemon->weight) }}" required type="number" step="0.01" class="form-control" id="weight" name="weight" placeholder="peso">
        </div>
        <div class="form-group">
            <label for="height">Altura (m)</label>
            <input value="{{ old('height', $pokemon->height) }}" required type="number" step="0.01" class="form-control" id="height" name="height" placeholder="altura">
        </div>
        <div class="form-group">
            <label for="type">Tipo</label>
            <select required class="form-control" id="type" name="type">
                <option value="bug" {{ old('type', $pokemon->type) == 'bug' ? 'selected' : '' }}>bicho</option>
                <option value="dark" {{ old('type', $pokemon->type) == 'dark' ? 'selected' : '' }}>oscuro</option>
                <option value="dragon" {{ old('type', $pokemon->type) == 'dragon' ? 'selected' : '' }}>dragón</option>
                <option value="electric" {{ old('type', $pokemon->type) == 'electric' ? 'selected' : '' }}>eléctrico</option>
                <option value="fairy" {{ old('type', $pokemon->type) == 'fairy' ? 'selected' : '' }}>hada</option>
                <option value="fighting" {{ old('type', $pokemon->type) == 'fighting' ? 'selected' : '' }}>lucha</option>
                <option value="fire" {{ old('type', $pokemon->type) == 'fire' ? 'selected' : '' }}>fuego</option>
                <option value="flying" {{ old('type', $pokemon->type) == 'flying' ? 'selected' : '' }}>volador</option>
                <option value="ghost" {{ old('type', $pokemon->type) == 'ghost' ? 'selected' : '' }}>fantasma</option>
                <option value="grass" {{ old('type', $pokemon->type) == 'grass' ? 'selected' : '' }}>planta</option>
                <option value="ground" {{ old('type', $pokemon->type) == 'ground' ? 'selected' : '' }}>tierra</option>
                <option value="ice" {{ old('type', $pokemon->type) == 'ice' ? 'selected' : '' }}>hielo</option>
                <option value="normal" {{ old('type', $pokemon->type) == 'normal' ? 'selected' : '' }}>normal</option>
                <option value="poison" {{ old('type', $pokemon->type) == 'poison' ? 'selected' : '' }}>veneno</option>
                <option value="psychic" {{ old('type', $pokemon->type) == 'psychic' ? 'selected' : '' }}>psíquico</option>
                <option value="rock" {{ old('type', $pokemon->type) == 'rock' ? 'selected' : '' }}>roca</option>
                <option value="steel" {{ old('type', $pokemon->type) == 'steel' ? 'selected' : '' }}>acero</option>
                <option value="water" {{ old('type', $pokemon->type) == 'water' ? 'selected' : '' }}>agua</option>
            </select>
        </div>
        <div class="form-group">
            <label for="evolution">Evoluciones</label>
            <input value="{{ old('evolution', $pokemon->evolution) }}" required type="number" step="1" class="form-control" id="evolution" name="evolution" placeholder="número de evoluciones">
        </div>
        <div class="form-group">
            <label for="image">Imagen</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">editar</button>
    </form>
    <br>
    <div class="form-group">
    <a href="{{url()->previous()}}">volver</a>
    </div>

@endsection