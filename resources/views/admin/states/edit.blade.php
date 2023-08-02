@extends('layouts.layout')
@section('title','Edit State')

@section('content')

        <div class="middle-content container-xxl p-0 mb-4">

            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/state">State</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit State</li>
                    </ol>
                </nav>
            </div>
                    <!-- /BREADCRUMB -->
    
            <div class="row layout-top-spacing">

            @include('layouts.includes.components.alert')

                <!--- form card start --->
                <div class="card p-4">

                    <form method="POST" action="/admin/state/{{$data->id}}">
                        @method('put')
                        @csrf

                        <div class="mt-2">
                            <label for="name">State Name</label>
                            <input value="{{$data->state_name}}" type="text" id="name" placeholder="Enter state name" name="state_name" class="form-control">
                        </div>

                        <label class="mt-4">Select treatments for this state</label>
                        <div class="row mt-1">
                            <div class="col-sm-4 ">
                                <input type="hidden" name="on_ed" value="0">
                                <input name="on_ed" value="1" class="form-check-input" type="checkbox" id="inlineCheckbox1" {{ ($data->on_ed == 1) ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineCheckbox1">ED</label>
                            </div>
                            <div class="col-sm-4 ">
                                <input type="hidden" name="on_uti" value="0">
                                <input name="on_uti" value="1" class="form-check-input" type="checkbox" id="inlineCheckbox2" {{ ($data->on_uti == 1) ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineCheckbox2">UTI</label>
                            </div>
                            <div class="col-sm-4 ">
                                <input type="hidden" name="on_hangover" value="0">
                                <input name="on_hangover" value="1" class="form-check-input" type="checkbox" id="inlineCheckbox3" {{ ($data->on_hangover == 1) ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineCheckbox3">Hangover</label>
                            </div>
                        </div>

                        <div class="row mt-2">
                            
                            <div class="col-sm-4 ">
                                <input type="hidden" name="on_suncare" value="0">
                                <input name="on_suncare" value="1" class="form-check-input" type="checkbox" id="inlineCheckbox4" {{ ($data->on_suncare == 1) ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineCheckbox4">Sun care</label>
                            </div>
                            <div class="col-sm-4 ">
                                <input type="hidden" name="on_periodavoidance" value="0">
                                <input name="on_periodavoidance" value="1" class="form-check-input" type="checkbox" id="inlineCheckbox5" {{ ($data->on_periodavoidance == 1) ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineCheckbox5">Period Avoidance</label>
                            </div>
                            <div class="col-sm-4 ">
                                <input type="hidden" name="on_motionsickness" value="0">
                                <input name="on_motionsickness" value="1" class="form-check-input" type="checkbox" id="inlineCheckbox6" {{ ($data->on_motionsickness == 1) ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineCheckbox6">Motion Sickness</label>
                            </div>
                        </div>


                        <div class="mt-4">
                            <input type="submit" class="btn btn-primary">
                        </div>

                    </form>

                </div>
                <!--- form card ending --->

            </div>
        </div>




@endsection