<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class LanguageController extends Controller
{
    public function change(Request $request)
    {
        $locale = $request->input('locale');

        // Set the application locale
        App::setLocale($locale);

        // Store the selected locale in the session
        session()->put('locale', $locale);

        // Redirect back to the previous page
        return redirect()->back();
    }
}
