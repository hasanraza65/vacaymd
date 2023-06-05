@extends('layouts.layout')
@section('title','Edit Patient')

@section('content')

        <div class="middle-content container-xxl p-0 mb-4">

            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/patients">Patients</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
                    <!-- /BREADCRUMB -->
    
            <div class="row layout-top-spacing">
                
                @include('layouts.includes.components.alert')

                <!--- form card start --->
                <div class="card p-4">

                    <form method="POST" action="/admin/patients/{{$data->id}}">

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
                                <input value="" id="password" name="password"  type="password" class="form-control" placeholder="Enter Password" aria-label="Passowrd">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="city">City</label>
                                <input value="{{$data->city}}" id="city"  type="city" class="form-control" placeholder="Enter City" aria-label="City" name="city">
                            </div>
                            <div class="col">
                                <label for="phone">Phone</label>
                                <input value="{{$data->phone}}" id="phone"  type="phone" class="form-control" placeholder="Enter Phone" aria-label="Phone" name="phone">
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


@endsection