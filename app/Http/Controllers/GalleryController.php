<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    // GalleryController.php
public function index()
{
    $images = GalleryImage::all();
    return view('gallery.index', compact('images'));
}
public static function getImages()
{
    $images = GalleryImage::all();
    return $images;
}

public function store(Request $request)
{
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

    

    return redirect()->back();
}


public function select(Request $request)
{
    $selectedImage = GalleryImage::find($request->input('image_id'));
    // Use the selected image
}

}
