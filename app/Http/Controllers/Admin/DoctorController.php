<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use SendGrid\Mail\Mail;
use Swift_TransportException;
use Illuminate\Support\Facades\View;
use App\Services\TwilioService;

class DoctorController extends Controller
{
    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }
    public function index(){

        $data = Doctor::with('userDetail')
        ->whereHas('userDetail')
        ->get();
        
        return view('admin.doctors.index',compact(['data']));

    }

    public function create(){

        return view('admin.doctors.create');

    }

    public function store(Request $request){

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
            'gender' => 'string',
        ]);

        if ($_FILES['file']['name']) {
            if (!$_FILES['file']['error']) {
                
                $image = $request->file('file');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('src/assets/uploads/Profile/'), $imageName);
                $imagePath = '/src/assets/uploads/Profile/' . $imageName;
                $profilepic = $imagePath;
                
            } else {
                $profilepic = null;
                return response()->json(['message' => 'Error uploading profile picture. Please try again later.'], 400);
            }
        }
    
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->gender = $data['gender'];
        $user->phone =$request->phone;
        $user->user_role =2;
        $user->profile_pic = $profilepic;
        $user->password = Hash::make($data['password']);
        $user->save();

        $doctor = new Doctor();
        $doctor->specialization = $request->specialization;
        $doctor->experience = $request->experience;
        $doctor->available_from = $request->available_from;
        $doctor->available_to = $request->available_to;
        $doctor->user_id = $user->id;
        $doctor->save();
        $this->sendEmail($user->id);
        return redirect('/admin/doctors')->with('success', 'Doctor created successfully');

        //return redirect()->back()->with('success', 'Doctor created successfully');

    }

    public function edit($id){

        $data = Doctor::with('userDetail')
                ->find($id);
        
        return view('admin.doctors.edit',compact(['data']));

    }

    public function update(Request $request, $id){

        //check if email available
        $check_email = User::where('email',$request->email)
        ->whereNot('id',$request->user_id)
        ->first();

        if($check_email){

            return redirect()->back()->withErrors(['email' => 'Email already exists']);

        }
        //ending check if email available


        $user = User::find($request->user_id);
        
      
        if (!empty($request->password)) {
            $new_password = Hash::make($request->password);
            $request->merge([
                'password' =>  $new_password,
            ]);
        }else{
            $old_pass=$user->password;
            $request->merge([
                'password' =>  $old_pass,
            ]);
        }

        if ($_FILES['file']['name']) {
            if (!$_FILES['file']['error']) {
                $request->validate([
                    'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $imageName = time().'.'.$request->file->extension();  
                $destination = '/src/assets/uploads/Profile/' .  $imageName;
                $request->file->move(public_path('src/assets/uploads/Profile'), $imageName);
                $fullPath = public_path($destination);
                $request->merge(['profile_pic'=> $destination]);
                
            } else {
                $request->merge(['profile_pic'=> '']);
                return response()->json(['message' => 'Error uploading profile picture. Please try again later.'], 400);
            }
        }

        $data = $request->all();
        //dd($request->all());
        $user->update($request->all());
        // $user->fill($data);
        // $user->save();

        $doctor = Doctor::where('id',$id)->first();

        $doctor->specialization = $request->specialization;
        $doctor->experience = $request->experience;
        $doctor->available_from = $request->available_from;
        $doctor->available_to = $request->available_to;
        $doctor_data = $doctor->update();
        return redirect('/admin/doctors')->with('success', 'User updated successfully');
        // return redirect()->back()->with('success', 'User updated successfully');

    }
    public function destroy($id){

        $doctor = Doctor::where('id',$id)->first();
        $data = User::find($doctor->user_id)->delete();
        $data = Doctor::where('id',$id)->delete();
       

        return response('Deleted');
    }

    public function sendEmail($userid){

        //get admin email
        $user = User::find($userid);
        //ending get admin email

        $to = $user->email;
        $to_name = $user->name;

        $email = new Mail();
        $from_email=env('MAIL_FROM_ADDRESS');
        $email->setFrom($from_email, "Vacay MD");

        $email->setSubject("New Account Created");
        $sms_message='Your new account has been created.';

        if($user->phone != null && $user->phone != ""){
        $this->sendSMS($user->phone, $sms_message);
        }

        $email->addTo($to, $to_name);

        $htmlContent = View::make('emails.new_account')->with(['userData' => $user])->render();

        $email->addContent("text/html", $htmlContent);
        
        $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
        
        $response = $sendgrid->send($email);

    }

    public function sendSMS($phone_num = null, $message = null){

        $this->twilioService->sendSMS($phone_num, $message);

    }
}
