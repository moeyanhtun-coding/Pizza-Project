<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderListController;
use App\Models\orderList;

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

    // orderproduct list
    public function productList($orderCode)
    {
        $totalPrice = Order::where('order_code',$orderCode)->first();
        $order = orderList::select('order_lists.*', 'users.name as user_name',
                'products.name as productName','products.image as productImage')
            ->leftJoin('users', 'users.id', '=', 'order_lists.user_id')
            ->leftJoin('products','products.id','=','order_lists.product_id')
            ->where('order_lists.order_code',$orderCode)
            ->get();
            return view('admin.cart.orderList',compact('order','totalPrice'));
    }
}