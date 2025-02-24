@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-warning text-white text-center">
                    <h4 class="mb-0">{{ __('Dashboard') }}</h4>
                </div>

                <div class="card-body p-4">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <p class="lead text-center">{{ __('¡Estás logeado y verificado!') }}</p>

                    <div class="mt-5 text-center">
                        @if (Auth::user()->role === 'superAdmin')
                        <a href="{{ route('superAdmin.index') }}" class="btn btn-primary btn-lg px-4 py-2">
                            Ir al panel de administrador
                        </a>
                        @elseif (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.index') }}" class="btn btn-primary btn-lg px-4 py-2">
                            Ir al Panel de administrador
                        </a>
                        @else
                        <a href="{{ route('user.index') }}" class="btn btn-primary btn-lg px-4 py-2">
                            Editar perfil
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
