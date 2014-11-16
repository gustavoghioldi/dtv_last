  <?php while ( have_posts() ) : the_post(); ?>
    <div class="content">
      <?php 
          $breadcrumbs = ot_get_option( 'breadcrumbs_menu', 'on' );
            if(!is_home() && !is_front_page() && ($breadcrumbs == 'on')){
            caps_breadcrumbs();
          }
        ?>

      <?php $disable_featured_image = ot_get_option( 'disable_featured_image_on_pages' ); ?>
      <?php if( ($disable_featured_image == 'on') && (has_post_thumbnail()) && (! post_password_required()) ): ?>
      	<div class="page-featured-image">
			       <?php the_post_thumbnail( 'blog-thumbnails' ); ?>
    	   </div>
          <?php endif; ?>
          
            <?php if(get_post_meta( $post->ID, 'page_title_display', true ) == 'on'): ?>
            <h2 class="page-title"><?php echo (get_post_meta( $post->ID, 'alt_title', true ) != '')? get_post_meta( $post->ID, 'alt_title', true ) :the_title(); ?></h2>
            <?php endif; ?>

          <?php the_content(); ?>
          <?php edit_post_link( __( 'Edit', THEMENAME ), '<span class="edit-link">', '</span>' ); ?>
          <?php
            $socials = ot_get_option('display_social_page');
            if($socials == 'on'){
              echo '<div class="col-lg-12 col-md-12">'.caps_buttons('').'</div>';
            }
          ?>

      <?php $allow_comments_on_pages = ot_get_option( 'allow_comments_on_pages' ); ?>
		  <?php if( $allow_comments_on_pages == 'on' ): ?>
      <div class="col-lg-12"><?php comments_template( '', true ); ?></div>
        <?php endif; ?> 
    </div>
<?php endwhile; // end of the loop. ?>