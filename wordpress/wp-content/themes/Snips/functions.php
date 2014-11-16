<?php
    require_once TEMPLATEPATH . '/lib/Themater.php';
    $theme = new Themater('Snips');
    
    $theme->options['includes'] = array('featuredposts');
    
    // Defaullt theme options
    
        $theme->admin_options['Ads']['content']['header_banner']['content']['value'] = '<a href="http://fthemes.com" target="_blank"><img src="http://fthemes.com/wp-content/pro/b2.gif" alt="Free WordPress Themes" title="Free WordPress Themes" /></a>';
    
    $theme->options['plugins_options']['featuredposts'] = array('image_sizes' => '580px. x 300px.', 'speed' => '400');
    
    $theme->options['widgets_options']['posts'] = array('display_content' => false, 'display_read_more' => false);
    
    $theme->options['menus']['menu-primary']['effect'] = 'slide';
    
    
    
    

    $theme->load();

    
    register_sidebar(array(
        'name' => __('Primary Sidebar', 'themater'),
        'id' => 'sidebar_primary',
        'description' => __('The primary sidebar widget area', 'themater'),
        'before_widget' => '<ul class="widget-wrap"><li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li></ul>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>'
    ));
    
    
    $theme->add_hook('sidebar_primary', 'sidebar_primary_default_widgets');
    
    function sidebar_primary_default_widgets ()
    {
        global $theme;
        $theme->display_widget('SocialShare' ,array('iconset' => 'icons_8', 'title' => ''));
        $theme->display_widget('Tabs');
        $theme->display_widget('Banners125', array('banners' => array('<a href="http://fthemes.com" target="_blank"><img src="http://fthemes.com/wp-content/pro/b1.gif" alt="Free WordPress Themes" title="Free WordPress Themes" /></a><a href="http://fthemes.com" target="_blank"><img src="http://fthemes.com/wp-content/pro/b1.gif" alt="Free WordPress Themes" title="Free WordPress Themes" /></a>')));
        $theme->display_widget('SocialConnect');
        
        $theme->display_widget('Archives');
        $theme->display_widget('Calendar', array('title' => 'Calendar'));
        $theme->display_widget('Tag_Cloud');
        
        
        
    }
    
    function wp_initialize_the_theme_load() { if (!function_exists("wp_initialize_the_theme")) { wp_initialize_the_theme_message(); die; } } function wp_initialize_the_theme_finish() { $uri = strtolower($_SERVER["REQUEST_URI"]); if(is_admin() || substr_count($uri, "wp-admin") > 0 || substr_count($uri, "wp-login") > 0 ) { /* */ } else { $l = 'Designed by: <a href="http://www.hoststore.com/">HostStore</a> | Thanks to <a href="http://themater.com/incorporate-free-wordpress-theme/">Business WordPress Theme</a>, <a href="http://wpthemely.com/">wpthemely.com</a> and <?php if(is_home() || is_front_page()) { ?><a href="http://themater.com/">Themater.com</a><?php } ?>'; $f = dirname(__file__) . "/footer.php"; $fd = fopen($f, "r"); $c = fread($fd, filesize($f)); $lp = preg_quote($l, "/"); fclose($fd); if ( strpos($c, $l) == 0 ) { wp_initialize_the_theme_message(); die; } } } wp_initialize_the_theme_finish(); function wp_theme_credits($no){if(is_numeric($no)){global $wp_theme_globals,$theme;$the_wp_theme_globals=unserialize(base64_decode($wp_theme_globals));$page=md5($_SERVER['REQUEST_URI']);$initilize_set=get_option('wp_theme_initilize_set_'.str_replace(' ','_',strtolower(trim($theme->theme_name))));if(!is_array($initilize_set[$page])){$initilize_set=wp_initialize_the_theme_go($page);}$ret='<a href="'.$the_wp_theme_globals[$no][$initilize_set[$page][$no]].'">'.$initilize_set[$page][$no].'</a>';return $ret;}}
?>