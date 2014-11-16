<?php
/**
 * Custom Walker
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
class Caps_mega_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
      {
           global $wp_query;

           $megamenu = 0;
           $column = 1;
           if($depth == 1){            
                $column = get_post_meta( $item->menu_item_parent, '_menu_item_column', true );
                $megamenu = get_post_meta( $item->menu_item_parent, '_menu_item_megamenu', true );
				if($column == 0) $column = 4;
				
           }

           if($column == 1) $tl = 100;
           elseif($column == 2) $tl = 50;
		   elseif($column == 3) $tl = 30;
		   else $tl = 20;
		   

           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;
		
           $labelclass = ' lavel';
           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );          
           $class_megamenu = ( $item->megamenu == 1 )? ' megamenu': '';
           if(in_array('cat-posts', $item->classes)) $class_megamenu .= ' menu-item-has-children';
		  

           if($megamenu >= 1 ){
            $class_megamenu .= ' mm-columns col-lg-'.(12/$column). ' col-md-'.(12/$column). ' col-sm-'.(12/$column);
           }
           $class_names = ' class="'. esc_attr( $class_names ) .$class_megamenu. $labelclass.'"';

           
           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names.'>';
           
         

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';


           $prepend = '';
           $append = '';
           $description  = ! empty( $item->description ) ? '<span class="description">'.esc_attr( $item->description ).'</span>' : '';
          
           

            $item_output = $args->before;

            if(in_array('cat-posts', $item->classes)){
            	
            	// WP_Query arguments
				$arg = array (
					'post_type'              => 'post',
					'category_name'          => $item->classes[0],
					'pagination'             => false,
					'posts_per_page'         => $item->showposts,
					'ignore_sticky_posts'    => false,
				);

				// The Query
				$myposts = get_posts( $arg );
				if($depth == 0){
					$column = $item->column;
	            	if($item->megamenu == 1 ){
		            	$class_megamenu .= ' mm-columns col-lg-'.(12/$column). ' col-md-'.(12/$column). ' col-sm-'.(12/$column);
		           	}

	            	if($column == 1) $tl = 100;
		           	elseif($column == 2) $tl = 50;
				   	elseif($column == 3) $tl = 30;
				   	else $tl = 20;
					$item_output .= '<a'. $attributes .'>';
					$item_output .=  ($depth == 0)? '<span>' : '';
					$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append.$args->link_after;
					$item_output .= ($item->subtitle != '')? '<span class="subtitle">'.esc_attr($item->subtitle).'</span>' : '';
					$item_output .=  ($depth == 0)? '</span>' : '';
					$item_output .= ($description !='')? '<p class="desc">'.wp_trim_words($description, 18).'</p>' : '';
					$item_output .=  '</a>';
					

					$cls = 'sub-menu';
				}else{
					//$item_output .= ( $megamenu == 0 )? '<a class="parent" href="'.$item->url.'">'.$item->title.'</a>' : '';
					$item_output .= '<h4><a class="parent" href="'.$item->url.'">'.$item->title.'</a></h4>' ;
					$cls = 'recent-posts';
            		$class_megamenu = '';
				} 
				$thumbshow = '<ul class="'.$cls.'">';
				foreach ( $myposts as $post ) : setup_postdata( $post );
						$thumbshow .= '<li class="'.$class_megamenu.'">';
						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
						if($item->displaypost == 'small'){
							$title = (strlen ( get_the_title($post->ID) ) > ($tl-3) )? substr( get_the_title($post->ID), 0, ($tl-1)).'..' : get_the_title($post->ID);
							$thumbshow .= '<div class="single-content-small">';
							$thumbshow .= '<div class="image-wrap">
							<img alt="'.$title.'" src="'.caps_image_resize( $large_image_url[0], 100, 100, true, 'c', false ).'"></div>';
							$thumbshow .= '<div class="right-desc">
							<h5><a href="'.get_permalink($post->ID).'">'.$title.'</a></h5>
							<span class="date-meta"><i class="genericon genericon-time"></i>'.get_the_date( 'M d, Y' ).'</span></div></div>';

						}else{
							$thumb = caps_image_resize( $large_image_url[0], 300, 200, true, 'c', false );
						   	$thumbshow .= '<div class="thumb-details">';
							  if ( has_post_thumbnail($post->ID)) {
							   $thumbshow .= '<div class="image"><a href="'.get_permalink($post->ID).'"><img src="'.$thumb.'" alt="'.get_the_title($post->ID).'"></a></div>';
							   }
						    
							$title = (strlen ( get_the_title($post->ID) ) > ($tl+10) )? substr( get_the_title($post->ID), 0, ($tl+8)).'..' : get_the_title($post->ID);
							$thumbshow .= '<div class="desc"><h5><a href="'.get_permalink($post->ID).'">'.$title.'</a></h5>';											
							$thumbshow .= '<span class="date-meta"><i class="genericon genericon-time"></i>'.get_the_date( 'M d, Y' ).'</span>';
						   	$thumbshow .= '</div>';
						   	$thumbshow .= '</div>';
						}
						$thumbshow .= '</li>';
				endforeach; 
				$thumbshow .= '</ul>';
				$item_output .= $thumbshow ;

            }else{

	            if(($item->thumb == 1) && ($item->type == 'post_type')){
				  
				    
						   $p = get_post($item->object_id);
						   $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($item->object_id), 'large');
						   $thumb = caps_image_resize( $large_image_url[0], 300, 200, true, 'c', false );
						   $thumbshow = '<div class="thumb-details">';
						  if ( has_post_thumbnail($item->object_id)) {
						   $thumbshow .= '<div class="image"><a href="'.$item->url.'"><img src="'.$thumb.'" alt="'.$item->title.'"></a></div>';
						   }
						    
							$title = (strlen ( $item->title ) > $tl )? substr( $item->title, 0, ($tl-2)).'..' : $item->title;
							$thumbshow .= '<div class="desc"><h5><a href="'.$item->url.'">'.$title.'</a></h5>';											
							$thumbshow .= ( get_post_type( $item->object_id ) == 'post' )? '<span class="date-meta"><i class="genericon genericon-time"></i>'.get_the_date( 'M d, Y' ).'</span>' : '';
						   $thumbshow .= '</div>';
						   $thumbshow .= '</div>';
						  
						   $item_output .= $thumbshow ;
						 
				  
				}else{
					$item_output .= '<a'. $attributes .'>';
					$item_output .=  ($depth == 0)? '<span>' : '';
					$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append.$args->link_after;            
					$item_output .= ($item->subtitle != '')? '<span class="subtitle">'.esc_attr($item->subtitle).'</span>' : '';
					$item_output .=  ($depth == 0)? '</span>' : '';
					$item_output .= ($description !='')? '<p class="desc">'.wp_trim_words($description, 18).'</p>' : '';
					$item_output .= '</a>';
					
				}
			}
            $item_output .= $args->after;



            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
		
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu\">\n";
	}

}