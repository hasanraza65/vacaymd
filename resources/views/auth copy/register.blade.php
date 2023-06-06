<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Register | Vacay Web </title>
    <link rel="icon" type="image/x-icon" href="../src/assets/img/favicon.ico"/>
    <link href="/layouts/modern-light-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
    <link href="/layouts/modern-light-menu/css/dark/loader.css" rel="stylesheet" type="text/css" />
    <script src="/layouts/modern-light-menu/loader.js"></script>
    
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="/src/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    
    <link href="/layouts/modern-light-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/light/authentication/auth-boxed.css" rel="stylesheet" type="text/css" />
    
    <link href="/layouts/modern-light-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" />
    <link href="/src/assets/css/dark/authentication/auth-boxed.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    
</head>
<body class="form">

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">
    
            <div class="row">
    
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12 d-flex flex-column align-self-center mx-auto">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/register" method="POST">
                        @csrf
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
    
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    
                                    <h2>Sign Up</h2>
                                    <p>Enter your email and password to register</p>
                                    
                                </div>


                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input placeholder="Enter Your Name" name="name" type="text" class="form-control add-billing-address-input">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input placeholder="Enter Your Email" name="email" type="email" class="form-control">
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input placeholder="Enter Your Password" name="password" type="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input placeholder="Enter Your Password Again" name="password_confirmation" type="password" class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Date of Birth</label>
                                        <input placeholder="Enter Your Date of Birth" name="dob" type="date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Billing Address</label>
                                        <input placeholder="Enter Your Billing Address" name="billing_address" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">State</label>
                                        <select name="state" id="state" class="form-select">
                                            <option value="Nevada">Nevada</option>
                                            <option value="Coming to Nevada">Coming to Nevada</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="hotel_name" class="col-12 d-none">
                                    <div class="mb-3">
                                        <label class="form-label">Hotel/Location Name</label>
                                        <input placeholder="Enter Your Hotel Location" name="hotel_name" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Passport/Driver Licence Card Picture</label>
                                        <input placeholder="Choose FIle" name="file" accept="image/*,.pdf,audio/*" type="file" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12 mt-4">
                                    <div class="mb-3">
                                        <div class="form-check form-check-primary form-check-inline">
                                            <input name="allow_receive_text" class="form-check-input me-3" type="checkbox" id="form-check-default">
                                            <label class="form-check-label" for="form-check-default">
                                                I agree the to receive text messages
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="mb-4">
                                        <button type="submit" class="btn btn-secondary w-100">SIGN UP</button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="text-center">
                                        <p class="mb-0">Already have an account ? <a href="/login" class="text  -warning">Sign in</a></p>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                    </form>
                </div>
                
            </div>
            
        </div>

    </div>
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="/src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <script>
        $(document).ready(function() {
            $('#state').on('change', function() {
                var selectedValue = $(this).val();
                if (selectedValue === 'Coming to Nevada') {
                    // Do something when the selected option is "Others"
                    $('#hotel_name').removeClass('d-none')
                } else {
                    // Do something when the selected option is not "Others"
                    $('#hotel_name').addClass('d-none')
                }
            });
        });
    </script>

</body>
</html>