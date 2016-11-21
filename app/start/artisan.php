<?php 

use Symfony\Component\Console\Command\Command;

Artisan::add(new CronRunCommand());
Artisan::add(new DisplayiOSDevices());
Artisan::add(new ShowUrlCommand());
Artisan::add(new ParseRecipeCommand());
