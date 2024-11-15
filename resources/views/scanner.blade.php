<h1>Lector de Código de Barras</h1>
<div id="interactive" class="viewport"></div>
<p>Código Escaneado: <span id="result"></span></p>
<p>Datos de la herramienta: <span id="data"></span></p>

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

    // Initialize Quagga
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
