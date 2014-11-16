<!-- Panel -->
    <div id="panel" class="container">
        
        <div class="row">

          
              <div class="col-lg-offset-5 col-md-offset-5 col-lg-7 col-md-7 col-xs-12 col-sm-12">
                <div class="content clearfix">
                                     
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">                          
                          <?php if ( is_active_sidebar( 'top-panel' ) ) : ?>
                            <?php dynamic_sidebar( 'top-panel' ); ?>
                          <?php else: ?>   
                            <?php echo 'Topbar widget area empty.'; ?>
                          <?php endif; ?>                          
                        </div>
                        
                    </div>       
                
        		</div> <!-- /login -->
        	</div>
       
    </div>
<!--END panel -->