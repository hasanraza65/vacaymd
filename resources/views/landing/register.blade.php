@include('landing.layout.header')

<style>

.progress {
  height: 5px;
  margin-bottom: 0;
  border-radius: 100px;
  overflow: hidden;

}
.progress-bar {
  height: 100%;
  border-radius: 100px;
}
  </style>
                    <style>
.password-input {
    padding-right: 35px;
    font-family: "Arial", sans-serif;
}

.toggle-password-icon {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
    color: gray !important;
}
.toggle-password-icon-re {
    position: absolute;
    top: 15%;
    right: 20px;
    transform: translateY(-50%);
    cursor: pointer;
    color: gray !important;
}

.input-container {
    position: relative;
  }
  
  /* date css */
  
  @media screen and (max-width: 750px) {
      
  .dob_label{
    margin-bottom: -50px;
    margin-top: 8px;
    z-index: 5;
  }
  
  @media screen and (min-width: 750px) {
  
  .dob_label{
      display:none!important;
  }
  
  }
  
}
  

                    </style>

<div class="step_info">
    <div class="container" style="padding-left: 30px;">Sign Up</div>
</div>

@if($errors->any())
        <div class="alert alert-danger m-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<form action="/register" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="step-form container">

        <div class="step active" id="step-1">

            <div class="question-div">

                <span class="heading ">Next you will provide some basic information about yourself <br> Already a member? <a href="/login" class="login-link">Log in</a> and continue</span>

                <div class="row mt-4">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <input placeholder="Legal First Name: " id="first_name" name="name" type="text" class="form-control add-billing-address-input input-custom" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input placeholder="Legal Last Name: " id="last_name" name="name_last" type="text" class="form-control input-custom" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <input id="email" placeholder="Email address:" name="email" type="email" class="form-control add-billing-address-input input-custom" required>
                            <div id="email_message" class="m-2"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input placeholder="Mobile number: " id="phone" name="phone" type="text" class="form-control input-custom" required>
                            <div id="phone_message" class="m-2"></div>
                        </div>
                    </div>


                    <div class="col-md-6">
    <div class="mb-3 position-relative ">
      
        <div class="input-container">
          <input placeholder="Password: " id="password" name="password" type="password" class="form-control input-custom password-input" required>
          <span class="toggle-password-icon" style="font-size:30px;" onclick="togglePasswordVisibility('password')">&#x1F441;</span>
        </div>

        
        <div class="progress mt-2">
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
        </div>
        <p class="mt-2" id="password-strength-message"></p>

        <ul style="font-size: 14px" class="mt-4" id="password-conditions">
            <li id="length">Password must be at least 8 characters long</li>
            <li id="uppercase">Include at least one uppercase letter</li>
            <li id="special">Include at least one special character</li>
            <li id="number">Include at least one number</li>
        </ul>
    </div>
</div>

<div class="col-md-6">
    <div class="mb-3 position-relative">
        <input placeholder="Re-enter password:" id="confirm_password" name="password_confirmation" type="password" class="form-control input-custom" required>
        <span class="toggle-password-icon-re" style="font-size:30px;" onclick="togglePasswordVisibility('confirm_password')">&#x1f441;</span>

        <div id="password_message" class="m-2"></div>

        <label class="button-container custom-register-checkbox-container w-100 mb-4 mt-4">
            <input type="checkbox" id="agree_terms" class="custom-radio-circle" name="i_agree_terms" id="form-check-default" required> 
            <label class="mouse-none" style="font-size: 14px">
                I Agree to terms and privacy policy and consent to telehealth
            </label>
        </label>
    </div>
