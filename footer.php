			

		</div>

		<footer class="footer" role="contentinfo">


				<div id="inner-footer" class="wrap cf cf_columns max-central">


					<div class='col-smart'>
						
						
							<nav role="navigation">
								<?php wp_nav_menu(array(
		    					'container' => '',                              // remove nav container
		    					'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
		    					'menu' => __( 'Footer Links', 'cf-theme' ),   // nav name
		    					'menu_class' => 'nav footer-nav cf',            // adding custom nav class
		    					'theme_location' => 'footer-links',             // where it's located in the theme
		    					'before' => '',                                 // before the menu
		        			'after' => '',                                  // after the menu
		        			'link_before' => '',                            // before each link
		        			'link_after' => '',                             // after each link
		        			'depth' => 0,                                   // limit the depth of the nav
		    					'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
								)); ?>
							</nav>
						
					</div>

					<div class='col-smart'>
						<?php dynamic_sidebar( 'footer-middle' ); ?>
					</div>

					<div class='col-smart'>
						<?php dynamic_sidebar( 'footer-right' ); ?>
					

					</div>


					

				</div>

				<div class='footerinfo max-central'><?php echo get_option('cf_footerinfo'); ?></div>

				
			</footer>

		<?php // generally scripts are not loaded in the 'traditiona' sense with wp and ever ?>
		

		   
		
		
		
		
		<!-- End Google Analytics -->
		<div id='popup-menu-container'>
		<?php // put whatever you want here as a pop up window, maybe footer info etc ?>
		</div>
<script>
		var rjs_baseURL = "<?php echo get_template_directory_uri(); ?>/library/dist/js/libs/";
		var rjs_pluginURL = "<?php echo plugins_url(); ?>";
</script>		
<?php 
// BIG DISTINCTION HERE - this is loading from the PARENT THEME and not the child theme, hence template_directory.  Generally the Javascript should be across all themes and not specific.
// Remembering that we're developing in such a way that we know we might be touching all themes together, our child themes are locked down to development of the parents
// so it's okay in the JS of the parent to maybe do some conditional loading or something
// And if you want to override it just use a new footer.
// <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" defer></script> ?>
<?php 
	if (file_exists( get_stylesheet_directory() . "/extra-footer.php" )) {
		include( get_stylesheet_directory() . "/extra-footer.php" );
	}
?>


<script data-main="<?php echo get_template_directory_uri(); ?>/library/js/main.js" src="<?php echo get_template_directory_uri(); ?>/library/js/vendor/require.js" defer></script>		
<script type="text/javascript" src="http://fast.fonts.net/jsapi/e4baf517-7128-4749-bbe6-cfc5fe4b4187.js" defer></script>

<!-- Google Analytics -->
<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', <?php echo GAPROPERTYID; ?>, 'auto');
		  ga('send', 'pageview');

</script>
<?php 

	wp_footer();

?>
	</body>
</html> <!-- end of site. what a ride! -->
