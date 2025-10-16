<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Category;
use App\Models\Question;
use App\Support\QuestionShowLoader;

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

    public function store(StoreQuestionRequest $request)
    {
        $request->validate([
            
        ]);

        $question = Question::create([
            'user_id'       => 1,
            'category_id'   => $request->category_id,
            'title'         => $request->title,
            'description'   => $request->description
        ]);

        return redirect()->route('questions.show', $question);
    }

    public function edit(Question $question)
    {
        $categories = Category::all();

        return view('questions.edit', [
            'question'      => $question,
            'categories'    => $categories
        ]);
    }

    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $request->validate([
            
        ]);

        $question->update([
            'category_id'   => $request->category_id,
            'title'         => $request->title,
            'description'   => $request->description
        ]);

        return redirect()->route('questions.show', $question);
    }

    public function show(Question $question, QuestionShowLoader $loader)
    {   
        $loader->load($question);

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
