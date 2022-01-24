<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;



class OrderController extends Controller
{
	public function index()
	{
		$productslist = DB::table('products')
		->join('categories', 'products.category_id', 'categories.id')
		->join('suppliers', 'products.supplier_id', 'suppliers.id')
		->where("products.product_quantity",'>',0)
		->select('products.*', 'categories.category_name', 'suppliers.name')
		->orderBy('products.id', 'desc')
		->get();

		$cartproducts = DB::table('pos')->get();

		// dd($productslist);
		return view('pos', compact("productslist", "cartproducts")); //response()->json($products);
	}

	public function addToCart($id)
	{
		$exist_product = DB::table('pos')->where('product_id', $id)->first();

		if ($exist_product) {

			DB::table('pos')->where('product_id', $id)->increment('product_quantity');

			$product = DB::table('pos')->where('product_id', $id)->first();
			$sub_total = $product->product_price * $product->product_quantity;
			DB::table('pos')->where('product_id', $id)->update(['sub_total' => $sub_total]);

			// $product = Product::find($id);
			// $product->product_quantity -= 1;
			// $product->save();
		} else {
			$product = DB::table('products')->where('id', $id)->first();

			$data = [];
			$data['product_id'] = $id;
			$data['product_name'] = $product->product_name;
			$data['product_quantity'] = 1;
			$data['product_price'] = $product->selling_price;;
			$data['sub_total'] = $product->selling_price;

			DB::table('pos')->insert($data);
		}
		return \Redirect::back()->withErrors(['msg' => 'The Message']);
	}

	public function order(Request $request)
	{
		/*$request->validate([
			'customer_id' => 'required',
			'payBy' => 'required'
		]);*/

		$data = [];
		$data['customer_id'] = 1;
		$data['qty'] = $request->qty;
		$data['sub_total'] = 0;
		$data['vat'] = 0;
		$data['total'] = 0;
		$data['pay'] = 0;
		$data['due'] = 0;
		$data['payBy'] = "none";
		$data['order_date'] = date('d/m/Y');
		$data['order_month'] = date('F');
		$data['order_year'] = date('Y');
		$data['status'] = "Pending";
		$order_id = DB::table('orders')->insertGetId($data);

		$cartContents = DB::table('pos')->get();

		$cartData = [];
		foreach ($cartContents as $content) {
			$cartData['order_id'] = $order_id;
			$cartData['product_id'] = $content->product_id;
			$cartData['product_quantity'] = $content->product_quantity;
			$cartData['product_price'] = $content->product_price;
			$cartData['sub_total'] = $content->sub_total;
			DB::table('order_details')->insert($cartData);

			DB::table('products')
			->where('id', $content->product_id)
				->update(['product_quantity' => DB::raw('product_quantity - ' . $content->product_quantity)]);
		}

		DB::table('pos')->delete();

		return \Redirect::back()->withErrors(['msg' => 'The Message']);
		//return response()->json('Done');
	}


	public function cartProducts()
	{
		$products = DB::table('pos')->get();
		return response()->json($products);
	}

	public function cartDelete($id)
	{
		DB::table('pos')->where('id', $id)->delete();
		return \Redirect::back()->withErrors(['msg' => 'The Message']);
		//return response('Done');
	}


    public function todayOrder()
    {
    	$orders = DB::table('orders')
    				->join('customers', 'orders.customer_id', 'customers.id')
    				->where('orders.order_date', date('d/m/Y'))
    				->select('customers.*', 'orders.*')
    				->orderBy('orders.id', 'desc')
    				->get();
		return view('orders', compact("orders")); //response()->json($products);
    }

    public function orders($id)
    {
    	$orders = DB::table('orders')
    				->join('customers', 'orders.customer_id', 'customers.id')
    				->where('orders.id', $id)
    				->select('customers.*', 'orders.*')
    				->first();

    	return response()->json($orders);
    }

    public function orderDetails($id)
    {
    	$details = DB::table('order_details')
    				->join('products', 'order_details.product_id', 'products.id')
    				->where('order_details.order_id', $id)
    				->select('products.product_name', 'products.qrcode', 'products.image', 'order_details.*')
    				->get();

		$orders = DB::table('orders')
    				->join('customers', 'orders.customer_id', 'customers.id')
    				->where('orders.id', $id)
    				->select('customers.*', 'orders.*')
    				->get();			
        //dd($orders[0]->name);
		//$orders = DB::table('orders')->where('id', $id)->get();
		return view('order_details', compact("details", "orders")); //response()->json($products);
    	//return response()->json($details);
    }

    public function searchOrder(Request $request){
    	$orderdate = $request->date;
    	$newdate = new DateTime($orderdate);
    	$done = $newdate->format('d/m/Y'); 

    	$order = DB::table('orders')
    	->join('customers','orders.customer_id','customers.id')
    	->select('customers.name','orders.*')
    	->where('orders.order_date',$done)
    	->get();

    	return response()->json($orderdate);

    }

	public function updateOrderStatus($id,$status){
		DB::table('orders')->where('id', $id)->update([
			"status" => $status
		]);
		return \Redirect::back()->withErrors(['msg' => 'The Message']);
	}

	public function deleteOrder($id)
	{
		DB::table('orders')->where('id', $id)->delete();
		DB::table('order_details')->where('order_id', $id)->delete();
		return \Redirect::back()->withErrors(['msg' => 'The Message']);
	}
}
