<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package themecap
 * @subpackage caps
 * @since caps 1.0
 */
$page_layout = caps_get_layout();
// Posts are found
	global $post;
	$image_class = ( $page_layout == 'full' )? 'col-lg-4 col-md-4 col-sm-6 col-xs-12' : 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
	$container_class = ( $page_layout == 'full' )? 'col-lg-8 col-md-8 col-sm-6 col-xs-12' : 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
	$wordcount = ( $page_layout == 'full' )? LEL*2 : LEL;

	$width = ($page_layout == 'full')? 1180 : 1180 * (2/3) ;
	$imgwidth = $width/2;
	$imgheight = round($imgwidth / 2.07);
?>
<div class="row">
<div <?php post_class( 'post-blog post list-post-blog' ); ?> >

    
        
        <?php
		if ( has_post_thumbnail() ) : 
			$fullsize = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
		else:
			$wordcount = $wordcount * 2;
		endif;
		?>        
        
          <?php if ( has_post_thumbnail() ) : ?>
	          	<div class="<?php echo $image_class; ?>"><div class="single-content-image">
		          	<a href="<?php the_permalink(); ?>" class="image-wrap">
		        		<img src="<?php echo caps_image_resize( $fullsize[0], $imgwidth, $imgheight, true, 'c', false ) ?>" alt="<?php the_title(); ?>">
		        	</a>
		        	<?php caps_post_format_icon(); ?>
	        	</div></div>
            <?php else: ?>
            	<?php $container_class = 'col-lg-12'; ?>
          <?php endif; ?>

          
        
       
    
    <div class="<?php echo $container_class; ?>">
        <h3><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>        
        <p><?php echo wp_trim_words( get_the_excerpt(), $wordcount); ?></p>       
        <div class="post-meta-info"><?php caps_post_info(); ?></div>      
    </div>	
    
</div>
</div>
