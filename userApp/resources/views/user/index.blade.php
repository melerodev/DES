@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-warning text-white text-center">
                    <h4 class="mb-0 background-color: red;">Actualizar Información</h4>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('user.update') }}">
                        @csrf
                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nombre:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Correo Electrónico -->
                        @if($user->role === 'superAdmin')
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                        </div>
                        @else
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Correo Electrónico:</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required onblur="resetEmailField()">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @endif

                        <!-- Nueva Contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Nueva Contraseña (opcional):</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirmar Contraseña:</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>

                        <!-- Botón de Enviar -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success btn-lg" style="max-width: 180px; margin: 0 auto;">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function resetEmailField() {
        var emailField = document.getElementById('email');
        if (emailField.value.trim() === '') {
            emailField.value = '{{ $user->email }}'; // Vuelve a poner el correo original
        }
    }
</script>
@endsection
