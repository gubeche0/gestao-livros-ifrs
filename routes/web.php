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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'alunos', 'middleware' => 'auth'], function () {
    Route::get('/', 'AlunoController@index')->name('alunos.index');
    Route::get('/{aluno}/editar', 'AlunoController@edit')->name('alunos.edit');
    Route::get('/{aluno}/deletar', 'AlunoController@destroy')->name('alunos.delete');
});
