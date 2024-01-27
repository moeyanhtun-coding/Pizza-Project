<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\orderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class RouteController extends Controller
{
    // get API product list

    public function productList()
    {
        $products = Product::get();
        $data = [
            'products' => $products,
        ];
        return response()->json($data, 200);
    }

    // get api category list
    public function categoryList()
    {
        $category = Category::get();
        $data = [
            'category' => $category,
        ];
        return response()->json($data, 200);
    }

    // get api contact list

    public function contactList()
    {
        $contact = Contact::get();
        $data = [
            'contact' => $contact
        ];
        return response()->json($data, 200);
    }

    // get api order list
    public function orderList()
    {
        $order = Order::get();
        $data = [
            'order' => $order
        ];
        return response()->json($data, 200);
    }

    // get api order_lists

    public function orderLists()
    {
        $orderList = orderList::get();
        $data = [
            'order_list' => $orderList
        ];
        return response()->json($data, 200);
    }

    /// get api user list
    public function userList()
    {
        $user = User::get();
        $data = [
            'user' => $user
        ];
        return response()->json($data, 200);
    }

    // create category

    public function categoryCreate(Request $request)
    {
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $createCategory = Category::create($data);
        return response()->json($createCategory, 200);
    }

    // create contact list

    public function contactCreate(Request $request)
    {
        $data = $this->getContactData($request);
        Contact::create($data);
        $createContact = Contact::get();
        return response()->json($createContact, 200);
    }

    // delete data {}

    public function contactDelete(Request $request)
    {
        $data = Contact::where('id', $request->categoryId)->first();
        if (isset($data)) {
            Contact::where('id', $request->categoryId)->delete();
            return response()->json([
                'status' => 'true',
                'message' => 'message Deleted!!!',
                'deleteData' => $data
            ], 200);
        }
        return response()->json([
            'status' => 'false',
            'message' => 'there is no contact',
            'deleteData' => $data
        ], 200);
    }

    // get api contact detail
    public function contactDetail($id)
    {
        $data = Contact::where('id', $id)->first();
        if (isset($data)) {
            return response()->json([
                'status' => 'true',
                'message' => 'Data found',
                'contactDetail' => $data
            ], 200);
        }
        return response()->json([
            'status' => 'false',
            'message' => 'there is no contact',
        ], 500);
    }

    //get api update contact

    public function categoryUpdate(Request $request)
    {
        $categoryId = $request->categoryId;
        $dbSource = Category::where('id', $categoryId)->first();
        if (isset($dbSource)) {
            $data = $this->getCategoryData($request);
            $response = Category::where('id', $categoryId)->update($data);
            return response()->json([
                'status' => 'true',
                'message' => 'update success!!!',
                'contactDetail' => $response
            ], 200);
        }
        return response()->json([
            'status' => 'false',
            'message' => 'there is no contact',
        ], 500);
    }
    private function getContactData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'user_id' => $request->user_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
    private function getCategoryData($request)
    {
        return [
            'name' => $request->category_name,
            'updated_at' => Carbon::now(),
        ];
    }
}
