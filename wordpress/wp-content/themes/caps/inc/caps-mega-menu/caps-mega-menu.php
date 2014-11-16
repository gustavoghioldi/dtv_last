<?php
define( 'COOL_MEGAMENU_VERSION', '1.0.1' );
define( 'COOL_MEGAMENU_RELEASE_DATE', '16th November, 2013' );
define( 'megamenupath', THEMEURI.'inc/caps-mega-menu/' );
define( 'megamenudir', THEMEDIR . 'inc/caps-mega-menu/' );
class Caps_mega_menu {

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/
	
	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {
		
		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'caps_mega_add_custom_nav_fields' ) );

		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'caps_mega_update_custom_nav_fields'), 10, 3 );
		
		
		// edit menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'caps_mega_edit_walker'), 10, 2 );
		add_action('admin_init', array( $this, 'megamenu_admin_init') );

		add_action('wp_head', array( $this, 'megamenu_footer_init') );

	} // end constructor
	


	/**
	 * Add custom fields to $item nav object
	 * in order to be used in custom Walker
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function caps_mega_add_custom_nav_fields( $menu_item ) {
	
	    $menu_item->subtitle = isset($menu_item->ID)? get_post_meta( $menu_item->ID, '_menu_item_subtitle', true ) : '';
	    $menu_item->megamenu = isset($menu_item->ID)?get_post_meta( $menu_item->ID, '_menu_item_megamenu', true ): '';
	    $menu_item->column = isset($menu_item->ID)?get_post_meta( $menu_item->ID, '_menu_item_column', true ): '';
	    //$menu_item->nav_label = get_post_meta( $menu_item->ID, '_menu_item_nav_label', true );
		$menu_item->thumb = isset($menu_item->ID)?get_post_meta( $menu_item->ID, '_menu_item_thumb', true ): '';
		$menu_item->showposts = isset($menu_item->ID)?get_post_meta( $menu_item->ID, '_menu_item_showposts', true ): 3;
		$menu_item->displaypost = isset($menu_item->ID)?get_post_meta( $menu_item->ID, '_menu_item_displaypost', true ): 'small';
	    return $menu_item;	    
	}
	
	/**
	 * Save menu custom fields
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function caps_mega_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
	
	    // Check if element is properly sent
	    if ( isset( $_REQUEST['menu-item-subtitle']) && is_array( $_REQUEST['menu-item-subtitle']) ) {
	        $subtitle_value = $_REQUEST['menu-item-subtitle'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_subtitle', $subtitle_value );
	    }
	     // Check if element is properly sent
	    if ( isset( $_REQUEST['menu-item-megamenu']) && is_array( $_REQUEST['menu-item-megamenu']) ) {
	        $megamenu_value = isset($_REQUEST['menu-item-megamenu'][$menu_item_db_id])? $_REQUEST['menu-item-megamenu'][$menu_item_db_id] : 0;
	        update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $megamenu_value );
	    }

	     // Check if element is properly sent
	    if ( isset( $_REQUEST['menu-item-column']) && is_array( $_REQUEST['menu-item-column']) ) {
	        $megamenu_value = isset($_REQUEST['menu-item-column'][$menu_item_db_id])? $_REQUEST['menu-item-column'][$menu_item_db_id] : 3;
	        update_post_meta( $menu_item_db_id, '_menu_item_column', $megamenu_value );
	    }
	    /* // Check if element is properly sent
	    if ( isset( $_REQUEST['menu-item-nav_label']) && is_array( $_REQUEST['menu-item-nav_label']) ) {
	        $megamenu_value = isset($_REQUEST['menu-item-nav_label'][$menu_item_db_id])? $_REQUEST['menu-item-nav_label'][$menu_item_db_id] : 1;
	        update_post_meta( $menu_item_db_id, '_menu_item_nav_label', $megamenu_value );
	    }*/
		 // Check if element is properly sent
	    if ( isset( $_REQUEST['menu-item-thumb']) && is_array( $_REQUEST['menu-item-thumb']) ) {
	        $thumb_value = isset($_REQUEST['menu-item-thumb'][$menu_item_db_id])? $_REQUEST['menu-item-thumb'][$menu_item_db_id] : 0;
	        update_post_meta( $menu_item_db_id, '_menu_item_thumb', $thumb_value );
	    }


	    // Check if element is properly sent
	    if ( isset( $_REQUEST['menu-item-showposts']) && is_array( $_REQUEST['menu-item-showposts']) ) {
	        $showposts = isset($_REQUEST['menu-item-showposts'][$menu_item_db_id])? $_REQUEST['menu-item-showposts'][$menu_item_db_id] : 3;
	        update_post_meta( $menu_item_db_id, '_menu_item_showposts', $showposts );
	    }
	    // Check if element is properly sent
	    if ( isset( $_REQUEST['menu-item-displaypost']) && is_array( $_REQUEST['menu-item-displaypost']) ) {
	        $displaypost = isset($_REQUEST['menu-item-displaypost'][$menu_item_db_id])? $_REQUEST['menu-item-displaypost'][$menu_item_db_id] : 'small';
	        update_post_meta( $menu_item_db_id, '_menu_item_displaypost', $displaypost );
	    }

	    
	}
	
	/**
	 * Define new Walker edit
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function caps_mega_edit_walker($walker,$menu_id) {
	
	    return 'Walker_Nav_Menu_Edit_Custom';
	    
	}

	function megamenu_admin_init() {		
		
		
		wp_register_style( 'jquery-ui-theme-css', megamenupath. '/css/jquery-ui-1.10.4.custom.css' );
		
		wp_enqueue_script( 'jquery');
		wp_enqueue_script( 'megamenu_script', megamenupath. '/js/admin-megamenu.js', array('jquery', 'jquery-ui-button', 'wp-color-picker') );
	}

	function megamenu_footer_init(){
		
			/*wp_enqueue_style( 'megamenu-css', megamenupath. '/css/megamenu.css' );
			wp_enqueue_script('jquery');			
			wp_enqueue_script( 'megamenu-js', megamenupath. '/js/megamenu.js', array('jquery') );*/
		
	}

}

