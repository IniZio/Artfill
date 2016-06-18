<?php get_header(); ?>
<div class="content-outer-wrapper">
	<div class="content-wrapper container main ">
	<?php
		// Check and get Sidebar Class
		$sidebar = get_post_meta($post->ID,'post-option-sidebar-template',true);
		if( empty($sidebar) ){
			global $default_post_sidebar;
			$sidebar = $default_post_sidebar; 
		}		
		$sidebar_array = gdl_get_sidebar_size( $sidebar );

		// Translator words
		if( $gdl_admin_translator == 'enable' ){
			$translator_social_share = get_option(THEME_SHORT_NAME.'_translator_social_shares', 'Social Share');
			$translator_duration = get_option(THEME_SHORT_NAME.'_translator_duration_package', 'Duration:');
			$translator_price = get_option(THEME_SHORT_NAME.'_translator_price_package', 'Price:');
			$translator_location = get_option(THEME_SHORT_NAME.'_translator_location_package', 'Location:');
		}else{
			$translator_social_share = __('Social Share','gdl_front_end');
			$translator_duration = __('Duration:','gdl_front_end');
			$translator_price = __('Price:','gdl_front_end');
			$translator_location = __('Location:','gdl_front_end');
		}
	?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="page-wrapper single-blog <?php echo $sidebar_array['sidebar_class']; ?>">
		<?php
			global $left_sidebar, $right_sidebar, $default_post_left_sidebar, $default_post_right_sidebar;
			$left_sidebar = get_post_meta( $post->ID , "post-option-choose-left-sidebar", true);
			$right_sidebar = get_post_meta( $post->ID , "post-option-choose-right-sidebar", true);
			if( empty( $left_sidebar )){ $left_sidebar = $default_post_left_sidebar; } 
			if( empty( $right_sidebar )){ $right_sidebar = $default_post_right_sidebar; } 
			
			global $package_single_size, $sidebar_type, $gdl_admin_translator;
			$item_size = $package_single_size[$sidebar_type];
			
			if( $gdl_admin_translator == 'enable' ){
				$translator_book_now = get_option(THEME_SHORT_NAME.'_translator_book_now_package', 'Book Now!');
				$translator_last_minute = get_option(THEME_SHORT_NAME.'_translator_last_minute_package', 'Last Minute');
			}else{
				$translator_book_now = __('Book Now!','gdl_front_end');
				$translator_last_minute = __('Last Minute','gdl_front_end');
			}		
		
			if( empty($package_id) ){ $package_id = 0; }
			
			$contact_form = get_option(THEME_SHORT_NAME.'_booknow_contact_shortcode');
			if( !empty($contact_form) ){
				echo '<div class="book-now-contact hidden" id="gdl-booknow-' . $package_id . '">';
				echo do_shortcode($contact_form);
				echo '</div>';
			}	
	
			// starting the content
			echo '<div class="row gdl-page-row-wrapper">';
			echo '<div class="gdl-page-left mb0 ' . $sidebar_array['page_left_class'] . '">';
			
			echo '<div class="row">';
			echo '<div class="gdl-page-item mb0 pb20 gdl-package-full ' . $sidebar_array['page_item_class'] . '">';
			if ( have_posts() ){
				while (have_posts()){
					the_post();

					$package_type = get_post_meta(get_the_ID(), 'package-type', true);
					if($package_type == 'Last Minute'){
						$package_ribbon = 'last-minute';
						$package_type_text = '<span class="head">' . $translator_last_minute . '</span>';
						$package_type_text .= '<span class="discount-text">';
						$package_type_text .= get_post_meta(get_the_ID(), 'package-type-text', true);
						$package_type_text .= '</span>';
					}else if($package_type == 'None'){
						$package_ribbon = '';
						$package_type_text = '';
					}else{
						$package_ribbon = 'normal-type';
						$package_type_text = $translator_learn_more;
					}					
					
					// package thumbnail
					print_single_package_thumbnail( get_the_ID(), $item_size, $package_ribbon, $package_type_text );
					
					echo '<div class="package-content-wrapper">';
					
					// package information
					echo '<div class="package-info-wrapper">';

					$date_type = get_post_meta( get_the_ID(), 'package-date-type', true );
					if( $date_type == 'Fixed' ){
						$start_date = get_post_meta( get_the_ID(), 'package-start-date', true );
						$end_date = get_post_meta( get_the_ID(), 'package-end-date', true ); 			
						
						echo '<div class="package-info"><i class="icon-time"></i>';
						echo '<span class="head">' . $translator_duration . ' </span>';
						echo get_package_date($start_date, $end_date, $gdl_date_format);
						echo '</div>';
					}else if( $date_type == 'Duration' ){
						echo '<div class="package-info"><i class="icon-time"></i>';
						echo '<span class="head">' . $translator_duration . ' </span>';
						echo get_post_meta( get_the_ID(), 'package-duration', true );
						echo '</div>';			
					}

					// package location
					$location = get_post_meta(get_the_ID(), 'package-location',true);
					if(!empty($location)){
						echo '<div class="package-info"><i class="icon-location-arrow"></i>';
						echo '<span class="head">' . $translator_location . ' </span>';
						echo do_shortcode($location);
						echo '</div>';
					}
					
					// package price
					$package_type = get_post_meta(get_the_ID(), 'package-type', true);
					$price = get_post_meta(get_the_ID(), 'package-price',true);
					if($package_type == 'Last Minute'){
						echo '<div class="package-info"><i class="icon-tag"></i>';
						echo '<span class="head">' . $translator_price . ' </span>';
						
						echo '<span class="normal-price">';
						echo do_shortcode($price);
						echo '</span>';
						
						echo '<span class="discount-text">';
						echo get_post_meta(get_the_ID(), 'package-type-text', true);
						echo '</span><span class="separator"> : </span>';
						
						echo '<span class="discount-price">';
						echo get_post_meta(get_the_ID(), 'package-last-minute-widget-text', true);
						echo '</span>';
						
						echo '</div>';
					}else if($package_type == 'Learn More'){
						if(!empty($price)){
							echo '<div class="package-info"><i class="icon-tag"></i>';
							echo '<span class="head">' . $translator_price . ' </span>';
							echo do_shortcode($price);
							echo '</div>';
						}
					}
			
					// book now button
					if( !empty($contact_form) ){
						echo '<a class="package-book-now-button gdl-button large various" ';
						echo ' href="#gdl-booknow-' . $package_id . '" data-fancybox-type="inline" data-rel="fancybox" ';
						echo ' data-title="' . get_the_title() . '" data-url="' . get_permalink() . '" >';
						echo $translator_book_now;
						echo '</a>';
					}			
			
					echo '<div class="clear"></div>';
					echo '</div>'; // package information
					
					// package content
					echo '<div class="package-content">';
					the_content();
					wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'gdl_front_end' ) . '</span>', 'after' => '</div>' ) );
					echo '<div class="clear"></div>';
					echo '</div>';
					
					// Include Social Shares
					if(get_post_meta($post->ID, 'post-option-social-enabled', true) != "No"){
						echo "<h3 class='social-share-title'>" . $translator_social_share . '</h3>';
						include_social_shares();
						echo "<div class='clear'></div>";
					}
					
					echo '</div>'; // package content wrapper
				}
			}
			echo "</div>"; // end of gdl-page-item
			
			get_sidebar('left');	
			echo '<div class="clear"></div>';			
			echo "</div>"; // row
			echo "</div>"; // gdl-page-left

			get_sidebar('right');
			echo '<div class="clear"></div>';
			echo "</div>"; // row
		?>
		<div class="clear"></div>
	</div> <!-- page wrapper -->
	</div> <!-- post class -->
	</div> <!-- content wrapper -->
</div> <!-- content outer wrapper -->
<?php get_footer(); ?>