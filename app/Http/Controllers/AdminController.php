<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
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

    function categories(){
        $categories = Category::get();
         $admin =  session::get('admin');
        if($admin){
             return view('categories',['name'=>$admin->name,'categories'=>$categories]);
        }else{
            return redirect('/admin-login');
        }
    }
    function logout(){
        Session::forget('admin');
        return redirect('/admin-login');
    }
    function addCategory(Request $request){
           $admin = session::get('admin');
           $category = new Category();
           $category->name = $request->category;
           $category->creator = $admin->name;
           if($category->save()){
              Session::flash('category', "Category '" . $request->category . "' added successfully!");
           }
           return redirect('/admin-categories');
    }
    function deleteCategory($id){
           $admin = session::get('admin');
           if(!$admin) return redirect('/admin-login');
           $category = Category::findOrFail($id);
           $name = $category->name;
           $category->delete();
           Session::flash('category', "Category '" . $name . "' deleted successfully!");
           return redirect('/admin-categories');
    }
}
