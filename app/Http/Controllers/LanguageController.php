<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        // Available languages
        $availableLangs = ['bn', 'en', 'ar'];
        
        // Check if the language is supported
        if (in_array($lang, $availableLangs)) {
            Session::put('locale', $lang);
            App::setLocale($lang);
        }
        
        return redirect()->back();
    }
}
