<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitud PDF</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { color: green; font-weight: bold; }
        h4, h5 { font-weight: bold; }
        p { font-family: Arial, sans-serif; }

        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; text-align: left; }

        .row { margin-top: 10px; }
        
        .col-md-11 {
            float: left;
            width: 90%;
        }
        .col-md-1 {
            float: left;
            width: 10%;
            text-align: right;
        }

        .col-md-8 {
            float: left;
            width: 60%;
        }
        .col-md-4 {
            float: left;
            width: 40%;
        }
        
        .mt-4 { margin-top: 1.5rem; }
        .mt-3 { margin-top: 1rem; }
        .fw-bold { font-weight: bold; }
        .ms-1 { margin-left: 0.25rem; }
        .pt-3 { padding-top: 1rem; }
        .mb-4 { margin-bottom: 1.5rem; }

        hr { border: 1px solid #ddd; margin: 20px 0; }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>
<body>
    <div class="row mt-4 clearfix">
        <div class="col-md-11">
            <h2 class="fw-bold ms-1 pt-3">SOLICITUD {{ $solicitud->fecha }}</h2>
        </div>
        <div class="col-md-1">
            <img src="img/logov.png" alt="Logo" style="width: 60px; height: 60px;">
        </div>
    </div>
    <hr>
    <h4 class="fw-bold">Centro de Biotecnología Agropecuaria</h4>
    <h5>Av. Troncal de Occidente No. 20 - 86 Mosquera.</h5>
    <h5 class="fw-bold">FESTO</h5>

    <div class="row clearfix" style="margin-top: 70px">
        <div class="col-md-8">
            <h4 class="fw-bold" style="color:green">SOLICITANTE</h4>
            <p>Instructor: {{ $solicitud->nombre }}</p>
            <p>Teléfono: {{ $solicitud->telefono }}</p>
            <p>Correo: {{ $solicitud->email }}</p>
        </div>
        <div class="col-md-4 mb-4">
            <h4 class="fw-bold" style="color:green">INFORMACIÓN DE LA SOLICITUD</h4>
            <p>Hora de la solicitud: {{ $solicitud->hora}}</p>
            <p>Fecha y hora entrega: {{ \Carbon\Carbon::parse($solicitud->hora_recibida)->format('d/m/Y H:i') }}</p>
            <p>Fecha y hora devolución: {{ \Carbon\Carbon::parse($solicitud->hora_entrega)->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <table class="mt-3">
        <thead>
            <tr>
                <th>HERRAMIENTA</th>
                <th>CANTIDAD</th>
                <th>ESTADO</th>
            </tr>
        </thead>
        <tbody>
            @foreach($herramientas as $detalleSolicitud)
                <tr>
                    <td>{{ $detalleSolicitud->herramienta->nombre }}</td>
                    <td>{{ $detalleSolicitud->cantidad }}</td>
                    <td>{{ $detalleSolicitud->estado }}</td> 
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
