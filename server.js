/*var http = require('http');

httpServer = http.createServer(function(req, res){
	res.end('Bonjour !');
	console.log('Un utilisateur s\'est connecté !');
});

httpServer.listen(1337);

var io = require('socket.io').listen(httpServer);*/


console.log('Salut !');
// const io = require("socket.io")();






const express = require('express');
const app = express();
const http = require('http');
const server = http.createServer(app);
const { Server } = require("socket.io");
const io = new Server(server);

app.get('https://localhost/una_sotra/public/clientBienvenue', (req, res) => {  
	console.log('Un utilisateur s\'est connecté !');
});

io.on('connection', (socket) => {  
	console.log('a user connected');
});

server.listen(8000, () => {  
	console.log('listening on *:8000');
});













































/*

const express = require('express');

const app = express();


const server = require('http').createServer(app);


const io = require('socket.io')(server, {
    cors: { origin: "*"}
});


io.on('connection', (socket) => {
    console.log('connection');

    socket.on('sendChatToServer', (message) => {
        console.log(message);

        // io.sockets.emit('sendChatToClient', message);
        socket.broadcast.emit('sendChatToClient', message);
    });


    socket.on('disconnect', (socket) => {
        console.log('Disconnect');
    });
});

server.listen(3000, () => {
    console.log('Server is running');
});*/