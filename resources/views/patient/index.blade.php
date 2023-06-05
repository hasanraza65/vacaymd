@extends('layouts.layout')
@section('title','Vacay Web')
@section('content')
<?php
$dashboard=App\Http\Controllers\Patient\OrdersController::dashboard();
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
                                                    <img src="/src/assets/img/orders.png" alt="money-bag">
                                                </span>
                                            </div>

                                            <div class="balance-info">
                                                <h6>My Total Orders</h6>
                                                <p>{{$dashboard['orders']}}</p>
                                            </div>
                                        </div>

                                        <div class="card-bottom-section">
                                            <a href="/patient/orders" class="">All Orders</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--- CARD 1 END --->

                        <!--- CARD 2 START --->

                        <!---

                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-card-five">
                                <div class="widget-content">
                                    <div class="account-box">

                                        <div class="info-box">
                                            <div class="icon">
                                                <span>
                                                    <img src="/src/assets/img/patients.png" alt="money-bag">
                                                </span>
                                            </div>

                                            <div class="balance-info">
                                                <h6>Total Patients</h6>
                                                <p>40</p>
                                            </div>
                                        </div>

                                        <div class="card-bottom-section">
                                            <a href="javascript:void(0);" class="">All Patients</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        -->

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