<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Intervention\Image\ImageManagerStatic as Image;

class Comments extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $commentId = '';
    public $method = 'addComment';
    public $action = 'Add';
    public $comment;
    public $search = '';
    // public $comments;
    public $image;

    protected $listeners = [
        'search' => 'render',
        'uploadImage' => 'handleImageUpload',
    ];

    protected $rules = [
        'comment' => 'required|min:5'
    ];
    
    public function render()
    {
        // $this->getComments();
        $comments = Comment::latest()->paginate(2);
        return view('livewire.comments', compact('comments'));
    }

    public function getComments() {
        $comments = Comment::latest()->paginate(2);

        // $this->comments = $comments;
    }

    public function handleImageUpload($imageData) {
        $this->image = $imageData;
    }

    public function addComment($formData) {
       $this->validate();
        // dd($formData['comment']);
        $image = $this->storeImage();
        $data = new Comment;
        $data->comment = $this->comment;
        $data->image = $image;

        $data->save();

        session()->flash('feedback', 'Comment successfully added.');
        $this->reset('comment', 'image');
        $this->render();

    }

    public function storeImage() {
        if(!$this->image) return null;
        $img = Image::make($this->image)->encode('jpg');
        $name = time().'.jpg';
        Storage::disk('public')->put($name, $img);
        // $this->getImagePathAttribute($name);
        return $name;
    }

    public function getImagePathAttribute($image) {
        return Storage::disk('public')->url($image);
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
        $comment = Comment::find($id);
        Storage::disk('public')->delete($comment->image);

        $comment->delete();

        session()->flash('feedback', 'Comment successfully deleted.');
        $this->render();
    }
}
