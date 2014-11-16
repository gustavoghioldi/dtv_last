<?php
if(WP_DEBUG !== true){
	// turn error reporting off
	error_reporting(0);
}

$caps_sharebutton_url = THEMEURI.'inc/caps-share-buttons';
$caps_sharebutton_path = THEMEDIR.'inc/caps-share-buttons';
define( 'share_button_url', $caps_sharebutton_url );
define( 'share_button_path', $caps_sharebutton_path );
	
// widget class
class Share_button_widget extends WP_Widget {

	// construct the widget
	public function __construct() {
		parent::__construct(
 		'caps_share_widget', // Base ID
		'Caps Share Buttons', // Name
		array( 'description' => __( 'Caps Share Buttons', THEMENAME ), ) // Args
	);
	}

	// extract required arguments and run the shortcode
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$url = isset($instance['url'])? $instance['url'] : '';
		$pagetitle = isset($instance['pagetitle'])? $instance['pagetitle'] : '';

		echo $before_widget;
		if (!empty($title))
		echo $before_title . $title . $after_title;
		
		$shortcode = '[caps_share_button';
			($url != '' ? $shortcode .= ' url="' . $url . '"' : NULL);
			($pagetitle != '' ? $shortcode .= ' title="' . $pagetitle . '"' : NULL);
		$shortcode .= ' widget="Y"]';
		echo do_shortcode($shortcode, 'capstheme' );
		echo $after_widget;
	}

	public function form( $instance ) {
		
		if ( isset( $instance[ 'title' ] ) ) {
		
			$title = $instance[ 'title' ];
		} else {
		
		$title = __( 'Share Buttons', THEMENAME );
		}

		$url = isset($instance['url'])? esc_url( $instance['url'] ) : '';
		$pagetitle = isset($instance['pagetitle'])? esc_attr( $instance['pagetitle'] ) : '';

		
		# Title
		echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';
		# URL
		echo '<p><label for="' . $this->get_field_id('url') . '">' . 'URL:' . '</label><input class="widefat" id="' . $this->get_field_id('url') . '" name="' . $this->get_field_name('url') . '" type="text" value="' . $url . '" /></p>';
		echo '<p class="description">Leave this blank to share the current page, or enter a URL to force one URL for all pages.</p>';
		# Page title
		echo '<p><label for="' . $this->get_field_id('pagetitle') . '">' . 'Page title:' . '</label><input class="widefat" id="' . $this->get_field_id('pagetitle') . '" name="' . $this->get_field_name('pagetitle') . '" type="text" value="' . $pagetitle . '" /></p>';
		echo '<p class="description">Set a page title for the page being shared, leave this blank if you have not set a URL.</p>';
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['url'] = strip_tags( $new_instance['url'] );
		$instance['pagetitle'] = strip_tags( $new_instance['pagetitle'] );

		return $instance;
	}

}

// add caps to available widgets
add_action( 'widgets_init', create_function( '', 'register_widget( "Share_button_widget" );' ) );

//Social link widget class
class Share_socila_link_widget extends WP_Widget {

	// construct the widget
	public function __construct() {
		parent::__construct(
 		'caps_social_link_widget', // Base ID
		'Caps Social link Buttons', // Name
		array( 'description' => __( 'Caps Social links Buttons', THEMENAME ), ) // Args
	);
	}

	// extract required arguments and run the shortcode
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		$social = isset($instance['social'])? $instance['social'] : array();

		echo $before_widget;
		if (!empty($title))
		echo $before_title . $title . $after_title;
		if(!empty($social))	{
			$icons = array(
				'facebook' => 'Facebook', 
				'skype' => 'Skype',
				'digg' => 'Diggit', 
				'youtube' => 'Youtube', 
				'google' => 'Google +', 
				'linkedin' => 'Linkedin', 
				'pinterest' => 'Pinterest',
				'reddit' => 'Reddit', 
				'stumbleupon' => 'Stumbleupon', 
				'tumblr' => 'Tumblr', 
				'twitter' => 'Twitter',
				'flickr' => 'Flickr'
				);
			echo '<div class="share-icons">';
			foreach ($social as $key => $value) {
				echo ($value != '')? '<a title="'.$icons[$key].'" class="caps_'.$key.'_share" target="_blank" href="'.$value.'"><i class="fa fa-'.$key.'"></i></a>': '';
			}
			echo '</div>';
		}
		
