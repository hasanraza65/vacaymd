@extends('layouts.layout')
@section('title','Vacay Web')
@section('content')

<?php
$dashboard=App\Http\Controllers\Admin\UserController::dashboard();
?>
<div class="middle-content container-xxl p-0">

                    <div class="row layout-top-spacing">

                        <!--- CARD 1 START --->

                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-card-five">
                                <div class="widget-content">
                                    <div class="account-box">

                                        <div class="info-box">
                                            <div class="icon">
                                                <span>
                                                    <img src="/src/assets/img/all-orders.png" alt="money-bag">
                                                </span>
                                            </div>

                                            <div class="balance-info">
                                                <h6>Total Orders</h6>
                                                <p>{{$dashboard['orders']}}</p>
                                            </div>
                                        </div>

                                        <div class="card-bottom-section">
                                            <a href="/admin/orders" class="">All Orders</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-card-five">
                                <div class="widget-content">
                                    <div class="account-box">

                                        <div class="info-box">
                                            <div class="icon">
                                                <span>
                                                    <img src="/src/assets/img/orders.png" alt="money-bag">
                                                </span>
                                            </div>

                                            <div class="balance-info">
                                                <h6>Total Open Orders</h6>
                                                <p>{{$dashboard['orders_open']}}</p>
                                            </div>
                                        </div>

                                        <div class="card-bottom-section">
                                            <a href="/admin/orders?assigned_to=null" class="">Total Open Orders</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-card-five">
                                <div class="widget-content">
                                    <div class="account-box">

                                        <div class="info-box">
                                            <div class="icon">
                                                <span>
                                                    <img src="/src/assets/img/completed-orders.svg" alt="money-bag">
                                                </span>
                                            </div>

                                            <div class="balance-info">
                                                <h6>Total Completed Orders</h6>
                                                <p>{{$dashboard['orders_completed']}}</p>
                                            </div>
                                        </div>

                                        <div class="card-bottom-section">
                                            <a href="/admin/orders?status=Completed" class="">Total Completed Orders</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-card-five">
                                <div class="widget-content">
                                    <div class="account-box">

                                        <div class="info-box">
                                            <div class="icon">
                                                <span>
                                                    <img src="/src/assets/img/cancelled-orders.svg" alt="money-bag">
                                                </span>
                                            </div>

                                            <div class="balance-info">
                                                <h6>Total Cancelled Orders</h6>
                                                <p>{{$dashboard['orders_cancelled']}}</p>
                                            </div>
                                        </div>

                                        <div class="card-bottom-section">
                                            <a href="/admin/orders?status=Cancelled" class="">Total Cancelled Orders</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-card-five">
                                <div class="widget-content">
                                    <div class="account-box">

                                        <div class="info-box">
                                            <div class="icon">
                                                <span>
                                                    <img src="/src/assets/img/dispensed.svg" alt="money-bag">
                                                </span>
                                            </div>

                                            <div class="balance-info">
                                                <h6>Total Dispensed Orders</h6>
                                                <p>{{$dashboard['orders_dispensed']}}</p>
                                            </div>
                                        </div>

                                        <div class="card-bottom-section">
                                            <a href="/admin/orders?status=Dispensed" class="">Total Dispensed Orders</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--- CARD 1 END --->

                        <!--- CARD 2 START --->

                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-card-five">
                                <div class="widget-content">
                                    <div class="account-box">

                                        <div class="info-box">
                                            <div class="icon">
                                                <span>
                                                    <img src="/src/assets/img/patient.svg" alt="money-bag">
                                                </span>
                                            </div>

                                            <div class="balance-info">
                                                <h6>Total Patients</h6>
                                                <p>{{$dashboard['patients']}}</p>
                                            </div>
                                        </div>

                                        <div class="card-bottom-section">
                                            <a href="/admin/patients" class="">All Patients</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-card-five">
                                <div class="widget-content">
                                    <div class="account-box">

                                        <div class="info-box">
                                            <div class="icon">
                                                <span>
                                                    <img src="/src/assets/img/doctor.svg" alt="money-bag">
                                                </span>
                                            </div>

                                            <div class="balance-info">
                                                <h6>Total Doctors</h6>
                                                <p>{{$dashboard['doctors']}}</p>
                                            </div>
                                        </div>

                                        <div class="card-bottom-section">
                                            <a href="/admin/doctors" class="">All Doctors</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--- CARD 2 END --->

                        <!--- CARD 3 START --->

                        <!----

                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-card-five">
                                <div class="widget-content">
                                    <div class="account-box">

                                        <div class="info-box">
                                            <div class="icon">
                                                <span>
                                                    <img src="../src/assets/img/money-bag.png" alt="money-bag">
                                                </span>
                                            </div>

                                            <div class="balance-info">
                                                <h6>Total Balance</h6>
                                                <p>$41,741.42</p>
                                            </div>
                                        </div>

                                        <div class="card-bottom-section">
                                            <div><span class="badge badge-light-success">+ 13.6% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg></span></div>
                                            <a href="javascript:void(0);" class="">View Report</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        --->
                        <!--- CARD 3 END --->

                        

                    </div>

                </div>

            </div>
@endsection