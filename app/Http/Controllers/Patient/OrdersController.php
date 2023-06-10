<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderDetail;
use App\Models\OrderAmounts;
use App\Models\OrderAddon;
use App\Models\PatientNote;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stripe\Stripe;
use Illuminate\Support\Facades\View;
//use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Session;
use DB;
use Auth;
use App\Services\TwilioService;
use App\Mail\NewOrderMail;
//use Illuminate\Support\Facades\Mail;
use App\Models\Message;
use SendGrid\Mail\Mail;
use Illuminate\Support\Facades\Mail as MailFacade;
use App\Models\User;
use App\Models\Prescription;
use App\Models\Pharmacy;
use Stripe\Charge;
use Swift_TransportException;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }


    public function index()
    {
        $data = Order::where('user_id',Auth::user()->id)
        ->whereNotNull('user_id')
        ->get();

        return view('patient.orders.index',compact(['data']));
    }
    public static function dashboard(){
        $data['orders'] = Order::where('user_id',Auth::user()->id)->count();
        return $data;
    }
    public function allTransactions(){
        $data = Payment::with(['userDetail','orderDetail'])->where('user_id',Auth::user()->id)->get();

        return view('patient.transactions.index',compact(['data']));

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function invoiceView(Request $request)
    {
        $data = Payment::with(['userDetail','orderDetail'])->where('order_id', $request->id)->first();
        $orderaddons = OrderAddon::with('itemDetail')->where('order_id',$request->id)->get();
        
        return view('patient.orders.invoice',compact(['data','orderaddons']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $data = new Order();
        $data->session_id = Session::getId();
        $order_num = $this->generateUniqueOrderNum();
        $data->order_num = $order_num;
        $data->treatment_req = $request->problem_type;
        $data->total_amount =79;
        $data->save();

        $orderid = $data->id;

        //saving order details

        // Get all the request data
        $data = $request->except(['problem_type','I_agree']);

        // Loop through the request data and insert each key-value pair into the meta table
        foreach ($data as $key => $value) {
            // Skip the CSRF token
            if ($key === '_token') {
                continue;
            }
            $newKey = str_replace("_", ' ', $key);

            if(is_array($value)){
                $output = '<ul>';
                foreach($value as $v){

                    $output .= '<li>' . $v. '</li>';

                }
                   
                $output . '</ul>';
               
               $meta = new OrderDetail([
                'key' => $newKey,
                'value' => $output,
                'order_id' => $orderid
               ]);
            }else{
                $meta = new OrderDetail([
                    'key' => $newKey,
                    'value' => $value,
                    'order_id' => $orderid
                ]);

            }
            

            $meta->save();
        }

        //ending saving order details

        //storing some data to session
        Session::put('order_num', $order_num);
        //ending session store

        //return redirect()->back()->with('success', 'Order created successfully');
        // return view('landing.register');
        return redirect()->to('/register');
    }
    public function reOrder(Request $request)
    {
        
        $old_order_id=$request->order_id;
        $old_order=Order::find($old_order_id);
        $data = new Order();
        $data->session_id = Session::getId();
        $order_num = $this->generateUniqueOrderNum();
        $data->order_num = $order_num;
        $data->user_id = $old_order->user_id;
        $data->total_amount = $old_order->total_amount;
        $data->treatment_req = $old_order->treatment_req;
        $data->passport_pic = $old_order->passport_pic;
        $data->delivery_location = $old_order->delivery_location;
        $data->billing_address = $old_order->billing_address;
        $data->agree_to_text = $old_order->agree_to_text;
        $data->state = $old_order->state;
        $data->nevada_arrival_date = $old_order->nevada_arrival_date;
        $data->reached_nevada = $old_order->reached_nevada;
        $data->home_state = $old_order->home_state;
        $data->home_city = $old_order->home_city;
        $data->hotel_city = $old_order->hotel_city;
        $data->our_pharmacy_text = $old_order->our_pharmacy_text;
        $data->confirm_patient_id = $old_order->confirm_patient_id;
        $data->save();
        
         ////////////  Order Details 
         $old_details=OrderDetail::where('order_id',$old_order_id)->get();
         if($old_details){
            foreach($old_details as $d){
                $new_details = new OrderDetail();
                $new_details->order_id = $data->id;
                $new_details->key = $d->key;
                $new_details->value = $d->value;
                $new_details->save();

            }

         }
        return redirect()->to('/patient/orders')->with('success', 'ReOrdered successfully');; 
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Order::with('orderDetail')
        ->with('userDetail')
        ->where('user_id',Auth::user()->id)
        ->whereNotNull('user_id')
        ->find($id);
        
        $messages = Message::with('userDetail')
        ->where('order_id',$id)->get();
        $notes = PatientNote::with('userDetail')
        ->where('order_id',$id)
        ->whereHas('userDetail')
        ->get();

        return view('patient.orders.show',compact(['data','messages','notes']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    function generateRandomOrderNum($length = 8)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    function generateUniqueOrderNum($length = 8)
    {
        do {
            $order_num = $this->generateRandomOrderNum($length);
        } while ($this->orderNumExists($order_num));

        return $order_num;
    }

    function orderNumExists($order_num)
    {
        return DB::table('orders')->where('order_num', $order_num)->exists();
    }
    

    public function updateLocationStatus(Request $request){

        $data = Order::find($request->order_id);
        $data->reached_nevada = 1;
        $data->state = $request->state;
        $data->update();
        $this->sendEmailUpdatelocPharmacy($request->order_id);
        $this->sendEmailUpdatelocToDoctor($request->order_id);
        //$this->sendEmailUpdatelocToMe($request->order_id);
        return redirect()->back()->with('success', 'Data updated successfully');
    }
    public function sendEmailUpdatelocPharmacy($orderid){
        //getting order data
        $orderData = Order::with(['userDetail','pharmacyDetail','pharmacyDetail.userDetail'])
        ->find($orderid);
        // $to = $orderData['userDetail']['email'];
        $to =$orderData->pharmacyDetail->userDetail->email;
        $to_name =$orderData->pharmacyDetail->userDetail->name;
        //ending getting order data
        $email = new Mail();
        $from_email=env('MAIL_FROM_ADDRESS');
        $email->setFrom($from_email, "Vacay MD");
        $email->setSubject("Patient Reached Nevada");
        $email->addTo($to, $to_name);
        $htmlContent = View::make('emails.updated_location')
        ->with(['orderData' => $orderData])
        ->render();

        $sms_message = "Patient of order #".$orderData->order_num.' has been reached Nevada';
        if($orderData->pharmacyDetail->pharmacy_phone != null && $orderData->pharmacyDetail->pharmacy_phone != ""){
            $this->sendSMS($orderData->pharmacyDetail->pharmacy_phone, $sms_message);
            }
        
        $email->addContent("text/html", $htmlContent);
        
        $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
        
        $response = $sendgrid->send($email);
        
    }
    public function sendEmailUpdatelocToDoctor($orderid){
        //getting order data
        $orderData = Order::with(['userDetail','doctorDetail'])
        ->find($orderid);
        // $to = $orderData['userDetail']['email'];
        $to =$orderData->doctorDetail->email;
        $to_name =$orderData->doctorDetail->name;
        //ending getting order data
        $email = new Mail();
        $from_email=env('MAIL_FROM_ADDRESS');
        $email->setFrom($from_email, "Vacay MD");
        $email->setSubject("Patient Reached Nevada");
        $email->addTo($to, $to_name);
        $htmlContent = View::make('emails.updated_location')
        ->with(['orderData' => $orderData])
        ->render();

        $sms_message = "Patient of order #".$orderData->order_num.' has been reached Nevada';
        if($orderData->doctorDetail->phone != null && $orderData->doctorDetail->phone != ""){
            $this->sendSMS($orderData->doctorDetail->phone, $sms_message);
            }
        
        $email->addContent("text/html", $htmlContent);
        
        $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
        
        $response = $sendgrid->send($email);
        
    }
    public function sendEmailUpdatelocToMe($orderid){
        //getting order data
        $orderData = Order::with(['userDetail','pharmacyDetail.userDetail'])
        ->find($orderid);
        // $to = $orderData['userDetail']['email'];
        $to =$orderData->userDetail->email;
        $to_name =$orderData->userDetail->name;
        //ending getting order data
        $email = new Mail();
        $email->setFrom("notification@skvclients.com", "Vacay MD");
        $email->setSubject("Reached Nevada");
        $email->addTo($to, $to_name);
        $htmlContent = View::make('emails.updated_location_my')
        ->with(['orderData' => $orderData])
        ->render();
        
        $email->addContent("text/html", $htmlContent);
        
        $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
        
        $response = $sendgrid->send($email);
        
    }
    public function sendSMS($phone_num = null, $message = null){

        $this->twilioService->sendSMS($phone_num, $message);

    }


    public function register(){

        return view('landing.register');

    }
    
}
