<?php

namespace App\Helpers;

use App\Models\Widget;

class WidgetHelper
{
    public static function get(string $code)
    {
        return Widget::query()->where('code', $code)->where('status', 1)->with(['items.router'])->first();
    }
}
