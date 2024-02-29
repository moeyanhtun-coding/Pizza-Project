<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // view list
    public function categoryList()
    {
        $category = Category::when(request("key"), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })
            ->orderBy('created_at', 'desc')->paginate();

        return view("admin.category.list", compact("category"));
    }
    // view category
    public function categoryCreate()
    {
        return view("admin.category.create");
    }

    // create category
    public function create(Request $request)
    {
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route("category#list");
    }
    // delete category
    public function delete($id)
    {
        Category::where("id", $id)->delete();
        return back()->with("DeleteSuccess", "Category delete success !");
    }
    // category edit
    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        return view("admin.category.edit", compact("category"));
    }
    // category update
    public function update(Request $request)
    {
        $this->categoryValidationCheck($request);

        $data = $this->requestCategoryData($request);
        Category::where("id", $request->categoryId)->update($data);
        return redirect()->route("category#list");
    }
    // category create Validation
    private function categoryValidationCheck($request)
    {
        $request->validate([
            'categoryName' => 'required|unique:categories,name,' . $request->categoryId,
        ]);
    }

    // category get data from client
    private function requestCategoryData($request)
    {
        return [
            'name' => $request->categoryName,
        ];
    }
}