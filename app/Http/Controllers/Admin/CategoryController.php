<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Recursives\CategoryRecursive;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;


class CategoryController extends Controller
{
    use DeleteModelTrait, StorageImageTrait;
    private $categoryRecursive;
    private $category;

    public function __construct(Category $category, CategoryRecursive $categoryRecursive)
    {
        $this->category = $category;
        $this->categoryRecursive = $categoryRecursive;
    }

    public function index()
    {
        $categories = $this->category->latest()->paginate(10);
        return view('admin.src.category.index', compact('categories'));
    }

    public function create()
    {
        $htmlOption = $this->categoryRecursive->categoryCreateRecursive();
        return view('admin.src.category.create', compact('htmlOption'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = [
            'user_id' => auth()->id(),  // auth()->id() || Auth::user()->id
        ];
        $dataImage = $this->storeImageUpload($request, 'image', 'category');
        if (!empty($dataImage)) {
            $data['image'] = $dataImage['image'];
        }
        Category::create($request->validated() + $data);
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
        $data = [];
        if ($request->hasFile('image')) {
            if ($category->image) {
                unlink("upload/category/" . $category->image);
            }
            $dataImage = $this->updateImageUpload($request, 'image', 'category');
            if (!empty($dataImage)) {
                $data['image'] = $dataImage['image'];
            } else {
                $data['image'] = $category->image;
            }
        }
        $category->update($request->validated() + $data);
        return redirect()->route('admin.category.index')->with([
            'alert-type' => 'success',
            'message' => 'Cập nhật danh mục thành công'
        ]);
    }
    public function destroy(Category $category)
    {
        return $this->deleteModelHasImageTrait($category, 'category');
    }
}
