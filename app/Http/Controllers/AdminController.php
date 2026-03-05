<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    function login(Request $request){

          $validation = $request->validate([
            'name'=>'required',
            'password'=>'required'
          ]);

        $admin = Admin::where([
            'name'=>$request->name,
            'password'=>$request->password
        ])->first();

        if(!$admin){
            return back()->withErrors(['user' => 'Invalid username or password']);
        }
        
        Session::put('admin',$admin);
        return redirect('/dashboard');
        
    }
    function dashboard(){
        $admin =  session::get('admin');
        if($admin){
             return view('admin',['name'=>$admin->name]);
        }else{
            return redirect('/admin-login');
        }
    }
}
