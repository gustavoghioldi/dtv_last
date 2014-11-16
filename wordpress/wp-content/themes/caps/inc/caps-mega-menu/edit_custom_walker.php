<?php
/**
 *  /!\ This is a copy of Walker_Nav_Menu_Edit class in core
 * 
 * Create HTML list of nav menu input items.
 *
 * @package themecap
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu  {
	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker_Nav_Menu::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker_Nav_Menu::end_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {}
	
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param object $args
	 */
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
	    global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = get_the_title( $original_object->ID );
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( __( '%s (Invalid)', THEMENAME ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( __( '%s (Pending)', THEMENAME ), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

		$submenu_text = '';
		if ( 0 == $depth )
			$submenu_text = 'style="display: none;"';


		wp_enqueue_style( 'jquery-ui-theme-css');

		?>
		<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
					<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php _e( 'sub item', THEMENAME ); ?></span></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', THEMENAME); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', THEMENAME); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item', THEMENAME); ?>" href="<?php
							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>"><?php _e( 'Edit Menu Item', THEMENAME ); ?></a>
					</span>
				</dt>
			</dl>

			<div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
				<?php if( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo $item_id; ?>">
							<?php _e( 'URL', THEMENAME ); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-thin">
					<label for="edit-menu-item-title-<?php echo $item_id; ?>">
						<?php _e( 'Navigation Label', THEMENAME ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="description description-thin">
					<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
						<?php _e( 'Title Attribute', THEMENAME ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo $item_id; ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php _e( 'Open link in a new window/tab', THEMENAME ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo $item_id; ?>">
						<?php _e( 'CSS Classes (optional)', THEMENAME ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
						<?php _e( 'Link Relationship (XFN)', THEMENAME ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>      
				
	            <p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo $item_id; ?>">
						<?php _e( 'Description', THEMENAME ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.', THEMENAME ); ?></span>
					</label>
				</p>
				<?php
	            /* New fields insertion starts here */
	            if(in_array('cat-posts', $item->classes)):
	           	?>
	            <p class="description description-thin">
					<label for="edit-menu-item-showposts-<?php echo $item_id; ?>">
						<?php _e( 'Show posts(<samll>In Number e.g. 3</small>)', THEMENAME ); ?><br />
						<input type="text" id="edit-menu-item-showposts-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-showposts[<?php echo $item_id; ?>]" value="<?php echo ($item->showposts  != '')? $item->showposts : 3 ; ?>" />
					</label>
				</p>
				<p class="description description-thin">
					<label for="edit-menu-item-displaypost-<?php echo $item_id; ?>">
						<?php _e( 'Display posts', THEMENAME ); ?><br />
						<select id="edit-menu-item-displaypost-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-displaypost[<?php echo $item_id; ?>]">
							<option<?php echo (esc_attr( $item->displaypost ) != 'large')? ' selected="selected"' : ''; ?> value="small">Small thumnail</option>
							<option<?php echo (esc_attr( $item->displaypost ) == 'large')? ' selected="selected"' : ''; ?> value="large">Large thumnail</option>
						</select>
					</label>
				</p>
				<?php endif; ?>
	             	               
	            
	            <script>
				
					jQuery(function($) {						
						
						
						$( "#radio<?php echo $item_id; ?>, #column<?php echo $item_id; ?>, #thumb<?php echo $item_id; ?>, #nav_label<?php echo $item_id; ?>" ).buttonset({
								create: function( event, ui ) {
						    		event.preventDefault();
								}
								});
						return false;
					});
				</script>
				<style type="text/css">
						input[type="radio"].ui-helper-hidden-accessible{
							visibility: hidden;
							top: 0;
							left: 0;
						}
				</style>
				
			<p class="field-description description description-wide"><strong>Megamenu Settings</strong></p>
				<p class="field-custom description description-wide">
	                <label for="edit-menu-item-subtitle-<?php echo $item_id; ?>">
	                    <?php _e( 'Subtitle', THEMENAME ); ?><br />
	                    <input type="text" id="edit-menu-item-subtitle-<?php echo $item_id; ?>" class="widefat code edit-menu-item-custom" name="menu-item-subtitle[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->subtitle ); ?>" />
	                </label>
	            </p>
				<div class="type-radio" style="width: 100%; overflow: hidden; position: relative;"> 
	            <?php if($depth == 0): ?>
	            <p class="field-custom description description-wide  type-radio">
	                <label for="radio<?php echo $item_id; ?>">
	                    <?php _e( 'Megamenu', THEMENAME ); ?><br />
	                    
						 
	                     <div id="radio<?php echo $item_id; ?>" class=" description-wide">
							<input type="radio" id="radio0<?php echo $item_id; ?>" name="menu-item-megamenu[<?php echo $item_id; ?>]" value="0"  <?php echo (($item->megamenu == 0) || !isset($item->megamenu))? 'checked="checked"': ''; ?> /><label for="radio0<?php echo $item_id; ?>">Off</label>
							<input type="radio" id="radio1<?php echo $item_id; ?>" name="menu-item-megamenu[<?php echo $item_id; ?>]" value="1"  <?php echo ($item->megamenu == 1)? 'checked="checked"': ''; ?> /><label for="radio1<?php echo $item_id; ?>">On</label>
							
						</div>
						</label>
						</p>
						<p class="field-custom description description-wide  type-radio">
						<label for="column<?php echo $item_id; ?>">
						<?php _e( 'Megamenu column', THEMENAME ); ?><br />		</label>					

						<div id="column<?php echo $item_id; ?>" class=" description-wide">
							<input type="radio" id="column1<?php echo $item_id; ?>" name="menu-item-column[<?php echo $item_id; ?>]" value="1"  <?php echo (($item->column == 1) || !isset($item->column))? 'checked="checked"': ''; ?> /><label for="column1<?php echo $item_id; ?>">Column1</label>
							<input type="radio" id="column2<?php echo $item_id; ?>" name="menu-item-column[<?php echo $item_id; ?>]" value="2"  <?php echo (($item->column == 2))? 'checked="checked"': ''; ?> /><label for="column2<?php echo $item_id; ?>">Column2</label>
							<input type="radio" id="column3<?php echo $item_id; ?>" name="menu-item-column[<?php echo $item_id; ?>]" value="3"  <?php echo (($item->column == 3) )? 'checked="checked"': ''; ?> /><label for="column3<?php echo $item_id; ?>">Column3</label>
							<input type="radio" id="column4<?php echo $item_id; ?>" name="menu-item-column[<?php echo $item_id; ?>]" value="4"  <?php echo (($item->column == 4) )? 'checked="checked"': ''; ?> /><label for="column4<?php echo $item_id; ?>">Column4</label>
                            							
						</div>

	                                
						
	            </p>
	        
	        <?php else: ?>
	            <p class="field-custom type-radio description description-wide">
						<label for="thumb<?php echo $item_id; ?>">
						<?php _e( 'Thumbnail Image', THEMENAME ); ?><br /></label>					

						<div id="thumb<?php echo $item_id; ?>" class=" description-wide">
							<input type="radio" id="thumb1<?php echo $item_id; ?>" name="menu-item-thumb[<?php echo $item_id; ?>]" value="1"  <?php echo (($item->thumb == 1) )? 'checked="checked"': ''; ?> /><label for="thumb1<?php echo $item_id; ?>">Show</label>
							<input type="radio" id="thumb0<?php echo $item_id; ?>" name="menu-item-thumb[<?php echo $item_id; ?>]" value="0"  <?php echo (($item->thumb == 0) || !isset($item->thumb))? 'checked="checked"': ''; ?> /><label for="thumb0<?php echo $item_id; ?>">Hide</label>		
						</div>       
						
	            </p>
	        <?php endif; ?>
	        <p class="field-description description description-wide"><small>----------------------------End Megamenu Settings---------------------------</small></p>
	        </div>
	            <?php
	            /* New fields insertion ends here */
	            ?>
	          <?php //endif; ?>
				<p class="field-move hide-if-no-js description description-wide">
					<label>
						<span><?php _e( 'Move', THEMENAME ); ?></span>
						<a href="#" class="menus-move-up"><?php _e( 'Up one', THEMENAME ); ?></a>
						<a href="#" class="menus-move-down"><?php _e( 'Down one', THEMENAME ); ?></a>
						<a href="#" class="menus-move-left"></a>
						<a href="#" class="menus-move-right"></a>
						<a href="#" class="menus-move-top"><?php _e( 'To the top', THEMENAME ); ?></a>
					</label>
				</p>

				<div class="menu-item-actions description-wide submitbox">
					<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( __( 'Original: %s', THEMENAME ), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
					echo wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'delete-menu-item',
								'menu-item' => $item_id,
							),
							admin_url( 'nav-menus.php' )
						),
						'delete-menu_item_' . $item_id
					); ?>"><?php _e( 'Remove', THEMENAME ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
						?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel', THEMENAME ); ?></a>
				</div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}


	function wp_get_nav_menu_items( $menu, $args = array() ) {
	$menu = wp_get_nav_menu_object( $menu );

	if ( ! $menu )
		return false;

	static $fetched = array();

	$items = get_objects_in_term( $menu->term_id, 'nav_menu' );

	if ( empty( $items ) )
		return $items;

	$defaults = array( 'order' => 'ASC', 'orderby' => 'menu_order', 'post_type' => 'nav_menu_item',
		'post_status' => 'publish', 'output' => ARRAY_A, 'output_key' => 'menu_order', 'nopaging' => true );
	$args = wp_parse_args( $args, $defaults );
	if ( count( $items ) > 1 )
		$args['include'] = implode( ',', $items );
	else
		$args['include'] = $items[0];

	$items = get_posts( $args );

	if ( is_wp_error( $items ) || ! is_array( $items ) )
		return false;

	// Get all posts and terms at once to prime the caches
	if ( empty( $fetched[$menu->term_id] ) || wp_using_ext_object_cache() ) {
		$fetched[$menu->term_id] = true;
		$posts = array();
		$terms = array();
		foreach ( $items as $item ) {
			$object_id = get_post_meta( $item->ID, '_menu_item_object_id', true );
			$object    = get_post_meta( $item->ID, '_menu_item_object',    true );
			$type      = get_post_meta( $item->ID, '_menu_item_type',      true );

			if ( 'post_type' == $type )
				$posts[$object][] = $object_id;
			elseif ( 'taxonomy' == $type)
				$terms[$object][] = $object_id;
		}

		if ( ! empty( $posts ) ) {
			foreach ( array_keys($posts) as $post_type ) {
				get_posts( array('post__in' => $posts[$post_type], 'post_type' => $post_type, 'nopaging' => true, 'update_post_term_cache' => false) );
			}
		}
		unset($posts);

		if ( ! empty( $terms ) ) {
			foreach ( array_keys($terms) as $taxonomy ) {
				get_terms($taxonomy, array('include' => $terms[$taxonomy]) );
			}
		}
		unset($terms);
	}

	$items = array_map( 'wp_setup_nav_menu_item', $items );

	if ( ! is_admin() ) // Remove invalid items only in frontend
		$items = array_filter( $items, '_is_valid_nav_menu_item' );

	if ( ARRAY_A == $args['output'] ) {
		$GLOBALS['_menu_item_sort_prop'] = $args['output_key'];
		usort($items, '_sort_nav_menu_items');
		$i = 1;
		foreach( $items as $k => $item ) {
			$items[$k]->$args['output_key'] = $i++;
		}
	}

	return apply_filters( 'wp_get_nav_menu_items',  $items, $menu, $args );
}

} // Walker_Nav_Menu_Edit