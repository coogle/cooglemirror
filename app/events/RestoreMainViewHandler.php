<?php 

class RestoreMainViewHandler
{
    const CHANNEL = "cooglemirror.ui.switch_url";
    const EVENT = "cooglemirror.ui.restore_main";
    
    public function handle()
    {
        $redis = Redis::connection();
        $redis->publish(self::CHANNEL, '/');
    }
}