@extends('layouts.layout')
@section('title','Create Upsale Medicine')

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

                    <form method="POST" action="/admin/upsaleitems" enctype="multipart/form-data" class="needs-validation" novalidate>

                        @csrf

                        <div class="row mt-2">
                            <div class="col">
                                <div class="col">
                                    <label for="name">Treatment For</label><br>

                                    <div class="form-check form-check-primary form-check-inline">
                                        <input name="treatment[]" value="ED" class="form-check-input" type="checkbox" id="ED">
                                        <label class="form-check-label" for="ED">
                                            ED
                                        </label>
                                    </div>

                                    <div class="form-check form-check-primary form-check-inline">
                                        <input name="treatment[]" value="UTI" class="form-check-input" type="checkbox" id="UTI">
                                        <label class="form-check-label" for="UTI">
                                            UTI
                                        </label>
                                    </div>

                                    <div class="form-check form-check-primary form-check-inline">
                                        <input name="treatment[]" value="HANGOVER" class="form-check-input" type="checkbox" id="HANGOVER">
                                        <label class="form-check-label" for="HANGOVER">
                                            HANGOVER
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="item_name">Medicine Name</label>
                                <input type="text" id="item_name" placeholder="Enter item name" name="item_name" class="form-control">
                            </div>
                            <div class="col">
                                <label for="item_price">Medicine Price</label>
                                <input type="number" step="0.01" id="item_price" placeholder="Enter item price" name="item_price" class="form-control" required>
                                <div class="invalid-feedback">
                                Please provide a valid price.
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <label for="item_description">Item Description</label>
                                <textarea name="item_description" id="item_description" class="form-control" placeholder="Enter description for Item"></textarea>
                            </div>
                        </div>

                        
                        <div class="mt-4">
                            <label for="item_image">Medicine Thumbnail</label>
                            <input type="file" id="item_image" placeholder="Choose Item Thumbnail" accept="image/png, image/jpeg, image/jpg" name="file" class="form-control">
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

<script>
document.querySelector('form').addEventListener('submit', function(event) {
  let inputs = event.target.querySelectorAll('input');
  inputs.forEach(input => {
    if (!input.validity.valid) {
      event.preventDefault();
      event.stopPropagation();
      input.classList.add('is-invalid');
    } else {
      input.classList.remove('is-invalid');
    }
  });
});
</script>


@endsection