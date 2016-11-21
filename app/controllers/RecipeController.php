<?php

use RecipeParser\FileUtil;
use RecipeParser\RecipeParser;
class RecipeController extends BaseController
{
    public function view()
    {
        $sections = [
            'fullscreen_above' => '',
            'fullscreen_below' => '',
            'top_bar' => '',
            'top_left' => '',
            'top_center' => '',
            'top_right' => '',
            'right_middle' => '',
            'left_middle' => '',
            'upper_third' => '',
            'middle_center' => '',
            'lower_third' => '',
            'bottom_bar' => '',
            'bottom_left' => '',
            'bottom_center' => '',
            'bottom_right' => '',
        ];
        
        try {
            
            $url = \Input::get('url', false);
            
            if(empty($url)) {
                return \Redirect::route('home');
            }
            
            $recipe = $this->parseRecipeUrl($url);
            
            $sections['recipe'] = $recipe;
            
            $layoutView =  \View::make('default.recipe.view', $sections);
    
        } catch(\Exception $e) {
    
            try {
                $sections['upper_third'] = \View::make('default.error', [
                    'exception' => $e
                ])->render();
    
            } catch(\Exception $e) {
                $sections['middle_center'] = '<p><span class="xlarge fa fa-fw fa-bomb"></span></p><p>An error has occurred:</p><p>' . $e->getMessage() . '</p>';
            }
    
            $layoutView =  \View::make('default.index', $sections);
        }
    
        return $layoutView;
        
    }
    
    protected function parseRecipeUrl($downloadUrl)
    {
        $html = FileUtil::downloadRecipeWithCache($downloadUrl);
        $url = \RecipeParser\Text::getRecipeUrlFromMetadata($html);
        $dom = \RecipeParser\Text::getDomDocument($html);
        $recipe = RecipeParser::parse($dom, $url);
        
        return $recipe;
    }
}