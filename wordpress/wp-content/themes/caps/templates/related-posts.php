<?php    
    $terms =  array();
    $postid = get_the_ID();
	$terms = wp_get_post_terms( $postid, 'post_tag' , array("fields" => "slugs") );

	if(!empty($terms)): ?>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
		<h3 class="title"><span><?php echo __( 'Related Articles', 'bapz' ); ?></span></h3> 
    	<div class="related-posts row">
                               
        
			<?php
			
	       
	        $sticky = get_option( 'sticky_posts' );
	        $sticky[] = $postid;
	        
			$args = array(
	        'post__not_in' => $sticky,
	        'posts_per_page' => 3,
	        'tax_query' => array(
	            array(
	                'taxonomy' => 'post_tag',
	                'field' => 'slug',
	                'terms' => $terms
	            ))
	        );
	        $query = new WP_Query( $args ); 

	        if ( $query->have_posts() ):
	        	       
			while ( $query->have_posts() ) :$query->the_post();
				
				 ?>
	        
	        	<div id="su-post-<?php the_ID(); ?>" class="related-post col-lg-4 col-md-4 col-sm-4">
			<?php 
				if ( has_post_thumbnail() ) : 
					$fullsize = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 						
			 	endif; 
			  ?>
					<div class="single-content-image">
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>" class="image-wrap">
								<img class="lazy" src="<?php echo caps_image_resize( $fullsize[0], 400, 300, true, 'c', false ) ?>" alt="<?php the_title(); ?>">
								<?php caps_post_format_icon(); ?>
							</a>
						<?php endif; ?>						
						<h5><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h5>
						<?php echo get_caps_post_info($post->ID); ?>
					</div>				
				</div>            
	        <?php
			endwhile;
			endif;
	       
		
		wp_reset_postdata();
	  ?>
  </div>
</div>
<?php endif; ?>