@extends('layouts.dashboard')

@section('title', 'Lista de Herramientas y Stock')

@section('content')
<h4 class="fw-bold">INVENTARIO DE HERRAMIENTAS</h4>

<!-- Contenido de la página -->
<div class="container mt-4">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Stock</th>
                    <th>Categoria</th>
                    <th>Imagen</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventario as $post)
                <tr>
                    <td>{{ $post->cod_herramienta }}</td>
                    <td>{{ $post->nombre }}</td>
                    <td>{{ Str::limit($post->descripcion, 50) }}</td>
                    <td>{{ $post->stock }}</td>
                    <td>{{ $post->categoria }}</td>
                    <td>
                        <!-- Imagen pequeña con enlace al modal -->
                        <img src="{{ asset('imagenes/herramientas/' . $post->imagen) }}" alt="Imagen del post" class="img-thumbnail" width="60" height="100" onclick="openModal('{{ asset('imagenes/herramientas/' . $post->imagen) }}')" style="cursor: pointer;">
                    </td>
                    <td>{{ $post->estado }}</td>
                    <td>
                        <!-- Formulario para disminuir stock -->
                        <form action="{{ route('inventario.adjustarStock', ['post' => $post->id, 'action' => 'decrease']) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="cod_herramienta" value="{{ $post->cod_herramienta }}">
                            <button type="submit" class="btn btn-warning btn-sm">
                                <i class="fas fa-minus-circle"></i>
                            </button>
                        </form>


                        <!-- Formulario para aumentar stock -->
                        <form action="{{ route('inventario.adjustarStock', ['post' => $post->id, 'action' => 'increase']) }}" method="POST" class="d-inline" title="Sumar Stock">
                            @csrf
                            <input type="hidden" name="cod_herramienta" value="{{ $post->cod_herramienta }}">
                            <button type="submit" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-plus-circle"></i>
                            </button>
                        </form>

                        <!-- Formulario para eliminar -->
                        <form action="{{ route('inventario.destroy', $post->id) }}" method="POST" class="d-inline" title="Eliminar">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal personalizado -->
<div id="customModal" class="custom-modal">
    <span class="close-modal" onclick="closeModal()">&times;</span>
    <img class="modal-content-img" id="modalImg">
</div>

<!-- Estilos para el modal -->
<style>
.custom-modal {
    display: none;
    position: fixed;
    z-index: 10

    00;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content-img {
    display: block;
    max-width: 40%;
    max-height: 40%;
    margin: auto;
    margin-top: 10%;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.close-modal {
    position: absolute;
    top: 20%;
    right: 25%;
    color: #fff;
    font-size: 35px;
    font-weight: bold;
    cursor: pointer;
    background-color: rgba(0, 0, 0, 0.8);
    padding: 5px;
    border-radius: 50%;
    line-height: 35px;
}

.close-modal:hover, .close-modal:focus {
    color: #bbb;
}
</style>

<!-- Script para manejar el modal -->
<script>
function openModal(imageUrl) {
    var modal = document.getElementById("customModal");
    var modalImg = document.getElementById("modalImg");
    modal.style.display = "block";
    modalImg.src = imageUrl;

    // Añadir evento para cerrar el modal al hacer clic fuera de la imagen
    modal.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeModal();
        }
    });
}

function closeModal() {
    var modal = document.getElementById("customModal");
    modal.style.display = "none";
}
</script>

@endsection
