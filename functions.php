<?php


define('GAPROPERTYID', 'UA-67905942-1');
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
	$array = array (
      "{gallery" => "[gallery",
      "{feature-box" => "[feature-box"
	);

	$post = strtr($post, $array);

	$post = strtr($post, $array);

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





add_action( 'after_setup_theme', 'phd_child_theme_setup' );

function phd_child_theme_setup() {
   remove_shortcode( 'showposts' );	
	add_shortcode( 'showposts', 'phd_cf_postsfeed' );	
}

function phd_cf_postsfeed($atts) {

	

	$atts = shortcode_atts( array(
		'category' => false,
		'number' => 4,
		'post_type' => 'post'
		)

	, $atts, 'showposts' );		


	$args = $atts; // let people do a full wp_query, but do some overrides for security...

	$args["post_status"] = 'publish'; // don't let people show private ones at this stage.

	$args["post_type"] = $atts["post_type"];

	if ($atts["category"]) {
		$args["category_name"] = $atts["category"];
	}

	$args["posts_per_page"] = $atts["number"];


	$posts_array = get_posts( $args );


	
	// The Loop
	$output = "";

	
	if (count($posts_array)) {
	
		ob_start();
		echo "<ul class='post-list shortcode-post-list'>";
			foreach ( $posts_array as $post ) : setup_postdata( $post );
			
			
				global $more;    // Declare global $more (before the loop).
				$more = 0;       // Set (inside the loop) to display content above the more tag.
					
					//add_filter('the_content','my_strip_tags');

				
				?>


				<li class='post-preview'>
					<a href='<?php echo get_permalink( $post->ID ); ?>'>
						<div class='image-container'>
							<?php
							if (has_post_thumbnail($post->ID)) {
								echo responsive_image_thumbnail($post->ID, 'thumbnail');
							}
							?>
						</div>	

						<h4><?php echo $post->post_title; ?></h4>
					</a>
					
					<div class='excerpt'>
						<?php echo string_limit_words( $post->post_excerpt, 40 ); ?>
					</div>

					<div class='read-more'>
						<a href='<?php echo get_permalink( $post->ID ); ?>'>Read More</a>
					</div>
				</li>
		<?php
			
			endforeach;
			wp_reset_postdata();
		echo "</ul>";

		$output = ob_get_contents();

		ob_end_clean();

	}

	return $output;
}