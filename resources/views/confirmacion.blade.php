@extends('layouts.dashboard')
@section('titulo', 'Confirmación')
@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación</title>
    @vite(['resources/js/app.js'])
    <script src="http://localhost:3000/socket.io/socket.io.js"></script>
</head>
<body>
    @foreach ($solicitudes as $solicitud)
    <h4 class="fw-bold mb-3">HERRAMIENTAS ESPERADAS PARA LA SOLICITUD {{ $solicitud->fecha }} </h4>
    <p><strong>Instructor:</strong> {{ $solicitud->nombre }} <br>
    <strong>ID de la solicitud:</strong> {{ $solicitud->id }} </p>

    <table class="tablen align-middle mb-0 bg-white">
        <thead class="bg-light">
            <tr style="height: 50px">
                <th>NOMBRE</th>
                <th>CANTIDAD</th>
                <th>ESTADO</th>
                <th>Actions</th>
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
                    <td>
                        <button type="button" class="btn btn-link btn-sm btn-rounded">
                            <a href="/solicitudIndex" style="text-decoration:none !important"><i class="fas fa-pencil"> </i>Editar</a>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @endforeach
    <center>
        <form action="{{ route('solicitud.pdf', $solicitud->id) }}" method="get">
            <button type="submit" id="entregadaBtn" class="btn ms-5" style="background-color: green; color:white;" {{ $solicitud->tools_scanned ? '' : 'disabled' }}>
                <i class="fas fa-tools"></i> Herramienta Entregada
            </button>
        </form>
    </center>




    
</body>
<script>
    const socket = io("http://localhost:3000");

    // Escuchar el evento "barcodeScanned" para actualizar la lista
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

    // Habilitar el botón si todas las herramientas están escaneadas
    const entregadaBtn = document.getElementById('entregadaBtn');
    if (totalTools === scannedTools) {
        entregadaBtn.disabled = false;  // Habilitar el botón si todas las herramientas están escaneadas
    }
}
</script>
</html>
<style>
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

</style>

@endsection
