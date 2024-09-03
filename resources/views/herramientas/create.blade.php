@extends('layouts.dashboard')
@section('titulo', 'Crear Herramienta')
@section('content')
@can('agregarAdministrador')

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="gcontainer py-3 bg-container">
        <h2 class="text-center mb-5">CREAR HERRAMIENTA</h2>
        <div class="container d-flex justify-content-center">
            <form action="/herramientas" method="POST" enctype="multipart/form-data" class="form-editar">
                @csrf
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label class="form-label fw-semibold">Nombre</label>
                            <input type="text" class="form-control" name="nombre" required placeholder="Ingresa el nombre del producto">
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label fw-semibold">Descripción</label>
                            <input type="text" placeholder="Ingresa la descripción del producto" class="form-control" name="descripcion" required>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label fw-semibold">Stock</label>
                            <input type="number" placeholder="Cantidad disponible de tu producto" class="form-control" name="stock" required>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label fw-semibold">Categoría</label>
                            <select class="form-control" name="categoria" required>
                                <option value="" disabled selected>Selecciona una categoría</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="imagen" class="form-label fw-semibold">Imagen</label>
                            <input type="file" placeholder="Seleccione la imagen del producto" class="form-control" name="imagen" required>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-plus py-2 fw-semibold">Crear Herramienta</button>
                </div>
            </form>
        </div>
    </div>
@else
    <div class="alert alert-success text-center mx-5" role="alert">
        Acceso no Autorizado
    </div>
@endcan
</div>
@endsection


<style>

.gcontainer {
    position: relative; /* Necesario para el pseudo-elemento */
    border-radius: 20px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    max-width: 800px;
    max-height: 480px;
    width: 100%;
    overflow: hidden; /* Para asegurar que el pseudo-elemento respete los bordes redondeados */
    background: rgba(255, 255, 255, 0.8); /* Fondo blanco semi-transparente para el contenido del formulario */
}

/*.gcontainer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.6); /* Sombra sobre la imagen 
    z-index: 0; /* Asegura que el pseudo-elemento esté por encima de la imagen de fondo pero debajo del contenido del formulario 
    border-radius: 20px; /* Coincide con el borde del contenedor 
}*/

.bg-container {
    background-image: url('/img/login1.jpg'); /* Cambia la ruta por la de tu imagen */
    background-size: cover; /* Ajusta la imagen para que cubra todo el contenedor */
    background-position: center; /* Centra la imagen en el contenedor */
    position: relative; /* Necesario para apilar el pseudo-elemento correctamente */
    z-index: 0; /* La imagen de fondo estará detrás del pseudo-elemento */
}


</style>


