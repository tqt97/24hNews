<?php

namespace App\Libraries;

use App\Models\Category;

class CategoryRecursive
{
    private $html;
    public function __construct()
    {
        $this->html = '';
    }
    public function categoryListRecursive($id = 0, $subMark = '| --')
    {
        $data = Category::where('parent_id', $id)->get();
        foreach ($data as $item) {
            $this->html .= '<option value="' . $item->name . '">' . $subMark ." ". $item->name . '</option>';
            $this->categoryCreateRecursive($item->id, $subMark . ' --');
        }

        return $this->html;
    }
    public function categoryCreateRecursive($id = 0, $subMark = '| --')
    {
        $data = Category::where('parent_id', $id)->get();
        foreach ($data as $item) {
            $this->html .= '<option value="' . $item->id . '">' . $subMark ." ". $item->name . '</option>';
            $this->categoryCreateRecursive($item->id, $subMark . ' --');
        }

        return $this->html;
    }

    public function categoryEditRecursive($id, $parentId = 0, $subMark = '| --')
    {
        $data = Category::where('parent_id', $parentId)->get();
        foreach ($data as $item) {
            if ($id == $item->id) {
                $this->html .= '<option selected value="' . $item->id . '">' . $subMark ." ". $item->name . '</option>';
            } else {
                $this->html .= '<option value="' . $item->id . '">' . $subMark ." ". $item->name . '</option>';
            }

            $this->categoryEditRecursive($id, $item->id, $subMark . ' --');
        }

        return $this->html;
    }
}
