@extends('bank.base')

@section('title', 'Pokémon Capturados:')

@section('basecontent')

    <table class="table table-striped table-hover" id="tablaPokemon">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Peso (kg)</th>
                <th>Altura (m)</th>
                <th>Tipo</th>
                <th>Evolución</th>
                <th>Imagen</th>
                @if(session('user'))
                    <th>Borrar</th>
                    <th>Editar</th>
                @endif
                <th>Ver</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pokemons as $pokemon)
                <tr>
                    <td>{{$pokemon->id}}</td>
                    <td>{{$pokemon->name}}</td>
                    <td>{{$pokemon->weight}}</td>
                    <td>{{$pokemon->height}}</td>
                    <td>{{$pokemon->type}}</td>
                    <td>{{$pokemon->evolution}}</td>
                    <td>
                        @if($pokemon->image)
                            <img src="{{ asset('storage/' . $pokemon->image) }}" alt="Imagen de {{$pokemon->name}}" width="50" height="50">
                        @endif
                    </td>
                    @if(session('user'))
                    <td><a href="#" data-href="{{ url('pokemon/' . $pokemon->id )}}" class="borrar">borrar</a></td>
                    <!-- Para hacerlo con botón, sin script.js y sin confirmación de borrado. No recomendable
                    <form id="formDelete" action="{{ url('pokemon/' . $pokemon->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <td><button type="submit" class="btn btn-danger">Borrar</button></td>
                    </form>
                    -->
                        <td><a href="{{url('pokemon/' . $pokemon->id . '/edit')}}">editar</a></td>
                    @endif
                    <td><a href="{{url('pokemon/' . $pokemon->id)}}">ver</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        @if(session('user'))
            <a href="{{url('pokemon/create')}}" class="btn btn-success">añadir pokémon</a>
            <form id="formDelete" action="{{ url('') }}" method="post">
                @csrf
                @method('delete')
            </form>
        @endif
    </div>

@endsection

@section('scripts')
    <script src="{{url('assets/scripts/script.js')}}"></script>
@endsection