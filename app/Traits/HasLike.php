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
    if ($this->relationLoaded('likes')) {
      return  $this->likes->isNotEmpty();
    }

    return $this->likes()->where('user_id', auth()->id())->exists();
  }

  public function like()
  {
    $this->likes()->create(['user_id' => auth()->id()]);
  }

  public function unlike()
  {
    $this->likes()->where('user_id', auth()->id())->delete();
  }
}
