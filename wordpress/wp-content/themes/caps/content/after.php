   <?php
   $content = ot_get_option('archive_posts_display', 'list');
    if($content == 'default') echo '</div>';
   ?>
   </div><!--.col-lg-8-->
      <?php $page_layout = caps_get_layout(); ?>
      <?php if( $page_layout == 'rs' ): ?>
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <?php get_sidebar(); ?>
      </div><!--.col-lg-3-->
      <?php endif; ?>
    </div><!--.row-->
  </div><!--.content-->