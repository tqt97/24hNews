<?php

namespace App\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryComposer
{
    public function compose(View $view)
    {
        $view->with(
            'categoryView',
            // Category::with('childrens')->where('parent_id', 0)->latest('id')->get()
            Category::with('posts')->get()
        );
    }
}
