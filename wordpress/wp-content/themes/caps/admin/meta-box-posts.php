<?php
add_action( 'admin_init', 'bapz_custom_meta_boxes_for_post_video' );
add_action( 'admin_init', 'bapz_custom_meta_boxes_for_page_slider' );


/*Initialize the meta boxes for video.*/
function bapz_custom_meta_boxes_for_post_video() {

  $post_video = array(
    'id'        => 'posts_video',
    'title'     => 'Video',
    'desc'      => '',
    'pages'     => array( 'post' ),
    'context'   => 'side',
    'priority'  => 'low',
    'fields'    => array(      
      array(
        'id'          => 'post_video_url_id_youtube',
        'label'       => 'Youtube Video URL ID',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        'choices'     => array()
      ),
	  array(
        'id'          => 'post_video_url_id_vimeo',
        'label'       => 'Vimeo Video URL ID',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'class'       => '',
        'choices'     => array()
      )
    )
  );
  
 // ot_register_meta_box( $post_video );

  $widgets = ot_get_option( 'custom_sidebar', array() );  
  $choices = array(
             array(
                'value'       => 'sidebar-1',
                'label'       => 'Main Sidebar',
                'src'         => ''
              ), 
             array(
                'value'       => 'sidebar-front',
                'label'       => 'Front page Sidebar',
                'src'         => ''
              ), 
          );
  if(!empty($widgets)){    
    $arr = array();
    foreach( $widgets as $widget ){
      $id = ( $widget['id'] != '' )? $widget['id'] : sanitize_title('', '-', $widget['title']);
      $arr['value'] = $id;
      $arr['label'] = $widget['title'];
      $arr['src'] = '';
      $choices[] = $arr;
    }
  }
  $sidebar = array(
    'id'        => 'posts_sidebar',
    'title'     => 'Sidebar',
    'desc'      => 'You can create more sidebar in <a href="'.get_bloginfo('url').'/wp-admin/themes.php?page=ot-theme-options#section_sidebar_options">Theme option</a>',
    'pages'     => array( 'page' ),
    'context'   => 'side',
    'priority'  => 'low',
    'fields'    => array(      
      array(
        'id'          => 'custom_sidebar',
        'label'       => 'Select sidebar',
        'desc'        => '',
        'std'         => 'sidebar-1',
        'type'        => 'select',
        'class'       => '',
        'choices'     => $choices
      ),
    
    )
  );
  
  ot_register_meta_box( $sidebar );

  $post_layout = array(
    'id'        => 'page_slider',
    'title'     => 'Bapz post layout',
    'desc'      => '',
    'pages'     => array( 'post' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(      
      array(
        'id'          => 'page_layout',
        'label'       => 'Select Layout',
        'desc'        => '',
        'std'         => 'rs',
        'type'        => 'radio-image',
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
    )
  );

  ot_register_meta_box( $post_layout );

}

/*Initialize the meta boxes for slider shortcode.*/
function bapz_custom_meta_boxes_for_page_slider() {

  $page_slider = array(
    'id'        => 'page_slider',
    'title'     => 'Bapz Page Options',
    'desc'      => '',
    'pages'     => array( 'page' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
      array(
        'id'          => 'page_title_display',
        'label'       => 'Title Display',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'select',
        'choices'     => array(
          array(
            'value'       => 'on',
            'label'       => 'On',
            'src'         => ''
          ),
          array(
            'value'       => 'off',
            'label'       => 'Off',
            'src'         => ''
          )),
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'alt_title',
        'label'       => 'Alternative page title',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        'choices'     => array()
      ),
      array(
        'id'          => 'page_layout',
        'label'       => 'Page Layout',
        'desc'        => '',
        'std'         => 'rs',
        'type'        => 'radio-image',
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
    )
  );
  
  ot_register_meta_box( $page_slider );

}


?>