<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $folder = uniqid() . '-' . now()->timestamp;
            $file = $request->file('image');
            // foreach ($request->file('images') as $file) {
            $filename = $file->getClientOriginalName();
            $file->storeAs('images/tmp/' . $folder, $filename, 'public');

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename
            ]);
            // }
            return $folder;
        }

        return '';
    }
}
