<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function home(){
       
        $data = Product::select('products.*','categories.categoryName')
        ->join('categories','products.categoryID','=','categories.categoryID')->get();
        $categories = Category::all();
        return view('home.master-frontend', compact('data','categories'));
    
    }
    public function index(){
       
        $data = Product::select('products.*','categories.categoryName')
        ->join('categories','products.categoryID','=','categories.categoryID')->get();
        $categories = Category::all();
        return view('home.index-frontend', compact('data'));
    
    }
    public function collection($categoryName){
   
    $category = Category::where('categoryName',$categoryName)->first();
    $product = Product::where('categoryID', $category->categoryID)->get();
    return view('home.category-frontend',compact('category','product'));
    }
    public function detail($productID){        
        $product = Product::find($productID);
        $category = Category::where('categoryID',$product->categoryID)->first();
        
        return view('home.product-detail-frontend',compact('product','category'));
    }
}
