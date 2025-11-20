<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function getHomePage(Request $request)
    {
        return view('frontend.home.index');
    }
}
