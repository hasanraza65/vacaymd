<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Auth;

class MessagesController extends Controller
{
    public function sendMessage(Request $request){

        $data = new Message();
        $data->message = $request->message;
        $data->order_id = $request->order_id;
        $data->user_id = Auth::user()->id;
        $data->save();

        return response('Message Sent');

    }
}
