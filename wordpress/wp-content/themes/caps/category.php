<?php
/**
 * The template for displaying Category pages.
 *
 * Used to display archive-type pages for posts in a category.
 *
 *
 * @package caps
 * @subpackage caps
 * @since caps 1.0
 */

get_header(); ?>
  <?php get_template_part( 'content/before'); ?>
   
    <?php        
        // Posts are found
        if ( have_posts() ) {
          while ( have_posts() ) { the_post();   
            $content = ot_get_option('archive_posts_display', 'list');
            get_template_part( 'content/'.$content); 
        	}
    	}
    ?>
      
  <?php if( function_exists( 'caps_numeric_posts_nav' ) ) { caps_numeric_posts_nav(); } ?>
  <?php get_template_part( 'content/after' ); ?>

<?php get_footer(); ?>