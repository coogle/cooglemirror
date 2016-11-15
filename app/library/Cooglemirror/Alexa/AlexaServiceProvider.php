<?php

namespace Cooglemirror\Alexa;

use Illuminate\Support\ServiceProvider;

class AlexaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('Alexa\Request\IntentRequest', function() {
            $data = \Request::json()->all();
            
            if(empty($data)) {
                return null;
            }
            
            return \Alexa\Request\Request::fromData(\Request::json()->all()); 
        });
    }
}