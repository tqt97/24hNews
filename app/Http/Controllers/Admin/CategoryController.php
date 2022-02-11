<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Recursives\CategoryRecursive;
use App\Traits\DeleteModelTrait;


class CategoryController extends Controller
{
    use DeleteModelTrait;
    private $categoryRecursive;
    private $category;

    public function __construct(Category $category, CategoryRecursive $categoryRecursive)
    {
        $this->category = $category;
        $this->categoryRecursive = $categoryRecursive;
    }

    public function index()
    {
        $categories = $this->category->with('author')->latest()->paginate(10);
        return view('admin.src.category.index', compact('categories'));
    }

    public function create()
    {
        $htmlOption = $this->categoryRecursive->categoryCreateRecursive();
        return view('admin.src.category.create', compact('htmlOption'));
    }

    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated() + ['author_id' => auth()->id()]);

        return redirect()->route('admin.category.index')->with([
            'alert-type' => 'success',
            'message' => 'Thêm danh mục thành công'
        ]);
    }

    public function edit(Category $category)
    {
        $htmlOption = $this->categoryRecursive->categoryEditRecursive($category->parent_id);
        return view('admin.src.category.edit', compact('category', 'htmlOption'));
    }

    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $category->update($request->validated());
        
        return redirect()->route('admin.category.index')->with([
            'alert-type' => 'success',
            'message' => 'Cập nhật danh mục thành công'
        ]);
    }
    public function destroy(Category $category)
    {
        return $this->deleteModelTrait($category);
    }
}
