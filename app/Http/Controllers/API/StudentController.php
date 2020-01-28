<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\StudentDetails;
use Validator;

class StudentController extends Controller
{
    public function studentRegistration(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'std_id'			=> 'required',
    		'std_first_name'	=> 'required',
    		'std_last_name'		=> 'required',
    		'std_full_name'		=> 'required',
    		'std_gender'		=> 'required',
    		'std_birthday'		=> 'required',
    		'std_created_at'	=> 'required',
    		'std_address'		=> 'required',	
    		'std_active_status'	=> 'required'
    	]);

    	if(!$validator->fails())
    	{
    		$student = StudentDetails::create($request->all());

    		$response = [
    			'success' => true,
    			'data'	  => [],
    			'message' => 'Insert data successfully!'
    		];
    		return response()->json($response, 201);
    	}else{
    		$response = [
    			'success' => false,
    			'data'	  => 'Validation Error',
    			'message' => $validator->errors()
    		];
    		return response()->json($response, 400);
    	}
    }

    public function updateStudent(Request $request) 
    {

    	$req_std_id 	= $request->std_id;
    	$updateDetails 	=  $request->all();

    	$student = StudentDetails::where('std_id', $req_std_id)
    							 ->update($updateDetails);
    	if($student == 1)
    	{
    		$response = [
				'success' => true,
				'data'	  => [],
				'message' => 'Update successfully!'
    		];
    		return response()->json($response, 200);	
    	}else{
    		$response = [
				'success' => false,
				'data'	  => [],
				'message' => 'Update Failed!'
    		];
    		return response()->json($response, 404);
    	}
		
    }

    public function listStudents()
    {
    	$students = StudentDetails::all();

    	dd($students);
    }

    public function studentsInterdict(Request $request)  
    {
    	$req_std_id 		= $request->std_id;
    	$req_active_status	= $request->std_active_status;

    	$active_status = $this->checkStdActivation($req_std_id);
    	
    	if($active_status == 1)
    	{
    		$student = StudentDetails::where('std_id', $req_std_id)
    							 ->update(['std_active_status' => 0]);

	    	if($student == 1)
	    	{
	    		$response = [
					'success' => true,
					'data'	  => [],
					'message' => 'Student interdicted!'
	    		];
	    		return response()->json($response, 200);
	    	}else{
	    		$response = [
					'success' => true,
					'data'	  => [],
					'message' => 'Interdict process failed. Please check student id'
	    		];
	    		return response()->json($response, 404);
	    	}
    	}else{
    		$response = [
				'success' => false,
				'data'	  => [],
				'message' => 'Student alredy interdicted'
	    	];
	    	return response()->json($response, 404);
    	}	
    }

    public function studentActivation(Request $request)
    {
    	$req_std_id 		= $request->std_id;
    	$req_active_status	= $request->std_active_status;

    	$active_status = $this->checkStdActivation($req_std_id);

    	if($active_status == 0)
    	{
    		$student = StudentDetails::where('std_id', $req_std_id)
    							 ->update(['std_active_status' => 1]);

	    	if($student == 1)
	    	{
	    		$response = [
					'success' => true,
					'data'	  => [],
					'message' => 'Student Activated!'
	    		];
	    		return response()->json($response, 200);
	    	}else{
	    		$response = [
					'success' => true,
					'data'	  => [],
					'message' => 'Activation process failed. Please check student id'
	    		];
	    		return response()->json($response, 404);
	    	}
    	}else{
    		$response = [
				'success' => false,
				'data'	  => [],
				'message' => 'Student alredy Activated'
	    	];
	    	return response()->json($response, 404);
    	}
    }

    public function checkStdActivation($std_id)
    {
    	$student = StudentDetails::all()->where('std_id', $std_id)->first();
    	$active_status = $student->std_active_status;
    	return $active_status;
    }

}
