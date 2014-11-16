<?php
echo '<style>';

/*--------------Background Options-----------------------*/
$background_image = ot_get_option( 'background_image', array() );
$site_layout = ot_get_option( 'site_layout' );
$custom_patterns_images = ot_get_option( 'custom_patterns_images' );
$boxed_width = ot_get_option( 'boxed_width', array(1080, 'px') );



if( $site_layout == 'boxed' ):
if($custom_patterns_images !='' ) { ?>
	.boxed {
		background:url(<?php echo get_template_directory_uri(); ?>/images/pattern-css/<?php echo $custom_patterns_images; ?>.png) repeat;
	}
<?php } ?>

<?php
$measurement = ot_get_option( 'boxed_width' );
if( !empty( $measurement ) ){ 
 echo ".boxed .footer, .boxed section { max-width: ".($measurement[0]+30)."px; }"; 
 echo ".boxed .fixed .container{ max-width: ".($measurement[0]+30)."px; }";
}
?>

<?php 
if( !empty( $background_image ) ){ ?>
.boxed {
	<?php
	foreach( $background_image as $key => $value ){
		if($key == 'background-image') echo ($value != '')? "{$key}: url({$value}); " : "";
		else echo ($value != '')? "{$key}: {$value}; " : "";
	}
?>
}
<?php
}
endif;
?>

<?php
$measurement = ot_get_option( 'boxed_width' );
if( !empty( $measurement ) ){ 
 echo ".container { max-width: " .implode( '', $measurement )."; }"; 
}
?>

<?php

$background_image = ot_get_option( 'footer_bacground_image', array() );
if( !empty( $background_image ) ){ ?>
	.footer-main-container {
		<?php
		foreach( $background_image as $key => $value ){
			if($key == 'background-image') echo ($value != '')? "{$key}: url({$value}); " : "";
			else echo ($value != '')? "{$key}: {$value}; " : "";
		}
	?>
	}
	<?php
	}

$footer_top_bacground_image = ot_get_option( 'footer_top_bacground_image', array() );
if( !empty( $footer_top_bacground_image ) ){ ?>
	#footer .footer-main-container {
		<?php
		foreach( $footer_top_bacground_image as $key => $value ){
			if($key == 'background-image') echo ($value != '')? "{$key}: url({$value}); " : "";
			else echo ($value != '')? "{$key}: {$value}; " : "";
		}
	?>
	}
	<?php
}

/*--------------Typography Options-----------------------*/
$typography = ot_get_option( 'body_fonts_option', array(
                                'font-color' => '#808080',
                                'font-family' => 'OpenSansRegular',
                                'font-size' => '13px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '22px',
                                'text-decoration' => 'none',
                                'text-transform' => 'none',
                            ) );
if(!empty($typography)):
	echo 'body { ';
	foreach ($typography as $key => $value) {
		if($value != ''){ $key = ($key == 'font-color')? 'color' : $key;
			echo $key.': '.$value.'; ';
		}
	}
	echo ' }';
endif;
?>

<?php
$typography = ot_get_option( 'topbar_fonts_option', array(
                                'font-color' => '#949494',
                                'font-family' => 'OpenSansRegular',
                                'font-size' => '13px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'line-height' => 'normal',
                                'letter-spacing' => '0em',
                                'text-decoration' => 'none',
                                
                            ) );
if(!empty($typography)):
	echo '.top-nav-background a { ';
	foreach ($typography as $key => $value) {
		if($value != ''){ $key = ($key == 'font-color')? 'color' : $key;			
			echo $key.': '.$value.'; ';
		}
	}
	echo ' }';
endif;
?>

<?php
$typography = ot_get_option( 'menu_fonts_option', array(
                                'font-color' => '#373737',
                                'font-family' => 'OpenSansRegular',
                                'font-size' => '14px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'text-decoration' => 'none',
                                'text-transform' => 'uppercase',
                            ) );
if(!empty($typography)):
	echo '.header .navbar-nav a { ';
	foreach ($typography as $key => $value) {
		if($value != ''){ $key = ($key == 'font-color')? 'color' : $key;
			echo $key.': '.$value.'; ';
		}
	}
	echo ' }';
endif;
?>

<?php
$typography = ot_get_option( 'submenu_fonts_option', array(
                                'font-color' => '#636363',
                                'font-family' => 'OpenSansRegular',
                                'font-size' => '13px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '22px',
                                'text-decoration' => 'none',
                                'text-transform' => 'none',
                            ) );
