<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        if (array_key_exists($lang, \Localization::getSupportedLocales()->toArray())) {

            Session::put('applocale', $lang);
        }
        return redirect()->back();
    }
}
