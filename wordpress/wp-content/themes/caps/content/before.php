<div class="content">
    <div class="row">
      <?php $page_layout = caps_get_layout(); ?>
      <?php if( $page_layout == 'ls' ): ?>
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <?php get_sidebar(); ?>
      </div><!--.col-lcol-xs-12 col-sm-12 col-md-3 g-3-->
      <?php endif; ?>
      
      <?php $class = ( $page_layout == 'full' )? ' col-md-12 col-lg-12' : ' col-md-8 col-lg-8';  ?>
      <div class="col-xs-12 col-sm-12<?php echo $class; ?>">
      	<?php 
      		$breadcrumbs = ot_get_option( 'breadcrumbs_menu', 'on' );
          if(!is_home() && !is_front_page() && ($breadcrumbs == 'on')){
      			caps_breadcrumbs();
      		}

          $content = ot_get_option('archive_posts_display', 'list');
          if($content == 'default') echo '<div class="row">';
        ?>
        
     
       