<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

//  المسار الرئيسي للموقع
Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['ar', 'en', 'fr'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');
Route::get('/download-cv/{locale}', function ($locale) {
    if (! in_array($locale, ['ar', 'en', 'fr'])) {
        abort(400);
    }

    return view('cv-template'); // سننشئ هذا الملف الآن
})->name('cv.download');
 
