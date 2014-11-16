	
<?php
	// Posts are found
	if ( $posts->have_posts() ) {
		echo '<div class="owl-post-slider">';
		while ( $posts->have_posts() ) :
			$posts->the_post();
			global $post, $template;
			$w = ( basename($template) == 'page.php')? 400 : 226;
			$h = $w*( 170/226 );
			?>

			<div  id="su-post-<?php the_ID(); ?>" class="su-slider-slide">
				<?php 
					if ( has_post_thumbnail() ) : 
						$fullsize = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 						
				 	endif; 
				  ?>
				<div class="single-content-large">
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>" class="image-wrap">
							<img src="<?php echo caps_image_resize( $fullsize[0], $w, $h, true, 'c', false ) ?>" alt="<?php the_title(); ?>">
							<?php caps_post_format_icon(); ?>
						</a>
					<?php endif; ?>						
					<h3><a href="<?php the_permalink(); ?>"><?php echo (strlen(get_the_title()) > 26 )? substr(get_the_title(), 0, 23).'..' : get_the_title(); ?></a></h3>
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

