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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home','HomeController@index')->name('home');
Route::post('save_student','StudentController@save_student');
Route::get('all_students','StudentController@all_students');
Route::get('edit_student/{id}','StudentController@edit_student');
Route::put('update_student','StudentController@update_student');
Route::delete('delete_student/{id}','StudentController@delete_student');
