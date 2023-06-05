@extends('layouts.layout')
@section('title','Edit Profile')

@section('content')

<div class="middle-content container-xxl p-0 mb-4">

            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
                    <!-- /BREADCRUMB -->
    
            <div class="account-settings-container layout-top-spacing">
                
                @include('layouts.includes.components.alert')

                <div class="account-content">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h2>Settings</h2>

                                    <ul class="nav nav-pills" id="animateLine" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="animated-underline-home-tab" data-bs-toggle="tab" href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Home</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="animated-underline-password-tab" data-bs-toggle="tab" href="#animated-underline-password" role="tab" aria-controls="animated-underline-password" aria-selected="false" tabindex="-1"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg> Password </button>
                                        </li>
                                        
                                        
                                    </ul>
                                </div>
                            </div>
    
                            <div class="tab-content" id="animateLineContent-4">
                                <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel" aria-labelledby="animated-underline-home-tab">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                        <form method="POST" action="/pharmacy/update-profile" enctype="multipart/form-data">


                                         @csrf
                                                <div class="info">
                                                    <h6 class="">General Information</h6>
                                                    <div class="row">
                                                        <div class="col-lg-11 mx-auto">
                                                            <div class="row">
                                                            <div class="col-xl-4 col-lg-12 col-md-4">
                                                                <div class="col-12 text-center myborder2">
                                                                              <?php
                                                                                $url='/src/assets/img/default_pic.webp';
                                                                                if($data->profile_pic!=null){
                                                                                  $url=$data->profile_pic;
                                                                                }
                                                                              ?>
                                                                             <label for="screen_shot" class="drop-container">
                                                                             <img id="myimage" src="<?=$url?>" alt="your image" />
                                                                             <div class="upload-wrapper">
  <input type="file" name="file" id="imgInp" class="form-control" accept="image/*">
  <label for="imgInp" id="uploadLabel">Upload picture</label>
</div> 
                                                                             <div id="progress-text"></div>
                                                                            </label>
									                            </div>
                                                                </div>
                                                                <div class="col-xl-8 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                                    <div class="form">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="fullName">Full Name</label>
                                                                                    <input type="text" class="form-control mb-3" name="name" value="{{$data->name}}" id="fullName" placeholder="Full Name" value="Jimmy Turner">
                                                                                </div>
                                                                            </div>
            
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="phone">Phone</label>
                                                                                    <input type="text" class="form-control mb-3"  name="phone" value="{{$data->phone}}" id="phone" placeholder="Write your phone number here" value="+1 (530) 555-12121">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="email">Email</label>
                                                                                    <input type="text" class="form-control mb-3 text-dark bg-light" readonly  value="{{$data->email}}" id="email" placeholder="Write your email here" value="Jimmy@gmail.com">
                                                                                </div>
                                                                            </div> 
                                                                            <!-- <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="website1">Password</label>
                                                                                    <input type="text" class="form-control mb-3"  name="password" value="" id="website1" placeholder="Password">
                                                                                </div>
                                                                            </div>                                    -->
                                                                            
    
                                                                            
    
                                                                            <div class="col-md-12 mt-1">
                                                                                <div class="form-group text-end">
                                                                                <input type="hidden" name="id" value="{{$data->id}}" id="">
                                                                                    <button class="btn btn-secondary">Save</button>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        
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








                                <!-- ////////////////////////////////////////////////  Password -->
                                <div class="tab-pane fade show  mb-4" id="animated-underline-password" role="tabpanel" aria-labelledby="animated-underline-password-tab">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                        <form method="POST" action="/pharmacy/update-password" enctype="multipart/form-data">


                                         @csrf
                                                <div class="info">
                                                    <h6 class="m-3 p-3">Update Password</h6>
                                                    <div class="row">
                                                        <div class="col-lg-11 mx-auto">
                                                            <div class="row">
                                                            
                                                                            
                                                                            
                                                                
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label for="website1">Old Password</label>
                                                                                    <input type="password" class="form-control mb-3" required  name="old_password" value="" id="website1" placeholder="Old Password">
                                                                                </div>
                                                                            </div> 
                                                                            
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label for="website1">New Password</label>
                                                                                    <input type="password" class="form-control mb-3" required  name="new_password" value="" id="website1" placeholder="New Password">
                                                                                </div>
                                                                            </div> 
                                                                            
    
                                                                            
    
                                                                            <div class="col-12 mt-1 mb-4">
                                                                                <div class="form-group text-end">
                                                                                <input type="hidden" name="id" value="{{$data->id}}" id="">
                                                                                    <button class="btn btn-secondary">Save</button>
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


                                <!-- Profile End AND  -->
                               
    
                                
                            </div>
                            
                        </div>


            </div>
</div>


@endsection