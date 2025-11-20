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

    protected function handleAlbumUploads(
        Request $request,
        array   &$data,
        string  $folder,
                $model = null,
        string  $field = 'album',
        string  $disk = 'public'
    ): void
    {
        $currentAlbum = [];
        if ($model && isset($model->{$field}) && is_array($model->{$field})) {
            $currentAlbum = $model->{$field};
        }
        $album = $request->input($field, []);

        if (!is_array($album)) {
            $album = [];
        }
        if ($request->hasFile('album_files')) {
            foreach ($request->file('album_files') as $file) {
                if (!$file->isValid()) {
                    continue;
                }
                $baseName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $baseName = Str::slug($baseName);
                $extension = $file->getClientOriginalExtension();
                $fileName = $baseName . '-' . time() . '-' . mt_rand(111, 999) . '.' . $extension;

                $path = $file->storeAs($folder, $fileName, $disk);
                $album[] = $path;
            }
        }
        $deleted = array_diff($currentAlbum, $album);
        foreach ($deleted as $oldPath) {
            Storage::disk($disk)->delete($oldPath);
        }
        $data[$field] = $album;
    }

    protected function deleteAlbumFiles($model, string $field = 'album', string $disk = 'public'): void
    {
        if (!$model || !isset($model->{$field}) || !is_array($model->{$field})) {
            return;
        }

        foreach ($model->{$field} as $path) {
            Storage::disk($disk)->delete($path);
        }
    }
}