// instantiate plugin's class
$GLOBALS['sweet_custom_menu'] = new Caps_mega_menu();


load_template( megamenudir . 'edit_custom_walker.php' );
load_template( megamenudir . 'custom_walker.php' );
load_template( megamenudir . 'caps-admin-menu.php' );

function caps_nav_menu( $args = array() ) {
	static $menu_id_slugs = array();
	$walker = new Caps_mega_walker();
	$defaults = array( 'menu' => '', 'container' => '', 'container_class' => '', 'container_id' => '', 'menu_class' => 'nav-menu crm-menu', 'menu_id' => '',
	'echo' => true, 'fallback_cb' => 'wp_page_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth' => 0, 'walker' => $walker, 'theme_location' => 'primary' );

	$args = wp_parse_args( $args, $defaults );
	/**
	 * Filter the arguments used to display a navigation menu.
	 *
	 * @since 3.0.0
	 *
	 * @param array $args Arguments from {@see wp_nav_menu()}.
	 */
	$args = apply_filters( 'wp_nav_menu_args', $args );
	$args = (object) $args;

	// Get the nav menu based on the requested menu
	$menu = wp_get_nav_menu_object( $args->menu );

	// Get the nav menu based on the theme_location
	if ( ! $menu && $args->theme_location && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $args->theme_location ] ) )
		$menu = wp_get_nav_menu_object( $locations[ $args->theme_location ] );

	// get the first menu that has items if we still can't find a menu
	if ( ! $menu && !$args->theme_location ) {
		$menus = wp_get_nav_menus();
		foreach ( $menus as $menu_maybe ) {
			if ( $menu_items = wp_get_nav_menu_items( $menu_maybe->term_id, array( 'update_post_term_cache' => false ) ) ) {
				$menu = $menu_maybe;
				break;
			}
		}
	}

	// If the menu exists, get its items.
	if ( $menu && ! is_wp_error($menu) && !isset($menu_items) )
		$menu_items = wp_get_nav_menu_items( $menu->term_id, array( 'update_post_term_cache' => false ) );

	/*
	 * If no menu was found:
	 *  - Fall back (if one was specified), or bail.
	 *
	 * If no menu items were found:
	 *  - Fall back, but only if no theme location was specified.
	 *  - Otherwise, bail.
	 */
	if ( ( !$menu || is_wp_error($menu) || ( isset($menu_items) && empty($menu_items) && !$args->theme_location ) )
		&& $args->fallback_cb && is_callable( $args->fallback_cb ) )
			return call_user_func( $args->fallback_cb, (array) $args );

	if ( ! $menu || is_wp_error( $menu ) )
		return false;

	$nav_menu = $items = '';

	$nav_menu .= '';

	$show_container = false;
	if ( $args->container ) {
		/**
		 * Filter the list of HTML tags that are valid for use as menu containers.
		 *
		 * @since 3.0.0
		 *
		 * @param array The acceptable HTML tags for use as menu containers, defaults as 'div' and 'nav'.
		 */
		$allowed_tags = apply_filters( 'wp_nav_menu_container_allowedtags', array( 'div', 'nav' ) );
		if ( in_array( $args->container, $allowed_tags ) ) {
			$show_container = true;
			$class = $args->container_class ? ' class="' . esc_attr( $args->container_class ) . '"' : ' class="menu-'. $menu->slug .'-container"';
			$id = $args->container_id ? ' id="' . esc_attr( $args->container_id ) . '"' : '';
			$nav_menu .= '<'. $args->container . $id . $class . '>';
		}
	}

	// Set up the $menu_item variables
	_wp_menu_item_classes_by_context( $menu_items );

	$sorted_menu_items = $menu_items_with_children = array();
	foreach ( (array) $menu_items as $menu_item ) {
		$sorted_menu_items[ $menu_item->menu_order ] = $menu_item;
		if ( $menu_item->menu_item_parent )
			$menu_items_with_children[ $menu_item->menu_item_parent ] = true;
	}

	// Add the menu-item-has-children class where applicable
	if ( $menu_items_with_children ) {
		foreach ( $sorted_menu_items as &$menu_item ) {
			if ( isset( $menu_items_with_children[ $menu_item->ID ] ) ){
				$menu_item->classes[] = 'menu-item-has-children';
				$menu_item->classes[] = 'dropdown';
			}
		}
	}

	unset( $menu_items, $menu_item );

	/**
	 * Filter the sorted list of menu item objects before generating the menu's HTML.
	 *
	 * @since 3.1.0
	 *
	 * @param array $sorted_menu_items The menu items, sorted by each menu item's menu order.
	 */
	$sorted_menu_items = apply_filters( 'wp_nav_menu_objects', $sorted_menu_items, $args );

	$items .= walk_nav_menu_tree( $sorted_menu_items, $args->depth, $args );
	unset($sorted_menu_items);

	// Attributes
	if ( ! empty( $args->menu_id ) ) {
		$wrap_id = $args->menu_id;
	} else {
		$wrap_id = 'menu-' . $menu->slug;
		while ( in_array( $wrap_id, $menu_id_slugs ) ) {
			if ( preg_match( '#-(\d+)$#', $wrap_id, $matches ) )
				$wrap_id = preg_replace('#-(\d+)$#', '-' . ++$matches[1], $wrap_id );
			else
				$wrap_id = $wrap_id . '-1';
		}
	}
	$menu_id_slugs[] = $wrap_id;

	$wrap_class = $args->menu_class ? $args->menu_class.' crm-menu' : '';

	/**
	 * Filter the HTML list content for navigation menus.
	 *
	 * @since 3.0.0
	 *
	 * @param string $items The HTML list content for the menu items.
	 * @param array $args Arguments from {@see wp_nav_menu()}.
	 */
	$items = apply_filters( 'wp_nav_menu_items', $items, $args );
	/**
	 * Filter the HTML list content for a specific navigation menu.
	 *
	 * @since 3.0.0
	 *
	 * @param string $items The HTML list content for the menu items.
	 * @param array $args Arguments from {@see wp_nav_menu()}.
	 */
	$items = apply_filters( "wp_nav_menu_{$menu->slug}_items", $items, $args );

	// Don't print any markup if there are no items at this point.
	if ( empty( $items ) )
		return false;

	$nav_menu .= sprintf( $args->items_wrap, esc_attr( $wrap_id ), esc_attr( $wrap_class ), $items );
	unset( $items );

	if ( $show_container )
		$nav_menu .= '</' . $args->container . '></nav><!-- #site-navigation -->';

	/**
	 * Filter the HTML content for navigation menus.
	 *
	 * @since 3.0.0
	 *
	 * @param string $nav_menu The HTML content for the navigation menu.
	 * @param array $args Arguments from {@see wp_nav_menu()}.
	 */
	$nav_menu = apply_filters( 'wp_nav_menu', $nav_menu, $args );

	if ( $args->echo )
		echo $nav_menu;
	else
		return $nav_menu;
}

function caps_default_main_menu(){
	$html = '';
	$html .='<ul class="nav navbar-nav" id="menu-header-menu-1">
			 <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1 current-menu-item">
			 <a href="' .home_url(). '/wp-admin/nav-menus.php" target="_blank"><span>menu settings</span></a></li>
             </ul>';
  echo $html;
 }
 
 function caps_default_footer_menu(){
	$html = '';
	$html .='<ul class="footer-nav list-inline" id="menu-footer-menu-1">
			 <li class="last">
			 <a href="' .home_url(). '/wp-admin/nav-menus.php" target="_blank">footer menu settings</a></li>
             </ul>';
  echo $html;
 }
?>