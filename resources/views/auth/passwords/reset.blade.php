<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Reset Password </title>
    <link rel="icon" type="image/x-icon" href="/src/assets/img/favicon.ico"/>
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
    
</head>
<body class="form">

    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <div class="auth-container d-flex h-100">

        <div class="container mx-auto align-self-center">
    
            <div class="row">
                
                <form method="POST" action="{{ route('password.update') }}">
                @csrf
    
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    @if($errors->any())
                        <div class="alert alert-danger m-4">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
    
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    
                                    <h2>Password Reset</h2>
                                    <p>Set Your New Password</p>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label class="form-label">Password</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                       
                                        <ul style="font-size: 10px" class="mt-4" id="password-conditions">
                                    <li id="length" style="">Password must be at least 8 characters long</li>
                                    <li id="uppercase" style="">Include at least one uppercase letter</li>
                                    <li id="special" style="">Include at least one special character</li>
                                    <li id="number" style="">Include at least one number</li>
                                    </ul>
                                    
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                
                                    
                                    <div class="mb-4">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <button type="submit" class="btn btn-secondary w-100">Reset Password</button>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
                </form>
                
            </div>
            
        </div>

    </div>
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="/src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <script>
$(document).ready(function() {
  $('#password').on('keyup change', function() {
    var password = $(this).val();

    // Check if password is at least 8 characters long
    var length = password.length >= 8;
    if (length) {
      $('#length').hide();
    } else {
      $('#length').show();
    }

    // Check if password includes at least one uppercase letter
    var hasUppercase = /[A-Z]/.test(password);
    if (hasUppercase) {
      $('#uppercase').hide();
    } else {
      $('#uppercase').show();
    }

    // Check if password includes at least one special character
    var hasSpecial = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password);
    if (hasSpecial) {
      $('#special').hide();
    } else {
      $('#special').show();
    }

    // Check if password includes at least one number
    var hasNumber = /\d/.test(password);
    if (hasNumber) {
      $('#number').hide();
    } else {
      $('#number').show();
    }

    var strength = 0;
    if (length) strength += 1;
    if (hasUppercase) strength += 1;
    if (hasSpecial) strength += 1;
    if (hasNumber) strength += 1;

    var width = (strength / 4) * 100;
    var color = '';
    if (strength == 0) {
      color = 'red';
    } else if (strength == 1 || strength == 2) {
      color = 'orange';
    } else if (strength == 3 || strength == 4) {
      color = 'green';
    }
    //$('.progress-bar').attr('aria-valuenow', width).css('width', width + '%').css('background-color', color);
    $("#password").css("border-color", color);

    var message = '';
    if (strength == 0) {
      message = 'Password is very weak';
      $('#nextBtn').prop("disabled", true); // Element(s) are now disabled.
    } else if (strength == 1 || strength == 2) {
      message = 'Password is weak';
      $('#nextBtn').prop("disabled", true); // Element(s) are now disabled.
    } else if (strength == 3) {
      message = 'Password is strong';
      $('#nextBtn').prop("disabled", true); // Element(s) are now disabled.
    } else {
      message = 'Password is very strong';
      $('#nextBtn').prop("disabled", false); // Element(s) are now enabled.
    }
    $('#password-strength-message').text(message);
  });
});

</script>
</body>
</html>