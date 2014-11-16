<?php
/**
 * The sidebar containing the blog widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 */
?>
<div class="sidebar">
	
	<?php
		$sidebar = 'sidebar-1';
	?>

	<?php if ( is_active_sidebar( $sidebar ) ) : ?>
		<?php dynamic_sidebar( $sidebar ); ?>
	<?php else: ?>
		<?php $args = 'before_widget = <div class="widget">&after_widget=</div>&before_title=<h3 class="title"><span>&after_title=</span></h3>'; ?>
		<?php the_widget( 'WP_Widget_Archives', '', $args ); ?> 
		<?php the_widget( 'WP_Widget_Pages', '', $args ); ?> 
	<?php endif; ?>


</div><!--.sidebar-->