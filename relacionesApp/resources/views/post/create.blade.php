@extends('base')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <script>
        $('#text').summernote({
            toolbar: [
           //     ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
         //       ['table', ['table']],
        //        ['insert', ['link', 'picture', 'video']],
         //       ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
@endsection

@section('content')
    <form action="{{ route('post.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" class="form-control" id="title" name="title" minlength="25" maxlength="60  " required
                value="{{ old('title') }}">
        </div>
        <div class="mb-3">
            <label for="entry" class="form-label">Entrada</label>
            <input type="text" class="form-control" id="entry" name="entry" minlength="60" maxlength="250" required
                value="{{ old('entry') }}">
        </div>

        <div class="mb-3">
            <label for="text" class="form-label">Texto</label>
            <textarea class="form-control" id="text" minlength="100" name="text">{{ old('text') }}</textarea>
        </div>
        <hr>
        <div class="mb-3 float-end">
            <button type="submit" class="btn btn-secondary">Agregar</button>
        </div>
    </form>
@endsection
