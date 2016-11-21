<?php

namespace Alexa\Intents;

class ResetUIController extends AbstractController
{
    public function execute(\Alexa\Request\IntentRequest $request)
    {
        $response = new \Alexa\Response\Response();
        
        exec('/usr/bin/sudo /usr/local/bin/restart-lightdm.sh 2>&1 &');
        
        $response->respond("I have attempted to reset the mirror visual interface.");
        
        $response->endSession();
        
        return \Response::json($response->render());
    }
}