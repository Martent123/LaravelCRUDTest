<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
	// CRUD
    
    /**
	*	Create method, will insert a new student info into the database
    */
	public function create(Request $request)
	{
		$request->validate([
			'last_name' => 'required',
	        'first_name' => 'required',
	        'email' => 'required',
	        'phone' => 'required',
	        'program' => 'required',
		])
	}
}
