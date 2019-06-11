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
Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
});

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'alunos', 'middleware' => 'auth'], function () {
    Route::get('/', 'AlunoController@index')->name('alunos.index');
    Route::get('/create', 'AlunoController@create')->name('alunos.create');
    Route::post('/create', 'AlunoController@store')->name('alunos.store');
    Route::get('/{aluno}/editar', 'AlunoController@edit')->name('alunos.edit');
    Route::post('/{aluno}/editar', 'AlunoController@update')->name('alunos.update');
    Route::get('/{aluno}/deletar', 'AlunoController@destroy')->name('alunos.delete');
});

Route::group(['prefix' => 'categorias', 'middleware' => 'auth'], function () {
    Route::get('/', 'CategoriaController@index')->name('categoria.index');
    Route::get('/create', 'CategoriaController@create')->name('categoria.create');
    Route::post('/create', 'CategoriaController@store')->name('categoria.store');
    Route::get('/{categoria}/editar', 'CategoriaController@edit')->name('categoria.edit');
    Route::post('/{categoria}/editar', 'CategoriaController@update')->name('categoria.update');
    Route::get('/{categoria}/deletar', 'CategoriaController@destroy')->name('categoria.delete');
});