if(!empty($typography)):
	echo '.header .navbar-nav ul a { ';
	foreach ($typography as $key => $value) {
		if($value != ''){ $key = ($key == 'font-color')? 'color' : $key;
			echo $key.': '.$value.'; ';
		}
	}
	echo ' }';
endif;
?>

<?php
$typography = ot_get_option( 'footer_heading_font_options', array(
                                'font-color' => '#FFFFFF',
                                'font-family' => 'OpenSansRegular',
                                'font-size' => '14px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '46px',
                                'text-decoration' => 'none',
                                'text-transform' => 'uppercase',
                            ) );
if(!empty($typography)):
	echo '.footer h3 { ';
	foreach ($typography as $key => $value) {
		if($value != ''){ $key = ($key == 'font-color')? 'color' : $key;
			echo $key.': '.$value.'; ';
		}
	}
	echo ' }';
endif;
?>

<?php
$typography = ot_get_option( 'footer_font_color', array(
                                'font-color' => '#d1d1d1',
                                'font-family' => 'OpenSansRegular',
                                'font-size' => '13px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '22px',
                                'text-decoration' => 'none',
                                'text-transform' => 'none',
                            ) );
if(!empty($typography)):
	echo '.footer p { ';
	foreach ($typography as $key => $value) {
		if($value != ''){ $key = ($key == 'font-color')? 'color' : $key;
			echo $key.': '.$value.'; ';
		}
	}
	echo ' }';
endif;
?>

<?php
$typography = ot_get_option( 'footer_link_color', array(
                                'font-color' => '#d1d1d1',
                                'font-family' => 'OpenSansRegular',
                                'font-size' => '13px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '22px',
                                'text-decoration' => 'none',
                                'text-transform' => '',
                            ) );
if(!empty($typography)):
	echo '.footer a { ';
	foreach ($typography as $key => $value) {
		if($value != ''){ $key = ($key == 'font-color')? 'color' : $key;
			echo $key.': '.$value.'; ';
		}
	}
	echo ' }';
endif;
?>

<?php
$typography = ot_get_option( 'heading_font_size_h1', array(
                                'font-color' => '#373737',
                                'font-family' => 'OpenSansBold',
                                'font-size' => '36px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '50px',
                                'text-decoration' => 'none',
                                'text-transform' => 'uppercase',
                            ) );
if(!empty($typography)):
	echo 'h1 { ';
	foreach ($typography as $key => $value) {
		if($value != ''){ $key = ($key == 'font-color')? 'color' : $key;
			echo $key.': '.$value.'; ';
		}
	}
	echo ' }';
endif;
?>

<?php
$typography = ot_get_option( 'heading_font_size_h2', array(
                                'font-color' => '#373737',
                                'font-family' => 'OpenSansBold',
                                'font-size' => '24px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '40px',
                                'text-decoration' => 'none',
                                'text-transform' => 'uppercase',
                            ) );
if(!empty($typography)):
	echo 'h2 { ';
	foreach ($typography as $key => $value) {
		if($value != ''){ $key = ($key == 'font-color')? 'color' : $key;
			echo $key.': '.$value.'; ';
		}
	}
	echo ' }';
endif;
?>

<?php
$typography = ot_get_option( 'heading_font_size_h3', array(
                                'font-color' => '#373737',
                                'font-family' => 'OpenSansSemiBold',
                                'font-size' => '18px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '30px',
                                'text-decoration' => 'none',
                                'text-transform' => 'uppercase',
                            ) );
if(!empty($typography)):
	echo 'h3 { ';
	foreach ($typography as $key => $value) {
		if($value != ''){ $key = ($key == 'font-color')? 'color' : $key;
			echo $key.': '.$value.'; ';
		}
	}
	echo ' }';
endif;
?>

<?php
$typography = ot_get_option( 'heading_font_size_h4', array(
                                'font-color' => '#373737',
                                'font-family' => 'OpenSansSemiBold',
                                'font-size' => '16px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '24px',
                                'text-decoration' => 'none'
                            ) );
if(!empty($typography)):
	echo 'h4 { ';
	foreach ($typography as $key => $value) {
		if($value != ''){ $key = ($key == 'font-color')? 'color' : $key;
			echo $key.': '.$value.'; ';
		}
	}
	echo ' }';
