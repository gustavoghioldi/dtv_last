<?php
add_filter( 'ot_recognized_font_families', 'trend_font_families' );
function trend_font_families( $array ){
	//Arial
	$array['PTSansRegular'] = 'PTSansRegular';
	$array['OpenSansBold'] = 'OpenSansBold';
	$array['OpenSansSemiBold'] = 'OpenSansSemiBold';
	$array['OpenSansBoldItalic'] = 'OpenSansBoldItalic';
	$array['OpenSansExtraBoldItalic'] = 'OpenSansExtraBoldItalic';
	$array['OpenSansItalic'] = 'OpenSansItalic';
	$array['OpenSansLight'] = 'OpenSansLight';
	$array['OpenSansRegular'] = 'OpenSansRegular';

	return $array;
}

add_filter('manage_posts_columns', 'caps_posts_columns', 10);
add_action('manage_posts_custom_column', 'caps_posts_custom_columns', 10, 2);
function caps_posts_columns($defaults){
    $defaults['caps_post_thumbs'] = __('Thumbs', THEMENAME);
    return $defaults;
}
function caps_posts_custom_columns($column_name, $id){
	if($column_name === 'caps_post_thumbs'){
        echo the_post_thumbnail(  array(100,100) );
    }
}
?>