		echo $after_widget;
	}

	public function form( $instance ) {
		
		if ( isset( $instance[ 'title' ] ) ) {
		
			$title = $instance[ 'title' ];
		} else {
		
		$title = __( 'Social Links', THEMENAME );
		}

		
		$social = isset($instance['social'])? $instance['social'] : array();

		$icons = array(
			'facebook' => 'Facebook', 
			'skype' => 'Skype',
			'digg' => 'Diggit', 
			'youtube' => 'Youtube', 
			'google' => 'Google +', 
			'linkedin' => 'Linkedin', 
			'pinterest' => 'Pinterest',
			'reddit' => 'Reddit', 
			'stumbleupon' => 'Stumbleupon', 
			'tumblr' => 'Tumblr', 
			'twitter' => 'Twitter',
			'flickr' => 'Flickr'
			);


		if(!empty($social)){
			$ordericons = array();
			foreach ($social as $key => $value) {
				$ordericons[$key] = $icons[$key];
			}
		}else{
			$ordericons = $icons;
		}
	
		# Title
		echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';
		
		echo '<p class="description">You can change order of social links</p>';
		echo '<ul class="icon-shortable">';
		foreach ($ordericons as $key => $value) {
			$link_value = isset($instance['social'][$key])? $instance['social'][$key] : '';
			echo '<li style="cursor:move"><p><label>'.$value.'</label><input class="widefat" type="text" name="' . $this->get_field_name('social') . '['.$key.']" value="'.$link_value.'"><small>To remove it, just leave it blank.</small></p></li>';
		}
		echo '</ul>';
		echo '<p class="description">Set a page title for the page being shared, leave this blank if you have not set a URL.</p>';
		wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_script('jquery-ui');
		?>
		<script>jQuery(document).ready(function() {jQuery( ".icon-shortable" ).sortable(); })</script>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['social'] = $new_instance['social'];

		return $instance;
	}

}

