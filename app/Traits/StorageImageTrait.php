<?php

namespace App\Traits;

use Storage;
use Illuminate\Support\Str;


trait StorageImageTrait
{
    public function storeImageUpload($request, $fieldName, $folderName)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $name_file = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            if (
                strcasecmp($extension, 'jpg') == 0 ||
                strcasecmp($extension, 'png') == 0 ||
                strcasecmp($extension, 'jpeg') == 0
            ) {
                $image = Str::random(2) . "-" . $name_file;
                if (file_exists("upload/" . $folderName . "/" . $image)) {
                    $image = Str::random(2) . "-" . $name_file;
                }
                $file->move("upload/" . $folderName, $image);
                $dataUploadTrait = [
                    'image' => $image,

                ];
                return $dataUploadTrait;
            }
        }
        return null;
    }
    public function updateImageUpload($request, $fieldName, $folderName)
    {
        $file = $request->file($fieldName);
        $name_file = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        if (
            strcasecmp($extension, 'jpg') == 0 ||
            strcasecmp($extension, 'png') == 0 ||
            strcasecmp($extension, 'jpeg') == 0
        ) {
            $image = Str::random(2) . "-" . $name_file;
            if (file_exists("upload/" . $folderName . "/" . $image)) {
                $image = Str::random(2) . "-" . $name_file;
            }
            $file->move("upload/" . $folderName, $image);
            $dataUploadTrait = [
                'image' => $image,

            ];
            return $dataUploadTrait;
        }
    }
}
