<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package themecap
 * @subpackage caps
 * @since Tcaps 1.0
 */

get_header(); ?>
  <div class="content">
      <div class="bredcrumbs">
        <h1 class="align-center"><?php echo _e( 'Page Not Found!', THEMENAME ); ?></h1>
      </div><!--.bredcrumbs-->
		<div class="title-content"><h3 class="title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', THEMENAME ); ?></h3>
        <div class="title-border"><span></span></div></div>
        <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', THEMENAME ); ?></p>
		<?php get_search_form(); ?>
  </div>
<?php get_footer(); ?>