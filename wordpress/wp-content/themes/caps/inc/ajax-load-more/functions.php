<?php

if( !function_exists( 'enqueue_scripts' ) ) {
    function enqueue_scripts() {
    	//Register our JS
	
		wp_register_script('ajax-load-more', get_template_directory_uri() . '/inc/ajax-load-more/js/ajax-load-more.js', 'jquery', '1.0', true);
		// Enqueue CSS
		wp_enqueue_style( 'ajax-load-more-css', get_template_directory_uri() . '/inc/ajax-load-more/css/ajax-load-more.css' );

        // Enqueue our scripts
    	wp_enqueue_script('ajax-load-more');	    	
    }
    
    add_action('wp_enqueue_scripts', 'enqueue_scripts');
}

/*-----------------------------------------------------------------------------------*/
/*	WP Ajax Load More Shortcode
/*-----------------------------------------------------------------------------------*/

function ajax_load_more( $atts, $content = null ) {	
	extract(shortcode_atts(array(
		'path' 				=> admin_url( 'admin-ajax.php' ),
		'post_type' 		=> 'post',
		'category' 			=> '',
		'taxonomy' 			=> '',
		'tag' 				=> '',
		'author' 			=> '',
		'search' 			=> '',
		'post_not_in' 		=> '',
		'offset' 		   => '0',
		'display_posts' 	=> '4',
		'scroll' 			=> 'false',
		'max_pages' 		=> '5',
		'transition' 		=> 'slide',
		'button_text' 		=> 'Older Posts' 
   ), $atts));	
   return '<div id="ajax-load-more"><div class="listing" data-args="" data-path="'.$path.'" data-post-type="'.$post_type.'" data-category="'.$category.'" data-taxonomy="'.$taxonomy.'" data-tag="'.$tag.'" data-author="'.$author.'" data-post-not-in="'.$post_not_in.'" data-offset="'.$offset.'" data-display-posts="'.$display_posts.'" data-search="'.$search.'" data-scroll="'.$scroll.'" data-max-pages="'.$max_pages.'" data-button-text="'.$button_text.'" data-transition="'.$transition.'"></div></div>';  
}
add_shortcode('ajax_load_more', 'ajax_load_more');

add_action( 'wp_ajax_ajax_post_action', 'ajax_post_action_callback' );
add_action( 'wp_ajax_nopriv_ajax_post_action', 'ajax_post_action_callback' );

function ajax_post_action_callback(){
	// ---------------------------------- //
	// - Set up our variables from ajax-load-more.js
	// ---------------------------------- //
	global $post, $wpdb;
	$postType = (isset($_POST['postType'])) ? $_POST['postType'] : 'post';
	$category = (isset($_POST['category'])) ? $_POST['category'] : '';
	$author_id = (isset($_POST['author'])) ? $_POST['author'] : '';
	$taxonomy = (isset($_POST['taxonomy'])) ? $_POST['taxonomy'] : '';
	$tag = (isset($_POST['tag'])) ? $_POST['tag'] : '';
	$s = (isset($_POST['search'])) ? $_POST['search'] : '';
	$exclude = (isset($_POST['postNotIn'])) ? $_POST['postNotIn'] : '';
	$numPosts = (isset($_POST['numPosts'])) ? $_POST['numPosts'] : 6;
	$page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
	$offset = (isset($_POST['offset'])) ? $_POST['offset'] : 0;

	$argsdata = (isset($_POST['args'])) ? $_POST['args'] : '';

	// ---------------------------------- //
	// - Set up initial args
	// ---------------------------------- //

	$args = array(
		'post_type' 			=> $postType,
		'category_name' 		=> $category,	
		'author'					=> $author_id,
		'posts_per_page' 		=> $numPosts,
		//'paged'          		=> $page, Removed in favour of 'offset', seems to work nicely.
		'offset'             => $offset + ($numPosts*$page),
		's'          			=> $s,	
		'orderby'   			=> 'date',
		'order'     			=> 'DESC',
		'post_status' 			=> 'publish',
		'ignore_sticky_posts' 	=> true,
	);


	// ---------------------------------- //
	// - Excluded Posts Example Function
	// ---------------------------------- //

	/* Create new array of excluded posts.
	for example, you may have a feature post rotator on the page and you may want to exclude these posts in your query.

	Example post array:
	$features = array('7238', '6649', '6951'); // Array of posts
	if($features){			
	   $postsNotIn = implode(",", $features); //Implode the posts and set a varible to pass to our data-post-not-in param.
	}   
	Example HTML
	<ul class="listing" data-path="<?php echo get_template_directory_uri(); ?>" data-post-type="post" data-post-not-in="<?php echo $postsNotIn; ?>" data-display-posts="6" data-button-text="Load More">
	*/

	// - Exclude posts if needed

	if(!empty($exclude)){
		$exclude=explode(",",$exclude);
		$args['post__not_in'] = $exclude;
	}

	// - Query by Taxonomy

	if(empty($taxonomy)){
		$args['tag'] = $tag;
	}else{
	    $args[$taxonomy] = $tag;
	}

	$as = str_replace("\\","",$_POST['args']);
	$args = ($argsdata != '' )? maybe_unserialize($as) : $args;
	$args['offset'] = $offset + ($numPosts*$page);
	
	// The Query
	$the_query = new WP_Query( $args );

	// ---------------------------------- //
	// - Run our loop
	// ---------------------------------- //

	if ($the_query->have_posts()) :
		 
		while ($the_query->have_posts()): $the_query->the_post();
			// - Run the repeater
			$content = ot_get_option('archive_posts_display', 'list');
        	get_template_part( 'inc/ajax-load-more/includes/'.$content); 	
		endwhile; endif;
	wp_reset_query(); 
	exit();
}




