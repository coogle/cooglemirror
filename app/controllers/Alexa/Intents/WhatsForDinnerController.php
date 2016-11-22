<?php

namespace Alexa\Intents;

use Cooglemirror\Dinner\Models\DinnerMenu;
use Carbon\Carbon;
class WhatsForDinnerController extends AbstractController
{
    public function execute(\Alexa\Request\IntentRequest $request)
    {
        $response = new \Alexa\Response\Response();
        
        $dayOfWeek = null;
        
        if(!isset($request->slots['DayOfWeek']) || empty($request->slots['DayOfWeek'])) {
            $request->slots['DayOfWeek'] = 'today';
        }
        
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
        
        $menuItem = DinnerMenu::findByDay($dayOfWeek);
        
        if(!$menuItem instanceof DinnerMenu) {
            $response->respond("I'm sorry, I could not find the menu for the request day.");
            $response->endSession();
            return \Response::json($response->render());
        }
        
        if($menuItem->menu == '?????') {
            $response->respond("There is nothing planned for dinner {$request->slots['DayOfWeek']}.");
        } else {
            $response->respond("'{$menuItem->menu}' is planned for dinner {$request->slots['DayOfWeek']}");
        }
        
        $response->endSession();
        
        return \Response::json($response->render());
    }
}