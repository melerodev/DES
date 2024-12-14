@extends('base')

@section('titulo')
    {{ $post->title}}
@endsection

@section('entrada')
    {{ $post->entry}}
@endsection

@section('by')
    {{ $post->created_at->locale('es')->isoFormat('dddd D \d\e mmmm \d\e\l Y') }}
@endsection


@section('content')
    <div class="mt-5">
        <form action="{{ route('post.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')

        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" placeholder="Introduce your email to verificate" value="{{ old($post->title, $post->title) }}">


        <label for="entry">Entry</label>
        <input type="text" name="entry" id="entry"  class="form-control" placeholder="Introduce your email to verificate" value="{{ old($post->entry, $post->entry) }}">

        <label for="text">Text</label>
            <textarea name="text" id="text" class="form-control mb-2">{{ old($post->text, $post->text) }}</textarea>

        <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>

        </form>
    </div>
@endsection
