<?php
add_action('admin_head-nav-menus.php', 'caps_add_metabox_menu_posttype_archive');
 
function caps_add_metabox_menu_posttype_archive() {
    add_meta_box('caps-metabox-nav-menu-latest-posts', 'Caps Latest posts', 'caps_metabox_menu_latest_posts', 'nav-menus', 'side', 'default');
}
 
function caps_metabox_menu_latest_posts() {
    //$post_types = get_post_types(array('show_in_nav_menus' => true, 'has_archive' => true), 'object');
 	
 	$categories = get_categories( );
    if ($categories) :
        $items = array();
        $loop_index = 999999;
 
        foreach ($categories as $cat) {
            $item = new stdClass();
            $loop_index++;
 
            $item->object_id = $loop_index;
            $item->db_id = 0;
            $item->object = 'post_cat_' . $cat->term_id;
            $item->menu_item_parent = 0;
            $item->type = 'custom';
            $item->title = 'Latest posts of '.$cat->name;
            $item->url = get_category_link( $cat->term_id );
            $item->target = '';
            $item->attr_title = '';
            $item->classes = array($cat->slug, 'cat-posts');
            $item->xfn = '';
            

            $items[] = $item;
        }
 
        $walker = new Walker_Nav_Menu_Checklist(array());
 
        echo '<div id="posttype-archive" class="posttypediv">';
        echo '<div id="tabs-panel-posttype-archive" class="tabs-panel tabs-panel-active">';
        echo '<ul id="posttype-archive-checklist" class="categorychecklist form-no-clear">';
        echo walk_nav_menu_tree(array_map('wp_setup_nav_menu_item', $items), 0, (object) array('walker' => $walker));
        echo '</ul>';
        echo '</div>';
        echo '</div>';
 
        echo '<p class="button-controls">';
        echo '<span class="add-to-menu">';
        echo '<input type="submit"' . disabled(1, 0) . ' class="button-secondary submit-add-to-menu right" value="' . __('Add to Menu', 'andromedamedia') . '" name="add-posttype-archive-menu-item" id="submit-posttype-archive" />';
        echo '<span class="spinner"></span>';
        echo '</span>';
        echo '</p>';
 
    endif;
}