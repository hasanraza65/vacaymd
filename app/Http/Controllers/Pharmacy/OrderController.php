<?php

namespace App\Http\Controllers\Pharmacy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Pharmacy;
use App\Models\Prescription;
use Auth;
use Illuminate\Support\Facades\View;
//use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Session;

use App\Services\TwilioService;
use App\Mail\NewOrderMail;
use SendGrid\Mail\Mail;
use Illuminate\Support\Facades\Mail as MailFacade;
use Swift_TransportException;

class OrderController extends Controller
{
    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }
    public function index(){

        $start_date = request('start_date');
        $end_date = request('end_date');
        $today = date('Y-m-d');

        //get pharmacy id 
        $pharmacy_id = Pharmacy::where('manager_id',Auth::user()->id)->pluck('id')->toArray();
        //ending get pharmacy id
    
        if (!empty($start_date)) {
            $start_date = date('Y-m-d', strtotime($start_date));
        }
    
        if (!empty($end_date)) {
            $end_date = date('Y-m-d', strtotime($end_date));
        }
        
        $dataQuery = Order::with('userDetail')
        ->where('order_status','Approved')
        ->whereNotNull('user_id')
        ->where('payment_status',1)
        ->whereHas('userDetail')
        ->whereIn('pharmacy_id', $pharmacy_id);


        $processingQuery = Order::with('userDetail')
        ->where('order_status','In Process')
        ->whereNotNull('user_id')
        ->where('payment_status',1)
        ->whereHas('userDetail')
        ->whereIn('pharmacy_id', $pharmacy_id);


        $completedQuery = Order::with('userDetail')
        ->where('order_status','Completed')
        ->whereNotNull('user_id')
        ->whereHas('userDetail')
        ->whereIn('pharmacy_id', $pharmacy_id);

        if (!empty($start_date)) {
    
            $active_tab = request('active_tab');
    
            if(request('active_tab') == 'latest_orders'){
            $dataQuery->whereDate('created_at', '>=', $start_date);
            }
    
            if(request('active_tab') == 'in_process'){
            $processingQuery->whereDate('created_at', '>=', $start_date);
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
            $processingQuery->whereDate('created_at', '<=', $end_date);
            }
    
            if(request('active_tab') == 'completed_orders'){
            $completedQuery->whereDate('created_at', '<=', $end_date);
            }
        }

        $data = $dataQuery->get();
        $processing = $processingQuery->get();
        $completed = $completedQuery->get();


        return view('pharmacy.orders.index',compact(['data','processing','completed']));
    } 
    /*
    public function index(){

        if(isset($_GET['order_status'])){
            $orderStatus = $_GET['order_status'];
        }else{
            $orderStatus = null;
        }

        if(isset($_GET['start_date'])){
            $startDate = $_GET['start_date'];
        }else{
            $startDate = null;
        }

        if(isset($_GET['end_date'])){
            $endDate = $_GET['end_date'];
        }else{
            $endDate = null;
        }

        $data = $this->getOrdersByFilter('Pending', $startDate, $endDate, );
        $processing = $this->getOrdersByFilter('In Process', $startDate, $endDate);
        $completed = $this->getOrdersByFilter('Completed', $startDate, $endDate);

        return view('pharmacy.orders.index', compact(['data', 'processing', 'completed']));

    } */

    private function getOrdersByFilter($orderStatus, $startDate, $endDate) {
        
        //get pharmacy id 
        $pharmacy_id = Pharmacy::where('manager_id',Auth::user()->id)->pluck('id')->toArray();
        //ending get pharmacy id

        $query = Order::with('userDetail')
            ->whereNotNull('user_id')
            ->where('payment_status',1)
            ->whereIn('pharmacy_id', $pharmacy_id);
    
        if ($orderStatus) {
            $query->where('order_status', $orderStatus);
        }
    
        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
    
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }
    
        return $query->get();
    } 
    public static function dashboard(){
        $pharmacy_id = Pharmacy::where('manager_id',Auth::user()->id)->pluck('id')->toArray();
        //ending get pharmacy id
        $data['orders']= Order::whereNotNull('user_id')
            ->where('payment_status',1)
            ->whereIn('pharmacy_id', $pharmacy_id)->count();
        $data['patients'] =Order::whereNotNull('user_id')
        ->where('payment_status',1)
        ->whereIn('pharmacy_id', $pharmacy_id)->groupBy('user_id')->count();
    
        return $data;
    }
    public function show($id){

        $data = Order::with('orderDetail')
        ->with('userDetail')
        ->with('prescriptionDetailImg')
        ->with('prescriptionDetail.prescriptionMedicines')
        ->find($id);

        //return print_r($data);
      

        $prescriptions = Prescription::all();
        
        $pharmacies = Pharmacy::all();

        return view('pharmacy.orders.show',compact(['data','prescriptions','pharmacies']));

    }

    public function updateOrderStatus(Request $request){

        $data = Order::find($request->order_id);

        //check if patient reached Nevada
        if($data->state == 'Coming To Nevada' && $request->order_status == 'Delivered'){
            return redirect()->back()->withErrors(['error' => 'Error: Patient still not reached Nevada so you cannot dispensed order at the moment.']);
        }
        //ending check if patient reached Nevada

        $data->order_status = $request->order_status;
        $data->update();

        $this->sendEmail_Status($request->order_id,$request->order_status);
       
        return redirect()->back()->with('success', 'Data updated successfully');

    }
    public function sendSMS($phone_num = '+17029641642', $message = 'Hey there'){

        $this->twilioService->sendSMS($phone_num, $message);

        echo "done";

    }
    public function sendEmail_Status($orderid,$status){

        //getting order data

        $orderData = Order::with('userDetail')
        ->find($orderid);
        
        $to = $orderData['userDetail']['email'];
        $to_name = $orderData['userDetail']['name'];

        //ending getting order data
        
        $email = new Mail();
        $email->setFrom("notification@skvclients.com", "Vacay MD");
        if($status=='Delivered'){
            $email->setSubject("Your medication has been dispensed");
            $sms_message='Your medication  #'.$orderData->order_num.' has been dispensed and will be delivered shortly';
        }else if($status=='Cancelled'){
            $email->setSubject("Your order has been Cancelled");
            $sms_message='Your order #'.$orderData->order_num.' has been cancelled';
        }else{
            $email->setSubject("Your order has been Cancelled");
        }
        $this->sendSMS($orderData['userDetail']['phone'], $sms_message);
        $email->addTo($to, $to_name);
        if($status=='Completed'){
            $htmlContent = View::make('emails.order_delivered')->with(['orderData' => $orderData])->render();
        }else if($status=='Cancelled'){
            $htmlContent = View::make('emails.order_cancelled')->with(['orderData' => $orderData])->render();
        }else{
            $htmlContent = View::make('emails.order_cancelled')->with(['orderData' => $orderData])->render();
        }
       
        $email->addContent("text/html", $htmlContent);
        
        $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
        
        $response = $sendgrid->send($email);

    }


}
