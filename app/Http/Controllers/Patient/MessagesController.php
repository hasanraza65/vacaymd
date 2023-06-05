<?php

namespace App\Http\Controllers\Patient;

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

        return response()->json(['message_id' => $data->id]);

    }
    public function getMessages(Request $request){
        $data = Message::where('order_id',$request->order_id)->with('userDetail')->get();
        return response()->json(['m' => $data], 200);

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
