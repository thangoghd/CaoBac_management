<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function addCustomer()
    {
        return view('admin/customers/add_customer');
    }

    public function  viewCustomers (Request $request)
    {
        $customer = Customer::all();

        return view('admin/customers/view_customers', compact('customer'));
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
        return redirect()->back()->with('message', 'Thêm khách hàng thành công!');
    }

    public function getCustomer($id)
    {
        $customer = Customer::find($id);
        return response()->json(
            [
                'customer' => $customer,
            ]
        );
    }

    public function updateCustomer(Request $request)
    {
        $customer = Customer::find($request->id);
        if(empty($customer->user_id))
        {
            $customer->customer_name = $request->customer_name;
            $customer->customer_id=$request->customer_id;
            $customer->type_id=$request->type_id;
            $customer->phonenum=$request->phonenum;
            $customer->gender=$request->gender;
            $customer->birthdate = $request->birthdate;
            $customer->address=$request->address;
            $customer->note=$request->note;
    
            $customer->update();
            return redirect()->back()->with('message', 'Cập nhật thông tin khách hàng thành công!');
        }
    }

    public function deleteCustomer($id)
    {
        $data = Customer::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Đã xoá dữ liệu khách hàng!');
    }
}
