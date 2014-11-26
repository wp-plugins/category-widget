<?php
/*
  Plugin Name: Category Widget
  Plugin URI: http://buffercode.com/plugin-display-post-titles-category-selection/
  Description: Easy way to display the number of post in that particular category by selecting from admin dashboard widget.
  Version: 1.6
  Author: vinoth06
  Author URI: http://buffercode.com/
  License: GPLv2
  License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

// Additing Action hook widgets_init
add_action('widgets_init', 'buffercode_category_widget');

function buffercode_category_widget() {
    register_widget('buffercode_category_widget_info');
}

class buffercode_category_widget_info extends WP_Widget {

    function buffercode_category_widget_info() {
        $this->WP_Widget('buffercode_category_widget_info', 'BC Category Widget', 'Select the category to display');
    }

    public function form($instance) {
        if (isset($instance['buffercode_no_post']) && isset($instance['buffercode_category']) && isset($instance['buffercode_name']) && isset($instance['buffercode_bullet']) && isset($instance['buffercode_title_count']) && isset($instance['buffercode_combo_list']) && isset($instance['buffercode_please_select']) && isset($instance['buffercode_orderby']) && isset($instance['buffercode_header_link'])) {
            $buffercode_no_post_value = $instance['buffercode_no_post'];
            $buffercode_category_value = $instance['buffercode_category'];
            $buffercode_name_value = $instance['buffercode_name'];
            $buffercode_bullet_value = $instance['buffercode_bullet'];
            $buffercode_title_count_value = $instance['buffercode_title_count'];
            $buffercode_combo_list_value = $instance['buffercode_combo_list'];
            $buffercode_please_select_value = $instance['buffercode_please_select'];
            $buffercode_orderby_value = $instance['buffercode_orderby'];
            $buffercode_header_link_value = $instance['buffercode_header_link'];
        } else {//Setting Default Values
            $buffercode_no_post_value = 5;
            $buffercode_category_value = 1;
            $buffercode_name_value = 'My Category';
            $buffercode_bullet_value = 2;
            $buffercode_title_count_value = 20;
            $buffercode_combo_list_value = 1;
            $buffercode_orderby_value = 4;
            $buffercode_please_select_value = 'Please Select';
            $buffercode_header_link_value = 2;
        }
        ?><!-- buffercode Category Widget Options -->
        <p>Name: <input class="widefat" name="<?php echo $this->get_field_name('buffercode_name'); ?>" type="text" value="<?php echo esc_attr($buffercode_name_value); ?>" /></p>

        <p>Select Category: <?php wp_dropdown_categories(array('name' => $this->get_field_name('buffercode_category'), 'selected' => $buffercode_category_value, 'id' => $this->get_field_id('buffercode_category'), 'class' => 'widefat')); ?> </p>

        <p>Number of Post:
            <select name="<?php echo $this->get_field_name('buffercode_no_post'); ?>" id="<?php echo $this->get_field_id('buffercode_no_post'); ?>" class="widefat">
                <?php
                $options = array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', 'All' => '11');
                foreach ($options as $langu => $code) {
                    echo '<option value="' . $code . '" id="' . $code . '"', $buffercode_no_post_value == $code ? ' selected="selected"' : '', '>', $langu, '</option>';
                }
                ?>
            </select></p>

        <p>Display in Combo box or List:
            <select name="<?php echo $this->get_field_name('buffercode_combo_list'); ?>" id="<?php echo $this->get_field_id('buffercode_combo_list'); ?>" class="widefat">
                <?php
                $cl_options = array('Combo Box' => '1', 'List' => '2');
                foreach ($cl_options as $cl_langu => $cl_code) {
                    echo '<option value="' . $cl_code . '" id="' . $cl_code . '"', $buffercode_combo_list_value == $cl_code ? ' selected="selected"' : '', '>', $cl_langu, '</option>';
                }
                ?>
            </select></p>

        <p>Show Bullet Style:
            <select name="<?php echo $this->get_field_name('buffercode_bullet'); ?>" id="<?php echo $this->get_field_id('buffercode_bullet'); ?>" class="widefat">
                <?php
                $bullet_options = array('Yes' => '1', 'No' => '2');
                foreach ($bullet_options as $bullet_value => $bullet_code) {
                    echo '<option value="' . $bullet_code . '" id="' . $bullet_code . '"', $buffercode_bullet_value == $bullet_code ? ' selected="selected"' : '', '>', $bullet_value, '</option>';
                }
                ?>
            </select></p>

        <p>Order by:
            <select name="<?php echo $this->get_field_name('buffercode_orderby'); ?>" id="<?php echo $this->get_field_id('buffercode_orderby'); ?>" class="widefat">
                <?php
                $orderby_options = array('Random' => '1', 'Ascending' => '2', 'Descending' => '3', 'Recent Post' => '4', 'Post Modified' => '5');
                foreach ($orderby_options as $orderby_value => $orderby_code) {
                    echo '<option value="' . $orderby_code . '" id="' . $orderby_code . '"', $buffercode_orderby_value == $orderby_code ? ' selected="selected"' : '', '>', $orderby_value, '</option>';
                }
                ?>
            </select></p>

        <p>Max Title Size:<input class="widefat" name="<?php echo $this->get_field_name('buffercode_title_count'); ?>" type="text" value="<?php echo esc_attr($buffercode_title_count_value); ?>" /></p>

        <p>Custom Combo Box "Please Select":<input class="widefat" name="<?php echo $this->get_field_name('buffercode_please_select'); ?>" type="text" value="<?php echo esc_attr($buffercode_please_select_value); ?>" /></p>

        <p>Header link Clickable ?:
            <select name="<?php echo $this->get_field_name('buffercode_header_link'); ?>" id="<?php echo $this->get_field_id('buffercode_header_link'); ?>" class="widefat">
                <?php
                $header_link_options = array('Yes' => '1', 'No' => '2');
                foreach ($header_link_options as $header_link_value => $header_link_code) {
                    echo '<option value="' . $header_link_code . '" id="' . $header_link_code . '"', $buffercode_header_link_value == $header_link_code ? ' selected="selected"' : '', '>', $header_link_value, '</option>';
                }
                ?>
            </select></p>

        <p>Suggestion or Feedback : <a href="http://buffercode.com">Contact us</a> | Plugin Helpful? - <a href="http://buffercode.com">Please Donate us</a></p>

        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['buffercode_no_post'] = (!empty($new_instance['buffercode_no_post']) ) ? strip_tags($new_instance['buffercode_no_post']) : '';

        $instance['buffercode_category'] = (!empty($new_instance['buffercode_category']) ) ? strip_tags($new_instance['buffercode_category']) : '';

        $instance['buffercode_name'] = (!empty($new_instance['buffercode_name']) ) ? strip_tags($new_instance['buffercode_name']) : '';

        $instance['buffercode_bullet'] = (!empty($new_instance['buffercode_bullet']) ) ? strip_tags($new_instance['buffercode_bullet']) : '';

        $instance['buffercode_title_count'] = (!empty($new_instance['buffercode_title_count']) ) ? strip_tags($new_instance['buffercode_title_count']) : '';

        $instance['buffercode_combo_list'] = (!empty($new_instance['buffercode_combo_list']) ) ? strip_tags($new_instance['buffercode_combo_list']) : '';

        $instance['buffercode_orderby'] = (!empty($new_instance['buffercode_orderby']) ) ? strip_tags($new_instance['buffercode_orderby']) : '';

        $instance['buffercode_header_link'] = (!empty($new_instance['buffercode_header_link']) ) ? strip_tags($new_instance['buffercode_header_link']) : '';

        $instance['buffercode_please_select'] = (!empty($new_instance['buffercode_please_select']) ) ? strip_tags($new_instance['buffercode_please_select']) : '';
        return $instance;
    }

    function widget($args, $instance) {
        extract($args);
        echo $before_widget;
        $buffercode_name_value = apply_filters('widget_title', $instance['buffercode_name']);
        $buffercode_category_value = empty($instance['buffercode_category']) ? '&nbsp;' :
                $instance['buffercode_category'];
        $buffercode_no_post_value = empty($instance['buffercode_no_post']) ? '&nbsp;' :
                $instance['buffercode_no_post'];
        $buffercode_bullet_value = empty($instance['buffercode_bullet']) ? '&nbsp;' :
                $instance['buffercode_bullet'];
        $buffercode_title_count_value = empty($instance['buffercode_title_count']) ? '&nbsp;' :
                $instance['buffercode_title_count'];
        $buffercode_combo_list_value = empty($instance['buffercode_combo_list']) ? '&nbsp;' :
                $instance['buffercode_combo_list'];
        $buffercode_please_select_value = empty($instance['buffercode_please_select']) ? 'Please Select' :
                $instance['buffercode_please_select'];
        $buffercode_orderby_value = empty($instance['buffercode_orderby']) ? '&nbsp;' :
                $instance['buffercode_orderby'];
        $buffercode_header_link_value = empty($instance['buffercode_header_link']) ? '&nbsp;' :
                $instance['buffercode_header_link'];

        $buffercode_cat_site_url = get_site_url();
        $buffercode_category_id = get_the_category_by_ID($buffercode_category_value);
        $category_id_str_replaced = strtolower(str_replace(" ", "-", $buffercode_category_id));

        if ($buffercode_header_link_value == 1)
            $buffercode_header_link_t_f = '<a href="' . $buffercode_cat_site_url . '/category/' . $category_id_str_replaced . '">' . $buffercode_name_value . '</a>';
        else
            $buffercode_header_link_t_f = $buffercode_name_value;

        if (!empty($name)) {
            echo $before_title . $buffercode_header_link_t_f . $after_title;
        }
        if ($buffercode_no_post_value == 11) {
            $buffercode_no_post_values = -1;
        } else {
            $buffercode_no_post_values = $buffercode_no_post_value;
        }

        if ($buffercode_orderby_value == 3) {
            $args = array('category' => $buffercode_category_value, 'posts_per_page' => $buffercode_no_post_values, 'order' => 'DESC', 'orderby' => 'title');
        } else if ($buffercode_orderby_value == 2) {
            $args = array('category' => $buffercode_category_value, 'posts_per_page' => $buffercode_no_post_values, 'order' => 'ASC', 'orderby' => 'title');
        } else if ($buffercode_orderby_value == 1) {
            $args = array('category' => $buffercode_category_value, 'posts_per_page' => $buffercode_no_post_values, 'orderby' => 'rand');
        }  else if ($buffercode_orderby_value == 5) {
            $args = array('category' => $buffercode_category_value, 'posts_per_page' => $buffercode_no_post_values, 'orderby' => 'modified');
        } else {
            $args = array('category' => $buffercode_category_value, 'posts_per_page' => $buffercode_no_post_values, 'orderby' => 'ID');
        }

        $myposts = get_posts($args);
        global $post;
        if ($buffercode_combo_list_value == 2) {
		echo '<ul>';
            foreach ($myposts as $post) : setup_postdata($post);
                ?>
                <li <?php if ($buffercode_bullet_value == 2) { ?> style="list-style-type:none;"<?php } ?>><!-- buffercode Category Link Start -->
                    <a href="<?php the_permalink(); ?>"><?php
                $check_title = get_the_title();
                $title_count = strlen($check_title);
                if ($title_count > $buffercode_title_count_value) {
                    $substr_title = substr($check_title, 0, $buffercode_title_count_value);
                    echo $substr_title . '...';
                } else {
                    echo $check_title;
                }
                ?></a>
                    <!-- buffercode Category Link Ends -->
                </li>
            <?php endforeach;
			echo '</ul>';
        } else { ?>

            <select onchange="window.location.href = this.options[this.selectedIndex].value">
                <option value="" selected ><?php echo $buffercode_please_select_value; ?></option>
                <?php
                foreach ($myposts as $post) : setup_postdata($post);

                    $check_title = get_the_title();
                    $title_count = strlen($check_title);
                    if ($title_count > $buffercode_title_count_value) {
                        $substr_title = substr($check_title, 0, $buffercode_title_count_value) . '...';
                    } else {
                        $substr_title = $check_title;
                    }
                    ?>
                    <!-- buffercode Category Link Start -->
                    <option value="<?php echo the_permalink(); ?>"><?php echo $substr_title ?></option>
                    <!-- buffercode Category Link Ends -->

            <?php endforeach; ?>
            </select>

            <?php
        }
        wp_reset_postdata();
        echo $after_widget;
    }

}
?>
