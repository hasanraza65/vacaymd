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

                            <div class="col-md-3">
                                <div class="widget-content widget-content-area br-8 p-4 mb-2">
                                <b>Current Location</b><br>
                                @if($data->state ==$data->selected_state_name && $data->reached_nevada == 1)   
                                <span style="font-size: 17px" class="badge badge-light-success mt-4 mb-1">Reached {{$data->selected_state_name}}</span>
                                @elseif($data->reached_nevada == 0 && $data->state == $data->selected_state_name)
                                <span style="font-size: 17px" class="badge badge-light-success mt-4 mb-1">{{$data->selected_state_name}}</span>
                                @else
                                <span style="font-size: 17px" class="badge badge-light-warning mt-4 mb-1">Coming to {{$data->selected_state_name}}</span>
                                @endif
                               
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
                                @elseif($data->order_status == 'Delivered' || $data->order_status == 'Delivered')
                                <span style="font-size: 17px" class="badge badge-light-success mt-4 mb-1">Dispensed</span>
                                @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="widget-content widget-content-area br-8 p-4 mb-2">
                                    <form action="/admin/update_order_status" method="post">
                                        <input type="hidden" name="order_id" value="{{$data->id}}">
                                    @csrf

                                    <b>Prescription</b>
                                    <div class="input-group  mt-3">
                                    @if(isset($data->prescriptionDetailImg))
                                      @if(isset($data->prescriptionDetailImg->prescription_image))
                                       <a download="{{$data->prescriptionDetailImg->prescription_image}}"  class="btn btn-primary mb-2" type="button" href="{{$data->prescriptionDetailImg->prescription_image}}" title="ImageName">Download</a>
                                      @endif
                                   @else
                                    <?php $default_presscription='';?>
                                   
                                     @foreach($prescriptions as $datas)
                                     <?php if($datas->for_problem==$data->treatment_req){ $default_presscription=$datas->prescription_image;}?>
                                     @endforeach
                                       
                                       <a download="{{$default_presscription}}"  class="btn btn-primary mb-2" type="button" href="{{$default_presscription}}" title="ImageName">Download</a>

                                    @endif
                                        <!-- <button data-bs-toggle="modal" data-bs-target="#prescriptionModal" class="btn btn-primary mb-2" type="button" id="button-addon2">View Prescription</button> -->
                                    </div>

                                    </form>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="widget-content widget-content-area br-8 p-4 mb-2">


                                    <b>Update Status</b>
                                    <form action="/pharmacy/update_order_status" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{$data->id}}">
                                    <div class="input-group mt-2 mb-1">
                                        <select class="form-select" name="order_status" required>
                                            
                                            <option value="">Select Status</option>
                                            <option value="Delivered" {{ ($data->order_status == 'Delivered') ? 'selected' : '' }}>Dispensed</option>
                                            <option value="Cancelled" {{ ($data->order_status == 'Cancelled') ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <button class="btn btn-primary " type="submit" id="button-addon2">Update</button>
                                    </div>

                                    </form>
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
                                        <th>Treatment Required</th>
                                        <th>Patient Name</th>
                                        <th>Patient Email</th>
                                        <th>Billing Address</th>
                                        <th>Delivery Location</th>
                                        <th>Patient Age</th>
                                        <th>Age</th>
                                        <th>Bill Amount</th>
                                        <th>Date</th>
                                    </tr>
                                    <tr>
                                        <td>{{$data->order_num}}</td>
                                        <td>{{$data->treatment_req}}</td>
                                        <td>{{$data->userDetail->name}}</td>
                                        <td>{{$data->userDetail->email}}</td>
                                        <td>{{$data->billing_address}}</td>
                                        <td>{{$data->delivery_location}}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->userDetail->dob)->format('m/d/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->userDetail?->dob)->age }} year</td>
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
                        <!--- questions table ---> 

                        <!---

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
                                        <td>{{$orderDetails->value}}</td>
                                    </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div> --->

                        <!--- ending question table --->
                            
                            
                    </div>
    
                </div> 


<!--- send to pharmacy model ---> 

<!-- Modal -->
<div class="modal fade" id="prescriptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Prescription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg> ... </svg>
                </button>
            </div>

            <div class="modal-body">
                
                
            <div class="table-responsive">
                <?php $now_show=0;?>
            @foreach($data->prescriptionDetail as $prescriptionDetails)
                        @foreach($prescriptionDetails->prescriptionMedicines as $datas)
                          <?php $now_show++;?>
                        @endforeach
            @endforeach
                @if($now_show>0)
                <table class="table table-bordered">
           
                          
                        
                    <thead>
                        
                        <tr>
                            <th scope="col">Medicine Name</th>
                            <th scope="col">Consumption Times</th>
                            <th class="text-center" scope="col">Total Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data->prescriptionDetail as $prescriptionDetails)
                        @foreach($prescriptionDetails->prescriptionMedicines as $datas)
                        <tr>
                            <td>{{$datas->medicine_name}}</td>
                            <td>
                                {{$datas->medicine_times}}
                            </td>
                            <td class="text-center">{{$datas->medicine_days}}</td>
                        </tr>
                        @endforeach
                        @endforeach
                        
                    </tbody>
                </table>

                @endif
                       @if(isset($data->prescriptionDetailImg->prescription_image))
                        <div class="row">
                           <div class="col-12">
                                <a download="{{$data->prescriptionDetailImg->prescription_image}}" class="btn btn-success m-4" href="{{$data->prescriptionDetailImg->prescription_image}}" title="ImageName">Download</a>
                            </div>
                        </div>
                        @endif
            </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn btn-light-dark" data-bs-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                <!---<button type="submit" class="btn btn-primary">Send</button> --->
            </div>

        </div>
    </div>
</div>

<!--- ending modal --->


@endsection