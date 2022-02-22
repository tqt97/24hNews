<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Slider;
use App\Models\Tag;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('media')->onlyTrashed()->paginate(10);
        $posts = Post::with('media')->onlyTrashed()->paginate(10);
        $sliders = Slider::with('media')->onlyTrashed()->paginate(10);
        $admins = Admin::with('media')->onlyTrashed()->paginate(10);
        return view('admin.history.index', compact('categories', 'posts',   'sliders', 'admins'));
    }
}
