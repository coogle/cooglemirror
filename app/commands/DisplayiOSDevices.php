<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Cooglemirror\IOS\FindMyiPhone;

class DisplayiOSDevices extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'coogle-mirror:display-ios-devices';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Display iOS Devices';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$fmi = new FindMyiPhone(\Config::get('services.iCloud.username'), \Config::get('services.iCloud.password'), false);
		
		$fmi->getDevices();
		
		foreach($fmi->devices as $device) {
		    $this->info("{$device->name} : {$device->ID}");
		}
		
		$fmi->playSound("bhve8lD8GHqSEeag1lr6uM6TiNdEk4CBJYzEjJbc4RfAgHzZibR2oeHYVNSUzmWV", "Testing 1 2 3");
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
		);
	}

}
