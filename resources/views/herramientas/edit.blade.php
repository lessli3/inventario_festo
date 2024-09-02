@extends('layouts.dashboard')
@section('titulo', 'Editar Herramienta')
@section('content')
@can('agregarAdministrador')
<h2 class="text-center my-4">EDITAR HERRAMIENTA</h2>
<div class="container d-flex justify-content-center">
    <form action="/Herramientas/{{$productEditar->id}}" method="POST" class="form-editar" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <label for="nombreHerramienta" class="form-label">Nombre</label>
                    <input type="text" class="form-control" value="{{$productEditar->nombre}}" name="nombreEdit">
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="descripHerramienta" class="form-label">Descripción</label>
                    <input type="text" class="form-control" value="{{$productEditar->descripcion}}" name="descripEdit">
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="precioHerramienta" class="form-label">Precio</label>
                    <input type="number" class="form-control" value="{{$productEditar->precio}}" name="precioEdit" id="precio">
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="stockHerramienta" class="form-label">Stock</label>
                    <input type="number" class="form-control" value="{{$productEditar->stock}}" name="stockEdit" id="stock">
                </div>
                <div class="col-lg-6 mb-4">
                    <label class="form-label fw-semibold">Cantidad</label>
                    <input type="number" value="{{$productEditar->cantidad}}" class="form-control" name="cantidadEdit">
                </div>
                <div class="col-lg-6 mb-4">
                    <label class="form-label fw-semibold">Unidad de medida</label>
                    <input type="text" value="{{$productEditar->medida}}" class="form-control" name="medidaEdit">
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="categoriaHerramienta" class="form-label">Categoría</label>
                    <select class="form-control" name="categoriaEdit" required>
                        <option value="" disabled>Selecciona una categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $productEditar->categoria == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="imagen" class="form-label fw-semibold">Imagen</label>
                    <input type="file" class="form-control" name="imagen" value="{{$productEditar->imagen}}">
                </div>
                <div class="contenedor-menu-info">
                    <h1 class="mb-3 mt-3 fw-semibold" style="font-size: 18px;font-weight: 350;">¿El Herramienta tiene oferta?</h1>
                    <select id="opcOfertaSelect" class="form-control" name="opcOferta">
                        <option value="no" {{ $productEditar->oferta ? 'selected' : '' }}>No</option>
                        <option value="si" {{ $productEditar->oferta ? 'selected' : '' }}>Sí</option>
                    </select>

                    <div id="ofertaFields" style="{{ $productEditar->oferta ? 'display: block;' : 'display: none;' }}">
                        <div class="mt-4">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label fw-semibold">Indique el descuento (%)</label>
                                    <input type="number" placeholder="" class="form-control" name="descuento" id="descuento" value="{{$productEditar->descuento}}">
                                </div>
                                <div class="col-lg-6 mb-3 fw-semibold">
                                    <label class="form-label">Valor Total</label>
                                    <input type="number" placeholder="" class="form-control" name="valor_final" id="valor_final" value="{{$productEditar->valor_final}}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success my-4">Editar</button>
            </div>
            </div>
    </form>
</div>
@else
    <div class="alert alert-success text-center mx-5" role="alert">
    Acceso no Autorizado
    </div>
@endcan
@endsection