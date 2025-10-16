<?php

namespace App\Support;

use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class QuestionShowLoader
{
  public function load(Question $question)
  {
    $userId = Auth::id();
    return [
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
    ];
  }
}
