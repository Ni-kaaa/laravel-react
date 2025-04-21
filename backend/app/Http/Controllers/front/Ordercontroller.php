<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\orderitems;
use App\Models\orders;
use App\Models\product;
use Illuminate\Http\Request;

class Ordercontroller extends Controller
{
    public function order (Request $request)
    {
        if(!empty($request->cart)){
            $order = new orders();
            $order->customer_id = $request->customer_id;
            $order->subtotal = $request->subtotal;
            $order->grand_total = $request->grand_total;
            $order->shipping = $request->shipping;
            $order->payment_status = $request->payment_status;
            $order->status = $request->status;
            $order->name = $request->name;
            $order->email = $request->email;
            $order->mobile = $request->mobile;
            $order->address = $request->address;
            $order->city = $request->city;
            $order->state = $request->state;
            $order->zip = $request->zip;
            $order->save();

            foreach($request->cart as $item)
            {
                $orderitem = new orderitems();
                $orderitem->order_id = $order->id;
                $orderitem->product_id = $item['product_id'];
                $orderitem->price = $item['quantity'] * $item['price'];
                $orderitem->unit_price = $item['price'];
                $orderitem->quantity = $item['quantity'];
                $orderitem->title = $item['title'];
                $orderitem->save();

                $product = product::find($item['product_id']);
                if ($product && $product->quantity >= $item['quantity']) {
                    $product->decrement('quantity', $item['quantity']); 
                } else {
                
                    return response()->json([
                        'status' => 400,
                        'message' => 'Insufficient stock for product ' . $item['title']
                    ]);
                }
               
              

            }
            return response()->json([
                "status" => 200,
                "message" => "your place order successful",
                "id" => $order->id
            ]);
           
        }
        else{
            return response()->json([
                "status" => 400,
                "message" => "your cart is empty"
            ]);
        }
    }

    public function index(Request $request)
    {
        $order = orders::all();

        return response()->json([
            "status" => 200,
            "order" => $order
        ]);
    }

    public function getorder(Request $request)
    {
        $order = orders::Orderby('id','desc')->limit(5)->get();

        return response()->json([
            "status" => 200,
            "order" => $order
        ]);
    }
    public function show($id,Request $request)  {
        $order = orders::with("items","items.product")->find($id);
        return response()->json([
            "status" => 200,
            "order" => $order,
            
        ]);
        
    }
    public function showByCustomerId($customer_id, Request $request)
{
    $orders = orders::with('items')->where('customer_id', $customer_id)->get();
    return response()->json([
        "status" => 200,
        "orders" => $orders
    ]);
}


   
}
