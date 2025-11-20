<?php

namespace App\Helpers;

use App\Models\Router;
use Illuminate\Support\Str;

class RouterHelper
{
    public static function sync(string $module, int $objectId, ?string $canonical, ?string $fallbackName = null): Router
    {
        $slug = $canonical ?: ($fallbackName ? Str::slug($fallbackName) : null);

        if (!$slug) {
            throw new \InvalidArgumentException('Canonical hoặc fallbackName phải có.');
        }

        return Router::updateOrCreate(
            [
                'module' => $module,
                'object_id' => $objectId,
            ],
            [
                'canonical' => $slug,
            ]
        );
    }

    public static function delete(string $module, int $objectId): void
    {
        Router::where('module', $module)
            ->where('object_id', $objectId)
            ->delete();
    }

    public static function findByCanonical(string $canonical): ?Router
    {
        return Router::where('canonical', $canonical)->first();
    }
}
