@extends('layouts.layout')
@section('title','Create Order')

@section('content')

        <div class="middle-content container-xxl p-0 mb-4">

            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/users">Patient Orders</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
                    <!-- /BREADCRUMB -->
    
            <div class="row layout-top-spacing" id="cancel-row">

                <!--- form card start --->
                <div id="wizard_Default" class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Fill Up The Questionnaire</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <div class="bs-stepper stepper-form-one">
                                        <div class="bs-stepper-header stepsdiv" role="tablist">
                                            <div class="step" data-target="#defaultStep-one">
                                                <button type="button" class="step-trigger" role="tab" >
                                                    <span class="bs-stepper-circle">1</span>
                                                    <span class="bs-stepper-label">Step One</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#defaultStep-two">
                                                <button type="button" class="step-trigger" role="tab"  >
                                                    <span class="bs-stepper-circle">2</span>
                                                    <span class="bs-stepper-label">Step Two</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#defaultStep-three">
                                                <button type="button" class="step-trigger" role="tab"  >
                                                    <span class="bs-stepper-circle">3</span>
                                                    <span class="bs-stepper-label">
                                                        <span class="bs-stepper-title">Step Three</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        <form action="/patient/order" method="POST">
                                            @csrf
                                        <div class="bs-stepper-content">
                                        <div id="defaultStep-one" class="content" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="card clickable uticard" onclick="orderFormCondition('UTI')">
                                                        <div class="card-body text-center">
                                                            <h5 class="card-title">UTI</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card clickable edcard" onclick="orderFormCondition('ED')">
                                                        <div class="card-body text-center">
                                                            <h5 class="card-title">ED</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card clickable hangovercard" onclick="orderFormCondition('HANGOVER')">
                                                        <div class="card-body text-center">
                                                            <h5 class="card-title">HANGOVER</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-action mt-5">
                                                <button type="button" class="btn btn-secondary btn-prev me-3">Prev</button>
                                                <button type="button" class="btn btn-secondary btn-nxt" disabled='disabled'>Next</button>
                                            </div>
                                            </div> <!-- End of Step One -->
                                            <div id="defaultStep-two" class="content" role="tabpanel">
                                                
                                                <div class="uti_form d-none">
                                                @include('patient.orders.includes.uti_form')
                                                </div>

                                                <div class="ed_form d-none">
                                                @include('patient.orders.includes.ed_form')
                                                </div>

                                                <div class="hangover_form d-none">
                                                @include('patient.orders.includes.hangover_form')
                                                </div>
                                                
                                                <div class="button-action mt-5">
                                                    <button type="button" class="btn btn-secondary btn-prev me-3">Prev</button>
                                                    <button type="button" class="btn btn-secondary btn-nxt">Next</button>
                                                </div>
                                            </div>
                                            <div id="defaultStep-three" class="content" role="tabpanel" >
                                                    
                                                <div class="uti_terms d-none">
                                                @include('patient.orders.includes.uti_terms')
                                                </div>

                                                <div class="ed_terms d-none">
                                                @include('patient.orders.includes.ed_terms')
                                                </div>

                                                <div class="hangover_terms d-none">
                                                @include('patient.orders.includes.hangover_terms')
                                                </div>

                                                <div class="button-action mt-3">
                                                    <button class="btn btn-secondary btn-prev me-3">Prev</button>
                                                    <button type="submit" class="btn btn-success me-3">Proceed To Payment</button>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                <!--- form card ending --->
            </div>
        </div>

@endsection