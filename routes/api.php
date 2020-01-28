<?php

use Illuminate\Http\Request;

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

# Route::middleware('auth:api')->get('/user', function (Request $request) {
#     return $request->user();
# });
Route::get('login', [ 'as' => 'login', 'uses' => 'API\UserController@login_page']);
// Route::get('login_page', 'API\UserController@login_page');
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
	Route::get('list_students', 'API\StudentController@listStudents');
	Route::post('std_register', 'API\StudentController@studentRegistration');
	Route::post('std_update', 'API\StudentController@updateStudent');
	Route::post('std_interdict', 'API\StudentController@studentsInterdict');
	Route::post('std_activation', 'API\StudentController@studentActivation');	
});

