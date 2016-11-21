<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ShowUrlCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'coogle-mirror:show-url';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Trigger a URL in the UI';

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
	    $url = $this->argument('url');
	    
		Event::fire(SwitchUrlHandler::EVENT, $url);
		
		$this->info("Displaying $url");
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
		    ['url', InputArgument::REQUIRED, 'The URL to display in the UI'],
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
