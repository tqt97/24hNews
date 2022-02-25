<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function index($locale)
    {
        $lang = $locale;
        Session::put('language', $lang);
        return redirect()->back();
    }
}
