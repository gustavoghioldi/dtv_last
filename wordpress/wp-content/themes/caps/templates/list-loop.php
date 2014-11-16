<?php
$excerptlength = isset($posts->excerptlength)? $posts->excerptlength : 20;
$page_layout = caps_get_layout();
// Posts are found
if ( $posts->have_posts() ) {
	while ( $posts->have_posts() ) {
		$posts->the_post();
		global $post;
		$image_class = ( $page_layout == 'full' )? 'col-lg-4 col-md-4 col-sm-6 col-xs-12' : 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
		$container_class = ( $page_layout == 'full' )? 'col-lg-8 col-md-8 col-sm-6 col-xs-12' : 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
		$excerptlength = ( $page_layout == 'full' )? ($excerptlength*2) : $excerptlength;
		$post_format_display = isset($posts->largeboxicon)? $posts->largeboxicon : 'yes';
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'post-blog post' ); ?> >
  <div class="row">
	    <div class="<?php echo $image_class; ?>">
	        <div class="single-content-image">
	        <?php
			if ( has_post_thumbnail() ) : 
				$fullsize = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
			endif;
			?>        
	        <a href="<?php the_permalink(); ?>">
	          <?php if ( has_post_thumbnail() ) : ?>
	        	<img src="<?php echo caps_image_resize( $fullsize[0], 325, 160, true, 'c', false ) ?>" alt="<?php the_title(); ?>">
	            <?php else: ?>
	            <img src="http://placehold.it/335x200" alt="<?php the_title(); ?>">
	          <?php endif; ?>
	          <?php if($post_format_display != 'no'){caps_post_format_icon();} ?>
	        </a>
	        </div>
	    </div>
	    <div class="<?php echo $container_class; ?>">
	        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>	        
	        <p><?php echo wp_trim_words(get_the_content(), $excerptlength); ?></p>	
	        <div class="post-meta-info"><?php caps_post_info(); ?></div>               
	    </div>
  </div>
</div>
<?php
	}
}
// Posts not found
else {
?>
<h3><?php _e( 'Posts not found', 'su' ) ?></h3>
<?php
}
?>


