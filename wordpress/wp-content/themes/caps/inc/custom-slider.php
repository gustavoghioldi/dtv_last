<?php
	$page_layout = (get_post_meta(get_the_ID(), 'page_layout', true) != '')? get_post_meta(get_the_ID(), 'page_layout', true) : 'rs';
	$slider_width = ot_get_option('slider_width');
	$slider_height = ot_get_option('slider_height');
	$width = ($page_layout == 'full') ? $slider_width : round($slider_width * 2 / 3);
	$height = ($page_layout == 'full') ? $slider_height : round($slider_height * 2 / 3);

	$slider = ot_get_option('custom_slider', array());
	
?>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 slider-wrap">
		<?php	
		if ( !empty($slider) ):        	       
			echo '<div class="main-slider">';
			foreach($slider as $slide):
					if($slide['image'] != ''):
					
					$url = caps_image_resize( $slide['image'], $width, $height, true, 'c', false );
					echo '<div class="item">';
						echo '<div class="img-wrap"><img class="lazyOwl" src="'.$url.'" alt="'.get_the_title().'"></div>';						
						echo '<div class="slideinfo scaleUp">';
							echo ($slide['title'] != '' )? '<h3>'.$slide['title'].'</h3>': '';
							echo ($slide['desc'] != '' )?'<p>'.$slide['desc'].'</p>' : '';
							$link = ($slide['button_link'] != '')? $slide['button_link'] : '#';
							echo ($slide['button_text'] != '' )?'<p class="tagcloud"><a href="'.$link.'">'.$slide['button_text'].'</a></p>' : '';
						echo '</div>';						
						
					echo '</div>';
					endif;
			endforeach;
			echo '</div>';
		else:
			echo 'No slide image found. You can add image from theme option.';	
		endif;
		
		?>
	</div>
	
</div>