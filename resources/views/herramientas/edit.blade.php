@extends('layouts.dashboard')
@section('titulo', 'Editar Herramienta')
@section('content')
@can('crearHerramienta')

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh">
    <div class="gcontainer py-3 bg-container" style=" max-height: 1900px">
    <h2 class="text-center my-4 fw-bold">EDITAR HERRAMIENTA</h2>


<div class="container d-flex justify-content-center">
    <form action="/herramientas/{{$herramientaEditar->id}}" method="POST" class="form-editar" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <label class="form-label fw-bold">Código de la Herramienta</label>
                    <input type="text" class="form-control" value="{{$herramientaEditar->cod_herramienta}}" name="codigoEdit">                
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="nombreHerramienta" class="form-label fw-bold">Nombre</label>
                    <input type="text" class="form-control" value="{{$herramientaEditar->nombre}}" name="nombreEdit">
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="descripHerramienta" class="form-label fw-bold">Descripción</label>
                    <input type="text" class="form-control" value="{{$herramientaEditar->descripcion}}" name="descripEdit">
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="stockHerramienta" class="form-label fw-bold">Stock</label>
                    <input type="number" class="form-control" value="{{$herramientaEditar->stock}}" name="stockEdit" id="stock">
                </div>

                <div class="col-lg-6 mb-4">
                    <label for="organizadorHerramienta"  class="form-label fw-bold">Organizador</label>
                    <select class="form-control" name="organizadorEdit" required>
                        <option value="" disabled selected>Selecciona</option>
                        <option value="1">Organizador 1</option>
                        <option value="2">Organizador 2</option>
                    </select>
                </div>

                <div class="col-lg-6 mb-4">
                    <label for="cajonHerramienta" class="form-label fw-bold">Cajón</label>
                    <select class="form-control" name="cajonEdit" required>
                        <option value="" disabled selected>Selecciona</option>
                        <option value="1">Cajón 1</option>
                        <option value="2">Cajón 2</option>
                        <option value="3">Cajón 3</option>
                        <option value="4">Cajón 4</option>
                        <option value="5">Cajón 5</option>
                        <option value="6">Cajón 6</option>
                    </select>
                </div>
                
                <div class="col-lg-6 mb-4">
                    <label for="categoriaHerramienta" class="form-label fw-bold">Categoría</label>
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
                            <label class="form-label fw-bold">Estado</label>
                            <select class="form-control" name="estadoEdit" required>
                                <option value="" disabled selected>Selecciona un estado</option>
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-4">
    <!-- Imagen anterior -->
    <div class="card" style="height: 180px; width: 80%; margin-left: 10%;">
        <label class="text-center form-label fw-bold">Imagen - Herramienta anterior</label>
        <div class="card-body text-center" style="background: transparent;">
            <img id="old-tool-image-preview" src="/imagenes/herramientas/{{$herramientaEditar->imagen}}" alt="Imagen Anterior" class="object-cover rounded-lg d-block mx-auto mb-4" style="height: 110px"/>
        </div>
    </div>
    <!-- Nueva imagen seleccionada -->
    <div id="card-new-tool-image" class="card mt-3" style="height: 180px; width: 80%; margin-left: 10%; display: none;">
        <label class="text-center ms-3 form-label fw-bold">Nueva Imagen</label>
        <div class="card-body text-center" style="background: transparent;">
            <img id="new-tool-image-preview" src="#" alt="Nueva Imagen" class="object-cover rounded-lg d-block mx-auto mb-4" style="height: 110px; display: none;"/>
        </div>
    </div>

    <!-- Input para seleccionar nueva imagen -->
    <label for="imagen" class="form-label fw-semibold mt-3">Seleccionar nueva imagen</label>
    <input type="file" id="preview-imagen" class="form-control" name="imagen" accept="image/*" onchange="previewImage(event, 'new-tool-image-preview', 'card-new-tool-image')">    <p style="font-size: 13px; color: red;">(Si no desea cambiar la imagen no seleccione ningún archivo)</p>
</div>

<div class="col-lg-6 mb-4">
    <!-- Código de barras anterior -->
    <div class="card" style="height: 180px; width: 80%; margin-left: 10%">
        <label class="text-center form-label fw-bold">Código de Barras Anterior</label>
        <div class="card-body text-center" style="background: transparent;">
            <img id="old-code-image-preview" src="/imagenes/codeb/{{$herramientaEditar->imagencode}}" alt="Código de Barras Anterior" class="object-cover rounded-lg d-block mx-auto mb-4" style="height: 110px"/>
        </div>
    </div>

    <!-- Nuevo código de barras seleccionado -->
    <div id="card-new-code-image" class="card mt-3" style="height: 180px; width: 80%; margin-left: 10%; display:none;">
        <label class="text-center ms-3 form-label fw-bold">Nuevo Código de Barras</label>
        <div class="card-body text-center" style="background: transparent;">
            <img id="new-code-image-preview" src="#" alt="Nuevo Código de Barras" class="object-cover rounded-lg d-block mx-auto mb-4" style="height: 110px; display: none;"/>
        </div>
    </div>

    <!-- Input para seleccionar nuevo código de barras -->
    <label for="imagencode" class="form-label fw-semibold mt-3">Seleccionar nuevo código de barras</label>
    <input type="file" id="code-image-input" class="form-control" name="imagencode" accept="image/*" onchange="previewImage(event, 'new-code-image-preview', 'card-new-code-image')">    <p style="font-size: 13px; color: red;">(Si no desea cambiar el código de barras no seleccione ningún archivo)</p>
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
<script>

function previewImage(event, previewId, cardId) {
    const input = event.target;
    const reader = new FileReader();

    reader.onload = function(e) {
        const preview = document.getElementById(previewId);
        const card = document.getElementById(cardId);

        preview.src = e.target.result;
        preview.style.display = 'block'; // Mostrar la imagen
        card.style.display = 'block';    // Mostrar la tarjeta
    };

    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]); // Leer la imagen seleccionada
    }
}



</script>


