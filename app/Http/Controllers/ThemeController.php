<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class ThemeController extends Controller
{
    public function changeTheme($theme)
    {
        Session::put('theme', $theme);

        return redirect()->back();
    }

    public function switchLanguage(Request $request)
    {
        $locale = $request->lang;
        if (in_array($locale, ['en', 'fr']))
        {
            Session::put('locale', $locale);
        }

        return redirect()->back()->with('success', 'Language Changed Successfully');
    }
}
