@extends('layouts.dashboard')
@section('titulo', 'Perfil')
@section('content')
@can('verSolicitud')

<div class="row">
<h2 class="text-center mb-3 mt-4 mb-4 fw-bold">PERFIL</h2>
</div>

<div class="container h-70">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-9 mb-1 mb-lg-0" style="padding-right: 0 !important">
        <div class="card mb-1" style="border-radius: .5rem; height: 80%">
          <div class="row g-0">
            <div class="col-md-4 gradient-custom text-center fw-bold"
              style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem; color:green;">
            @can('editarHerramienta')
              <img src="img/admin.png" alt="Avatar" class="img-fluid mt-5 mb-3" style="width: 150px;"/>
              <p style="font-size: 23px">{{$usuario->name}}</p>
              <h6>Cuentadante</h6>
            @endcan
            @can('solicitarHerramienta')
            <img src="img/instructor.png" alt="Avatar" class="img-fluid mt-5 mb-3" style="width: 150px;"/>
            <p style="font-size: 23px">{{$usuario->name}}</p>
            <h6>Instructor</h6>
            @endcan
            @can('editarSolicitud')
            <img src="img/instructor.png" alt="Avatar" class="img-fluid mt-5 mb-3" style="width: 150px;"/>
            <p style="font-size: 23px">{{$usuario->name}}</p>
            <h6>Monitor</h6>
            @endcan
            </div>
            <div class="col-md-8">
              <div class="card-body p-4">
                <h5 class="fw-bold">Información</h5>
                <hr class="mt-0 mb-4">
                <div class="row pt-1 mt-4">
                    <div class="col-6 mb-3">
                        <h6 style="font-weight: bold;">Cédula</h6>
                        <p>{{$usuario->user_identity}}</p>
                    </div>
                    <div class="col-6 mb-3">
                        <h6 style="font-weight: bold;">Estado</h6>
                        <p>{{$usuario->user_estado}}</p>
                    </div>
                </div>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                    <div class="col-6">
                        <h6 style="font-weight: bold;">Email</h6>
                        <p>{{$usuario->email}}</p>
                    </div> 
                  
                  <div class="col-6">
                    <h6 style="font-weight: bold;">Teléfono</h6>
                    <p>{{$usuario->telefono}}</p>
                  </div>
                </div>
                <center>
                <button class="btn btn-light mt-1" style="border-radius: 1.5rem;">
                <a href="/users/{{$usuario->id}}/edit" style="text-decoration: none; color: green;" class="fw-bold"><i class="far fa-edit mb-1" style="font-size:20px; color:green;"></i>  Editar</a>
                </button>
                </center>
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

