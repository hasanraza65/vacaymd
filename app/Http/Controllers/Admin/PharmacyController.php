<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use App\Models\User;
use App\Models\State;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){

        $data = Pharmacy::with('userDetail','state')->get();
        return view('admin.pharmacies.index',compact(['data']));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $users = User::where('user_role',3)->get();
        $states = State::all();
     
        return view('admin.pharmacies.create',compact(['users','states']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8', // Minimum 6 characters
                'regex:/[a-z]/', // At least one lowercase letter
                'regex:/[A-Z]/', // At least one uppercase letter
                'regex:/[0-9]/', // At least one number
                'regex:/[@$!%*#?&]/', // At least one special character
            ],
           
        ]);
    
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->phone = $request->pharmacy_phone;
        $user->user_role =3;
        $user->save();
        $this->sendEmail($user->id);
        
        $data = new Pharmacy();
        $data->create($request->except('name','email','password')+['manager_id' => $user->id]);
       
        return redirect('/admin/pharmacies')->with('success', 'Pharmacy created successfully');
        // return redirect()->back()->with('success', 'Pharmacy created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pharmacy $pharmacy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Pharmacy::find($id);
        $states = State::all();
        $users = User::where('user_role',3)->get();

        return view('admin.pharmacies.edit',compact(['data','users','states']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        if(isset($request->password)){

            $request->validate([
                'password' => [
                    'required',
                    'string',
                    'min:8', // Minimum 6 characters
                    'regex:/[a-z]/', // At least one lowercase letter
                    'regex:/[A-Z]/', // At least one uppercase letter
                    'regex:/[0-9]/', // At least one number
                    'regex:/[@$!%*#?&]/', // At least one special character
                ],
            ]);
        }
        

        //check unique email

        $checkmail = User::where('email',$request->p_email)
        ->whereNot('id',$request->manager_id)
        ->first();

        if($checkmail){
            return redirect()->back()->withErrors(['email' => 'Error: Email already exists']);
        }

        //ending check unique email

        $pharmacy = Pharmacy::find($id);

        $pharmacy->fill($request->except(['p_name','p_email','password']));
        $pharmacy->save();

        //pharmacy manager
        $user = User::find($request->manager_id);

        $user->email = $request->p_email;
        $user->name = $request->p_name;

        if(isset($request->password)){
        $user->password = Hash::make($request->password);
        }
        $user->update();

        //ending manager

        return redirect('/admin/pharmacies')->with('success', 'Pharmacy updated successfully');
        //return redirect()->back()->with('success', 'Pharmacy updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pharmacy = Pharmacy::find($id);
        $user_id=$pharmacy->manager_id;
        $user = User::find($user_id);
        if($user){
            $user = User::where('id',$user_id)->delete();
        }
        $data = Pharmacy::where('id',$id)->delete();
     

        return response('Deleted');
    }
}
