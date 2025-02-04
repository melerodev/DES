@extends('layouts.app')

@section('content')
<style>
    .table-container {
        margin: 0 20px; /* Agrega márgenes a los lados de la tabla */
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;
    }

    th, td {
        padding: 15px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
</style>
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Role</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                @if(Auth::user()->id != $user->id)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td><a href="{{ route('profile.edit', $user->id) }}">Editar</a></td>
                        <td>
                            <form action="{{ route('profile.destroy', $user->id) }}" method="POST" onsubmit="return confirmar()">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <script>
        function confirmar() {
            return confirm('¿Estás seguro de que deseas eliminar este usuario?');
        }

        @if (session('error'))
            alert('Ha surgido un error al intentar eliminar el usuario.');
        @endif
    </script>
</div>
@endsection
