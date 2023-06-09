@extends('layouts.layout')
@section('title','Edit Pharmacy')

@section('content')

        <div class="middle-content container-xxl p-0 mb-4">

            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/users">Pharmacy</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
                    <!-- /BREADCRUMB -->
    
            <div class="row layout-top-spacing">

            @include('layouts.includes.components.alert')

                <!--- form card start --->
                <div class="card p-4">

                    <form method="POST" action="/admin/pharmacies/{{$data->id}}" id="pharmacy_form">

                        @csrf
                        @method('PUT')

                        <div class="mt-2">
                            <label for="name">Pharmacy Name</label>
                            <input type="text" value="{{$data->pharmacy_name}}" id="name" placeholder="Enter Pharmacy Name" name="pharmacy_name" class="form-control">
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="phone">Pharmacy Phone #</label>
                                <input type="text" value="{{$data->pharmacy_phone}}" id="phone" placeholder="Enter Pharmacy Phone" name="pharmacy_phone" class="form-control">
                                <div id="phone_message" class="m-2"></div>
                            </div>
                            <div class="col">
                                <div class="col">
                                    <label for="name">Pharmacy Address</label>
                                    <input type="text" value="{{$data->pharmacy_address}}" id="name" placeholder="Enter Pharmacy Address" name="pharmacy_address" class="form-control">
                                </div>
                            </div>
                        </div>

                        <!---
                        <div class="mt-4">
                            <label for="name">Choose Pharmacy Manager</label>
                            <select class="form-select" name="manager_id">
                                @foreach($users as $userss)
                                <option value="{{$userss->id}}" {{ ($data->manager_id == $userss->id) ? 'selected' : '' }}>{{$userss->name}}</option>
                                @endforeach
                            </select>
                        </div> --->

                        <!--- pharmacy manager ---> 

                        <div class="row mt-4">
                            <div class="col">
                                <label for="p_name">Manager Name</label>
                                <input type="text" value="{{$data->userDetail->name}}" id="p_name" placeholder="Enter Manager Name" name="p_name" class="form-control">
                            </div>
                            <div class="col">
                                <div class="col">
                                    <label for="p_email">Manager Email</label>
                                    <input type="text" value="{{$data->userDetail->email}}" id="p_email" placeholder="Enter Manager Email" name="p_email" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="col">
                                    <label for="password">Manager Password</label>
                                    <input type="password" value="" id="password" placeholder="Enter Manager Password" name="password" class="form-control">
                                    <ul style="font-size: 10px" class="mt-4" id="password-conditions">
                                        <li id="length" style="">Password must be at least 8 characters long</li>
                                        <li id="uppercase" style="">Include at least one uppercase letter</li>
                                        <li id="special" style="">Include at least one special character</li>
                                        <li id="number" style="">Include at least one number</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="manager_id" value="{{$data->userDetail->id}}">

                        <!--- ending pharmacy manager --->


                        <div class="mt-4">
                            <input type="submit" class="btn btn-primary">
                        </div>

                    </form>

                </div>
                <!--- form card ending --->

            </div>
        </div>


    <script>
        $(document).ready(function () {
            // Function to get the value of a query parameter from the URL
            function getQueryParam(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
            }

            // Get the value from the URL using the GET method
            const selectedValue = getQueryParam('selected_role');

            // Compare the value with the options and select the matched option
            if (selectedValue) {
            $('#user_role').val(selectedValue);
            }
        });
    </script>


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


// Assume phoneValidity is globally declared and initially set to false.
var phoneValidity = false;

// Phone validation
$('#phone').on('keyup', function() {
  var phone = $(this).val().trim();

  if (!phone.match(/^\d{10}$/)) {
    $('#phone_message').html('Invalid Phone Number').css('color', 'red');
    phoneValidity = false;
  } else {
    $('#phone_message').html('Valid Phone Number').css('color', 'green');
    phoneValidity = true;
  }

  //checkValidity();
});

// Prevent form submission until phone number is valid
$('#pharmacy_form').on('submit', function(e) {
  if (!phoneValidity) {
    e.preventDefault();

    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Please provide a valid phone number before submitting the form.',
      confirmButtonText: 'Okay'
    }).then((result) => {

  });
    


  }
});
//ending

</script>

@endsection