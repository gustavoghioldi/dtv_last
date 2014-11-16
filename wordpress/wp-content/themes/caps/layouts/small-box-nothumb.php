<?php	
$column = isset($posts->smallboxcolumn)? $posts->smallboxcolumn : 2;
$excerptlength = isset($posts->excerptlength)? $posts->excerptlength : 20;
$smallboxexcerpt = isset($posts->smallboxexcerpt)? $posts->smallboxexcerpt : 'no';
$smallboxcomment = isset($posts->smallboxcomment)? $posts->smallboxcomment : 'no';
$smallboxbg = isset($posts->smallboxbg)? $posts->smallboxbg : 'yes';
$imgwidth = ($column == 1)? 400 :  round(400 / $column);
$imgheight = $imgwidth;

$thumbclass = ($smallboxbg == 'yes')? '' : ' trans-bg';

$sticky_text = ot_get_option('sticky_text');

$class = "col-lg-".(12/$column)." col-md-".(12/$column)." col-sm-".(12/$column)." col-xs-12";
?>

<div class="<?php echo $class; ?>">
	
	<div class="small-box-content no-thumb<?php echo $thumbclass ?>">	
		
			<h5>
				<i class="genericon genericon-rightarrow"></i>
				<a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
				 <?php echo (is_sticky(get_the_ID()) && ($sticky_text != ''))? '<span class="subtitle">Hot</span>' : ''; ?> 
				 <?php echo ($smallboxcomment != 'no')? '<span class="count-comment"><a href="'.get_comments_link().'"><i class="fa fa-comment-o"></i>'.get_comments_number( ).'</a></span>' : ''; ?>
			</h5>
			<?php echo (($smallboxexcerpt != 'no') && ($excerptlength > 0))? '<p>'.wp_trim_words(get_the_excerpt(), $excerptlength).'</p>' : '';  ?>
		
	</div>

</div>

			