// add caps to available widgets
add_action( 'widgets_init', create_function( '', 'register_widget( "Share_socila_link_widget" );' ) );	
	



	
	

	
	// get and show share buttons
	function show_share_buttons($content='', $booShortCode = FALSE, $atts = '') {
	

		// globals
		global $post, $wpdb;
		
		// variables
		$htmlContent = $content;
		$htmlShareButtons = '';
		$strIsWhatFunction = '';
		$pattern = get_shortcode_regex();
		$arrSettings = ot_get_option('post_share_icons', array());
		$socials_post = ot_get_option('display_social_post');
		$socials_page = ot_get_option('display_social_page');
		$socials_event = ot_get_option('display_social_event');

		// caps_hide shortcode is in the post content and instance is not called by shortcode caps
		if (preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches )
			&& array_key_exists( 2, $matches )
			&& in_array('caps_share_button_hide', $matches[2]) 
			&& $booShortCode == FALSE) {
			
			// exit the function returning the content without the buttons
			return $content;
		}
	
		// get sbba settings

		// placement on pages/posts/categories/archives/homepage
		if ( (is_page() && ($socials_page == 'on')) || (is_single() && ($socials_post == 'on'))  || (is_single() && ($socials_event == 'on'))  || $booShortCode == TRUE) {

					
			// if not shortcode
			if (isset($atts['widget']))
				// use widget share text
				$strShareText = ot_get_option('croc_share_text');
			else 								
				// use normal share text
				$strShareText = ot_get_option('croc_share_text');
						
			// caps div
			$htmlShareButtons = '<div class="caps-share-buttons">';
			
			// center if set so
			$htmlShareButtons.= '<div class="share-icons-wrap">';
			
			
			// share text
			$htmlShareButtons .= '<span>'.$strShareText.'&nbsp;&nbsp;&nbsp;</span>';
			


			// if running standard
			if ($booShortCode == FALSE) {
			
				// use wordpress functions for page/post details
				$urlCurrentPage = get_permalink($post->ID);	
				$strPageTitle = get_the_title($post->ID);
			}	else { // if using shortcode
			
				// if custom attributes have been set
				if (isset($atts['url']) && $atts['url'] != '') {
					
					// set page URL and title as set by user
					$urlCurrentPage = (isset($atts['url']) ? $atts['url'] : caps_current_url());
					$strPageTitle = (isset($atts['title']) ? $atts['title'] : NULL);

				} else {
					// get page name and url from functions
					$urlCurrentPage = caps_current_url();
					$strPageTitle = $_SERVER["SERVER_NAME"];
				}
				
				
			}	
			
			
			// the buttons!
			$htmlShareButtons.= '<div class="share-icons">'.get_share_buttons($arrSettings, $urlCurrentPage, $strPageTitle).'</div>';
			
			
			// close center if set
			$htmlShareButtons.= '</div>';
			$htmlShareButtons.= '</div>';
			
			// if not using shortcode
			if ($booShortCode == FALSE) {
			
				// switch for placement of caps
				switch ($arrSettings['caps_before_or_after']) {
				
					case 'before': // before the content
					$htmlContent = $htmlShareButtons . $content;
					break;
					
					case 'after': // after the content
					$htmlContent = $htmlShareButtons;
					break;
					
					case 'both': // before and after the content
					$htmlContent = $htmlShareButtons . $content . $htmlShareButtons;
					break;
				}
			}
			
			// if using shortcode
			else {
			
				// just return buttons
				$htmlContent = $htmlShareButtons;
			}
		}
		
		// return content and share buttons
		return $htmlContent;
	}

	// shortcode for adding buttons
	function caps_buttons($atts) {
	
		// get buttons - NULL for $content, TRUE for shortcode flag
		$htmlShareButtons = show_share_buttons(NULL, TRUE, $atts);
		
		//return buttons
		return $htmlShareButtons;
	}
	
	// shortcode for hiding buttons
	function caps_hide($content) {

	}
	
	// get URL function
	function caps_current_url() {
	
		// add http
		$urlCurrentPage = 'http';
		
		// add s to http if required
		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$urlCurrentPage .= "s";}
		
		// add colon and forward slashes
		$urlCurrentPage .= "://";
		
		// check if port is not 80
		if ($_SERVER["SERVER_PORT"] != "80") {
		
			// include port if needed
			$urlCurrentPage .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			
		} 
		
		// else if on port 80
		else {
		
			// don't include port in url
			$urlCurrentPage .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		
		return $urlCurrentPage;
	}
	
	// shorten URL with bit.ly
	function caps_shorten($urlLong) {
	
		// get results from bitly and return short url
		$hmtlBitly = wp_remote_fopen('//api.bit.ly/v3/shorten?login=simplesharebuttons&apiKey=R_555eddf50da1370b8ab75670a3de2fe6&longUrl=' . $urlLong);
		$arrBitly = json_decode($hmtlBitly, true);
		$urlShort =  $arrBitly['data'];
		$urlShort =  $urlShort['url'];
		$hmtlBitly = str_replace('[\]', '', $hmtlBitly);
		
		if ($urlShort != '') {
		
			return $urlShort;
		} else {
		
			return $urlLong;
		}; 
	}
	
	// get set share buttons
	function get_share_buttons($arrSettings=array(), $urlCurrentPage, $strPageTitle) {

	// variables
	$htmlShareButtons = '';
	if(empty($arrSettings)) return '';
	
	// explode saved include list and add to a new array
	$arrSelectedSSBA = $arrSettings;
	
	// check if array is not empty
	if(!empty($arrSettings)) {
	
		
		// set show flag to false
		$booShowShareCount = false;
		
	
		// for each included button
		foreach ($arrSelectedSSBA as $strSelected) {
			 $btnicon = explode('-', $strSelected['icon']);
			 $btn = $btnicon[1];
			 $strGetButton = 'caps_' . $btn;
		
			// add a list item for each selected option
			$htmlShareButtons .= (function_exists($strGetButton))? $strGetButton($strSelected['icon'], $urlCurrentPage, $strPageTitle, $booShowShareCount) : '';
		}
	}
	
	// return share buttons
	return $htmlShareButtons;
}

