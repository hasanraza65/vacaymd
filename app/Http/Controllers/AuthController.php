<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Passport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use App\Services\TwilioService;
use App\Mail\NewOrderMail;
//use Illuminate\Support\Facades\Mail;
use SendGrid\Mail\Mail;
use Illuminate\Support\Facades\Mail as MailFacade;
use Swift_TransportException;
use Illuminate\Support\Facades\View;

class AuthController extends Controller
{
    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }
    public function showRegisterForm()
    {
        return view('landing.register');
    }

    public function register(Request $request)
    {
        // Add your validation rules here
       
           
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'confirmed',
                'string',
                'min:8', // Minimum 6 characters
                'regex:/[a-z]/', // At least one lowercase letter
                'regex:/[A-Z]/', // At least one uppercase letter
                'regex:/[0-9]/', // At least one number
                'regex:/[@$!%*#?&]/', // At least one special character
            ],
        ]);

        //uploading user passport
        
        //ending upload user passport

        // Create the user
        $fullname = $request->name.' '.$request->name_last;

        $user = User::create([
            'name' => $fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dob' => $request->dob,
            'phone' => $request->phone,
            'gender' => $request->gender
            
        ]);

        

        // Log the user in
        Auth::login($user);

        //storing values to order table

        $order_num = Session::get('order_num');
        $images = $request->file('files');
         if ($request->hasFile('files')) :
                 foreach ($images as $item):
                $imageName = time() . '_' . $item->getClientOriginalName();
                $item->move(public_path('src/assets/uploads/Profile/'), $imageName);
                $imagePath = '/src/assets/uploads/Profile/' . $imageName;
                     $pass = Passport::create([
                        'user_id' => $user->id,
                       
                        'passport_pic' =>$imagePath
                    ]);
                 endforeach;
                
         endif; 

        if(isset($order_num)){

        $order = Order::where('order_num',$order_num)->first();
        $order->billing_address = $request->billing_address;
        $order->home_state = $request->home_state;
        $order->home_city = $request->home_city;
        $order->hotel_city = $request->hotel_city;
        $order->delivery_location = $request->hotel_name;
        $order->state = $request->state;
        $order->user_id = Auth::user()->id;
  
        $order->nevada_arrival_date = $request->nevada_arrival_date;
        $order->our_pharmacy_text = $request->our_pharmacy_text;
        $order->update();
         
        //sending mail
        $this->sendEmail($order->id);
        //ending sending mail

        //sending sms
        if($request->phone){
            $this->sendSMS($request->phone, 'Your Order has been placed');
        }
       
        //ending sending sms

            if(Auth::user()->user_role == 1){
                $dashboard = "admin";
            }elseif(Auth::user()->user_role == 2){
                $dashboard = "doctor";
            }elseif(Auth::user()->user_role == 3){
                $dashboard = "pharmacy_manager";
            }else{
                $dashboard = "admin";
            }

            Session::forget('order_num');

            return redirect()->to('/patient/make-payment/'.$order->id);
        
        }

        //ending storing values to order table

        return redirect()->intended(url('/'));
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Add your validation rules here
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

         // Check if the user exists
        $user = User::where('email', $request->email)->first();

        // If user exists and has more than 2 failed login attempts, block the account
        if ($user && $user->login_attempts >= 3) {
            throw ValidationException::withMessages([
                'email' => ['Your account is blocked due to too many failed login attempts.'],
            ]);
        }

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            //return redirect()->route('/');
            // Redirect the user to the intended URL or a default page

            // Reset the login attempts on successful login
            $user->update(['login_attempts' => 0]);

            if(Auth::user()->user_role == 1){
                $dashboard = "admin";
            }elseif(Auth::user()->user_role == 2){
                $dashboard = "doctor";
            }elseif(Auth::user()->user_role == 3){
                $dashboard = "pharmacy";
            }else{
                $dashboard = "admin";
            }

            //storing values to order table
            $order_num = Session::get('order_num');

            if(isset($order_num)){

            $order = Order::where('order_num',$order_num)->first();
            $order->billing_address = $request->billing_address;
            $order->home_state = $request->home_state;
            $order->home_city = $request->home_city;
            $order->hotel_city = $request->hotel_city;
            $order->delivery_location = $request->hotel_name;
            $order->state = $request->state;
            $order->user_id = Auth::user()->id;
            $order->nevada_arrival_date = $request->nevada_arrival_date;
            $order->our_pharmacy_text = $request->our_pharmacy_text;
            $order->update();

            Session::forget('order_num');
            $orderid = $order->id;

            return redirect()->to('/patient/make-payment/'.$orderid);

            }

            //ending storing values to order table

            return redirect()->intended(url('/'));
        }

         // If login failed, increment the login_attempts counter
         if ($user) {
            $user->increment('login_attempts');
        }

        // If unsuccessful, redirect back with an error message
        return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function sendEmail($orderid){

        //getting order data

        $orderData = Order::with('userDetail')
        ->find($orderid);
        
        $to = $orderData['userDetail']['email'];
        $to_name = $orderData['userDetail']['name'];

        //ending getting order data
        
        $email = new Mail();
        $from_email=env('MAIL_FROM_ADDRESS');
        $email->setFrom($from_email, "Vacay MD");
        $email->setSubject("New Order");
        $email->addTo($to, $to_name);
        
        $htmlContent = View::make('emails.new_order')
        ->with(['orderData' => $orderData])
        ->render();
        
        $email->addContent("text/html", $htmlContent);
        
        $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
        
        $response = $sendgrid->send($email);
        
        /*

        $to = $orderData['userDetail']['email'];

        Mail::to($to)->send(new NewOrderMail($orderData)); */

        //return back()->with('success', 'Email sent successfully');

    }

    public function sendSMS($phone_num = null, $message = null){

        $this->twilioService->sendSMS($phone_num, $message);

        echo "done";

    }

    public function checkEmail(Request $request){

        $email = $request->email;
        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json(['error' => 'Email already exists.']);
        }

        return response()->json(['success' => 'Email is available.']);

    }
    public static function getUserRole($id){
        $user = User::where('id', $id)->first();
        return $user;

    }

    public function updateProfilePic(Request $request){

        $user = User::find(Auth::user()->id);

        if ($_FILES['file']['name']) {
            if (!$_FILES['file']['error']) {
               
                $image = $request->file('file');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('src/assets/uploads/Profile/'), $imageName);
                $imagePath = '/src/assets/uploads/Profile/' . $imageName;

                
            } else {
                $imagePath = '';
                return response()->json(['message' => 'Error uploading profile picture. Please try again later.'], 400);
            }
        }

        $user->profile_pic = $imagePath;
        $user->update();


    }
}

