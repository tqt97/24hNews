<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Libraries\CategoryRecursive;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    private $categoryRecursive;
    private $category;

    public function __construct(Category $category, CategoryRecursive $categoryRecursive)
    {
        $this->category = $category;
        $this->categoryRecursive = $categoryRecursive;
    }

    public function index()
    {

        $highlights = $this->category->all()->sortBy('is_highlight')->pluck('is_highlight')->unique();
        $status = $this->category->all()->sortBy('status')->pluck('status')->unique();

        return view('admin.category.index', compact('status', 'highlights'));
    }

    public function create()
    {
        $htmlOption = $this->categoryRecursive->categoryCreateRecursive();
        return view('admin.category.create', compact('htmlOption'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = $this->category->create($request->validated() + ['author_id' => auth()->id()]);

        $category->addFilePondMedia($request, $category, 'categories');

        return redirect()->route('admin.categories.index')->with($category->alertSuccess('store'));
    }

    public function edit(Category $category)
    {
        $htmlOption = $this->categoryRecursive->categoryEditRecursive($category->parent_id);
        return view('admin.category.edit', compact('category', 'htmlOption'));
    }

    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $category->update($request->validated());

        $category->editFilePondMedia($request, $category, 'categories');

        return redirect()->route('admin.categories.index')->with($category->alertSuccess('update'));
    }
    public function destroy(Category $category)
    {
        return $category->destroyModelHasImage($category, 'categories');
    }
    public function destroyMultiple(Request $request)
    {
        $ids = explode(",", $request->ids);

        $this->category->whereIn('id', $ids)->delete();
        return response()->json([
            'code' => 200,
            'message' => 'success'
        ], 200);
    }
    public function forceDestroy(int $id)
    {
        $category = $this->category->withTrashed()->findOrFail($id);
        $category->clearMediaCollection('categories');
        $category =  $category->forceDelete();

        return redirect()->back()->with($this->category->alertSuccess('success'));
    }
    public function forceDestroyMultiple(Request $request)
    {
        $ids = explode(",", $request->ids);
        $categories = $this->category->whereIn('id', $ids)->withTrashed()->get();
        foreach ($categories as $category) {
            $category->clearMediaCollection('categories');
            $category->forceDelete();
        }
        return response()->json([
            'code' => 200,
            'message' => 'success'
        ], 200);
    }
    public function restore(int $id)
    {
        $category = $this->category->withTrashed()->findOrFail($id);
        if ($category && $category->trashed()) {
            $category->restore();
            return redirect()->back()->with($category->alertSuccess('restore'));
        }
    }
    public function restoreMultiple(Request $request)
    {
        $ids = explode(",", $request->ids);

        $categories = $this->category->whereIn('id', $ids)->withTrashed()->get();
        foreach ($categories as $category) {
            $category->restore();
        }
        return response()->json([
            'code' => 200,
            'message' => 'success'
        ], 200);
    }
}
