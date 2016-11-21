<?php

namespace Alexa\Intents;

use Carbon\Carbon;
use Cooglemirror\Dinner\Models\DinnerMenu;
class SetMenuItemController extends AbstractController
{
    public function execute(\Alexa\Request\IntentRequest $request)
    {
        $response = new \Alexa\Response\Response();
        
        $dayOfWeek = null;
        //'mon', 'tues', 'weds', 'thurs', 'fri', 'sat', 'sun'
        switch(strtolower($request->slots['DayOfWeek'])) {
            case 'monday':
                $dayOfWeek = "mon";
                break;
            case 'tuesday':
                $dayOfWeek = 'tues';
                break;
            case 'wednesday':
                $dayOfWeek = 'weds';
                break;
            case 'thursday':
                $dayOfWeek = 'thurs';
                break;
            case 'friday':
                $dayOfWeek = 'fri';
                break;
            case 'saturday':
                $dayOfWeek = 'sat';
                break;
            case 'sunday':
                $dayOfWeek = 'sun';
                break;
            case 'today':
                $now = Carbon::now();
                switch($now->dayOfWeek) {
                    case Carbon::MONDAY:
                        $dayOfWeek = 'mon';
                        break;
                    case Carbon::TUESDAY:
                        $dayOfWeek = 'tues';
                        break;
                    case Carbon::WEDNESDAY:
                        $dayOfWeek = 'weds';
                        break;
                    case Carbon::THURSDAY:
                        $dayOfWeek = 'thurs';
                        break;
                    case Carbon::FRIDAY:
                        $dayOfWeek = 'fri';
                        break;
                    case Carbon::SATURDAY:
                        $dayOfWeek = 'sat';
                        break;
                    case Carbon::SUNDAY:
                        $dayOfWeek = 'sun';
                        break;
                }
                break;
            case 'tomorrow':
                $now = Carbon::now()->addDay();
                switch($now->dayOfWeek) {
                    case Carbon::MONDAY:
                        $dayOfWeek = 'mon';
                        break;
                    case Carbon::TUESDAY:
                        $dayOfWeek = 'tues';
                        break;
                    case Carbon::WEDNESDAY:
                        $dayOfWeek = 'weds';
                        break;
                    case Carbon::THURSDAY:
                        $dayOfWeek = 'thurs';
                        break;
                    case Carbon::FRIDAY:
                        $dayOfWeek = 'fri';
                        break;
                    case Carbon::SATURDAY:
                        $dayOfWeek = 'sat';
                        break;
                    case Carbon::SUNDAY:
                        $dayOfWeek = 'sun';
                        break;
                }
                break;
        }
        
        if(is_null($dayOfWeek)) {
            $response->respond("I'm sorry, I did not understand the day you wanted to modify on the menu");
            $response->endSession();
            return \Response::json($response->render());
        }
        
        $menuItem = isset($request->slots['MenuItem']) ? $request->slots['MenuItem'] : null;
        
        switch(strtolower($request->slots['Action'])) {
            case 'put':
            case 'add':
            case 'update':
                
                if(empty('menuItem')) {
                    $response->respond("I'm sorry, I did not catch what you wanted to add to the menu");
                    $response->endSession();
                    return \Response::json($response->render());
                }
                
                $day = DinnerMenu::findByDay($dayOfWeek);
                
                $day->menu = ucwords($menuItem);
                $day->save();
                
                $response->respond("I've added '$menuItem' to the dinner menu for {$request->slots['DayOfWeek']}.");
                
                break;
            case 'clear':
            case 'reset':
            case 'remove':
                
                $day = DinnerMenu::findByDay($dayOfWeek);
                $day->menu = '?????';
                $day->save();
                
                $response->respond("I've cleared the dinner menu for {$request->slots['DayOfWeek']}.");
                break;
            default:
                $response->respond("I'm sorry, I did not understand what you wanted me to do with the menu.");
                break;
        }
        
        $response->endSession();
        
        return \Response::json($response->render());
    }
}