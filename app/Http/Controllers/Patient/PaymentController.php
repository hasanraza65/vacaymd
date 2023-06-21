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
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

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
        /*
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
        } */ 

        //creating authorized.net customer profile
        $customerid = $this->createCustomerProfile($authUser->email);
        //creating authorized.net customer payment profile
        $customer_paymentid = $this->createCustomerPaymentProfile($request->card_number, $request->card_expiry, $request->card_code, $customerid);

        $authUser->authorized_user_id = $customerid;
        $authUser->authorized_user_payment_id = $customer_paymentid;
        $authUser->update();

        return redirect()->to('/thank_u')->with('success', 'Order Created Successful!');
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

    //////////////////////////////////////////
    //////////////////////////////////////////
    /* AUTHORIZE.NET PAYMENT GATEWAY STARTS */
    public function makeAPayment(Request $request)
    {
        //dd($request->all());
        $data = $request->all();

        // Formatting the card number
        $cardNumber = str_replace(' ', '', $data['card_number']);

        // Formatting the card expiry
        $cardExpiryParts = explode('/', $data['card_expiry']);
        $cardExpiryMonth = trim($cardExpiryParts[0]);
        $cardExpiryYear = trim($cardExpiryParts[1]);
        $cardExpiry = $cardExpiryYear . '-' . $cardExpiryMonth;

        // Card code does not need formatting
        $cardCode = $data['card_code'];

        /* Create a merchantAuthenticationType object with authentication details
        retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(env('AUTHORIZE_NET_API_LOGIN_ID'));
        $merchantAuthentication->setTransactionKey(env('AUTHORIZE_NET_TRANSACTION_KEY'));

        // Set the transaction's refId
        $refId = 'ref' . time();

        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($cardNumber);
        $creditCard->setExpirationDate($cardExpiry);
        $creditCard->setCardCode($cardCode);

        // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create a transaction
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount(200);
        $transactionRequestType->setPayment($paymentOne);

        // Assemble the complete transaction request
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);

        // Create the controller and get the response
        $controller = new AnetController\CreateTransactionController($request);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

        // Check the response
        if ($response != null) {
            if ($response->getMessages()->getResultCode() == "Ok") {
                return response()->json(['message' => 'Transaction successful'], 200);
            } else {
                $errorMessages = $response->getMessages()->getMessage();
                //return response()->json(['message' => $errorMessages[0]->getText()], 500);
                return back()->withErrors('Error! ' . $errorMessages[0]->getText());
            }
        } else {
            return response()->json(['message' => 'No response returned'], 500);
        }
    }

    public function createCustomerProfile($email=null)
    {
        // Set up merchant authentication
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(env('AUTHORIZE_NET_API_LOGIN_ID'));
        $merchantAuthentication->setTransactionKey(env('AUTHORIZE_NET_TRANSACTION_KEY'));

        // Create the customer profile data object
        $customerProfile = new AnetAPI\CustomerProfileType();
        $customerProfile->setMerchantCustomerId('M_' . time());
        $customerProfile->setEmail($email);

        // Create the API request object
        $apiRequest = new AnetAPI\CreateCustomerProfileRequest();
        $apiRequest->setMerchantAuthentication($merchantAuthentication);
        $apiRequest->setProfile($customerProfile);

        // Send the API request
        $controller = new AnetController\CreateCustomerProfileController($apiRequest);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

        // Handle the response (e.g., store the customerProfileId in your database)

        return $response->getCustomerProfileId();
    }

    public function createCustomerPaymentProfile($card_num=null, $card_exp=null, $card_cvv=null, $customerProfileId=null)
    {

        // Formatting the card number
        $cardNumber = str_replace(' ', '', $card_num);

        // Formatting the card expiry
        $cardExpiryParts = explode('/', $card_exp);
        $cardExpiryMonth = trim($cardExpiryParts[0]);
        $cardExpiryYear = trim($cardExpiryParts[1]);
        $cardExpiry = $cardExpiryYear . '-' . $cardExpiryMonth;

        // Card code does not need formatting
        $cardCode = $card_cvv;


        // Set up merchant authentication
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(env('AUTHORIZE_NET_API_LOGIN_ID'));
        $merchantAuthentication->setTransactionKey(env('AUTHORIZE_NET_TRANSACTION_KEY'));

        // Create the credit card object
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($cardNumber);
        $creditCard->setExpirationDate($cardExpiry);
        $creditCard->setCardCode($cardCode);

        // Add the payment data to a paymentType object
        $paymentCreditCard = new AnetAPI\PaymentType();
        $paymentCreditCard->setCreditCard($creditCard);

        // Create a customer payment profile object
        $paymentprofile = new AnetAPI\CustomerPaymentProfileType();
        $paymentprofile->setCustomerType('individual');
        $paymentprofile->setPayment($paymentCreditCard);

        // Create the API request object
        $apiRequest = new AnetAPI\CreateCustomerPaymentProfileRequest();
        $apiRequest->setMerchantAuthentication($merchantAuthentication);
        $apiRequest->setCustomerProfileId($customerProfileId);
        $apiRequest->setPaymentProfile($paymentprofile);

        // Send the API request
        $controller = new AnetController\CreateCustomerPaymentProfileController($apiRequest);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

        //return $response;
        return $response->getCustomerPaymentProfileId();
        // Handle the response (e.g., store the customerPaymentProfileId in your database)
    }

    public function chargeCustomerProfile(Request $request, $customerProfileId=512333904, $customerPaymentProfileId=518847137, $amount=140)
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

        return $response;
        // Handle the response (e.g., check if the transaction was successful and update your database accordingly)
    }


    /* AUTHORIZE.NET PAYMENT GATEWAY ENDS */

}
