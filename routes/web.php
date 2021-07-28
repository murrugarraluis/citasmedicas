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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// ROL ADMIN
Route::get('/hospitales', function () {
    return view('mantainers.hospital');
})->name('hospital');

// ROL HOSPITAL
Route::get('/equipos', function () {
	return view('mantainers.covidteam');
})->name('covidteam');
Route::get('/doctores', function () {
	return view('mantainers.doctor');
})->name('doctor');


