<?php 

Event::listen(ShowTimedUrlHandler::EVENT, 'ShowTimedUrlHandler');
Event::listen(SwitchUrlHandler::EVENT, 'SwitchUrlHandler');
Event::listen(RestoreMainViewHandler::EVENT, 'RestoreMainViewHandler');