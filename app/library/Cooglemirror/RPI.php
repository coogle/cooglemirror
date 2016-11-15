<?php

namespace Cooglemirror;

class RPI
{
    static public function getSerialNumber()
    {
        if(\App::environment() == 'production') {
            $procInfo = "Serial : X000000008cbb005";
        } else {
            $procInfo = file_get_contents('/proc/cpuinfo');
        }
        
        foreach(explode("\n", $procInfo) as $line) {
            $pieces = explode(":", $line);

            if(trim($pieces[0]) == "Serial") {
                return trim($pieces[1]);
            }
            
        }
        
        throw new \Exception("Could not determine RPI Serial Number");
    }
}