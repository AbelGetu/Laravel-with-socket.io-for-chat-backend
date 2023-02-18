const app = require('express')();
const server = require('http').createServer(app);
require('dotenv').config();

const redisPort = process.env.REDIS_PORT;
const redisHost = process.env.REDIS_HOST;

const io = require('socket.io')(server, {
    cors: { origin: '*', methods: ['GET', 'POST'] }
});
const Redis = require('ioredis');
const redis = new Redis(redisPort, redisHost);

redis.subscribe('test-channel', () => {
    console.log('subscribed to: test-channel');
});

redis.subscribe('message-channel', () => {
    console.log('subscribed to: message-channel');
})

let users = [];

redis.on('message', (channel, message) => {
    message  = JSON.parse(message);
    if(channel == 'UserSignedUp') {
        // users.push(message.data.username);
        users.push(message.data);
        io.emit(channel + ':' + message.event, users);
        // console.log(users);
        // console.log(channel + ':' + message.event, users);
    } else if(channel == 'message-channel') {        
        io.emit(channel + ':' + message.event, message.data);
        console.log(channel + ':' + message.event, message.data);
    }    
})



io.on('connection', (socket) => {
    console.log(`⚡: ${socket.id} user just connected!`);


    //sends the message to all the users on the server
    // socket.on('message', (data) => {
    //     io.emit('message-channel:App\\Events\\MessageResponse', data);
    // });

    // //Listens when a new user joins the server
    // socket.on('newUser', (data) => {
    //     //Adds the new user to the list of users
    //     users.push(data);
    //     // console.log(users);
    //     //Sends the list of users to the client
    //     socket.emit('newUserResponse', users);
    // });

    socket.on('disconnect', () => {
      console.log('🔥: A user disconnected');
      //Updates the list of users when a user disconnects from the server
        // users = users.filter((user) => user.socketID !== socket.id);
        // // console.log(users);
        // //Sends the list of users to the client
        // socket.emit('newUserResponse', users);
        // socket.disconnect();
    });
});



const broadcastPort = 4000;
server.listen(broadcastPort, () => {
    console.log("Listening on port:" + broadcastPort);
});

app.get('/', (req, res)=> {
    return res.json("john");
})