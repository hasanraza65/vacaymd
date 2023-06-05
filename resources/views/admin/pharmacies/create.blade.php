@extends('layouts.layout')
@section('title','Create Pharmacy')

@section('content')

        <div class="middle-content container-xxl p-0 mb-4">

            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/pharmacies">Pharmacy</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
                    <!-- /BREADCRUMB -->
    
            <div class="row layout-top-spacing">

            @include('layouts.includes.components.alert')

                <!--- form card start --->
                <div class="card p-4">

                    <form method="POST" action="/admin/pharmacies">

                        @csrf

                        <div class="mt-2">
                            <label for="name">Pharmacy Name</label>
                            <input type="text" id="name" placeholder="Enter pharmacy name" name="pharmacy_name" class="form-control">
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="name">Pharmacy Phone #</label>
                                <input type="text"  id="name" placeholder="Enter pharmacy phone" name="pharmacy_phone" class="form-control">
                            </div>
                            <div class="col">
                                <div class="col">
                                    <label for="name">Pharmacy Address</label>
                                    <input type="text" id="name" placeholder="Enter pharmacy address" name="pharmacy_address" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="name">Choose Pharmacy Manager</label>
                            <select class="form-select" name="manager_id">
                                @foreach($users as $userss)
                                <option value="{{$userss->id}}">{{$userss->name}}</option>
                                @endforeach
                            </select>
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
            // Function to get the value of a query parameter from the URL
            function getQueryParam(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
            }

            // Get the value from the URL using the GET method
            const selectedValue = getQueryParam('selected_role');

            // Compare the value with the options and select the matched option
            if (selectedValue) {
            $('#user_role').val(selectedValue);
            }
        });
    </script>

@endsection