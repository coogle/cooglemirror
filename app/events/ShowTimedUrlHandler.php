<?php 

class ShowTimedUrlHandler
{
    const CHANNEL = "cooglemirror.ui.timed_url";
    const EVENT = "cooglemirror.ui.timed_url";
    
    public function handle($url, $timeout)
    {
        $data = compact('url', 'timeout');
        
        $redis = Redis::connection();
        $redis->publish(self::CHANNEL, json_encode($data));
    }
}