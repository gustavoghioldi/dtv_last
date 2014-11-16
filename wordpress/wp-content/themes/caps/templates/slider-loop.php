<div class="row">	
<?php
	$column = isset($posts->largeboxcolumn)? $posts->largeboxcolumn : 3;
	if(is_page()){
		$page_layout = (get_post_meta(get_the_ID(), 'page_layout', true) != '')? 
	                  get_post_meta(get_the_ID(), 'page_layout', true) : 'rs';
	}else{
		$page_layout = ot_get_option('blog_page_layout', 'rs');
	}
	// Posts are found
	if ( $posts->have_posts() ) {
		echo '<div class="owl-post-slider">';
		while ( $posts->have_posts() ) :
			$posts->the_post();
			global $post, $template;
			$w = ( $page_layout == 'full' )? 400 : 226;
			$h = $w*( 170/226 );
			?>

			<div class="su-slider-slide">
				<?php 
					if ( has_post_thumbnail() ) : 
						$fullsize = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 						
				 	endif; 
				  ?>
				<div class="single-content-image">
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>" class="image-wrap">
							<img class="lazyOwl" src="<?php echo caps_image_resize( $fullsize[0], $w, $h, true, 'c', false ) ?>" alt="<?php the_title(); ?>">
							<?php caps_post_format_icon(); ?>
						</a>
					<?php endif; ?>						
					<h4><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
					<?php caps_post_info(); ?>
				</div>				
			</div>

			<?php
		endwhile;
		echo '</div>';
	}
	
	// Posts not found
	else {
		echo '<h4>' . __( 'Posts not found', 'su' ) . '</h4>';
	}
?>
</div>
