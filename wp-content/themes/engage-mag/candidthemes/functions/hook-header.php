<?php
/**
 * Header Hook Element.
 *
 * @package Engage Mag
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


if (!function_exists('engage_mag_do_skip_to_content_link')) {
    /**
     * Add skip to content link before the header.
     *
     * @since 1.0.0
     */
    function engage_mag_do_skip_to_content_link()
    {
        ?>
        <a class="skip-link screen-reader-text"
           href="#content"><?php esc_html_e('Skip to content', 'engage-mag'); ?></a>
        <?php
    }
}
add_action('engage_mag_before_header', 'engage_mag_do_skip_to_content_link', 10);

if (!function_exists('engage_mag_preloader')) {
    /**
     * Add preloader to website
     *
     * @since 1.0.0
     */
    function engage_mag_preloader()
    {
        global $engage_mag_theme_options;


        //Check if preloader is enabled from customizer
        if ($engage_mag_theme_options['engage-mag-extra-preloader'] == 1) :

            ?>
            <!-- Preloader -->
            <div id="loader-wrapper">
                <div class="loader">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        <?php
        endif;

    }
}
add_action('engage_mag_before_header', 'engage_mag_preloader', 20);

if (!function_exists('engage_mag_header_start_container')) {
    /**
     * Add header html open tag
     *
     * @since 1.0.0
     */
    function engage_mag_header_start_container()
    {
        ?>
        <header id="masthead" class="site-header" <?php engage_mag_do_microdata('header'); ?>>
        <?php

    }
}
add_action('engage_mag_header_start', 'engage_mag_header_start_container', 10);


if (!function_exists('engage_mag_construct_header')) {
    /**
     * Add header block.
     *
     * @since 1.0.0
     */
    function engage_mag_construct_header()
    {
        /**
         * engage_mag_after_header_open hook.
         *
         * @since 1.0.0
         *
         */
        do_action('engage_mag_after_header_open');
        ?>
        <div class="overlay"></div>
        <?php
        global $engage_mag_theme_options;

        //Check if top header is enabled from customizer
        if ($engage_mag_theme_options['engage-mag-enable-top-header'] == 1):

            /**
             * engage_mag_top_bar hook.
             *
             * @since 1.0.0
             *
             * @hooked engage_mag_before_top_bar - 5
             * @hooked engage_mag_trending_news - 10
             * @hooked engage_mag_top_header_right_start - 15
             * @hooked engage_mag_top_social_menu - 20
             * @hooked engage_mag_top_menu - 25
             * @hooked engage_mag_top_search - 30
             * @hooked engage_mag_top_header_right_end - 35
             * @hooked engage_mag_after_top_bar - 40
             */
            do_action('engage_mag_top_bar');
        endif; // $engage_mag_theme_options['engage-mag-enable-top-header']

            /**
             * engage_mag_main_header_one hook.
             *
             * @since 1.0.0
             *
             * @hooked engage_mag_construct_main_navigation - 10
             * @hooked engage_mag_construct_main_header - 20
             *
             */
            do_action('engage_mag_main_header');

            /**
             * engage_mag_main_navigation hook.
             *
             * @since 1.0.0
             *
             * @hooked engage_mag_construct_main_navigation - 10
             *
             */
            do_action('engage_mag_main_navigation');


        /**
         * engage_mag_before_header_close hook.
         *
         * @since 1.0.0
         *
         */
        do_action('engage_mag_before_header_close');

    }
}
add_action('engage_mag_header', 'engage_mag_construct_header', 10);


if (!function_exists('engage_mag_header_end_container')) {
    /**
     * Add header html close tag
     *
     * @since 1.0.0
     */
    function engage_mag_header_end_container()
    {
        ?>
        </header><!-- #masthead -->
        <?php

    }
}
add_action('engage_mag_header_end', 'engage_mag_header_end_container', 10);

if (!function_exists('engage_mag_header_ads')) {
    /**
     * Add header ads
     *
     * @since 1.0.0
     */
    function engage_mag_header_ads()
    {
        global $engage_mag_theme_options;
        $logo_position = $engage_mag_theme_options['engage-mag-custom-logo-position'];
        if ($logo_position == 'center') {
            $logo_class = 'full-wrapper text-center';
            $logo_right_class = 'full-wrapper';
        } else {
            $logo_class = 'float-left';
            $logo_right_class = 'float-right';
        }

            $engage_mag_header_ad_image = esc_url($engage_mag_theme_options['engage-mag-header-ads-image']);
            $engage_mag_header_ad_url = esc_url($engage_mag_theme_options['engage-mag-header-ads-image-link']);
            if (!empty($engage_mag_header_ad_image)):
                ?>
                <div class="logo-right-wrapper clearfix  <?php echo $logo_class ?>">
                    <?php
                    if (!empty($engage_mag_header_ad_image) && (!empty($engage_mag_header_ad_url))) {
                        ?>
                        <a href="<?php echo $engage_mag_header_ad_url ?>" target="_blank">
                            <img src="<?php echo $engage_mag_header_ad_image; ?>"
                                 class="<?php echo logo_right_class; ?>">
                        </a>
                        <?php
                    } else if (!empty($engage_mag_header_ad_image)) {
                        ?>
                        <img src="<?php echo $engage_mag_header_ad_image; ?>"
                             class="<?php echo logo_right_class; ?>">
                        <?php
                    }
                    ?>
                </div> <!-- .logo-right-wrapper -->
            <?php
            endif; // !empty $engage_mag_header_ad_image
    }
}
add_action('engage_mag_header_ads', 'engage_mag_header_ads', 10);


