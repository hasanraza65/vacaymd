@extends('layouts.layout')
@section('title','Order Detail')

@section('content')
                
<style>
    
</style>
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

                            <div class="col-md-3">
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
                                @elseif($data->order_status == 'Completed')
                                <span style="font-size: 17px" class="badge badge-light-success mt-4 mb-1">{{$data->order_status}}</span>
                                @elseif($data->order_status == 'Approved')
                                <span style="font-size: 17px" class="badge badge-light-success mt-4 mb-1">{{$data->order_status}}</span>
                                @elseif($data->order_status == 'In Process')
                                <span style="font-size: 17px" class="badge badge-light-info mt-4 mb-1">{{$data->order_status}}</span>
                                @elseif($data->order_status == 'Cancelled' || $data->order_status == 'Rejected')
                                <span style="font-size: 17px" class="badge badge-light-danger mt-4 mb-1">{{$data->order_status}}</span>
                               
                                @elseif($data->order_status == 'Delivered' || $data->order_status == 'Delivered')
                                <span style="font-size: 17px" class="badge badge-light-success mt-4 mb-1">Dispensed</span>
                                @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="widget-content widget-content-area br-8 p-4 mb-2">

                                    <b>Update Status</b><br>

                                    @if($data->order_status == null || $data->order_status == "" || $data->order_status == "Pending")
                                    <div class="mt-4 row">
                                        <div class="col-md-6">
                                            <form id="approve-form" action="/doctor/update_order_status" method="POST">
                                            @csrf
                                                <input type="hidden" name="confirm_patient_id" value="off" id="confirm_patient_id">
                                                <input type="hidden" value="Approved" name="order_status">
                                                <input type="hidden" name="order_id" value="{{$data->id}}">
                                                <button onclick="approveAlert()" type="button" class="btn btn-success w-100 mx-sm-2">Approve</button> 
                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <form id="reject-form" action="/doctor/update_order_status" method="POST">
                                                @csrf
                                                <input type="hidden" value="Rejected" name="order_status">
                                                <input type="hidden" name="order_id" value="{{$data->id}}">
                                                <button type="button" onclick="rejectAlert()" class="btn btn-danger w-100 mx-sm-2">Reject</button> 
                                            </form>
                                        </div>

                                    </div>
                                    @else 

                                    @if($data->order_status != 'Cancelled')
                                    <form action="/doctor/update_order_status" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{$data->id}}">
                                    <div class="input-group mt-2 mb-1">
                                        <select class="form-select" name="order_status" id="orderstatus_select">
                                            <option value="In Process" {{ ($data->order_status == 'In Process') ? 'selected' : '' }}>In Process</option>
                                            <option value="Pending" {{ ($data->order_status == 'Pending') ? 'selected' : '' }}>Pending</option>
                                            <option value="Completed" {{ ($data->order_status == 'Completed') ? 'selected' : '' }}>Completed</option>
                                            <option value="Cancelled" {{ ($data->order_status == 'Cancelled') ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <button class="btn btn-primary " type="submit" id="button-addon2">Update</button>
                                    </div>

                                    </form>
                                    @else 
                                    <br>
                                    <span class="mt-2">Order has been closed. <br>Status cannot be changed now.</span>
                                    @endif

                                    @endif

                                    
                                </div>
                            </div>

                            <!--- send to pharmacy section --->
                            <div class="col-md-3">
                                <div class="widget-content widget-content-area br-8 p-4 mb-2">
 
                                        <input type="hidden" name="order_id" value="{{$data->id}}">
                                    @csrf

                                    <b>Send To Pharmacy</b><br>

                                    @if($data->order_status == 'Approved')
                                    <div class="input-group  mt-3">
                                        @if($data->pharmacy_id == null)
                                        <button data-bs-toggle="modal" data-bs-target="#sendToPharmacyModal" class="btn btn-primary mb-2" type="button" id="button-addon2">Send To Pharmacy</button>
                                        @else 
                                        <button data-bs-toggle="modal" data-bs-target="#sendToPharmacyModal" class="btn btn-info mb-2" type="button" id="button-addon2">Update Pharmacy Sent Data</button>
                                        @endif
                                    </div>
                                    @else
                                    <button disabled data-bs-toggle="modal" data-bs-target="#sendToPharmacyModal" class="btn btn-primary" type="button" id="button-addon2">Send To Pharmacy</button><br>
                                    <span style="font-size:11px; font-style:italic" class="text-danger">Please approve the order first.</span><br>
                                    @endif


                                </div>
                            </div> 
                            <!--- ending send to pharmacy section --->
                      
                            <!--- send to pharmacy section --->
                            <div class="col-12 justify-content-center text-center">
                                <div class="widget-content justify-content-center widget-content-area">
                                <b>Drivers license or passport</b><br>
                                        <?php
                                        $p_url='/src/assets/img/default-image.jpg'; 
                                        ?>
                                        @if($passports->count()>0)
                                        @foreach($passports as $pass)
                                        <?php
                                        $p_url=$pass->passport_pic;
                                        ?>

                                       <img disabled data-bs-toggle="modal" data-bs-target="#passport" class="rounded m-1" src="{{$p_url}}" alt="pic1" width="300px">
 
                                        @endforeach

                                        @else
                                        <img disabled data-bs-toggle="modal" data-bs-target="#passport" class="rounded m-1" src="{{$p_url}}" alt="pic1" width="300px">
                                        @endif
                                </div>
                            </div> 
                            <!--- ending send to pharmacy section --->

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
        <th>Delivery Location</th>
        <th>Patient DOB</th>
        <th>Age</th> <!-- Added column for Age -->
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
        <td>{{ \Carbon\Carbon::parse($data->userDetail->dob)->age }} year</td> <!-- Calculate and display age -->
        <td>${{number_format($data->total_amount,2)}}</td>
        <td>{{ \Carbon\Carbon::parse($data->created_at)->format('m/d/Y') }}</td>
    </tr>
</table>

                            </div>
                        </div>
                        @if($data->addons && $data->addons->count() > 0)

                        <div class="widget-content widget-content-area br-8 p-4 mb-2">
                            <b>Addons Medicines</b>
                            <div class="table-responsive mt-4">
                                <table class="table table-bordered">
                                    
                                    <tr>
                                            
                                            <th>Image view</th>
                                            <th>Item name</th>
                                            <th>Item description</th>
                                            
                                        
                                    </tr>
                                  
                                   
                                    @foreach($data->addons as $ao)
                                    
                                    <tr>
                                      
                                        <td><img width="60" height="auto" src="{{$ao?->itemDetail->thumbnail }}"></td>
                                        <td>{{$ao?->itemDetail->item_name }}</td>
                                        <td>{{$ao?->itemDetail->item_description }}</td>
                                       
                                        
                                       
                                    </tr>
                                    
                                      
                                       
                                    @endforeach
                                  

                                </table>
                            </div>
                        </div>
                        @endif

                        <div class="widget-content widget-content-area br-8 p-4 mb-2">
    <b>Questions & Answers</b>
    <div id="toggleAccordion" class="no-icons accordion">
        @foreach($data->orderDetail as $orderDetails)
            @if($orderDetails->value)
                <div class="card">
                    <div class="card-header" id="...">
                        <section class="mb-0 mt-0">
                            <div role="menu" class="" data-bs-target="#defaultAccordionOne_{{$orderDetails->id}}" aria-expanded="false" aria-controls="defaultAccordionOne_{{$orderDetails->id}}">
                                <strong>
                                    @php
                                        $question = Str::endsWith($orderDetails->key, 'free text')
                                            ? '<span style="color: red;">' . Str::replaceLast(' free text', '', $orderDetails->key) . '</span>'
                                            : $orderDetails->key;
                                    @endphp
                                    {!! $question !!}
                                </strong>
                                <div class="icons"><svg> ... </svg></div>
                            </div>
                        </section>
                    </div>

                    <div id="defaultAccordionOne_{{$orderDetails->id}}" aria-labelledby="..." data-bs-parent="#toggleAccordion">
                        <div class="card-body p-1 m-1">
                            <strong class="text-dark" style="font-size: 20px; margin: 0px !important;"><?php echo $orderDetails->value; ?></strong>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>


                        @include('doctor.orders.includes.chat')
                            
                            
                    </div>
    
                </div> 


<!--- send to pharmacy model ---> 

<!-- Modal -->
<div class="modal fade" id="sendToPharmacyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Send To Pharmacy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg> ... </svg>
                </button>
            </div>
            <form action="/doctor/send_to_pharmacy" method="POST">
                @csrf
                <input type="hidden" value="{{$data->id}}" name="order_id">
            <div class="modal-body">
                
                <div class="mt-2">
                    <label for="prescription">Choose Prescription</label>
                    <select id="prescription" class="form-select" name="prescription_id" required>
                        <option value="">Choose Prescription</option>
                        @foreach($prescriptions as $datas)
                        <option value="{{$datas->id}}" <?php if($datas->for_problem==$data->treatment_req){ echo 'selected';}?> {{ ($data->prescription_id == $datas->id) ? 'selected' : '' }}>{{$datas->prescription_name}} ({{$datas->for_problem}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4">
                    <label for="pharmacy">Choose Pharmacy</label>
                    <select id="pharmacy" class="form-select" name="pharmacy_id" required>
                       
                        @foreach($pharmacies as $datas)
                        <option value="{{$datas->id}}" {{ ($data->pharmacy_id == $datas->id) ? 'selected' : '' }}>{{$datas->pharmacy_name}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn btn-light-dark" data-bs-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--- ending modal --->



<div class="modal fade modal-lg" id="passport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Drivers license or passport</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg> ... </svg>
                </button>
            </div>
           
            <div class="modal-body">
                                       <?php
                                        $p_url='/src/assets/img/default-image.jpg'; 
                                        ?>
                                        @if($passports)
                                        @foreach($passports as $pass)
                                        <?php
                                        $p_url=$pass->passport_pic;
                                        ?>

                                          <img class="rounded" src="{{$p_url}}" alt="pic1" width="100%">
 
                                        @endforeach
                                        @endif
          
                

            </div>
            <div class="modal-footer">
                <button class="btn btn btn-light-dark" type="button" data-bs-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                
            </div>
           
        </div>
    </div>
</div>

<!--- ending modal --->


@endsection