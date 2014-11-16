<?php global $theme; ?>

    <div id="footer-wrap" class="span-24">
        
        <div id="footer">
        
            <div id="copyrights">
                <?php
                    if($theme->display('footer_custom_text')) {
                        $theme->option('footer_custom_text');
                    } else { 
                        ?> &copy; <?php echo date('Y'); ?>  <a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a>. <?php _e('All Rights Reserved.', 'themater');
                    }
                ?> 
            </div>
            
            <?php /* 
                    All links in the footer should remain intact. 
                    These links are all family friendly and will not hurt your site in any way. 
                    Warning! Your site may stop working if these links are edited or deleted 
                    
                    You can buy this theme without footer links online at http://themater.com/buy/?theme=snips 
                */ ?>
            
            <div id="credits">Powered by <a href="http://wordpress.org/"><strong>WordPress</strong></a> | Designed by: <a href="http://www.hoststore.com/">HostStore</a> | Thanks to <a href="http://themater.com/incorporate-free-wordpress-theme/">Business WordPress Theme</a>, <a href="http://wpthemely.com/">wpthemely.com</a> and <?php if(is_home() || is_front_page()) { ?><a href="http://themater.com/">Themater.com</a><?php } ?></div><!-- #credits -->
            
        </div><!-- #footer -->
        
    </div><!-- #wrap-footer -->

</div><!-- #container -->

</div><!-- #wrapper -->

<?php wp_footer(); ?>
<?php $theme->hook('html_after'); ?>
</body>
</html>