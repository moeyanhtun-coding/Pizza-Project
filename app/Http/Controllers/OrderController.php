<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderList(){
        $order = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','=','orders.user_id')
        ->orderBy("id","desc")->get();
        return view("admin.cart.order",compact("order"));
    }
    public function orderStatus(Request $request)
    {
        $order = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','=','orders.user_id')
        ->orderBy("id","desc");
        if($request->status == null){
            $order = $order->get();
        } else{
            $order = $order->where('orders.status',$request->status)->get();
        }
        return response()->json($order, 200);
    }

    // status search
    public function statusSearch(Request $request){
    $order = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','=','orders.user_id')
        ->orderBy("id","desc");
        if($request->status == null){
            $order = $order->get();
        } else{
            $order = $order->where('orders.status',$request->status)->get();
        }
        return view("admin.cart.order",compact("order"));
    }
    // status change
    public function statusChange(Request $request){
        Order::where('id',$request->orderID)->update(['status'=> $request->status]);
    }
}