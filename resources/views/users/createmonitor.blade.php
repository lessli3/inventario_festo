@extends('layouts.dashboard')
@section('titulo', 'Solicitudes')
@section('content')


<!-- Mostrar mensajes de éxito o error -->
@if (session('success'))
    <div class="alert alert-success" id="successAlert">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger" id="errorAlert">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif

<!-- Formulario para crear un monitor -->
<div class="card mx-5 my-5" style="min-height: 90vh; max-height: 2000px; margin-top: 5%">
    <h3 class="col-12 text-center fw-bold mt-5 mb-4">AGREGAR MONITOR</h3>
    <form action="{{ route('crearMonitor') }}" method="POST">
        @csrf
        <div class="container p-4">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Apellido</label>
                        <input type="text" name="lastname" id="lastname" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="user_identity" class="form-label">Cédula</label>
                        <input type="text" name="user_identity" id="user_identity" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                </div>

                
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Crear Monitor</button>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="text-center mt-2">
                        <a href="{{ route('monitores') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

<style>
    @media (max-width: 767px) {
    .card{
        width: 90% !important;
        height: 110px !important;
        min-height: 100% !important;
        max-height: 120% !important;
    }

    .main-content{
        margin-left: 0 !important;
        padding-right: 5% !important;
        margin-top: 13% !important;
    }

    .header{
        height: 50px !important;
    }
    }
    @media (min-width: 768px) and (max-width: 991px) {
    .card{
        width: 90% !important;
        height: 500px !important;
        min-height: 100!important;
        max-height: 120% !important;

    }
    .main-content{
        margin-left: 5% !important;
    }
}
</style>
