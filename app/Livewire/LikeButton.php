<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class LikeButton extends Component
{   
    public  Model $likeable;
    
    public function toggle() {
        if ($this->likeable->isLiked()) {
            $this->likeable->unlike();
        } else {
            $this->likeable->like();
        }
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
