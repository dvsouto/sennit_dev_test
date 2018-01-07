<?php

use Illuminate\Http\Request;

// Rotas de autenticação (Sessão)
Route::group([ 'prefix' => 'token' ], function(){
    Route::post('/', [ 'uses' => 'TokenController@createToken', 'as' => 'token.create' ]);
    Route::delete('/{token}', [ 'uses' => 'TokenController@deleteToken', 'as' => 'token.delete' ])->where('token', '[A-Za-z0-9]+');
    Route::get('/{token}', [ 'uses' => 'TokenController@getToken', 'as' => 'token.get' ])->where('token', '[A-Za-z0-9]+');
});

// Rotas da API de Pessoas (Autenticação Básica)
Route::group([ 'prefix' => 'pessoa', 'middleware' => 'auth' ], function(){
    Route::get('list', [ 'uses'   => 'PessoaController@List',   'as' => 'pessoa.list' ]);
    Route::post('create', [ 'uses' => 'PessoaController@Create', 'as' => 'pessoa.create' ]);
    Route::get('get/{id}', [ 'uses'   => 'PessoaController@Get',   'as' => 'pessoa.list' ])->where('id', '[0-9]+');
    Route::put('update/{id}', [ 'uses' => 'PessoaController@Update', 'as' => 'pessoa.update' ])->where('id', '[0-9]+');
    Route::delete('delete/{id}', [ 'uses' => 'PessoaController@Delete', 'as' => 'pessoa.delete' ])->where('id', '[0-9]+');
});
// Route::group([ 'prefix' => '{token}', 'middleware' => 'auth' ], function(){
// });