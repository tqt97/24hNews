<?php

namespace App\Traits;


trait AlertTrait
{
    public function alertSuccess($action)
    {
        if ($action == 'store') {
            return [
                'alert-type' => 'success',
                'message' => 'Thêm thành công'
            ];
        } else if ($action == 'update') {
            return [
                'alert-type' => 'success',
                'message' => 'Cập nhật thành công'
            ];
        } else if ($action == 'destroy') {
            return [
                'alert-type' => 'success',
                'message' => 'Xóa thành công'
            ];
        }
    }
}
