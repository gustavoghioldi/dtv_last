<?php	
$column = isset($posts->smallboxcolumn)? $posts->smallboxcolumn : 2;
$excerptlength = isset($posts->excerptlength)? $posts->excerptlength : 20;
$smallboxexcerpt = isset($posts->smallboxexcerpt)? $posts->smallboxexcerpt : 'no';
$imgwidth = ($column == 1)? 400 :  round(400 / $column);
$imgheight = $imgwidth;

$class = "col-lg-".(12/$column)." col-md-".(12/$column)." col-sm-".(12/$column)." col-xs-12";
?>

<div class="<?php echo $class; ?>">
	<?php 
		if ( has_post_thumbnail() ) : 
			$fullsize = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
	 	endif; 
	 	$tclass  = '';
	?>

	<div class="single-content-small">
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" class="image-wrap">
				<img class="lazy" src="<?php echo caps_image_resize( $fullsize[0], $imgwidth, $imgheight, true, 'c', false ) ?>" alt="<?php the_title(); ?>">
				<?php caps_post_format_icon(); ?>
			</a>
		<?php else: ?>	
			<?php $tclass = ' full-width'; ?>
		<?php endif; ?>	
		<div class="right-desc<?php echo $tclass ?>">
			<h5><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h5>
			<?php caps_post_info(); ?>
			<?php echo (($smallboxexcerpt != 'no') && ($excerptlength > 0))? wp_trim_words(get_the_excerpt(), $excerptlength) : '';  ?>
		</div>
	</div>

</div>

			