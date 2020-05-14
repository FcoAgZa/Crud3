<?php

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

Route::get('/', 'Controller@index');
Route::get('registro','Controller@registro')->name('registro');
Route::post('registro','Controller@registro_datos');
Route::get('registrogrupo', 'Controller@registrogrupo')->name('registrogrupo');
Route::post('/registrogrupo', 'Controller@registrogrupo_datos')->name('registrogrupo_datos');
Route::get('editaalumno{id_alumno}','Controller@editaalumno')->name('editaalumno');
Route::post('editaalumno_d/{id_alumno}','Controller@update')->name('editaalumno_d');
Route::get('/borrar/{id_alumno}','Controller@borrar')->name('borrar');