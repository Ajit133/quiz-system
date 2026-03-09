<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home(Request $request)
    {
        $search = $request->query('search');
        $categories = Category::withCount('quizzes')->get();

        $quizResults = null;
        if ($search && trim($search) !== '') {
            $quizResults = Quiz::where('name', 'like', '%' . $search . '%')
                ->with('category')
                ->get();
        }

        return view('welcome', [
            'categories'  => $categories,
            'quizResults' => $quizResults,
            'search'      => $search,
        ]);
    }

    public function categoryQuizzes($id)
    {
        $category = Category::with('quizzes')->findOrFail($id);

        return view('user.category-quizzes', [
            'category' => $category,
            'quizzes'  => $category->quizzes,
        ]);
    }

    public function quizDetail($id)
    {
        $quiz      = Quiz::with('category')->findOrFail($id);
        $questions = Question::where('quiz_id', $id)->get();

        return view('user.quiz-detail', [
            'quiz'      => $quiz,
            'questions' => $questions,
        ]);
    }
}
