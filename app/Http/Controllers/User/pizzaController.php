<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class pizzaController extends Controller
{
    public function pizzaCart()
    {
        $cartList = Cart::select('carts.*', 'products.name as pizzaName', 'products.price as pizzaPrice', 'products.image')
            ->leftJoin('products', 'products.id', 'carts.product_id')
            ->where('carts.user_id', Auth::user()->id)
            ->get();

        $totalPrice = 0;
        foreach ($cartList as $c) {
            $totalPrice += $c->pizzaPrice * $c->qty;
        }

        return view('user.cart.cart', compact('cartList', 'totalPrice'));
    }

    public function pizzaDetail($id)
    {
        $data = Product::where('id', $id)->first();
        $products = Product::get();
        return view('user.main.productDetail', compact('data', 'products'));
    }


}