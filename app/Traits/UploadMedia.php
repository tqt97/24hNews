<?php

namespace App\Traits;

use Storage;

trait UploadMedia
{
    public function storeImage($request, $model, $fieldName, $collection)
    {
        if ($request->hasFile($fieldName)) {
            $model->addMediaFromRequest($fieldName)
                ->sanitizingFileName(function ($fileName) {
                    return strtolower(str_replace(['!', '@', '#', '$', '%', '^', '&', '*', '/', '\\', ' '], '-', $fileName));
                })->toMediaCollection($collection);
        }
    }

    public function updateImage($request, $model, $fileName, $collection)
    {

        if ($request->hasFile($fileName)) {
            $model->clearMediaCollection($collection);
            $model->addMediaFromRequest($fileName)
                ->sanitizingFileName(function ($fileName) {
                    return strtolower(str_replace(['!', '@', '#', '$', '%', '^', '&', '*', '/', '\\', ' '], '-', $fileName));
                })
                ->toMediaCollection($collection);
        }
    }
}
