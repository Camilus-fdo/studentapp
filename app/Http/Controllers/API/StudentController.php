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

    	$req_std_id = $request->std_id;
    	$updateDetails =  $request->all();

    	$student = StudentDetails::where('std_id', $req_std_id)
    							 ->update($updateDetails);

		$response = [
			'success' => true,
			'data'	  => [],
			'message' => 'Update successfully!'
    	];
    	return response()->json($response, 201);
    }

    public function listStudents()
    {
    	$students = StudentDetails::all();

    	dd($students);
    }

}
