<?php 
/*
List of available filters in WP Review plugin.
You can use these filterns in your theme in funtions.php file
and set different default settings.
*/

// Set default colors for new reviews
function new_default_review_colors($colors) {
    $colors = array(
        'color' => ot_get_option( 'custom_color', '#019877' ),
        'fontcolor' => '#373737',
        'bgcolor1' => '#fafafa',
        'bgcolor2' => '#fafafa',
        'bordercolor' => '#ffffff'
    );
  return $colors;
}
add_filter( 'caps_review_default_colors', 'new_default_review_colors' );

// Set colors for ALL displayed reviews
function mts_new_review_colors($colors, $id) {
  $colors['bgcolor1'] = '#ff0000';
  return $colors;
}
add_filter( 'caps_review_colors', 'mts_new_review_colors', 10, 2 );
 
// Set location for ALL displayed reviews
function mts_new_review_location($position, $id) {
  $position = 'bottom';
  return $position;
}
add_filter( 'caps_review_location', 'mts_new_review_location', 10, 2 );
 
// Set default location for new reviews
function mts_new_default_review_location($position) {
  $position = 'bottom';
  return $position;
}
add_filter( 'caps_review_default_location', 'mts_new_default_review_location' );
 
// Hide fields in "item" meta box
function mts_hide_item_metabox_fields($fields) {
  unset($fields['location'], $fields['fontcolor'], $fields['bordercolor']);
  // Or remove all with:
  // $fields = array();
  return $fields;
}
add_filter( 'caps_review_metabox_item_fields', 'mts_hide_item_metabox_fields' );

// Hide selected review types in metabox dropdown
function mts_hide_review_types($types) {
  unset($types['point'], $types['percentage']); // remove types
  $types['star'] = __('Enable Reviews'); // Change label
  return $types;
}
add_filter( 'caps_review_metabox_types', 'mts_hide_review_types' );
 
// Add default criteria
function mts_add_default_criteria($items) {
  $items = array(__('Audio'), __('Visual'), __('UX'), __('Price'));
  return $items;
}
add_filter( 'caps_review_default_criteria', 'mts_add_default_criteria' );

// Customize caps_review_show_total() output
function mts_custom_review_total($content, $id, $type, $total) {
  if (get_the_title($id) == 'Special Post With Blue Rating') {
    $color = '#0000FF';
    $content = preg_replace('/"review-type-[^"]+"/', '$0 style="background-color: '.$color.';"', $content);
  }
return $content;
}
add_filter('caps_review_show_total', 'mts_custom_review_total', 10, 4);

// Exclude post types
function mts_caps_review_exclude_post_types($excluded) {
  // default: $excluded = array('attachment');
  $excluded[] = 'page'; // Don't allow reviews on pages
  return $excluded;
}
add_filter( 'caps_review_excluded_post_types', 'mts_caps_review_exclude_post_types' );
?>