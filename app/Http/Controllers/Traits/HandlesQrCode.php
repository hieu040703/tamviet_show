<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

trait HandlesQrCode
{
    protected function generateQrForModel(
        string $routeName,
               $model,
        string $folder = 'qrcodes',
        string $field = 'qr_code',
        int    $size = 300,
        string $disk = 'public'
    ): void
    {
        $qrContent = route($routeName, $model->id);

        $qrSvg = QrCode::format('svg')
            ->size($size)
            ->generate($qrContent);

        $fileName = strtolower(class_basename($model)) . '_' . $model->id . '.svg';
        $qrPath = trim($folder, '/') . '/' . $fileName;

        Storage::disk($disk)->put($qrPath, $qrSvg);

        $model->update([$field => $qrPath]);
    }

    protected function deleteQrForModel(
        $model,
        string $field = 'qr_code',
        string $disk = 'public'
    ): void
    {
        $path = $model->{$field} ?? null;

        if (!empty($path)) {
            Storage::disk($disk)->delete($path);
        }
    }
}
