<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;

class TagController extends Controller
{
    private $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function index()
    {
        $tags = $this->tag->latest()->paginate(8);
        return view('admin.tag.index', compact('tags'));
    }


    public function create()
    {
        return view('admin.tag.create');
    }


    public function store(StoreTagRequest $request)
    {
        $tag =  $this->tag->create([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.tags.index')->with($tag->alertSuccess('store'));
    }

    public function show($id)
    {
    }

    public function edit(Tag $tag)
    {
        return view('admin.tag.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.tags.index')->with($tag->alertSuccess('update'));
    }


    public function destroy(Tag $tag)
    {
        return $tag->destroyModel($tag);
    }
}