// get facebook button
function caps_facebook($arrSettings, $urlCurrentPage, $strPageTitle, $booShowShareCount) {

	// facebook share link
	$htmlShareButtons = '<a title="Share on Facebook" class="caps_facebook_share" href="//www.facebook.com/sharer.php?u=' . $urlCurrentPage  . '" target="_blank" rel="nofollow">';
	
	
	// show custom image
	$htmlShareButtons .= '<span><i class="fa '.$arrSettings.'"></i></span>';
	
	// close href
	$htmlShareButtons .= '</a>';
	
	// if show share count is set to Y
	//if (isset($arrSettings['caps_show_share_count']) && $booShowShareCount == true) {
	
		//$htmlShareButtons .= '<span class="caps_sharecount">' . getFacebookShareCount($urlCurrentPage) . '</span>';
	//}
	
	// return share buttons
	return $htmlShareButtons;
}

// get facebook share count
function getFacebookShareCount($urlCurrentPage) {

	// get results from facebook and return the number of shares
    $htmlFacebookShareDetails = wp_remote_fopen('//graph.facebook.com/' . $urlCurrentPage);
    $arrFacebookShareDetails = json_decode($htmlFacebookShareDetails, true);
    $intFacebookShareCount =  (isset($arrFacebookShareDetails['shares']) ? $arrFacebookShareDetails['shares'] : 0);
    return ($intFacebookShareCount ) ? $intFacebookShareCount : '0';
}

// get twitter button
function caps_twitter($arrSettings, $urlCurrentPage, $strPageTitle, $booShowShareCount) {

	// format the URL into friendly code
	$twitterShareText = '';

	// twitter share link
	$htmlShareButtons = '<a title="Tweet about this on Twitter" class="caps_twitter_share" href="//twitter.com/share?url=' . $urlCurrentPage . '&amp;text=' . $twitterShareText . '" target="_blank" rel="nofollow">';
	
	$htmlShareButtons .= '<span><i class="fa '.$arrSettings.'"></i></span>';
	
	// close href
	$htmlShareButtons .= '</a>';
	
	// if show share count is set to Y
	//if (isset($arrSettings['caps_show_share_count']) && $booShowShareCount == true) {
	
		//$htmlShareButtons .= '<span class="caps_sharecount">' . getTwitterShareCount($urlCurrentPage) . '</span>';
	//}
	
	// return share buttons
	return $htmlShareButtons;
}

// get twitter share count
function getTwitterShareCount($urlCurrentPage) {

	// get results from twitter and return the number of shares
    $htmlTwitterShareDetails = wp_remote_fopen('//urls.api.twitter.com/1/urls/count.json?url=' . $urlCurrentPage);
    $arrTwitterShareDetails = json_decode($htmlTwitterShareDetails, true);
    $intTwitterShareCount =  $arrTwitterShareDetails['count'];
    return ($intTwitterShareCount ) ? $intTwitterShareCount : '0';
}

