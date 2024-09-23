<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploader
{
    public function upload(array $files): bool
    {
        try {
            foreach($files as $file) {
                $fileName = $file->getClientOriginalName();
                $filePath = sprintf('images/%s.%s', Str::random(32), $file->getClientOriginalExtension());
                Storage::disk('public')->put($filePath , $file->get());

                Post::create([
                    'name' => $fileName,
                    'image_path' => $filePath
                ]);

            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
