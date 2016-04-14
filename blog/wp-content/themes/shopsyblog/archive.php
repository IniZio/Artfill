<?php get_header(); ?>
<div class="content-outer-wrapper">

	<div class="content-wrapper container main ">
   
	<?php
		// Check and get Sidebar Class
		$sidebar = get_option(THEME_SHORT_NAME.'_search_archive_sidebar','no-sidebar');
		$sidebar_array = gdl_get_sidebar_size( $sidebar );
	?>
	<div class="page-wrapper archive-page <?php echo $sidebar_array['sidebar_class']; ?>">
		<?php
			$left_sidebar = get_option(THEME_SHORT_NAME.'_search_archive_left_sidebar');
			$right_sidebar = get_option(THEME_SHORT_NAME.'_search_archive_right_sidebar');		

			echo '<div class="row gdl-page-row-wrapper">';
			echo '<div class="gdl-page-left mb0 ' . $sidebar_array['page_left_class'] . '">';
			
			echo '<div class="row">';
			echo '<div class="gdl-page-item mb0 pb20 ' . $sidebar_array['page_item_class'] . '">';
			
				if( is_page() ){
					// Top Slider Part				
					if( $gdl_top_slider_type == 'Layer Slider' ){
						$layer_slider_id = get_post_meta( $post->ID, 'page-option-layer-slider-id', true);
						echo '<div class="gdl-top-slider">';
						echo '<div class="gdl-top-slider-wrapper ' . $full_slider . '">';
						echo do_shortcode('[layerslider id="' . $layer_slider_id . '"]');
						echo '<div class="clear"></div>';
						echo '</div>';
						echo '</div>';
					}else if( empty($gdl_top_slider_type) || $gdl_top_slider_type == 'Title' || $gdl_top_slider_type == 'No Slider' ){
						$page_caption = get_post_meta($post->ID, 'page-option-caption', true);
						print_page_header(get_the_title(), $page_caption);					
					}else if ( $gdl_top_slider_type != "None"){
						echo '<div class="gdl-top-slider">';
						echo '<div class="gdl-top-slider-wrapper ' . $full_slider . '">';			
						$slider_xml = "<Slider>" . create_xml_tag('size', 'full-width');
						$slider_xml = $slider_xml . create_xml_tag('slider-type', $gdl_top_slider_type);
						$slider_xml = $slider_xml . $gdl_top_slider_xml;
						$slider_xml = $slider_xml . "</Slider>";
						$slider_xml_dom = new DOMDocument();
						$slider_xml_dom->loadXML($slider_xml);
						print_slider_item($slider_xml_dom->documentElement);
						echo '<div class="clear"></div>';
						echo '</div>';
						echo '</div>';
					}	
					
					// Under Slider Area
					if(get_post_meta( $post->ID, 'page-option-enable-bottom-slider', true) == 'Yes'){
						$stunning_title = get_post_meta( $post->ID, 'page-option-under-slider-title', true);
						$stunning_caption = get_post_meta( $post->ID, 'page-option-under-slider-caption', true);
						$stunning_button_text = get_post_meta( $post->ID, 'page-option-under-slider-button-text', true);
						$stunning_button_link = get_post_meta( $post->ID, 'page-option-under-slider-button-link', true);
						
						$button_class = (!empty($stunning_button_text) && !empty($stunning_button_link))? 'button-on': '';
						
						echo '<div class="under-slider-wrapper">';
						echo '<div class="under-slider-container container">';
						
						echo '<div class="under-slider-inner-wrapper ' . $button_class . '">';
						echo '<h2 class="under-slider-title">' . $stunning_title . '</h2>';
						echo '<div class="under-slider-caption">' . $stunning_caption . '</div>';
						if( !empty($stunning_button_text) && !empty($stunning_button_link) ){
							echo '<a href="' . $stunning_button_link . '" class="under-slider-button gdl-button large">';
							echo $stunning_button_text . '</a>';
						}
						echo '</div>';
						
						echo '</div>';
						echo '</div>';
					}
					
				}else if( is_single() ){
					if( $post->post_type == 'portfolio' ){
						$single_title = get_the_title();
						$single_caption = get_post_meta( $post->ID, "post-option-blog-header-caption", true);
						print_page_header($single_title, $single_caption);					
					}else if($post->post_type == 'package'){
						$single_title = get_the_title();
						$single_caption = get_post_meta( $post->ID, "post-option-blog-header-caption", true);
						print_page_header($single_title, $single_caption);
					}else{
						$single_title = get_post_meta( $post->ID, "post-option-blog-header-title", true);
						$single_caption = get_post_meta( $post->ID, "post-option-blog-header-caption", true);
						if(empty( $single_title )){
							$single_title = get_option(THEME_SHORT_NAME . '_default_post_header','Blog Post');
							$single_caption = get_option(THEME_SHORT_NAME . '_default_post_caption');
						}
						print_page_header($single_title, $single_caption);			
					}	
				}else if( is_404() ){
					global $gdl_admin_translator;
					if( $gdl_admin_translator == 'enable' ){
						$translator_404_title = get_option(THEME_SHORT_NAME.'_404_title', 'Page Not Found');
					}else{
						$translator_404_title = __('Page Not Found','gdl_front_end');		
					}			
					print_page_header($translator_404_title);
				}else if( is_search() ){

					global $gdl_admin_translator;
					if( $gdl_admin_translator == 'enable' ){
						$title = get_option(THEME_SHORT_NAME.'_search_header_title', 'Search Results');
					}else{
						$title = __('Search Results', 'gdl_front_end');
					}		
					
					$caption = get_search_query();
					print_page_header($title, $caption);
				}else if( is_archive() ){
					
					if( is_category() || is_tax('portfolio-category') || is_tax('product_cat') ){
						$title = __('Category','gdl_front_end');
						$caption = single_cat_title('', false);
					}else if( is_tag() || is_tax('portfolio-tag') || is_tax('product_tag') ){
						$title = __('Tag','gdl_front_end');
						$caption = single_cat_title('', false);
					}else if( is_day() ){
						$title = __('Day','gdl_front_end');
						$caption = get_the_date('F j, Y');
					}else if( is_month() ){
						$title = __('Month','gdl_front_end');
						$caption = get_the_date('F Y');
					}else if( is_year() ){
						$title = __('Year','gdl_front_end');
						$caption = get_the_date('Y');
					}else if( is_author() ){
						$title = __('By','gdl_front_end');
						
						$author_id = get_query_var('author');
						$author = get_user_by('id', $author_id);
						$caption = $author->display_name;					
					}else{
						$title = __('Shop','gdl_front_end');
					}
							
					print_page_header($title, $caption);				
				} 
			
			if( !is_tax('portfolio-category') && !is_tax('portfolio-tag') ){
			
				// blog archive
				$item_type = get_option(THEME_SHORT_NAME.'_search_archive_item_size', '1/1 Full Thumbnail');
				$num_excerpt = get_option(THEME_SHORT_NAME.'_search_archive_num_excerpt', 285);
				$full_content = get_option(THEME_SHORT_NAME.'_search_archive_full_blog_content', 'No');

				global $blog_div_size_num_class;
				$item_class = $blog_div_size_num_class[$item_type]['class'];
				$item_size = $blog_div_size_num_class[$item_type][$sidebar_type];		

					
				echo '<div id="blog-item-holder" class="blog-item-holder">';
				if( $item_type == '1/4 Blog Widget' || $item_type == '1/3 Blog Widget' || 
					$item_type == '1/2 Blog Widget' || $item_type == '1/1 Blog Widget'){
					
					print_blog_widget($item_class, $item_size, $num_excerpt, $full_content, $item_type);				
					
				}else if( $item_type == '1/1 Medium Thumbnail' ){
					print_blog_medium($item_class, $item_size, $num_excerpt, $full_content);
				}else if( $item_type == '1/1 Full Thumbnail' ){	
					print_blog_full($item_class, $item_size, $num_excerpt, $full_content);
				}
				echo '</div>'; // blog-item-holder
			}else{
				
				// portfolio archive
				$port_size = get_option(THEME_SHORT_NAME.'_portfolio_archive_size' ,'1/4');
				$show_title = (get_option(THEME_SHORT_NAME.'_portfolio_archive_show_title' ,'Yes') == "Yes")? true: false;
				$show_tag = (get_option(THEME_SHORT_NAME.'_portfolio_archive_show_tags' ,'Yes') == "Yes")? true: false;
				print_normal_portfolio($port_size, $show_title, $show_tag);
			}

			echo '<div class="clear"></div>';
			//pagination();
			
			echo "</div>"; // end of gdl-page-item
			
			get_sidebar('left');	
			echo '<div class="clear"></div>';			
			echo "</div>"; // row
			echo "</div>"; // gdl-page-left

			get_sidebar('right');
			echo '<div class="clear"></div>';
			echo "</div>"; // row
		?>
       
         <?php //pagination($pages=3, $range=2);?>
		<div class="clear"></div>
	</div> <!-- page wrapper -->
	</div> <!-- content wrapper -->
</div> <!-- content outer wrapper -->
<?php get_footer(); ?>
