<?php

use Illuminate\Http\UploadedFile;

if (! function_exists('imageUpload')) {

    function imageUpload(UploadedFile $file, string $folder): string
    {
        // Helper logic here
        $imageName = time() . '_' . $file->getClientOriginalName();
        $path = public_path("storage/{$folder}");

        if (! is_dir($path)) {
            mkdir($path, 0755, true);
        }

        // Handle Livewire temporary file or normal file
        if (method_exists($file, 'store')) {
            // Livewire temporary upload
            $file->storeAs($folder, $imageName, 'public');
        } else {
            // Regular UploadedFile instance
            $file->move($path, $imageName);
        }

        return $imageName;
    }
}
