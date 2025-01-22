<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lector de Código de Barras</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        .container {
            width: 90%;
            max-width: 600px;
            background: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }
        #interactive {
            width: 100%;
            height: 320px;
            border: 2px solid #007bff;
            border-radius: 8px;
            margin-bottom: 20px;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .result, .tool-data {
            margin: 10px 0;
            padding: 10px;
            border-radius: 4px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            text-align: left;
        }
        .result span, .tool-data span {
            font-weight: bold;
            color: #007bff;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }

        
    </style>
</head>
<body>
    <div class="container">
        <h1>Lector de Código de Barras</h1>
        <div id="interactive" class="viewport">
            <p>Activando cámara...</p>
        </div>
        <div class="result">
            Código Escaneado: <span id="result">N/A</span>
        </div>
        <div class="tool-data">
            Datos de la Herramienta: <span id="data">N/A</span>
        </div>
        <button onclick="window.location.reload()">Reiniciar Escáner</button>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    <script src="http://localhost:3000/socket.io/socket.io.js"></script>

    <script>
        let herramientasEscaneadas = [];

        const socket = io("http://localhost:3000");

        socket.on('connect', () => {
            console.log("Socket.IO connected");
        });

        socket.on('disconnect', () => {
            console.log("Socket.IO disconnected");
        });

        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector('#interactive'),
                constraints: {
                    width: 480,
                    height: 320,
                    facingMode: "environment"
                }
            },
            decoder: {
                readers: ["code_128_reader", "ean_reader", "ean_8_reader", "upc_reader"]
            }
        }, function (err) {
            if (err) {
                console.error("Quagga initialization error:", err);
                return;
            }
            Quagga.start();
        });

        Quagga.onDetected(function (result) {
            const code = String(result.codeResult.code);
            console.log('Código escaneado:', code);

            document.getElementById('result').textContent = code;

            fetch('/api/scan-barcode', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ barcode: code })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Respuesta del servidor:', data);

                const toolData = `Nombre: ${data.nombre}, Descripción: ${data.descripcion}`;
                document.getElementById('data').textContent = toolData;

                herramientasEscaneadas.push({
                    barcode: code,
                    nombre: data.nombre,
                    descripcion: data.descripcion
                });

                socket.emit("scanBarcode", herramientasEscaneadas);
            })
            .catch(error => console.error('Error:', error));

            Quagga.stop();
        });
    </script>
</body>
</html>
