
var mysql = require("mysql");
var app = require("express")();
var http = require('http').Server(app);
var io = require('socket.io')(http);
connections = [];

var connection = mysql.createConnection({
    host: 'localhost',
    user:'root',
    password:'',
    database:'ciblog'
});

app.get("/",function(req,res){
    res.sendFile(__dirname + '/application/views/products/admin_view2.php');
});

http.listen(process.env.PORT || 3000);
console.log('Server running!!');

io.sockets.on('connection', function(socket){
    connections.push(socket);
    console.log('Connected: %s users connected', connections.length);

    //DC
socket.on('disconnect', function(data){
connections.splice(connections.indexOf(socket), 1 );
console.log('DISCONNECTED: %s users connected', connections.length);
    });
//pag send ng message

socket.on('add_product', function(data){
    console.log(data);
     io.sockets.emit('new_product', {data: data});
});

// socket.on('add productname', function(data){
//         console.log('[NAME] ', data);
//         io.sockets.emit('new product', {prodname: data});
//     });
// socket.on('add price', function(data){
//         console.log(data);
//         io.sockets.emit('new price', {price: data});
//     });
// socket.on('add quantity', function(data){
//         console.log(data);
//         io.sockets.emit('new quantity', {quantity: data});
//     });
// socket.on('add category', function(data){
//         console.log(data);
//         io.sockets.emit('new category', {category: data});
//     });
// socket.on('add photo', function(data){
//         console.log(data);
//         io.sockets.emit('new photo', {photo: data});
//     });
// socket.on('add description', function(data){
//         console.log(data);
//         io.sockets.emit('new description', {description: data});
//     });

    function updateUsernames(){
        io.sockets.emit('get users', username);
    }
});

var add_status = function (products,callback) {
    connection.getConnection(function(err,connection){
        if (err) {
          callback(false);
          return;
        }
    connection.query("INSERT INTO `products` (`product_name`, `price`, `quantity`, `category_id`, `product_image`, `user_id`, `descriptions`) VALUES ('"+products+"')",function(err,rows){
            connection.release();
            if(!err) {
              callback(true);
            }
        });
     connection.on('error', function(err) {
              callback(false);
              return;
        });
    });
}
// http.listen(3000,function(){
//     console.log("Connected in Port 3000");
// });