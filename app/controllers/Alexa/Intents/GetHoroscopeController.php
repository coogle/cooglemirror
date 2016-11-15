<?php

namespace Alexa\Intents;

class GetHoroscopeController extends AbstractController
{
    public function execute(\Alexa\Request\IntentRequest $request)
    {
        $dailyHoroscope = json_decode(file_get_contents('http://www.api.littleastro.com/restserver/index.php/api/horoscope/readings/format/json'));
        
        $sign = strtolower($request->slots['Sign']);
        
        $response = new \Alexa\Response\Response();
        
        foreach($dailyHoroscope as $horoscope) {
            if(strtolower($horoscope->Sign) != $sign) {
                continue;
            }
            
            $response->respond($horoscope->Daily_Horoscope)
                     ->withCard("Daily Horoscope For {$horoscope->Sign}", $horoscope->Daily_Horoscope);
            break;
        }
        
        if(empty($response->outputSpeech)) {
            $response->respond("The outlook for you today looks grim.");
        }
        
        $response->endSession();
        
        return \Response::json($response->render());
    }
}