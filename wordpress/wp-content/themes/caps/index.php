<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */
?>
<?php get_header(); ?>
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