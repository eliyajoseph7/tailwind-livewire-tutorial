<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Home extends Component
{
    public $search = '';

    public function mount() {
        $this->render();
    }

    public function render()
    {
        return view('livewire.home')->layout('livewire.home');
    }

    public function searchComment() {
        dd('search');
        Comment::where('comment', 'LIKE', '%{$this->message}%')->get();
        $this->emit('search');
    }
}
