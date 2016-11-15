<?php

namespace Alexa\Intents;

use Cooglemirror\IOS\FindMyiPhone;
class FindJohnPhoneController extends AbstractController
{
    public function execute(\Alexa\Request\IntentRequest $request)
    {
        $device_id = \Config::get('phones.john.device_id');
        
        $fmi = new FindMyiPhone(\Config::get('services.iCloud.username'), \Config::get('services.iCloud.password'), false);
        
        $fmi->playSound($device_id, "CoogleMirror asked to find me.");
        
        $response = new \Alexa\Response\Response();
        
        $response->respond("I've asked the phone to announce itself for you.")
                 ->endSession();
        
        return \Response::json($response->render());
    }
}