<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  $icon_array = array( 
          array(
            'value'       => 'fa-facebook',
            'label'       => 'Facebook',
            'src'         => ''
          ),
          array(
            'value'       => 'fa-flattr',
            'label'       => 'Flattr',
            'src'         => ''
          ),
          array(
            'value'       => 'fa-twitter',
            'label'       => 'Twitter',
            'src'         => ''
          ),
          array(
            'value'       => 'fa-youtube',
            'label'       => 'Youtube',
            'src'         => ''
          ),
          array(
            'value'       => 'fa-pinterest',
            'label'       => 'Pinterest',
            'src'         => ''
          ),
          array(
            'value'       => 'fa-tumblr',
            'label'       => 'Tumblr',
            'src'         => ''
          ),
          array(
            'value'       => 'fa-google-plus',
            'label'       => 'Google+',
            'src'         => ''
          ),
          array(
            'value'       => 'fa-dribbble',
            'label'       => 'Dribbble',
            'src'         => ''
          ),
          array(
            'value'       => 'fa-linkedin',
            'label'       => 'Linkedin',
            'src'         => ''
          ),
          array(
            'value'       => 'fa-skype',
            'label'       => 'Skype',
            'src'         => ''
          ),
          array(
            'value'       => 'fa-rss',
            'label'       => 'RSS',
            'src'         => ''
          ),
        );

      $share_icon_array = array( 
          array(
            'value'       => 'fa-facebook',
            'label'       => 'Facebook',
            'src'         => ''
          ),
          array(
            'value'       => 'fa-twitter',
            'label'       => 'Twitter',
            'src'         => ''
          ),
          array(
            'value'       => 'fa-digg',
            'label'       => 'Diggit',
            'src'         => ''
          ),
          array(
            'value'       => 'fa-reddit',
            'label'       => 'Reddit',
            'src'         => ''
          ),
          array(
            'value'       => 'fa-pinterest',
            'label'       => 'Pinterest',
            'src'         => ''
          ),
          array(
            'value'       => 'fa-tumblr',
            'label'       => 'Tumblr',
            'src'         => ''
          ),
          array(
            'value'       => 'fa-google-plus',
            'label'       => 'Google+',
            'src'         => ''
          ),
          array(
            'value'       => 'fa-dribbble',
            'label'       => 'Dribbble',
            'src'         => ''
          ),
          array(
            'value'       => 'fa-linkedin',
            'label'       => 'Linkedin',
            'src'         => ''
          ),
          array(
            'value'       => 'fa-stumbleupon',
            'label'       => 'Stumbleupon',
            'src'         => ''
          ),
          array(
            'value'       => 'fa-envelope',
            'label'       => 'Linkedin',
            'src'         => ''
          ),
          array(
            'value'       => 'fa-print',
            'label'       => 'Print',
            'src'         => ''
          ),
        );

        $post_icon = array();
      foreach($share_icon_array as $val){
       
        $post_icon[] = array(
                              'title' => $val['label'],
                              'display'  => 'on',
                              'icon'  => $val['value']
                              );
      }
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => 'General Options'
      ),
      array(
        'id'          => 'header_options',
        'title'       => 'Header options'
      ),
      array(
        'id'          => 'footer_options',
        'title'       => 'Footer Options'
      ),
      array(
        'id'          => 'front_options',
        'title'       => 'Slider Options'
      ),
      array(
        'id'          => 'blog_options',
        'title'       => 'Blog Options'
      ),
      array(
        'id'          => 'background_options',
        'title'       => 'Background Options'
      ),
      array(
        'id'          => 'sidebar_options',
        'title'       => 'Sidebar Options'
      ),
      array(
        'id'          => 'typography_options',
        'title'       => 'Typography Options'
      ),      
      array(
        'id'          => 'social_sharing_links',
        'title'       => 'Social Sharing Links'
      ),
      array(
        'id'          => 'styling_options',
        'title'       => 'Styling Options'
      ),
      array(
        'id'          => 'custom_css',
        'title'       => 'Custom Css'
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'custom_fabicon',
        'label'       => 'Custom Fabicon',
        'desc'        => 'you can put url of an ico image that will appear your website\'s fabicon
(16px X 16px)',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'apple_iphone_icon',
        'label'       => 'Apple iPhone Icon',
        'desc'        => 'Icon for Apple iPhone (57px X 57px)',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'apple_iphone_retina_icon',
        'label'       => 'Apple iPhone Retina Icon',
        'desc'        => 'Icon for Apple iPhone Retina (114px X 114px)',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'apple_ipad_icon',
        'label'       => 'Apple iPad Icon',
        'desc'        => 'Icon for Apple iPad (72px X 72px)',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'apple_ipad_retina_icon',
        'label'       => 'Apple iPad Retina Icon',
        'desc'        => 'Icon for Apple iPad Retina (144px X 144px)',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'admin_logo',
        'label'       => 'Admin logo',
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'top_fixed_menu',
        'label'       => 'On scrolling Fixed Menu Disable',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'operator'    => 'and'
      ),
	  
      array(
        'id'          => 'tracking_code',
        'label'       => 'Tracking Code',
        'desc'        => 'Google Analytic code goes here, this will be added into the footer template of your theme.',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'general',
        'rows'        => '3',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'allow_comments_on_pages',
        'label'       => 'Allow Comments on Pages',
        'desc'        => 'Allow comments on regular page.',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'disable_featured_image_on_pages',
        'label'       => 'Disable Featured image on pages',
        'desc'        => 'Disable featured images on regular pages',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'operator'    => 'and'
      ),
	  	  
      array(
        'id'          => 'logo',
        'label'       => 'Logo',
        'desc'        => 'Please choose an image file for your logo.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'header_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  
	  array(
        'id'          => 'top_nav_bar_disable',
        'label'       => 'Top Bar Disable',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'header_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'top_sliding_panel',
        'label'       => 'Top Bar Sliding panel',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'header_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'operator'    => 'and'
      ),	  
      array(
        'id'          => 'ad_link',
        'label'       => 'Header Ad Link',
        'desc'        => '',
        'std'         => '#',
        'type'        => 'text',
        'section'     => 'header_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'ad_image',
        'label'       => 'Header add banner',
        'desc'        => 'Leave empty to hide it',
        'std'         => get_template_directory_uri()."/images/header-ads.png",
        'type'        => 'upload',
        'section'     => 'header_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ), 
      array(
        'id'          => 'ad_script',
        'label'       => 'Header advert script',
        'desc'        => 'Leave empty to hide it',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'header_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      
      array(
        'id'          => 'breadcrumbs_menu',
        'label'       => 'Breadcrumbs Menu',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'header_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'breadcrumb_on_mobile_devices',
        'label'       => 'Breadcrumb on Mobile Devices',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'header_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'bredcrumb_menu_prefix',
        'label'       => 'Bredcrumb Menu Prefix',
        'desc'        => 'The text before the breadcrumbs menu',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'header_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'footer_logo',
        'label'       => 'Footer Logo',
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'footer_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),	  
	  array(
        'id'          => 'copyright_bar',
        'label'       => 'Copyright Bar',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'footer_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'operator'    => 'and'
      ),
	  array(
        'id'          => 'copyright_text',
        'label'       => 'Copyright Text',
        'desc'        => '',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'footer_options',
        'rows'        => '3',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_widget',
        'label'       => 'Footer Widget',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'footer_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'slider_width',
        'label'       => 'Slider Width',
        'desc'        => '',
        'std'         => 1200,
        'type'        => 'numeric-slider',
        'section'     => 'front_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '500,2000,2',
        'class'       => ''
      ),
      array(
        'id'          => 'slider_height',
        'label'       => 'Slider Height',
        'desc'        => '',
        'std'         => 626,
        'type'        => 'numeric-slider',
        'section'     => 'front_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '200,1600,2',
        'class'       => ''
      ),
      array(
        'id'          => 'slider_posts',
        'label'       => 'Display post in slider',
        'desc'        => 'You can use it using Widget or Shortcode [caps_posts_slider].',
        'std'         => 5,
        'type'        => 'numeric-slider',
        'section'     => 'front_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '1,20,1',
        'class'       => ''
      ),
      array(    
          'id'          => 'post_event',     
          'label'       => 'Events',     
          'desc'        => 'Select event to show in post slider',     
          'std'         => '',     
          'type'        => 'custom-post-type-checkbox',     
          'section'     => 'front_options',     
          'rows'        => '',     
          'post_type'   => 'event',     
          'taxonomy'    => '',     
          'min_max_step'=> '',     
          'class'       => '',    
          'condition'   => '',    
          'operator'    => 'and'    
        ),         
      array(
        'id'          => 'include_cat',
        'label'       => 'Category',
        'desc'        => 'Default all category posts show',
        'std'         => '',
        'type'        => 'category-checkbox',
        'section'     => 'front_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'category_display',
        'label'       => 'Category Display',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'front_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'post_format_display',
        'label'       => 'Post format icon Display',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'front_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'excerpt_display',
        'label'       => 'Excerpt Display',
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'front_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'excerpt_length',
        'label'       => 'Excerpt length in slider',
        'desc'        => 'Make sure "Excerpt Display" is "ON"',
        'std'         => 30,
        'type'        => 'numeric-slider',
        'section'     => 'front_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '20,200,5',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_slider',
        'label'       => 'Custom Image Slider',
        'desc'        => 'You can use it using Widget or Shortcode [caps_custom_slider].',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'front_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'image',
            'label'       => 'Image',
            'desc'        => '',
            'std'         => '',
            'type'        => 'upload',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),  
          array(
            'id'          => 'desc',
            'label'       => 'Slide description',
            'desc'        => '',
            'std'         => '',
            'type'        => 'textarea',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'button_text',
            'label'       => 'Button text',
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'button_link',
            'label'       => 'Button Link',
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      
	  array(
        'id'          => 'site_layout',
        'label'       => 'Layout',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'wide',
            'label'       => 'Wide',
            'src'         => ''
          ),
          array(
            'value'       => 'boxed',
            'label'       => 'Boxed',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'boxed_width',
        'label'       => 'Boxed container width',
        'desc'        => '',
        'std'         => array( 1080, 'px'),
        'type'        => 'measurement',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'custom_patterns_images',
        'label'       => 'Custom patterns',
        'desc'        => '',
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'pattern1',
            'label'       => 'pattern1',
            'src'         => get_template_directory_uri(). '/images/pattern/pattern1.png'
          ),
		  array(
            'value'       => 'pattern2',
            'label'       => 'pattern2',
            'src'         => get_template_directory_uri(). '/images/pattern/pattern2.png'
          ),
		  array(
            'value'       => 'pattern3',
            'label'       => 'pattern3',
            'src'         => get_template_directory_uri(). '/images/pattern/pattern3.png'
          ),
		  array(
            'value'       => 'pattern4',
            'label'       => 'pattern4',
            'src'         => get_template_directory_uri(). '/images/pattern/pattern4.png'
          ),
		  array(
            'value'       => 'pattern5',
            'label'       => 'pattern5',
            'src'         => get_template_directory_uri(). '/images/pattern/pattern5.png'
          ),
		  array(
            'value'       => 'pattern6',
            'label'       => 'pattern6',
            'src'         => get_template_directory_uri(). '/images/pattern/pattern6.png'
          ),
		  array(
            'value'       => 'pattern7',
            'label'       => 'pattern7',
            'src'         => get_template_directory_uri(). '/images/pattern/pattern7.png'
          ),
		  array(
            'value'       => 'pattern8',
            'label'       => 'pattern8',
            'src'         => get_template_directory_uri(). '/images/pattern/pattern8.png'
          ),
		  array(
            'value'       => 'pattern9',
            'label'       => 'pattern9',
            'src'         => get_template_directory_uri(). '/images/pattern/pattern9.png'
          ),
		  array(
            'value'       => '10',
            'label'       => '10',
            'src'         => get_template_directory_uri(). '/images/pattern/pattern10.png'
          )
        ),
      ),
      array(
        'id'          => 'background_image',
        'label'       => 'Background Image For Outer Areas in Boxed Mode',
        'desc'        => '',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'background_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_sidebar',
        'label'       => 'Custom Sidebar',
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'sidebar_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'id',
            'label'       => 'Widget ID',
            'desc'        => 'Sidebar id - Must be all in lowercase, with no spaces.',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),  
          array(
            'id'          => 'desc',
            'label'       => 'Widget description',
            'desc'        => 'Text description of what/where the sidebar is. Shown on widget management screen.',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      array(
        'id'          => 'body_fonts_option',
        'label'       => 'Body Fonts Option',
        'desc'        => '',
        'std'         => array(
                                'font-color' => '#808080',
                                'font-family' => 'OpenSansRegular',
                                'font-size' => '13px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '22px',
                                'text-decoration' => 'none',
                                'text-transform' => 'none',
                            ),
        'type'        => 'typography',
        'section'     => 'typography_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'topbar_fonts_option',
        'label'       => 'Topbar font Option',
        'desc'        => '',
        'std'         => array(
                                'font-color' => '#949494',
                                'font-family' => 'OpenSansRegular',
                                'font-size' => '13px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'line-height' => 'normal',
                                'letter-spacing' => '0em',
                                'text-decoration' => 'none',                               
                            ),
        'type'        => 'typography',
        'section'     => 'typography_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'menu_fonts_option',
        'label'       => 'Menu Link Option',
        'desc'        => '',
        'std'         => array(
                                'font-color' => '#373737',
                                'font-family' => 'OpenSansRegular',
                                'font-size' => '14px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'text-decoration' => 'none',
                                'text-transform' => 'uppercase',
                            ),
        'type'        => 'typography',
        'section'     => 'typography_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'submenu_fonts_option',
        'label'       => 'Sub-menu Link  Option',
        'desc'        => '',
        'std'         => array(
                                'font-color' => '#373737',
                                'font-family' => 'OpenSansRegular',
                                'font-size' => '13px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '22px',
                                'text-decoration' => 'none',
                                'text-transform' => 'none',
                            ),
        'type'        => 'typography',
        'section'     => 'typography_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_heading_font_options',
        'label'       => 'Footer Heading Font options',
        'desc'        => '',
        'std'         => array(
                                'font-color' => '#FFFFFF',
                                'font-family' => 'OpenSansRegular',
                                'font-size' => '14px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '46px',
                                'text-decoration' => 'none',
                                'text-transform' => 'uppercase',
                            ),
        'type'        => 'typography',
        'section'     => 'typography_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_font_color',
        'label'       => 'Footer Font Color',
        'desc'        => '',
        'std'         => array(
                                'font-color' => '#D1D1D1',
                                'font-family' => 'OpenSansRegular',
                                'font-size' => '13px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '22px',
                                'text-decoration' => 'none',
                                'text-transform' => 'none',
                            ),
        'type'        => 'typography',
        'section'     => 'typography_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_link_color',
        'label'       => 'Footer Link Color',
        'desc'        => '',
        'std'         => array(
                                'font-color' => '#D1D1D1',
                                'font-family' => 'OpenSansRegular',
                                'font-size' => '13px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '22px',
                                'text-decoration' => 'none',
                                'text-transform' => '',
                            ),
        'type'        => 'typography',
        'section'     => 'typography_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'heading_font_size_h1',
        'label'       => 'Heading Font Size H1',
        'desc'        => '',
        'std'         => array(
                                'font-color' => '#373737',
                                'font-family' => 'OpenSansBold',
                                'font-size' => '36px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '50px',
                                'text-decoration' => 'none',
                                'text-transform' => 'uppercase',
                            ),
        'type'        => 'typography',
        'section'     => 'typography_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'heading_font_size_h2',
        'label'       => 'Heading Font Size H2',
        'desc'        => '',
        'std'         => array(
                                'font-color' => '#373737',
                                'font-family' => 'OpenSansBold',
                                'font-size' => '24px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '40px',
                                'text-decoration' => 'none',
                                'text-transform' => 'uppercase',
                            ),
        'type'        => 'typography',
        'section'     => 'typography_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'heading_font_size_h3',
        'label'       => 'Heading Font Size H3',
        'desc'        => '',
        'std'         => array(
                                'font-color' => '#373737',
                                'font-family' => 'OpenSansSemiBold',
                                'font-size' => '18px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '30px',
                                'text-decoration' => 'none',
                                'text-transform' => 'uppercase',
                            ),
        'type'        => 'typography',
        'section'     => 'typography_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'heading_font_size_h4',
        'label'       => 'Heading Font Size H4',
        'desc'        => '',
        'std'         => array(
                                'font-color' => '#373737',
                                'font-family' => 'OpenSansSemiBold',
                                'font-size' => '16px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '24px',
                                'text-decoration' => 'none'
                            ),
        'type'        => 'typography',
        'section'     => 'typography_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'heading_font_size_h5',
        'label'       => 'Heading Font Size H5',
        'desc'        => '',
        'std'         => array(
                                'font-color' => '#373737',
                                'font-family' => 'OpenSansSemiBold',
                                'font-size' => '13px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '22px',
                                'text-decoration' => 'none',
                                'text-transform' => '',
                            ),
        'type'        => 'typography',
        'section'     => 'typography_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'heading_font_size_h6',
        'label'       => 'Heading Font Size H6',
        'desc'        => '',
        'std'         => array(
                                'font-color' => '#373737',
                                'font-family' => 'OpenSansBold',
                                'font-size' => '12px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '18px',
                                'text-decoration' => 'none',
                                'text-transform' => 'uppercase',
                            ),
        'type'        => 'typography',
        'section'     => 'typography_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'breadcrumbs_font_size',
        'label'       => 'Breadcrumbs Font Size',
        'desc'        => '',
        'std'         => array(13, 'px'),
        'type'        => 'measurement',
        'section'     => 'typography_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'page_title_font_size',
        'label'       => 'Page Title Font Size',
        'desc'        => '',
        'std'         => array(24, 'px'),
        'type'        => 'measurement',
        'section'     => 'typography_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'sidebar_widget_title_font_size',
        'label'       => 'Sidebar Widget Title Font Size',
        'desc'        => '',
        'std'         => array(14, 'px'),
        'type'        => 'measurement',
        'section'     => 'typography_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'copyright_text_font_size',
        'label'       => 'Copyright Text Font Size',
        'desc'        => '',
        'std'         => array(13, 'px'),
        'type'        => 'measurement',
        'section'     => 'typography_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'link_color',
        'label'       => 'Link Color',
        'desc'        => '',
        'std'         => '#3A3A3A',
        'type'        => 'colorpicker',
        'section'     => 'typography_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_link_hover_color',
        'label'       => 'Footer Link Hover Color',
        'desc'        => '',
        'std'         => '#FFFFFF',
        'type'        => 'colorpicker',
        'section'     => 'typography_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'blog_page_layout',
        'label'       => 'Blog page Layout',
        'desc'        => '',
        'std'         => 'rs',
        'type'        => 'radio-image',
        'section'     => 'blog_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'full',
            'label'       => 'Full width',
            'src'         => get_template_directory_uri(). '/images/layouts/full.png'
          ),
          array(
            'value'       => 'ls',
            'label'       => 'Left Sidebar',
            'src'         => get_template_directory_uri(). '/images/layouts/ls.png'
          ),
          array(
            'value'       => 'rs',
            'label'       => 'Right sidebar',
            'src'         => get_template_directory_uri(). '/images/layouts/rs.png'
          ),           
        ),
      ),      
      array(
        'id'          => 'archive_posts_display',
        'label'       => 'Blog archive posts display',
        'desc'        => '',
        'std'         => 'list',
        'type'        => 'radio-image',
        'section'     => 'blog_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'list',
            'label'       => '1',
            'src'         => get_template_directory_uri(). '/images/layouts/1.png'
          ),         
          array(
            'value'       => 'default',
            'label'       => '3',
            'src'         => get_template_directory_uri(). '/images/layouts/3.png'
          ),          
        ),
      ),      
      array(
        'id'          => 'blog_readmore_text',
        'label'       => 'Blog Read More Button Label',
        'desc'        => '',
        'std'         => 'Read more',
        'type'        => 'text',
        'section'     => 'blog_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'category_color',
        'label'       => 'Category color',
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'blog_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'category',
            'label'       => 'Category',
            'desc'        => '',
            'std'         => '',
            'type'        => 'category-select',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'category_color',
            'label'       => 'Category color',
            'desc'        => '',
            'std'         => '',
            'type'        => 'colorpicker',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      array(
        'id'          => 'sticky_text',
        'label'       => 'Sticky post text',
        'desc'        => '',
        'std'         => 'Hot',
        'type'        => 'text',
        'section'     => 'blog_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'sticky_color',
        'label'       => 'Sticky post text background color',
        'desc'        => '',
        'std'         => '#f16261',
        'type'        => 'colorpicker',
        'section'     => 'blog_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'large_excerpt_length',
        'label'       => 'Large box excerpt lenth',
        'desc'        => 'count as total word number',
        'std'         => 30,
        'type'        => 'numeric-slider',
        'section'     => 'blog_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '1,200,1',
        'class'       => ''
      ),
      array(
        'id'          => 'list_excerpt_length',
        'label'       => 'List box excerpt lenth',
        'desc'        => 'count as total word number',
        'std'         => 20,
        'type'        => 'numeric-slider',
        'section'     => 'blog_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '10,100,1',
        'class'       => ''
      ),
      array(
        'id'          => 'featured_image_on_single_post',
        'label'       => 'Featured Image on Single Post Page',
        'desc'        => 'Show featured images on single post pages.',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'blog_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'author_bio_in_single',
        'label'       => 'Author bio show in Single Post Page',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'blog_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'related_post_in_single',
        'label'       => 'Related post show in Single Post Page',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'blog_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'topbar_social_icons',
        'label'       => 'Topbar Social Icons',
        'desc'        => '',
        'std'         => array(
                            array(
                              'title' => 'Facebook',
                              'link'  => 'https://www.facebook.com/directv',
                              'icon'  => 'fa-facebook'
                              ),
                            array(
                              'title' => 'Twitter',
                              'link'  => 'http://twitter.com/directv',
                              'icon'  => 'fa-twitter'
                              ),
                            array(
                              'title' => 'Skype',
                              'link'  => 'skype:echo123?call',
                              'icon'  => 'fa-skype'
                              ),
                            array(
                              'title' => 'Youtube',
                              'link'  => 'https://www.youtube.com/',
                              'icon'  => 'fa-youtube'
                              ),
                            ),
        'type'        => 'list-item',
        'section'     => 'social_sharing_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'link',
            'label'       => 'Link',
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'icon',
            'label'       => 'Icon',
            'desc'        => '',
            'std'         => '',
            'type'        => 'select',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and',
            'choices'     => $icon_array
          )
        )
      ),
        array(
            'id'          => 'display_social_post',
            'label'       => 'Display Social Icon in single post',
            'desc'        => '',
            'std'         => 'on',
            'type'        => 'on-off',
            'rows'        => '',
            'section'     => 'social_sharing_links',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
        array(
            'id'          => 'display_social_page',
            'label'       => 'Display Social Icon in Page',
            'desc'        => '',
            'std'         => 'off',
            'type'        => 'on-off',
            'rows'        => '',
            'section'     => 'social_sharing_links',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
        array(
            'id'          => 'display_social_event',
            'label'       => 'Display Social Icon in Single Event',
            'desc'        => '',
            'std'         => 'on',
            'type'        => 'on-off',
            'rows'        => '',
            'section'     => 'social_sharing_links',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
        array(
        'id'          => 'croc_share_text',
        'label'       => 'Share text',
        'desc'        => '',
        'std'         => 'SHARE',
        'type'        => 'text',
        'section'     => 'social_sharing_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
    array(
        'id'          => 'post_share_icons',
        'label'       => 'Post Share Icons',
        'desc'        => '',
        'std'         => $post_icon,
        'type'        => 'list-item',
        'section'     => 'social_sharing_links',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'display',
            'label'       => 'Display',
            'desc'        => '',
            'std'         => 'on',
            'type'        => 'on-off',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),    
          array(
            'id'          => 'icon',
            'label'       => 'Icon',
            'desc'        => '',
            'std'         => '',
            'type'        => 'select',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and',
            'choices'     => $share_icon_array
          )      
        )
      ), 
      array(
            'id'          => 'fplb_enable',
            'label'       => 'Show like button for posts',
            'desc'        => '',
            'std'         => 'on',
            'type'        => 'on-off',
            'rows'        => '',
            'section'     => 'social_sharing_links',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),       
      array(
        'id'          => 'custom_color',
        'label'       => 'Custom Preset Color',
        'desc'        => '',
        'std'         => '#019877',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'header_top_background_color',
        'label'       => 'Header Top Background Color',
        'desc'        => '',
        'std'         => '#3A3A3A',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'header_background_color',
        'label'       => 'Header Background Color',
        'desc'        => '',
        'std'         => '#FFFFFF',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'header_border_color',
        'label'       => 'Header Border Color',
        'desc'        => '',
        'std'         => '#EAEAEA',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      
      array(
        'id'          => 'content_background_color',
        'label'       => 'Content Background Color',
        'desc'        => '',
        'std'         => '#FFFFFF',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'sidebar_background_color',
        'label'       => 'Sidebar Background Color',
        'desc'        => '',
        'std'         => '#FFFFFF',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'footer_background_color',
        'label'       => 'Footer Background Color',
        'desc'        => '',
        'std'         => '#3A3A3A',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),     
      
      array(
        'id'          => 'menu_background_color_sublevels',
        'label'       => 'Menu Background Color - Sublevels',
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'styling_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'css_code',
        'label'       => 'CSS Code',
        'desc'        => 'Any custom CSS from the user should go in this field, it will override the theme CSS',
        'std'         => '',
        'type'        => 'css',
        'section'     => 'custom_css',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
      
	  ),
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}