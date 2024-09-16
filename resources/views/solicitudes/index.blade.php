@extends('layouts.dashboard')
@section('titulo', 'Solicitudes')
@section('content')
@can('verSolicitud')
<div class="container">
    <h4 class="fw-semibold mb-4" style="color: green;">Revisa tus solicitudes <i class="fas fa-pencil icono me-1 mb-1" style="color: green; font-size: 18px"></i></h4>
   
    <div class="row"> <!-- Ajusta la altura mínima aquí -->
        @foreach($solicitudes as $solicitud)
        <div class="col-4 mb-4">
            <div class="card p-3 overflow-auto" style="min-height: 400px; width: 330px">
                <h5 style="color: green;">Solicitud #{{ $solicitud->id }} - {{ $solicitud->fecha }}</h5>
                <p><strong style="color: green;">Hora - Solicitud:</strong>{{ $solicitud->hora }}<br>
                <strong style="color: green;">Instructor:</strong> {{ $solicitud->nombre }}<br>
                <strong style="color: green;">Email:</strong> {{ $solicitud->email }}<br>
                <strong style="color: green;">Teléfono:</strong> {{ $solicitud->telefono }}</p>
                <div class="row"> <!-- Ajusta la altura mínima aquí -->
                    @foreach($solicitud->detalles as $detalle)
                    <div class="col-md-12 mb-3">
                    @can('solicitarHerramienta')
                    <div class="card p-3 mb-1" style="height: 180px;">
                    @endcan
                    @can('crearHerramienta')
                    <div class="card p-3" style="min-height: 230px;">
                    @endcan
                            <h6 class="fw-bold" style="color: green;">HERRAMIENTA</h6>
                            <p><strong style="color: gray;">Nombre:</strong> {{ $detalle->herramienta->nombre }}<br>
                            <strong style="color: gray;">Código:</strong> {{ $detalle->herramienta->cod_herramienta }}<br>
                            <strong style="color: gray;">Cantidad:</strong> {{ $detalle->cantidad }}<br>
                            <strong style="color: gray;">Estado:</strong> <span style="color: green;">{{ $detalle->estado }}</span></p>

                            @can('editarHerramienta')
                            <form action="{{ route('solicitud.actualizarEstado', $detalle->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <label for="estado" class="mb-0">Actualizar Estado</label>

                                <div class="form-group d-flex align-items-center">
                                    <select name="estado" class="form-control me-2">
                                        <option value="aceptada" {{ $detalle->estado == 'aceptada' ? 'selected' : '' }}>Aceptada</option>
                                        <option value="entregada" {{ $detalle->estado == 'entregada' ? 'selected' : '' }}>Entregada</option>
                                        <option value="recibida" {{ $detalle->estado == 'recibida' ? 'selected' : '' }}>Recibida</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary text-white">
                                        <i class="fas fa-sync-alt"></i> 
                                    </button>
                                </div>
                            </form>

                            @endcan
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
    <div class="alert alert-success text-center mx-5" role="alert">
        Acceso no Autorizado
    </div>
@endcan
@endsection
