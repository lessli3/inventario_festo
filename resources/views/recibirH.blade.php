@extends('layouts.dashboard')
@section('titulo', 'Recibir Herramientas')
@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibir Herramientas</title>
    @vite(['resources/js/app.js'])
    <script src="http://localhost:3000/socket.io/socket.io.js"></script>
</head>
<body>
@foreach ($solicitudes as $solicitud)
    <h4 class="fw-bold mb-3">HERRAMIENTAS PARA RECIBIR EN LA SOLICITUD {{ $solicitud->fecha }} </h4>
    <p><strong>Instructor:</strong> {{ $solicitud->nombre }} <br>
    <strong>ID de la solicitud:</strong> {{ $solicitud->id }} </p>

    <table class="tablen align-middle mb-0 bg-white">
        <thead class="bg-light">
            <tr style="height: 50px">
                <th class="ps-4">NOMBRE</th>
                <th>CANTIDAD</th>
                <th class="ps-3" >ESTADO</th>
            </tr>
        </thead>
        <tbody id="tools-list">
            @foreach ($herramientas as $detalleSolicitud)
                <tr id="tool-{{ $detalleSolicitud->herramienta->id }}" class="tool-item" data-barcode="{{ $detalleSolicitud->cod_herramienta }}">
                    <td style="height: 90px;">
                        <div class="d-flex align-items-center">
                        <img
                            src="{{ Str::startsWith($detalleSolicitud->herramienta->imagen, ['http://', 'https://']) ? $detalleSolicitud->herramienta->imagen : asset('imagenes/herramientas/' . $detalleSolicitud->herramienta->imagen) }}"
                            alt="{{ $detalleSolicitud->herramienta->nombre }}"
                            style="width: 45px; height: 45px"
                            class="rounded-circle"
                        />


                            <div class="ms-3">
                                <p class="fw-bold mb-1">{{ $detalleSolicitud->herramienta->nombre }}</p>
                                <p class="text-muted mb-0">{{ $detalleSolicitud->cod_herramienta }} </p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="text-muted mb-0 ms-4">{{ $detalleSolicitud->cantidad }}</p>
                    </td>
                    <td>
                        <span class="status badge badge-success rounded-pill d-inline" style="background-color: cadetblue;">PENDIENTE</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @endforeach
    <center>
        <form action="{{ route('solicitudes.finalizar', $solicitud->id) }}" method="get">
            @csrf
            <button type="submit" id="finalizarBtn" class="btn btn-outline-success mt-4 " data-loading-text="Procesando..." disabled>
                <i class="fas fa-check"></i> Finalizar 
            </button>
        </form>

        <button id="finalizadoBtn" class="btn mt-3" style="background-color: green; color:white;">
        <a href="/solicitudIndex" class="" role="button" style="color: white; opacity: 1; text-decoration: none;">
        <i class="fas fa-arrow-left"></i> Regresar</a>
    </button>
    </center>
</body>
</body>
<script>
  const socket = io("http://localhost:3000");

    socket.on('barcodeScanned', (scannedTools) => {
        console.log("Evento barcodeScanned recibido:", scannedTools);  // Verifica lo que llega

        scannedTools.forEach(scannedTool => {
            // Buscar la herramienta en el DOM usando el barcode
            const toolElement = document.querySelectorAll('.tool-item').forEach((toolItem) => {
                const toolBarcode = toolItem.getAttribute('data-barcode'); // Obtener el barcode desde el atributo 'data-barcode'

                // Si el código escaneado coincide con el de la herramienta, actualizar el estado
                if (toolBarcode === scannedTool.barcode) {
                    const statusElement = toolItem.querySelector('.status');
                    if (statusElement) {
                        statusElement.innerText = 'ESCANEADA';
                        statusElement.style.backgroundColor = 'green';  // Cambiar color a verde
                        toolItem.classList.add('scanned');
                    }
                }
            });
        });
        checkAllScanned();
    });

    function checkAllScanned() {
        const totalTools = document.querySelectorAll('.tool-item').length;
        const scannedTools = document.querySelectorAll('.tool-item.scanned').length;

        const finalizarBtn = document.getElementById('finalizarBtn');
        if (totalTools === scannedTools) {
            finalizarBtn.disabled = false;
            console.log("El botón ahora está habilitado");
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const finalizarBtn = document.getElementById('finalizarBtn');

        if (finalizarBtn) {
            finalizarBtn.addEventListener('click', (e) => {
                // Prevenir múltiples envíos
                e.preventDefault();

                finalizarBtn.innerText = "Procesando...";
                finalizarBtn.style.backgroundColor = "gray";
                finalizarBtn.style.cursor = "not-allowed";

                // Deshabilitar el botón inmediatamente para evitar clics múltiples
                finalizarBtn.disabled = true;

                setTimeout(() => {
                    finalizarBtn.style.display = 'none'; 

                    // Cambiar el botón "Regresar" por "Finalizado"
                    if (finalizadoBtn) {
                        finalizadoBtn.style.backgroundColor = "gray"; // Cambiar color a gris
                        finalizadoBtn.style.cursor = "not-allowed"; // Cambiar cursor
                        finalizadoBtn.querySelector('a').innerText = "Finalizado"; // Cambiar texto del enlace
                    }

                }, 10000); 


                // Si es necesario, envía el formulario manualmente
                finalizarBtn.closest('form').submit();
            });
        }
    });

</script>
</html>
<style>

#finalizarBtn[disabled] {
    background-color: gray;
    color: white;
    cursor: not-allowed;
}

#finalizarBtn {
    transition: background-color 0.3s ease, color 0.3s ease;
}

    .tablen tr:not(:last-child) td:last-child {
    border-bottom-color: transparent !important;
    }

    .tablen{
        width: 95%;
        margin: auto;
        margin-top: auto;
        margin-bottom: auto;
        margin-top: 40px;
    }


@media (max-width: 677px) {
    .header{
        width: 100% !important;
        margin-left: 0% !important;
        margin-top: 0 !important;
        z-index: 5 !important;
    }
}
@media (min-width: 677px) and (max-width: 1000px) {
    .header{
        margin-top: 0 !important;
        z-index: 5 !important;
    }
}
</style>
@endsection
