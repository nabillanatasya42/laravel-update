<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productslist = DB::table('products')
        ->join('categories', 'products.category_id', 'categories.id')
        ->join('suppliers', 'products.supplier_id', 'suppliers.id')
        ->select('products.*', 'categories.category_name', 'suppliers.name')
        ->orderBy('products.id', 'desc')
        ->get();
        // dd($productslist);
        return view('products',compact("productslist")); //response()->json($products);
    }

    public function addproduct()
    {
        // dd($productslist);
        return view('addproducts'); //response()->json($products);
    }


    public function productStock()
    {
        // dd($productslist);
        $productslist = DB::table('products')
        ->join('categories', 'products.category_id', 'categories.id')
        ->join('suppliers', 'products.supplier_id', 'suppliers.id')
        ->select('products.*', 'categories.category_name', 'suppliers.name')
        ->orderBy('products.id', 'desc')
        ->get();

        // dd($productslist);
        return view('stocks', compact("productslist")); //response()->json($products);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
       /* $request->validate([
            //'category_id'      => 'required',
           // 'supplier_id'      => 'required',
            'product_name'     => 'required',
            'product_code'     => 'required|max:80',
            'root'             => 'required|max:80',
            'buying_price'     => 'required|max:80',
            'selling_price'    => 'required|max:80',
            'buying_date'      => 'required|max:80',
            'product_quantity' => 'required',
        ]);*/
      
        if ($request->image) {
            //$position = strpos($request->image, ';');
            //$sub = substr($request->image, 0, $position);
            //$ext = explode('/', $sub)[1];

            $name = time().'.png';
            $img = Image::make($request->image)->resize(240, 200);

            $upload_path = 'backend/product/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $writer = new PngWriter();

            $qrCode = QrCode::create($request->product_code)
            ->setEncoding(new Encoding('ISO-8859-1'))
            ->setSize(90)
            ->setMargin(1);

            $result = $writer->write($qrCode);
            // Save it to a file
            $pathsave = 'backend/product/' . md5(date('d-m-y:h:i:s') . rand(10000, 1000000)) . '.png';
            $result->saveToFile($pathsave);

            $product = new Product;
            $product->category_id = 1;
            $product->supplier_id = 1;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->qrcode       = $pathsave;
            $product->root = $request->root;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->buying_date = $request->buying_date;
            $product->product_quantity = $request->product_quantity;
            $product->image = $image_url;
            $product->save();
            
        } else {

            $writer = new PngWriter();

            $qrCode = QrCode::create($request->product_code)
                ->setEncoding(new Encoding('ISO-8859-1'))
                ->setSize(90)
                ->setMargin(1);
            $result = $writer->write($qrCode);
            
            $pathsave = 'backend/product/' . md5(date('d-m-y:h:i:s') . rand(10000, 1000000)) . '.png';
            $result->saveToFile($pathsave);
            
            $product = new Product;
            $product->category_id = 1;
            $product->supplier_id = 1;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->qrcode       = $pathsave;
            $product->root = $request->root;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->buying_date = $request->buying_date;
            $product->product_quantity = $request->product_quantity;
            $product->save();
        }

        return \Redirect::back()->withErrors(['msg' => 'The Message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productslist = Product::findOrFail($id);
       // dd($productslist->qrcode);
        return view('updateproducts',compact("productslist")); //response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*$request->validate([
            'category_id'      => 'required',
            'supplier_id'      => 'required',
            'product_name'     => 'required',
            'product_code'     => 'required|max:80',
            'root'             => 'required|max:80',
            'buying_price'     => 'required|max:80',
            'selling_price'    => 'required|max:80',
            'buying_date'      => 'required|max:80',
            'product_quantity' => 'required',
        ]);*/

        $product = Product::findOrFail($id);
       // $product->category_id = $request->category_id;
        //$product->supplier_id = $request->supplier_id;
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->root = $request->root;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->buying_date = $request->buying_date;
        $product->product_quantity = $request->product_quantity;

        if ($request->newImage) {
            $image = $request->newImage;
            //$position = strpos($image, ';');
            //$sub = substr($image, 0, $position);
            //$ext = explode('/', $sub)[1];

            $name = time().'.png';
            $img = Image::make($image)->resize(240, 200);

            $upload_path = 'backend/product/';
            $image_url = $upload_path.$name;
            $newImage = $img->save($image_url);

            if ($newImage) {
                //unlink($product->image);
                $product->image = $image_url;
                $product->save();
            }

        } else {
            $product->save();
        }
        return \Redirect::back()->withErrors(['msg' => 'The Message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $image = $product->image;

        if ($image) {
            unlink($image);
            $product->delete();
        }else{
            $product->delete();
        }
        return \Redirect::back()->withErrors(['msg' => 'The Message']);
    }

    public function updateStock($id)
    {
        request()->validate([
            'product_quantity' => 'required|numeric'
        ]);
        $product = Product::findOrFail($id);
        $product->product_quantity = request()->product_quantity;
        $product->save();
    }
}
