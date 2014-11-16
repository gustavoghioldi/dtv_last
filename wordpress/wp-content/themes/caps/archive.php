<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, caps already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 *
 * @package caps
 * @subpackage caps
 */
 
get_header(); ?>

	 <?php get_template_part( 'content/before'); ?>
    <?php
    if ( is_day() ) :
      printf( __( 'Daily Archives: %s', THEMENAME ), '<span>' . get_the_date() . '</span>' );
    elseif ( is_month() ) :
      printf( __( 'Monthly Archives: %s', THEMENAME ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', THEMENAME ) ) . '</span>' );
    elseif ( is_year() ) :
      printf( __( 'Yearly Archives: %s', THEMENAME ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', THEMENAME ) ) . '</span>' );
    else :
    _e( 'Archives', THEMENAME );
    endif;
    ?>
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