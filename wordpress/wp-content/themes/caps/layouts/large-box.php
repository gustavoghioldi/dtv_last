
<?php	
$page_layout = ot_get_option('blog_page_layout', 'rs');	
global $post;
	$boxtype = isset($posts->boxtype)? $posts->boxtype : 'no';
	$column = isset($posts->largeboxcolumn)? $posts->largeboxcolumn : 2;
	$category_display = isset($posts->largeboxcategory)? $posts->largeboxcategory : 'no';
	$post_format_display = isset($posts->largeboxicon)? $posts->largeboxicon : 'yes';
	$excerptlength = isset($posts->excerptlength)? $posts->excerptlength : 20;

	$width = ($page_layout == 'full')? 1180 : 1180 * (2/3) ;
	$imgwidth = ($column == 1)? $width :  round($width / $column);
	$imgheight = round($imgwidth / 2);


	
	$class = "col-lg-".(12/$column)." col-md-".(12/$column)." col-sm-".(12/$column)." col-xs-12";
?>

<div class="<?php echo $class; ?>">
	<?php 
		if ( has_post_thumbnail() ) : 
			$fullsize = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
	 	endif; 
	 	$tclass = '';
	  ?>
		<?php if( $boxtype == 'no' ): ?>
			<div class="single-content-image">
				
				<?php if ( has_post_thumbnail() ) : ?>							
					<a href="<?php the_permalink(); ?>" class="image-wrap">	
						<img  class="lazy" src="<?php echo caps_image_resize( $fullsize[0], $imgwidth, $imgheight, true, 'c', false ) ?>" alt="<?php the_title(); ?>">							
	            		<?php if($post_format_display != 'no'){caps_post_format_icon();} ?>	
	            	</a>	
	            	<?php
						$category = get_the_category();
						$cat = $category[0]->name;
						$catname = wordwrap($cat, 1, "<br />\n", true);
						echo ($category_display != 'no')? '<a class="slide-cat category-'.$category[0]->term_id.'" href="'.get_category_link($category[0]->term_id).'">'.$catname.'</a>' : '';
					?>
				<?php else: ?>	
					<?php 
						$excerptlength = $excerptlength * 2; 
						$tclass = ' class="margin-top-none"';
					?>
				<?php endif; ?>		
				
				
				
								
				<h4<?php echo $tclass ?>><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
				
				<p><?php echo wp_trim_words(get_the_excerpt(), $excerptlength); ?></p>		
				<div class="post-meta-info"><?php caps_post_info(); ?></div>				
			</div>
		<?php else: ?>
			<?php
				$slider_width = ot_get_option('slider_width');
				$slider_height = ot_get_option('slider_height');
				
				$width = ($page_layout == 'full') ? $slider_width : round($slider_width * 2 / 3);
				$height = ($page_layout == 'full') ? $slider_height : round($slider_height * 2.2 / 3);

				$imgwidth = ($column == 1)? $width :  round($width / $column);
				$imgheight = ($column == 1)? $height : round($height / $column);
				if($column > 1 ) { $imgheight = $imgwidth;	}	
			?>
			<div class="single-content-image image-only">
				<a href="<?php the_permalink(); ?>" class="image-wrap">
					<?php if ( has_post_thumbnail() ) : ?>							
							<img class="lazy" src="<?php echo caps_image_resize( $fullsize[0], $imgwidth, $imgheight, true, 'c', false ) ?>" alt="<?php the_title(); ?>">							
		            <?php else: ?>                       
						<img src="http://placehold.it/400x400" alt="<?php the_title(); ?>">				
					<?php endif; ?>		
					<?php caps_post_format_icon(); ?>
					<h5><?php the_title(); ?></h5>
				</a>
			</div>
		<?php endif; ?>

</div>


			


