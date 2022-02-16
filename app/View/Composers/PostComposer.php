<?php

namespace App\View\Composers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\View\View;

class PostComposer
{
    public function compose(View $view)
    {
        $view->with('postView', Post::with('media')->take(8)->latest()->get());
    }
}
