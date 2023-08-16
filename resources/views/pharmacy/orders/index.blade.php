@extends('layouts.layout')
@section('title','Orders')

@section('content')
                
                <div class="middle-content container-xxl p-0">

                    <!-- BREADCRUMB -->
                    <div class="page-meta">
                        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Patient Orders</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Orders</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- /BREADCRUMB -->
    
                    <div class="row layout-top-spacing">

                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <button onclick="changeData('latest_orders','new-orders-btn')" class="new-orders-btn btn btn-primary btn-rounded mb-2 me-4 w-100">New Orders</button>
                                </div>
                                <div class="col-md-4">
                                    <button onclick="changeData('in_process','in-process-orders-btn')" class="in-process-orders-btn btn btn-outline-info btn-rounded mb-2 me-4 w-100">In Process</button>
                                </div>

                                <div class="col-md-4">
                                    <button onclick="changeData('completed_orders','completed-orders-btn')" class="completed-orders-btn btn btn-outline-success btn-rounded mb-2 me-4 w-100">Completed</button>
                                </div>
                            </div>

                            @include('pharmacy.orders.includes.filters')

                            <div class="widget-content widget-content-area br-8 latest_orders">
                                <table id="" class="table dt-table-hover html5-extension" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="d-none">ID</th>
                                            <th>Order ID</th>
                                            <th>Patient Name</th>
                                            <th>Patient Email</th>
                                            <th>Billing Address</th>
                                            <th>Dilvery Location</th>
                                            <th>Payment Status</th>
                                            <th>Patient DOB</th>
                                            <th>Age</th>
                                            <th>Date</th>
                                            <th class="no-content">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <!--- Latest orders --->
                                    <tbody>
                                        @foreach($data as $datas)
                                        <tr id="row_{{$datas->id}}">
                                            <td class="d-none">{{$datas->id}}</td>
                                            <td class="action_btn" onclick="window.location ='/pharmacy/orders/{{$datas->id}}'">{{$datas->order_num}}</td>
                                            <td class="action_btn" onclick="window.location ='/pharmacy/orders/{{$datas->id}}'">{{$datas->userDetail->name}}</td>
                                            <td>{{$datas->userDetail->email}}</td>
                                            <td>{{$datas->billing_address}}</td>
                                            <td>{{$datas->delivery_location}}</td>
                                            <td>
                                                @if($datas->payment_status == 1)
                                                <span class="badge badge-light-success mb-2 me-4">Paid</span>
                                                @elseif($datas->payment_status == 0)
                                                <span class="badge badge-light-danger mb-2 me-4">Unpaid</span>
                                                @elseif($datas->payment_status == 2)
                                                <span class="badge badge-light-warning mb-2 me-4">Refunded</span>
                                                @endif

                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($datas->userDetail->dob)->format('m/d/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($datas->userDetail?->dob)->age }} year</td>
                                            <td>{{ \Carbon\Carbon::parse($datas->created_at)->format('m/d/Y') }}</td>
                                            <td class="">
                                                <a href="/pharmacy/orders/{{$datas->id}}" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Show" data-bs-original-title="Show" aria-label="Show"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye p-1 br-8 mb-1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                                                </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <!---Ending Latest orders --->
                                    </table>
                                    
                                </div>


                                <div class="widget-content widget-content-area br-8 in_process d-none">

                                    <!--- Assigned To Me orders --->
                                    <table id="" class="table dt-table-hover html5-extension" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="d-none">ID</th>
                                            <th>Order ID</th>
                                            <th>Patient Name</th>
                                            <th>Patient Email</th>
                                            <th>Billing Address</th>
                                            <th>Dilvery Location</th>
                                            <th>Payment Status</th>
                                            <th>Patient DOB</th>
                                            <th>Age</th>
                                            <th>Date</th>
                                            <th class="no-content">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($processing as $datas)
                                        <tr id="row_{{$datas->id}}">
                                            <td class="d-none">{{$datas->id}}</td>
                                            <td class="action_btn" onclick="window.location ='/pharmacy/orders/{{$datas->id}}'">{{$datas->order_num}}</td>
                                            <td class="action_btn" onclick="window.location ='/pharmacy/orders/{{$datas->id}}'">{{$datas->userDetail->name}}</td>
                                            <td>{{$datas->userDetail->email}}</td>
                                            <td>{{$datas->billing_address}}</td>
                                            <td>{{$datas->delivery_location}}</td>
                                            <td>
                                                @if($datas->payment_status == 1)
                                                <span class="badge badge-light-success mb-2 me-4">Paid</span>
                                                @elseif($datas->payment_status == 0)
                                                <span class="badge badge-light-danger mb-2 me-4">Unpaid</span>
                                                @elseif($datas->payment_status == 2)
                                                <span class="badge badge-light-warning mb-2 me-4">Refunded</span>
                                                @endif

                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($datas->userDetail->dob)->format('m/d/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($datas->userDetail?->dob)->age }} year</td>
                                            <td>{{ \Carbon\Carbon::parse($datas->created_at)->format('m/d/Y') }}</td>
                                            <td class="">
                                                <a href="/pharmacy/orders/{{$datas->id}}" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Show" data-bs-original-title="Show" aria-label="Show"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye p-1 br-8 mb-1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                                                </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                    <!---Ending Assigned orders --->
                                    
                                </div>

                                <div class="widget-content widget-content-area br-8 completed_orders d-none">
                                    <!--- Completed orders --->
                                    <table id="" class="table dt-table-hover html5-extension" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="d-none">ID</th>
                                            <th>Order ID</th>
                                            <th>Patient Name</th>
                                            <th>Patient Email</th>
                                            <th>Billing Address</th>
                                            <th>Dilvery Location</th>
                                            <th>Payment Status</th>
                                            <th>Patient DOB</th>
                                            <th>Age</th>
                                            <th>Date</th>
                                            <th class="no-content">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($completed as $datas)
                                        <tr id="row_{{$datas->id}}">
                                            <td class="d-none">{{$datas->id}}</td>
                                            <td class="action_btn" onclick="window.location ='/pharmacy/orders/{{$datas->id}}'">{{$datas->order_num}}</td>
                                            <td class="action_btn" onclick="window.location ='/pharmacy/orders/{{$datas->id}}'">{{$datas->userDetail->name}}</td>
                                            <td>{{$datas->userDetail->email}}</td>
                                            <td>{{$datas->billing_address}}</td>
                                            <td>{{$datas->delivery_location}}</td>
                                            <td>
                                                @if($datas->payment_status == 1)
                                                <span class="badge badge-light-success mb-2 me-4">Paid</span>
                                                @elseif($datas->payment_status == 0)
                                                <span class="badge badge-light-danger mb-2 me-4">Unpaid</span>
                                                @elseif($datas->payment_status == 2)
                                                <span class="badge badge-light-warning mb-2 me-4">Refunded</span>
                                                @endif

                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($datas->userDetail->dob)->format('m/d/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($datas->userDetail?->dob)->age }} year</td>
                                            <td>{{ \Carbon\Carbon::parse($datas->created_at)->format('m/d/Y') }}</td>
                                            <td class="">
                                                <a href="/pharmacy/orders/{{$datas->id}}" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Show" data-bs-original-title="Show" aria-label="Show"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye p-1 br-8 mb-1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                                                </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                    <!---Ending Completed orders --->
                                    
                                </div>
                            </div>
    
                        </div> 
                    </div>

<script>

        $(document).ready(function() {
            // Trigger the click event for the button with ID 'myButton'
            var classname = $('#active_tab').val();
            var btnclass = $('#active_btn').val();

            changeData(classname,btnclass);
        });
  

    function changeData(className,btnClass){

            $('.new-orders-btn').removeClass('btn-primary');
            $('.in-process-orders-btn').removeClass('btn-info');
            $('.completed-orders-btn').removeClass('btn-success');

            $('.new-orders-btn').addClass('btn-outline-primary');
            $('.in-process-orders-btn').addClass('btn-outline-info');
            $('.completed-orders-btn').addClass('btn-outline-success');

            $('.latest_orders').addClass('d-none');
            $('.in_process').addClass('d-none');
            $('.completed_orders').addClass('d-none');

            $('.'+className).removeClass('d-none');

            if(btnClass == 'new-orders-btn'){

                $('.'+btnClass).removeClass('btn-outline-primary');
                $('.'+btnClass).addClass('btn-primary');

            }else if(btnClass == 'in-process-orders-btn'){

                $('.'+btnClass).removeClass('btn-outline-info');
                $('.'+btnClass).addClass('btn-info');

            }else if(btnClass == 'completed-orders-btn'){

                $('.'+btnClass).removeClass('btn-outline-success');
                $('.'+btnClass).addClass('btn-success');

            }

            $('#active_tab').val(className);
            $('#active_btn').val(btnClass);

    }

</script>

@endsection