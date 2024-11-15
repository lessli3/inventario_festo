@extends('layouts.dashboard')
@section('titulo', 'Solicitudes')
@section('content')

    <h4 class="fw-bold">Crear un Nuevo Monitor</h4>

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
    <form action="{{ route('crearMonitor') }}" method="POST">
        @csrf
        <div class="container p-5" style="width: 800px">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="lastname" class="form-label">Apellido</label>
                    <input type="text" name="lastname" id="lastname" class="form-control" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="user_identity" class="form-label">Cédula</label>
                    <input type="text" name="user_identity" id="user_identity" class="form-control" required>
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Crear Monitor</button>
    </form>
</div>
@endsection
