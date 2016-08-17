<?php

namespace Alexa;

use Cooglemirror\Audio;
class AlexaController extends \BaseController
{
    public function trigger()
    {
        zray_disable();
        
        Audio::play(app_path() . '/audio/beep.wav');
        
        $recording = Audio::record(4);
        
        Audio::play($recording);
    }
}