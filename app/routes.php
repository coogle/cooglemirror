<?php

use Alexa\Request\IntentRequest;
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

Route::group(['before' => 'alexa-ask', 'prefix' => 'ask'], function() {
    
    $intent = \App::make('Alexa\Request\IntentRequest');
    
    if($intent instanceof IntentRequest) {
        $controllerName = '\Alexa\Intents\\' . $intent->intentName . 'Controller@run';
        
        Route::any(null, [
            'uses' => $controllerName
        ]);
    }
    
});