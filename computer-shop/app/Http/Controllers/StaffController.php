<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Session;
use Hash;

class StaffController extends Controller
{
    public function index(){
        $data = Staff::get();
        return view('staffs\staff-index-backend',compact('data'));
    }
    //register
    public function register(){
        return view('staffs\staff-register-backend');
    }
    //create account
    public function create(Request $request){
        $request -> validate([
            'staffID'=>'required|max:6|unique:staff',
            'staffUsername'=>'required|max:30|unique:staff',
            'staffPassword'=>'required|max:100',
            'staffName'=>'required|max:40',
            'staffPhone'=>'max:10',
            'staffEmail'=>'max:40'
        ]);

        $staff = new staff();
        $staff->staffID = $request->staffID;
        $staff->staffUsername = $request->staffUsername;
        $staff->staffPassword = Hash::make($request->staffPassword);
        $staff->staffName = $request->staffName;
        $staff->staffPhone = $request->staffPhone;
        $staff->staffEmail = $request->staffEmail;
        $success = $staff->save();

        if($success){
            return redirect()->back()->with('success','account create successfully!');
        }
        else{
            return redirect()->back()->with('fail','account creation fail!');
        }
    }
    //login request
    public function access(){
        if(Session::has('staffLogin'))
        {
        return redirect('staff/info');
        }
        else
        {
            return view('staffs/staff-login-backend');
        }
    }
    //login page
    public function login(Request $request){
        $request -> validate([
            'staffUsername'=>'required|max:30',
            'staffPassword'=>'required|max:30'
        ]);
        
        $user = staff::where('staffUsername','=',$request->staffUsername)->first();
        if($user){
            //$password = staff::where('staffPassword','=',$request->staffPassword)->first();
            if(Hash::check($request->staffPassword,$user->staffPassword)){
                $request->Session()->put('staffLogin', $user->staffID);
                $request->Session()->put('staffUsername', $user->staffUsername);
                $request->Session()->put('staffPassword', $request->staffPassword);
                $request->Session()->put('staffName', $user->staffName);
                $request->Session()->put('staffPhone', $user->staffPhone);
                $request->Session()->put('staffEmail', $user->staffEmail);
                return redirect('staff/info');
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
        if(Session::has('staffLogin')){
            Session::pull('staffLogin');
            Session::pull('staffUsername');
            Session::pull('staffPassword');
            Session::pull('staffName');
            Session::pull('staffPhone');
            Session::pull('staffEmail');
            return redirect('staff/access');
        }
    }
    //info
    public function info(){
        if(Session::has('staffLogin')){
            $data = session::get('staffLogin');
            return view('staffs/staff-info-backend', compact('data'));
        }
        else{
            return redirect('staff/access');
        }
    }
    //delete account
    public function delete($staffID){
        staff::where('staffID','=',$staffID)->delete();
        return redirect('staff/logout');
    }
    public function deleteI($staffID){
        $login = session::get('staffLogin');
        if( $login == $staffID){
            staff::where('staffID','=',$staffID)->delete();
            return redirect('staff/logout');
        }
        else{
            staff::where('staffID','=',$staffID)->delete();
            return redirect()->back()->with('success','account deleted successfully!');
        }
        //staff::where('staffID','=',$staffID)->delete();
        //return redirect()->back()->with('success','account deleted successfully!');
    }
    //edit account
    public function edit($staffID){
        $staff = Staff::where('staffID','=',$staffID)->first();
        return view('staffs/staff-edit-backend',compact('staff'));
    }
    //update account
    public function update(Request $request){
        $request -> validate([
            'staffUsername'=>'required|max:30',
            'staffName'=>'required|max:40',
            'staffPhone'=>'max:10',
            'staffEmail'=>'max:40'
        ]);

        $success = staff::where('staffID','=',session::get('staffLogin'))->update([
            'staffUsername' => $request->staffUsername,
            'staffName' => $request->staffName,
            'staffPhone' => $request->staffPhone,
            'staffEmail' => $request->staffEmail,
        ]);
        if($success){
            $request->Session()->put('staffEmail', $request->staffEmail);
            $request->Session()->put('staffUsername', $request->staffUsername);
            $request->Session()->put('staffName', $request->staffName);
            $request->Session()->put('staffPassword', $request->staffPassword);
            $request->Session()->put('staffPhone', $request->staffPhone);
            return redirect()->back()->with('success','account edited successfully!');
        }
        else{
            return redirect()->back()->with('fail','failed to edit account!');
        }
    }
}