// get google+ button
function caps_google($arrSettings, $urlCurrentPage, $strPageTitle, $booShowShareCount) {

	// google share link
	$htmlShareButtons = '<a title="Share on Google+" class="caps_google_share" href="//plus.google.com/share?url=' . $urlCurrentPage  . '" target="_blank" rel="nofollow">';
	
	$htmlShareButtons .= '<span><i class="fa '.$arrSettings.'"></i></span>';
	
	// close href
	$htmlShareButtons .= '</a>';
	
	// if show share count is set to Y
	//if (isset($arrSettings['caps_show_share_count']) && $booShowShareCount == true) {
	
		//$htmlShareButtons .= '<span class="caps_sharecount">' . getGoogleShareCount($urlCurrentPage) . '</span>';
	//}
	
	// return share buttons
	return $htmlShareButtons;
}

// get google share count
function getGoogleShareCount($urlCurrentPage) {

	 $args = array(
            'method' => 'POST',
            'headers' => array(
                // setup content type to JSON 
                'Content-Type' => 'application/json'
            ),
            // setup POST options to Google API
            'body' => json_encode(array(
                'method' => 'pos.plusones.get',
                'id' => 'p',
                'method' => 'pos.plusones.get',
                'jsonrpc' => '2.0',
                'key' => 'p',
                'apiVersion' => 'v1',
                'params' => array(
                    'nolog'=>true,
                    'id'=> $urlCurrentPage,
                    'source'=>'widget',
                    'userId'=>'@viewer',
                    'groupId'=>'@self'
                ) 
             )),
             // disable checking SSL sertificates               
            'sslverify'=>false
        );
     
    // retrieves JSON with HTTP POST method for current URL  
    $json_string = wp_remote_post("//clients6.google.com/rpc", $args);
     
    if (is_wp_error($json_string)){
        // return zero if response is error                             
        return "0";             
    } else {        
        $json = json_decode($json_string['body'], true);                    
        // return count of Google +1 for requsted URL
        return intval( $json['result']['metadata']['globalCounts']['count'] ); 
    }
}

// get diggit button
function caps_digg($arrSettings, $urlCurrentPage, $strPageTitle, $booShowShareCount) {

	// diggit share link
	$htmlShareButtons = '<a title="Digg this" class="caps_diggit_share caps_share_link" href="//www.digg.com/submit?url=' . $urlCurrentPage  . '" target="_blank" rel="nofollow">';
	
	$htmlShareButtons .= '<span><i class="fa '.$arrSettings.'"></i></span>';
	
	// close href
	$htmlShareButtons .= '</a>';

	// return share buttons
	return $htmlShareButtons;
}

// get reddit button
function caps_reddit($arrSettings, $urlCurrentPage, $strPageTitle, $booShowShareCount) {

	// reddit share link
	$htmlShareButtons = '<a title="Share on Reddit" class="caps_reddit_share" href="//reddit.com/submit?url=' . $urlCurrentPage  . '&amp;title=' . $strPageTitle . '" target="_blank" rel="nofollow">';
	
	
	$htmlShareButtons .= '<span><i class="fa '.$arrSettings.'"></i></span>';
	// close href
	$htmlShareButtons .= '</a>';
	
	// if show share count is set to Y
	//if (isset($arrSettings['caps_show_share_count']) && $booShowShareCount == true) {
	
		// get and display share count
		//$htmlShareButtons .= '<span class="caps_sharecount">' . getRedditShareCount($urlCurrentPage) . '</span>';
	//}
	
	// return share buttons
	return $htmlShareButtons;
}

// get reddit share count
function getRedditShareCount($urlCurrentPage) {

	// get results from reddit and return the number of shares
    $htmlRedditShareDetails = wp_remote_fopen('//www.reddit.com/api/info.json?url=' . $urlCurrentPage);
	$arrRedditResult = json_decode($htmlRedditShareDetails, true);
    $intRedditShareCount = (isset($arrRedditResult['data']['children']['0']['data']['score']) ? $arrRedditResult['data']['children']['0']['data']['score'] : 0);
    return ($intRedditShareCount ) ? $intRedditShareCount : '0';
}

