<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home

    public function home()
    {
        $categoryCounts = Category::leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->select('categories.id', 'categories.name', Category::raw('COUNT(products.id) as product_count'))
            ->groupBy('categories.id', 'categories.name')
            ->get();
        $product = Product::orderBy('created_at', 'asc')->paginate(6);

        $cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('product', 'categoryCounts', 'cart'));
    }

    // filter by name
    public function filter($categoryId)
    {
        $product = Product::where('category_id', $categoryId)->orderBy('created_at', 'asc')->paginate(6);
        $categoryCounts = Category::leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->select('categories.id', 'categories.name', Category::raw('COUNT(products.id) as product_count'))
            ->groupBy('categories.id', 'categories.name')
            ->get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('product', 'categoryCounts', 'cart'));
    }
    // history order
    public function history()
    {
        $historyData = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(6);
        return view('user.main.history', compact('historyData'));
    }

    // change password
    public function changePasswordPage()
    {
        return view('user.account.passwordChange');
    }

    // password change function
    public function changePassword(Request $request)
    {
        $this->validationPassword($request);
        $currentUserID = Auth::user()->id;
        $user = User::where('id', $currentUserID)->first();
        $oldPassword = $user->password;
        if (Hash::check($request->oldPassword, $oldPassword)) {
            $data = ['password' => Hash::make($request->newPassword)];
            User::where('id', Auth::user()->id)->update($data);
            return back()->with('success', 'Password Changed.');
        } else {
            return back()->with('notMatch', 'The Old Password not Match. Try again..');
        }
    }

    // detail page
    public function detail($id)
    {
        $data = User::where('id', $id)->first();
        return view('user.account.detail', compact('data'));
    }

    // account update
    public function updateAccount($id)
    {
        $data = User::where('id', $id)->first();
        return view('user.account.updateAccount', compact('data'));
    }

    // account update function
    public function updateData($id, Request $request)
    {
        $this->updateValidationCheck($request);
        $data = $this->updateGetData($request);
        if ($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;
            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        User::where('id', $id)->update($data);
        return redirect()->route('user#home');
    }

    // contact us
    public function contactUs()
    {
        return view('user.contact.contact_us');
    }

    public function contactSend(Request $request)
    {
        $this->contactSendValidation($request);
        $data = $this->contactSendgetData($request);
        Contact::create($data);
        return redirect()->route('user#home');
    }
    private function contactSendgetData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'user_id' => $request->userId,
        ];
    }
    private function contactSendValidation($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required | min:10',
        ])->validate();
    }
    // password get data
    private function validationPassword($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:8',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|min:8|same:newPassword'
        ])->validate();
    }
    private function updateValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'image' => 'mimes:jpg,bmp,png,jpeg'
        ])->validate();
    }

    private function updateGetData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now(),
        ];
    }
}