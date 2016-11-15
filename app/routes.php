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

Route::group([
    'before' => 'localhost'
], function() {

    Route::get('/', [
        'as' => 'home',
        'uses' => 'HomeController@index'
    ]);
    
});

Route::group([], function() {
   
    Route::any('/ask', [
        'as' => 'ask',
        'uses' => 'Alexa\ASKController@processIntent'
    ]);
    
});