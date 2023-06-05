@extends('layouts.layout')
@section('title','Create Prescription')

@section('content')

        <div class="middle-content container-xxl p-0 mb-4">

            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/prescriptions">Prescription</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
                    <!-- /BREADCRUMB -->
    
            <div class="row layout-top-spacing">

            @include('layouts.includes.components.alert')

                <!--- form card start --->
                <div class="card p-4">

                    <form method="POST" action="/admin/prescriptions" enctype="multipart/form-data">

                        @csrf

                        <div class="row mt-2">
                            <div class="col">
                                <label for="name">Prescription Name</label>
                                <input type="text" id="name" placeholder="Enter prescription name" name="prescription_name" class="form-control">
                            </div>
                            <div class="col">
                                <div class="col">
                                    <label for="name">Problem For</label>
                                    <select class="form-select" name="for_problem">
                                        <option value="">Select problem</option>
                                        <option value="ED">ED</option>
                                        <option value="UTI">UTI</option>
                                        <option value="HANGOVER">HANGOVER</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!--- repeater div start ---> 
                        <div class="repeater mt-4">
                            <div class="medicine-row mt-4">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="medicine_name[]" placeholder="Medicine Name" />
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-select" name="medicine_times[]">
                                            <option value="">Select medicine times</option>
                                            <option value="Morning">Morning</option>
                                            <option value="Morning & Evening">Morning & Evening</option>
                                            <option value="Morning, Noon & Evening">Morning, Noon and Evening</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="medicine_days[]" placeholder="Medicine Days" />
                                    </div>
                                    <div class="col-md-2">
                                        <input style="height:100%" type="button" class="btn btn-danger remove-row" value="X" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="button" class="btn btn-secondary add-row mt-4" value="Add Medicine" />

                        <!--- repeater div end -->
                        <div class="mt-2">
                            <label for="prescription_image">Prescription File</label>
                            <input type="file" id="prescription_image" placeholder="Choose Prescription File" accept="image/*,.pdf" name="file" class="form-control">
                        </div>

                        <div class="mt-4">
                            <input type="submit" class="btn btn-primary">
                        </div>

                    </form>

                </div>
                <!--- form card ending --->

            </div>
        </div>


    <script>
        $(document).ready(function () {
            $('.add-row').on('click', function () {
        let newRow = $('.medicine-row:first').clone();
        newRow.find('input[type="text"]').val('');
        newRow.find('select').val('');
        newRow.appendTo('.repeater');
        });

        $(document).on('click', '.remove-row', function () {
            if ($('.medicine-row').length > 1) {
                $(this).closest('.medicine-row').remove();
            } else {
                alert('You cannot remove the last row.');
            }
            });
        });
    </script>


@endsection