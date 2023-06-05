<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Facades\PayPal;

class PayPalController extends Controller
{
    public function handlePayment()
    {
        $provider = PayPal::setProvider('express_checkout');

        $data = [];
        $data['items'] = [
            [
                'name' => 'Item 1',
                'price' => 9.99,
                'qty' => 1,
            ],
        ];
        $data['invoice_id'] = uniqid();
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');

        $response = $provider->setExpressCheckout($data);

        return redirect($response['paypal_link']);
    }

    public function paymentSuccess(Request $request)
    {
        $provider = PayPal::setProvider('express_checkout');

        $token = $request->get('token');
        $payerId = $request->get('PayerID');
        $response = $provider->getExpressCheckoutDetails($token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $data = [];
            $data['items'] = [
                [
                    'name' => 'Item 1',
                    'price' => 9.99,
                    'qty' => 1,
                ],
            ];
            $data['invoice_id'] = $response['INVNUM'];
            $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
            $data['return_url'] = route('payment.success');

            $payment_status = $provider->doExpressCheckoutPayment($data, $token, $payerId);

            if (in_array(strtoupper($payment_status['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
                // Payment was successful. Handle the transaction and update your database.
                return view('patient.payment.success');
            }
        }

        return view('patient.payment.failed');
    }
}