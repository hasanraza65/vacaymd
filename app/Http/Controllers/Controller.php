<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Order;
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
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function sendEmail($userid){

        $userData = User::find($userid);
        $to = $userData->email;
        $to_name = $userData->name;
        //ending getting order data
        $email = new Mail();
        $from_email=env('MAIL_FROM_ADDRESS');
        $email->setFrom($from_email, "Vacay MD");
        $email->setSubject("Account Created");
        $email->addTo($to, $to_name);
        $htmlContent = View::make('emails.new_account')
         ->with(['userData' => $userData])
        ->render();
        $email->addContent("text/html", $htmlContent);
        $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
        $response = $sendgrid->send($email);

    }

}
