<?php 

class SwitchUrlHandler
{
    const CHANNEL = "cooglemirror.ui.switch_url";
    const EVENT = "cooglemirror.ui.switch_url";
    
    public function handle($data)
    {
        $redis = Redis::connection();
        $redis->publish(self::CHANNEL, $data);
    }
}