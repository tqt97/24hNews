<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TemporaryFile;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $folder = uniqid() . '-' . now()->timestamp;
            $file = $request->file('image');
            // foreach ($files as $file) {
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
    public function update(Request $request)
    {
        $path = storage_path('app/public/images/tmp/' . $request->query('patch') . '/file.part');
        File::append($path, $request->getContent());

        if (filesize($path) == $request->header('Upload-Length')) {
            $name = $request->header('Upload-Name');
            File::move($path, storage_path('app/public/images/tmp/' . $request->query('patch') . '/' . $name));

            TemporaryFile::create([
                'folder' => $request->query('patch'),
                'filename' => $name
            ]);
        }

        return response()->json(['uploaded' => true]);
    }

    public function destroy(Request $request)
    {
        $folder = $request->getContent();
        $files = TemporaryFile::where('folder', $folder)->get();
        foreach ($files as $file) {
            Storage::disk('public')->delete('images/tmp/' . $folder . '/' . $file->filename);
            $file->delete();
        }
        rmdir(storage_path('app/public/images/tmp/' . $folder));
        return Response::json(['success' => true]);
    }
}
