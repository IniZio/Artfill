<?php
/*
Plugin Name: Featured Images Widget
Plugin URI: http://wordpress.org/plugins/featured-images-widget/
Description: Display featured images from recent posts in a sidebar widget.
Version: 0.3
Author: mdefeo
Author URI: http://marcellodefeo.com/
*/
class recent_work extends WP_Widget {
	function recent_work() {
		parent::WP_Widget(false, $name = 'Featured Images Thumbnails');	
	}
	function widget($args, $instance) {	
		extract($args);
		$title	= apply_filters('widget_title', $instance['title']);
		$show 	= $instance['show'];
		$cat 	= $instance['cat'];
		$css 	= $instance['css'];
		?>
		<?php echo $before_widget; ?>
		<?php if($title)
		echo $before_title . $title . $after_title; ?>
		<ul>
			<?php
			$posts = get_posts(array('numberposts'=>$show,'category'=>$cat));
			foreach ($posts as $post) {
				if(has_post_thumbnail($post->ID)) {
					echo "<li>\r\n";
					echo "<a href=\"".$post->guid."\">".get_the_post_thumbnail($post->ID,'thumbnail',array('alt'=> trim(strip_tags( $post->post_excerpt )),'title'	=> trim(strip_tags($post->post_title))))."</a>\r\n";
					echo "</li>\r\n";
				}
			}
			wp_reset_postdata();?>
		</ul>
		<?php echo $after_widget; ?>
		<?php
		if($css == 1) {
			wp_register_style('rw-css',plugins_url('style.css', __FILE__));
			wp_enqueue_style('rw-css');
		}
	}
	function update($new_instance, $old_instance) {		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['show'] = strip_tags($new_instance['show']);
		$instance['cat'] = strip_tags($new_instance['cat']);
		$instance['css'] = strip_tags($new_instance['css']);
		return $instance;
	}
	function form($instance) {	
		$title	= esc_attr($instance['title']);
		$show	= esc_attr($instance['show']);
		$cat		= esc_attr($instance['cat']);
		$css		= esc_attr($instance['css']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('show'); ?>"><?php _e('Show most recent:'); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id('show'); ?>" name="<?php echo $this->get_field_name('show'); ?>">
				<?php
				$x = 1;
				while($x <= 10) {
					echo "<option value=\"{$x}\"";
					if($x == $show) echo " selected";
					echo ">{$x}</option>\r\n";
					$x++;
				}          	
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('cat'); ?>"><?php _e('Select category:'); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('cat'); ?>">
			<?php 
			$categories = get_categories('orderby=name'); 
			foreach ($categories as $category) {
				echo "<option value=\"".$category->term_id."\"";
				if($category->term_id == $cat) echo " selected";
				echo ">".$category->cat_name."</option>\r\n";
			}		
			?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('css'); ?>"><?php _e('Enable CSS:'); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id('css'); ?>" name="<?php echo $this->get_field_name('css'); ?>">
				<option value="0" <?php if($css == 0) echo "selected"; ?>>No</option>
				<option value="1" <?php if($css == 1) echo "selected"; ?>>Yes</option>
			</select>
		</p>

		<?php 
	}
}
add_action('widgets_init', create_function('', 'return register_widget("recent_work");'));
?>