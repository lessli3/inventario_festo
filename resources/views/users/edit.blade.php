@extends('layouts.dashboard')
@section('titulo', 'Perfil')
@section('content')
@can('verSolicitud')
<div class="row">
    <h4 class="col-md-3 ms-3 fw-bold" style="color:green;">Editar Perfil</h4>
    <button class="btn btn-outline-success mt-1 col-md-1 offset-7 fw-bold" style="border-radius: 1.5rem;" onclick="window.history.back()">
    Regresar
</button>

</div>

<div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-9 mb-1 mb-lg-0">
            <div class="card mb-1" style="border-radius: .5rem; height: 60%">
                <div class="row g-0">
                    <div class="col-md-12">
                        <div class="card-body">
                        <form action="/users/{{$usuEditar->id}}" method="POST" class="form-editar">
                            @csrf
                            @method('put')
                            <h5 class="fw-bold">Edita tu Información</h5>
                            <hr class="mt-0 mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nombreUser" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" value="{{$usuEditar->name}}" name="nameEdit">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="apellidoUser" class="form-label">Apellido</label>
                                        <input type="text" class="form-control" value="{{$usuEditar->lastname}}" name="lastnameEdit">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="telefonoUser" class="form-label">Teléfono</label>
                                        <input type="number" class="form-control" value="{{$usuEditar->telefono}}" name="telefonoEdit">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="emailUser" class="form-label">Correo</label>
                                        <input type="email" class="form-control" value="{{$usuEditar->email}}" name="correoEdit">
                                    </div>
                                </div>
                                
                                
                            </div>
                            <center>
                                    <button class="btn btn-light" style="border-radius: 1.5rem; color:green;">
                                    <i class="far fa-edit mb-1" style="font-size:20px; "></i> Editar
                                    </button>
                            </center>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
    <div class="alert alert-success text-center mx-5" role="alert">
    Acceso no Autorizado
    </div>
@endcan
@endsection





