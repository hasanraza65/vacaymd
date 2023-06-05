@extends('layouts.layout')
@section('title','Users')

@section('content')
                
                <div class="middle-content container-xxl p-0">

                    <!-- BREADCRUMB -->
                    <div class="page-meta">
                        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Users</a></li>
                                <li class="breadcrumb-item active" aria-current="page">All Users</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- /BREADCRUMB -->
    
                    <div class="row layout-top-spacing">

                            <div class="widget-content widget-content-area br-8">
                                <table id="html5-extension" class="table dt-table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="d-none">ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>User Role</th>
                                            <th class="no-content">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $datas)
                                        <tr id="row_{{$datas->id}}">
                                            <td class="d-none">{{$datas->id}}</td>
                                            <td>{{$datas->name}}</td>
                                            <td>{{$datas->email}}</td>
                                            <td>{{$datas->gender}}</td>
                                            <td>@if($datas->user_role == 1)
                                                Admin
                                                @elseif($datas->user_role == 2)
                                                Doctor
                                                @elseif($datas->user_role == 3)
                                                Pharmacy Manager
                                                @elseif($datas->user_role == 4)
                                                Patient
                                                @endif
                                            </td>
                                            <td class="">
                                                <a href="/admin/users/{{$datas->id}}/edit" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Edit" data-bs-original-title="Edit" aria-label="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-8 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                                <a onclick="deleteFunction({{$datas->id}},'/admin/users/{{$datas->id}}')" href="javascript:void(0);" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Delete" data-bs-original-title="Delete" aria-label="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-8 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>
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