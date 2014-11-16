<?php
/**
 * Template Name: Front page
 *
 * Description: caps loves thepage with sidebar look as much as
 * you do. Use this page template to show the sidebar in any page.
 *
 */
?>
<?php get_header(); ?>
  <?php while ( have_posts() ) : the_post(); ?>
  <div class="content">
      <div class="row">
        <?php $default_sidebar_position = ot_get_option( 'default_sidebar_position', 'right' ); ?>
      <?php if( $default_sidebar_position != 'right' ): ?>
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <?php get_sidebar('page'); ?>
      </div><!--.col-lg-3-->
      <?php endif; ?>
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
          <?php the_content(); ?>
          <?php $allow_comments_on_pages = ot_get_option( 'allow_comments_on_pages' ); ?>
          <?php if( $allow_comments_on_pages == 'on' ): ?>
          	<?php comments_template( '', true ); ?>
          <?php endif; ?> 
        </div><!--.col-lg-9-->
        <?php if( $default_sidebar_position == 'right' ): ?>
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <?php get_sidebar('page'); ?>
      </div><!--.col-lg-3-->
      <?php endif; ?>       
      </div><!--.row-->    
  </div>
<?php endwhile; ?>    
<?php get_footer(); ?>