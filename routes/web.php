<?php

use Illuminate\Support\Facades\Route;
use illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('vue.accueil');
})->name('accueil');

Route::get('destination', function () {
    return view('vue.destination');
})->name('destination');

Route::get('equipage', function () {
    return view('vue.equipage');
})->name('equipage');

Route::get('technologie', function () {
    return view('vue.technologie');
})->name('technologie');


Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['fr', 'en'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();});
