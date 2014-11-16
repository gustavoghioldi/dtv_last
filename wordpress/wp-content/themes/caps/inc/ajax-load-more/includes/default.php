<?php	
$page_layout = ot_get_option('blog_page_layout', 'rs');	
$class = ( $page_layout == 'full')? 'col-lg-4 col-md-4 col-sm-6 col-xs-12' : 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
$imgwidth = ($page_layout == 'full')? 1180 : 1180 * (2/3) ;
$imgheight = round($imgwidth / 2);
?>

<div class="<?php echo $class; ?>">
	<?php 
		if ( has_post_thumbnail() ) : 
			$fullsize = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
	 	endif; 
	?>
	<div class="single-content-large">
		
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" class="image-wrap">							
				<img src="<?php echo caps_image_resize( $fullsize[0], $imgwidth, $imgheight, true, 'c', false ) ?>" alt="<?php the_title(); ?>">						
				<?php caps_post_format_icon(); ?>
			</a>
		<?php endif; ?>		
						
		<h4><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
		<?php caps_post_info(); ?>
		<p><?php echo get_the_excerpt(); ?></p>						
	</div>

</div>
