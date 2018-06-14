var socket 		= require ('socket.io'),
		express 	=	require('express'),
		https 		= require('https'),
		http 			= require('http'),
		logger 		= require('winston'),
		fs 				= require('fs')

var privateKey  = fs.readFileSync('my_key.key', 'utf8');
var certificate = fs.readFileSync('my_cert.crt', 'utf8');
var credentials = {key: privateKey, cert: certificate};

logger.remove(logger.transports.Console);
logger.add(logger.transports.Console,{
	colorize: true,
	timestamp: true
});
logger.info('SocketIO > listening on port');


var app = express();

var http_server= http.createServer(app).listen(3001);

//HTTPS
var https_server = https.createServer(credentials,app).listen(3000);

function emitNewOrder(server){
	var io = socket.listen(server);
	// console.log(server);

	//First listen to a connection and run the call back function
	io.sockets.on('connection',function(socket){
		socket.on("new_order",function(data){
			console.log(data);
			io.emit("new_order",data);
		})
	});
}

emitNewOrder(http_server);
// emitNewOrder(https_server);