<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use SendGrid\Mail\Mail;
use App\Models\User;

class PasswordCustomResetController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
     
     /*
    public function sendResetLinkEmail(Request $request)
    {
        
        $request->validate(['email' => 'required|email']);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        // If password reset link sent successfully
        if ($response == Password::RESET_LINK_SENT) {

            // Send email with password reset link to user
            $to = $request->email;
            $to_name = 'User';
            $reset_url = url('/password/reset/'.$response);

            $email = new Mail();
            $email->setFrom("notification@skvclients.com", "Vacay MD");
            $email->setSubject("Reset Password Link");
            $email->addTo($to, $to_name);

            $htmlContent = View::make('emails.password_reset')
                ->with(['reset_url' => $reset_url])
                ->render();

            $email->addContent("text/html", $htmlContent);

            $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));

            $sendgrid->send($email);

            // Show success message
            return back()->with('status', trans($response));
        }

        // If password reset link not sent
        return back()->withErrors(
            ['email' => trans($response)]
        );
    } */ 
    
    public function sendResetLinkEmail(Request $request){
        

    $request->validate(['email' => 'required|email']);

    $user = User::where('email', $request->input('email'))->first();

    if (!$user) {
        return redirect()->back()->withErrors(['email' => 'We can\'t find a user with that email address.']);
    }

    $token = Password::createToken($user);


    $this->sendLinkMail($token,$request->email);

    return redirect()->back()->with('status', 'We have e-mailed your password reset link!');

        
    }
    
    public function sendLinkMail($token,$email){
        
        // Send email with password reset link to user
            $to = $email;
            $to_name = 'User';

            $email = new Mail();
            $from_email=env('MAIL_FROM_ADDRESS');
            $email->setFrom($from_email, "Vacay MD - Password Reset");
            $email->setSubject("Reset Password Link");
            $email->addTo($to, $to_name);

            $htmlContent = View::make('emails.password_reset')
                ->with(['token' => $token])
                ->render();

            $email->addContent("text/html", $htmlContent);

            $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));

            $sendgrid->send($email);
        
    }
}
