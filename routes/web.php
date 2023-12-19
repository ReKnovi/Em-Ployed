<?php

namespace App\Http\Controllers\Auth;



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\JobController;


Route::get('/', function () {
    return view('welcome');
});

// Employer registration route
Route::get('/register/employer', [RegisterController::class, 'showRegistrationForm'])->name('register.employer');
Route::post('/register/employer', [RegisterController::class, 'register']);

// // Admin registration route
// Route::get('/register/admin', [RegisterController::class, 'showAdminRegistrationForm'])->name('register.admin');
// Route::post('/register/admin', [RegisterController::class, 'registerAdmin']);

// Job creation route
Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create')->middleware('auth');

// Job store route
Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store')->middleware('auth');

// Job index route (you can adjust the route and method names as needed)
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index')->middleware('auth');

// Job details route
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

// Job application form route
Route::get('/jobs/{job}/apply', [JobController::class, 'apply'])->name('jobs.apply')->middleware('auth');

// Job application submission route
Route::post('/jobs/{job}/apply', [JobController::class, 'submitApplication'])->name('jobs.submitApplication')->middleware('auth');

Auth::routes();
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});

