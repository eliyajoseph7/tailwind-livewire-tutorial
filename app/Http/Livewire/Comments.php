<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Http\Request;
use Livewire\Component;

class Comments extends Component
{
    public $commentId = '';
    public $method = 'addComment';
    public $action = 'Add';
    public $comment;
    public $search = '';
    public $comments = [];

    protected $listeners = ['search' => 'render'];

    protected $rules = [
        'comment' => 'required|min:5'
    ];
    
    public function render()
    {
        $this->getComments();
        return view('livewire.comments');
    }

    public function getComments() {
        $comments = Comment::latest()->get();

        $this->comments = $comments;
    }

    public function addComment($formData) {
       $this->validate();
        // dd($formData['comment']);
        $data = new Comment;
        $data->comment = $this->comment;

        $data->save();

        session()->flash('feedback', 'Comment successfully added.');
        $this->reset('comment');
        $this->render();

    }


    // public function searchComment() {
    //     $data = Comment::where('comment', 'LIKE', '%{$this->comment}%')->get();
    //     $this->comments = $data;
    //     dd($data);
    // }

    public function editComment($id) {
        $this->commentId = $id;
        $comment = Comment::find($id);
        $this->action = 'Update';
        $this->method = 'updateComment';
        $this->comment = $comment->comment;
    }

    public function updateComment($formData) {
        $data = Comment::find($this->commentId);
        $data->comment = $formData['comment'];

        $data ->save();
        $this->reset(['commentId', 'action', 'comment', 'method']);

        session()->flash('feedback', 'Comment successfully updated.');
        $this->render();
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function deleteComment($id) {
        Comment::find($id)->delete();

        session()->flash('feedback', 'Comment successfully deleted.');
        $this->render();
    }
}
