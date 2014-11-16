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
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		global $post;
		$image_class = ( $page_layout == 'full' )? 'col-lg-4 col-md-4 col-sm-6 col-xs-12' : 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
		$container_class = ( $page_layout == 'full' )? 'col-lg-8 col-md-8 col-sm-6 col-xs-12' : 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
		
		$img_width = ( $page_layout == 'full' )? 1050 : 708;
?>

	<div id="post-<?php the_ID(); ?>" <?php post_class( 'post-blog post-details' ); ?> >
	  <div class="row">	    
	        
			<?php if ( has_post_thumbnail() ) : ?>
			  	<?php          		
			  		$attachment = caps_get_attachment(get_post_thumbnail_id( $post->ID ));  
			  	?>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="image-wrap">
			    		<img src="<?php echo caps_image_resize( $attachment['src'], $img_width, 350, true, 'c', false ) ?>" alt="<?php the_title(); ?>">
			    		<span class="overlay">
			    			<?php echo $attachment['title']; ?>
			    			<?php echo ($attachment['caption'] != '')? ' - '.$attachment['caption'] : ''; ?>	        			
			    			<a data-mfp-type="image" href="<?php echo $attachment['src']; ?>" data-mfp-src="<?php echo $attachment['src']; ?>" class="zoom-icon su-lightbox"><i class="fa fa-plus"></i> <?php echo __( 'Full view', THEMENAME ); ?></a>
			    			<?php echo ($attachment['description'] != '')? '<p>'.$attachment['description'].'</p>' : ''; ?>			    			
			    		</span>
					</div>
			   </div>
			<?php endif; ?>      

		    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 entry-content">
		        <h3><?php the_title(); ?></h3>
		        <div class="post-meta-info"><?php caps_post_info(); ?></div>
		        <p><?php the_content(); ?></p>         
			  	<?php echo get_the_tag_list('<div class="tagcloud">',' ','</div>'); ?>
		    </div>

		    <?php 
		    $author_bio_in_single = ot_get_option('author_bio_in_single');
			if( $author_bio_in_single == 'on' ):
		     ?>
		    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="author-desc">
					<?php echo get_avatar( get_the_author_meta( $post->ID ), 76 ); ?>
					<div class="author-details">
					<h5><?php echo __( 'Written by ', THEMENAME ).get_the_author(); ?></h5>
					<?php echo (get_the_author_meta( 'description' )!= '')? '<p>'.get_the_author_meta( 'description' ).'</p>' : ''; ?>
					<ul class="list-inline author-social">
						<?php echo (get_the_author_meta('facebook'))? '<li><a target="_blank" title="Facebook" href="'.get_the_author_meta('facebook').'"><i class="fa fa-facebook"></i></a></li>': ''; ?>
						<?php echo (get_the_author_meta('twitter'))? '<li><a target="_blank" title="Twitter" href="'.get_the_author_meta('twitter').'"><i class="fa fa-twitter"></i></a></li>': ''; ?>
						<?php echo (get_the_author_meta('skype'))? '<li><a target="_blank" title="Skype" href="skype:'.get_the_author_meta('skype').'?call"><i class="fa fa-skype"></i></a></li>': ''; ?>
						<?php echo (get_the_author_meta('dribbble'))? '<li><a target="_blank" title="Dribbble" href="'.get_the_author_meta('dribbble').'"><i class="fa fa-dribbble"></i></a></li>': ''; ?>						
					</ul>
					</div>
				</div>
			</div>
		<?php endif; ?>

			<?php
				$socials = ot_get_option('display_social_post');
				if($socials == 'on'){
					echo '<div class="col-lg-12 col-md-12">'.caps_buttons('').'</div>';
				}
			?>

			<?php 
				$related_post = ot_get_option('related_post_in_single');
				if( $related_post == 'on' ){
					get_template_part( 'templates/related', 'posts' ); 
				}
			?> 

	  </div>
	  <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', THEMENAME ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
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