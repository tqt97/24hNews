<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Slider;

class HomeController extends Controller
{
    public function __invoke()
    {
        $posts = Post::highlightPost()->take(8)->latest()->get();
        // ->when(request('category_id'), function ($query) {
        //     return $query->whereHas('categories', function ($q) {
        //         return $q->where('id', request('category_id'));
        //     });
        // })
        // ->when(request('tag_id'), function ($query) {
        //     return $query->whereHas('tags', function ($q) {
        //         return $q->where('id', request('tag_id'));
        //     });
        // })
        // ->when(request('query'), function ($query) {
        //     return $query->where('title', 'like', '%' . request('query') . '%');
        // })
        // ->take(8)->latest()->get();
        // ->paginate(2);

        $sliders = Slider::getSlider()->take(8)->latest()->get();
        return view('web.home', compact('posts','sliders'));
    }
}
