<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index(){

        $data = User::where('user_role',4)->get();
        
        return view('admin.patients.index',compact(['data']));

    }



    public function edit($id){

        $data = User::find($id);
        return view('admin.patients.edit',compact(['data']));
    }

    public function update(Request $request, $id){

        //check if email available
        $check_email = User::where('email',$request->email)
        ->whereNot('id',$id)
        ->first();

        if($check_email){

            return redirect()->back()->withErrors(['email' => 'Email already exists']);

        }
        //ending check if email available

        

        $user = User::find($id);
        $old_passowrd=$user->password;
        
        if (!empty($data['password'])) {
            $new_password = Hash::make($data['password']);
            $request->merge(['password'=> $new_password]);
        }else{
           
            $request->merge(['password'=> $old_passowrd]);
        }
        $data = $request->all();
        $user->fill($data);
        $user->save();
        return redirect('/admin/patients')->with('success', 'User updated successfully');
        // return redirect()->back()->with('success', 'User updated successfully');

    }

    public function destroy($id){

        $data = User::find($id)->delete();

        return response('Deleted');
    }
}
