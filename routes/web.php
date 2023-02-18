<?php

use App\Events\UserSignedUp;
use Illuminate\Http\Request;
use App\Events\MessageResponse;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {

    // Redis::set('name', 'Abel Getu');

    // return Redis::get('name');
    // Publish events with Redis
    // $data = [
    //     'event' => 'UserSignedUp',
        // $data =  collect(
        //     'name' 'JohnDoe',
        //     'email' = 'johndoe@gmail.com'
        // );
    // ];

    // $name = $request->query('name', 'Abel');
    // $email = $request->query('email', 'default@gmail.com');

    // event(new UserSignedUp($name, $email));

    $user = 'Abel Getu';
    $message = 'Hello everyone';

    event(new MessageResponse($message, $user));

    // Redis::publish('test-channel', json_encode($data));
    return 'Done';
    

    // $prefix = config('database.redis.options.prefix');
    // $channel = $prefix . 'test-channel';

    // return "Done. (published on $channel)";

    // $prefix = config('database.redis.options.prefix');
    // $channel = $prefix . 'test-channel';
    
    // return "Done. (published on $channel)";
    return view('welcome');
});
