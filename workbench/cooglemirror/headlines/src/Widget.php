<?php

namespace Cooglemirror\Headlines;

class Widget
{
    public function compose($view)
    {
        $feedUrl = "http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=8&q=http%3A%2F%2Fnews.google.com%2Fnews%3Foutput%3Drss";
        
        $headlines = [];
        
        $response = file_get_contents($feedUrl);
        $feed = json_decode($response, true);
        
        foreach($feed['responseData']['feed']['entries'] as $entry) {
            $headlines[] = $entry['title'];
        }
        
        $view->with('headlines', $headlines);
    }
    
}