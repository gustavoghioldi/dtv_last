	
<?php
	// Posts are found
	if ( $posts->have_posts() ) {
		$count = 1;
		while ( $posts->have_posts() ) :
			$posts->the_post();
			global $post, $template;
			$class = ( basename($template) == 'page.php')? 'col-lg-4 col-md-4 col-sm-6 col-xs-12' : 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
			?>

			<div  id="su-post-<?php the_ID(); ?>" class="<?php echo $class; ?>">
				<?php 
					if ( has_post_thumbnail() ) : 
						$fullsize = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
				 	endif; 
				  if($count == 1): ?>
					<div class="single-content-large">
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>" class="image-wrap">
								<img src="<?php echo caps_image_resize( $fullsize[0], 400, 200, true, 'c', false ) ?>" alt="<?php the_title(); ?>">
								<?php caps_post_format_icon(); ?>
							</a>
						<?php endif; ?>						
						<h3><a href="<?php the_permalink(); ?>"><?php echo (strlen(get_the_title()) > 35 )? substr(get_the_title(), 0, 33).'..' : get_the_title(); ?></a></h3>
						
						<p><?php echo (strlen(get_the_excerpt()) > 100 )? substr(get_the_excerpt(), 0, 98).'..' : get_the_excerpt(); ?></p>						
					</div>
				<?php else: ?>

					<div class="single-content-small">
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>" class="image-wrap">
								<img src="<?php echo caps_image_resize( $fullsize[0], 100, 100, true, 'c', false ) ?>" alt="<?php the_title(); ?>">
								<?php caps_post_format_icon(); ?>
							</a>
						<?php endif; ?>	
						<div class="right-desc">
							<a href="<?php the_permalink(); ?>"><?php echo (strlen(get_the_title()) > 30 )? substr(get_the_title(), 0, 28).'..' : get_the_title(); ?></a>
							<?php caps_post_info(); ?>
						</div>
					</div>

				<?php endif; ?>
			</div>

			<?php
			$count++;
		endwhile;
	}
	// Posts not found
	else {
		echo '<h4>' . __( 'Posts not found', 'su' ) . '</h4>';
	}
?>

