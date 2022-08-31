var socket  = require( 'socket.io' );
var express = require( 'express' );
var fs      = require( 'fs' );
var app     = express();
var path    = require( 'path' );

var opt = false;
// var base_url = 'http://demo.desnet.id/bolita/webservices/index.php/';

if(opt){
    var privateKey  = fs.readFileSync(path.join(__dirname, '../../../../../..','ssl-le', 'privkey.pem')).toString();
    var certificate = fs.readFileSync(path.join(__dirname, '../../../../../..','ssl-le', 'cert.pem')).toString();
}else{
    var privateKey  = '';
    var certificate = '';
}

var optServ = {
                key   : privateKey,
                cert  : certificate,
            };

/* CONNECT TO HTTP */
var http    = require('http');
var http_p  = 2051;
var http_server  = http.createServer(app);
http_server.listen(http_p, function(){
    console.log('Http server listening at port %d', http_p);
});

/* CONNECT TO HTTPS */
var https   = require('https');
var https_p = 2052;
var https_server = https.createServer(optServ, app);

https_server.listen(https_p, function(){
    console.log('Https server listening at port %d', https_p);
});

// app.get('/status', (req, res) => res.send('Connected'));

if(opt){
    emitNewOrder(https_server);
}else{
    emitNewOrder(http_server);
}

var clients = {};
var rooms = [];

function emitNewOrder(server){
    var io = socket.listen( server );

    io.sockets.on('connection', function (socket) {

        socket.on( 'connect_users', function( data ) {
            let usr_raw = data.id_karyawan;
            // let usr     = usr_raw;
            var usr = usr_raw.toString();
            clients[usr] = { "socket"  : socket.id };
            // console.log(clients);
            // var room = data.room;
            socket.join(usr);
            // console.log(data);

            // io.sockets.emit("look-online", {data : clients}); // untuk melihat user yang online
        });

        socket.on('refresh-token', function(data){
            if(data.refresh === true)
            {
                if(typeof clients[data.id_karyawan] !== 'undefined') { 
                    io.sockets.in(data.id_karyawan).emit('req_token', data);
                    // io.sockets.connected[clients[data.id_karyawan].socket].emit('req_token', data);
                }
            }
            // console.log(data);
        });

        socket.on('send-notif', function (data){
            if(typeof clients[data.id_karyawan] !== 'undefined') { 
                io.sockets.in(data.id_karyawan).emit('receive_notif', data);           
                // io.sockets.connected[clients[data.id_karyawan].socket].emit('receive_notif', data);
            }
        });

        socket.on('broadcast_visitor_statistic', function(data){
            var room = data.room;
            console.log(data);
            io.sockets.in(room).emit('receive_visitor_statistic', data);
        });

        //BROADCAST TO ALL
        socket.on('test-broadcast', function(data){
            var room = data.room;
            var list = {'clients_list' : clients};
            io.sockets.in(room).emit('broadcast', list);
        });

        socket.on('notif', function(data){
            console.log("Sending: " + data.content + " to " + data.nama + " level " + data.level);
            var room = 1;
            io.sockets.in(room).emit("notify", {nama: data.nama, content: data.content, url: data.url});
        });

        // HANDLE CHAT
        socket.on('bc-new-chat', function(data){
            if(data.status == 1){
                io.sockets.emit('post-chat', {status : data.status, id : data.id, data: data.data});
            }
        });
        // HANDLE CHAT

        socket.on('disconnect_users', function(data) {
        
            var room = data.room;
            socket.leave(room);

            delete clients[data.user];

        // io.sockets.emit("look-online", {data : clients});
        });


        // socket.on('kirim-email', function(data){
        //   console.log(data);
        //   http.get(base_url+"mailservice/send_mail", (resp) => {
        //     }).on("error", (err) => {
        //       console.log("Error: " + err.message);
        //   });
        // });
    });

  // setInterval(() => {
  //       console.log('hai');
  //       // io.emit('message', variable);
  // }, 1000);
}
