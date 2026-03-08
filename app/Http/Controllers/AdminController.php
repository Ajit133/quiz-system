<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Question;
use App\Models\Quiz;
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
           $validation = $request->validate([
            'category'=>'required | min:3 | max:50 | unique:categories,name'
           ]);
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

    function showAddQuiz(){
        $admin = Session::get('admin');
        if(!$admin) return redirect('/admin-login');

        $categories  = Category::get();
        $quizDetails = Session::get('quizDetails');
        $questions   = $quizDetails ? Question::where('quiz_id', $quizDetails['id'])->get() : collect();

        return view('add-quiz', [
            'name'        => $admin->name,
            'categories'  => $categories,
            'quizDetails' => $quizDetails,
            'questions'   => $questions,
        ]);
    }

    function saveQuiz(Request $request){
        $admin = Session::get('admin');
        if(!$admin) return redirect('/admin-login');

        $request->validate([
            'quiz'        => 'required|min:3|max:100',
            'category_id' => 'required|exists:categories,id',
        ]);

        $quiz = new Quiz();
        $quiz->name = $request->quiz;
        $quiz->category_id = $request->category_id;
        $quiz->save();

        Session::put('quizDetails', [
            'id'          => $quiz->id,
            'name'        => $quiz->name,
            'category_id' => $quiz->category_id,
        ]);

        Session::flash('quiz_success', "Quiz '{$quiz->name}' created! Now add questions below.");
        return redirect('/add-quiz');
    }

    function addQuestion(Request $request){
        $admin = Session::get('admin');
        if(!$admin) return redirect('/admin-login');

        $quizDetails = Session::get('quizDetails');
        if(!$quizDetails) return redirect('/add-quiz');

        $request->validate([
            'question'       => 'required|min:5',
            'option_a'       => 'required',
            'option_b'       => 'required',
            'option_c'       => 'required',
            'option_d'       => 'required',
            'correct_answer' => 'required|in:option_a,option_b,option_c,option_d',
            'marks'          => 'required|integer|min:1',
        ]);

        $q = new Question();
        $q->quiz_id        = $quizDetails['id'];
        $q->question       = $request->question;
        $q->option_a       = $request->option_a;
        $q->option_b       = $request->option_b;
        $q->option_c       = $request->option_c;
        $q->option_d       = $request->option_d;
        $q->correct_answer = $request->correct_answer;
        $q->marks          = $request->marks;
        $q->save();

        Session::flash('quiz_success', 'Question added successfully!');
        return redirect('/add-quiz');
    }

    function finishQuiz(){
        $admin = Session::get('admin');
        if(!$admin) return redirect('/admin-login');

        Session::forget('quizDetails');
        Session::flash('quiz_success', 'Quiz saved! You can create a new quiz below.');
        return redirect('/add-quiz');
    }
}
