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
use Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('landing.payment');
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

            /*
            $charge = Charge::create([
                'amount' => $amount * 100, // Amount in cents
                'currency' => 'usd',
                'source' => $request->input('stripeToken'),
                'description' => 'VACAY MD',
            ]); */

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

            /*

            $donepayment = Charge::create ([
            
                "amount" => $amount * 100,
                "currency" => "USD",
                "customer" => $customertoken,
                "description" => "Payment By VACAY MD"
            ]); */



            //ending storting card for future

            // Save the charge details to your database or perform other actions as needed.
            /*
            $order = Order::where('id',$request->order_id)->first();
            $order->payment_status = 1;
            $order->update(); */

            //adding transaction

            /*

            $transaction = new Payment();
            $transaction->amount = $amount;
            $transaction->order_id = $request->order_id;
            //$transaction->t_id = $charge->id;
            $transaction->method = 'Stripe';
            $transaction->user_id = Auth::user()->id;
            $transaction->save(); */

            //ending adding transaction

            //return back()->with('success_message', 'Payment successful!');

            return redirect()->to('/patient/orders/')->with('success', 'Order Created Successful!');

        }   catch (\Exception $ex) {
            return back()->withErrors('Error! ' . $ex->getMessage());
        }


        //return redirect()->to('/patient');
        
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
}
