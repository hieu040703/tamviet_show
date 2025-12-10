<?php

use App\Models\System;

if (!function_exists('convert_array')) {
    function convert_array($items, $keyField, $valueField)
    {
        $result = [];
        foreach ($items as $item) {
            $result[$item[$keyField]] = $item[$valueField];
        }
        return $result;
    }
}

if (!function_exists('system_setting')) {
    function system_setting(string $keyword, $default = null)
    {
        static $systemCache = null;
        if ($systemCache === null) {
            $systems = System::all();
            $systemCache = convert_array($systems, 'keyword', 'content');
        }

        return $systemCache[$keyword] ?? $default;
    }
}
