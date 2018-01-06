<?php

use Illuminate\Http\Request;



Route::post('access/{token}', [ 'uses' => 'AuthController@Access', 'as' => 'auth.access' ])->middleware('startsession');