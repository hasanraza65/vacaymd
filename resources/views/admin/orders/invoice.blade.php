@extends('layouts.layout')
@section('title','Invoice')

@section('content')

        <div class="middle-content container-xxl p-0 mb-4">

            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/patient/orders">Patient Orders</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Invoice</li>
                    </ol>
                </nav>
            </div>
                    <!-- /BREADCRUMB -->
    
            <div class="row layout-top-spacing" id="cancel-row">

                <!--- form card start --->
                <div id="wizard_Default" class="col-lg-12 layout-spacing">
                <div class="row invoice layout-top-spacing layout-spacing">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            
                            <div class="doc-container">
    
                                <div class="row">
    
                                    <div class="col-xl-9">
    
                                        <div class="invoice-container">
                                            <div class="invoice-inbox">
                                                
                                                <div id="ct" class="">
                                                    
                                                    <div class="invoice-00001">
                                                        <div class="content-section">
        
                                                            <div class="inv--head-section inv--detail-section">
                                                            
                                                                <div class="row">

                                                                    <div class="col-sm-6 col-12 mr-auto">
                                                                        <div class="d-flex">
                                                                        <div class="nav-logo">
                                                                           <div class="nav-item">
                    
                                                                                   <img width="50%" height="auto" src="/src/assets/logos/logo.png" class="" alt="logo">
                   
                                                                           </div>
                                                                         </div>
                                                                        </div>
                                                                        <p class="inv-street-addr mt-3">WacayMD</p>
                                                                        <p class="inv-email-address">notification@skvclients.com</p>
                                                                        <!-- <p class="inv-email-address">(120) 456 789</p> -->
                                                                    </div>
                                                                    
                                                                    <div class="col-sm-6 text-sm-end">
                                                                        <p class="inv-list-number mt-sm-3 pb-sm-2 mt-4"><span class="inv-title">Invoice : </span> <span class="inv-number">{{$data?->orderDetail?->order_num}}</span></p>
                                                                        <p class="inv-created-date mt-sm-5 mt-3"><span class="inv-title">Invoice Date : </span> <span class="inv-date">{{date('m/d/Y',strtotime($data?->orderDetail?->created_at))}}</span></p>
                                                                        <p class="inv-due-date"><span class="inv-title">TID : </span> <span class="inv-date">{{$data?->t_id}}</span></p>
                                                                    </div>                                                                
                                                                </div>
                                                                
                                                            </div>
        
                                                            <div class="inv--detail-section inv--customer-detail-section">
    
                                                                <div class="row">
        
                                                                    <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4 align-self-center">
                                                                        <p class="inv-to">Invoice To</p>
                                                                    </div>
    
                                                                    <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 align-self-center order-sm-0 order-1 text-sm-end mt-sm-0 mt-5">
                                                                        <h6 class=" inv-title">Invoice From</h6>
                                                                    </div>
                                                                    
                                                                    <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4">
                                                                        <p class="inv-customer-name">{{$data?->userDetail?->name}}</p>
                                                                        <p class="inv-street-addr">{{$data?->userDetail?->city}}</p>
                                                                        <p class="inv-email-address">{{$data?->userDetail?->email}}</p>
                                                                        <p class="inv-email-address">{{$data?->userDetail?->phone}}</p>
                                                                    </div>
                                                                    
                                                                    <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12 order-sm-0 order-1 text-sm-end">
                                                                        <p class="inv-customer-name">WacayMD</p>
                                                                        <!-- <p class="inv-street-addr">2161 Ferrell Street, MN, 56545 </p> -->
                                                                        <p class="inv-email-address">notification@skvclients.com</p>
                                                                        <!-- <p class="inv-email-address">(218) 356 9954</p> -->
                                                                    </div>
    
                                                                </div>
                                                                
                                                            </div>
    
                                                            <div class="inv--product-table-section">
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <thead class="">
                                                                            <tr>
                                                                                <th scope="col">S.No</th>
                                                                                <th scope="col">Treatment</th>
                                                                                <th class="text-end" scope="col">Method</th>
                                                                                <th class="text-end" scope="col">Amount</th>
                                                                               
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>1</td>
                                                                                <td>{{$data?->orderDetail?->treatment_req}}</td>
                                                                                <td class="text-end">{{$data?->method}}</td>
                                                                                <td class="text-end">{{number_format($data?->amount,2)}}</td>
                                                                                
                                                                            </tr>
                                                                           
                                                                            
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="inv--total-amounts">
                                                            
                                                                <div class="row mt-4">
                                                                    <div class="col-sm-5 col-12 order-sm-0 order-1">
                                                                    </div>
                                                                    <div class="col-sm-7 col-12 order-sm-1 order-0">
                                                                        <div class="text-sm-end">
                                                                            <div class="row">
                                                                                <div class="col-sm-8 col-7">
                                                                                    <p class="">Sub Total :</p>
                                                                                </div>
                                                                                <div class="col-sm-4 col-5">
                                                                                    <p class="">$ {{number_format($data?->amount,2)}}</p>
                                                                                </div>
                                                                                <div class="col-sm-8 col-7">
                                                                                    <p class="">Tax :</p>
                                                                                </div>
                                                                                <div class="col-sm-4 col-5">
                                                                                    <p class="">$ 0.00</p>
                                                                                </div>
                                                                                <div class="col-sm-8 col-7">
                                                                                    <p class=" discount-rate">Shipping :</p>
                                                                                </div>
                                                                                <div class="col-sm-4 col-5">
                                                                                    <p class="">$ 0.00</p>
                                                                                </div>
                                                                                <div class="col-sm-8 col-7">
                                                                                    <p class=" discount-rate">Discount:</p>
                                                                                </div>
                                                                                <div class="col-sm-4 col-5">
                                                                                    <p class="">$ 0.00</p>
                                                                                </div>
                                                                                <div class="col-sm-8 col-7 grand-total-title mt-3">
                                                                                    <h4 class="">Grand Total : </h4>
                                                                                </div>
                                                                                <div class="col-sm-4 col-5 grand-total-amount mt-3">
                                                                                    <h4 class="">$ 0.00</h4>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
    
                                                            </div>
    
                                                            <div class="inv--note">
    
                                                                <div class="row mt-4">
                                                                    <div class="col-sm-12 col-12 order-sm-0 order-1">
                                                                        <p>Note: Thank you for doing Business with us.</p>
                                                                    </div>
                                                                </div>
    
                                                            </div>
        
                                                        </div>
                                                    </div> 
                                                    
                                                </div>
        
        
                                            </div>
        
                                        </div>
    
                                    </div>
    
                                    <div class="col-xl-3">
    
                                        <div class="invoice-actions-btn">
    
                                            <div class="invoice-action-btn">

                                                <div class="row">
                                                    <!-- <div class="col-xl-12 col-md-3 col-sm-6">
                                                        <a href="javascript:void(0);" class="btn btn-primary btn-send">Send Invoice</a>
                                                    </div> -->
                                                    <div class="col-xl-12 col-md-3 col-sm-6">
                                                        <a href="javascript:void(0);" class="btn btn-secondary btn-print  action-print">Print</a>
                                                    </div>
                                                    <!-- <div class="col-xl-12 col-md-3 col-sm-6">
                                                        <a href="javascript:void(0);" class="btn btn-success btn-download">Download</a>
                                                    </div>
                                                    <div class="col-xl-12 col-md-3 col-sm-6">
                                                        <a href="./app-invoice-edit.html" class="btn btn-dark btn-edit">Edit</a>
                                                    </div> -->
                                                </div>

                                            </div>
                                            
                                        </div>
                                        
                                    </div>
    
                                </div>
                                
                            </div>
    
                        </div>
                    </div>
                        </div>
                <!--- form card ending --->
            </div>
        </div>

@endsection