endif;
?>

<?php
$typography = ot_get_option( 'heading_font_size_h5', array(
                                'font-color' => '#636363',
                                'font-family' => 'OpenSansSemiBold',
                                'font-size' => '13px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '22px',
                                'text-decoration' => 'none',
                                'text-transform' => '',
                            ) );
if(!empty($typography)):
	echo 'h5 { ';
	foreach ($typography as $key => $value) {
		if($value != ''){ $key = ($key == 'font-color')? 'color' : $key;
			echo $key.': '.$value.'; ';
		}
	}
	echo ' }';
endif;
?>

<?php
$typography = ot_get_option( 'heading_font_size_h6', array(
                                'font-color' => '#373737',
                                'font-family' => 'OpenSansBold',
                                'font-size' => '12px',
                                'font-style' => 'normal',
                                'font-variant' => 'normal',
                                'font-weight' => 'normal',
                                'letter-spacing' => '0em',
                                'line-height' => '18px',
                                'text-decoration' => 'none',
                                'text-transform' => 'uppercase',
                            ) );
if(!empty($typography)):
	echo 'h6 { ';
	foreach ($typography as $key => $value) {
		if($value != ''){ $key = ($key == 'font-color')? 'color' : $key;
			echo $key.': '.$value.'; ';
		}
	}
	echo ' }';
endif;
?>

<?php
$measurement = ot_get_option( 'breadcrumbs_font_size', array(13, 'px') );
if( !empty( $measurement ) ){ 
 echo ".bredcrumbs li, .bredcrumbs a { font-size: " .implode( '', $measurement )."; }"; 
}
?>

<?php
$measurement = ot_get_option( 'page_title_font_size', array(24, 'px') );
if( !empty( $measurement ) ){ 
 echo ".page-title { font-size: " .implode( '', $measurement )."; }"; 
}
?>

<?php
$measurement = ot_get_option( 'sidebar_widget_title_font_size', array(14, 'px') );
if( !empty( $measurement ) ){ 
 echo ".sidebar h3 { font-size: " .implode( '', $measurement )."; }"; 
}
?>

<?php
$measurement = ot_get_option( 'copyright_text_font_size', array(13, 'px') );
if( !empty( $measurement ) ){ 
 echo ".copyright { font-size: " .implode( '', $measurement )."; }"; 
}
?>

<?php
  $slides = ot_get_option( 'category_color', array() );  
  if ( ! empty( $slides ) ) {
    foreach( $slides as $slide ) {
      echo '.category-'.$slide['category'].' { background-color : '.$slide['category_color'].' !important ;}';
    }
  }
?>


<?php
echo '.subtitle:before { color: '.ot_get_option( 'sticky_color', '#f16261' ).'}';
echo '.subtitle { background-color: '.ot_get_option( 'sticky_color', '#f16261' ).'}';

?>



<?php
echo 'a{ color: '.ot_get_option( 'link_color' ).'}';
echo '.footer a:hover{ color: '.ot_get_option( 'footer_link_hover_color' ).'}';
/*---------------styling options----------------------*/
$primary_color = ot_get_option( 'primary_color' );
echo "body { color: {$primary_color}; }";

$header_top_background_color = ot_get_option( 'header_top_background_color', "#3A3A3A" );
echo ".top-nav-background, .footer { background-color: {$header_top_background_color}; }";

$header_background_color = ot_get_option( 'header_background_color', '#FFFFFF' );
echo ".header { background-color: {$header_background_color}; }" ;

$header_border_color = ot_get_option( 'header_border_color', '#EAEAEA' );
echo ".main-menu-header, .form-search i, .navbar-nav > li, .nav li ul { border-color: {$header_border_color}; }";

$content_background_color = ot_get_option( 'content_background_color', "#FFFFFF" );
echo ".main-container{ background-color: {$content_background_color}; }";
$footer_background_color = ot_get_option( 'footer_background_color', array() );


$sidebar_background_color = ot_get_option( 'sidebar_background_color' , "#FFFFFF");
echo ".sidebar { background-color: {$sidebar_background_color}; }";

$link_color = ot_get_option( 'link_color', '#3A3A3A' );
echo "a { color: {$link_color}; }";

$css_code = ot_get_option( 'css_code' );
echo ( $css_code != '' )? $css_code: '';
?>
@media (min-width: 768px) {
}
<?php echo '</style>'; ?>
