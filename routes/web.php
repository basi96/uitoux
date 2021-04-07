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

// Route::get('/', function () {
//     return view('welcome');
// });

//Routes For Student
Route::get('/', 'App\Http\Controllers\StudentController@index')->name('student.index');
Route::post('/studentCreate', 'App\Http\Controllers\StudentController@store')->name('student.store');
Route::post('/studentUpdate', 'App\Http\Controllers\StudentController@update')->name('student.update');
