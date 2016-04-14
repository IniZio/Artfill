<?php
/*
This file is part of Easy Testimonials.

Easy Testimonials is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Easy Testimonials is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Easy Testimonials.  If not, see <http://www.gnu.org/licenses/>.

Shout out to http://www.makeuseof.com/tag/how-to-create-wordpress-widgets/ for the help
*/

class cycledTestimonialWidget extends WP_Widget
{
	function cycledTestimonialWidget(){
		$widget_ops = array('classname' => 'cycledTestimonialWidget', 'description' => 'Displays a Testimonial cycle.' );
		$this->WP_Widget('cycledTestimonialWidget', 'Easy Testimonial Cycle', $widget_ops);
	}

	function form($instance){
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => 1, 'show_title' => 0, 'transition' => 'fade', 'timer' => '2000', 'category' => '' ) );
		$title = $instance['title'];
		$count = $instance['count'];
		$show_title = $instance['show_title'];
		$use_excerpt = $instance['use_excerpt'];
		$transition = $instance['transition'];
		$timer = $instance['timer'];
		$category = $instance['category'];
				
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('count'); ?>">Count: <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo esc_attr($count); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('transition'); ?>">Transition: 
			<p><select name="<?php echo $this->get_field_name('transition'); ?>" id="<?php echo $this->get_field_id('transition'); ?>">	
				<option value="scrollHorz" <?php if(esc_attr($transition) == "scrollHorz"): echo 'selected="SELECTED"'; endif; ?>>Horizontal Scroll</option>
				<option <?php if(!isValidKey()): ?>disabled=DISABLED <?php endif; ?>	value="scrollVert" <?php if(esc_attr($transition) == "scrollVert"): echo 'selected="SELECTED"'; endif; ?>>Vertical Scroll<?php if(!isValidKey()): ?> - Register to Enable!<?php endif; ?></option>
				<option value="fadeIn" <?php if(esc_attr($transition) == "fadeIn"): echo 'selected="SELECTED"'; endif; ?>>Fade In</option>
				<option <?php if(!isValidKey()): ?>disabled=DISABLED <?php endif; ?>	value="fadeout" <?php if(esc_attr($transition) == "fadeout"): echo 'selected="SELECTED"'; endif; ?>>Fade Out<?php if(!isValidKey()): ?> - Register to Enable!<?php endif; ?></option>
				<option <?php if(!isValidKey()): ?>disabled=DISABLED <?php endif; ?>	value="carousel" <?php if(esc_attr($transition) == "carousel"): echo 'selected="SELECTED"'; endif; ?>>Carousel<?php if(!isValidKey()): ?> - Register to Enable!<?php endif; ?></option>
				<option <?php if(!isValidKey()): ?>disabled=DISABLED <?php endif; ?>	value="flipHorz" <?php if(esc_attr($transition) == "flipHorz"): echo 'selected="SELECTED"'; endif; ?>>Horizontal Flip<?php if(!isValidKey()): ?> - Register to Enable!<?php endif; ?></option>
				<option <?php if(!isValidKey()): ?>disabled=DISABLED <?php endif; ?>	value="flipVert" <?php if(esc_attr($transition) == "flipVert"): echo 'selected="SELECTED"'; endif; ?>>Vertical Flip<?php if(!isValidKey()): ?> - Register to Enable!<?php endif; ?></option>
				<option <?php if(!isValidKey()): ?>disabled=DISABLED <?php endif; ?>	value="tileslide" <?php if(esc_attr($transition) == "tileslide"): echo 'selected="SELECTED"'; endif; ?>>Tile Slide<?php if(!isValidKey()): ?> - Register to Enable!<?php endif; ?></option>
				<option <?php if(!isValidKey()): ?>disabled=DISABLED <?php endif; ?>	value="none" <?php if(esc_attr($transition) == "none"): echo 'selected="SELECTED"'; endif; ?>>None<?php if(!isValidKey()): ?> - Register to Enable!<?php endif; ?></option>
			</select></p>
			<p><span class="description">Pick your desired transition.</span></label></p>
			<p><label for="<?php echo $this->get_field_id('timer'); ?>">Timer: <input class="widefat" id="<?php echo $this->get_field_id('timer'); ?>" name="<?php echo $this->get_field_name('timer'); ?>" type="text" value="<?php echo esc_attr($timer); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('show_title'); ?>">Show Testimonial Title: </label><input class="widefat" id="<?php echo $this->get_field_id('show_title'); ?>" name="<?php echo $this->get_field_name('show_title'); ?>" type="checkbox" value="1" <?php if($show_title){ ?>checked="CHECKED"<?php } ?>/></p>
			<p><label for="<?php echo $this->get_field_id('use_excerpt'); ?>">Use Testimonial Excerpt: </label><input class="widefat" id="<?php echo $this->get_field_id('use_excerpt'); ?>" name="<?php echo $this->get_field_name('use_excerpt'); ?>" type="checkbox" value="1" <?php if($use_excerpt){ ?>checked="CHECKED"<?php } ?>/></p>
			<p><label for="<?php echo $this->get_field_id('category'); ?>">Category Slug: <input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo esc_attr($category); ?>" /></label></p>
		<?php
	}

	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['count'] = $new_instance['count'];
		$instance['show_title'] = $new_instance['show_title'];
		$instance['use_excerpt'] = $new_instance['use_excerpt'];
		$instance['timer'] = $new_instance['timer'];
		$instance['transition'] = $new_instance['transition'];
		$instance['category'] = $new_instance['category'];
		
		return $instance;
	}

	function widget($args, $instance){
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$count = empty($instance['count']) ? 1 : $instance['count'];
		$show_title = empty($instance['show_title']) ? 0 : $instance['show_title'];
		$transition = empty($instance['transition']) ? 'fade' : $instance['transition'];
		$timer = empty($instance['timer']) ? '2000' : $instance['timer'];
		$use_excerpt = empty($instance['use_excerpt']) ? 0 : $instance['use_excerpt'];
		$category = empty($instance['category']) ? '' : $instance['category'];

		if (!empty($title)){
			echo $before_title . $title . $after_title;;
		}
		
		echo outputTestimonialsCycle(array('testimonials_link' => get_option('testimonials_link'), 'count' => $count, 'show_title' => $show_title, 'transition' => $transition, 'timer' => $timer, 'container' => true, 'category' => $category, 'use_excerpt' => $use_excerpt));

		echo $after_widget;
	} 
}
?>