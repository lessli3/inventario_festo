@extends('layouts.dashboard')
@section('titulo', 'Crear Herramienta')
@section('content')
@can('agregarAdministrador')
<h2 class="text-center mb-5 fw-bold">CREAR PRODUCTO</h2>
<div class="container d-flex justify-content-center">
<form action="/herramientas" method="POST" enctype="multipart/form-data" class="form-editar">
    @csrf
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <label class="form-label fw-semibold">Nombre</label>
                <input type="text"  class="form-control" name="nombre" required="" placeholder="Ingresa el nombre del producto">
            </div>
            <div class="col-lg-6 mb-4">
                <label class="form-label fw-semibold">Descripción</label>
                <input type="text" placeholder="Ingresa la descripción del producto" class="form-control" name="descripcion" required="">
            </div>
            <div class="col-lg-6 mb-4">
                <label class="form-label fw-semibold">Precio</label>
                <input type="number" placeholder="Precio de tu producto por unidad" class="form-control" name="precio" id="precio" required="">
            </div>
            <div class="col-lg-6 mb-4">
                <label class="form-label fw-semibold">Stock</label>
                <input type="number" placeholder="Cantidad disponible de tu producto" class="form-control" name="stock" required="">
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
            <div class="col-lg-6 mb-4">
                <label for="vendedor_id" class="form-label ">Emprendimiento</label>
                <select class="form-control" name="vendedor_id" required>
                    <option value="" disabled selected>Selecciona tu emprendimiento</option>
                    @foreach($vendedores as $vendedor)
                        <option value="{{ $vendedor->id }}">{{ $vendedor->nom_emprendimiento }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-6 mb-4">
                <label class="form-label fw-semibold">Cantidad</label>
                <input type="number" placeholder="Cantidad que contiene cada producto" class="form-control" name="cantidad">
            </div>
            <div class="col-lg-6 mb-4">
                <label class="form-label fw-semibold">Unidad de Medida</label>
                <input type="text" placeholder="Ej. Lts, Gr, Ml, Kg, Pares, etc." class="form-control" name="medida">
            </div>
            <div class="mb-4">
                <label for="imagen" class="form-label fw-semibold">Imagen</label>
                <input type="file" placeholder="Seleccione la imagen del producto" class="form-control" name="imagen" required="">
            </div>
            <div class="contenedor-menu-info">
                <h1 class="mb-4 mt-3 fw-semibold" style="font-size: 18px;font-weight: 350;">¿El producto tiene oferta?</h1>
                <select id="opcOfertaSelect" class="form-control" name="opcOferta">
                    <option value="no">No</option>
                    <option value="si">Sí</option>
                </select>

                <div id="ofertaFields" style="display: none;">
                    <div class="mt-4">
                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <label class="form-label fw-semibold">Indica el descuento (%)</label>
                                <input type="number" placeholder="Porcentaje de descuento" class="form-control" name="descuento" id="descuento">
                                <small class="form-text text-muted">Ingresa valores numéricos sin el signo (%)</small>
                            </div>
                            <div class="col-lg-6 mb-4 fw-semibold">
                                <label class="form-label">Valor Total</label>
                                <input type="number" placeholder="Ingresa el nombre de su producto." class="form-control" name="valor_final" id="valor_final" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    <div class="text-center">
        <button type="submit" class="btn btn-success my-4 fw-semibold">Crear Producto</button>
    </div>
    </form>
</div>
@else
    <div class="alert alert-success text-center mx-5" role="alert">
    Acceso no Autorizado
    </div>
@endcan
@endsection