<?php

namespace Cooglemirror;

class Audio
{
    static public function record($lenSecs)
    {
        $audio = tempnam('/tmp', 'rec_');
        
        $lenSecs = (int)$lenSecs;
        
        $cmd = "/usr/bin/arecord -f dat -d $lenSecs $audio";
        
        $returnVal = null;
        $output = null;
        
        exec($cmd, $output, $returnVal);
        
        if($returnVal != 0) {
            throw new \Exception("Failed to record audio");
        }
        
        return $audio;
    }
    
    static public function play($file)
    {
        $cmd = "/usr/bin/aplay $file";
        
        $returnVal = null;
        $output = null;
        
        exec($cmd, $output, $returnVal);
        
        if($returnVal != 0) {
            throw new \Exception("Failed to Play Audio");
        }
    }
}
