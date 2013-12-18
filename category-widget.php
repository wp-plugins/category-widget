<?php
/*
Plugin Name: Category Widget
Plugin URI: http://buffercode.com/plugin-display-post-titles-category-selection/
Description: Easy way to display the number of post in that particular category by selecting from admin dashboard widget.
Version: 1.4.2
Author: vinoth06
Author URI: http://buffercode.com/
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
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
if ( isset( $instance[ 'bc_no_post' ]) && isset ($instance[ 'bc_category' ]) && isset ($instance[ 'bc_name' ])  && isset ($instance[ 'bc_bullet' ]) && isset ($instance[ 'bc_title_count' ]) && isset ($instance[ 'bc_combo_list' ]) &&isset ($instance[ 'bc_please_select'])) {
			$bc_no_post_value = $instance[ 'bc_no_post' ];
			$bc_category_value = $instance[ 'bc_category' ];
			$bc_name_value = $instance[ 'bc_name' ];
			$bc_bullet_value = $instance[ 'bc_bullet' ];
			$bc_title_count_value = $instance[ 'bc_title_count' ];
			$bc_combo_list_value = $instance[ 'bc_combo_list' ];		
			$bc_please_select_value=$instance[ 'bc_please_select' ];		
		}
		else {//Setting Default Values
		$bc_no_post_value = 5;
		$bc_category_value = 1;
		$bc_name_value	= 'My Category';
		$bc_bullet_value = 2;
		$bc_title_count_value = 20;
		$bc_combo_list_value =1;
		$bc_please_select_value='Please Select';
		} ?><!-- Buffercode.com Category Widget Options -->
		<p>Name: <input class="widefat" name="<?php echo $this->get_field_name( 'bc_name' ); ?>" type="text" value="<?php echo esc_attr( $bc_name_value );?>" /></p>
		
		<p>Select Category: <?php wp_dropdown_categories(array('name' => $this->get_field_name('bc_category'), 'selected' => $bc_category_value, 'id' => $this->get_field_id('bc_category'), 'class' => 'widefat')); ?> </p>
		
		<p>Number of Post:
		<select name="<?php echo $this->get_field_name('bc_no_post'); ?>" id="<?php echo $this->get_field_id('bc_no_post'); ?>" class="widefat">
		<?php
		$options = array('1' =>'1','2' =>'2','3' =>'3','4' =>'4','5' =>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','All'=>'11');
		foreach ($options as $langu => $code) {
		echo '<option value="' . $code . '" id="' . $code . '"', $bc_no_post_value == $code ? ' selected="selected"' : '', '>', $langu, '</option>';
		}
		?>
		</select></p>
		
		<p>Display in Combo box or List:
		<select name="<?php echo $this->get_field_name('bc_combo_list'); ?>" id="<?php echo $this->get_field_id('bc_combo_list'); ?>" class="widefat">
		<?php
		$cl_options = array('Combo Box' =>'1','List' =>'2');
		foreach ($cl_options as $cl_langu => $cl_code) {
		echo '<option value="' . $cl_code . '" id="' . $cl_code . '"', $bc_combo_list_value == $cl_code ? ' selected="selected"' : '', '>', $cl_langu, '</option>';
		}
		?>
		</select></p>
		
		<p>Show Bullet Style:
		<select name="<?php echo $this->get_field_name('bc_bullet'); ?>" id="<?php echo $this->get_field_id('bc_bullet'); ?>" class="widefat">
		<?php
		$bullet_options = array('Yes' =>'1','No' =>'2');
		foreach ($bullet_options as $bullet_value => $bullet_code) {
		echo '<option value="' . $bullet_code . '" id="' . $bullet_code . '"', $bc_bullet_value == $bullet_code ? ' selected="selected"' : '', '>', $bullet_value, '</option>';
		}
		?>
		</select></p>
		
		<p>Max Title Size:<input class="widefat" name="<?php echo $this->get_field_name( 'bc_title_count' ); ?>" type="text" value="<?php echo esc_attr( $bc_title_count_value );?>" /></p>
		
		<p>Custom Combo Box "Please Select":<input class="widefat" name="<?php echo $this->get_field_name( 'bc_please_select' ); ?>" type="text" value="<?php echo esc_attr( $bc_please_select_value );?>" /></p>
		
<?php
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
$instance['bc_no_post'] = ( ! empty( $new_instance['bc_no_post'] ) ) ? strip_tags( $new_instance['bc_no_post'] ) : '';

$instance['bc_category'] = ( ! empty( $new_instance['bc_category'] ) ) ? strip_tags( $new_instance['bc_category'] ) : '';

$instance['bc_name'] = ( ! empty( $new_instance['bc_name'] ) ) ? strip_tags( $new_instance['bc_name'] ) : '';

$instance['bc_bullet'] = ( ! empty( $new_instance['bc_bullet'] ) ) ? strip_tags( $new_instance['bc_bullet'] ) : '';

$instance['bc_title_count'] = ( ! empty( $new_instance['bc_title_count'] ) ) ? strip_tags( $new_instance['bc_title_count'] ) : '';

$instance['bc_combo_list'] = ( ! empty( $new_instance['bc_combo_list'] ) ) ? strip_tags( $new_instance['bc_combo_list'] ) : '';

$instance['bc_please_select'] = ( ! empty( $new_instance['bc_please_select'] ) ) ? strip_tags( $new_instance['bc_please_select'] ) : '';
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
$bc_title_count_value = empty( $instance['bc_title_count'] ) ? '&nbsp;' :
$instance['bc_title_count'];
$bc_combo_list_value = empty( $instance['bc_combo_list'] ) ? '&nbsp;' :
$instance['bc_combo_list'];
$bc_please_select_value = empty( $instance['bc_please_select'] ) ? 'Please Select' :
$instance['bc_please_select'];

if ( !empty( $name ) ) { echo $before_title . $bc_name_value .
$after_title; };
if($bc_no_post_value==11){$args = array('category' => $bc_category_value,'posts_per_page'   => -1 );}
else{ $args = array('category' => $bc_category_value,'posts_per_page'   => $bc_no_post_value );}
$myposts = get_posts( $args );
global $post;
if($bc_combo_list_value == 2){
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
	<li <?php if($bc_bullet_value==2){?> style="list-style-type:none;<?php } ?>"><!-- Buffercode.com Category Link Start -->
		<a href="<?php the_permalink(); ?>"><?php $check_title=get_the_title(); $title_count=strlen($check_title);
		if ($title_count>$bc_title_count_value){
		$substr_title=substr($check_title, 0, $bc_title_count_value);
		echo $substr_title.'...';
		}else{echo $check_title;	}
		?></a>
		<!-- Buffercode.com Category Link Ends -->
	</li>
<?php endforeach;  } else {?>

<select id="buffercode_option">
<option value="" selected ><?php echo $bc_please_select_value; ?></option>
<?php foreach ( $myposts as $post ) : setup_postdata( $post ); 
		
		$check_title=get_the_title();
		$title_count=strlen($check_title);
		if ($title_count>$bc_title_count_value){
		$substr_title=substr($check_title, 0, $bc_title_count_value).'...';
		}else{$substr_title=$check_title;	}
		?>
	<!-- Buffercode.com Category Link Start -->
		<option value="<?php echo the_permalink(); ?>"><?php echo $substr_title ?></option>
		<!-- Buffercode.com Category Link Ends -->
	
<?php endforeach; ?>
</select>
<script>
window.onload=function(){
    var combo=document.getElementById('buffercode_option');
    combo.onchange=function(){
        if(this.value!='0') window.open(this.value, '_self');
    };
};
</script>
<?php
}
wp_reset_postdata();
echo $after_widget;
}
}

?>
