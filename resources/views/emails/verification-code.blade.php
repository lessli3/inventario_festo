<!DOCTYPE html>
<html>
<head>
    <title>Código de Verificación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 10px 0;
            background-color: #39a900;
            color: #ffffff;
            border-radius: 8px 8px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
            text-align: center;
            color: #333333;
        }
        .content p {
            font-size: 18px;
            margin: 10px 0;
        }
        .code {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            font-size: 24px;
            font-weight: bold;
            color: #39a900;
            background-color: #f0f8ff;
            border: 1px dashed #39a900;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            padding: 10px 0;
            font-size: 12px;
            color: #888888;
            border-top: 1px solid #dddddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Código de Verificación</h1>
        </div>
        <div class="content">
            <p>¡Hola!</p>
            <p>Tu código de verificación es:</p>
            <div class="code">{{ $code }}</div>
            <p>Por favor, usa este código para ingresar a CONTROL FESTO. Este código es válido solo por un tiempo limitado.</p>
        </div>
        <div class="footer">
            <p>Este correo fue generado automáticamente. Por favor, no respondas a este mensaje.</p>
            <p>CONTROL FESTO - SENA</p>

        </div>
    </div>
</body>
</html>
