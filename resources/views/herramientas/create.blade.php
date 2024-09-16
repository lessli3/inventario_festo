@extends('layouts.dashboard')
@section('titulo', 'Crear Herramienta')
@section('content')
@can('agregarAdministrador')

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="gcontainer py-3 bg-container" style="max-height: 2000px">
        <h2 class="text-center mb-5 fw-bold">CREAR HERRAMIENTA</h2>
        <div class="container d-flex justify-content-center" >
            <form action="/herramientas" method="POST" enctype="multipart/form-data" class="form-editar">
                @csrf
                <div class="container mt-3" >
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label class="form-label fw-bold">Código de la Herramienta</label>
                            <input type="text" class="form-control" name="cod_herramienta" required placeholder="Ingresa el nombre de la herramienta">
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label fw-bold">Nombre</label>
                            <input type="text" class="form-control" name="nombre" required placeholder="Ingresa el nombre de la herramienta">
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label fw-bold">Descripción</label>
                            <input type="text" placeholder="Ingresa la descripción de la herramienta" class="form-control" name="descripcion" required>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label fw-bold">Stock</label>
                            <input type="number" placeholder="Cantidad disponible de la herramienta" class="form-control" name="stock" required>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label fw-bold">Categoría</label>
                            <select class="form-control" name="categoria" required>
                                <option value="" disabled selected>Selecciona una categoría</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label fw-bold">Estado</label>
                            <select class="form-control" name="estado" required>
                                <option value="" disabled selected>Selecciona un estado</option>
                                    <option value="activo">Activo</option>
                                    <option value="Inctivo">Inactivo</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-4 d-flex justify-content-center">
                            <div class="card">
                            <label for="imagen" class="form-label fw-bold">Imagen</label>
                                <div class="card-body text-center" style="background: transparent;">
                                    <img id="preview-imagen" src="#" alt="Vista previa de la imagen" class="img-fluid" style="display: none; height: 150px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4 d-flex justify-content-center">
                        <div class="card">
                            <label for="imagencode" class="form-label fw-bold">Imagen - Código de barras</label>
                                <div class="card-body text-center" style="background: transparent;">
                                    <img id="preview-imagencode" src="#" alt="Vista previa del código de barras" class="img-fluid" style="display: none; height: 110px">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4 d-flex justify-content-center">
                            <input type="file" id="imagen" class="form-control mt-3" name="imagen" required onchange="previewImage(event, 'preview-imagen')">
                        </div>
                        <div class="col-lg-6 mb-4 d-flex justify-content-center">
                            <input type="file" id="imagencode" class="form-control mt-3" name="imagencode" required onchange="previewImage(event, 'preview-imagencode')">
                        </div>

                    </div>

                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-plus py-2 fw-bold">Crear Herramienta</button>
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
    position: relative; 
    border-radius: 20px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    max-width: 800px;
    max-height: 600px;
    width: 100%;
    overflow: hidden; 
    background: rgba(255, 255, 255, 0.8); 
}

/*.gcontainer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.6); 
    z-index: 0; 
    border-radius: 20px; 
}*/

.bg-container {
    /*background-image: url('/img/login1.jpg'); */
    background-size: cover; 
    background-position: center; 
    position: relative; 
    z-index: 0; 
}

.card {
    border: 1px solid #ddd; /* Borde de la tarjeta */
    border-radius: 10px; /* Bordes redondeados */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Sombra */
    padding: 15px;
    max-width: 350px; /* Limitar el ancho */
    text-align: center;
}

.img-fluid {
    max-width: 100%;
    height: auto;
    border-radius: 5px; /* Bordes redondeados para la imagen */
}



</style>

<script>
function previewImage(event, previewId) {
    const input = event.target;
    const reader = new FileReader();

    reader.onload = function(e) {
        const preview = document.getElementById(previewId);
        preview.src = e.target.result;
        preview.style.display = 'block'; // Mostrar la imagen
    };

    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]); // Leer la imagen seleccionada
    }
}
</script>

