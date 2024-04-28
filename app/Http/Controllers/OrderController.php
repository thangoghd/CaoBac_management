<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;

class OrderController extends Controller
{
    //
    public function addOrder()
    {
        return view('admin.orders.add_order');
    }

    public function createCustomer(Request $request)
    {
        $data = new Customer;

        $data->customer_name=$request->customer_name;
        $data->phonenum=$request->phonenum;
        $data->gender=$request->gender;
        $data->birthdate = $request->birthdate;
        $data->address=$request->address;
        $data->note=$request->note;
        
        
        $data->save();
        return response()->json([
            'customer_name' => $data->customer_name,
            'phonenum' => $data->phonenum,
            'message' => 'Thêm khách hàng thành công!'
        ]);
    }


    //Query the "customers" database to find customers
    public function searchCustomer(Request $request)
    {
        $input = $request->input('input');
        
        
        $customers = Customer::where('customer_name', 'like', "%$input%")
                                ->orWhere('phonenum', 'like', "%$input%")
                                ->get();
        
        return response()->json($customers);
    }

    public function searchProduct(Request $request)
    {
        // Get data from input
        $input = $request->input('input');

        // Query data from the products table to search for products based on 3 criteria: product name, category and product id
        $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.*', 'categories.category_name')
        ->where('products.product_name', 'LIKE', "%$input%")
        ->orWhere('categories.category_name', 'LIKE', "%$input%")
        ->get();

        return response()->json($products);
    }

    public function getDetailedProduct(Request $request)
    {
        $product_id = $request->input('input');

        $product = Product::join('categories', 'products.category_id', '=', 'categories.id')
        ->join('product_images', 'products.id', '=', 'product_images.product_id')
        ->select('products.*', 'categories.category_name', 'product_images.image')
        ->where('products.id', 'LIKE', "%$product_id%")
        ->get();

            // Nếu không tìm thấy sản phẩm, trả về một lỗi
        if (!$product) {
            return response()->json(['error' => 'Sản phẩm không tồn tại'], 404);
        }

        return response()->json($product);
    }

    public function createOrder(Request $request)
    {
        $data = new Order();

        
        $data->datetime = $request->dateTime;
        $data->order_type=$request->orderType;
        $data->detailed_info=$request->customerInfo;
        $data->note=$request->note;
        
        
        $data->save();
        return redirect()->back()->with('message', 'Thêm đơn hàng thành công!');
    }

}
