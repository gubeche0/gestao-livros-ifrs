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
})->name('logout');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/homeCoord')->name('homeCoord');
Route::get('/homeAdmin')->name('homeAdmin');

Route::group(['prefix' => 'alunos', 'middleware' => ['auth', 'coord']], function () {
    Route::get('/', 'AlunoController@index')->name('aluno.index');
    Route::get('/create', 'AlunoController@create')->name('aluno.create');
    Route::post('/create', 'AlunoController@store')->name('aluno.store');
    Route::get('/{aluno}', 'AlunoController@show')->name('aluno.show');
    Route::get('/{aluno}/editar', 'AlunoController@edit')->name('aluno.edit');
    Route::post('/{aluno}/editar', 'AlunoController@update')->name('aluno.update');
    Route::get('/{aluno}/deletar', 'AlunoController@destroy')->name('aluno.delete');
});

Route::group(['prefix' => 'users', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'UserController@index')->name('user.index');
    Route::get('/create', 'UserController@create')->name('user.create');
    Route::post('/create', 'UserController@store')->name('user.store');

    Route::get('/{user}/editar', 'UserController@edit')->name('user.edit');
    Route::post('/{user}/editar', 'UserController@update')->name('user.update');
    Route::get('/{user}/deletar', 'UserController@destroy')->name('user.delete');
});

Route::group(['prefix' => 'cursos', 'middleware' => ['auth', 'coord']], function () {
    Route::get('/', 'CursoController@index')->name('curso.index');
    Route::get('/create', 'CursoController@create')->name('curso.create');
    Route::post('/create', 'CursoController@store')->name('curso.store');
    Route::get('/{curso}/editar', 'CursoController@edit')->name('curso.edit');
    Route::post('/{curso}/editar', 'CursoController@update')->name('curso.update');
    Route::get('/{curso}/deletar', 'CursoController@destroy')->name('curso.delete');
});

Route::group(['prefix' => 'livros', 'middleware' => ['auth', 'coord']], function () {
    Route::get('/', 'LivroController@index')->name('livro.index');
    Route::get('/create', 'LivroController@create')->name('livro.create');
    Route::post('/create', 'LivroController@store')->name('livro.store');
    Route::get('/{livro}/editar', 'LivroController@edit')->name('livro.edit');
    Route::post('/{livro}/editar', 'LivroController@update')->name('livro.update');
    Route::get('/{livro}/deletar', 'LivroController@destroy')->name('livro.delete');
    Route::get('/{livro}', 'LivroController@show')->name('livro.exemplar');    
    Route::get('/{livro}', 'LivroController@show')->name('livro.exemplar');
});

Route::group(['prefix' => 'exemplares', 'middleware' => ['auth', 'coord']], function () {
    Route::get('/{exemplar}', 'ExemplarController@show')->name('exemplar.historico');
    Route::get('/{exemplar}/deletar', 'ExemplarController@destroy')->name('exemplar.delete');
    Route::get('/{exemplar}/restaurar', 'ExemplarController@restore')->name('exemplar.restore');
});

Route::group(['prefix' => 'emprestimo', 'middleware' => ['auth', 'coord']], function () {
    Route::get('/', 'EmprestimoController@index')->name('emprestimo.index');
    Route::get('/registrar', 'EmprestimoController@loan')->name('emprestimo.loan');
    Route::post('/registrar', 'EmprestimoController@registerLoan')->name('emprestimo.registerLoan');
    Route::get('/devolver', 'EmprestimoController@devolution')->name('emprestimo.devolution');
    Route::post('/devolver', 'EmprestimoController@registerDevolution')->name('emprestimo.registerDevolution');
});

Route::group(['prefix' => 'turma', 'middleware' => ['auth', 'coord']], function () {
    Route::get('/', 'TurmaController@index')->name('turma.index');
    Route::get('/create', 'TurmaController@create')->name('turma.create');
    Route::post('/create', 'TurmaController@store')->name('turma.store');
    Route::get('/{turma}/editar', 'TurmaController@edit')->name('turma.edit');
    Route::post('/{turma}/editar', 'TurmaController@update')->name('turma.update');
    Route::get('/{turma}/deletar', 'TurmaController@destroy')->name('turma.delete');
    Route::get('/{turma}/restaurar', 'TurmaController@restore')->name('turma.restore');
});

Route::group(['prefix' => 'barcode', 'middleware' => ['auth', 'coord']], function () {
    Route::get('/', 'BarcodeController@index')->name('barcode.index');
    Route::post('/', 'BarcodeController@store')->name('barcode.store');
});

Route::group(['prefix' => 'relatorio', 'middleware' => ['auth', 'coord']], function () {
    Route::get('/', 'RelatorioController@emprestimo')->name('relatorio.emprestimo');
});

Route::group(['prefix' => 'perfil', 'middleware' => ['auth']], function () {
    Route::get('/', 'PerfilController@index')->name('profile.index');
    Route::post('/update', 'PerfilController@update')->name('profile.update');
    Route::post('/password', 'PerfilController@password')->name('profile.password');
    Route::post('/senhaNova', 'PerfilController@senhaNova')->name('profile.senhaNova');
    Route::get('/senha', 'PerfilController@senha')->name('profile.senha');
});

Route::group(['prefix' => 'requisicao/livro', 'middleware' => ['auth']], function () {
    Route::get('/', 'RequisicaoLivroController@index')->name('requisicaoLivro.index');
    Route::get('/create', 'RequisicaoLivroController@create')->name('requisicaoLivro.create');
    Route::post('/create', 'RequisicaoLivroController@store')->name('requisicaoLivro.store');
    Route::get('/{livro}/editar', 'RequisicaoLivroController@edit')->name('requisicaoLivro.edit');
    Route::post('/{livro}/editar', 'RequisicaoLivroController@update')->name('requisicaoLivro.update');
    Route::get('/{livro}/deletar', 'RequisicaoLivroController@destroy')->name('requisicaoLivro.delete');
    Route::get('/{livro}', 'RequisicaoLivroController@show')->name('requisicaoLivro.exemplar');    
});


Route::group(['prefix' => 'assuntos', 'middleware' => ['auth', 'coordCurso']], function () { // colocar validar se tem acesso a isso de alguma forma
    Route::get('/', 'AssuntoController@index')->name('assunto.index');
    Route::get('/create', 'AssuntoController@create')->name('assunto.create');
    Route::post('/create', 'AssuntoController@store')->name('assunto.store');
    Route::get('/{assunto}/editar', 'AssuntoController@edit')->name('assunto.edit');
    Route::post('/{assunto}/editar', 'AssuntoController@update')->name('assunto.update');
    Route::get('/{assunto}/deletar', 'AssuntoController@destroy')->name('assunto.delete');
});

Route::group(['prefix' => 'areas', 'middleware' => ['auth', 'coordCurso']], function () { // colocar validar se tem acesso a isso de alguma forma
    Route::get('/', 'AreaController@index')->name('area.index');
    Route::get('/create', 'AreaController@create')->name('area.create');
    Route::post('/create', 'AreaController@store')->name('area.store');
    Route::get('/{area}/editar', 'AreaController@edit')->name('area.edit');
    Route::post('/{area}/editar', 'AreaController@update')->name('area.update');
    Route::get('/{area}/deletar', 'AreaController@destroy')->name('area.delete');
});