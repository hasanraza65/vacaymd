@extends('layouts.layout')
@section('title','Edit Doctor')

@section('content')

        <div class="middle-content container-xxl p-0 mb-4">

            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/doctors">Doctors</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
                    <!-- /BREADCRUMB -->
    
            <div class="row layout-top-spacing">
                
                @include('layouts.includes.components.alert')

                <!--- form card start --->
                <div class="card p-4">

                    <form method="POST" action="/admin/doctors/{{$data->id}}" enctype="multipart/form-data">

                        @method('PUT')
                        @csrf

                        <div class="mt-2">
                            <label for="profile_pic">Doctor Picture</label>
                            <input type="file" id="profile_pic" accept="image/*" placeholder="Choose Doctor Picture" name="file" class="form-control">
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="name">Full Name</label>
                                <input value="{{$data->userDetail->name}}" id="name" placeholder="Enter Full Name" name="name" class="form-control">
                            </div>
                            <div class="col">
                                <label for="gender">Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="Male" {{ ($data->userDetail->gender == 'Male') ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ ($data->userDetail->gender == 'Female') ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="email">Email</label>
                                <input value="{{$data->userDetail->email}}" id="email" name="email" type="email" class="form-control" placeholder="Enter Email" aria-label="Email">
                            </div>
                            <div class="col">
                                <label for="password">Password</label>
                                <input value="" name="password" id="password"  type="password" class="form-control" placeholder="Enter Password" aria-label="" autocomplete="off">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="experience">Experience</label>
                                <input value="{{$data->experience}}" id="experience" name="experience" type="text" class="form-control" placeholder="Experience" aria-label="Email">
                            </div>
                            <div class="col">
                                <label for="specialization">Specialization</label>
                                <input value="{{$data->specialization}}" name="specialization" id="specialization" name="text"  type="text" class="form-control" placeholder="Enter Doctor Specialization" aria-label="Last name">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="available_from">Available From</label>
                                <input value="{{$data->available_from}}" id="available_from" name="available_from" type="time" class="form-control" placeholder="Available From" aria-label="Email">
                            </div>
                            <div class="col">
                                <label for="available_to">Available To</label>
                                <input value="{{$data->specialization}}" id="available_to" name="available_to"  type="time" class="form-control" placeholder="Available To" aria-label="Last name">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <label for="phone">Phone</label>
                                <input id="phone" value="{{$data->userDetail->phone}}" name="phone" type="text" class="form-control" placeholder="" aria-label="Email">
                            </div>
                            
                        </div>

                        <input type="hidden" value="{{$data->userDetail->id}}" name="user_id">

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