<?php
/**
 * The template for displaying an event-category page
 *
 ***************** NOTICE: *****************
 *  Do not make changes to this file. Any changes made to this file
 * will be overwritten if the plug-in is updated.
 *
 * To overwrite this template with your own, make a copy of it (with the same name)
 * in your theme directory. See http://docs.wp-event-organiser.com/theme-integration for more information
 *
 * WordPress will automatically prioritise the template in your theme directory.
 ***************** NOTICE: *****************
 *
 * @package Event Organiser (plug-in)
 * @since 1.0.0
 */

//Call the template header
get_header(); ?>

	<?php get_template_part( 'content/before' ); ?>
		<?php if ( have_posts() ) : ?>
			<h1 class="page-title"><?php
				printf( __( 'Event Category Archives: %s', 'eventorganiser' ), '<span>' . single_cat_title( '', false ) . '</span>' );
			?></h1>

			<?php
				$category_description = category_description();
				if ( ! empty( $category_description ) )
					echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
			?>

			<?php while ( have_posts() ) : the_post(); ?>
							
				<div id="post-<?php the_ID(); ?>" <?php post_class( 'post-blog post' ); ?> >
				  <div class="row">					    
				    <?php 
			         if ( has_post_thumbnail() ) : 
			         	$fullsize = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
			        ?>
			        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			        	<div class="single-content-image">
			        		<a href="<?php the_permalink(); ?>">         
			        		<img src="<?php echo caps_image_resize( $fullsize[0], 335, 200, true, 'c', false ) ?>" alt="<?php the_title(); ?>">					            
			        		</a>
			          	</div>
			    	</div>
			        <?php endif; ?>
				    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>					        
				        <!-- Output the date of the occurrence-->
						<?php							
	 					if( eo_is_all_day() ){
							$format = 'd F Y';
							$microformat = 'Y-m-d';
						}else{
							$format = 'd F Y '.get_option('time_format');
							$microformat = 'c';
						}?>
						<div class="post-meta-info" itemprop="startDate" datetime="<?php eo_the_start($microformat); ?>"><p><span class="date-meta"><?php eo_the_start($format); ?></span></p></div>
				
						<?php echo eo_get_event_meta_list(); ?>							
				       	<?php $blog_readmore_text = ot_get_option( 'blog_readmore_text', 'more' ); ?>
    					<a href="<?php the_permalink(); ?>" class="read-more-post"><?php echo $blog_readmore_text; ?></a>
				    </div>
				</div>
				</div>
				<?php endwhile; ?><!--The Loop ends-->			

			<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>
	<?php if( function_exists( 'bapz_numeric_posts_nav' ) ) { bapz_numeric_posts_nav(); } ?>
  <?php get_template_part( 'content/after' ); ?>

<?php get_footer(); ?>
