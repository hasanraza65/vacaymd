@extends('layouts.layout')
@section('title','Edit User')

@section('content')

        <div class="middle-content container-xxl p-0 mb-4">

            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/users">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
                    <!-- /BREADCRUMB -->
    
            <div class="row layout-top-spacing">
                
                @include('layouts.includes.components.alert')

                <!--- form card start --->
                <div class="card p-4">

                    <form method="POST" action="/admin/users/{{$data->id}}">

                        @method('PUT')
                        @csrf

                        <div class="row mt-4">
                            <div class="col">
                                <label for="name">Full Name</label>
                                <input value="{{$data->name}}" id="name" placeholder="Enter Full Name" name="name" class="form-control">
                            </div>
                            <div class="col">
                                <label for="gender">Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="Male" {{ ($data->gender == 'Male') ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ ($data->gender == 'Female') ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="email">Email</label>
                                <input value="{{$data->email}}" id="email" name="email" type="email" class="form-control" placeholder="Enter Email" aria-label="Email">
                            </div>
                            <div class="col">
                                <label for="password">Password</label>
                                <input  id="password" name="password"  type="password" class="form-control" placeholder="Enter Password" aria-label="Last name">
                            </div>
                        </div>

                        <div class="mt-4 row">
                           <div class="col">
                           <label for="user_role">User Role</label>
                            <select id="user_role" name="user_role" class="form-control">
                                <!---<option value="1" {{ ($data->user_role == 1) ? 'selected' : '' }}>Admin</option> --->
                                <option value="2" {{ ($data->user_role == 2) ? 'selected' : '' }}>Doctor</option>
                                <!---<option value="3" {{ ($data->user_role == 3) ? 'selected' : '' }}>Pharmacy Manager</option> --->
                                <!---<option value="4" {{ ($data->user_role == 4) ? 'selected' : '' }}>Patient</option> --->
                            </select>
                           </div>
                            <div class="col">
                                <label for="phone">Phone</label>
                                <input id="phone" value="{{$data->phone}}" name="phone" type="text" class="form-control" placeholder="" aria-label="Email">
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

@endsection