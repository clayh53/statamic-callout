<?php
/**
 * add-on: callout
 * @author  Clay Harmon
 * Statamic add-on modifier - filters content
 * section for the callout delimiters
 * {% and %}, shamelessly borrowed from Jekyll 
 * and Octopress
 *
 * the {% classname  beginning delimiter will be replaced with
 * the opening div tag <div class="classname">
 * and the %} delimiter will be replaced with the 
 * closing </div> tag and then allow for custom CSS
 * to style the callout section
 * This will generally be used for whole paragraphs
 * and that is 
 * 
 * 
 */
class Modifier_callout extends Modifier
{
   	var $meta = array(
		'name'			 => 'callout',
		'version'		 => '1',
		'author'		 => 'Clay Harmon',
		'author_url' => 'http://clayharmon.com'
		);
    
    

    public function index($value, $parameters=array())  
        
       
        {	
	        
	        $tag = array_get($parameters, 0, 'div');
			
	        //replaces opening delimiter with <div class="classname">
	        $abbreviation_search = '/{%\s([A-Za-z1-9]*)/';
			$abbreviation_replace = '<'.$tag.' class="$1">';
			$value = preg_replace($abbreviation_search,$abbreviation_replace,$value);

			//replaces closing delimiter with <\div>
	        $abbreviation_search = '/\s%}/';
			$abbreviation_replace = '</'.$tag.'>';
			$value = preg_replace($abbreviation_search,$abbreviation_replace,$value);
			
	  	        
	        return $value;
    	}
    	
}