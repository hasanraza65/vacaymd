<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class ProfileController extends Controller
{
    public function showProfile(){
        
        $user_id = Auth::user()->id;
        
        $data = User::find($user_id);

        return view('patient.profile.edit',compact(['data']));

    }
    public function updateProfile(Request $request){

        //check if email available
        $id=$request->id;
        $check_email = User::where('email',$request->email)
        ->whereNot('id',$id)
        ->first();

        if($check_email){

            return redirect()->back()->withErrors(['email' => 'Email already exists']);

        }

        //ending check if email available
       
        $user = User::find($id);

        if ($_FILES['file']['name']) {
            if (!$_FILES['file']['error']) {
               
                $image = $request->file('file');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('src/assets/uploads/Profile/'), $imageName);
                $imagePath = '/src/assets/uploads/Profile/' . $imageName;
                $request->merge(['profile_pic'=> $imagePath]);

                
            } else {
                $request->merge(['profile_pic'=> '']);
                return response()->json(['message' => 'Error uploading profile picture. Please try again later.'], 400);
            }
        }
        $data = $request->all();
        $user->fill($data);
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');

    }
    public function updatePassword(Request $request)
    {
        // Get the authenticated user
    $user = auth()->user();
    // Check if the old password matches the user's current password
  
    if (!Hash::check($request->old_password, $user->password)) {
       // return redirect()->back()->with('error', 'Old Password is Incorrect');
        return redirect()->back()->withErrors(['Old Password is Incorrect']);
    }
    
    // Update the user's password
    $user->password = Hash::make($request->new_password);
    $user->save();
    return redirect()->back()->with('success', 'Your password has been updated.');
       
       
    }


}
