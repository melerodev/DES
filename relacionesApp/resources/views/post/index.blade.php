@extends('base')

@section('content')
    @foreach ($posts     as $post)
        <div class="post-preview">
            <a href=@if ($post->id == 0) "#" @else "{{ url('post/' . $post->id) }}" @endif">
                <h2 class="post-title">
                    {{-- Str::limit($post->texto, 50, ' ...') --}}
                    {{ $post->title }}
                </h2>
                <h3 class="post-subtitle">
                    {{-- Str::limit(Str::substr($post->entrada, 50) . $text, 80, ' ...', preserveWords: true) --}}
                    {{ $post->entry }}
                </h3>
            </a>
            <p class="post-meta">
                Publicado por
                <a href="#">izvserver</a>
                el {{ $post->created_at->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y') }}
            </p>
        </div>
        <hr class="my-4" />
    @endforeach
@endsection
