<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;

class QuestionPolicy
{
    public function delete(User $user, Question $question)
    {
        return $user->id === $question->user_id; // true || false
    }

    public function update(User $user, Question $question)
    {
        $isOwn = $user->id === $question->user_id;

        $isEmpty = $question->answers()->count() === 0 && $question->comments()->count() === 0; // ture || flase

        return  $isOwn && $isEmpty;
    }
}
