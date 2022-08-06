<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function order_view($id)
    {
        $order = Order::find($id);
        $orderproduct = OrderProduct::where('order_id',$id)->latest()->get();
        $sum = $orderproduct->sum('total');
		return response()->json([
		  'order' => $order,
          'orderproduct' => $orderproduct,
          'sum' => $sum,
		]);
    }
    public function order_search(Request $request)
	{
        $query = $request->get('query');
		if($request->get('query') == null)
		{
            $allData=Order::latest()->get();
		}
		else
		{
            $allData=Order::where('ordernumber', 'LIKE', "%{$query}%")->latest()->get();		
		}
		return response()->json([
            'allData' => $allData,
        ]); 	
	}
    public function order_list()
    {
        $allData = Order::latest()->get();
		return response()->json([
		  'allData' => $allData
		]); 
    }
    public function order_submit(Request $request)
    {
        $data = new Order();
        $data->ordernumber = random_int(10000000000, 99999999999);
        $data->total = 0;
        $data->customername = $request->customername;
        $data->customerphone = $request->customerphone;
        $data->save();
        $data->ordernumber = $data->ordernumber.$data->id;
        $data->update();

        $cart = Cart::get();
        foreach($cart as $singlecart)
        {
            $datap = new OrderProduct();
            $datap->order_id = $data->id;
            $datap->name = $singlecart->name;
            $datap->image = $singlecart->image;
            $datap->description = $singlecart->description;
            $datap->price = $singlecart->price;
            $datap->quantity = $singlecart->quantity;
            $datap->total = $singlecart->total;
            $save = $datap->save();
            if($save)
            {
                $singlecart->delete();
            }
        }

        $orderproduct = OrderProduct::where('order_id',$data->id)->get(); 
        $data->total = $orderproduct->sum('total');
        $data->update();

        $message="Order submitted successfully.";
        $status = 1;
        
        return response()->json([
          'message' => $message,
          'status' => $status
        ]);

    }
    public function product_quantity_increment($id)
    {
        $data= Cart::find($id);
        $data->quantity = $data->quantity + 1;
        $data->total = $data->quantity * $data->price;
        $update = $data->update();
        if($update)
        {
            $message="Product updated in cart successfully.";
            $status = 1;
        }
        else
        {
            $message="Unable to update product in cart,please try again.";
            $status = 0;
        }
        return response()->json([
            'message' => $message,
            'status' => $status
        ]); 
    }
    public function product_quantity_decrement($id)
    {
        $data= Cart::find($id);
        $data->quantity = $data->quantity - 1;
        $data->total = $data->quantity * $data->price;
        $update = $data->update();
        if($data->quantity < 1)
        {
            $data->delete();
        }
        if($update)
        {
            $message="Product updated in cart successfully.";
            $status = 1;
        }
        else
        {
            $message="Unable to update product in cart,please try again.";
            $status = 0;
        }
        return response()->json([
            'message' => $message,
            'status' => $status
        ]); 
    }
    public function product_removefrom_cart($id)
    {
        $data= Cart::find($id);
        $delete = $data->delete();
        if($delete)
        {
            $message="Product removed from cart successfully.";
            $status = 1;
        }
        else
        {
            $message="Unable to remove product from cart,please try again.";
            $status = 0;
        }
        return response()->json([
            'message' => $message,
            'status' => $status
        ]); 
    }
    public function products_cart()
    {
        $allData = Cart::latest()->get();
        $sum = $allData->sum('total');
		return response()->json([
		  'allData' => $allData,
          'sum' => $sum
		]); 
    }
    public function product_addto_cart($id)
    {
        $message="Sorry somthing went wrong,please try again.";
        $status = 0;

        $product = Product::find($id);
        $data= Cart::where('product_id',$id)->first();
        if($data != null)
        {
            $data->quantity = $data->quantity + 1;
            $data->total = $data->quantity * $data->price;
            $update = $data->update();
            $message="Product quantity updated to cart.";
            $status = 1;
        }
        else
        {
            $data = new Cart();
            $data->product_id = $product->id;
            $data->name = $product->name;
            $data->image = $product->image;
            $data->description = $product->description;
            $data->price = $product->price;
            $data->quantity = 1;
            $data->total = $data->price * $data->quantity;
            $save = $data->save();
            
            $message="Product added to cart.";
            $status = 1;
        }
        
        return response()->json([
            'message' => $message,
            'status' => $status
        ]); 

    }
    public function products()
    {
        $allData = Product::latest()->get();
		return response()->json([
		  'allData' => $allData
		]); 
    }
    public function products_search(Request $request)
	{
        $query = $request->get('query');
		if($request->get('query') == null)
		{
            $allData=Product::latest()->get();
		}
		else
		{
            $allData=Product::where('name', 'LIKE', "%{$query}%")->latest()->get();		
		}
		return response()->json([
            'allData' => $allData,
        ]); 	
	}


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
