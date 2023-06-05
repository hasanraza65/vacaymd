@extends('layouts.layout')
@section('title','Edit Upsale Medicine')

@section('content')

        <div class="middle-content container-xxl p-0 mb-4">

            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/upsaleitems">Upsale items</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
                    <!-- /BREADCRUMB -->
    
            <div class="row layout-top-spacing">

            @include('layouts.includes.components.alert')

                <!--- form card start --->
                <div class="card p-4">

                    <form method="POST" action="/admin/upsaleitems/{{$data->id}}" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="row mt-2">
                            <div class="col">
                                <div class="col">
                                    <label for="name">Treatment For</label><br>

                                    <div class="form-check form-check-primary form-check-inline">
                                        <input name="treatment[]" value="ED" class="form-check-input" type="checkbox" id="ED" {{ ($data->treatment == 'ED') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="ED">
                                            ED
                                        </label>
                                    </div>

                                    <div class="form-check form-check-primary form-check-inline">
                                        <input name="treatment[]" value="UTI" class="form-check-input" type="checkbox" id="UTI" {{ ($data->treatment == 'UTI') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="UTI">
                                            UTI
                                        </label>
                                    </div>

                                    <div class="form-check form-check-primary form-check-inline">
                                        <input name="treatment[]" value="HANGOVER" class="form-check-input" type="checkbox" id="HANGOVER" {{ ($data->treatment == 'HANGOVER') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="HANGOVER">
                                            HANGOVER
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <label for="item_name">Medicine Name</label>
                                <input value="{{$data->item_name}}" type="text" id="item_name" placeholder="Enter item name" name="item_name" class="form-control" required>
                            </div>
                            <div class="col">
                                <label for="item_price">Medicine Price</label>
                                <input value="{{$data->item_price}}" type="text" id="item_price" placeholder="Enter item price" name="item_price" class="form-control" required>
                            </div>
                        </div>

                        
                        <div class="mt-2">
                            <label for="item_image">Medicine Thumbnail</label>
                            <input type="file" id="item_image" placeholder="Choose Item Thumbnail" accept="image/png, image/jpeg, image/jpg" name="file" class="form-control">
                        </div>
                        <input type="hidden" name="old_image" value="{{$data->thumbnail}}">
                        <img width="60" height="auto" class="mt-4 mb-4" src="{{$data->thumbnail}}">

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