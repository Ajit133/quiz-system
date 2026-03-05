<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function login(Request $request){
        $admin = Admin::where([
            'name'=>$request->name,
            'password'=>$request->password
        ])->first();
        // return $admin->name;
        return view('admin',['name'=>$admin->name]);
    }
}
