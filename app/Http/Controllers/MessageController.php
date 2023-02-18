<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\MessageResponse;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        return Message::latest();
    }

    public function store(Request $request)
    {
        $message = new Message;
        $message->user_id = auth()->id();
        $message->message = $request->input('message');
        $message->save();

        // fire message event
        event(new MessageResponse($request->input('message'), auth()->user()->name));
        return $message;
    }
}
