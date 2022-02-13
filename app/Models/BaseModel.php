<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class BaseModel extends Model
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
    public function destroyModelHasImage($model, $collection)
    {
        try {
            $model->clearMediaCollection($collection);
            $model->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
    public function destroyModel($model)
    {
        try {
            $model->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
}
