<?php

	/*
	*	Goodlayers Blog Item File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Goodlayers
	* 	@link		http://goodlayers.com
	* 	@copyright	Copyright (c) Goodlayers
	*	---------------------------------------------------------------------
	*	This file contains the function that can print each blog item due to 
	*	different conditions.
	*	---------------------------------------------------------------------
	*/
	
	// Print blog item
	function print_blog_item($item_xml){
		$additional = ''; $additional_html = '';
		
		$blog_type = find_xml_value($item_xml, 'blog-type');
		if( $blog_type == 'Carousel' ){
			$additional = 'navigation-on';
		}
		
		$offset = find_xml_value($item_xml, 'offset');
		$pagination = find_xml_value($item_xml, "pagination");	
		$view_all_blog = find_xml_value($item_xml, 'read-the-blog');
		if( !empty($view_all_blog) && $view_all_blog != 'None' ){
			global $gdl_admin_translator;	
			if( $gdl_admin_translator == 'enable' ){
				$translator_view = get_option(THEME_SHORT_NAME.'_translator_read_the_blog', 'Read The Blog');
			}else{
				$translator_view = __('Read The Blog','gdl_front_end');
			}		
			$additional_html = '<a href="' . get_permalink(get_page_by_path($view_all_blog));
			$additional_html = $additional_html . '" class="view-all-projects">';
			$additional_html = $additional_html . $translator_view . '</a>';
		}		
		print_item_header( find_xml_value($item_xml, 'header'), $additional, 
			$additional_html, find_xml_value($item_xml, 'icon-class') );
		global $paged, $sidebar_type, $blog_div_size_num_class;
		
		if(empty($paged)){ $paged = (get_query_var('page')) ? get_query_var('page') : 1; }
		if($pagination == "No"){ $paged = 1; }
		if($paged != '1'){ $offset = 0; }
		
		// get the item class and size from array
		$item_type = find_xml_value($item_xml, 'item-size');
		$item_class = $blog_div_size_num_class[$item_type]['class'];
		$item_size = $blog_div_size_num_class[$item_type][$sidebar_type];
				
		// get the blog meta value		
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		$full_content = find_xml_value($item_xml, 'show-full-blog-post');
		$blog_thumbnail = find_xml_value($item_xml, 'show-thumbnail');
		if( $blog_thumbnail == 'No' ){ $item_size = ''; }
		
		$category = find_xml_value($item_xml, 'category', false);
		$category = ( $category == 'All' )? '': $category;

		$order = find_xml_value($item_xml, 'order');
		$orderby = find_xml_value($item_xml, 'orderby');		
		
		// start fetching database
		query_posts(array('post_type'=>'post', 'paged'=>$paged, 'order'=>$order, 'orderby'=>$orderby,
			 'category_name'=>$category, 'posts_per_page'=>$num_fetch, 'offset'=>$offset  ));		
		$site_title = get_bloginfo( 'name' );
		// printing each blog function
		echo '<div class="blogtitle"><h2><a href="' . home_url() . '">'.$site_title.'</a></h2></div>';
		echo '<div class="blog-item-holder">';
		if( $item_type == '1/4 Blog Widget' || $item_type == '1/3 Blog Widget' || 
			$item_type == '1/2 Blog Widget' || $item_type == '1/1 Blog Widget'){
			
			if( $blog_type == 'Carousel' ){
				print_blog_widget_carousel($item_class, $item_size, $num_excerpt, $full_content, $item_type);
			}else{
				print_blog_widget($item_class, $item_size, $num_excerpt, $full_content, $item_type);
			}
		}else if( $item_type == '1/1 Blog List' ){
			print_blog_list($item_class, $item_size);
		}else if( $item_type == '1/1 Medium Thumbnail' ){
			print_blog_medium($item_class, $item_size, $num_excerpt, $full_content);
		}else if( $item_type == '1/1 Full Thumbnail' ){	
			print_blog_full($item_class, $item_size, $num_excerpt, $full_content);
		}
		echo '</div>';
		
		echo '<div class="clear"></div>';
		if( $pagination == "Yes" ){	
			pagination();
		}	
		
		wp_reset_query();
	}	
	
	// print the blog thumbnail
	function print_blog_thumbnail( $post_id, $item_size ){
		if( empty($item_size) ){ return ''; }
	
		$thumbnail_types = get_post_meta( $post_id, 'post-option-thumbnail-types', true);
		if( $thumbnail_types == "Image" || empty($thumbnail_types) ){
			$thumbnail_id = get_post_thumbnail_id( $post_id );
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
			$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
			if( !empty($thumbnail) ){
			    //echo '<div class="blogtitle"><h2><a href="' . home_url() . '">The Etsy Blog</a></h2></div>';
				echo '<div class="blog-media-wrapper gdl-image">';
				echo '<a href="' . get_permalink() . '"><img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/></a>';
				echo '</div>';	// blog-media-wrapper
			}
		}else if( $thumbnail_types == "Video" ){
			$video_link = get_post_meta( $post_id, 'post-option-thumbnail-video', true); 
			echo '<div class="blog-media-wrapper gdl-video">';
			echo get_video($video_link, gdl_get_width($item_size), gdl_get_height($item_size));
			echo '</div>';	// blog-media-wrapper
		}else if ( $thumbnail_types == "Slider" ){
			$slider_xml = get_post_meta( $post_id, 'post-option-thumbnail-xml', true); 
			$slider_xml_dom = new DOMDocument();
			$slider_xml_dom->loadXML($slider_xml);
			echo '<div class="blog-media-wrapper gdl-slider">';
			echo print_flex_slider($slider_xml_dom->documentElement, $item_size);
			echo '</div>';	// blog-media-wrapper
		}else if ( $thumbnail_types == "HTML5 Video" ){
			$video = get_post_meta( $post_id, 'post-option-thumbnail-html5-video', true); 
			echo '<div class="blog-media-wrapper gdl-html5-video">';
			get_html5_video($video);
			echo '</div>';	// blog-media-wrapper		
		}	
	}
	
	// print the blog thumbnail
	function print_single_blog_thumbnail( $post_id, $item_size ){
		$thumbnail_types = get_post_meta( $post_id, 'post-option-inside-thumbnail-types', true);
		if( $thumbnail_types == "Image" || empty($thumbnail_types) ){
			$thumbnail_id = get_post_meta( $post_id, 'post-option-inside-thumbnial-image', true);
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
			$thumbnail_full = wp_get_attachment_image_src( $thumbnail_id , 'full' );
			$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
			if( !empty($thumbnail) ){
				echo '<div class="blog-media-wrapper gdl-image">';
				echo '<a href="' . $thumbnail_full[0] . '" data-rel="fancybox" title="' . get_the_title() . '">';
				echo '<img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/>';
				echo '</a>';
				echo '</div>';	// blog-media-wrapper
			}
		}else if( $thumbnail_types == "Video" ){
			$video_link = get_post_meta( $post_id, 'post-option-inside-thumbnail-video', true);
			echo '<div class="blog-media-wrapper gdl-video">';
			echo get_video($video_link, gdl_get_width($item_size), gdl_get_height($item_size));
			echo '</div>';	// blog-media-wrapper
		}else if ( $thumbnail_types == "Slider" ){
			$slider_xml = get_post_meta( $post_id, 'post-option-inside-thumbnail-xml', true);
			$slider_xml_dom = new DOMDocument();
			$slider_xml_dom->loadXML($slider_xml);
			echo '<div class="blog-media-wrapper gdl-slider">';
			echo print_flex_slider($slider_xml_dom->documentElement, $item_size);
			echo '</div>';	// blog-media-wrapper
		}else if ( $thumbnail_types == "HTML5 Video" ){
			$video = get_post_meta( $post_id, 'post-option-inside-thumbnail-html5-video', true); 
			echo '<div class="blog-media-wrapper gdl-html5-video">';
			get_html5_video($video);
			echo '</div>';	// blog-media-wrapper		
		}		
	}	
	
	// print blog widget type
	
	
	function print_blog_widget( $item_class, $item_size, $num_excerpt, $full_content, $blog_size ){
	
		global $more, $gdl_date_format, $gdl_admin_translator;

		if( $gdl_admin_translator == 'enable' ){
			$translator_continue_reading = get_option(THEME_SHORT_NAME.'_translator_continue_reading', 'Continue Reading');
		}else{
			$translator_continue_reading = __('Continue Reading ','gdl_front_end');
		}	
		
		if( $full_content == 'Yes' ){ $more = 0; }
		
		$blog_row_size = 0;
		$blog_size = str_replace(' Blog Widget', '', $blog_size);
		$i=0;
		while( have_posts() ){
			the_post();
			if($i==0)
			{
        /*echo "this is the first post in the loop, output larger size, full content, etc.";*/
				
			$blog_row_size = print_item_size($blog_size, $blog_row_size, $item_class . '');
			
			// blog content
			echo '<div class="blog-content-wrapper">';
			
			// blog thumbnail
print_blog_thumbnail( get_the_ID(), $item_size );			
			
			echo '<h2 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';

				
			
			echo '<div class="blog-content">';
			if( $full_content == "No" ){
				echo gdl_get_excerpt( $num_excerpt, '... ' );	
			}else{
				the_content($translator_continue_reading);
			}			
			echo '</div>'; // blog content
			//blog information
			echo '<div class="blog-info-wrapper">';
			echo '<div class="author-info">'; ?>
			By : <span class="author-decor"><?php the_author_posts_link(get_the_ID()); ?></span>
            <?php
			echo '</div>';
            echo '<div class="blog-meta-large-post">Published:'.get_the_time('M j, Y ').'</div>';
			
			echo '<div class="blog-meta-large-comment">';
			echo'<span class="blog-info-divider">';
			comments_popup_link( __('0 Comment','gdl_front_end'),
				__('1 Comment','gdl_front_end'),
				__('% Comments','gdl_front_end'), '',
				__('Comments are Off','gdl_front_end') );
				echo'</span>';
			echo '</div>';		
			echo '<div class="clear"></div>';
			echo '</div>'; // blog info wrapper		
			echo '</div>'; // blog content wrapper
			
			echo '</div>'; // item_class
			$i++;
			}
			else
			{
			$blog_row_size = print_item_size($blog_size, $blog_row_size, $item_class . '');
			
			// blog content
			echo '<div class="blogwrappertwo">';
			
			echo '<div class="blog-image">';// blog thumbnail
//print_blog_thumbnail( get_the_ID(), $item_size );
print_blog_thumbnail( get_the_ID(), 'full' );			
			
			echo '</div>';
			echo '<h2 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';

					
			
			echo '<div class="blog-content">';
			if( $full_content == "No" ){
			    echo '<p class="extcontent">';
				echo gdl_get_excerpt( $num_excerpt, '...' );	
				echo '</p>';
			}else{
				the_content($translator_continue_reading);
			}	
			
			// blog information
		    echo '<div class="blog-info-wrapper">';  //
			echo '<div class="author-info">'; ?>
			By : <span class="author-decor"><?php the_author_posts_link(get_the_ID()); ?></span>
            <?php
            echo '<div class="blog-date">Published:'.get_the_time('M j, Y ').'</div>';
			echo '</div>';
			
			
			echo '<div class="blog-comment">';
			echo'<span>';
			comments_popup_link( __('0 Comment','gdl_front_end'),
				__('1 Comment','gdl_front_end'),
				__('% Comments','gdl_front_end'), '',
				__('Comments are Off','gdl_front_end') );
				echo '</span>';
			echo '</div>';		
			echo '<div class="clear"></div>';
			echo '</div>'; // blog info wrapper			
			echo '</div>'; // blog content
			
			
			echo '</div>'; // blog content wrapper
			
			echo '</div>'; // item_class
			$i++;
			}
			
		}
			
    
		
		echo '<div class="clear"></div>';
		echo '</div>'; // close row
		 
	
		
	}
		
	// print blog widget type
	function print_blog_widget_carousel( $item_class, $item_size, $num_excerpt, $full_content, $blog_size ){
		global $more, $gdl_date_format, $gdl_admin_translator;

		if( $gdl_admin_translator == 'enable' ){
			$translator_continue_reading = get_option(THEME_SHORT_NAME.'_translator_continue_reading', 'Continue Reading');
		}else{
			$translator_continue_reading = __('Continue Reading ','gdl_front_end');
		}	
		
		if( $full_content == 'Yes' ){ $more = 0; }
		
		$blog_row_size = 0;
		$blog_size = str_replace(' Blog Widget', '', $blog_size);
		
		echo '<div class="blog-carousel-wrapper">';

		echo '<div class="blog-nav-wrapper">';
		echo '<a class="blog-nav left" ></a>';
		echo '<a class="blog-nav right" ></a>';
		echo '</div>'; // blog-nav-wrapper				
		
		echo '<div class="blog-carousel-holder row" data-index="0">';
		while( have_posts() ){
			the_post();
			
			print_item_size($blog_size, 0.1, $item_class . '');

			// blog content
			echo '<div class="blog-content-wrapper">';
			// blog thumbnail
			print_blog_thumbnail( get_the_ID(), $item_size );			
			
			echo '<h2 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';

			// blog information
            echo '<div class="blog-info-wrapper">';
			echo '<div class="author-info">Posted by:'.get_the_author(get_the_ID()).'</div>';
            echo '<div class="blog-date">Published:'.get_the_time('M j, Y ').'</div>';
			echo '<div class="clear"></div>';
			 			
			echo '<div class="blog-comment"><span class="blog-info-divider">|</span>';
			comments_popup_link( __('0 Comment','gdl_front_end'),
				__('1 Comment','gdl_front_end'),
				__('% Comments','gdl_front_end'), '',
				__('Comments are Off','gdl_front_end') );
			echo '</div>';		
			echo '<div class="clear"></div>';
			echo '</div>'; // blog info wrapper			
			
			echo '<div class="blog-content">';
			if( $full_content == "No" ){
				echo gdl_get_excerpt( $num_excerpt, '... ' );	
			}else{
				the_content($translator_continue_reading);
			}			
			echo '</div>'; // blog content
			echo '</div>'; // blog content wrapper
			
			echo '</div>'; // item_class
		}
		echo '</div>'; // blog carousel holder
		
		echo '<div class="clear"></div>';
		echo '</div>'; // gdl-carousel-wrapper		
	}	

	// print blog list type
	function print_blog_list( $item_class, $item_size ){
		global $gdl_date_format;

		while( have_posts() ){
			the_post();

			echo '<div class="' . $item_class . '">'; 

			// blog thumbnail
			echo '<div class="blog-medium-media-wrapper">';
			print_blog_thumbnail( get_the_ID(), $item_size );
			echo '</div>'; // blog-medium-media-wrapper			
			
			echo '<div class="blog-content-wrapper">';
			
			// blog title
			echo '<h2 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
			
			// blog date
			echo '<div class="blog-info-wrapper">';
			echo '<div class="author-info">Posted by:'.get_the_author(get_the_ID()).'</div>';
            echo '<div class="blog-date">Published:'.get_the_time('M j, Y ').'</div>';
			echo '<div class="clear"></div>';	
			
			echo '</div>'; // blog-content-wrapper
			
			echo '<div class="clear"></div>';
			echo '</div>'; // blog-item
		
		}
		
	}
	
	// print blog medium thumbnail type
	function print_blog_medium( $item_class, $item_size, $num_excerpt, $full_content ){
		global $gdl_admin_translator, $more, $gdl_date_format;
		
		if( $full_content == 'Yes' ){ $more = 0; }
		
		if( $gdl_admin_translator == 'enable' ){
			$translator_continue_reading = get_option(THEME_SHORT_NAME.'_translator_continue_reading', 'Continue Reading');
		}else{
			$translator_continue_reading = __('Continue Reading ','gdl_front_end');
		}	

		while( have_posts() ){
			the_post();

			echo '<div class="' . $item_class . '">'; 
			
			echo '<div class="blog-content-wrapper">';
			
			// blog thumbnail
			echo '<div class="blog-medium-media-wrapper">';
			print_blog_thumbnail( get_the_ID(), $item_size );
			echo '</div>'; // blog-medium-media-wrapper
			
			echo '<div class="blog-context-wrapper">';
			
			// blog title
			echo '<h2 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';

			// blog information
			
			
			// blog content
			echo '<div class="blog-content">';
			if( $full_content == "No" ){
			    echo '<p>';
				echo gdl_get_excerpt( $num_excerpt, '... ' );
				echo '</p>';
				echo '<div class="clear"></div>';
				//echo '<a class="blog-continue-reading" href="' . get_permalink() . '"> ' . $translator_continue_reading . '</a>';				
			}else{
				the_content($translator_continue_reading);
			}
			echo '<div class="blog-info-wrapper">';
			echo '<div class="author-info">Posted by:'.get_the_author(get_the_ID()).'</div>';
            echo '<div class="blog-date">Published:'.get_the_time('M j, Y ').'</div>';
			echo '<div class="clear"></div>';
			/*echo '<div class="blog-author"><i class="icon-user"></i>';
			echo the_author_posts_link();
			echo '</div>';<i class="icon-comments"></i><i class="icon-calendar"></i>	*/		
            
			echo '<div class="blog-comment">';
			echo '<span>';
			comments_popup_link( __('0 Comment','gdl_front_end'),
				__('1 Comment','gdl_front_end'),
				__('% Comments','gdl_front_end'), '',
				__('Comment are off','gdl_front_end') );
			echo '</span>';
			echo '</div>';	
			
			/*$tags_opening = '<div class="blog-tag"><i class="icon-tags"></i>';
			$tags_ending = '</div>';
			the_tags( $tags_opening, ', ', $tags_ending );	*/			

			echo '<div class="clear"></div>';
			echo '</div>'; // blog information
			echo '</div>';
			
			echo '</div>'; // blog-context-wrapper
			
			echo '</div>'; // blog-content-wrapper
			
			echo '</div>'; // blog-item
		
		}
		
	}
	
	// print blog full thumbnail type
	function print_blog_full( $item_class, $item_size, $num_excerpt, $full_content = "No" ){
		global $gdl_admin_translator, $more, $gdl_date_format;
		
		if( $full_content == 'Yes' ){ $more = 0; }
		
		if( $gdl_admin_translator == 'enable' ){
			$translator_continue_reading = get_option(THEME_SHORT_NAME.'_translator_continue_reading', 'Continue Reading');
		}else{
			$translator_continue_reading = __('Continue Reading','gdl_front_end');
		}	

		while( have_posts() ){
			the_post();

			echo '<div class="' . $item_class . '">'; 
			
			// blog thumbnail
			print_blog_thumbnail( get_the_ID(), $item_size );		
			
			echo '<div class="blog-content-wrapper">';
			
			// blog title
			echo '<h2 class="blog-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';		

			// blog information
			echo '<div class="blog-info-wrapper">';
						
			echo '<div class="blog-date"><i class="icon-calendar"></i>';
			echo '<a href="' . get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d')) . '" >';
			echo get_the_time($gdl_date_format);
			echo '</a>';
			echo '</div>';
			
			echo '<div class="blog-comment"><i class="icon-comments"></i>';
			comments_popup_link( __('0 Comment','gdl_front_end'),
				__('1 Comment','gdl_front_end'),
				__('% Comments','gdl_front_end'), '',
				__('Comment are off','gdl_front_end') );
			echo '</div>';				
			
			echo '<div class="blog-author"><i class="icon-user"></i>';
			echo the_author_posts_link();
			echo '</div>';				
			
			$tags_opening = '<div class="blog-tag"><i class="icon-tags"></i>';
			$tags_ending = '</div>';
			the_tags( $tags_opening, ', ', $tags_ending );
	
			echo '<div class="clear"></div>';
			echo '</div>'; // blog information
			
			// blog content
			echo '<div class="blog-content">';
			if( $full_content == "No" ){
				echo gdl_get_excerpt( $num_excerpt, '... ' );
				echo '<div class="clear"></div>';
				echo '<a class="blog-continue-reading" href="' . get_permalink() . '"> ' . $translator_continue_reading . '</a>';				
			}else{
				the_content($translator_continue_reading);
			}
			echo '</div>';
			
			echo '</div>'; // blot content wrapper
			
			echo '</div>'; // blog item
		}		
			
	}
	
?>