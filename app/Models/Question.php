<?php

namespace App\Models;

use App\Traits\HasLike;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory, HasLike;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    protected static function booted()
    {
        static::deleting(function (self $question) {
            $question->likes()->delete();
            
            $question->comments()->get()->each(function ($comment) {
                $comment->likes()->delete();
                $comment->delete();
            });

            $question->answers()->get()->each(function ($answer) {
                $answer->likes()->delete();

                $answer->comments()->get()->each(function ($comment) {
                    $comment->likes()->delete();

                    $comment->delete();
                });
            });
        });
    }
}
