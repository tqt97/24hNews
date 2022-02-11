<?php

namespace App\Observers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Traits\HandleTag;
use App\Traits\UploadMedia;

class PostObserver
{
    use  UploadMedia, HandleTag;
    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function saving(Post $post)
    {
        $this->storeMedia($request, $post, 'image', 'image_post');

        if (isset($request->categories)) {
            $post->categories()->attach($request->categories);
        }
        $post->tags()->attach($this->storeTag($request));
    }


    public function created(Post $post)
    {
        //


    }

    /**
     * Handle the Post "updated" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
