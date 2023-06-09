<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Order;
use App\Models\User;
use App\Models\UpSaleItem;
use App\Models\OrderAddon;
use Auth;
use Carbon\Carbon;
use SendGrid\Mail\Mail;
use Swift_TransportException;
use Illuminate\Support\Facades\View;
use App\Services\TwilioService;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }
    public function index($id)
    {   
        //get order details 
        $order = Order::find($id);
        //ending get order details

        //get order addons
        $orderaddons = OrderAddon::with('itemDetail')->where('order_id',$id)->get();
        //ending get order addons

        //getting items
        $items = UpSaleItem::where('treatment',$order->treatment_req)->get();
        //ending getting items

        return view('landing.payment',compact(['items','id','orderaddons']));
    }

    public function addAddons(Request $request){

        $counter = 0;
        for($i=0; $i<count($request->selected_items); $i++){

            $data = new OrderAddon();
            $data->order_id = $request->order_id;
            $data->item_id = $request->selected_items[$i];
            $data->item_price = $request->selected_item_price[$i];
            $data->save();
            $counter = $counter+1;

            //update order amount
            $order= Order::find($request->order_id);
            $order->total_amount = $order->total_amount+$request->selected_item_price[$i];
            $order->update();
            //ending update order amount

        }

        if($counter > 1){
        return back()->with('success', 'Addons have been added to your order');
        }else{
        return back()->with('success', 'Addon has been added to your order');
        }

    }

    public function removeAddonItem($id){

        $data = OrderAddon::find($id);
        $data->delete();

        //update order amount
        $order= Order::find($data->order_id);
        $order->total_amount = $order->total_amount-$data->item_price;
        $order->update();
        //ending update order amount
        
        return back()->with('success', 'Item has been removed from your order');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $order = Order::where('id',$request->order_id)->first();
        $authUser = User::find($order->user_id);


        $amount = $request->amount;
        //Stripe::setApiKey(config('services.stripe.secret'));
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {

            //storing card for future

            if($authUser->stripe_token == "" || $authUser->stripe_token == null){
        
                $customer = \Stripe\Customer::create(array(
                    'source'   => $request->stripeToken,
                    'email'    => $authUser->email,
                    'name'     => $authUser->name
                ));
    
                $customertoken = $customer->id;
    
                $user = User::find($order->user_id);
                $user->stripe_token = $customertoken;
                $user->update();
    
            }else{
    
                $customertoken = $authUser->stripe_token;
            }

            //sending email
            $this->sendEmail($request->order_id);
            //ending sending email

            return redirect()->to('/thank_u')->with('success', 'Order Created Successful!');

        }   catch (\Exception $ex) {
            return back()->withErrors('Error! ' . $ex->getMessage());
        }

        
    }

    public function sendEmail($orderid){

        $orderData = Order::with('userDetail')
        ->find($orderid);

        //get admin email
        $admin = User::where('user_role',1)->first();
        //ending get admin email

        $to = $admin->email;
        $to_name = $admin->name;

        $email = new Mail();
        $from_email=env('MAIL_FROM_ADDRESS');
        $email->setFrom($from_email, "Vacay MD");

        $email->setSubject("You have received a new order.");
        $sms_message='New order  #'.$orderData->order_num.' has been received.';

        if($admin->phone != null && $admin->phone != ""){
        $this->sendSMS($admin->phone, $sms_message);
        }

        $email->addTo($to, $to_name);

        $htmlContent = View::make('emails.order_completed')->with(['orderData' => $orderData])->render();

        $email->addContent("text/html", $htmlContent);
        
        $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
        
        $response = $sendgrid->send($email);

    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function paymentForm($orderid){

        return view('patient.payments.create');
    }

    public function sendSMS($phone_num = null, $message = null){

        $this->twilioService->sendSMS($phone_num, $message);

    }

}
