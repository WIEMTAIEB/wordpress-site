<?php
/**
 * Engage Mag Grid Post Widget.
 *
 * @since 1.0.0
 */
if (!class_exists('Engage_Mag_Thumb_Posts')) :

    /**
     * Highlight Post widget class.
     *
     * @since 1.0.0
     */
    class Engage_Mag_Thumb_Posts extends WP_Widget
    {
        private function defaults()
        {
            $defaults = array(
                'title' => esc_html__('Thumbnail Posts', 'engage-mag'),
                'cat' => 0,
                'post-number' => 6,
                'post-date' => 1,
                'show-category' => 0,
                'show-excerpt' => 0,
                'excerpt-length' => 15,
                'column_number_layout'=> 0,

            );
            return $defaults;
        }

        public function __construct()
        {
            $opts = array(
                'classname' => 'engage-mag-thumbnail-post',
                'description' => esc_html__('Help to display content in thumbnail image Layout.', 'engage-mag'),
            );

            parent::__construct('engage-mag-thumbnail-post', esc_html__('Engage Mag Thumbnail Post', 'engage-mag'), $opts);
        }

        public function widget($args, $instance)
        {
            $instance = wp_parse_args((array)$instance, $this->defaults());
            $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
            echo $args['before_widget'];

            $cat_id = !empty($instance['cat']) ? $instance['cat'] : '';
            $post_number = !empty($instance['post-number']) ? $instance['post-number'] : 6;
            $post_date = !empty($instance['post-date']) ? $instance['post-date'] : 0;
            $show_category = !empty($instance['show-category']) ? $instance['show-category'] : 0;
            $show_excerpt = !empty($instance['show-excerpt']) ? $instance['show-excerpt'] : 0;
            $excerpt_length = !empty($instance['excerpt-length']) ? $instance['excerpt-length'] : '';
             $column_number_layout = absint( $instance['column_number_layout'] );

            if($column_number_layout == 0){
                $col_class = 'ct-cols';
            }elseif($column_number_layout == 2){
                $col_class = 'ct-cols ct-three-cols';
            }elseif($column_number_layout == 3){
                $col_class = 'ct-cols ct-four-cols';
            }else{
                $col_class = 'ct-cols ct-two-cols';
            }
            $row_class ="";
            if($column_number_layout == 3){
                $row_class ="ct-four-row";
            }

            global $engage_mag_theme_options;
            $hide_read_time = $engage_mag_theme_options['engage-mag-extra-hide-read-time'];

            if (!empty($title)) {
                $cat_class = 'cat-' . $cat_id;
                ?>
                <div class="title-wrapper <?php echo $cat_class; ?>">
                    <?php
                    echo $args['before_title'];
                    if (!empty($cat_id)) {
                        ?>
                        <a href="<?php echo esc_url(get_category_link($cat_id)); ?>"> <?php echo esc_html($title); ?> </a>
                        <?php
                    } else {
                        echo esc_html($title);
                    }
                    echo $args['after_title'];
                    ?>
                </div>
                <?php
            }

            $query_args = array(
                'post_type' => 'post',
                'cat' => absint($cat_id),
                'posts_per_page' => absint($post_number),
                'ignore_sticky_posts' => true
            );

            $query = new WP_Query($query_args);

            if ($query->have_posts()) :

                ?>
                <div class="ct-grid-post clearfix <?php echo $row_class; ?>">
                    <?php
                    while ($query->have_posts()) :
                        $query->the_post();
                        ?>
                        <div class="<?php echo $col_class; ?>">

                            <div class="list-post-block">
                                <div class="list-post">
                                    <div class="post-block-style">

                                        <?php
                                        if (has_post_thumbnail()) {
                                            ?>
                                            <div class="post-thumb">
                                            <?php
                                            engage_mag_post_formats(get_the_ID());
                                            ?>
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('thumbnail'); ?>
                                                </a>
                                            </div>
                                            <?php
                                        } else { ?>
                                            <div class="post-thumb">
                                                <a href="<?php the_permalink(); ?>">
                                                    <img src="<?php echo esc_url (get_template_directory_uri()) . '/candidthemes/assets/images/refined-mag-thumb.jpg' ?>"
                                                         alt="<?php the_title(); ?>">
                                                </a>
                                            </div><!-- Post thumb end -->
                                        <?php }
                                        ?>
                                        <div class="post-content">
                                             <?php if ($show_category == 1) { ?>
                                            <div class="post-meta">
                                                <?php
                                                engage_mag_list_category(get_the_ID());
                                                ?>
                                            </div>
                                        <?php } ?>
                                            <div class="featured-post-title">
                                                <h3 class="post-title"><a
                                                            href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h3>

                                            </div>
                                           <?php if ($post_date == 1 || $hide_read_time != 1) { ?>
                                            <div class="post-meta">
                                                <?php
                                                if ($post_date == 1) {
                                                    engage_mag_posted_on();
                                                }
                                                if ($hide_read_time != 1) {
                                                    engage_mag_read_time_words_count(get_the_ID());
                                                }

                                                ?>
                                            </div>
                                        <?php } ?>
                                        <?php if ($show_excerpt == 1) { ?>
                                            <div class="post-excerpt">
                                                <?php echo engage_mag_excerpt_words(get_the_ID(), absint($excerpt_length)); ?>
                                            </div>
                                        <?php } ?>
                                            <?php
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            <?php
            endif;

            echo $args['after_widget'];

        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance['title'] = sanitize_text_field($new_instance['title']);
            $instance['cat'] = absint($new_instance['cat']);
            $instance['post-number'] = absint($new_instance['post-number']);
            $instance['post-date'] = absint($new_instance['post-date']);
            $instance['show-category'] = absint($new_instance['show-category']);
            $instance['show-excerpt'] = absint($new_instance['show-excerpt']);
            $instance['excerpt-length'] = absint($new_instance['excerpt-length']);

             $instance['column_number_layout'] = isset($new_instance['column_number_layout'])? absint( $new_instance['column_number_layout'] ) : 1;
            return $instance;

        }

        public function form($instance)
        {
            $instance = wp_parse_args((array )$instance, $this->defaults());

            $title = esc_attr($instance['title']);
            $post_number = absint($instance['post-number']);
            $post_date = absint($instance['post-date']);
            $show_category = absint($instance['show-category']);
            $show_excerpt = absint($instance['show-excerpt']);
            $excerpt_length = absint($instance['excerpt-length']);
            $layout_arrays = array( __('Column 1','engage-mag'), __('Column 2','engage-mag'), __('Column 3','engage-mag'),  __('Column 4','engage-mag')  );
            $column_number_layout = $instance['column_number_layout'];
            ?>
            <p>
                <label
                        for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'engage-mag'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                       value="<?php echo esc_attr($instance['title']); ?>"/>
            </p>
            <p class="custom-dropdown-posts">
                <label for="<?php echo esc_attr($this->get_field_name('cat')); ?>">
                    <strong><?php esc_html_e('Select Category: ', 'engage-mag'); ?></strong>
                </label>
                <?php
                $cat_args = array(
                    'orderby' => 'name',
                    'hide_empty' => 0,
                    'id' => $this->get_field_id('cat'),
                    'name' => $this->get_field_name('cat'),
                    'class' => 'widefat',
                    'taxonomy' => 'category',
                    'selected' => absint($instance['cat']),
                    'show_option_all' => esc_html__('Show Recent Posts', 'engage-mag')
                );
                wp_dropdown_categories($cat_args);
                ?>
            </p>

            <p>
                <label
                        for="<?php echo esc_attr($this->get_field_id('post-number')); ?>"><?php esc_html_e('Number of Posts to Display:', 'engage-mag'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('post-number')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('post-number')); ?>" type="number"
                       value="<?php echo esc_attr($instance['post-number']); ?>"/>
            </p>
            <p>
                <label
                        for="<?php echo esc_attr($this->get_field_id('excerpt-length')); ?>"><?php esc_html_e('Number of Words Normal Excerpt:', 'engage-mag'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('excerpt-length')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('excerpt-length')); ?>" type="number"
                       value="<?php echo esc_attr($instance['excerpt-length']); ?>"/>
            </p>
            <p>
                <label
                        for="<?php echo esc_attr($this->get_field_id('show-excerpt')); ?>"><?php esc_html_e('Show Normal Post Excerpt:', 'engage-mag'); ?></label>
                <input class="widefat ct-show-hide" id="<?php echo esc_attr($this->get_field_id('show-excerpt')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('show-excerpt')); ?>" type="checkbox"
                       value="<?php echo $show_excerpt; ?>" <?php checked(($instance['show-excerpt'] == 1) ? $instance['show-excerpt'] : 0); ?>/>
            </p>

            <p>
                <label
                        for="<?php echo esc_attr($this->get_field_id('post-date')); ?>"><?php esc_html_e('Show Post Date:', 'engage-mag'); ?></label>
                <input class="widefat ct-show-hide" id="<?php echo esc_attr($this->get_field_id('post-date')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('post-date')); ?>" type="checkbox"
                       value="<?php echo $post_date; ?>" <?php checked(($instance['post-date'] == 1) ? $instance['post-date'] : 0); ?>/>
            </p>

            <p>
                <label
                        for="<?php echo esc_attr($this->get_field_id('show-category')); ?>"><?php esc_html_e('Show Post Category:', 'engage-mag'); ?></label>
                <input class="widefat ct-show-hide" id="<?php echo esc_attr($this->get_field_id('show-category')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('show-category')); ?>" type="checkbox"
                       value="<?php echo $show_category; ?>" <?php checked(($instance['show-category'] == 1) ? $instance['show-category'] : 0); ?>/>
            </p>
            
            <p>
                <label for="<?php echo $this->get_field_id( 'column_number_layout' ); ?>">
                    <?php _e( 'Select the column number', 'engage-mag' ); ?>
                </label>
                <select class="widefat" id="<?php echo $this->get_field_id( 'column_number_layout' ); ?>" name="<?php echo $this->get_field_name( 'column_number_layout' ); ?>">
                    <?php
                    foreach( $layout_arrays as $key => $column_array ){
                        echo ' <option value="'.$key.'"'.selected( $column_number_layout, $key, 0).'>'.$column_array.'</option>';
                    }
                    ?>
                </select>
                </p>

            <?php
        }
    }

endif;