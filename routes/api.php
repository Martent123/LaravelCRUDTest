<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Models\Student;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::resource('student', StudentController::class);

// list all active student
Route::get('/students', function(){
	return Student::where('active',1)->get();
});

// view the student by id
Route::get('/students/{id}', function($id){
	return Student::find($id);
});

// remove the student by id
Route::get('/removeStudent/{studentid}', [StudentController::class, 'destroyById']);