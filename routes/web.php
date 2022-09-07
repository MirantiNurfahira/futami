<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('landingpage.index');
});

// Auth
Route::group([], function () {
	Route::get('login', 'AuthController@LoginView');
	Route::get('register', 'AuthController@RegisterView');
	Route::post('login', 'AuthController@LoginProcess')->name('loginProcess');
	Route::post('register', 'AuthController@RegisterProcess')->name('registerProcess');
	Route::get('logout', 'AuthController@Logout');
});

	
// Users
Route::group(['middleware' => ['auth.users', 'admin'], 'prefix' => 'users'], function() {

	// Dashboard Users
	Route::get('/', 'UsersController@Home')->name('home');
	// Management Users
	Route::post('/add', 'UsersController@Store');
	Route::get('/edit/{id}', 'UsersController@edit');
	Route::put('/edit/{id}', 'UsersController@Update')->name('UpdateProcess');
	Route::delete('/delete/{id}', 'UsersController@Delete');
});


//ttdOp
Route::get('/ttd_operator/{id}','OperatorController@ttd_operator')->name('ttd_operator');
// Op
Route::group(['middleware' => ['auth.users', 'operator'], 'prefix' => 'operators'], function() {

	// Dashboard Op
	Route::get('/', 'OperatorController@Home')->name('home');
	// Management Op
	Route::post('/add', 'OperatorController@Store');
	Route::get('/edit/{id}', 'OperatorController@edit');
	Route::put('/edit/{id}', 'OperatorController@Update');
	Route::delete('/delete/{id}', 'OperatorController@Delete')->name('DeleteProcess');
});

//ttdStaff
Route::get('/ttd_staff/{id}','StaffController@ttd_staff')->name('ttd_staff');
//approve staff
Route::get('/approve/{id}', 'StaffController@approve')->name('approve');
//reject staff
Route::get('/decline/{id}', 'StaffController@decline')->name('decline');
// staff
Route::group(['middleware' => ['auth.users', 'staff'], 'prefix' => 'staffs'], function() {
	// Dashboard staff
	Route::get('/', 'StaffController@Home')->name('home');
});


//ttdSpv
Route::get('/ttd_supervisor/{id}','SupervisorController@ttd_supervisor')->name('ttd_supervisor');
// spv
Route::group(['middleware' => ['auth.users', 'supervisor'], 'prefix' => 'supervisors'], function() {
	// Dashboard spv
	Route::get('/', 'SupervisorController@Home')->name('home');
});
