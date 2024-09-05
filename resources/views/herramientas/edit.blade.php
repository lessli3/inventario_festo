@extends('layouts.dashboard')
@section('titulo', 'Editar Herramienta')
@section('content')
@can('agregarAdministrador')

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="gcontainer py-3 bg-container">

<h2 class="text-center my-4 fw-bold">EDITAR HERRAMIENTA</h2>
<div class="container d-flex justify-content-center">
    <form action="/herramientas/{{$herramientaEditar->id}}" method="POST" class="form-editar" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <label class="form-label fw-semibold">Código de la Herramienta</label>
                    <input type="text" class="form-control" value="{{$herramientaEditar->cod_herramienta}}" name="codigoEdit">                
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="nombreHerramienta" class="form-label">Nombre</label>
                    <input type="text" class="form-control" value="{{$herramientaEditar->nombre}}" name="nombreEdit">
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="descripHerramienta" class="form-label">Descripción</label>
                    <input type="text" class="form-control" value="{{$herramientaEditar->descripcion}}" name="descripEdit">
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="stockHerramienta" class="form-label">Stock</label>
                    <input type="number" class="form-control" value="{{$herramientaEditar->stock}}" name="stockEdit" id="stock">
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="categoriaHerramienta" class="form-label">Categoría</label>
                    <select class="form-control" name="categoriaEdit" required>
                        <option value="" disabled>Selecciona una categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $herramientaEditar->categoria == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-6 mb-4">
                            <label class="form-label fw-semibold">Estado</label>
                            <select class="form-control" name="estadoEdit" required>
                                <option value="" disabled selected>Selecciona un estado</option>
                                    <option value="activo">Activo</option>
                                    <option value="Inctivo">Inactivo</option>
                            </select>
                        </div>
                <div class="col-lg-12 mb-4">
                    <label for="imagen" class="form-label fw-semibold">Imagen</label>
                    <input type="file" class="form-control" name="imagen" value="{{$herramientaEditar->imagen}}">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-plus py-2">Editar</button>
            </div>
            </div>
    </form>
</div>
@else
    <div class="alert alert-success text-center mx-5" role="alert">
    Acceso no Autorizado
    </div>
    </div>
</div>
@endcan
@endsection

<style>
    .gcontainer {
    position: relative; /* Necesario para el pseudo-elemento */
    border-radius: 20px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    max-width: 800px;
    max-height: 600px;
    width: 100%;
    overflow: hidden; /* Para asegurar que el pseudo-elemento respete los bordes redondeados */
    background: rgba(255, 255, 255, 0.8); /* Fondo blanco semi-transparente para el contenido del formulario */
}
</style>
