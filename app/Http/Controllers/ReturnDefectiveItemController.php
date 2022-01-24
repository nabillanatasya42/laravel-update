<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ReturnDefectiveItemController extends Controller
{
    public function ViewInventoryItem(Request $request)
    {
       DB: :table('products')->where ('product_id',$request->product_id)->view([
           'customer_name'=>$request->customer_name,
           'product_quantity'=>$request->product_quantity,
           'product_price'=>$request->product_price,
       ]);


    public function AddInventoryItem(Request $request)
    {
       DB: :table('products')->where ('product_id',$request->product_id)->add([
           'product_quantity'=>$request->product_quantity,
           'product_price'=>$request->product_price,
       ]);
            return back()->with('product_id', 'Return defective item added successfully!!');

}