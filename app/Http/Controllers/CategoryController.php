<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    
    //View category page
    public function viewCategory()
    {
        $data = Category::all();
        return view('admin.product.category', compact('data'));
    }

            //Create a new category
    public function addCategory(Request $request)
    {
        $data = new Category;
        $data->category_name=$request->category;
        $data->save();
        return redirect()->back()->with('message', 'Loại sản phẩm đã được thêm vào!');
    }

    //Delete a category
    public function deleteCategory($id)
    {
        $data = Category::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Loại sản phẩm đã được xoá bỏ!');
    }
}
