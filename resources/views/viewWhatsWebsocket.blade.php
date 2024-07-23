<!DOCTYPE html>
<html>
<head>
    <title>Visualização de Webhook</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>
    

</head>
<body>
    <h1>Visualização de Webhook</h1>

    <div id="webhookData">
        <!-- Aqui será inserida a tabela com os dados do webhook -->
    </div>

    
    

    <script >
        try{
        const socket = io("wss://apiwhatsapp.us.to/teste02", {
            transports: ['websocket']
        });

        socket.on('connect', () => {
            console.log('Conectado ao WebSocket da Evolution API');
        });

        socket.on('disconnect', () => {
            console.log('Desconectado do WebSocket da Evolution API');
        });

        socket.on('error', (error) => {
            console.error('Erro na conexão WebSocket:', error);
        });
    }
        catch (err) {
            console.error("WebSocket connection error:", err); 
            
        }
    </script>    

</body>
</html>
