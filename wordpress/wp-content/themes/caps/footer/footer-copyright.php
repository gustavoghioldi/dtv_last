<section class="footer-copyright">
  <div class="container">
    <div class="row">
      <div class="copyright-bar">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <?php $copyright_bar = ot_get_option( 'copyright_bar' );
            if( $copyright_bar != 'disable' ): ?>
          <h6 class="copyright"><?php $copyright_text = ot_get_option( 'copyright_text' ); echo ($copyright_text != '')? $copyright_text : 'Copyright &copy; 2014 ipsum erroribus is a design vituperata.'; ?></h6>
          <?php endif; ?>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <?php 
            $args = array(
                'theme_location'  => 'footer',
                'menu_class'      => 'footer-nav list-inline',
                'fallback_cb'     => 'caps_default_footer_menu'
            );
            wp_nav_menu( $args );
            ?>
        </div><!--.col-lg-6-->
      </div><!--.copyright-bar-->
    </div>
  </div><!--.container-->
</section><!--.footer-copyright-->