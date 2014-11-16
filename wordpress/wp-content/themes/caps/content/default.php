<?php	
$page_layout = ot_get_option('blog_page_layout', 'rs');	
$total_large = ( $page_layout == 'full' )? 3 : 2;
$class = ( $page_layout == 'full')? 'col-lg-4 col-md-4 col-sm-6 col-xs-12' : 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
$excerptlength = ( $page_layout == 'full' )? LBEL*2 : LBEL;

?>
<div  id="post-<?php the_ID(); ?>" class="<?php echo $class; ?>">
	<?php 
		if ( has_post_thumbnail() ) : 
			$fullsize = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
	 	endif; 
	?>
	<div class="single-content-image default-content">
		
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" class="image-wrap">							
				<img class="lazy" src="<?php echo caps_image_resize( $fullsize[0], 400, 200, true, 'c', false ) ?>" alt="<?php the_title(); ?>">						
				<?php caps_post_format_icon(); ?>
			</a>
		<?php endif; ?>		
						
		<h4><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
		<?php caps_post_info(); ?>
		<p><?php echo wp_trim_words(get_the_excerpt(), $excerptlength); ?></p>	
		<?php $blog_readmore_text = ot_get_option( 'blog_readmore_text', 'more' ); ?>
	    <a href="<?php the_permalink(); ?>" class="read-more-post"><?php echo $blog_readmore_text; ?></a>					
	</div>
</div>


