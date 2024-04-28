<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{    
        // View Add_product page
        public function addProduct()
        {
            $category = Category::all();
            return view('admin\product\add_product', compact('category'));
        }

        // Create a new product
        public function createProduct(Request $request)
        {
            $product = new Product;

            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->description = $request->description;

            $product->save();


            if ($request->hasFile('image')) {
                $image=$request->image;
                $imageName = time() . '_' . $image->getClientOriginalName();

                $image->move('product', $imageName);
                DB::table('product_images')->insert([
                    'product_id' => $product->id,
                    'image' => $imageName,
                    'thumbnail' => 1
                ]);
            }

            return redirect()->back()->with('message', 'Đã thêm sản phẩm!');
        }
            
        // View list of products
        public function viewProduct()
        {
            $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->where('product_images.thumbnail', 1)
            ->select('products.*', 'categories.category_name', 'product_images.image')
            ->get();
            $category = Category::all();
            return view('admin\product\view_product', compact('products', 'category'));
            
        }
    
        // Delete a product
        public function deleteProduct($id)
        {
            $data = Product::find($id);
            $data->delete();
            return redirect()->back()->with('message', 'Sản phẩm đã được huỷ bỏ!');
        }
    
        // Get data of a product
        public function getProduct($id)
        {
            $product = Product::find($id);
            return response()->json(
                [
                    'product' => $product,
                ]
            );
        }
        
    
    
        // Edit a product
        public function updateProduct(Request $request)
        {
            $product = Product::find($request->id);
            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->decription = $request->decription;

            $product->update();
            return redirect()->back()->with('message', 'Cập nhật sản phẩm thành công!');
        }
}
