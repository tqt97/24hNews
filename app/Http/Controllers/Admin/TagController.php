<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;

class TagController extends Controller
{
    use DeleteModelTrait;
    private $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = $this->tag->latest()->paginate(8);
        return view('admin.src.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.src.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {
        $this->tag->create([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.tag.index')->with([
            'alert-type' => 'success',
            'message' => 'Thêm tag thành công'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = $this->tag->findOrFail($id);
        return view('admin.src.tag.edit', compact('tag'));
        // return response()->json([
        //     'data' => $tag
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, $id)
    {
        $this->tag->findOrFail($id)->update([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.tag.index')->with([
            'alert-type' => 'success',
            'message' => 'Thêm tag thành công'
        ]);
        // return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->deleteModelTrait($id, $this->tag);
    }
}
