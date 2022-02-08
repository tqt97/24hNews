<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;


class CategoryController extends Controller
{
    use DeleteModelTrait, StorageImageTrait;
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function index()
    {
        $categories = $this->category->latest()->paginate(10);
        return view('admin.src.category.index', compact('categories'));
    }
    public function create()
    {
        return view('admin.src.category.create');
    }
    public function store(CreateCategoryRequest $request)
    {
        $data = [
            'name' => $request->name,
            'user_id' => Auth::user()->id,
            'is_new' => $request->is_new ? 1 : 0,
            'status' => $request->status ? 1 : 0,
        ];
        $dataImage = $this->storeImageUpload($request, 'image', 'category');
        if (!empty($dataImage)) {
            $data['image'] = $dataImage['image'];
        }
        $this->category->create($data);
        return redirect()->route('admin.category.index')->with([
            'alert-type' => 'success',
            'message' => 'Thêm danh mục thành công'
        ]);
    }
    public function edit($id)
    {
        $category = $this->category->findOrFail($id);
        return view('admin.src.category.edit', compact('category'));
    }

    public function update(EditCategoryRequest $request, $id)
    {
        $category = $this->category->findOrFail($id);
        $data = [
            'name' => $request->name,
            'user_id' => Auth::user()->id,
            'is_new' => $request->is_new ? 1 : 0,
            'status' => $request->status ? 1 : 0,
        ];
        if ($request->hasFile('image')) {
            if ($category->image) {
                unlink("upload/category/" . $category->image);
            }
            $dataImage = $this->storeImageUpload($request, 'image', 'category');
            if (!empty($dataImage)) {
                $data['image'] = $dataImage['image'];
            } else {
                $data['image'] = $category->image;
            }
        }
        $category->update($data);
        return redirect()->route('admin.category.index')->with([
            'alert-type' => 'success',
            'message' => 'Cập nhật danh mục thành công'
        ]);
    }
    public function destroy($id)
    {
        return $this->deleteModelHasImageTrait($id, $this->category, 'category');
    }
}
