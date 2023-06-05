@extends('layouts.layout')
@section('title','Order Detail')

@section('content')
                
                <div class="middle-content container-xxl p-0">

                    <!-- BREADCRUMB -->
                    <div class="page-meta">
                        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Patient Orders</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Order Detail</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- /BREADCRUMB -->
    
                    <div class="row layout-top-spacing">

                    @include('layouts.includes.components.alert')

                        <!--- status update section ---> 

                            <div class="col-md-4">
                                <div class="widget-content widget-content-area br-8 p-4 mb-2">
                                <b>Treatment Required</b><br>
                                <span style="font-size: 17px" class="badge badge-light-secondary mt-4 mb-1">{{$data->treatment_req}}</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="widget-content widget-content-area br-8 p-4 mb-2">
                                <b>Current Status</b><br>
                                @if($data->order_status == 'Pending')
                                <span style="font-size: 17px" class="badge badge-light-warning mt-4 mb-1">{{$data->order_status}}</span>
                                @elseif($data->order_status == 'Completed' || $data->order_status == 'Approved')
                                <span style="font-size: 17px" class="badge badge-light-success mt-4 mb-1">{{$data->order_status}}</span>
                                @elseif($data->order_status == 'In Process')
                                <span style="font-size: 17px" class="badge badge-light-info mt-4 mb-1">{{$data->order_status}}</span>
                                @elseif($data->order_status == 'Cancelled' || $data->order_status == 'Rejected')
                                <span style="font-size: 17px" class="badge badge-light-danger mt-4 mb-1">{{$data->order_status}}</span>
                                @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="widget-content widget-content-area br-8 p-4 mb-2">

                                    @if($data->state == 'Coming To Nevada' && $data->reached_nevada == 0)   
                                    <form action="/patient/update_location_status" method="post">
                                    <input type="hidden" name="order_id" value="{{$data->id}}">
                                    <input type="hidden" name="state" value="Nevada">
                                    @csrf

                                    <b>Update About Your Location</b>
                                    <div class="input-group  mt-3 mb-2">
                                        <button class="btn btn-primary" type="submit" id="button-addon2">I have reached Nevada</button>
                                    </div>

                                    </form>
                                    @elseif($data->state == 'Coming to Nevada' && $data->reached_nevada == 1)
                                    
                                    <b>Your Current Location</b>
                                    <div class="input-group">
                                        <span style="font-size: 17px" class="badge badge-light-primary mt-4 mb-1">Reached Nevada</span>
                                    </div>

                                    @else 
                                    <b>Your Current Location</b>
                                    <div class="input-group">
                                        <span style="font-size: 17px" class="badge badge-light-primary mt-4 mb-1">{{$data->state}}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <!--- ending status update section --->
                        
                        <div class="widget-content widget-content-area br-8 p-4 mb-2">
                            <b>Patient Details</b>
                            <div class="table-responsive mt-4">
                                <table class="table table-bordered">
                                    
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Patient Name</th>
                                        <th>Patient Email</th>
                                        <th>Billing Address</th>
                                        <th>Dilvery Location</th>
                                        <th>Patient DOB</th>
                                        <th>Bill Amount</th>
                                        <th>Date</th>
                                    </tr>
                                    <tr>
                                        <td>{{$data->order_num}}</td>
                                        <td>{{$data->userDetail->name}}</td>
                                        <td>{{$data->userDetail->email}}</td>
                                        <td>{{$data->billing_address}}</td>
                                        <td>{{$data->delivery_location}}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->userDetail->dob)->format('m/d/Y') }}</td>
                                        <td>${{$data->total_amount}}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->created_at)->format('m/d/Y') }}</td>
                                    </tr>

                                </table>
                            </div>
                        </div>

                        <!--- questions table ---> 

                        <div class="widget-content widget-content-area br-8 p-4 mb-2">
                            <b>Questions & Answers</b>
                            <div class="table-responsive mt-4">
                                <table class="table table-bordered">
                                    
                                    <tr>
                                        <th>Question</th>
                                        <th>Answer</th>
                                    </tr>
                                    @foreach($data->orderDetail as $orderDetails)
                                    <tr>
                                        <td>{{$orderDetails->key}}</td>
                                        <td><?php echo $orderDetails->value;?></td>
                                    </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>

                        <!--- ending question table --->

                        @include('patient.orders.includes.chat')
                            
                            
                    </div>
    
                </div> 


@endsection