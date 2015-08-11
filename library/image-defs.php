<?php

$max = 1400;



$max_tablet = 900;
$max_mobile = 600;


$tablet_ratio = $max_tablet / $max;
$mobile_ratio = $max_mobile / $max;

$keepAbove = 250; // don't make thumbnails smaller than this


$ratio = (9 / 16); // could be 16:9 but this can be restrictive. Photographers often things as 6:4 landscape

// we're hard coding the 900 value here.  however, this is based on our 'max width' blog which has a max width of 900px

$featured = array( $max_tablet, floor($max_tablet * $ratio), true); // this can be our gallery image
$panorama = array($max, 600, true); // hard crop. 600px in the CSS.  Generally this is just overf half the screen (1080) so it's okay.

// a thumbnail is generally going to be in a trio, a 3 column layout.  so if maxwidth is 1000px it's ~ 333px wide, and less with margins thus .33 of 900px
$thumbnail = array( floor($featured[0] * 0.33), floor($featured[1] * 0.33), true);
$medium = array( floor($featured[0] * 0.50), floor($featured[1] * 0.50), true);
$large = array( $featured[0], $featured[1], false); // soft crop featured image