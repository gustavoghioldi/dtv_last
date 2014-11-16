<div class="row">
<?php
if(!defined('LTL'))
define('LTL',  ot_get_option('list_text_length', 120));
if(!defined('LBTL'))
define('LBTL', ot_get_option('large_title_length', 35) );
if(!defined('LBCL'))
define('LBCL', ot_get_option('large_text_length', 100) );
if(!defined('SBTL'))
define('SBTL', ot_get_option('small_title_length', 30) );
if(!defined('STL'))
define('STL', ot_get_option('slider_title_length', 25) );

	$page_layout = caps_get_layout();
	// Posts are found
	if ( $posts->have_posts() ) {
		$count = 1;
		while ( $posts->have_posts() ) :
			$posts->the_post();
			$content = ot_get_option('archive_posts_display', 'list');
        	get_template_part( 'inc/ajax-load-more/includes/'.$content);  
		endwhile;
	}
	// Posts not found
	else {
		echo '<h4>' . __( 'Posts not found', 'su' ) . '</h4>';
	}
?>
</div>

