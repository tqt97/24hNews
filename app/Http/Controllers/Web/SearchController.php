<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $posts = Post::where('status', 1)
            ->where('title', 'like', '%' . request('keyword') . '%')->latest()->get();
        return view('web.search', compact('posts','keyword'));
    }
}
