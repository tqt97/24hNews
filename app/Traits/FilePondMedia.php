<?php

namespace App\Traits;

use App\Models\TemporaryFile;

trait FilePondMedia
{
    public function addFilePondMedia($request, $model, $collection)
    {
        $fileName = $request->image;
        $tmpFile = TemporaryFile::where('folder', $fileName)->first();
        if ($tmpFile) {
            $model->addMedia(storage_path('app/public/images/tmp/' . $fileName . '/' . $tmpFile->filename))
                ->sanitizingFileName(function ($fileName) {
                    return strtolower(str_replace(['!', '@', '#', '$', '%', '^', '&', '*', '/', '\\', ' '], '-', $fileName));
                })
                ->toMediaCollection($collection);
            rmdir(storage_path('app/public/images/tmp/' . $fileName));
            $tmpFile->delete();
        }
    }
    public function editFilePondMedia($request, $model, $collection)
    {
        $fileName = $request->image;
        $tmpFile = TemporaryFile::where('folder', $fileName)->first();
        if ($tmpFile) {
            $model->clearMediaCollection($collection);
            $model->addMedia(storage_path('app/public/images/tmp/' . $fileName . '/' . $tmpFile->filename))
                ->sanitizingFileName(function ($fileName) {
                    return strtolower(str_replace(['!', '@', '#', '$', '%', '^', '&', '*', '/', '\\', ' '], '-', $fileName));
                })
                ->toMediaCollection($collection);
            rmdir(storage_path('app/public/images/tmp/' . $fileName));
            $tmpFile->delete();
        }
    }

}
