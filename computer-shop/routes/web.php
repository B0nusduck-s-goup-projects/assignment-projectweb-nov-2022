<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/connection',function( ){
    try{
        DB::connection()->getPdo();
        return 'connected successfully';
    }
    catch(\Exception $ex)
    {
        dd($ex->getMessage());
    }
});
//home
Route::get('/', function () {
    return redirect('home');
});
Route::get('home',[HomeController::class,'home']);
Route::get('home/index',[HomeController::class,'index']);
Route::get('home/collection/{categoryName}',[HomeController::class,'collection']);
Route::get('home/detail/{productID}',[HomeController::class,'detail']);
//staff
Route::get('staff/register',[StaffController::class,'register']);
Route::post('staff/create',[StaffController::class,'create']);
Route::get('staff/info',[StaffController::class,'info']);
Route::get('staff/delete/{staffID}',[StaffController::class,'delete']);
Route::get('staff/deleteI/{staffID}',[StaffController::class,'deleteI']);
Route::get('staff/access',[StaffController::class,'access']);
Route::post('staff/login',[StaffController::class,'login']);
Route::get('staff/logout',[StaffController::class,'logout']);
Route::get('staff/edit/{staffID}',[StaffController::class,'edit']);
Route::post('staff/update',[StaffController::class,'update']);
Route::get('staff/index',[StaffController::class,'index']);
//customer
Route::get('customer/register',[CustomerController::class,'register']);
Route::post('customer/create',[CustomerController::class,'create']);
Route::get('customer/access',[CustomerController::class,'access']);
Route::post('customer/login',[CustomerController::class,'login']);
Route::get('customer/logout',[CustomerController::class,'logout']);
Route::get('customer/info',[CustomerController::class,'info']);
Route::get('customer/edit/{customerID}',[CustomerController::class,'edit']);
Route::post('customer/update',[CustomerController::class,'update']);
Route::get('customer/delete/{customerID}',[CustomerController::class,'delete']);
Route::get('customer/deleteI/{customerID}',[CustomerController::class,'deleteI']);
Route::get('customer/index',[CustomerController::class,'index']);
Route::get('customer/register-staff',[CustomerController::class,'registerstaff']);
//category
Route::get('category/index',[CategoryController::class,'index']);
Route::get('category/add',[CategoryController::class,'add']);
Route::post('category/save',[CategoryController::class,'save']);
Route::get('category/edit/{categoryID}',[CategoryController::class,'edit']);
Route::post('category/update',[CategoryController::class,'update']);
Route::get('category/delete/{categoryID}',[CategoryController::class,'delete']);
//product
Route::get('product/index',[ProductController::class,'index']);
Route::get('product/add',[ProductController::class,'add']);
Route::post('product/save',[ProductController::class,'save']);
Route::get('product/edit/{productID}',[ProductController::class,'edit']);
Route::post('product/update',[ProductController::class,'update']);
Route::get('product/delete/{productID}',[ProductController::class,'delete']);
