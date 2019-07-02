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
    Route::get('/', 'AlunoController@index')->name('aluno.index');
    Route::get('/create', 'AlunoController@create')->name('aluno.create');
    Route::post('/create', 'AlunoController@store')->name('aluno.store');
    Route::get('/{aluno}/editar', 'AlunoController@edit')->name('aluno.edit');
    Route::post('/{aluno}/editar', 'AlunoController@update')->name('aluno.update');
    Route::get('/{aluno}/deletar', 'AlunoController@destroy')->name('aluno.delete');
});

Route::group(['prefix' => 'categorias', 'middleware' => 'auth'], function () {
    Route::get('/', 'CategoriaController@index')->name('categoria.index');
    Route::get('/create', 'CategoriaController@create')->name('categoria.create');
    Route::post('/create', 'CategoriaController@store')->name('categoria.store');
    Route::get('/{categoria}/editar', 'CategoriaController@edit')->name('categoria.edit');
    Route::post('/{categoria}/editar', 'CategoriaController@update')->name('categoria.update');
    Route::get('/{categoria}/deletar', 'CategoriaController@destroy')->name('categoria.delete');
});

Route::group(['prefix' => 'cursos', 'middleware' => 'auth'], function () {
    Route::get('/', 'CursoController@index')->name('curso.index');
    Route::get('/create', 'CursoController@create')->name('curso.create');
    Route::post('/create', 'CursoController@store')->name('curso.store');
    Route::get('/{curso}/editar', 'CursoController@edit')->name('curso.edit');
    Route::post('/{curso}/editar', 'CursoController@update')->name('curso.update');
    Route::get('/{curso}/deletar', 'CursoController@destroy')->name('curso.delete');
});

Route::group(['prefix' => 'livros', 'middleware' => 'auth'], function () {
    Route::get('/', 'LivroController@index')->name('livro.index');
    Route::get('/create', 'LivroController@create')->name('livro.create');
    Route::post('/create', 'LivroController@store')->name('livro.store');
    Route::get('/{livro}/editar', 'LivroController@edit')->name('livro.edit');
    Route::post('/{livro}/editar', 'LivroController@update')->name('livro.update');
    Route::get('/{livro}/deletar', 'LivroController@destroy')->name('livro.delete');
});