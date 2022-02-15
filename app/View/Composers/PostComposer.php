<?php

namespace App\View\Composers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\View\View;

class PostComposer
{
    public function compose(View $view)
    {
        $view->with('postView', Post::take(4)->latest()->get());
    }
}
