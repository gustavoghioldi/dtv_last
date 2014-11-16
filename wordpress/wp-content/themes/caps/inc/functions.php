<?php
function caps_get_layout(){
	if(is_page() || is_single() ){
		$page_layout = (get_post_meta(get_the_ID(), 'page_layout', true) != '')? 
	                  get_post_meta(get_the_ID(), 'page_layout', true) : 'rs';
	}else{
		$page_layout = ot_get_option('blog_page_layout', 'rs');
	}
	return $page_layout;
}

function caps_post_format_icon(){
	global $post, $wpdb;
	//'image', 'video', 'gallery', 'audio', 'quote'
	$format = get_post_format();
	switch ($format) {
    case 'video':
        echo '<i class="dash fa fa-film"></i>';
        break;
    case 'gallery':
        echo '<i class="dash gallery"></i>';
        break;
    case 'audio':
        echo '<i class="dash fa fa-music"></i>';
        break; 
    case 'quote':
        echo '<i class="dash genericon genericon-quote"></i>';
        break;
    case 'link':
        echo '<i class="dash fa fa-link"></i>';
        break;       
    default: 
    	echo '<i class="dash fa fa-camera"></i>';         
	}
	
}

function get_caps_post_info($postid){
	global $wpdb;
	$output = '<p class="meta-info">
		<span class="date-meta"><i class="genericon genericon-time"></i>'.get_the_time( get_option( 'date_format' ) ).'</span>';
		
	$output .= '<span class="count-comment"><a href="'.get_comments_link().'" class="su-post-comments-link"><i class="fa fa-comment-o"></i>'.get_comments_number( $postid ).'</a></span>
	</p>';
	return $output;
}

function caps_post_info(){
	global $post;
	$output = '
	<p class="meta-info">
		<span class="date-meta"><i class="genericon genericon-time"></i>'.get_the_time( get_option( 'date_format' ) ).'</span>';
		 if(is_single()): 
			$output .= '<span class="author-meta"><a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'"><i class="genericon genericon-user"></i>'.get_the_author().'</a></span>
			<span class="category-meta"><i class="genericon genericon-document"></i>'.get_the_category_list( __( ', ', 'capstheme' ) ).'</span>';
		 endif; 
		$output .= '<span class="count-comment"><a href="'.get_comments_link().'" class="su-post-comments-link"><i class="fa fa-comment-o"></i>'.get_comments_number(  ).'</a></span>
	</p>';
	echo  $output;
}

function caps_get_attachment( $attachment_id ) {
	global $wpdb, $post;

	$arr = array(
		'alt' => '',
		'caption' => '',
		'description' => '',
		'href' => '',
		'src' => '',
		'title' => ''
	);

	$query = new WP_Query( array( 'p' => $attachment_id, 'post_status' => 'any', 'post_type' => 'attachment' ) );
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$arr = array(
				'alt' => get_post_meta( $post->ID, '_wp_attachment_image_alt', true ),
				'caption' => get_the_excerpt(),
				'description' => get_the_content(),
				'href' => get_permalink(),
				'src' => $post->guid,
				'title' => get_the_title()
			);
		}
	}

	wp_reset_postdata();

	
	return $arr;
}

