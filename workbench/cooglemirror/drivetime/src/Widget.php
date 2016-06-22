<?php

namespace Cooglemirror\Drivetime;

use Carbon\Carbon;
class Widget
{
    public function compose($view)
    {
        try {
            $baseUrl = "https://maps.googleapis.com/maps/api/distancematrix/json?";
            
            $params = [
                'origins' => \Config::get('cooglemirror-drivetime::widget.origin'),
                'destinations' => \Config::get('cooglemirror-drivetime::widget.destinations', []),
                'key' => \Config::get('cooglemirror-drivetime::widget.api_key'),
                'mode' => \Config::get('cooglemirror-drivetime::widget.distance_mode', 'driving'),
                'units' => \Config::get('cooglemirror-drivetime::widget.units', 'imperial')
            ];
            
            $params['destinations'] = implode('|', $params['destinations']);
            
            $requestUrl = $baseUrl . http_build_query($params);
            
            $result = json_decode(file_get_contents($requestUrl));
            
            $driveData = [
                'updated' => Carbon::now(\Config::get('app.timezone'))->format('g:ia'),
                'times' => []
            ];
            
            foreach($result->destination_addresses as $idx => $address) {
                $driveData['times'][] = [
                    'destination' => $address,
                    'distance' => $result->rows[0]->elements[$idx]->distance->text,
                    'eta' => $result->rows[0]->elements[$idx]->duration->text
                ];
            }
            
            $view->with('driveData', $driveData);
            
        } catch(\Exception $e) {
            dd($e->getMessage());
        }
    }
    
}