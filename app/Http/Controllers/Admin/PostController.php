<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\PostTag;
use App\Models\Tag;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    use DeleteModelTrait, StorageImageTrait;
    private $category;
    private $post;
    private $postImage;
    private $tag;
    private $postTag;

    public function __construct(
        Category $category,
        Post $post,
        PostImage $postImage,
        Tag $tag,
        PostTag $postTag
    ) {
        $this->category = $category;
        $this->post = $post;
        $this->postImage = $postImage;
        $this->tag = $tag;
        $this->postTag = $postTag;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->post->latest()->paginate(10);
        return view('admin.src.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->all();
        $tags = $this->tag->all();
        return view('admin.src.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'title' => $request->title,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'content' => $request->content,
                'user_id' => Auth::user()->id,
                'is_highlight' => $request->is_highlight ? 1 : 0,
                'status' => $request->status ? 1 : 0,
            ];
            $dataImage = $this->storeImageUpload($request, 'image', 'post');
            if (!empty($dataImage)) {
                $data['image'] = $dataImage['image'];
            }
            $post = $this->post->create($data);

            // Insert tags for post
            $tagIds = [];
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    // Insert to tags
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
            }
            $post->tags()->attach($tagIds);

            DB::commit();
            return redirect()->route('admin.post.index')->with([
                'alert-type' => 'success',
                'message' => 'Thêm bài viết thành công'
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->post->findOrFail($id);
        $categories = $this->category->all();
        $tags = $this->tag->all();
        return view('admin.src.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $post = $this->post->findOrFail($id);

            $data = [
                'title' => $request->title,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'content' => $request->content,
                'user_id' => Auth::user()->id,
                'is_highlight' => $request->is_highlight ? 1 : 0,
                'status' => $request->status ? 1 : 0,
            ];
            if ($request->hasFile('image')) {
                if ($post->image) {
                    unlink("upload/post/" . $post->image);
                }
                $dataImage = $this->updateImageUpload($request, 'image', 'post');
                if (!empty($dataImage)) {
                    $data['image'] = $dataImage['image'];
                } else {
                    $data['image'] = $post->image;
                }
            }
            $this->post->findOrFail($id)->update($data);

            // Insert tags for post
            $tagIds = [];
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    // Insert to tags
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
            }
            $post->tags()->sync($tagIds);

            DB::commit();
            return redirect()->route('admin.post.index')->with([
                'alert-type' => 'success',
                'message' => 'Sửa bài viết thành công'
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->deleteModelHasImageTrait($id, $this->post, 'post');

    }
}
