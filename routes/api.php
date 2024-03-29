<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/teste', 'Api\ExemplarController@index');
// Route::resource('exemplar', 'Api\ExemplarController');

Route::group(['prefix' => 'exemplar'], function () {
    Route::get('/', 'Api\ExemplarController@index')->name('api.exemplar.index');
    Route::get('/{exemplar}', 'Api\ExemplarController@show')->name('api.exemplar.show');
    Route::post('/{exemplar}/editar', 'Api\ExemplarController@update')->name('api.exemplar.update');
});

Route::group(['prefix' => 'livro'], function () {
    Route::get('/{exemplar}', 'Api\LivroController@show')->name('api.livro.show');
});

