<div class="row">
<?php
	if(is_page()){
		$page_layout = (get_post_meta(get_the_ID(), 'page_layout', true) != '')? 
	                  get_post_meta(get_the_ID(), 'page_layout', true) : 'rs';
	}else{
		$page_layout = ot_get_option('blog_page_layout', 'rs');
	}

	// Posts are found
	if ( $posts->have_posts() ) {
		while ( $posts->have_posts() ) :
			$posts->the_post();
			global $post;

			
				$total_large = ( $page_layout == 'full' )? 3 : 2;
				$class = ( $page_layout == 'full')? 'col-lg-4 col-md-4 col-sm-6 col-xs-12' : 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
			?>

			<?php 
				if($posts->largebox > 0){
					get_template_part('layouts/large-box', ''); 
					$posts->largebox = $posts->largebox -1;
				}else{
					get_template_part('layouts/small-box', $posts->smallboxtype);
				}
			?>

			<?php
		endwhile;
	}
	// Posts not found
	else {
		echo '<h4>' . __( 'Posts not found', 'su' ) . '</h4>';
	}
?>
</div>

