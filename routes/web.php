<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/search', [WelcomeController::class, 'search'])->name('search');
Route::get('/documents/{document}', [WelcomeController::class, 'show'])->name('documents.show');

Route::view('/issuances', 'issuances')->name('issuances');
Route::view('/bulletins', 'bulletins')->name('bulletins');
Route::view('/about', 'about')->name('about');
Route::view('/help', 'help')->name('help');
