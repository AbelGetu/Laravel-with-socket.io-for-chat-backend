<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    <body id="app">
       
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.5.4/socket.io.min.js" integrity="sha512-HTENHrkQ/P0NGDFd5nk6ibVtCkcM7jhr2c7GyvXp5O+4X6O5cQO9AhqFzM+MdeBivsX7Hoys2J7pp2wdgMpCvw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            console.log('hello');
            const socket = io.connect('http://localhost:4000', () => {
                console.log('connected from client side');
            });

            socket.on('test-channel:UserSignedUp', (data) => {
                console.log('data', data)
                // console.log(data);
            });
        </script>
       
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.16/vue.min.js"></script> --}}

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.3.7/socket.io.min.js"></script> --}}

        {{-- <script>
             const socket = io.connect('http://localhost:3000', () => {
                console.log('connected from client side');
            });

            new Vue({
                el: 'body',
                data: {
                    users: []
                },
                ready: function() {
                    socket.on('test-channel:UserSignedUp', function(data) {
                        this.users.push(data.username);
                    }.bind(this));
                }
            })
        </script> --}}
    </body>
</html>