// caps comments form
 function caps_comment_form( $args = array(), $post_id = null ) {
	if ( null === $post_id )
		$post_id = get_the_ID();
	else
		$id = $post_id;

	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html5    = 'html5' === $args['format'];
	$fields   =  array(
		'author' => '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="form-group"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . '  placeholder="' . __( 'Name', 'caps' ) . '" class="form-control" /></div>',
		'email'  => '<div class="form-group"><input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="' . __( 'Email', 'caps' ) . '" class="form-control" /></div>',
		'url'    => '<div class="form-group"><input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="' . __( 'Website', 'caps' ) . '" class="form-control" /></div></div>',
	);

	$required_text = sprintf( ' ' . __('Required fields are marked %s', 'caps'), '<span class="required">*</span>' );
	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="form-group"><textarea id="comment" name="comment" aria-required="true" rows="8" placeholder="' . __( 'Message', 'caps' ) . '" class="form-control"></textarea></div></div>',
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'caps' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'caps' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.', 'caps' ) . ( $req ? $required_text : '' ) . '</p>',
		
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => __( 'Leave a comment', 'caps' ),
		'title_reply_to'       => __( 'Leave a comment to %s', 'caps' ),
		'cancel_reply_link'    => __( 'Cancel reply', 'caps' ),
		'label_submit'         => __( 'Send', 'caps' ),
		'format'               => 'xhtml',
	);

	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
		<?php if ( comments_open( $post_id ) ) : ?>
			<?php do_action( 'comment_form_before' ); ?>
			<div class="blog-comment-form">
                <h3 class="title"><span><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></span></h3>
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo $args['must_log_in']; ?>
					<?php do_action( 'comment_form_must_log_in_after' ); ?>
				<?php else : ?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="comment-form"<?php echo $html5 ? ' novalidate' : ''; ?>>
                    <?php if ( is_user_logged_in() ) : ?>
					  <?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
                    <?php endif; ?>
                      <div class="row">
                    	
						<?php do_action( 'comment_form_top' ); ?>
						
						<?php if ( is_user_logged_in() ) : ?>
							<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
                             <?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
						<?php else : ?>
							<?php
							do_action( 'comment_form_before_fields' ); ?>
                            <?php
								foreach ( (array) $args['fields'] as $name => $field ) {
									echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
								}
							?>
                            <?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
							<?php
							do_action( 'comment_form_after_fields' );
							?>
						<?php endif; ?>                        
						
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <input type="submit" class="submit-btn comment-submit-button" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
                          <?php comment_id_fields( $post_id ); ?>
                        </div>
						<?php do_action( 'comment_form', $post_id ); ?>
                      </div><!--.row-->
					</form>
				<?php endif; ?>
			</div><!--.blog-comment-form-->
			<?php do_action( 'comment_form_after' ); ?>
		<?php else : ?>
			<?php do_action( 'comment_form_comments_closed' ); ?>
		<?php endif; ?>
	<?php
 }

 if ( ! function_exists( 'caps_comments' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own caps_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
function caps_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', THEMENAME ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', THEMENAME ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="single-comment">
			<div class="row">
				<div class="comment-meta comment-author vcard col-lg-2 col-md-2 col-sm-3 col-xs-12">
				<?php
					echo get_avatar( $comment, 200 );
					
				?>
			</div><!-- .comment-meta -->
				<div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
					<div class="comment-content">
						<div class="comment-info">
						<?php
						printf( '<cite><b class="fn">%1$s</b> %2$s</cite> on ',
							get_comment_author_link(),
							// If current post author is also comment author, make it known visually.
							( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', THEMENAME ) . '</span>' : ''
						);
						printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							/* translators: 1: date, 2: time */
							sprintf( __( '%1$s at %2$s', THEMENAME ), get_comment_date(), get_comment_time() )
						);
						?>
						</div>
						<?php if ( '0' == $comment->comment_approved ) : ?>
							<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', THEMENAME ); ?></p>
						<?php endif; ?>

					
						<?php comment_text(); ?>
						
					

						<div class="reply">
							<?php edit_comment_link( __( 'Edit', THEMENAME ), '<span class="cedit-link">', '</span>' ); ?>
							<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', THEMENAME ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</div><!-- .reply -->
					</div><!-- .comment-content -->
				</div>
			</div>
		</div><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

 /**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
 function caps_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'bapz' ), max( $paged, $page ) );

	return $title;
 }
 add_filter( 'wp_title', 'caps_wp_title', 10, 2 );

function caps_numeric_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="col-lg-12 col-md-12 col-sm-12"><div class="navigation pagination"><ul class="list-inline">' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link( '<i class="fa fa-angle-left"></i>' ) );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>&hellip;</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>&hellip;</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link( '<i class="fa fa-angle-right"></i>' ) );

	echo '</ul></div></div>' . "\n";

}

add_action( 'show_user_profile', 'caps_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'caps_show_extra_profile_fields' );
 
function caps_show_extra_profile_fields( $user ) { 

	$fields =  array('Twitter url' => 'twitter', 'Facebook url' => 'facebook', 'Skype name' => 'skype', 'Dribbble url' => 'dribbble' );
	?>
 
	<h3>Extra profile information</h3>
	 
	<table class="form-table">
	    <?php foreach($fields as $key=>$value): ?>
	    <tr>
	        <th><label for="<?php echo $value ?>"><?php echo $key ?></label></th>
	        <td>
	            <input type="text" name="<?php echo $value ?>" id="<?php echo $value ?>" value="<?php echo esc_attr( get_the_author_meta( $value, $user->ID ) ); ?>" class="regular-text" /><br />
	            <span class="description">Please enter your <?php echo $key ?>.</span>
	        </td>
	    </tr>
	<?php endforeach;  ?>
	</table>
<?php }

add_action( 'personal_options_update', 'caps_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'caps_save_extra_profile_fields' );
 
function caps_save_extra_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    $fields =  array('Twitter url' => 'twitter', 'Facebook url' => 'facebook', 'Skype name' => 'skype', 'Dribbble url' => 'dribbble' );
    foreach($fields as $key=>$value){
    	update_user_meta( $user_id, $value, $_POST[$value] );
    }
    
}

function caps_body_classes( $classes ) {
	
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if(is_page()){
		$page_layout = ot_get_option('blog_page_layout', 'rs');
		if ( $page_layout == 'full' ) {
			$classes[] = 'full-width-page';
		} else {
			$classes[] = 'sidebar-page';
		}
	}

	$site_layout = ot_get_option( 'site_layout' );
	
	if ( $site_layout == 'boxed' ) {
		$classes[] = 'boxed';
	}


	return $classes;
}
add_filter( 'body_class', 'caps_body_classes' );

function pre_esc_html($atts, $content) {
  return '<pre>'.$content.'</pre>';
}

add_shortcode( 'coding', 'pre_esc_html');

function fix_caps_gallery_wpse43558($output, $attr) {
    global $post;

    static $instance = 0;
    $instance++;
    $size_class = '';

    /**
     *  will remove this since we don't want an endless loop going on here
     */
    // Allow plugins/themes to override the default gallery template.
    //$output = apply_filters('post_gallery', '', $attr);

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'div',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => 3,
        'size'       => '',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $gallery_style = $gallery_div = '';
    if ( apply_filters( 'use_default_gallery_style', true ) )
        /**
         * this is the css you want to remove
         *  #1 in question
         */
        /*
        */
    $size_class = ($size != '' )?sanitize_html_class( $size ) : 'normal';
    $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-size-{$size_class}'><div class='row'>";
    $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

    $i = 1;
	$col = 12/$columns;
	$width = round(1180/$columns);
	$height = $width;
    foreach ( $attachments as $id => $attachment ) {

        $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
		 $image_url = wp_get_attachment_url($id, $size, false, false);
		 $attatchement_image = caps_image_resize( $image_url, $width, $height, true, false, false );
		$class = ($i % $columns == 0)? ' last' : '';
        
		$output .= "<{$itemtag} class='col-xs-12 col-sm-6 col-md-{$col} col-lg-{$col}{$class}'><div class='gallery-item'>";
        $output .= "<a class='image-type popup' href='".$image_url."' data-effect='mfp-zoom'><i class='fa fa-2 fa-plus-circle'></i> </a>
        <img src='" . $attatchement_image . "' alt='images thumb' /><h5>".$attachment->post_excerpt."</h5></div>
            </{$itemtag}>";
     $i++;   
    }
    $output .= "</div></div>\n";
    return $output;
}
add_filter("post_gallery", "fix_caps_gallery_wpse43558",10,2);

 if ( ! function_exists( 'modify_attachment_link' ) ) :
	function modify_attachment_link( $markup, $id, $size, $permalink, $icon, $text ){

	    // We need just thumbnails.
	    if ( 'portfolio-thumb' !== $size )
	    {   // Return the original string untouched.

	        return $markup;
	    }

	       

	    // Recreate the missing information.
	    $_post      = get_post( $id );
	    $new_url  = wp_get_attachment_url( $_post->ID, 'medium' );
	    $post_title = esc_attr( $_post->post_title );

	    if ( $text ) 
	    {
	        $link_text = esc_attr( $text );
	    } 
	    elseif ( 
	           ( is_int( $size )    && $size != 0 ) 
	        or ( is_string( $size ) && $size != 'none' ) 
	        or $size != FALSE 
	    ) 
	    {
	        $link_text = wp_get_attachment_image( $id, $size, $icon );
	    } 
	    else 
	    {
	        $link_text = '';
	    }

	    if ( trim( $link_text ) == '' )
	    {
	        $link_text = $_post->post_title;
	    }
	    return "<div class='blog-thumbnail element' data-link='$new_url' data-zoom='$new_url'><a class='element-lightbox' rel='croc-lightbox[pop_gal]' href='$new_url' title='$post_title' target='_blank'><i class='icon-zoom-in'></i></a></div>{$link_text}";
	}

	add_filter( 'wp_get_attachment_link', 'modify_attachment_link', 10, 6 );
endif;

function caps_custom_excerpt_length( $length ) {
	return 55;
}
add_filter( 'excerpt_length', 'caps_custom_excerpt_length', 999 );

add_shortcode( 'caps_posts_slider' , 'caps_posts_slider_callback' );

function caps_posts_slider_callback(){
	get_template_part('inc/posts-slider', '');
}

add_shortcode( 'caps_custom_slider' , 'caps_custom_slider_callback' );

function caps_custom_slider_callback(){
	get_template_part('inc/custom-slider', '');
}


 include 'ajax-load-more/functions.php';
 include 'posts-slider-widget.php';
 include 'category-posts-widget.php';
 include 'custom-slider-widget.php';
?>