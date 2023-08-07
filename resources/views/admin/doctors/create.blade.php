@extends('layouts.layout')
@section('title','Add Doctor')

@section('content')

        <div class="middle-content container-xxl p-0 mb-4">

            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/doctore">Doctors</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
                    <!-- /BREADCRUMB -->
    
            <div class="row layout-top-spacing">
                
                @include('layouts.includes.components.alert')

                <!--- form card start --->
                <div class="card p-4">

                    <form method="POST" action="/admin/doctors" enctype="multipart/form-data">

                        @csrf

                        <div class="mt-2">
                            <label for="profile_pic">Doctor Picture</label>
                            <input type="file" id="profile_pic" accept="image/*" placeholder="Choose Doctor Picture" name="file" class="form-control" >
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="name">Full Name</label>
                                <input id="name" placeholder="Enter Full Name" name="name" class="form-control" required>
                            </div>
                            <div class="col">
                                <label for="gender">Gender</label>
                                <select class="form-control" name="gender" required>
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
                                <input value="" name="password" id="password"  type="password" class="form-control" placeholder="Enter Password" aria-label="Last name" autocomplete="off" required>
                                <ul style="font-size: 10px" class="mt-4" id="password-conditions">
                                    <li id="length" style="">Password must be at least 8 characters long</li>
                                    <li id="uppercase" style="">Include at least one uppercase letter</li>
                                    <li id="special" style="">Include at least one special character</li>
                                    <li id="number" style="">Include at least one number</li>
                                </ul>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="experience">Experience</label>
                                <input id="experience" name="experience" type="text" class="form-control" placeholder="Enter Experience" aria-label="Email">
                            </div>
                            <div class="col">
                                <label for="specialization">Specialization</label>
                                <input name="specialization" id="specialization" name="text"  type="text" class="form-control" placeholder="Enter Doctor Specialization" aria-label="Last name">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="available_from">Available From</label>
                                <input id="available_from" name="available_from" type="time" class="form-control" placeholder="Available From" aria-label="Email">
                            </div>
                            <div class="col">
                                <label for="available_to">Available To</label>
                                <input id="available_to" name="available_to"  type="time" class="form-control" placeholder="Available To" aria-label="Last name">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <label for="phone">Phone</label>
                                <input id="phone" name="phone" type="text" class="form-control" placeholder="Phone" aria-label="Email">
                            </div>
                            
                        </div>
                        <div class="mt-4">
                            <label for="name">Choose State</label>
                            <select class="form-select" required name="state_id">
                              <option value="">Select state</option>
                                @foreach($states as $state)
                                <option value="{{$state->id}}">{{$state->state_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <input type="submit" class="btn btn-primary">
                        </div>

                    </form>

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
                    
                </div>
                <!--- form card ending --->

            </div>
        </div>


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