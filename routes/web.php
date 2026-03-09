<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/menu', [SiteController::class, 'menu'])->name('menu');
Route::get('/galleria', [SiteController::class, 'gallery'])->name('gallery');
Route::get('/chi-siamo', [SiteController::class, 'about'])->name('about');
Route::get('/contatti', [SiteController::class, 'contact'])->name('contact');
