<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// landing page
Route::get('/', function () {
    return view('index');
});

// documentation
Route::get('/docs', function () {
    return view('docs');
});

// student list
Route::get('/student', function () {
    return view('student');
})->middleware(['auth', 'verified'])->name('student');

require __DIR__.'/auth.php';
