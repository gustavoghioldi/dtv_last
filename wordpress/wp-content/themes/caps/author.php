<?php
/**
 * The template for displaying Author archive pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package themecap
 * @subpackage caps
 * @since caps 1.0
 */

get_header(); ?>
  <?php get_template_part( 'content/before'); ?>
      <?php
		$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
	  ?>
      <p>This is <?php echo $curauth->nickname; ?>'s page</p>
      <h3><?php printf( __( 'All posts by %s', THEMENAME ), '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a>' ); ?></h3>
      <?php rewind_posts(); ?>
        <?php if ( get_the_author_meta( 'description' ) ) : ?>
			 <?php get_template_part( 'content/author-bio' ); ?>
        <?php endif; ?>
		
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