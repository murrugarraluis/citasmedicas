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
	return view('auth.login');
})->name('login');

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
	return view('dashboard');
})->name('dashboard');

// ROL ADMIN
Route::get('/hospitales', function () {
	return view('mantainers.hospital');
})->middleware('can:hospital')->name('hospital');

// ROL HOSPITAL
Route::get('/equipos', function () {
	return view('mantainers.covidteam');
})->middleware('can:covidteam')->name('covidteam');
Route::get('/doctores', function () {
	return view('mantainers.doctor');
})->middleware('can:doctor')->name('doctor');

// ROL DOCTOR
Route::get('/citas', function () {
	return view('mantainers.appointment');
})->middleware('can:appointment')->name('appointment');


