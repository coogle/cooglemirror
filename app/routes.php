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
    
    Route::get('/recipe/view', [
        'as' => 'recipe.view',
        'uses' => 'RecipeController@view'
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



Route::group(['before' => 'auth.twilio'], function() {
    
    Route::any('/twilio/voice', [
        'as' => 'twilio.voice',
        'uses' => 'Twilio\CallbackController@voice'
    ]);

    Route::any('/twilio/sms', [
        'as' => 'twilio.sms',
        'uses' => 'Twilio\CallbackController@sms'
    ]);
});

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