// get linkedin button
function caps_linkedin($arrSettings, $urlCurrentPage, $strPageTitle, $booShowShareCount) {

	// linkedin share link
	$htmlShareButtons = '<a title="Share on LinkedIn" class="caps_linkedin_share caps_share_link" href="//www.linkedin.com/shareArticle?mini=true&amp;url=' . $urlCurrentPage  . '" target="_blank" rel="nofollow">';
	
	$htmlShareButtons .= '<span><i class="fa '.$arrSettings.'"></i></span>';
	
	// close href
	$htmlShareButtons .= '</a>';
	
	// if show share count is set to Y
	if (isset($arrSettings['caps_show_share_count']) && $booShowShareCount == true) {
	
		// get and display share count
		$htmlShareButtons .= '<span class="caps_sharecount">' . getLinkedinShareCount($urlCurrentPage) . '</span>';
	}
	
	// return share buttons
	return $htmlShareButtons;
}

// get linkedin share count
function getLinkedinShareCount($urlCurrentPage) {

	// get results from linkedin and return the number of shares
    $htmlLinkedinShareDetails = wp_remote_fopen('//www.linkedin.com/countserv/count/share?url=' . $urlCurrentPage);
	$htmlLinkedinShareDetails = str_replace('IN.Tags.Share.handleCount(', '', $htmlLinkedinShareDetails);
    $htmlLinkedinShareDetails = str_replace(');', '', $htmlLinkedinShareDetails);
    $arrLinkedinShareDetails = json_decode($htmlLinkedinShareDetails, true);
    $intLinkedinShareCount =  $arrLinkedinShareDetails['count'];
    return ($intLinkedinShareCount ) ? $intLinkedinShareCount : '0';
}

// get pinterest button
function caps_pinterest($arrSettings, $urlCurrentPage, $strPageTitle, $booShowShareCount) {

	// pinterest share link
	$htmlShareButtons = "<a title='Pin on Pinterest' class='caps_pinterest_share' href='javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;//assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());'>";
	
	$htmlShareButtons .= '<span><i class="fa '.$arrSettings.'"></i></span>';
	
	// close href
	$htmlShareButtons .= '</a>';
	
	// if show share count is set to Y
	if (isset($arrSettings['caps_show_share_count']) && $booShowShareCount == true) {
	
		$htmlShareButtons .= '<span class="caps_sharecount">' . getPinterestShareCount($urlCurrentPage) . '</span>';
	}
	
	// return share buttons
	return $htmlShareButtons;
}

// get pinterest share count
function getPinterestShareCount($urlCurrentPage) {

	// get results from pinterest and return the number of shares
    $htmlPinterestShareDetails = wp_remote_fopen('//api.pinterest.com/v1/urls/count.json?url=' . $urlCurrentPage);
    $htmlPinterestShareDetails = str_replace('receiveCount(', '', $htmlPinterestShareDetails);
    $htmlPinterestShareDetails = str_replace(')', '', $htmlPinterestShareDetails);
    $arrPinterestShareDetails = json_decode($htmlPinterestShareDetails, true);
    $intPinterestShareCount =  $arrPinterestShareDetails['count'];
    return ($intPinterestShareCount ) ? $intPinterestShareCount : '0';
}

// get stumbleupon button
function caps_stumbleupon($arrSettings, $urlCurrentPage, $strPageTitle, $booShowShareCount) {

	// stumbleupon share link
	$htmlShareButtons = '<a title="Share on StumbleUpon" class="caps_stumbleupon_share caps_share_link" href="//www.stumbleupon.com/submit?url=' . $urlCurrentPage  . '&amp;title=' . $strPageTitle . '" target="_blank" rel="nofollow">';
	
	$htmlShareButtons .= '<span><i class="fa '.$arrSettings.'"></i></span>';
	
	// close href
	$htmlShareButtons .= '</a>';
	
	// if show share count is set to Y
	if (isset($arrSettings['caps_show_share_count']) && $booShowShareCount == true) {
	
		$htmlShareButtons .= '<span class="caps_sharecount">' . getStumbleUponShareCount($urlCurrentPage) . '</span>';
	}
	
	// return share buttons
	return $htmlShareButtons;
}

