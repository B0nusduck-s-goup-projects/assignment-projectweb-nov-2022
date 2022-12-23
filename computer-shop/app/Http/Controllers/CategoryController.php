<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index(){
        $data = category::get();
        return view('categories/category-index-backend',compact('data'));
    }

    public function add(){
        return view('categories/category-add-backend');
    }

    public function save(Request $request){
        $request -> validate([
            'categoryID'=>'required|unique:categories',
            'categoryName'=>'required'
        ]);

        $category = new category();
        $category->categoryID = $request->categoryID;
        $category->categoryName = $request->categoryName;
        $category->save();
        
        return redirect()->back()->with('success','category added successfully!');
    }

    public function edit($categoryID){
        $category = category::where('categoryID','=',$categoryID)->first();
        return view('categories/category-edit-backend',compact('category'));
    }

    public function update(Request $request){
        $request -> validate([
            'categoryName'=>['required',Rule::unique('categories')->ignore($request->categoryID,'categoryID')],
        ]);

        category::where('categoryID','=',$request->categoryID)->update([
            'categoryName' => $request->categoryName,
        ]);
        return redirect()->back()->with('success','category updated successfully!');
    }

    public function delete($categoryID){
            //note: this function cannot delete row that has been connected to other tables
                $Product = Product::where('categoryID','=',$categoryID)->first();
                if($Product) {
                    return redirect()->back()->with('fail','category deletion fail!');
                }
                else {
                    category::where('categoryID','=',$categoryID)->delete();
                    return redirect()->back()->with('success','category deleted successfully!');
                }
            /*$success = category::where('categoryID','=',$categoryID)->delete();
            return redirect()->back()->with('success','category deleted successfully!');
            return redirect()->back()->with('fail','category deletion fail!');*/

            
    }
}
