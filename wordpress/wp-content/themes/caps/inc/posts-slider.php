<?php
	$page_layout = (get_post_meta(get_the_ID(), 'page_layout', true) != '')? get_post_meta(get_the_ID(), 'page_layout', true) : 'rs';
	$slider_width = ot_get_option('slider_width');
	$slider_height = ot_get_option('slider_height');
	$slider_posts = ot_get_option('slider_posts');
	$category_display = ot_get_option('category_display');
	$post_format_display = ot_get_option('post_format_display');
	$excerpt_display = ot_get_option('excerpt_display');
	$excerpt_length = ot_get_option('excerpt_length');
	$width = ($page_layout == 'full') ? $slider_width : round($slider_width * 2 / 3);
	$height = ($page_layout == 'full') ? $slider_height : round($slider_height * 2 / 3);
	$exclude_cat = ot_get_option('include_cat', array());

	$event = ot_get_option('post_event', array());
	
?>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 slider-wrap">
		<?php
		$args = array(
			'posts_per_page' => $slider_posts,
			'post_type' => array('post', 'event'),
			'category__and' => $exclude_cat,
			'post__in' => $event
			);
		$query = new WP_Query( $args ); 

		if ( $query->have_posts() ):        	       
			echo '<div class="main-slider">';
			while ( $query->have_posts() ) :$query->the_post();
					if(has_post_thumbnail()):
					$fullsize = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
					$url = caps_image_resize( $fullsize[0], $width, $height, true, 'c', false );
					echo '<div class="item">';
						echo '<div class="img-wrap"><img class="lazyOwl" src="'.$url.'" alt="'.get_the_title().'"></div>';
						if(get_post_type() == 'event'){
							$category = get_the_terms($post->ID, 'event-category');		
							if ( $category && ! is_wp_error( $category ) ) : 
								foreach ($category as $key => $value) {
									$category[0] = $value;
								}
							else:
								$category[0] = new stdClass();
							endif;
						}else{
							$category = get_the_category();
						}
							



						$cat = $category[0]->name;
						if($cat != ''){
						$catename = wordwrap($cat, 1, "<br />\n", true);
						echo ($category_display == 'on')? '<a class="slide-cat category-'.$category[0]->term_id.'" href="'.get_category_link($category[0]->term_id).'">'.$catename.'</a>' : '';
						}
						echo '<div class="slideinfo scaleUp">';
							echo '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
							echo '<p><span class="date-meta"><i class="genericon genericon-time"></i>'.get_the_time( get_option( 'date_format' ) ).'</span></p>';
							echo ($excerpt_display == 'on')? '<p>'.wp_trim_words( get_the_content(), $num_words = $excerpt_length, '' ).'</p>' : '';
						echo '</div>';						
						if(($post_format_display == 'on') && (get_post_type() == 'post'))caps_post_format_icon();
					echo '</div>';
					endif;
			endwhile;
			echo '</div>';
		endif;
		wp_reset_postdata();
		?>
	</div>
	
</div>