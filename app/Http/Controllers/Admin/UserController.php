<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use SendGrid\Mail\Mail;
use Swift_TransportException;
use Illuminate\Support\Facades\View;
use App\Services\TwilioService;

class UserController extends Controller
{
    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }
    
    public function index(){

        $data = User::where('user_role','!=',4)
        ->where('user_role','!=',3)
        ->get();

        return view('admin.users.index',compact(['data']));

    }
    public static function dashboard(){

        $data['patients'] = User::where('user_role',4)->count();
        $data['doctors'] = Doctor::count();
        $data['orders'] = Order::whereNotNull('user_id')->whereHas('userDetail')->count();
        $data['orders_completed'] = Order::whereNotNull('user_id')->whereHas('userDetail', function ($query) {
            $query->whereNotNull('stripe_token');
        })->where('order_status','Completed')->count();
        $data['orders_dispensed'] = Order::whereNotNull('user_id')->whereHas('userDetail', function ($query) {
            $query->whereNotNull('stripe_token');
        })->where('order_status','Dispensed')->count();
        $data['orders_cancelled'] = Order::whereNotNull('user_id')->whereHas('userDetail', function ($query) {
            $query->whereNotNull('stripe_token');
        })->where('order_status','Cancelled')->count();
        $data['orders_open'] = Order::whereNull('assigned_to')->whereNotNull('user_id')->whereHas('userDetail', function ($query) {
            $query->whereNotNull('stripe_token');
        })->whereNot('order_status','Rejected')->count();
        return $data;
    }

    public function create(){

        return view('admin.users.create');

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
    
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->gender = $data['gender'];
        $user->password = Hash::make($data['password']);
        $user->phone = $request->phone;
        $user->user_role = $request->user_role;
        $user->save();
        $this->sendEmail($user->id);
        if($request->user_role == 2){

            $doctor = new Doctor();
            $doctor->user_id = $user->id;
            $doctor->save();

        }
        
        return redirect('/admin/users')->with('success', 'User created successfully');
        //return redirect()->back()->with('success', 'User created successfully');

    }

    public function edit($id){

        $data = User::find($id);
        return view('admin.users.edit',compact(['data']));
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
        $old_password=$user->password;
        
        if (!empty($request->password)) {
            $new_password = Hash::make($request->password);
            $request->merge(['password'=> $new_password]);
        }else{
           
            $request->merge(['password'=> $old_password]);
        }
        $data = $request->all();
        $user->fill($data);
        $user->save();
        return redirect('/admin/users')->with('success', 'User updated successfully');
        //return redirect()->back()->with('success', 'User updated successfully');

    }

    public function destroy($id){

        $data = User::find($id)->delete();

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
