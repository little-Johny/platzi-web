<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Comment extends Component
{
    public Model $commentable;
    public bool $showForm = false;
    public string $content = '';

    public function toggle()
    {
        $this->showForm = !$this->showForm;
    }

    public function add()
    {
        $this->validate([
            'content' => 'required|string|max:255',
        ]);

        $this->commentable->comments()->create([
            'content' => $this->content,
            'user_id' => 1, // Reemplazar por el id del usuario de la sesion
        ]);

        // Reiniciar variables
        /* $this->content = '';
        $this->showForm = false; */

        $this->reset('content','showForm');
    }

    public function render()
    {
        return view('livewire.comment', [
            'comments' => $this->commentable->comments,
        ]);
    }
}
