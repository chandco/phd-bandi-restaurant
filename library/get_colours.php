<?php

/// This might not be called within wordpress, do NOT use wordpress functions

function get_colours() {



	$colours = file_get_contents( dirname(__FILE__) . "/less/colours.less" );

	$colours = explode(";", $colours);

	function trim_value(&$value) 
	{ 	
		// clear whitespace
	    $value = trim( str_replace( " ", "", str_replace("@", "", $value) ) ); 

	    // sepearate the colon
	    $value = explode(":", $value);
	}

	array_walk($colours, 'trim_value');



	$colour_array = array();

	foreach ($colours as $colour) {

		if (!$colour[0]) continue;
		
		if (strstr($colour[0], '-text')) {
			$colour_array[str_replace("-text", "", $colour[0])]['text'] = $colour[1];

		} else {

			$colour_array[ $colour[0] ]['background'] = $colour[1];
		}

	}

	return $colour_array;

}