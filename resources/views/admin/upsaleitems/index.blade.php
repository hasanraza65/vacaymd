@extends('layouts.layout')
@section('title','Upsale Medicines')

@section('content')
                
                <div class="middle-content container-xxl p-0">
                    
                    <!-- BREADCRUMB -->
                    <div class="page-meta">
                        <nav class="breadcrumb-style-one d-flex justify-content-between align-items-center" aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="#">Upsale Items</a></li>
                                <li class="breadcrumb-item active" aria-current="page">All Upsale Items</li>
                            </ol>
                            <a href="/admin/upsaleitems/create" class="btn btn-primary">Add New</a>
                        </nav>
                    </div>
                    <!-- /BREADCRUMB -->

    
                    <div class="row layout-top-spacing">

                            <div class="widget-content widget-content-area br-8">
                                <table id="html5-extension" class="table dt-table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="d-none">ID</th>
                                            <th>Medicine Thumbnail</th>
                                            <th>Medicine Name</th>
                                            <th>Medicine Price</th>
                                            <th>Medicine Category</th>
                                            <th class="no-content">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($items as $name => $itemsGroup)
                                    <tr>
                                        <td class="d-none">{{ $itemsGroup[0]->id }}</td>
                                        <td><img width="60" height="auto" src="{{ $itemsGroup[0]->thumbnail }}"></td>
                                        <td>{{ $name }}</td>
                                        <td>${{ number_format($itemsGroup[0]->item_price,2) }}</td>
                                        <td>
                                        @foreach ($itemsGroup as $item)
                                            {{ $item->treatment }},
                                        @endforeach
                                        </td>
                                        <td class="">
                                            <a href="/admin/upsaleitems/{{ $itemsGroup[0]->id }}/edit" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Edit" data-bs-original-title="Edit" aria-label="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-8 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                            <a onclick="deleteFunction({{ $itemsGroup[0]->id }},'/admin/upsaleitems/{{ $itemsGroup[0]->id }}')" href="javascript:void(0);" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-original-title="Delete" data-bs-original-title="Delete" aria-label="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-8 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>
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