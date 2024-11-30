const { createServer } = require("http");
const { Server } = require("socket.io");

const httpServer = createServer();
const io = new Server(httpServer, {
    cors: {
        origin: "*",
        methods: ["GET", "POST"]
    }
});

io.on("connection", (socket) => {
    console.log("Nuevo cliente conectado");
    socket.on("scanBarcode", (data) => {
        io.emit("barcodeScanned", data); 
    });
    

    socket.on("disconnect", () => {
        console.log("Cliente desconectado");
    });
});

httpServer.listen(3000, () => {
    console.log("Servidor de Socket.IO corriendo en el puerto 3000");
});
