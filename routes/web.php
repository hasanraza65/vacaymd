<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\PasswordResetController;

Route::get('password/reset', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [PasswordResetController::class, 'reset'])->name('password.update');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
}); */

use App\Http\Controllers\AuthController;



// Your other routes...

Route::get('/unauthorized', function () {
    return view('unauthorized');
});
// Password Reset Routes...


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Add any other routes that require authentication inside the auth middleware group.
Route::middleware(['auth'])->group(function () {

    Route::get('/index', function () {
        return view('admin.index');
    });

    Route::get('/', function () {
        return view('welcome');
    })->middleware('redirect.role');


    /// gallary
    
    // web.php
    Route::get('/gallery', [App\Http\Controllers\GalleryController::class,'index'])->name('gallery.index');
    Route::post('/gallery', [App\Http\Controllers\GalleryController::class,'store'])->name('gallery.store');
    Route::post('/gallery/select', [App\Http\Controllers\GalleryController::class,'select'])->name('gallery.select');




    //ADMIN ROUTES
        Route::prefix('admin')->middleware(['role:1'])->group(function () { 

            Route::get('/', function () {
                return view('admin.index');
            });

          
        //Orders Routes
        Route::resource('/users', App\Http\Controllers\Admin\UserController::class);
        //Ending Orders Routes
        Route::POST('/invoice', [App\Http\Controllers\Admin\OrderController::class, 'invoiceView']);
        //Orders Routes
        Route::resource('/orders', App\Http\Controllers\Admin\OrderController::class);
        //Ending Orders Routes

        //Patients Routes
        Route::resource('/patients', App\Http\Controllers\Admin\PatientController::class);
        //Ending Patients Routes

        //Doctors Routes
        Route::resource('/doctors', App\Http\Controllers\Admin\DoctorController::class);
        //Ending Doctors Routes

        //Pharmacy Routes
        Route::resource('/pharmacies', App\Http\Controllers\Admin\PharmacyController::class);
        //Ending Pharmacy Routes

        //Patients Routes
        Route::resource('/patients', App\Http\Controllers\Admin\PatientController::class);
        //Ending Patients Routes

        Route::post('/update_order_status', [App\Http\Controllers\Admin\OrderController::class, 'updateOrderStatus']);

        //Prescription Routes 
        Route::resource('/prescriptions', App\Http\Controllers\Admin\PrescriptionController::class);
        Route::get('/transactions', [App\Http\Controllers\Admin\OrderController::class, 'allTransactions']);
        Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'showProfile']);
        Route::POST('/update-profile', [App\Http\Controllers\Admin\ProfileController::class, 'updateProfile']);
        Route::POST('/update-password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword']);
        //Ending Pharmacy Routes

        //addons items routes
        Route::resource('/upsaleitems', App\Http\Controllers\Admin\UpSaleItemController::class);
        //ending addons items routes
    });

    //ending ADMIN ROUTES

    //PATIENT Route

    Route::prefix('patient')->middleware(['role:4'])->group(function () {

        Route::get('/', function () {
            return view('patient.index');
        });

            // Routes without the checkOwner middleware
            Route::resource('/orders', App\Http\Controllers\Patient\OrdersController::class)
                ->except(['show', 'edit', 'update', 'destroy']);
        
            // Nested group for routes with the checkOwner middleware
            Route::middleware(['checkOwner:Order'])->group(function () {
                Route::get('/orders/{id}', 'App\Http\Controllers\Patient\OrdersController@show')->name('orders.show');
                Route::get('/orders/{id}/edit', 'App\Http\Controllers\Patient\OrdersController@edit')->name('orders.edit');
                Route::put('/orders/{id}', 'App\Http\Controllers\Patient\OrdersController@update')->name('orders.update');
                Route::delete('/orders/{id}', 'App\Http\Controllers\Patient\OrdersController@destroy')->name('orders.destroy');
            });
        Route::get('/transactions', [App\Http\Controllers\Patient\OrdersController::class, 'allTransactions']);
        Route::POST('/invoice', [App\Http\Controllers\Patient\OrdersController::class, 'invoiceView']);
        Route::POST('/re-order', [App\Http\Controllers\Patient\OrdersController::class, 'reOrder']);

        Route::get('/payment/{orderid}', [App\Http\Controllers\Patient\PaymentController::class, 'paymentForm']);

        Route::post('/update_location_status', [App\Http\Controllers\Patient\OrdersController::class, 'updateLocationStatus']);

        Route::get('/profile', [App\Http\Controllers\Patient\ProfileController::class, 'showProfile']);
        Route::POST('/update-profile', [App\Http\Controllers\Patient\ProfileController::class, 'updateProfile']);
        Route::POST('/update-password', [App\Http\Controllers\Patient\ProfileController::class, 'updatePassword']);

        //send msg
        Route::POST('/sendmessage', [App\Http\Controllers\Patient\MessagesController::class, 'sendMessage']);
        Route::POST('/getmessages', [App\Http\Controllers\Patient\MessagesController::class, 'getMessages']);
        //send msg

        //delete msg
        Route::delete('messages/{id}', [App\Http\Controllers\Patient\MessagesController::class, 'destroy']);
        //delete msg

        Route::get('/make-payment/{orderid}', [App\Http\Controllers\Patient\PaymentController::class, 'index']);

    });

    //ending Patient Rotue

    //Doctor Route

    Route::prefix('doctor')->middleware(['role:2'])->group(function () {

        Route::get('/', function () {
            return view('doctor.index');
        });

        Route::resource('/orders', App\Http\Controllers\Doctor\OrderController::class);
        Route::get('/showemail', [App\Http\Controllers\Doctor\OrderController::class, 'showemail']);
        Route::get('/profile', [App\Http\Controllers\Doctor\ProfileController::class, 'showProfile']);
        Route::POST('/update-profile', [App\Http\Controllers\Doctor\ProfileController::class, 'updateProfile']);
        Route::POST('/update-password', [App\Http\Controllers\Doctor\ProfileController::class, 'updatePassword']);
        Route::POST('/update-doctor-info', [App\Http\Controllers\Doctor\ProfileController::class, 'updateDoctor']);

        //Send Order To Pharmacy
        Route::Post('send_to_pharmacy', [App\Http\Controllers\Doctor\OrderController::class, 'sendToPharmacy']);
        //Ending Send Order To Pharmacy

        //Update order status
        Route::Post('update_order_status', [App\Http\Controllers\Doctor\OrderController::class, 'updateOrderStatus']);
        //Ending Send Order To Pharmacy
        
        //send Notes
        Route::POST('send-note', [App\Http\Controllers\Doctor\PatientNotesController::class, 'sendNote']);
        Route::resource('/patient-notes', App\Http\Controllers\Doctor\PatientNotesController::class);
        //send Notes
        //send msg
        Route::POST('sendmessage', [App\Http\Controllers\Doctor\MessagesController::class, 'sendMessage']);
        Route::POST('getmessages', [App\Http\Controllers\Doctor\MessagesController::class, 'getMessages']);
        //send msg

        //delete msg
        Route::delete('messages/{id}', [App\Http\Controllers\Doctor\MessagesController::class, 'destroy']);
        //delete msg

         //update msg
         Route::POST('updatemessage', [App\Http\Controllers\Doctor\MessagesController::class, 'updateMessage']);
         //update msg

    });

    //ending Doctor Rotue

    //Pharmacy Route

    Route::prefix('pharmacy')->middleware(['role:3'])->group(function () {

        Route::get('/', function () {
            return view('pharmacy.index');
        });

        Route::get('/pharmacy', function () {
            return view('admin.index');
        });

        Route::resource('/orders', App\Http\Controllers\Pharmacy\OrderController::class);
        Route::get('/profile', [App\Http\Controllers\Pharmacy\ProfileController::class, 'showProfile']);
        Route::POST('/update-profile', [App\Http\Controllers\Pharmacy\ProfileController::class, 'updateProfile']);
        Route::POST('/update-password', [App\Http\Controllers\Pharmacy\ProfileController::class, 'updatePassword']);

        Route::post('/update_order_status', [App\Http\Controllers\Pharmacy\OrderController::class, 'updateOrderStatus']);


    });

    //ending Doctor Rotue

});