</div>


                </div>

            </div>



        </div>
        <div class="step" id="step-2">

            <span class="heading ">This information helps your doctor determine if you're eligible for treatment.</span>

            <div class="question-div">

                <div class="row mt-4">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <select name="gender" class="form-select input-custom" required>
                                <option>Sex assigned at birth</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="dob_label d-md-none" for="dob" id="dobLabel">DOB</label>
                            <input type="date" id="dob" class="form-control datepicker" placeholder="Birthdate: " name="dob" pattern="\d{2}\d{2}\d{4}" required>
                        </div>
                    </div>

                    <span class="mt-2 mb-2" style="font-size:14px">By law, we can only provide consultations if you are present in Nevada</span>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <input placeholder="Home Address: " name="billing_address" type="text" class="form-control input-custom" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input placeholder="Home State: " name="home_state" type="text" class="form-control input-custom">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <input placeholder="Home City: " name="home_city" type="text" class="form-control input-custom">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <input placeholder="Zipcode: " name="zip" type="text" class="form-control input-custom" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-">
                            <select id="state" name="state" class="form-select input-custom" required>
                                <option value="">Are you in Nevada?</option>
                                <option value="Nevada">Yes</option>
                                <option value="Coming To Nevada">Coming to Nevada</option>
                            </select>
                        </div>
                    </div>

                        <div class="col-md-6 nevada_options d-none">
                            <div class="mb-3">
                                <input placeholder="When you will reach Nevada: " name="nevada_arrival_date" type="text" onfocus="(this.type='date')" class="form-control input-custom">
                            </div>
                        </div>

                        <div class="col-md-6 nevada_options d-none">
                            <div class="mb-3">
                                <input placeholder="Las Vegas delivery address:" name="hotel_name" type="text" class="form-control input-custom" >
                            </div>
                        </div>
    

                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label upload-label">Upload a valid ID (Drivers license or passport)</label>
                            <input  name="files[]" accept="image/*,.pdf" type="file" class="form-control input-custom" style="padding-left: 10px;" multiple>
                            <span class="mt-2" style="font-size:14px">A state issued ID is required by law (Driver’s license, Tribal ID, or Passport)</span>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="button-container custom-register-checkbox-container w-100 mb-2 mt-4">
                            <input type="checkbox" class="custom-radio-circle" name="allow_receive_text" id="form-check-default">
                            <label class="mouse-none" style="font-size: 14px">
                                I agree the to receive text messages (Msg & data rates may apply.)
                                
                            </label>
                        </label>
                    </div>
                    <div class="col-12">
                        <label class="button-container custom-register-checkbox-container w-100 mb-4 mt-1">
                            <input type="checkbox" class="custom-radio-circle" name="our_pharmacy_text" id="form-check-default" required>
                            <label class="mouse-none" style="font-size: 14px">
                             By clicking the box, you agree to have this medication dispensed by our partner pharmacy only
                                
                            </label>
                        </label>
                    </div>

                </div>

            </div>

        </div>

        <div class="step-buttons mt-4">
            <button class="button-custom previous-button" type="button" id="prevBtn" onclick="changeStep(-1)" disabled>Previous</button>
            <button type="button" class="button-custom" id="nextBtn" onclick="changeStep(1)" disabled>Submit & Next</button>
            <button type="submit" class="button-custom d-none" id="submitBtn">Submit and Pay</button>
        </div>

    </div>

</form>



<script>
    let currentStep = 1;
    const totalSteps = 2;

    function changeStep(n) {



        if (n === 1 && !validateStep(currentStep)) {
            
            Swal.fire({
            icon: 'error',
            title: 'All Fields Are Required',
            text: 'Please fill up the fields',
            confirmButtonText: 'Okay'
        }).then((result) => {
        
          //window.location.href = '/steps';

        });

            return;
        }

        const prevStep = document.getElementById(`step-${currentStep}`);
        currentStep += n;
        const nextStep = document.getElementById(`step-${currentStep}`);

        prevStep.classList.remove('active');
        nextStep.classList.add('active');

        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        if (currentStep === 1) {
            prevBtn.setAttribute('disabled', 'disabled');
        } else {
            prevBtn.removeAttribute('disabled');
        }

        if (currentStep > 1) {

            $('#nextBtn').removeClass('d-none');
        }

        if (currentStep === totalSteps) {

            $('#submitBtn').removeClass('d-none');
            $('#nextBtn').addClass('d-none');
        } else {

            $('#nextBtn').removeClass('d-none');
            $('#submitBtn').addClass('d-none');
        }

        //$('#nextBtn').removeClass('d-none');
    }
