<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Validation\Rule;
use Session;
use Hash;

class CustomerController extends Controller
{
    //index
    public function index(){
        $data = Customer::get();
        return view('customers\customer-index-backend',compact('data'));
    }
    //register
    public function register(){
        return view('customers\customer-register-backend');
    }
    public function registerstaff(){
        return view('customers\customer-register-staff-backend');
    }
    //create account
    public function create(Request $request){
        $request -> validate([
            'customerUsername'=>'required|max:30|unique:customers',
            'customerPassword'=>'required|max:30',
            'customerFullName'=>'required|max:50',
            'customerMail'=>'required|email|max:40'
        ]);

        $customer = new customer();
        $customer->customerUsername = $request->customerUsername;
        $customer->customerPassword = Hash::make($request->customerPassword);
        $customer->customerFullName = $request->customerFullName;
        $customer->customerMail = $request->customerMail;
        $success = $customer->save();

        if($success){
            return redirect()->back()->with('success','account create successfully!');
        }
        else{
            return redirect()->back()->with('fail','account creation fail!');
        }
    }
    //login request
    public function access(){
        if(Session::has('customerLogin'))
        {
        return redirect('customer/info');
        }
        else
        {
            return view('customers/customer-login-backend');
        }
    }
    //login
    public function login(Request $request){
        $request -> validate([
            'customerUsername'=>'required',
            'customerPassword'=>'required'
        ]);

        $user = customer::where('customerUsername','=',$request->customerUsername)->first();
        if($user){
            if(Hash::check($request->customerPassword, $user->customerPassword)){
                $request->Session()->put('customerLogin', $user->customerID);
                $request->Session()->put('customerMail', $user->customerMail);
                $request->Session()->put('customerUsername', $user->customerUsername);
                $request->Session()->put('customerPassword', $request->customerPassword);
                $request->Session()->put('customerFullName', $user->customerFullName);
                return redirect('customer/info');
            }
            else{
                return back()->with('fail','wrong password');
            }
        }
        else{
            return back()->with('fail','user dont exist');
        }
    }
    //logout
    public function logout(){
        if(Session::has('customerLogin')){
            Session::pull('customerLogin');
            Session::pull('customerMail');
            Session::pull('customerUsername');
            Session::pull('customerPassword');
            Session::pull('customerFullName');
            return redirect('customer/access');
        }
    }
    //info
    public function info(){
        if(Session::has('customerLogin')){
            $data = session::get('customerLogin');
            return view('customers/customer-info-backend', compact('data'));
        }
        else{
            return redirect('customer/access');
        }
    }
    //info edit
    public function edit($customerID){
        $customer = customer::where('customerID','=',$customerID)->first();
        return view('customers/customer-edit-backend',compact('customer'));
    }
    //info update
    public function update(Request $request){
        $request -> validate([
            'customerUsername'=>['required',Rule::unique('customers')->ignore(session::get('customerLogin'),'customerID')],
            'customerFullName'=>'required|max:50',
            'customerMail'=>'required|email|max:40'
        ]);

        try {
            customer::where('customerID','=',session::get('customerLogin'))->update([
                'customerUsername' => $request->customerUsername,
                'customerFullName' => $request->customerFullName,
                'customerMail' => $request->customerMail
            ]);
            $request->Session()->put('customerMail', $request->customerMail);
            $request->Session()->put('customerUsername', $request->customerUsername);
            $request->Session()->put('customerFullName', $request->customerFullName);
            return redirect()->back()->with('success','successfully edited account!');
        } catch (Throwable $th) {
            return redirect()->back()->with('fail','failed to edit account!');
        }
    }
    //delete customer
    //from customer info
    public function delete($customerID){
        Customer::where('customerID','=',$customerID)->delete();
        return redirect('customer/logout');
    }
    //from customer index
    public function deleteI($customerID){
        $login = session::get('customerLogin');
        if( $login == $customerID){
            Customer::where('customerID','=',$customerID)->delete();
            return redirect('customer/logout');
        }
        else{
            staff::where('customerID','=',$customerID)->delete();
            return redirect()->back()->with('success','account deleted successfully!');
        }
    }
}
