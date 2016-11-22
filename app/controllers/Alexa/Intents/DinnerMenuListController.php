<?php

namespace Alexa\Intents;

use Cooglemirror\Dinner\Models\DinnerMenu;
use Carbon\Carbon;
class DinnerMenuListController extends AbstractController
{
    public function execute(\Alexa\Request\IntentRequest $request)
    {
        $response = new \Alexa\Response\Response();
        $responseStr = "Here is the current dinner menu: ";
        
        $days = [
            Carbon::SUNDAY => 'sun',
            Carbon::MONDAY => 'mon',
            Carbon::TUESDAY => 'tues',
            Carbon::WEDNESDAY => "weds",
            Carbon::THURSDAY => 'thurs',
            Carbon::FRIDAY => 'fri',
            Carbon::SATURDAY => 'sat',
        ];
        
        $dayLong = [
            'sun' => 'Sunday',
            'mon' => 'Monday',
            'tues' => 'Tuesday',
            'weds' => 'Wednesday',
            'thurs' => 'Thursday',
            'fri' => 'Friday',
            'sat' => 'Saturday'
        ];
        
        $today = Carbon::now()->dayOfWeek;
        
        $menuItems = [];
        $skippedDays = [];
        
        for($i = 0; $i < 7; $i++) {
           
            if($today >= 7) {
                $today = 0;
            }
            
            $dinnerItem = DinnerMenu::findByDay($days[$today]);
            
            if(!$dinnerItem instanceof DinnerMenu) {
                $response->respond("I'm sorry, there was a problem retrieivng the dinner menu.");
                $response->endSession();
                return \Response::json($response->render());
            }
            
            if($dinnerItem->menu == '?????') {
                $skippedDays[] = $dayLong[$days[$today]];
                $today++;
                continue;
            }
            
            $menuItems[] = "{$dayLong[$days[$today]]}: {$dinnerItem->menu}";
            $dinnerItem = null;
            $today++;
        }
        
        $responseStr .= implode(', ', $menuItems);
        
        if(!empty($skippedDays)) {
            if(count($skippedDays) == 1) {
                $responseStr .= ". Nothing has been planned for dinner on {$skippedDays[0]}";
            } else {
                $lastDay = array_pop($skippedDays);
                $responseStr .= ". Nothing has been planned for dinner on " . implode(',', $skippedDays) . " or " . $lastDay;
            }
        }
        
        $response->respond($responseStr);
        $response->endSession();
        
        return \Response::json($response->render());
    }
}