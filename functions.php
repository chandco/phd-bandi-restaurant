<?php



add_action( 'after_setup_theme', 'my_ag_child_theme_setup' );
// new feature box

function my_ag_child_theme_setup() {
	remove_shortcode( 'feature-box' );
	add_shortcode( 'feature-box', 'child_theme_shortcode_feature_box' );	
}



function child_theme_shortcode_feature_box($atts, $content = false) {

	
	$output = "";

	 
	
	 // get some sort of image from img id

	

	if ( $content ) { $p_class = "feature has-content"; } else { $p_class = "feature  has-content"; }


	if ($atts["colour"]) {
		$p_class .= " " . $atts["colour"];
	}

	if ( $atts["link"] ) {
		$p_class .= " has-link";
	}
	if ( $atts["link"] ) {	$output .= '<a href="' . $atts["link"] . '" title="' . $atts["linktitle"] . '">'; } 
	$output .= '<div class="' . $p_class . '">';
	
	

	if ($atts["imgid"] != "" && $atts["imgid"] != 'undefined') {

		$img = wp_get_attachment_image_src($atts["imgid"], responsive_conditional_size('medium'));
		$output .= 	'<header>';
		$output .= 		'<img src="' . $img[0] . '" />';		
		$output .= 	'</header>';
	}

	

	

	

	
	
	
	
	$output .= '<div class="content">';
	$output .= 	'<h2>';

		if ($atts["icon"]) { $output .= '<i class="fa fa-' . $atts["icon"] . '"></i>'; }
		
		$output .= $atts["title"];
	$output .= '</h2>';


	 if ( $content ) { 
	 	
	 	//if ( $atts["link"] ) {	$output .= '<a href="' . $atts["link"] . '" title="' . $atts["linktitle"] . '">'; } 
		$output .= '<div class="copy">' . wpautop($content) . '</div>';
		//if ( $atts["link"]) {	$output .= '</a>'; } 
		
	 } 
	 $output .= '</div>';


	
	


	$output .= '</div>';
	if ( $atts["link"]) {	$output .= '</a>'; } 
	 

	
	return $output; 
}




remove_filter("the_content", "WrapStuff");
add_filter("the_content", "BBG_WrapStuff", 0);




function BBG_WrapStuff( $post ) {

	$pattern = "/{{section:(\#?.+)}}/";
	

	$chars = preg_split($pattern, $post, null, PREG_SPLIT_DELIM_CAPTURE);
	
	

	$original = $post;

	$newpost = "";
	if (count($chars) == 0) return $post;

	$even = true;


	foreach ($chars as $key => $match) {

		

		if ($even) {
			// content
			$newpost .= $match;

			if ($key > 0) {
				$newpost .= "</div>"; // close div
			}
		} else {

			// flag
			if (substr($match, 0, 1) == '#' || substr(strtolower($match), 0, 3) == 'rgb') {
				$newpost .= "<div class='section full-width-background' style='background:" . $match . ";'>"; 
			} else {
				$newpost .= "<div class='section full-width-background " . $match . "'>"; 
			}
			
			

		}
		
		
		
		$even = ($even) ? false : true; 
	}

	return $newpost;
	// 	/*
	// 	$match == {{section:colour}}
	// 	$matches[1][$key] == colour
	// 	*/

	// 	echo $x . "<textarea>" . print_r($match, true) . "</textarea>";

		
		
		
	// 	$chunk = strstr($post, $match, TRUE ); // everything before this instance of the section
	// 	echo "<textarea>" . $chunk . "</textarea>";
	// 	echo "<textarea>" . $post . "</textarea>";
	// 	echo "<textarea>" . strstr($post, $match) . "</textarea>";
	// 	$newpost .= $chunk;
		
	// 	if ($key > 0) {
	// 		$newpost .= "</div>";
	// 	}
		
	// 	// open the section
	// 	$newpost .= "<div class='section " . $matches[1][$key] . "'>"; 


		
	// 	echo "<hr>";

	// 	$post = str_replace( $match, "", strstr($post, $match) );
	
	// 	$x++;
		
	// }

	// $newpost .= $post . "</div>"; // we never close this in the loop above

	// return $newpost;



}
