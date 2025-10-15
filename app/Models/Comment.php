<?php

namespace App\Models;

use App\Traits\HasLike;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory, HasLike;

    protected $fillable = [
        'content',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
