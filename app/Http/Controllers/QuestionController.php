<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function index()
    {
        $questions = Question::with([
            'user',
            'category',
        ])->latest()->paginate(24);

        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('questions.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'   => 'required|exists:categories,id',
            'title'         => 'required|string|max:255',
            'description'   => 'required|string'
        ]);

        $question = Question::create([
            'user_id'       => 1,
            'category_id'   => $request->category_id,
            'title'         => $request->title,
            'description'   => $request->description
        ]);

        return redirect()->route('questions.show', $question);
    }

    public function show(Question $question)
    {
        $userId = 1;
        $question->load([
            'user',
            'category',
            'answers' => fn($query) =>  $query->with([
                'user',
                'likes'  => fn($query) => $query->where('user_id', $userId),
                'comments' => fn($query) => $query->with([
                    'user',
                    'likes' => fn($query) => $query->where('user_id', $userId),
                ]),
            ]),
            'comments' => fn($query) => $query->with([
                'user',
                'likes' => fn($query) => $query->where('user_id', $userId)
            ]),
            'likes' => fn($query) => $query->where('user_id', $userId)
        ]);

        return view(
            'questions.show',
            /* compact($question) o */
            ["question" => $question]
        );
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('home');
    }
}
