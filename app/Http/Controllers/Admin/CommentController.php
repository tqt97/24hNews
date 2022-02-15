<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $comment;
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
    public function index()
    {
        $comments = $this->comment->all();
        return view('admin.comment.index', compact('comments'));
    }
    public function edit(Comment $comment)
    {
        return view('admin.comment.edit', compact('comment'));
    }
    public function update(Comment $comment, Request $request)
    {
        $comment->update($request->all());
        return redirect()->route('admin.comment.index');
    }
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comment.index');
    }
}
