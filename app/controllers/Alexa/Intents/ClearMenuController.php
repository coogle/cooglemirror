<?php

namespace Alexa\Intents;

use Cooglemirror\Dinner\Models\DinnerMenu;
class ClearMenuController extends AbstractController
{
    public function execute(\Alexa\Request\IntentRequest $request)
    {
        foreach(['mon', 'tues', 'weds', 'thurs', 'fri', 'sat', 'sun'] as $dayOfWeek) {
            $menuObj = DinnerMenu::where('day', '=', $dayOfWeek)->first();

            if(!$menuObj instanceof DinnerMenu) {
                $menuObj = new DinnerMenu();
                $menuObj->day = $dayOfWeek;
            }

            $menuObj->menu = '?????';
            $menuObj->save();
        }
        
        $response = new \Alexa\Response\Response();
        $response->respond("I have cleared the dinner menu");
        $response->endSession();
        
        \Event::fire(\SwitchUrlHandler::EVENT, '\\');
        
        return \Response::json($response->render());
    }
}