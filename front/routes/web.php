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

// Route::get('/', function () {
//     return view('welcome');
// });

// Rota padrão
Route::get('/', [ 'uses' => 'MainController@default', 'as' => 'default' ]);

// Rotas de autenticação
Route::group([ 'prefix' => 'auth' ], function(){
    Route::get('login', [ 'uses' => 'AuthController@login', 'as' => 'auth.login' ]);
    Route::get('logout', [ 'uses' => 'AuthController@logout', 'as' => 'auth.logout' ]);
});

// Projeto
Route::group([ 'prefix' => 'project' ], function(){
   Route::get('home', [ 'uses' => 'MainController@home', 'as' => 'project.home' ]) ;
});