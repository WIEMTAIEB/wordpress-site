<?php
/**
 * Engage News Category Three Column Widget
 *
 * @since 1.0.0
 */
if (!class_exists('Engage_News_Category_Three_Column')) {
    /**
     * Highlight Post widget class.
     *
     * @since 1.0.0
     */
    class Engage_News_Category_Three_Column extends WP_Widget
    {
        private function defaults()
        {
            $defaults = array(
                'cat_id_1' => 0,
                'cat_id_2' => 0,
                'cat_id_3' => 0,
                'post_number' => 5,
            );
            return $defaults;

        }

        public function __construct()
        {
            $opts = array(
                'classname' => 'engage-news-cat_column',
                'description' => esc_html__('Three Category Column Widget.', 'engage-news'),
            );
            parent::__construct('engage_news_three_category_column_widget', esc_html__('Engage Mag Three Category Column', 'engage-news'), $opts);
        }

        public function widget($args, $instance)
        {
            $instance = wp_parse_args((array)$instance, $this->defaults());

            $cat_id_1 = absint($instance['cat_id_1']);
            $cat_id_2 = absint($instance['cat_id_2']);
            $cat_id_3 = absint($instance['cat_id_3']);
            $post_number = absint($instance['post_number']);
            $cat1_class = 'cat-' . $cat_id_1;
            $cat2_class = 'cat-' . $cat_id_2;
            $cat3_class = 'cat-' . $cat_id_3;

            echo $args['before_widget'];
            global $engage_mag_theme_options;
            $show_default_image = $engage_mag_theme_options['engage-mag-extra-hide-default-thumbnails'];
            $hide_read_time = $engage_mag_theme_options['engage-mag-extra-hide-read-time'];
            ?>
            <div class="block ct-cat-cols">
                <div class="row clearfix">
                    <div class="ct-three-cols">


                        <?php
                        if ($cat_id_1) {
                            ?>
                            <h2 class="widget-title <?php echo $cat1_class; ?>">
                                <a href="<?php echo esc_url(get_category_link($cat_id_1)); ?>">

                                    <?php echo esc_html(get_cat_name($cat_id_1)); ?>

                                </a>

                            </h2>
                            <?php
                        }
                        ?>

                        <?php
                        $i = 1;
                        $two_category_section = array(
                            'ignore_sticky_posts' => true,
                            'post_type' => 'post',
                            'cat' => $cat_id_1,
                            'posts_per_page' => $post_number,
                            'order' => 'DESC'
                        );
                        $two_category_section_query = new WP_Query($two_category_section);

                        if ($i == 1) {
                            ?>
                            <div class="ct-post-overlay">
                                <?php
                                while ($two_category_section_query->have_posts()):
                                    $two_category_section_query->the_post();
                                    $post_class = '';
                                    if (has_post_thumbnail()) {

                                        ?>

                                        <div class="post-thumb">
                                            <?php
                                            engage_mag_post_formats(get_the_ID());
                                            ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('engage-mag-carousel-img'); ?>
                                            </a>
                                        </div>

                                    <?php } elseif ($show_default_image != 1) {
                                        ?>

                                        <div class="post-thumb">
                                            <?php
                                            engage_mag_post_formats(get_the_ID());
                                            ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php echo esc_url(get_template_directory_uri()) . '/candidthemes/assets/images/refined-mag-carousel.jpg' ?>"
                                                     alt="<?php the_title(); ?>">

                                            </a>
                                        </div>

                                        <?php
                                    } else {
                                        $post_class = 'post-relative';
                                    } ?>
                                    <div class="post-content <?php echo $post_class; ?>">
                                            <div class="post-meta">
                                                <?php
                                                engage_mag_list_category(get_the_ID());
                                                ?>
                                            </div>
                                        <h3 class="post-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                            <div class="post-meta">
                                                <?php
                                                    engage_mag_posted_on();
                                                
                                                    engage_mag_read_time_words_count(get_the_ID());
                                                

                                                ?>
                                            </div>
                                       
                                    </div><!-- Post content end -->

                                    <?php $i++;
                                    break; endwhile;
                                ?>

                            </div><!-- Post Overaly Article end -->
                            <?php
                        }
                        if ($i >= 2) {
                            ?>
                            <div class="list-post-block">
                                <ul class="list-post">
                                    <?php
                                    while ($two_category_section_query->have_posts()):
                                        $two_category_section_query->the_post();
                                        ?>
                                        <li>
                                            <div class="post-block-style">

                                                <?php

                                                if (has_post_thumbnail()) {
                                                    ?>
                                                    <div class="post-thumb">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_post_thumbnail('thumbnail'); ?>
                                                        </a>
                                                    </div><!-- Post thumb end -->
                                                <?php } elseif ($show_default_image != 1) { ?>
                                                    <div class="post-thumb">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <img src="<?php echo esc_url(get_template_directory_uri()) . '/candidthemes/assets/images/refined-mag-thumb.jpg' ?>"
                                                                 alt="<?php the_title(); ?>">
                                                        </a>
                                                    </div><!-- Post thumb end -->
                                                <?php } ?>

                                                <div class="post-content">
                                                        <div class="post-meta">
                                                            <?php
                                                            engage_mag_list_category(get_the_ID());
                                                            ?>
                                                        </div>
                                                    <h3 class="post-title">
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h3>
                                                        <div class="post-meta">
                                                            <?php
                                                            
                                                                engage_mag_posted_on();
                                                            
                                                                engage_mag_read_time_words_count(get_the_ID());
                                                            

                                                            ?>
                                                        </div>
                                                    
                                                </div><!-- Post content end -->
                                            </div><!-- Post block style end -->
                                        </li><!-- Li 1 end -->

                                        <?php $i++; endwhile;
                                    wp_reset_postdata();
                                    ?>


                                </ul><!-- List post end -->
                            </div><!-- List post block end -->
                            <?php
                        }
                        ?>

                    </div><!-- Col 1 end -->

                    <div class="ct-three-cols">

                        <?php
                        if ($cat_id_2) {
                            ?>
                            <h2 class="widget-title <?php echo $cat2_class; ?>">
                                <a href="<?php echo esc_url(get_category_link($cat_id_2)); ?>">
                                    <?php echo esc_html(get_cat_name($cat_id_2)); ?>
                                </a>
                            </h2>
                            <?php
                        }
                        ?>
                        <?php
                        $i = 1;
                        $two_category_section = array(
                            'ignore_sticky_posts' => true,
                            'post_type' => 'post',
                            'cat' => $cat_id_2,
                            'posts_per_page' => $post_number,
                            'order' => 'DESC'
                        );
                        $two_category_section_query = new WP_Query($two_category_section);

                        if ($i == 1) {
                            ?>

                            <div class="ct-post-overlay clearfix">
                                <?php

                                $ID = array();
                                while ($two_category_section_query->have_posts()):
                                    $two_category_section_query->the_post();

                                    $ID[] = get_the_ID();

                                    $post_class = '';
                                    if (has_post_thumbnail()) {

                                        ?>

                                        <div class="post-thumb">
                                            <?php
                                            engage_mag_post_formats(get_the_ID());
                                            ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('engage-mag-carousel-img'); ?>
                                            </a>
                                        </div>

                                    <?php } elseif ($show_default_image != 1) {
                                        ?>

                                        <div class="post-thumb">
                                            <?php
                                            engage_mag_post_formats(get_the_ID());
                                            ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php echo esc_url(get_template_directory_uri()) . '/candidthemes/assets/images/refined-mag-carousel.jpg' ?>"
                                                     alt="<?php the_title(); ?>">

                                            </a>
                                        </div>

                                        <?php
                                    } else {
                                        $post_class = 'post-relative';
                                    } ?>
                                    <div class="post-content <?php echo $post_class; ?>">
                                            <div class="post-meta">
                                                <?php
                                                engage_mag_list_category(get_the_ID());
                                                ?>
                                            </div>
                                        <h3 class="post-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                            <div class="post-meta">
                                                <?php
                                                    engage_mag_posted_on();
                                                
                                                    engage_mag_read_time_words_count(get_the_ID());
                                                

                                                ?>
                                            </div>
                                        
                                    </div><!-- Post content end -->

                                    <?php
                                    $i++;
                                    break;
                                endwhile;
                                ?>

                            </div><!-- Post Overaly Article end -->
                            <?php
                        }

                        if ($i >= 2) {
                            ?>
                            <div class="list-post-block">
                                <ul class="list-post">
                                    <?php
                                    while ($two_category_section_query->have_posts()):
                                        $two_category_section_query->the_post();
                                        ?>
                                        <li>
                                            <div class="post-block-style">

                                                <?php

                                                if (has_post_thumbnail()) {
                                                    ?>
                                                    <div class="post-thumb">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_post_thumbnail('thumbnail'); ?>
                                                        </a>
                                                    </div><!-- Post thumb end -->
                                                <?php } elseif ($show_default_image != 1) { ?>
                                                    <div class="post-thumb">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <img src="<?php echo esc_url(get_template_directory_uri()) . '/candidthemes/assets/images/refined-mag-thumb.jpg' ?>"
                                                                 alt="<?php the_title(); ?>">
                                                        </a>
                                                    </div><!-- Post thumb end -->
                                                <?php } ?>

                                                <div class="post-content">
                                                        <div class="post-meta">
                                                            <?php
                                                            engage_mag_list_category(get_the_ID());
                                                            ?>
                                                        </div>
                                                    <h3 class="post-title">
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h3>
                                                        <div class="post-meta">
                                                            <?php
                                                            
                                                                engage_mag_posted_on();
                                                            
                                                            
                                                                engage_mag_read_time_words_count(get_the_ID());
                                                            

                                                            ?>
                                                        </div>                                                   
                                                </div><!-- Post content end -->
                                            </div><!-- Post block style end -->
                                        </li><!-- Li 1 end -->

                                        <?php
                                        $i++;
                                    endwhile;
                                    wp_reset_postdata();
                                    ?>

                                </ul><!-- List post end -->
                            </div><!-- List post block end -->
                            <?php
                        }
                        ?>
                    </div><!-- Col 2 end -->
                    <div class="ct-three-cols">

                        <?php
                        if ($cat_id_3) {
                            ?>
                            <h2 class="widget-title <?php echo $cat3_class; ?>">
                                <a href="<?php echo esc_url(get_category_link($cat_id_3)); ?>">
                                    <?php echo esc_html(get_cat_name($cat_id_3)); ?>
                                </a>
                            </h2>
                            <?php
                        }
                        ?>

                        <?php
                        $i = 1;
                        $two_category_section = array(
                            'ignore_sticky_posts' => true,
                            'post_type' => 'post',
                            'cat' => $cat_id_3,
                            'posts_per_page' => $post_number,
                            'order' => 'DESC'
                        );
                        $two_category_section_query = new WP_Query($two_category_section);

                        if ($i == 1) {
                            ?>

                            <div class="ct-post-overlay clearfix">
                                <?php

                                $ID = array();
                                while ($two_category_section_query->have_posts()):
                                    $two_category_section_query->the_post();

                                    $ID[] = get_the_ID();

                                    $post_class = '';
                                    if (has_post_thumbnail()) {

                                        ?>

                                        <div class="post-thumb">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('engage-mag-carousel-img'); ?>
                                            </a>
                                        </div>

                                    <?php } elseif ($show_default_image != 1) {
                                        ?>

                                        <div class="post-thumb">
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php echo esc_url(get_template_directory_uri()) . '/candidthemes/assets/images/refined-mag-carousel.jpg' ?>"
                                                     alt="<?php the_title(); ?>">

                                            </a>
                                        </div>

                                        <?php
                                    } else {
                                        $post_class = 'post-relative';
                                    } ?>
                                    <div class="post-content <?php echo $post_class; ?>">
                                            <div class="post-meta">
                                                <?php
                                                engage_mag_list_category(get_the_ID());
                                                ?>
                                            </div>
                                        <h3 class="post-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                            <div class="post-meta">
                                                <?php
                                                    engage_mag_posted_on();
                                                
                                                    engage_mag_read_time_words_count(get_the_ID());
                                                

                                                ?>
                                            </div>
                                            
                                    </div><!-- Post content end -->

                                    <?php $i++;
                                    break;endwhile;
                                ?>

                            </div><!-- Post Overaly Article end -->
                            <?php
                        }

                        if ($i >= 2) {
                            ?>
                            <div class="list-post-block">
                                <ul class="list-post">
                                    <?php
                                    while ($two_category_section_query->have_posts()):
                                        $two_category_section_query->the_post();
                                        ?>
                                        <li>
                                            <div class="post-block-style">

                                                <?php

                                                if (has_post_thumbnail()) {
                                                    ?>
                                                    <div class="post-thumb">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_post_thumbnail('thumbnail'); ?>
                                                        </a>
                                                    </div><!-- Post thumb end -->
                                                <?php } elseif ($show_default_image != 1) { ?>
                                                    <div class="post-thumb">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <img src="<?php echo esc_url(get_template_directory_uri()) . '/candidthemes/assets/images/refined-mag-thumb.jpg' ?>"
                                                                 alt="<?php the_title(); ?>">
                                                        </a>
                                                    </div><!-- Post thumb end -->
                                                <?php } ?>

                                                <div class="post-content">
                                                    
                                                        <div class="post-meta">
                                                            <?php
                                                            engage_mag_list_category(get_the_ID());
                                                            ?>
                                                        </div>
                                                    <h3 class="post-title">
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h3>
                                                    
                                                        <div class="post-meta">
                                                            <?php
                                                            
                                                                engage_mag_posted_on();
                                                            
                                                            
                                                                engage_mag_read_time_words_count(get_the_ID());


                                                            ?>
                                                        </div>
                                                </div><!-- Post content end -->
                                            </div><!-- Post block style end -->
                                        </li><!-- Li 1 end -->

                                        <?php $i++;endwhile;
                                    wp_reset_postdata(); ?>

                                </ul><!-- List post end -->
                            </div><!-- List post block end -->
                        <?php } ?>
                    </div><!-- Col 3 end -->
                </div><!-- Row end -->
            </div><!-- Block Lifestyle end -->
            <div class="gap-40"></div>

            <?php
            echo $args['after_widget'];
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance['cat_id_1'] = (isset($new_instance['cat_id_1'])) ? absint($new_instance['cat_id_1']) : '';
            $instance['cat_id_2'] = (isset($new_instance['cat_id_2'])) ? absint($new_instance['cat_id_2']) : '';
            $instance['cat_id_3'] = (isset($new_instance['cat_id_3'])) ? absint($new_instance['cat_id_3']) : '';
            $instance['post_number'] = absint($new_instance['post_number']);
            return $instance;
        }

        public function form($instance)

        {
            $instance = wp_parse_args((array )$instance, $this->defaults());
            $cat_id_1 = absint($instance['cat_id_1']);
            $cat_id_2 = absint($instance['cat_id_2']);
            $cat_id_3 = absint($instance['cat_id_3']);
            $post_number = absint($instance['post_number']);
            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('cat_id_1')); ?>">
                    <strong><?php esc_html_e('Select Category for Column One', 'engage-news'); ?></strong>
                </label><br/>
                <?php
                $engage_mag_category_col_1_dropown_cat = array(
                    'show_option_all' => esc_html__('Show Recent Posts', 'engage-news'),
                    'orderby' => 'name',
                    'order' => 'asc',
                    'show_count' => 1,
                    'hide_empty' => 1,
                    'echo' => 1,
                    'selected' => absint($instance['cat_id_1']),
                    'hierarchical' => 1,
                    'name' => esc_attr($this->get_field_name('cat_id_1')),
                    'id' => esc_attr($this->get_field_name('cat_id_1')),
                    'class' => 'widefat',
                    'taxonomy' => 'category',
                    'hide_if_empty' => false,
                );
                wp_dropdown_categories($engage_mag_category_col_1_dropown_cat);
                ?>
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('cat_id_2')); ?>">
                    <strong><?php esc_html_e('Select Category for Column Two', 'engage-news'); ?></strong>
                </label><br/>
                <?php
                $engage_mag_category_col_2_dropown_cat = array(
                    'show_option_all' => esc_html__('Show Recent Posts', 'engage-news'),
                    'orderby' => 'name',
                    'order' => 'asc',
                    'show_count' => 1,
                    'hide_empty' => 1,
                    'echo' => 1,
                    'selected' => absint($instance['cat_id_2']),
                    'hierarchical' => 1,
                    'name' => esc_attr($this->get_field_name('cat_id_2')),
                    'id' => esc_attr($this->get_field_name('cat_id_2')),
                    'class' => 'widefat',
                    'taxonomy' => 'category',
                    'hide_if_empty' => false,
                );
                wp_dropdown_categories($engage_mag_category_col_2_dropown_cat);
                ?>
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('cat_id_3')); ?>">
                    <strong><?php esc_html_e('Select Category for Column Three', 'engage-news'); ?></strong>
                </label><br/>
                <?php
                $engage_mag_category_col_3_dropown_cat = array(
                    'show_option_all' => esc_html__('Show Recent Posts', 'engage-news'),
                    'orderby' => 'name',
                    'order' => 'asc',
                    'show_count' => 1,
                    'hide_empty' => 1,
                    'echo' => 1,
                    'selected' => absint($instance['cat_id_3']),
                    'hierarchical' => 1,
                    'name' => esc_attr($this->get_field_name('cat_id_3')),
                    'id' => esc_attr($this->get_field_name('cat_id_3')),
                    'class' => 'widefat',
                    'taxonomy' => 'category',
                    'hide_if_empty' => false,
                );
                wp_dropdown_categories($engage_mag_category_col_3_dropown_cat);
                ?>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('post_number')); ?>"><strong><?php esc_html_e('Number of Posts:', 'engage-news'); ?></strong></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('post_number')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('post_number')); ?>" type="number"
                       value="<?php echo $post_number; ?>" min="1"/>
            </p>
            <?php
        }
    }
}

if ( ! function_exists( 'engage_news_load_widgets' ) ) :

    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function engage_news_load_widgets() {

        // Thumbnail Widget.
        register_widget( 'Engage_News_Category_Three_Column' );

    }

endif;
add_action( 'widgets_init', 'engage_news_load_widgets' );