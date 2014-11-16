<?php while ( have_posts() ) : the_post(); ?>
  <div class="content">
      <div class="row">       
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

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
                echo caps_buttons('');
              }
            ?>
            <?php $allow_comments_on_pages = ot_get_option( 'allow_comments_on_pages' ); ?>
            <?php if( $allow_comments_on_pages == 'on' ): ?>
              <?php comments_template( '', true ); ?>
            <?php endif; ?>
          
        </div><!--.col-lg-8-->
       
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
          <?php get_sidebar( 'page' ); ?>
        </div><!--.col-lg-4-->      
      </div><!--.row-->    
  </div>
<?php endwhile; ?>    
