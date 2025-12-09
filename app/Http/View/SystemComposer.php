<?php

namespace App\Http\View;

use Illuminate\View\View;
use App\Models\System;

class SystemComposer
{
    public function compose(View $view)
    {
        $systems = System::all();
        $systemArray = convert_array($systems, 'keyword', 'content');
        $view->with('system', $systemArray);
    }
}
