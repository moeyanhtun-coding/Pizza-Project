<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\orderList;
use Carbon\CarbonTimeZone;
use Illuminate\Log\Logger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function pizzaList(Request $request)
    {
        if ($request->status == 'asc') {
            $data = Product::orderBy('created_at', 'asc')->get();
        } else if ($request->status == 'desc') {
            $data = Product::orderBy('created_at', 'desc')->get();
        }
        return $data;
    }
    public function addToCart(Request $request)
    {
        $data = $this->getData($request);
        Cart::create($data);
        $response = [
            'status' => 'success',
            'message' => 'add to cart'
        ];
        return response()->json($response, 200);
    }
    public function orderConfirm(Request $request)
    {
        $totalPrice = 0;
        foreach ($request->all() as $item) {
            $data = orderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code'],
            ]);
            $totalPrice += $data->total;
        }

        Cart::where('user_id', Auth::user()->id)->delete();
        Order::create([
            'user_id' => Auth::user()->id,
            'total_price' => $totalPrice + 3000,
            'order_code' => $data->order_code,
        ]);
        return response()->json([
            'status' => 'true'
        ], 200);
    }
    public function orderCancel(){
        Cart::where('user_id',Auth::user()->id)->delete();
        return response()->json([
                'status' => 'true'
            ], 200);
    }

    public function rowDelete(Request $request){
        Cart::where('user_id',Auth::user()->id)
            ->where('product_id', $request->productID)
            ->where('id', $request->orderID)
            ->delete();
    }
// role change
    public function roleChange(Request $request)
    {
        User::where('id', $request->id)->update([ 'role'=>$request->role]);
    }
    private function getData($request)
    {
        return [
            'user_id' => $request->userID,
            'product_id' => $request->pizzaID,
            'qty' => $request->productCount,
            'created-at' => Carbon::now(),
            'updated-at' => Carbon::now()
        ];
    }
}
