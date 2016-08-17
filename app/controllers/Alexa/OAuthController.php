<?php

namespace Alexa;

use OAuth\Common\Storage\Session;
use OAuth\Common\Consumer\Credentials;
use OAuth\ServiceFactory;
use Cooglemirror\RPI;
use Cooglemirror\OAuth\Storage\File;
class OAuthController extends \BaseController
{
    protected function getAmazonOAuth()
    {
        $storage = new File(storage_path() . '/amazon-oauth');
        
        $creds = new Credentials(\Config::get('services.amazon.client_id'),
            \Config::get('services.amazon.client_secret'),
            route('alexa.authresponse'));
        
        $serviceFactory = new ServiceFactory();
        
        $amz = $serviceFactory->createService('amazon', $creds, $storage, \Config::get('services.amazon.scope'));
        
        return $amz;
    }
    
    public function authorize()
    {
        $amz = $this->getAmazonOAuth();
        
        $scopeData = [
            'alexa:all' => [
                'productID' => 'cooglemirror',
                'productInstanceAttributes' => [
                    'deviceSerialNumber' => RPI::getSerialNumber()
                ]
            ]
        ];
        
        $authUrl = $amz->getAuthorizationUri([
            'scope_data' => json_encode($scopeData)
        ]);
        
        return \Redirect::to((string)$authUrl);
    }
    
    public function authResponse()
    {
        if(\Input::has('error')) {
            throw new \Exception("OAuth Error: " . \Input::get('error_description'));
        }
        
        if(!\Input::has('code')) {
            throw new \Exception("Failed to retrieve access token");
        }
        
        $amz = $this->getAmazonOAuth();
        
        $amz->requestAccessToken($_GET['code']);
        
        
        
        dd(\Input::all());
    }
}