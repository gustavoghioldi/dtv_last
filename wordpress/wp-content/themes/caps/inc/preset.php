<?php
$custom_color = ot_get_option( 'custom_color', '#019877' );
/*--------------start frontend settings-----------------------*/
$custom_color = isset($_COOKIE['color'])? '#'.$_COOKIE['color'] : $custom_color; 

if($custom_color == ''){
	$custom_color = '#019877';
}

function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   $rgb_color = implode(",", $rgb); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
   return $rgb_color;
}
?>
<style type="text/css">

.main-slider .owl-prev,
.main-slider .owl-next{
   background: rgba(<?php echo hex2rgb($custom_color); ?>,.8);
}

.review-total-only.small-thumb:before,
.button-primary:active,
.button-primary:focus,
.button-primary:hover,
.wpcf7-submit:hover,
.wpcf7-submit:focus,
.wpcf7-submit:active,
#submit:active,
#submit:focus,
#submit:hover,
.search-submit:active,
.search-submit:focus,
.search-submit:hover,
.eemail_textbox_button:hover,
.read-more-post:active,
.read-more-post:focus,
.read-more-post:hover,
 .tagcloud a:active,
.tagcloud a:focus,
.tagcloud a:hover,
.latest-title > span:after,
.nav > li > a:focus,
.toggleMenu.active,
a:hover,
a:focus {
	color: <?php echo $custom_color; ?> !important;
}

.sidebar .review-total-star,
.review-total-only.small-thumb.review-total-only,
.caps_review_tab_widget_content .tab_title.selected a:before,
ul.pop-widget-tabs li a.active:before,
.caps-share-buttons .share-icons a:hover,
.button-primary,
.sidebar .widget_loginwithajaxwidget > div,
.sidebar .share-icons a:hover,
.search-submit,
.widget_calendar #wp-calendar caption,
.main-container #searchsubmit,
.container .jbmww_wrapper .jbww_head,
.JBWeatherWidget,
.widget_caps_weather_widget,
.jbmww_wrapper .jbww_head,
.pagination li a:hover,
.pagination li.active a,
.EO_Event_List_Widget,
.latest-title > span,
.right-menu,
.footer-widget .tagcloud a,
.navbar-nav > .current-menu-item a > span:before,
.navbar-nav li:hover > a > span:before,
#panel .content,
.read-more-post,
.comment-submit-button {
	background: <?php echo $custom_color; ?>;
}

body .slide-cat:hover{
   background: <?php echo $custom_color; ?> !important;
}

.tagcloud a,
.footer-widget h3 span:after,
 button#load-more.loading,
.title:after,
.wpcf7-submit,
.eemail_textbox_button,
.sidebar .jbmww_wrapper .jbww_search_bar a.searchButton{
	background-color: <?php echo $custom_color; ?>;
}

.form-control:focus {
	border-color: <?php echo $custom_color; ?>;
	box-shadow: none;
	-ms-box-shadow: none;
	-o-box-shadow: none;
	-webkit-box-shadow: none;
}

.nav li ul {
	border-bottom-color: <?php echo $custom_color; ?>!important;
}

.button-primary:active,
.button-primary:focus,
.button-primary:hover,
.wpcf7-submit:hover,
.wpcf7-submit:focus,
.wpcf7-submit:active,
#submit:active,
#submit:focus,
#submit:hover,
.search-submit:active,
.search-submit:focus,
.search-submit:hover,
.eemail_textbox_button:hover,
.read-more-post:active,
.read-more-post:focus,
.read-more-post:hover,
.tagcloud a:active,
 .tagcloud a:focus,
 .tagcloud a:hover,
ul.pop-widget-tabs li a.active span:before,
blockquote{
   border-color: <?php echo $custom_color; ?>;
}

blockquote:before{
  <?php echo (is_rtl())? 'border-right-color' : 'border-left-color' ; ?> : <?php echo $custom_color; ?>;
}

</style>