Route::get('/steps', function () {
    return view('landing.steps');
});
Route::get('/terms_of_use', function () {
    return view('landing.terms_of_use');
});
Route::get('/telemedicine', function () {
    return view('landing.telemedicine');
});
Route::get('/thank_u', function () {
    return view('landing.thank_u');
});

Route::post('/patient/order', [App\Http\Controllers\Patient\OrdersController::class, 'store']);

Route::get('/patient/sendsms', [App\Http\Controllers\Patient\OrdersController::class, 'sendSMS']);

Route::get('/patient/sendemail', [App\Http\Controllers\AuthController::class, 'sendEmail']);

Route::get('/patient/register', [App\Http\Controllers\Patient\OrdersController::class, 'register']);

Route::get('handle-payment', [PayPalController::class, 'handlePayment'])->name('payment.handle');
Route::get('payment-success', [PayPalController::class, 'paymentSuccess'])->name('payment.success');
Route::get('payment-failed', [PayPalController::class, 'paymentFailed'])->name('payment.failed');

Route::post('/patient/create-payment', [App\Http\Controllers\Patient\PaymentController::class, 'store']);


Route::get('/check-email', [App\Http\Controllers\AuthController::class, 'checkEmail']);

Route::get('/test-mail', [App\Http\Controllers\Patient\OrdersController::class, 'sendEmail']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::POST('/update-profile-pic', [App\Http\Controllers\AuthController::class, 'updateProfilePic']);

//add addons to order
Route::POST('/add_addons_to_order', [App\Http\Controllers\Patient\PaymentController::class, 'addAddons']);
//ending add addons to order
//remove addons
Route::get('/remove_order_addon_item/{id}', [App\Http\Controllers\Patient\PaymentController::class, 'removeAddonItem']);
//ending remove addons

//authorize.net payment gateway route
Route::get('/makeapayment', [App\Http\Controllers\Patient\PaymentController::class,'makeAPayment']);
Route::get('/createcustomer', [App\Http\Controllers\Patient\PaymentController::class,'createCustomerProfile']);
Route::get('/customerpayment', [App\Http\Controllers\Patient\PaymentController::class,'createCustomerPaymentProfile']);
Route::get('/chargecustomer', [App\Http\Controllers\Patient\PaymentController::class,'chargeCustomerProfile']);
//endng authorize.net payment gateway route

