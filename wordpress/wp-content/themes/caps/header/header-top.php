<div class="top-nav-background">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="latest-title"><span><i class="genericon genericon-time"></i></span>
                <ul id="js-news">
                    <?php
                        // WP_Query arguments
                        $args = array (
                          'post_type'              => 'post',
                          'pagination'             => false,
                          'posts_per_page'         => get_option( 'posts_per_page' ),
                          'ignore_sticky_posts'    => true,
                        );

                        // The Query
                        $query = new WP_Query( $args );

                        // The Loop
                        if ( $query->have_posts() ) {
                          while ( $query->have_posts() ) {
                            $query->the_post();
                             echo '<li class="news-item"><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
                          }
                        }

                        // Restore original Post Data
                        wp_reset_postdata();
                    ?>            
                    
                    
                </ul>
               
            </div>
          </div> 
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?php 
              $top_sliding_panel = ot_get_option('top_sliding_panel', 'on');
              if($top_sliding_panel == 'on'){
            ?>
            <div id="toggle" class="right-menu">
            		<a id="open" class="open" href="#"><i class="genericon genericon-menu"></i></a>
                <a id="close" style="display: none;" class="close" href="#"><i class="genericon genericon-close-alt"></i></a>
             </div>
             <?php } ?>

              <?php 
                $topbar_social_icons = ot_get_option('topbar_social_icons', array());
                if(!empty($topbar_social_icons)):
              ?>
              <ul class="list-inline social-icons">
                <?php
                  foreach ($topbar_social_icons as $social) {
                     echo '<li><a target="_blank" title="'.$social['title'].'" href="'.$social['link'].'"><i class="fa '.$social['icon'].'"></i></a></li>';
                  }
                ?>
              	           
              </ul>
              <?php endif; ?>              
          </div>
          <?php get_template_part('header/sliding', 'panel'); ?>
        </div> 
      </div>
    </div> <!--/.top-nav-background -->