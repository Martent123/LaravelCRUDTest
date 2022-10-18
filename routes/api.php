<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProgramsController;

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
Route::get('students', [StudentController::class, 'getStudents']);

// view the student by id
Route::get('students/{id}', [StudentController::class, 'getStudentById']);

// Create a new student
Route::post('/students', [StudentController::class, 'createStudent']);

// Update student
Route::put('students/{id}',[StudentController::class, 'updateStudent']);

// remove the student by id
Route::delete('students/{id}', [StudentController::class, 'destroyById']);

// list all programs
Route::get('programs', [ProgramsController::class, 'getPrograms']);