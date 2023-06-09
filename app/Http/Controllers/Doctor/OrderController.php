<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDetail;
use App\Models\PatientNote;
use App\Models\Prescription;
use App\Models\Pharmacy;
use App\Models\Payment;
use App\Models\Passport;
use Auth;
use Carbon\Carbon;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Refund;
use App\Services\TwilioService;
use SendGrid\Mail\Mail;
use Illuminate\Support\Facades\Mail as MailFacade;
use Swift_TransportException;
use Illuminate\Support\Facades\View;
use App\Models\Message;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class OrderController extends Controller
{
    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }

    function showemail(){
        $orderData = Order::with('userDetail')
        ->find(2);
        return view('emails.order_approved', compact(['orderData']));
    }
    public function index(){

        $start_date = request('start_date');
        $end_date = request('end_date');
        $today = date('Y-m-d');
    
        if (!empty($start_date)) {
            $start_date = date('Y-m-d', strtotime($start_date));
        }
    
        if (!empty($end_date)) {
            $end_date = date('Y-m-d', strtotime($end_date));
        }
    
        $dataQuery = Order::with('userDetail')
        ->whereNull('assigned_to')
        ->whereNotNull('user_id')
        ->whereNull('pharmacy_id')
        ->whereHas('userDetail', function ($query) {
            $query->whereNotNull('authorized_user_payment_id');
        })
        ->whereHas('userDetail')
        ->whereNot('order_status','Rejected');
    
        $assigned_tomeQuery = Order::with('userDetail')
        ->where('assigned_to', Auth::user()->id)
        ->whereNotNull('user_id')
        ->where('payment_status', 1)
        ->whereHas('userDetail')
        ->whereNot('order_status','Rejected')
        ->whereNot('order_status', 'Completed');
    
        $completedQuery = Order::with('userDetail')
        ->where('order_status', 'Completed')
        ->whereNotNull('user_id')
        ->whereHas('userDetail')
        ->whereNot('order_status','Rejected')
        ->where('payment_status', 1);
    
        if (!empty($start_date)) {
    
            $active_tab = request('active_tab');
    
            if(request('active_tab') == 'latest_orders'){
            $dataQuery->whereDate('created_at', '>=', $start_date);
            }
    
            if(request('active_tab') == 'assigned_orders'){
            $assigned_tomeQuery->whereDate('created_at', '>=', $start_date);
            }
    
            if(request('active_tab') == 'completed_orders'){
            $completedQuery->whereDate('created_at', '>=', $start_date);
            }
        }
    
        if (!empty($end_date)) {
    
            $active_tab = request('active_tab');
    
            if(request('active_tab') == 'latest_orders'){
            $dataQuery->whereDate('created_at', '<=', $end_date);
            }
    
            if(request('active_tab') == 'assigned_orders'){
            $assigned_tomeQuery->whereDate('created_at', '<=', $end_date);
            }
    
            if(request('active_tab') == 'completed_orders'){
            $completedQuery->whereDate('created_at', '<=', $end_date);
            }
        }
    
        $data = $dataQuery->get();
        $assigned_tome = $assigned_tomeQuery->get();
        $completed = $completedQuery->get();
    
        return view('doctor.orders.index', compact(['data', 'assigned_tome', 'completed']));
    }

    public function show($id){

        $data = Order::with('orderDetail')
        ->with('userDetail')
        ->find($id);

        $prescriptions = Prescription::all();
        
        $pharmacies = Pharmacy::all();
        $passports = Passport::where('user_id',$data->user_id)->get();

        $messages = Message::with('userDetail')
        ->where('order_id',$id)
        ->whereHas('userDetail')
        ->get();
        $notes = PatientNote::with('userDetail')
        ->where('order_id',$id)->get();

        return view('doctor.orders.show',compact(['data','prescriptions','pharmacies','messages','notes','passports']));

    }

    public function sendToPharmacy(Request $request){

        $data = Order::find($request->order_id);
        $data->pharmacy_id = $request->pharmacy_id;
        $data->prescription_id = $request->prescription_id;
        $data->assigned_to = Auth::user()->id;
        $data->update();

        $pharmacy = Pharmacy::find($request->pharmacy_id);

        $sms_message = "A new order has been sent to you by the doctor.";
        //$this->sendSMS($pharmacy->pharmacy_phone, $sms_message);

        $this->sendToPharEmail_todoctor($request->order_id);
        $this->sendToPharEmail_toPharmacy($request->order_id);

        return redirect()->back()->with('success', 'Data updated successfully');

    }

    public function sendToPharEmail_todoctor($orderid){

        $orderData = Order::with('userDetail')
        ->find($orderid);

        //get admin email
        $user = User::find($orderData->assigned_to);
        //ending get admin email

        $to = $user->email;
        $to_name = $user->name;

        $email = new Mail();
        $from_email=env('MAIL_FROM_ADDRESS');
        $email->setFrom($from_email, "Vacay MD");

        $email->setSubject("Order Sent To Pharmacy.");
        $sms_message='Order  #'.$orderData->order_num.' has been sent to pharmacy.';

        if($user->phone != null && $user->phone != ""){
        $this->sendSMS($user->phone, $sms_message);
        }

        $email->addTo($to, $to_name);

        $htmlContent = View::make('emails.order_sent_pharmacy_doc')->with(['data' => $orderData])->render();

        $email->addContent("text/html", $htmlContent);
        
        $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
        
        $response = $sendgrid->send($email);

    }

    public function sendToPharEmail_toPharmacy($orderid){

        $orderData = Order::with('userDetail')
        ->find($orderid);

        //get admin email
        $pharmacy = Pharmacy::find($orderData->pharmacy_id);
        $user = User::find($pharmacy->manager_id);
        //ending get admin email

        $to = $user->email;
        $to_name = $user->name;

        $email = new Mail();
        $from_email=env('MAIL_FROM_ADDRESS');
        $email->setFrom($from_email, "Vacay MD");

        $email->setSubject("New Order Received.");
        $sms_message='New order received at pharmacy.';

        if($pharmacy->pharmacy_phone != null && $pharmacy->pharmacy_phone != ""){
        $this->sendSMS($pharmacy->pharmacy_phone, $sms_message);
        }

        $email->addTo($to, $to_name);

        $htmlContent = View::make('emails.order_sent_pharmacy_pharm')->with(['data' => $orderData])->render();

        $email->addContent("text/html", $htmlContent);
        
        $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
        
        $response = $sendgrid->send($email);

    }

    public function updateOrderStatus(Request $request){

        if($request->order_status == "Approved"){

            //assigning order to doctor 
            $data = Order::find($request->order_id);
            $data->assigned_to = Auth::user()->id;
            $data->confirm_patient_id =$request->confirm_patient_id;
            //$data->payment_status = 1;
            $data->update();

            $this->sendAssignedEmail($request->order_id);
            //ending assigning order to doctor


            //charging customer 
            $amount = $data->total_amount;
            $user = User::find($data->user_id);

            $is_payment = $this->chargeCustomerProfile($user->authorized_user_id,$user->authorized_user_payment_id, $amount);

                if($is_payment != 0){
                    $payment_trasanction = Payment::create([
                        'amount' => $amount ,
                        'order_id' => $request->order_id,
                        'user_id' => $data->user_id,
                        't_id' => $is_payment,
                        'method' => 'Card',
                    ]);
                      
        $data = Order::find($request->order_id);
        $data->order_status = $request->order_status;
        $data->payment_status = 1;
        $data->update();
         /////////////  Default Notes 
         if($data->treatment_req=='ED'){
           
            $deualt_filepath='/src/assets/uploads/Gallery/1683886354_ED.mp3';
           }elseif($data->treatment_req=='UTI'){
            
            $deualt_filepath='/src/assets/uploads/Gallery/1683886362_HANGOVER.mp3';
           }elseif($data->treatment_req=='HANGOVER'){
           
            $deualt_filepath='/src/assets/uploads/Gallery/1683886370_UTI.mp3';
           }
           $defualt_message="Transcription of audio message - Hi, This is Dr Kulkarni. I have reviewed the information that you have provided and feel that you are a good candidate for treatment. Please follow the instructions sent with your prescription and contact me through your account if you have any questions. Thank you.";
        //    $p = new PatientNote();
        //    $p->attachment = $deualt_filepath;
        //    $p->order_id = $request->order_id;
        //    $p->user_id = $data->user_id;
        //    $p->doctor_id = Auth::user()->id;
        //    $p->save();

           $mess = new Message();
           $mess->message =  $defualt_message;
           $mess->attachment = $deualt_filepath;
           $mess->order_id = $request->order_id;
           $mess->user_id = Auth::user()->id;
           $mess->save();

           ////////////  deault Notes
        $this->sendEmail_Status($request->order_id,$request->order_status);

                }else{

                    $order_data = Order::find($request->order_id);
                    $order_data->assigned_to = null;
                    $order_data->payment_status = 0;
                    $order_data->update();

                    return redirect()->back()->withErrors(['error' => 'Error: There are some issue with the patient payment card. So, order cannot be approved.']);

                }
              
                // Handle successful charge
        
           
            //edning charging customer
        }
        if($request->order_status == "Completed"){
            $data = Order::find($request->order_id);
            if($data->order_status!='Delivered'){
                return redirect()->back()->withErrors(['error' => 'Order not delivered by pharmacy. You can not complete this at this moment.']);
 
            }
            $data->order_status = $request->order_status;
            $data->update();
             
            $this->sendEmail_Status($request->order_id,$request->order_status);
        }

        if($request->order_status == "Cancelled"){
            $data = Order::find($request->order_id);
            $data->order_status = $request->order_status;
            $data->payment_status = 2;
            $data->update();
             
            $this->sendEmail_Status($request->order_id,$request->order_status);
        }

        if($request->order_status == "In Process"){
            $data = Order::find($request->order_id);
            $data->order_status = $request->order_status;
            $data->update();
             
            $this->sendEmail_Status($request->order_id,$request->order_status);
        }
        

        return redirect()->back()->with('success', 'Data updated successfully');

    }

    public function sendEmail_Approved($orderid){

        //getting order data

        $orderData = Order::with('userDetail')
        ->find($orderid);
        
        $to = $orderData['userDetail']['email'];
        $to_name = $orderData['userDetail']['name'];

        //ending getting order data
        
        $email = new Mail();
        $from_email=env('MAIL_FROM_ADDRESS');
        $email->setFrom( $from_email, "Vacay MD");
        $email->setSubject("Your order has been approved");
        $email->addTo($to, $to_name);
        
        $htmlContent = View::make('emails.order_approved')
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

    public function sendEmail_Rejected($orderid){

        //getting order data

        $orderData = Order::with('userDetail')
        ->find($orderid);
        
        $to = $orderData['userDetail']['email'];
        $to_name = $orderData['userDetail']['name'];

        //ending getting order data
        
        $email = new Mail();
        $from_email=env('MAIL_FROM_ADDRESS');
        $email->setFrom($from_email, "Vacay MD");
        $email->setSubject("Your order has been rejected");
        $email->addTo($to, $to_name);
        
        $htmlContent = View::make('emails.order_rejected')
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

    }
    public function sendEmail_Status($orderid,$status){

        //getting order data

        $orderData = Order::with('userDetail')
        ->find($orderid);
        
        $to = $orderData['userDetail']['email'];
        $to_name = $orderData['userDetail']['name'];

        //ending getting order data
        
        $email = new Mail();
        $from_email=env('MAIL_FROM_ADDRESS');
        $email->setFrom($from_email, "Vacay MD");
        if($status=='Completed'){
            $email->setSubject("Your order has been completed");
            $sms_message='Your order  #'.$orderData->order_num.' has been completed';
        }else if($status=='Approved'){
            $email->setSubject("Your order has been approved");
            $sms_message='Your order #'.$orderData->order_num.' has been approved. Please update your location in your account when you are in Nevada.';
        }else if($status=='Rejected'){
            $email->setSubject("Your order has been rejected");
            $sms_message='Your order #'.$orderData->order_num.' has been rejected';
        }else if($status=='Cancelled'){
            $email->setSubject("Your order has been cancelled");
            $sms_message='Your order #'.$orderData->order_num.' has been cancelled. <br> If you were charged for this order, you will get refund in 5-10 business days.';

            if($orderData->payment_status == 1){
            $this->refundAmount($orderid);
            }

        }else if($status=='Pending'){
            $email->setSubject("Your order status has been changed to Pending");
            $sms_message='Your order #'.$orderData->order_num.' status has been changed to Pending';
        }else{
            $email->setSubject("Your order status has been changed to In Process");
            $sms_message='Your order #'.$orderData->order_num.' status has been changed to InProcess';
        }
        $this->sendSMS($orderData['userDetail']['phone'], $sms_message);
        $email->addTo($to, $to_name);
        if($status=='Completed'){
            $htmlContent = View::make('emails.order_completed')->with(['orderData' => $orderData])->render();
        }else if($status=='Approved'){
            $htmlContent = View::make('emails.order_approved')->with(['orderData' => $orderData])->render();
        }else if($status=='Rejected'){
            $htmlContent = View::make('emails.order_rejected')->with(['orderData' => $orderData])->render();
        }else if($status=='Cancelled'){
            $htmlContent = View::make('emails.order_doc_cancelled')->with(['orderData' => $orderData])->render();
        }else if($status=='Pending'){
            $htmlContent = View::make('emails.order_pending')->with(['orderData' => $orderData])->render();
        }else {
            $htmlContent = View::make('emails.order_inprogress')->with(['orderData' => $orderData])->render();
        }
       
        $email->addContent("text/html", $htmlContent);
        
        $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
        
        $response = $sendgrid->send($email);

    }

    public function refundAmount($orderid){

        $orderData = Order::with('userDetail')
        ->find($orderid);


        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentData = Payment::where('order_id',$orderid)->first();
        $chargeid = $paymentData->t_id;

        try {
            $payment_intent = \Stripe\PaymentIntent::retrieve($chargeid);
            
            if ($payment_intent->status == 'succeeded') {
                foreach ($payment_intent->charges->data as $charge) {
                    $refund = Refund::create([
                        'charge' => $charge->id, 
                    ]);
                }

                $paymentData->is_refunded = 1;
                $paymentData->refund_date = Carbon::now();;
                $paymentData->refund_id = $refund->id;
                $paymentData->update();
                //return response()->json(['refund' => $refund]);
            } else {
                return response()->json(['error' => 'PaymentIntent has not been paid.'], 400);
            }
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Handle error
            return response()->json(['error' => $e->getMessage()], 400);
        }
        
    }



    public static function dashboard(){

        $data['patients'] = Order::select('user_id')
        ->where('assigned_to', Auth::user()->id)
        ->whereNotNull('user_id')
        ->groupBy('user_id')
        ->count();

        $data['pending_orders'] = Order::whereNull('assigned_to')
        ->whereNotNull('user_id')
        ->whereHas('userDetail', function ($query) {
            $query->whereNotNull('authorized_user_payment_id');
        })
        ->whereHas('userDetail')
        ->whereNot('order_status','Rejected')
        ->count();
        return $data;
    }

    public function sendAssignedEmail($orderid){

        $orderData = Order::with('userDetail')
        ->find($orderid);

        $user = User::find($orderData->assigned_to);
        
        $to = $user->email;
        $to_name = $user->name;
        $phone = $user->phone;


        $email = new Mail();
        $from_email=env('MAIL_FROM_ADDRESS');
        $email->setFrom($from_email, "Vacay MD");

        $email->setSubject("New Patient Has Been Assigned.");
        $sms_message='A new patient '.$orderData['userDetail']['name'].' has been assigned to you.';

        if($phone != null && $phone != ""){
        $this->sendSMS($phone, $sms_message);
        }

        $email->addTo($to, $to_name);

        $htmlContent = View::make('emails.patient_assigned')->with(['data' => $orderData])->render();

        $email->addContent("text/html", $htmlContent);
        
        $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
        
        $response = $sendgrid->send($email);

    }


    public function chargeCustomerProfile($customerProfileId=null, $customerPaymentProfileId=null, $amount=null)
    {
        // Set up merchant authentication
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(env('AUTHORIZE_NET_API_LOGIN_ID'));
        $merchantAuthentication->setTransactionKey(env('AUTHORIZE_NET_TRANSACTION_KEY'));

        // Set the profile to charge
        $profileToCharge = new AnetAPI\CustomerProfilePaymentType();
        $profileToCharge->setCustomerProfileId($customerProfileId);
        $paymentProfile = new AnetAPI\PaymentProfileType();
        $paymentProfile->setPaymentProfileId($customerPaymentProfileId);
        $profileToCharge->setPaymentProfile($paymentProfile);

        // Create the transaction data
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($amount);
        $transactionRequestType->setProfile($profileToCharge);

        // Create the API request object
        $apiRequest = new AnetAPI\CreateTransactionRequest();
        $apiRequest->setMerchantAuthentication($merchantAuthentication);
        $apiRequest->setTransactionRequest($transactionRequestType);

        // Send the API request
        $controller = new AnetController\CreateTransactionController($apiRequest);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

        if ($response != null && $response->getMessages()->getResultCode() == "Ok") {
            $tresponse = $response->getTransactionResponse();
            return $tresponse->getTransId();
            }else{
                return 0;
            }
        // Handle the response (e.g., check if the transaction was successful and update your database accordingly)
    }

}
