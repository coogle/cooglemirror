<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use RecipeParser\FileUtil;
use RecipeParser\RecipeParser;

class ParseRecipeCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'coogle-mirror:parse-recipe';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Parse a Recipe URL';

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
	    $downloadUrl = $this->argument('url');
	    
	    $html = FileUtil::downloadRecipeWithCache($downloadUrl);
	    $url = \RecipeParser\Text::getRecipeUrlFromMetadata($html);
	    $dom = \RecipeParser\Text::getDomDocument($html);
	    $recipe = RecipeParser::parse($dom, $url);
	    
	    var_dump($recipe);
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
