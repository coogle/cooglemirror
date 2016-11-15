<?php

namespace Alexa\Intents;

abstract class AbstractController extends \BaseController
{
    public function run()
    {
        $intent = \App::make('Alexa\Request\IntentRequest');
        
        return $this->execute($intent);
    }
    
    abstract function execute(\Alexa\Request\IntentRequest $request);
}