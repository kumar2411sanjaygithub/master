<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();

        return view('crm-master.product.index', compact('product'));
    }

    public function create()
    {

        return view('crm-master.product.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'product_name' =>'required'
        ]); 
        // For Insert Data
        $product = new Product;
        $product->product_name = Input::get('product_name');
        $product->save();

        return redirect()->route('crm-master.product.index')->with('success','Product Added Successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('crm-master.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'product_name' =>'required'
        ]); 
        // For Update Data
        $product = Product::find($id);
        $product->product_name = Input::get('product_name');
        $product->save();        

        return redirect()->route('crm-master.product.index')->with('success', 'Product Updated Successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('crm-master.product.index')->with('success','Product Deleted Successfully.');
    }

}
