<?php

namespace Cooglemirror\Weather;

use Cmfcmf\OpenWeatherMap;
class Widget
{
    public function compose($view)
    {
        try {
            $map = new OpenWeatherMap(\Config::get('cooglemirror-weather::widget.openweathermap.api_key'));
            
            $weatherForecast = $map->getWeatherForecast(
                \Config::get('cooglemirror-weather::widget.city'),
                \Config::get('cooglemirror-weather::widget.openweathermap.units'),
                \Config::get('cooglemirror-weather::widget.openweathermap.language'),
                0
            );
            
            $currentWeather = $map->getWeather(
                \Config::get('cooglemirror-weather::widget.city'),
                \Config::get('cooglemirror-weather::widget.openweathermap.units'),
                \Config::get('cooglemirror-weather::widget.openweathermap.language')
            );
            
            $weatherData = [
                'current' => [
                    'temp' => round($currentWeather->temperature->now->getValue(), 0) . "&deg;",
                    'icon' => $this->convertIcon($currentWeather->weather->icon)
                ],
                'hourly' => []
            ];
            
            $hourCount = \Config::get('cooglemirror-weather::widget.hours', 4);
            
            $i = 0;
            $opacity = 1;
            foreach($weatherForecast as $forecast) {
                $weatherData['hourly'][] = [
                    'hour' => $forecast->time->from->format('g A'),
                    'temp' => round($forecast->temperature->getValue(), 0) . "&deg;",
                    'icon' => $this->convertIcon($forecast->weather->icon),
                    'opacity' => $opacity
                ];
                
                $opacity -= (1 / ($hourCount + 1));
                
                if(++$i >= $hourCount) {
                    break;
                }
            }
            
            $view->with('weatherData', $weatherData);
            
        } catch(\Exception $e) {
            $view->with('exception', $e->getMessage());
            dd($e->getMessage());
        }
    }
    
    protected function convertIcon($icon)
    {
        switch($icon) {
            case '01d':
                return "wi-day-sunny";
            case '02d':
                return 'wi-day-cloudy';
            case '03d':
                return 'wi-cloudy';
            case '04d':
                return 'wi-cloudy-windy';
            case '09d':
                return 'wi-showers';
            case '10d':
                return 'wi-rain';
            case '11d':
                return 'wi-thunderstorm';
            case '13d':
                return 'wi-snow';
            case '50d':
                return 'wi-fog';
            case '01n':
                return 'wi-night-clear';
            case '02n':
                return 'wi-night-cloudy';
            case '03n':
                return 'wi-night-cloudy';
            case '04n':
                return 'wi-night-cloudy';
            case '09n':
                return 'wi-night-showers';
            case '10n':
                return 'wi-night-rain';
            case '11n':
                return 'wi-night-thunderstorm';
            case '13n':
                return 'wi-night-snow';
            case '50n':
                return 'wi-night-alt-cloudy-windy';
        }
        
        return 'wi-na';
    }
}