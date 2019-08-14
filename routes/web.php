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

Route::redirect('/', '/home', 301);

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
    Route::get('/{livro}', 'LivroController@show')->name('livro.exemplar');    
    Route::get('/{livro}', 'LivroController@show')->name('livro.exemplar');    

});

Route::group(['prefix' => 'exemplares', 'middleware' => 'auth'], function () {
    Route::get('/{exemplar}/deletar', 'ExemplarController@destroy')->name('exemplar.delete');
    Route::get('/{exemplar}/restaurar', 'ExemplarController@restore')->name('exemplar.restore');
});

Route::group(['prefix' => 'emprestimo', 'middleware' => 'auth'], function () {
    Route::get('/', 'EmprestimoController@index')->name('emprestimo.index');
    Route::get('/registrar', 'EmprestimoController@loan')->name('emprestimo.loan');
    Route::post('/registrar', 'EmprestimoController@registerLoan')->name('emprestimo.registerLoan');
    Route::get('/devolver', 'EmprestimoController@devolution')->name('emprestimo.devolution');
    Route::post('/devolver', 'EmprestimoController@registerDevolution')->name('emprestimo.registerDevolution');
});

Route::group(['prefix' => 'turma', 'middleware' => 'auth'], function () {
    Route::get('/', 'TurmaController@index')->name('turma.index');
    Route::get('/create', 'TurmaController@create')->name('turma.create');
    Route::post('/create', 'TurmaController@store')->name('turma.store');
    Route::get('/{turma}/editar', 'TurmaController@edit')->name('turma.edit');
    Route::post('/{turma}/editar', 'TurmaController@update')->name('turma.update');
    Route::get('/{turma}/deletar', 'TurmaController@destroy')->name('turma.delete');
    Route::get('/{turma}/restaurar', 'TurmaController@restore')->name('turma.restore');
});

Route::group(['prefix' => 'barcode', 'middleware' => 'auth'], function () {
    Route::get('/', 'BarcodeController@index')->name('barcode.index');
    Route::post('/', 'BarcodeController@store')->name('barcode.store');
});