<?php
/**
 * The Header for our theme.
 *
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php caps_fabicon_ico(); ?>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
    <![endif]-->
    <script>var ajax_url = '<?php echo admin_url( 'admin-ajax.php' );?>';</script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
  <section class="header">
    <?php 
        $header_top = ot_get_option( 'top_nav_bar_disable', 'on' );
        
        if($header_top == 'on'){
          get_template_part('header/header', 'top'); 
        }      
    ?>
    <div class="main-header-part">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <h1 class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">
              <?php
                $logo_image = ot_get_option('logo');
                if($logo_image == ''){
                  echo '<span><img src="'.get_template_directory_uri().'/images/logo.png" alt="LOGO" /></span>';
                }else{
                  echo '<img src="'.$logo_image.'" alt="LOGO" />';
                }
              ?>
              </a></h1>
            
          </div>
          <?php 
            $ad_image = ot_get_option('ad_image');
          ?>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?php if($ad_image != ''){ ?><div class="header-ads"><a href="<?php echo ot_get_option('ad_link'); ?>"><img src="<?php echo $ad_image; ?>" alt="banner ads" /></a></div><?php } ?>
            <?php echo ot_get_option('ad_script', '');  ?>
          </div>

        </div>
      </div>
    </div> <!--/.main-header-part -->
    <div class="main-menu-header">
      <div class="container">
        <div class="row">
        <div class="col-lg-11 col-md-11 col-sm-10 col-xs-9">
          <div class="navbar-header">              
              <a class="toggleMenu" href="#" style="display: none; "> <i class="fa fa-list"></i></a>
           </div>
    		  <?php		  					
              $home_icon_link = '<li class="home-icon"><a href="' .get_bloginfo( 'url' ). '"><i class="fa fa-home"></i></a></li>';
        				
        			$args = array(
                            'theme_location'  => 'header',
                            'menu_class'      => 'nav navbar-nav',
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">' .$home_icon_link. '%3$s</ul>',
                            'fallback_cb'     => 'caps_default_main_menu',
                            'container'       => '',		);
                    
        			
                caps_nav_menu( $args );
            

            ?>
            </div>

            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-3 search-col">
              <form class="form-search" action="<?php echo home_url(); ?>">
                <input type="text" class="input-medium search-query" name="s" placeholder="Start typing..."><a href="#" class="search"><i class="fa fa-search"></i><i class="fa fa-times"></i></a>
              </form>
            </div>

        </div>
      </div>
    </div> <!--/.menu-header -->
  </section><!--/.navbar -->
  
  <section class="main-container">
    <div class="container">

      