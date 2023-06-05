<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryImage;
use App\Models\PatientNote;
use App\Models\Order;
use Auth;

class PatientNotesController extends Controller
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
    public function sendNote(Request $request){


    $filename='';
    $filepath='';
    if ($_FILES['file']['name']) {
        if (!$_FILES['file']['error']) {
            $image = $request->file('file');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('src/assets/uploads/Gallery/'), $imageName);
            $imagePath = '/src/assets/uploads/Gallery/' . $imageName;
    
            $filepath=$imagePath;
            $filename=$imageName;
            
            $galleryImage = new GalleryImage();
            $galleryImage->filename = $filename;
            $galleryImage->filepath = $filepath;
            $galleryImage->user_id = Auth::user()->id;
            $galleryImage->save();
            
        } else {
            
            return response()->json(['message' => 'Error uploading profile picture. Please try again later.'], 400);
        }
    }

        $data = new PatientNote();
        $data->message = $request->message;
        $data->attachment = $request->attachment;
        $data->filepath = $filepath;
        $data->order_id = $request->order_id;
        $data->user_id = $request->user_id;
        $data->doctor_id = Auth::user()->id;
        $data->save();

        return redirect()->back()->with('success', 'Note Sent successfully');

    }

    public function updateMessage(Request $request){

        $data = PatientNote::find($request->id);
        $data->message = $request->message;
        $data->update();


        return redirect()->back()->with('success', 'Data updated successfully');
    }

    public function destroy($id){

        $data = PatientNote::find($id)->delete();

        return response('Deleted');
    }

}
