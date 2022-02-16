<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    private $category;
    private $post;
    private $tag;

    public function __construct(Category $category, Post $post, Tag $tag)
    {
        $this->category = $category;
        $this->post = $post;
        $this->tag = $tag;
    }
    public function index()
    {
        // $posts = $this->post->all();
        $highlights = $this->post->all()->sortBy('is_highlight')->pluck('is_highlight')->unique();
        $status = $this->post->all()->sortBy('status')->pluck('status')->unique();

        return view('admin.post.index', compact('highlights', 'status'));
    }
    public function create()
    {
        $tags = $this->tag->all();
        $categories = $this->category->all();
        return view('admin.post.create', compact('tags', 'categories'));
    }
    public function store(StorePostRequest $request)
    {
        try {
            DB::beginTransaction();

            $post = Post::create($request->validated() + ['author_id' => auth()->id()]);

            $post->addFilePondMedia($request, $post, 'posts');

            if (isset($request->categories)) {
                $post->categories()->attach($request->categories);
            }

            $post->tags()->attach($post->storeTag($request));

            DB::commit();

            return redirect()->route('admin.posts.index')->with($post->alertSuccess('store'));
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
        }
    }
    public function show(Post $post)
    {
        //
    }
    public function edit(Post $post)
    {
        $tags = $this->tag->all();
        $tagOfPost = $post->tags;

        $categories = $this->category->all();
        $categoryOfPost = $post->categories;

        return view('admin.post.edit', compact('post', 'tags', 'tagOfPost', 'categories', 'categoryOfPost'));
    }
    public function update(Post $post, UpdatePostRequest $request)
    {
        try {
            DB::beginTransaction();

            $post->update($request->validated());

            $post->editFilePondMedia($request, $post, 'posts');


            if (isset($request->categories)) {
                $post->categories()->sync($request->categories);
            }

            $post->tags()->sync($post->storeTag($request));

            DB::commit();

            return redirect()->route('admin.posts.index')->with($post->alertSuccess('update'));
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
        }
    }
    public function destroy(Post $post)
    {
        return $post->destroyModelHasImage($post, 'posts');
    }
}
