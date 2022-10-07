<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Programs;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

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

			$studentModel = new Student;
			
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
			$programId = Programs::where('program',$program) -> first();

			// insert into db
			$studentModel->last_name = $lastName;
			$studentModel->first_name = $firstName;
			$studentModel->email = $email;
			$studentModel->phone = $phone;
			$studentModel->program_id = $programId;
			$studentModel->created_by = $currentUser;
			$studentModel->save();

			// return success if no exception
			return redirect()->route('student');

		} catch (QueryException $qe){
				Log::error($qe->getMessage());
				return back()->with('fail', 'Oops, Something wrong with query');
		} catch (Exception $e){
				Log::error($e->getMessage());
				return back()->with('fail', 'Oops, Something unexpected happened');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Programs  $programs
     * @return \Illuminate\Http\Response
     */
    public function show($studentId)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Programs  $programs
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Programs  $programs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programs $programs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Programs  $programs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programs $programs)
    {
        //
    }

}
