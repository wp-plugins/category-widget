<?php
/*
Plugin Name: Category Widget
Plugin URI: http://buffercode.com/plugin-display-post-titles-category-selection/
Description: Easy way to display the number of post in that particular category by selecting from admin dashboard widget.
Version: 1.2
Author: vinoth06
Author URI: http://buffercode.com/
License: GPLv2
*/

// Additing Action hook widgets_init
add_action( 'widgets_init', 'bc_category_widget'); 

function bc_category_widget() {
register_widget( 'bc_category_widget_info' );
}

class bc_category_widget_info extends WP_Widget {
function bc_category_widget_info () {
		$this->WP_Widget('bc_category_widget_info', 'BC Category Widget','Select the category to display');	}

public function form( $instance ) { 
if ( isset( $instance[ 'bc_no_post' ]) && isset ($instance[ 'bc_category' ]) && isset ($instance[ 'bc_name' ])  && isset ($instance[ 'bc_bullet' ])) {
			$bc_no_post_value = $instance[ 'bc_no_post' ];
			$bc_category_value = $instance[ 'bc_category' ];
			$bc_name_value = $instance[ 'bc_name' ];
			$bc_bullet_value = $instance[ 'bc_bullet' ];
					
			
		}
		else {
		$bc_no_post_value = 5;
		$bc_category_value = 1;
		$bc_name_value	= 'My Category';
		$bc_bullet_value = 2;
		} ?>
		<p>Name: <input class="widefat" name="<?php echo $this->get_field_name( 'bc_name' ); ?>" type="text" value="<?php echo esc_attr( $bc_name_value );?>" /></p>
		
		<p>Select Category: <?php wp_dropdown_categories(array('name' => $this->get_field_name('bc_category'), 'selected' => $bc_category_value, 'id' => $this->get_field_id('bc_category'), 'class' => 'widefat')); ?> </p>
		
		<p>Number of Post:
		<select name="<?php echo $this->get_field_name('bc_no_post'); ?>" id="<?php echo $this->get_field_id('bc_no_post'); ?>" class="widefat">
		<?php
		$options = array('1' =>'1','2' =>'2','3' =>'3','4' =>'4','5' =>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10');
		foreach ($options as $langu => $code) {
		echo '<option value="' . $code . '" id="' . $code . '"', $bc_no_post_value == $code ? ' selected="selected"' : '', '>', $langu, '</option>';
		}
		?>
		</select></p>
		
		<p>Show Bullet Style:
		<select name="<?php echo $this->get_field_name('bc_bullet'); ?>" id="<?php echo $this->get_field_id('bc_bullet'); ?>" class="widefat">
		<?php
		$bullet_options = array('yes' =>'1','no' =>'2');
		foreach ($bullet_options as $bullet_value => $bullet_code) {
		echo '<option value="' . $bullet_code . '" id="' . $bullet_code . '"', $bc_bullet_value == $bullet_code ? ' selected="selected"' : '', '>', $bullet_value, '</option>';
		}
		?>
		</select></p>
		
<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
$instance['bc_no_post'] = ( ! empty( $new_instance['bc_no_post'] ) ) ? strip_tags( $new_instance['bc_no_post'] ) : '';

$instance['bc_category'] = ( ! empty( $new_instance['bc_category'] ) ) ? strip_tags( $new_instance['bc_category'] ) : '';

$instance['bc_name'] = ( ! empty( $new_instance['bc_name'] ) ) ? strip_tags( $new_instance['bc_name'] ) : '';

$instance['bc_bullet'] = ( ! empty( $new_instance['bc_bullet'] ) ) ? strip_tags( $new_instance['bc_bullet'] ) : '';
return $instance;
}

function widget($args, $instance) {
extract($args);
echo $before_widget;
$bc_name_value = apply_filters( 'widget_title', $instance['bc_name'] );
$bc_category_value = empty( $instance['bc_category'] ) ? '&nbsp;' :
$instance['bc_category'];
$bc_no_post_value = empty( $instance['bc_no_post'] ) ? '&nbsp;' :
$instance['bc_no_post'];
$bc_bullet_value = empty( $instance['bc_bullet'] ) ? '&nbsp;' :
$instance['bc_bullet'];

if ( !empty( $name ) ) { echo $before_title . $bc_name_value .
$after_title; };
 $args = array('category' => $bc_category_value,'posts_per_page'   => $bc_no_post_value );
$myposts = get_posts( $args );
global $post;
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
	<li <?php if($bc_bullet_value==2){?> style="list-style-type:none;<?php } ?>"><!-- Buffercode.com Category Link Start -->
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<!-- Buffercode.com Category Link Ends -->
	</li>
<?php endforeach; 
wp_reset_postdata();
echo $after_widget;
}
}

?>
