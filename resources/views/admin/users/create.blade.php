@extends('layouts.layout')
@section('title','Create User')

@section('content')

        <div class="middle-content container-xxl p-0 mb-4">

            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/users">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
                    <!-- /BREADCRUMB -->
    
            <div class="row layout-top-spacing">

            @include('layouts.includes.components.alert')

                <!--- form card start --->
                <div class="card p-4">

                    <form method="POST" action="/admin/users">

                        @csrf

                        <div class="row mt-4">
                            <div class="col">
                                <label for="name">Full Name</label>
                                <input id="name" placeholder="Enter Full Name" name="name" class="form-control" required>
                            </div>
                            <div class="col">
                                <label for="gender">Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" class="form-control" placeholder="Enter Email" aria-label="Email" required>
                            </div>
                            <div class="col">
                                <label for="password">Password</label>
                                <input id="password" name="password" type="password" class="form-control" placeholder="Enter Password" aria-label="Last name" required>
                                <ul style="font-size: 10px" class="mt-4" id="password-conditions">
                                    <li id="length" style="">Password must be at least 8 characters long</li>
                                    <li id="uppercase" style="">Include at least one uppercase letter</li>
                                    <li id="special" style="">Include at least one special character</li>
                                    <li id="number" style="">Include at least one number</li>
                                </ul>
                            </div>
                        </div>

                        <div class="mt-4 row">
                            <div class="col">
                            <label for="user_role">User Role</label>
                            <select id="user_role" name="user_role" class="form-control" required>
                                <!---<option value="1">Admin</option> --->
                                <option value="2">Doctor</option>
                                <!---<option value="4">Patient</option>--->
                            </select>
                            </div>
                            <div class="col">
                                <label for="phone">Phone</label>
                                <input id="phone" name="phone" type="text" class="form-control" placeholder="Phone" aria-label="Email">
                            </div>
                        </div>

                        <div class="mt-4">
                            <input type="submit" class="btn btn-primary">
                        </div>

                    </form>

                </div>
                <!--- form card ending --->

            </div>
        </div>
        <script>
    $(document).ready(function() {
      $('#phone').on('input', function() {
        var phoneNumber = $(this).val();
        // Remove any non-digit characters
        phoneNumber = phoneNumber.replace(/\D/g, '');
        $(this).val(phoneNumber);

        // Check if the number of digits is within the valid range
        if (phoneNumber.length > 10) {
          phoneNumber = phoneNumber.slice(0, 10);
          $(this).val(phoneNumber);
        }
      });
    });
  </script>

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

</script>

@endsection