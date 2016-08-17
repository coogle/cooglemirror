<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('voice', [
    'as' => 'voicetest',
    'uses' => 'HomeController@voice'
]);

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

Route::get('/alexa/auth', [
    'as' => 'alexa.auth',
    'uses' => 'Alexa\OAuthController@authorize'
]);

Route::get('/alexa/authresponse', [
    'as' => 'alexa.authresponse',
    'uses' => 'Alexa\OAuthController@authResponse'
]);

Route::get('/alexa/trigger', [
    'as' => 'alexa.trigger',
    'uses' => 'Alexa\AlexaController@trigger'
]);
