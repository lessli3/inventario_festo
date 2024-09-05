@extends('layouts.dashboard')
@section('titulo', 'Crear Solicitud')
@section('content')
@can('solicitarHerramienta')
<section>
    <center>
        <h4 class="mb-4 fw-bold">COMPLETA TU INFORMACIÓN</h4>
    </center>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if(count($solicituditemsArray) > 0)
                <form action="{{ route('solicitudes.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="form-group col-lg-6 mb-3">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" value="{{ auth()->user()->name }}" class="form-control" required>
                        </div>

                        <div class="form-group col-lg-6 mb-3">
                            <label for="telefono">Teléfono:</label>
                            <input type="number" id="telefono" name="telefono" class="form-control" placeholder="Ej. 3015488445" required>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" class="form-control" readonly>
                    </div>
                    
                    <h5 class="">Información del pedido</h5>
                    <hr>

                    @foreach($solicituditemsArray as $item)
                        <input type="hidden" name="solicituditemsArray[]" value="{{ json_encode($item) }}">
                            <input type="hidden" name="herramienta_id[]" value="{{ $item['id'] }}">
                            <input type="hidden" name="cantidad[]" value="{{ $item['cantidad'] }}">
                            <div class="card p-3 m-2">
                                <div class="row">
                                    <div class="form-group col-lg-6 mb-3">
                                        <label for="producto">Nombre de la herramienta:</label>
                                        <h5 class="fw-semibold ms-2"type="text" id="producto" name="producto" value="{{ $item['nombre'] }}" >
                                            {{ $item['nombre'] }}</h5> 
                                    </div>   
                                    <div class="form-group col-lg-6 mb-3">
                                        <label for="cantidad_producto">Cantidad:</label>
                                        <h6 class="fw-semibold ms-2"type="text" id="cantidad_producto" name="cantidad_producto" value="{{ $item['cantidad'] }}" >
                                        {{ $item['cantidad'] }} unidad(es)</h6>  
                                    </div>                            
                                </div>

                            <div class="row">
                                
                                <div class="d-flex col-lg-6 p-3">
                                <a href="/solicitud" class="btn btn-outline-success">
                                    <i class="fas fa-edit me-1"></i> Editar pedido
                                </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                    <hr>

                    <div class="text-center">
                        <button type="submit" class="btn btn-plus fw-bold" >Guardar Pedido</button>
                    </div>

                </form>
                @else
                    <div class="alert alert-warning">No hay productos ni servicios en el solicitud.</div>
                @endif
            </div>
        </div>
    </div>
</section>
@else
    <div class="alert alert-success text-center mx-5" role="alert">
        Acceso no Autorizado
    </div>
@endcan
@endsection