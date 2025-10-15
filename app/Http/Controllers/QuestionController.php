<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
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
