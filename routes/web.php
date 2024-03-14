<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactUsController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    // Check if the view is already cached
    if (Cache::has('cached_welcome_view')) {
        // If cached, return the cached view
        return Cache::get('cached_welcome_view');
    }

    // If not cached, render the view and cache it
    $view = view('welcome')->render();

    // Cache the rendered view for a specified duration (e.g., 1 hour)
    Cache::put('cached_welcome_view', $view, now()->addHour());

    return $view;
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact');
