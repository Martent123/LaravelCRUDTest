<?php

namespace App\Http\Controllers;

use App\Models\Programs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramsController extends Controller
{
    /**
     * List all students that is active
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getPrograms(Request $request){
		
		// join program table to get the program name
		$programs = DB::table('programs')
		->get();
		
		if (!$programs->isEmpty())
			return response()->json(array('data'=>$programs),200)->header('Content-Type', 'application/json');
		else
			// if no student record found
			return response()->json(array('data'=>'Programs Not Found'),404)->header('Content-Type', 'application/json');
	}
}
