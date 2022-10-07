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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

			// modify data if needed :? not this time
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
     * Remove the specified resource from storage.
     *
     * @param  studentId
     */
    public function destroyById($studentId)
    {

        $affected = DB::table('student')
        			->where('unique_id', $studentId)
        			->update(['active' => 0]);

		return redirect()
					->route('student');
    }

    /*
		Update the tartget student
    */
    public function update(Student $student)
    {
    	$studentId = $student->studentId;
    	dd($studentId);
    	$affected = DB::table('student')
        			->where('unique_id', $studentId)
        			->update(['active' => 0]);

		return redirect()
					->route('student');
    }

}
