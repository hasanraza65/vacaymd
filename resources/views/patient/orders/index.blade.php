@extends('layouts.layout')
@section('title','My Orders')

@section('content')
                
                <div class="middle-content container-xxl p-0">

                    <!-- BREADCRUMB -->
                    <div class="page-meta">
                        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Patient Orders</a></li>
                                <li class="breadcrumb-item active" aria-current="page">My All Orders</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- /BREADCRUMB -->
    
                    <div class="row layout-top-spacing">

                    @include('layouts.includes.components.alert')

                            <div class="widget-content widget-content-area br-8">
                                <table id="html5-extension" class="table dt-table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="d-none">ID</th>
                                            <th>Order ID</th>
                                            <th>Bill Amount</th>
                                            <th>Date</th>
                                            <th>Payment Status</th>
                                            <th>Invoice</th>
                                            <th>Reorder</th>
                                            <th class="no-content">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach($data as $datas)
                                        
                                        <tr id="row_{{$datas->id}}">
                                            <td class="d-none">{{$datas->id}}</td>
                                            <td class="action_btn"  onclick="window.location ='/patient/orders/{{$datas->id}}'">{{$datas->order_num}}</td>
                                            <td class="action_btn"  onclick="window.location ='/patient/orders/{{$datas->id}}'">{{number_format($datas->total_amount,2)}}</td>
                                            <td>{{ \Carbon\Carbon::parse($datas->created_at)->format('m/d/Y') }}</td>
                                            <td>
                                                @if($datas->payment_status == 1)
                                                <span class="badge badge-light-success mb-2 me-4">Paid</span>
                                                @elseif($datas->payment_status == 0)
                                                <span class="badge badge-light-danger mb-2 me-4">Unpaid</span>
                                                @elseif($datas->payment_status == 2)
                                                <span class="badge badge-light-warning mb-2 me-4">Refunded</span>
                                                @endif

                                            </td>
                                            <td>
                                                @if($datas->payment_status != 0)
                                                <form action="/patient/invoice" method="post">
                                                    @csrf 
                                                    <input type="hidden" name="id" value="{{$datas->id}}" id="">
                                                    <input type="submit" name="" value="Invoice" class="form-control btn btn-outline-success" id="">
                                                </form> 
                                                @else 
                                                   
                                                @endif
                                            </td>
                                            <td>
                                                @if($datas->payment_status == 1)
                                                <a href="/steps?type={{strtolower($datas->treatment_req)}}" class="btn btn-primary">Reorder</a>
                                                <!---
                                                  <form action="/patient/re-order" method="post">
                                                    @csrf 
                                                    <input type="hidden" name="order_id" value="{{$datas->id}}" id="">
                                                  <button class="btn btn-primary">Reorder</button>
                                                  </form>
                                                --->
                                                @endif
                                            </td>
                                            <td class="">
                                                <a href="/patient/orders/{{$datas->id}}" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Show" data-bs-original-title="Show" aria-label="Show"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye p-1 br-8 mb-1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
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