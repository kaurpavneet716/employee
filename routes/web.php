<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\EmployeeController;

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

Route::get('/',[EmployeeController::class, 'showForm']);
Route::post('/submit-form',[EmployeeController::class,'submitForm']);
Route::get('/edit-employee/{id}',[EmployeeController::class,'editRecord']);
Route::post('/update-form/{id}',[EmployeeController::class,'updateRecord']);
Route::post('/name-search',[EmployeeController::class,'filterSearch']);



Route::get('/view-form/{id}',[EmployeeController::class,'viewForm']);
Route::get('/delete-data/{id}',[EmployeeController::class,'deleteData']);

