<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function index(){
        $start_date = request('start_date');
        $assigned_to = request('assigned_to');
        $end_date = request('end_date');
        $status = request('status');
        $dataQuery = Order::with('userDetail')
        ->whereHas('userDetail')
        ->whereNotNull('user_id');
        if (!empty($status)) {
           
            $dataQuery->where('order_status', $status);
        }
        
        if (!empty($start_date)) {
            $start_date = date('Y-m-d', strtotime($start_date));
            $dataQuery->whereDate('created_at', '>=', $start_date);
        }
        if (!empty($end_date)) {
            $end_date = date('Y-m-d', strtotime($end_date));
            $dataQuery->whereDate('created_at', '<=', $end_date);
        }
        if (!empty($assigned_to)) {
           
            $dataQuery->where('order_status', $assigned_to);
        }
        
        $data = $dataQuery->get();
        return view('admin.orders.index',compact(['data']));
    }
    public function allTransactions(){
        $data = Payment::with(['userDetail','orderDetail'])->get();

        return view('admin.transactions.index',compact(['data']));

    }
    public function invoiceView(Request $request)
    {
        $data = Payment::with(['userDetail','orderDetail'])
        ->whereHas('userDetail')
        ->where('order_id', $request->id)->first();
        
        return view('admin.orders.invoice',compact(['data']));
    }

    public function show($id){

        $data = Order::with(['orderDetail','messages' => function($q){ $q->with('userDetail');}])
        ->with('userDetail')
        ->whereHas('userDetail')
        ->whereNotNull('user_id')
        ->find($id);

        return view('admin.orders.show',compact(['data']));

    }

    public function updateOrderStatus(Request $request){

        $data = Order::find($request->order_id);
        $data->order_status = $request->order_status;
        $data->update();

        return redirect()->back()->with('success', 'Data updated successfully');

    }
    public function destroy($id){

        $OrderDetail = OrderDetail::where('order_id',$id)->delete();
        $data = Order::where('id',$id)->delete();
       

        return response('Deleted');
    }
}
