@extends('base')

@section('titulo')
    {{ $post->title }}
@endsection

@section('entrada')
    {{ $post->entry }}
@endsection

@section('by')
    {{ $post->created_at->locale('es')->isoFormat('dddd D \d\e mmmm \d\e\l Y') }}
@endsection

@section('content')
    {!! strip_tags($post->text, env('PERMITTED_TAGS', '')) !!}

    <div class="text-end">
        <a href="{{ route('post.edit', $post->id) }}">Edit</a>
    </div>

    <hr>

    @foreach ($post->comments as $comment)
        <div class="card mb-3" id="{{ $comment->id }}">
            <div class="card-text">
                {{ $comment->text }}
            </div>
            <div class="card-footer text-muted">
               @if ($comment->isEditable())
               <a href="{{ route('comment.edit', $comment->id) }}">{{ $comment->nickname }}</a>
               @else
                <span>{{ $comment->nickname }}</span>
               @endif
                , <span>{{ $comment->created_at->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y') }}</span>
            </div>
        </div>
    @endforeach

    <hr>

    <form action="{{ route('comment.store') }}" method="post" style="margin-bottom: 8rem">

        @csrf

        <div class="mb-3">
            <label for="mail" class="form-label">Email</label>
            <input type="email" class="form-control" id="mail" name="mail" minlength="5" maxlength="40" required
                placeholder="Introduce your email" value="{{ old('mail') }}">
        </div>

        <div class="mb-3">
            <label for="nickname" class="form-label">Nick Name</label>
            <input type="text" class="form-control" id="nickname" name="nickname" minlength="5" maxlength="100"
                required placeholder="Introduce your nick name" value="{{ old('nickname') }}">
        </div>

        <div class="mb-3">
            <label for="text" class="form-label">Text</label>
            <textarea class="form-control" id="text" placeholder="Introduce the comment" minlength="10" name="text">{{ old('text') }}</textarea>
        </div>

        <hr>

        <div class="mb-3 float-end">
            <button type="submit" class="btn btn-secondary">Send comments</button>
        </div>

        <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}">

    </form>


    <form action="{{ route('post.comment', $post->id) }}" method="post">

        @csrf

        <div class="mb-3">
            <label for="mail" class="form-label">Email</label>
            <input type="email" class="form-control" id="mail" name="mail" minlength="5" maxlength="40" required
                placeholder="Introduce your email" value="{{ old('mail') }}">
        </div>

        <div class="mb-3">
            <label for="nickname" class="form-label">Nick Name</label>
            <input type="text" class="form-control" id="nickname" name="nickname" minlength="5" maxlength="100"
                required placeholder="Introduce your nick name" value="{{ old('nickname') }}">
        </div>

        <div class="mb-3">
            <label for="text" class="form-label">Text</label>
            <textarea class="form-control" id="text" placeholder="Introduce the comment" minlength="10" name="text">{{ old('text') }}</textarea>
        </div>

        <hr>

        <div class="mb-3 float-end">
            <button type="submit" class="btn btn-secondary">Send comments</button>
        </div>
    </form>
@endsection
