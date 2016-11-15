<?php

namespace Alexa\Intents;

class GetMirrorTempController extends AbstractController
{
    public function execute(\Alexa\Request\IntentRequest $request) {
        $cpuTemp = file_get_contents('/sys/class/thermal/thermal_zone0/temp');
        
        $cpuTemp = round($cpuTemp/1000, 1);
        
        $response = new \Alexa\Response\Response();
        
        if($cpuTemp >= 80) {
            $response->respond("The mirror is operating at a dangerous temperature of {$cpuTemp} degrees celsius.");
        } else {
            $response->respond("The mirror is operating at a safe temperature of {$cpuTemp} degrees celsius.");
        }
        
        $response->withCard("Mirror Operating Temperature", "{$cpuTemp} degrees celsius");
        $response->endSession();
        
        return \Response::json($response->render());
    }
}