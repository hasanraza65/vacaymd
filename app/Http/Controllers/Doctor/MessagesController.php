<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Order;
use Auth;

class MessagesController extends Controller
{
    public function sendMessage(Request $request){

        $data = new Message();
        $data->message = $request->message;
        $data->order_id = $request->order_id;
        $data->user_id = Auth::user()->id;
        $data->save();

        //assigning order to doctor 
        $data = Order::find($request->order_id);
        $data->assigned_to = Auth::user()->id;
        $data->update();
        //ending assigning order to doctor

        return response('Message Sent');

    }
    public function getMessages(Request $request){
        $data = Message::where('order_id',$request->order_id)->with('userDetail')->get();
        return response()->json(['m' => $data], 200);

    }
    public function sendNote(Request $request){

        $data = new Message();
        $data->message = $request->message;
        $data->order_id = $request->order_id;
        $data->user_id = Auth::user()->id;
        $data->save();

        return response('Note Sent');

    }

    public function updateMessage(Request $request){

        $data = Message::find($request->message_id);
        $data->message = $request->message;
        $data->update();


        return redirect()->back()->with('success', 'Data updated successfully');
    }

    public function destroy($id){

        $data = Message::find($id)->delete();

        return response('Deleted');
    }

}
