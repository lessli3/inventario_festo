<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOLICITUD FINALIZADA - CONTROL FESTO</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #39a900;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .content p {
            font-size: 16px;
            margin: 10px 0;
        }
        .highlight {
            color: #39a900;
            font-weight: bold;
        }
        .footer {
            background-color: #f4f4f4;
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #dddddd;
        }
        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Confirmación de devolución</h1>
        </div>
        <div class="content">
            <p>Hola <span class="highlight">{{ $solicitud->nombre }}</span>,</p>
            <p>La solicitud realizada el <span class="highlight">{{ $solicitud->fecha }}</span> ha sido recibida correctamente.</p>
            <br>
            <p>El archivo PDF con los detalles de tu solicitud se adjunta a este correo.</p>
            <p>Gracias por usar CONTROL FESTO.</p>
        </div>
        <div class="footer">
            <p>Este correo fue generado automáticamente. Por favor, no respondas a este mensaje.</p>
            <p>CONTROL FESTO - SENA</p>

        </div>
    </div>
</body>
</html>
