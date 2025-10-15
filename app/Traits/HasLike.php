<?php


namespace App\Traits;

use App\Models\Like;

trait HasLike
{
  public function likes()
  {
    return $this->morphMany(Like::class, 'likeable');
  }

  public function isLiked()
  {
    return $this->likes()->where('user_id', 1)->exists();
  }

  public function like()
  {
    $this->likes()->create(['user_id' => 1]);
  }

  public function unlike()
  {
    $this->likes()->where('user_id', 1)->delete();
  }
}
