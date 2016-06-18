<?php 
if( !function_exists('pagination') ){
	function pagination($pages = '', $range = 3){
		$showitems = ($range * 2)+1;  
	 
		global $paged;
		if(empty($paged)){ $paged = 1; }

		if(empty($pages)){
			global $wp_query;

			$pages = $wp_query->max_num_pages;
		
			if(!$pages){ $pages = 1; }
		}   
	 
		if(1 != $pages){
			echo "<div class=\"gdl-pagination\">";  
			 
			// first page
			/*if($paged > 2 && $paged > $range+1 && $showitems < $pages){ 
				echo '<a href="' . get_pagenum_link(1) . '">';
				_e('&laquo; First', 'gdl_front_end'); 
				echo '</a>';
			}
			
			// previous page
			if($paged > 1 && $showitems < $pages){
				echo '<a href="' . get_pagenum_link($paged - 1) . '">';
				_e('&lsaquo; Previous', 'gdl_front_end');
				echo '</a>';
			}
*/			
			// middle page
			echo '<div class="pagehead">Page:</div>';
			
			for ($i=1; $i <= $pages; $i++){
				/*if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
					echo ($paged == $i)? "<span class=\"current\"> ".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
				}*/
				
				if($i == $pages) {
					if($paged == $pages){ echo "<span class=\"current\"> Last </span>"; } else { echo "<a href='".get_pagenum_link($i)."' class=\"inactive\"> Last </a>"; } }
				else if($paged == $i) { echo "<span class=\"current\"> ".$i."</span>";}
				else { echo "<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>"; }
				
				//echo $pages;
			}
			
			/*// next page
			if ($paged < $pages && $showitems < $pages){
				echo '<a href="' . get_pagenum_link($paged + 1) . '">';
				_e('Next &rsaquo;', 'gdl_front_end');
				echo '</a>';
			}
			
			// last page
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
				echo '<a href="' . get_pagenum_link($pages) . '">';
				
				_e('Last &raquo;', 'gdl_front_end');
				echo '</a>';
			}*/
			
			echo '<div class="clear"></div>';
			echo '<div class="navigation-bar">';
				// previous
				//echo '';
				if ($paged != 1){
				echo '<a href="' . get_pagenum_link($paged - 1) . '">';
				echo '<div class="previous active"></div>';
				echo '</a>';
			}
			else { echo '<div class="previous inactive"></div>'; }
				
				//Next
				//echo '';
					if ($paged != $pages){
				echo '<a href="' . get_pagenum_link($paged + 1) . '">';
				echo '<div class="next active"></div>';
				echo '</a>';
			}
			else { echo '<div class="next inactive"></div>'; }
			echo '</div>';
			echo '<div class="clear"></div>';
			echo '</div>'; // gdl pagination
		}
	}
}
?>