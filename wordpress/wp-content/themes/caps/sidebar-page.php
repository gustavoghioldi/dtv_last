<?php
/**
 * The sidebar containing the blog widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 */
?>
<div class="sidebar">
	 <?php wp_reset_postdata(); ?> 
	<?php
		
		$sidebar = get_post_meta(get_the_ID(), 'custom_sidebar', true);	

		$sidebar = ($sidebar != '')? $sidebar : 'sidebar-1';
		$sidebar = is_front_page()? 'sidebar-front'	 : $sidebar;
	?>

  <?php if ( is_active_sidebar( $sidebar ) ) : ?>
		<?php dynamic_sidebar( $sidebar ); ?>
  <?php else: ?>
  <?php $args = 'before_widget = <div class="widget">&after_widget=</div>&before_title=<h3 class="title"><span>&after_title=</span></h3>'; ?>
  <?php the_widget( 'WP_Widget_Pages', '', $args ); ?> 
<?php endif; ?>
</div><!--.sidebar-->