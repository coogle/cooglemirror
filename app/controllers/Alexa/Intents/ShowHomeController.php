<?php

namespace Alexa\Intents;

class ShowHomeController extends AbstractController
{
    public function execute(\Alexa\Request\IntentRequest $request) {
    	
    	\Event::fire(\SwitchUrlHandler::EVENT, '\\');
        
        $response = new \Alexa\Response\Response();
        $response->endSession();
        
        return \Response::json($response->render());
    }
}