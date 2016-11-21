<?php

namespace Twilio;

class CallbackController extends \BaseController
{
    protected $_whiteList = [
        '+19142631049',
        '+12485905686'
    ];
    
    public function sms()
    {
        if(!in_array(\Input::get('From'), $this->_whiteList)) {        
            \App::abort(404);
        }
        
        $url = \Input::get('Body', '');
        
        if(empty($url)) {
            return "Empty URL";
        }
        
        if(!filter_var($url, FILTER_VALIDATE_URL)) {
            return "Invalid URL";
        }
        
        $redirectUrl = "http://localhost/recipe/view?url=".urlencode($url);
        \Event::fire(\SwitchUrlHandler::EVENT, $redirectUrl);
        return "Ok";
    }
    
    public function call()
    {
        if(!in_array(\Input::get('From'), $this->_whiteList)) {
            \App::abort(404);
        }
    }
}