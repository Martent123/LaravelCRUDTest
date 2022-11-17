<?php

use Illuminate\Support\Facades\Route;
use App\Models\Programs;
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
// switched to react route
Route::view('/{path?}', 'index')
    ->where('path', '.*');

// landing page
// Route::get('/', function () {
//     return view('index');
// });

// documentation
// Route::get('/docs', function () {
//     return view('docs');
// });

// student list
// Route::get('/student', function () {
//     return view('student');
// })->middleware(['auth', 'verified'])->name('student');

// student add
// Route::get('/studentCreate', function () {
//     return view('studentCreate');
// })->middleware(['auth', 'verified'])->name('student');


//return list of programs in db
// Route::get('/programs', function(){
// 	return Programs::select('program')->get();
// });

// Route::get('/dashboard', function () {
//     return view('student');
// })->middleware(['auth', 'verified'])->name('student');

require __DIR__.'/auth.php';
