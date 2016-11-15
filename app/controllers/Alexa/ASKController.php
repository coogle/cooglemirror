<?php

namespace Alexa;

class ASKController extends \BaseController
{
    public function processIntent()
    {
        $response = [
            'version' => '1.0',
            'response' => [
                'outputSpeech' => [
                    'type' => 'PlainText',
                    'text' => 'The outlook is grim.'
                ]
            ]
        ];
        
        return \Response::json($response);
    }
}