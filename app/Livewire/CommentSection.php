<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class CommentSection extends Component
{
    use WithPagination;

    public $name;
    public $comment;
    public $editCommentId;
    public $button = 'add';
    public $perPage = 15;


    protected $listeners = ['commentAdded' => '$refresh'];

    public function loadMore()
    {
        $this->perPage += 15;
    }
    public function render()
    {
        $comments = Comment::latest()->Paginate($this->perPage);
        return view('livewire.comment-section', compact('comments'));
    }


    public function add()
    {
        $this->validate([
            'name' => 'required',
            'comment' => 'required',
        ]);

        Comment::create([
            'name' => $this->name,
            'comment' => $this->comment,
        ]);

        $this->reset(['name', 'comment']);
    }

    public function editComment($commentId)
    {
        $this->editCommentId = $commentId;
        $this->button = 'update';
        $comment = Comment::findOrFail($commentId);
        $this->name = $comment->name;
        $this->comment = $comment->comment;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'comment' => 'required',
        ]);

        $comment = Comment::findOrFail($this->editCommentId);
        $comment->update([
            'name' => $this->name,
            'comment' => $this->comment,
        ]);
        $this->button = 'add';
        $this->reset(['editCommentId', 'name', 'comment']);
    }

    public function deleteComment($commentId)
    {
        Comment::findOrFail($commentId)->delete();
    }
}
