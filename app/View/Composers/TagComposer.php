<?php

namespace App\View\Composers;

use App\Models\Tag;
use Illuminate\View\View;

class TagComposer
{
    public function compose(View $view)
    {
        $view->with('tagView', Tag::take(8)->latest()->get());
    }
}
