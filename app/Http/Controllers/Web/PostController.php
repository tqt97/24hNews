<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts= Post::getPost()->get();
        return view('web.post.list', compact('posts'));
    }
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('web.post.show', compact('post'));
    }
}