if (!function_exists('engage_mag_trending_news_item')) {
    /**
     * Add trending news section
     *
     * @since 1.0.0
     */
    function engage_mag_trending_news_item()
    {
        global $engage_mag_theme_options;
        $trending_cat = absint($engage_mag_theme_options['engage-mag-trending-news-category']);
        $trending_title = esc_html($engage_mag_theme_options['engage-mag-enable-trending-news-text']);
        if (is_rtl()) {
            $marquee_class = 'trending-right';
        } else {
            $marquee_class = 'trending-left';
        }
        ?>
        <?php
            $query_args = array(
                'post_type' => 'post',
                'ignore_sticky_posts' => true,
                'posts_per_page' => 10,
                'cat' => $trending_cat
            );
        $query = new WP_Query($query_args);
        if ($query->have_posts()) :
            ?>

            <div class="trending-wrapper">
                <?php
                if ($trending_title):
                    ?>
                    <strong class="trending-title">
                        <?php echo $trending_title; ?>
                    </strong>
                <?php
                endif;
                ?>
                <div class="trending-content <?php echo $marquee_class; ?>">
                    <?php
                    while ($query->have_posts()) :
                        $query->the_post();
                        ?>
                        <a href="<?php the_permalink(); ?>"
                           title="<?php the_title(); ?>">
                                <span class="img-marq">
                                     <?php the_post_thumbnail('thumbnail'); ?>
                                </span>
                            <?php the_title(); ?>
                        </a>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>

                </div>
            </div> <!-- .top-right-col -->
        <?php
        endif;
        ?>
        <?php


    }
}
add_action('engage_mag_trending_news', 'engage_mag_trending_news_item', 10);

// Post Carousel from Customizer
if (!function_exists('engage_mag_post_carousel_customizer')) {
    /**
     * Post Carousel from Customizer
     *
     * @since 1.0.0
     */
    function engage_mag_post_carousel_customizer()
    {
        global $engage_mag_theme_options;
        $cat_id = absint($engage_mag_theme_options['engage-mag-post-carousel-below-slider-cat']);
        $section_title = esc_html($engage_mag_theme_options['engage-mag-enable-post-carousel-below-slider-title']);
        $engage_mag_slider_args = array();
        if (is_rtl()) {
            $engage_mag_slider_args['rtl'] = true;
        }
        $engage_mag_slider_args_encoded = wp_json_encode($engage_mag_slider_args);

        $query_args = array(
            'post_type' => 'post',
            'cat' => $cat_id,
            'posts_per_page' => 5,
            'ignore_sticky_posts' => true
        );

        $query = new WP_Query($query_args);

        if ($query->have_posts()) :

            ?>
            <div class="ct-header-carousel-section">
                <div class="container-inner">
                <?php
                if ($section_title) {
                    ?>
                    <h2 class="widget-title"> <?php echo $section_title; ?> </h2>
                    <?php
                }
                ?>
                <div class="ct-header-carousel ct-post-overlay clearfix"
                     data-slick='<?php echo $engage_mag_slider_args_encoded; ?>'>
                    <?php
                    while ($query->have_posts()) :
                        $query->the_post();
                        if (has_post_thumbnail()) {
                            $featured_image = get_the_post_thumbnail_url('', 'engage-mag-carousel-img');
                        } else {
                            $featured_image = esc_url(get_template_directory_uri()) . '/candidthemes/assets/images/refined-mag-carousel.jpg';
                        }
                        ?>
                        <div class="ct-carousel-single" style="background-image: url(<?php echo esc_url($featured_image); ?>)">
                            <?php
                            engage_mag_post_formats(get_the_ID());
                            ?>
                            <div class="featured-section-details post-content">
                                    <div class="post-meta">
                                        <?php
                                        engage_mag_featured_list_category(get_the_ID());
                                        ?>
                                    </div>
                                    
                                <h3 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="post-meta">
                                    <?php
                                        engage_mag_widget_posted_on();
                                        engage_mag_read_time_slider(get_the_ID());
                                        engage_mag_widget_posted_by();
                                    ?>
                                </div>
                            </div>

                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div> <!-- .container-inner -->
            </div> <!-- .ct-header-carousel-section -->
        <?php
        endif;
    }
}
add_action('engage_mag_post_carousel_customizer_hook', 'engage_mag_post_carousel_customizer', 10);