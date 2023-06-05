@extends('layouts.layout')
@section('title','Transactions')

@section('content')
                
                <div class="middle-content container-xxl p-0">

                    <!-- BREADCRUMB -->
                    <div class="page-meta">
                        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Transactions</a></li>
                                <li class="breadcrumb-item active" aria-current="page">All Transactions</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- /BREADCRUMB -->
    
                    <div class="row layout-top-spacing">

                    @include('layouts.includes.components.alert')

                            <div class="widget-content widget-content-area br-8">
                                <table id="html5-extension" class="table dt-table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="d-none">ID</th>
                                            <th>User</th>
                                            <th>Order</th>
                                            <th>Amount</th>
                                            <th>TID</th>
                                            <th>Method</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $datas)
                                        <tr id="row_{{$datas->id}}">
                                            <td class="d-none">{{$datas->id}}</td>
                                            <td>{{$datas->userDetail?->name}}</td>
                                            <td>{{$datas->orderDetail?->id}}</td>
                                            <td>{{$datas->amount}}</td>
                                            <td>{{$datas->t_id}}</td>
                                            <td>{{$datas->method}}</td>
                                            
                                        </tr>
                                        @endforeach
                                      
                                    </tbody>
                                    </table>
                                </div>
                            </div>
    
                        </div> 
                    </div>


@endsection