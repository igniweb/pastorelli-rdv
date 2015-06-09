<?php

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::get('auth/sign-in', ['as' => 'auth.sign_in', 'uses' => 'AuthController@signIn']);
Route::get('auth/sign-out', ['as' => 'auth.sign_out', 'uses' => 'AuthController@signOut']);
