@extends('base')

@section('titulo')
    {{ $comment->post->title}}
@endsection

@section('entrada')
    {{ $comment->post->title}}
@endsection

@section('by')
    {{ $comment->post->created_at->locale('es')->isoFormat('dddd D \d\e mmmm \d\e\l Y') }}
@endsection


@section('content')
    <div class="mt-5">
        <form action="{{ route('comment.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')

        <h4>Correo</h4>
        <input type="mail" class="form-control" placeholder="Introduce your email to verificate">

        <h4>Comentario</h4>
            <textarea name="text" class="form-control mb-2">{{ old($comment->text) }}</textarea>

            <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
        </form>

        <div class="card-footer text-muted">
            <span>{{ $comment->nickname }}</span>,
            <span>{{ $comment->created_at->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y') }}</span>
        </div>
    </div>
@endsection
