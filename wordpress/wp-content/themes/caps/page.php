<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 */

get_header(); ?>
  
	<?php
	$page_layout = (get_post_meta(get_the_ID(), 'page_layout', true) != '')? 
	get_post_meta(get_the_ID(), 'page_layout', true) : 'rs';
	

	get_template_part('layouts/page', $page_layout);
	?> 
       
<?php get_footer(); ?>