<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class VendorInformationController extends Controller
{
    public function AddVendorProfile(){
        return view('AddVendorForm');
    }

    public function SaveVendor(Request $request){

        DB::table('vendors')->insert([
            'vendor_name'=>$request->vendor_name,
            'vendor_num'=>$request->vendor_num,
            'vendor_email'=>$request->vendor_email,
            'vendor_address'=>$request->vendor_address
        ]);
        return back()->with('vendor_add', 'Vendor added successfully!!');
    }

    public function ViewVendorProfile()
    {
        $vendors = DB::table('vendors')->get();
        return view('ViewVendorForm',compact('vendors'));
    }

    public function ListVendorDetails()
    {
        $vendors = DB::table('vendors')->get();
        return view('UpdateVendorForm',compact('vendors'));
    }


    public function UpdateVendorProfile($id)
    {
        $vendors = DB::table('vendors')->where ('id',$id)->first();
        return view('UpdateVendorForm',compact('vendors'));
    }

    public function UpdateVendor(Request $request)
    {
        DB::table('vendors')->where ('id',$request->id)->update([
            'vendor_name'=>$request->vendor_name,
            'vendor_num'=>$request->vendor_num,
            'vendor_email'=>$request->vendor_email,
            'vendor_address'=>$request->vendor_address
        ]);
            return back()->with('vendor_update', 'Vendor updated successfully!!');

    }

    public function DeleteVendorProfile($id)
    {

    }

}


