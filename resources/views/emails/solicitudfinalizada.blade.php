<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Herramientas Recibidas</title>
</head>
<body>
    <h1>Solicitud {{ $solicitud->id }} Recibida</h1>
    <p>Hola {{ $solicitud->nombre }}</p>
    <p>La solicitud de herramientas de la fecha {{ $solicitud->fecha }} ha sido recibida correctamente. El PDF con los detalles  se adjunta a este correo.</p>
    <p>Gracias por usar nuestro sistema.</p>
</body>
</html>
