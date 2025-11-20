<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HandlesUploads
{
    protected function handleUploads(
        Request $request,
        array   &$data,
        string  $folder,
                $model = null,
        string  $field = 'image',
        string  $disk = 'public'
    ): void
    {
        $currentPath = null;
        if ($model && isset($model->{$field})) {
            $currentPath = $model->{$field};
        }

        if ($request->hasFile($field)) {
            if (!empty($currentPath)) {
                Storage::disk($disk)->delete($currentPath);
            }

            $file = $request->file($field);

            $baseName = $data['canonical'] ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $baseName = Str::slug($baseName);
            $extension = $file->getClientOriginalExtension();
            $fileName = $baseName . '-' . time() . '.' . $extension;

            $path = $file->storeAs($folder, $fileName, $disk);
            $data[$field] = $path;
        } else {
            if (!empty($currentPath)) {
                $data[$field] = $currentPath;
            }
        }
    }
}
