<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Programs;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
	// CRUD

	/**
     * List all students that is active
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getStudents(Request $request){
		
		// join program table to get the program name
		$students = DB::table('student')
		->join('programs','student.program_id', '=', 'programs.id')
		->select('student.*', 'programs.program')
		->where('active',1)
		->get();
		
		if (!$students->isEmpty())
			return response()->json(array('data'=>$students),200)->header('Content-Type', 'application/json');
		else
			// if no student record found
			return response()->json(array('data'=>'Student Not Found'),404)->header('Content-Type', 'application/json');
	}

	/**
     * List target student if exists and is active
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getStudentById(Request $request){
		
		//get the student id from request
		$student_id = $request->route('id');

		// join program table to get the program name
		$students = DB::table('student')
		->join('programs','student.program_id', '=', 'programs.id')
		->select('student.*', 'programs.program')
		->where('student.unique_id',$student_id)
		->where('active',1)
		->get();
		
		if (!$students->isEmpty())
			return response()->json(array('data'=>$students),200)->header('Content-Type', 'application/json');
		else
			// if no student record found
			return response()->json(array('data'=>'Student Not Found'),404)->header('Content-Type', 'application/json');
	}


	/**
     * Update target student information
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function updateStudent(Request $request){
		
		//get the student id from request
		$student_id = $request->route('id');

		// check if student exist and is active
		$targetStudent = Student::where('unique_id', $student_id)
		->where('active',1)
		->firstOrFail();

		// validate inputs
		$request->validate([
			'last_name' => 'required',
	        'first_name' => 'required',
	        'email' => 'required|email:rfc,dns',
	        'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
	        'program' => 'required',
		],[
			'last_name.required' => 'Last name is required.',
			'first_name.required' => 'First name is required.',
			'email.required' => 'Email address is required.',
			'phone.required' => 'Phone is required.',
			'program.required' => 'Program is required.',
		]);

		
		//start update the student record

		try{
		
			$data = $request->all();

			$lastName = $data["last_name"];
			$firstName = $data["first_name"];
			$email = $data["email"];
			$phone = $data["phone"];
			$program = $data["program"];
			$programId = DB::table('programs')->select('id')->where('program',$program)->first()->id;
			
			$targetStudent->last_name = $lastName;
			$targetStudent->first_name = $firstName;
			$targetStudent->email = $email;
			$targetStudent->phone = $phone;
			$targetStudent->program_id = $programId;
			$targetStudent->save();

			return response()->json([
					'message' => 'Student updated'
				], 200);
		}
		catch (QueryException $qe){
			// failed, Query Exception, return error message
				Log::error($qe->getMessage());

				return response()->json([
					'message' => 'Oops, Something wrong with query :('
				], 500);
				// return back()->with('fail', 'Oops, Something wrong with query');
		} catch (Exception $e){
			// failed, Exception, return error message
				Log::error($e->getMessage());

				return response()->json([
					'message' => 'Oops, Something unexpected happened :('
				], 500);
				// return back()->with('fail', 'Oops, Something unexpected happened');
		}
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createStudent(Request $request)
    {

        // validate inputs
		$request->validate([
			'last_name' => 'required',
	        'first_name' => 'required',
	        'email' => 'required|email:rfc,dns',
	        'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
	        'program' => 'required',
		],[
			'last_name.required' => 'Last name is required.',
			'first_name.required' => 'First name is required.',
			'email.required' => 'Email address is required.',
			'phone.required' => 'Phone is required.',
			'program.required' => 'Program is required.',
		]);

		try{

			$studentModel = new Student();
			
			// get the data from request
			$data = $request->all();

			// get the id of user who made request
			$currentUser = Auth::id();

			$lastName = $data["last_name"];
			$firstName = $data["first_name"];
			$email = $data["email"];
			$phone = $data["phone"];
			$program = $data["program"];
			$programId = DB::table('programs')->select('id')->where('program',$program)->first()->id;


			// insert into db
			$studentModel->last_name = $lastName;
			$studentModel->first_name = $firstName;
			$studentModel->email = $email;
			$studentModel->phone = $phone;
			$studentModel->program_id = $programId;
			$studentModel->save();

			// return success if no exception
			return response()->json([
				'message' => 'Student Created :)'
			], 200);

		} catch (QueryException $qe){
			// failed, Query Exception, return error message
				Log::error($qe->getMessage());

				return response()->json([
					'message' => 'Oops, Something wrong with query :('
				], 500);
				// return back()->with('fail', 'Oops, Something wrong with query');
		} catch (Exception $e){
			// failed, Exception, return error message
				Log::error($e->getMessage());

				return response()->json([
					'message' => 'Oops, Something unexpected happened :('
				], 500);
				// return back()->with('fail', 'Oops, Something unexpected happened');
		}
    }

	/**
     * Set target student active to false
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function destroyById(Request $request){
		
		//get the student id from request
		$student_id = $request->route('id');

		// check if student exist and is active
		$targetStudent = Student::where('unique_id', $student_id)
		->where('active',1)
		->firstOrFail();

		
		try{
			$targetStudent->active = 0;
			$targetStudent->save();

			return response()->json([
					'message' => 'Student Removed'
				], 200);
		}
		catch (QueryException $qe){
			// failed, Query Exception, return error message
				Log::error($qe->getMessage());

				return response()->json([
					'message' => 'Oops, Something wrong with query :('
				], 500);
				// return back()->with('fail', 'Oops, Something wrong with query');
		} catch (Exception $e){
			// failed, Exception, return error message
				Log::error($e->getMessage());

				return response()->json([
					'message' => 'Oops, Something unexpected happened :('
				], 500);
				// return back()->with('fail', 'Oops, Something unexpected happened');
		}
	}
}
