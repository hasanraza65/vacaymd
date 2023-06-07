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

                            @include('admin.orders.includes.filters')

                            <div class="widget-content widget-content-area br-8">
                                <table id="html5-extension" class="table dt-table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="d-none">ID</th>
                                            <th>Order ID</th>
                                            <th>Patient Name</th>
                                            <th>Patient Email</th>
                                            <th>Billing Address</th>
                                            <th>Dilvery Location</th>
                                            <th>Patient DOB</th>
                                            <th>Bill Amount</th>
                                            <th>Payment Status</th>
                                            <th>Date</th>
                                            <th>Invoice</th>
                                            <th class="no-content">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         
                                        @foreach($data as $datas)
                                        <?php $bold_class='';
                                        
                                         if($datas->assigned_to==null || $datas->assigned_to==''){
                                            $bold_class='fw-bold';
                                         }
                                          
                                        ?>

                                        <tr id="row_{{$datas->id}}">
                                            <td class="d-none">{{$datas->id}}</td>
                                            <td class="{{$bold_class}} action_btn" onclick="window.location ='/admin/orders/{{$datas->id}}'">{{$datas->order_num}}</td>
                                            <td class="{{$bold_class}} action_btn"  onclick="window.location ='/admin/orders/{{$datas->id}}'">{{$datas->userDetail->name}}</td>
                                            <td class="{{$bold_class}}" >{{$datas->userDetail->email}}</td>
                                            <td class="{{$bold_class}}" >{{$datas->billing_address}}</td>
                                            <td class="{{$bold_class}}" >{{$datas->delivery_location}}</td>
                                            <td class="{{$bold_class}}" >{{ \Carbon\Carbon::parse($datas->userDetail->dob)->format('m/d/Y') }}</td>
                                            <td class="{{$bold_class}}" >${{number_format($datas->total_amount,2)}}</td>
                                            <td class="{{$bold_class}}" >@if($datas->payment_status == 1)
                                                Paid 
                                                @else 
                                                Unpaid
                                                @endif
                                            </td>
                                            <td {{$bold_class}}>{{ \Carbon\Carbon::parse($datas->created_at)->format('m/d/Y') }}</td>
                                            <td>
                                                @if($datas->payment_status == 1)
                                                <form action="/admin/invoice" method="post">
                                                    @csrf 
                                                    <input type="hidden" name="id" value="{{$datas->id}}" id="">
                                                    <input type="submit" name="" value="Invoice" class="form-control btn btn-outline-success" id="">
                                                </form> 
                                                @else 
                                                <span class="badge badge-light-danger mb-2 me-4">Unpaid</span>
                                                @endif
                                                
                                            </td>
                                            <td class="">
                                                <a href="/admin/orders/{{$datas->id}}" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Show" data-bs-original-title="Show" aria-label="Show"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye p-1 br-8 mb-1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                                                <a onclick="deleteFunction({{$datas->id}},'/admin/orders/{{$datas->id}}')" href="javascript:void(0);" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-original-title="Delete" data-bs-original-title="Delete" aria-label="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-8 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>
                                                </td>
                                        </tr>
                                        @endforeach
                                      
                                    </tbody>
                                    </table>
                                </div>
                            </div>
    
                        </div> 
                    </div>


@endsection