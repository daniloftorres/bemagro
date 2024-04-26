<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function setLanguage(Request $request)
    {
        $language = $request->input('language', 'en');
        App::setLocale($language);
        Session::put('language', $language);
        return back();
    }
}
