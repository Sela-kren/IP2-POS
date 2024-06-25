<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileUpload
{
    public static function uploadFile($file, $folder, $fileName = null)
    {
        // Generate a unique file name if not provided
        $fileName = $fileName ?? time() . '_' . $file->getClientOriginalName();

        // Store the file
        $path = $file->storeAs($folder, $fileName, 'public');

        // Return the URL to the stored file
        return [
            'url' => Storage::url($path),
            'path' => $path
        ];
    }
}