</script>

<script>
$(document).ready(function() {
  var passwordValidity = true;
  var emailValidity = false;
  var phoneValidity = true;
  var checkboxValidity = false;
  var nameValidity = true;

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
      passwordValidity = false;
    } else if (strength == 1 || strength == 2) {
      color = 'orange';
      passwordValidity = false;
    } else if (strength == 3) {
      color = 'green';
      passwordValidity = true;
    } else {
      color = 'green';
      passwordValidity = true;
    }
    $('.progress-bar').attr('aria-valuenow', width).css('width', width + '%').css('background-color', color);

    var message = '';
    if (strength == 0) {
      message = 'Password is very weak';
    } else if (strength == 1 || strength == 2) {
      message = 'Password is weak';
    } else if (strength == 3) {
      message = 'Password is strong';
    } else {
      message = 'Password is very strong';
    }
    $('#password-strength-message').html('<span style="color: green;">' + message + '</span>');

    checkValidity();
  });

  $('#email').on('keyup', function() {
    var email = $(this).val();

    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email) && email.length > 0) {
      $.ajax({
        url: "/check-email",
        type: "GET",
        data: {email: email},
        success: function(data) {
          if (data.error) {
            $('#email_message').html(data.error).css('color', 'red');
            emailValidity = false;
          } else {
            $('#email_message').html(data.success).css('color', 'green');
            emailValidity = true;
          }

          checkValidity();
        }
      });
    } else {
      $('#email_message').html('Invalid Email').css('color', 'red');
      emailValidity = false;

      checkValidity();
    }
  });

  $('#phone').on('keyup', function() {
    var phone = $(this).val().trim();

    if (!phone.match(/^\d{10}$/)) {
      $('#phone_message').html('Invalid Phone Number').css('color', 'red');
      phoneValidity = false;
    } else {
      $('#phone_message').html('Valid Phone Number').css('color', 'green');
      phoneValidity = true;
    }

    checkValidity();
  });

  $('#password, #confirm_password').on('keyup', function() {
    if ($('#password').val() == $('#confirm_password').val()) {
      $('#password_message').html('Matching').css('color', 'green');
      passwordValidity = true;
    } else {
      $('#password_message').html('Not Matching').css('color', 'red');
      passwordValidity = false;
    }

    checkValidity();
  });

  $('#agree_terms').change(function() {
    if ($(this).is(':checked')) {
      checkboxValidity = true;
    } else {
      checkboxValidity = false;
    }

    checkValidity();
  });

  $('#first_name, #last_name').on('keyup', function() {
    var name = $(this).val().trim();

    if (!/^[a-zA-Z]+$/.test(name)) {
      $('#name_message').html('Only Alphabets Allowed').css('color', 'red');
      nameValidity = false;
    } else {
      $('#name_message').html('');
      nameValidity = true;
    }

    checkValidity();
  });

  // Validate Cardholder Name input
  $('#first_name, #last_name').on('input', function() {
        this.value = this.value.replace(/[^a-zA-Z\s]+/g, '');
    });

  function checkValidity() {
    if (passwordValidity && emailValidity && phoneValidity && checkboxValidity && nameValidity) {
      $('#nextBtn').prop("disabled", false);
    } else {
      $('#nextBtn').prop("disabled", true);
    }
  }
});
</script>


<script>
                      function togglePasswordVisibility(id) {
    const passwordInput = document.getElementById(id);
    const icon = document.querySelector(".toggle-password-icon");
    
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.innerHTML = "&#x1f441;&#xfe0e;"; // change the icon to a crossed eye
    } else {
        passwordInput.type = "password";
        icon.innerHTML = "&#x1f441;"; // change the icon back to the eye
    }
}

                    </script>



<script>
  const dobInput = document.getElementById('dob');
  const dobLabel = document.getElementById('dobLabel');

  dobInput.addEventListener('change', function() {
    if (dobInput.value) {
      dobLabel.style.display = 'none';
    } else {
      dobLabel.style.display = 'block';
    }
  });
</script>


@include('landing.layout.footer')