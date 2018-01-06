<?php

use Illuminate\Http\Request;

// Rotas de autenticação (Sessão)
Route::group([ 'prefix' => 'token' ], function(){
    Route::put('/', [ 'uses' => 'TokenController@createToken', 'as' => 'token.create' ]);
    Route::delete('/{token}', [ 'uses' => 'TokenController@deleteToken', 'as' => 'token.delete' ]);
    Route::get('/{token}', [ 'uses' => 'TokenController@getToken', 'as' => 'token.get' ]);
});

// Rotas da API de Pessoas (Autenticação Básica)
Route::group([ 'prefix' => 'pessoa', 'middleware' => 'auth' ], function(){
    Route::get('list', [ 'uses'   => 'PessoaController@List',   'as' => 'pessoa.list' ]);
    Route::post('create', [ 'uses' => 'PessoaController@Create', 'as' => 'pessoa.create' ]);
    Route::post('update', [ 'uses' => 'PessoaController@Update', 'as' => 'pessoa.update' ]);
    Route::delete('delete', [ 'uses' => 'PessoaController@Delete', 'as' => 'pessoa.delete' ]);
});
// Route::group([ 'prefix' => '{token}', 'middleware' => 'auth' ], function(){
// });