// get stumbleupon share count
function getStumbleUponShareCount($urlCurrentPage) {

	// get results from stumbleupon and return the number of shares
    $htmlStumbleUponShareDetails = wp_remote_fopen('//www.stumbleupon.com/services/1.01/badge.getinfo?url=' . $urlCurrentPage);
    $arrStumbleUponResult = json_decode($htmlStumbleUponShareDetails, true);
    $intStumbleUponShareCount =  (isset($arrStumbleUponResult['result']['views']) ? $arrStumbleUponResult['result']['views'] : 0);
    return ($intStumbleUponShareCount ) ? $intStumbleUponShareCount : '0';
}

// get email button
function caps_envelope($arrSettings, $urlCurrentPage, $strPageTitle, $booShowShareCount) {

	// email share link
	$htmlShareButtons = '<a title="Email to someone" class="caps_email_share" href="mailto:?Subject=' . $strPageTitle . '&amp;Body=' . $strPageTitle . '%20' . $urlCurrentPage  . '">';
	
	$htmlShareButtons .= '<span><i class="fa '.$arrSettings.'"></i></span>';
	
	// close href
	$htmlShareButtons .= '</a>';
	
	// return share buttons
	return $htmlShareButtons;
}


// get buffer button
function caps_buffer($arrSettings, $urlCurrentPage, $strPageTitle, $booShowShareCount) {

	// buffer share link
	$htmlShareButtons = '<a  title="Buffer this page" class="caps_buffer_share" href="https://bufferapp.com/add?url=' . $urlCurrentPage . '&amp;text=' . ($arrSettings['caps_buffer_text'] != '' ? $arrSettings['caps_buffer_text'] : NULL) . ' ' . $strPageTitle . '" target="_blank" rel="nofollow">';
	
	$htmlShareButtons .= '<span><i class="fa '.$arrSettings.'"></i></span>';
	
	// close href
	$htmlShareButtons .= '</a>';
	
	// return share buttons
	return $htmlShareButtons;
}

// get tumblr button
function caps_tumblr($arrSettings, $urlCurrentPage, $strPageTitle, $booShowShareCount) {

	// check if // is included
	if (preg_match('[//]', $urlCurrentPage)) {
	
		// remove // from URL
		$urlCurrentPage = str_replace('//', '', $urlCurrentPage);			
	} else if (preg_match('[https://]', $urlCurrentPage)) { // check if https:// is included
	
		// remove // from URL
		$urlCurrentPage = str_replace('https://', '', $urlCurrentPage);			
	}

	// strip // or https:// from URL (tumblr doesn't work with this set)
	$urlCurrentPage =  str_replace("//", '', $urlCurrentPage);  

	// tumblr share link
	$htmlShareButtons = '<a title="share on Tumblr" class="caps_tumblr_share" href="//www.tumblr.com/share/link?url=' . $urlCurrentPage . '&amp;name=' . $strPageTitle . '" target="_blank" rel="nofollow">';
	
	$htmlShareButtons .= '<span><i class="fa '.$arrSettings.'"></i></span>';
	
	// close href
	$htmlShareButtons .= '</a>';
	
	// return share buttons
	return $htmlShareButtons;
}

// get print button
function caps_print($arrSettings, $urlCurrentPage, $strPageTitle, $booShowShareCount) {

	// linkedin share link
	$htmlShareButtons = '<a  title="Print this page" class="caps_print caps_share_link" href="#" onclick="window.print()">';
	
	$htmlShareButtons .= '<span><i class="fa '.$arrSettings.'"></i></span>';
	
	// close href
	$htmlShareButtons .= '</a>';

	// return share buttons
	return $htmlShareButtons;
}
	
	// register shortcode [caps] to show [caps_hide]
	add_shortcode( 'caps_share_button', 'caps_buttons' );	
	add_shortcode( 'caps_share_button_hide', 'caps_hide' );	


	
?>
