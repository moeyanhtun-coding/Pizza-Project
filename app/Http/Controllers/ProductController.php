<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // product list view
    public function listPage()
    {
        $productData = Product::select('products.*', 'categories.name as category_name')
            ->when(request('key'), function ($query) {
                $query->where('products.name', 'like', '%' . request('key') . '%');
            })
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->orderBy('products.created_at', 'desc')
            ->paginate(3);

        return view("admin.product.list", compact("productData"));
    }

    // product create
    public function productCreate()
    {
        $categories = Category::select('id', 'name')->get();
        return view("admin.product.create", compact("categories"));
    }
    public function create(Request $request)
    {
        $this->getDataValidationCheck($request, "create");
        $data = $this->getDataRequest($request);
        $fileName = uniqid() . $request->file("productImage")->getClientOriginalName();
        $request->file('productImage')->storeAs('public', $fileName);
        $data['image'] = $fileName;
        Product::create($data);
        return redirect()->route('product#list');
    }

    // product delete page
    public function delete($id)
    {
        $oldImage = Product::where('id', $id)->first();
        $oldImage = $oldImage->image;
        Storage::delete('public/' . $oldImage);
        Product::where('id', $id)->delete();
        return redirect()->route('product#list')->with('DeleteSuccess', 'Delete Successful');
    }

    public function detail($id)
    {
        $product = Product::where('products.id', $id)
            ->join('categories', 'products.category_id', 'categories.id')
            ->select('products.*', 'categories.name as category_name')->first();
        return view('admin.product.detail', compact('product'));
    }
    // product edit page route
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        $category = Category::select('id', 'name')->get();
        return view('admin.product.edit', compact('product', 'category'));
    }

    //update product
    public function update($id, Request $request)
    {
        $this->getDataValidationCheck($request, 'update');
        $data = $this->getDataRequest($request);
        if ($request->hasFile('productImage')) {
            $oldImage = Product::where('id', $id)->first();
            $oldImage = $oldImage->image;
            Storage::delete('public/' . $oldImage);

            $fileName = uniqid() . $request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        Product::where('id', $id)->update($data);
        return redirect()->route('product#list');
    }

    //get data from request
    private function getDataRequest($request)
    {
        return [
            'category_id' => $request->productCategory,
            'name' => $request->productName,
            'description' => $request->productDescription,
            'price' => $request->productPrice,
        ];
    }

    // product get data validation check
    private function getDataValidationCheck($request, $need)
    {
        $validationRule =
            [
                'productName' => 'required',
                'productDescription' => 'required|min:5',
                'productCategory' => 'required',
                'productPrice' => 'required',
            ];
        $validationRule['productImage'] = $need == 'update' ? 'mimes:jpg,bmp,png,jpeg' : 'required | mimes:jpg,bmp,png,jpeg';
        Validator::make($request->all(), $validationRule)->validate();
    }
}
