<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(){
        $data = Product::select('products.*','categories.categoryName')
        ->join('categories','products.categoryID','=','categories.categoryID')->get();
        return view('products\product-index-backend', compact('data'));
    }
    public function add(){
        $data = category::get();
        return view('products/product-add-backend', compact('data'));
    }

    public function save(Request $request){
        $request -> validate([
            'productID'=>'required|unique:products',
            'productName'=>'required',
            'productPrice'=>'required'
            //'productImage'=>'required'
        ]);

        $product = new Product();
        $product->productID = $request->productID;
        $product->categoryID = $request->categoryID;
        $product->productName = $request->productName;
        $product->productPrice = $request->productPrice;
        $product->productImage = $request->productImage;
        $product->save();
        
        return redirect()->back()->with('success','product added successfully!');
    }

    public function edit($productID){
        $data = category::get();
        $product = Product::where('productID','=',$productID)->first();
        return view('products/product-edit-backend',compact('product'),compact('data'));
    }

    public function update(Request $request){
        $request -> validate([
            'productName'=>'required',
            'productPrice'=>'required'
        ]);

        $productID = $request->productID;
            Product::where('productID','=',$productID)->update([
            'productName' => $request->productName,
            'productPrice' => $request->productPrice,
            'categoryID' => $request->categoryID,
            'productImage' => $request->productImage
        ]);
        return redirect()->back()->with('success','product updated successfully!');
    }

    public function delete($productID){
            //note: this function cannot delete row that has been connected to other tables
            Product::where('productID','=',$productID)->delete();
            return redirect()->back()->with('success','product deleted successfully!');
    }
}
