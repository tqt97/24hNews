<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        Comment::create([
            'content' => $request->content,
            'user_id' => auth()->user()->id,
            'post_id' => $request->post_id,
            'status' =>  1,
        ]);
        return redirect()->back()->with([
            'alert-type' => 'success',
            'message' =>  'Bình luận thành công. Quản trị sẽ kiểm duyệt trước khi hiển thị.'
        ]);
    }
}
