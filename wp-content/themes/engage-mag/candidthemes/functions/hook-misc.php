<?php
/**
 * Single Post Hook Element.
 *
 * @package Engage Mag
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
/**
 * Display sidebar
 *
 * @param none
 * @return void
 *
 * @since Engage Mag 1.0.0
 *
 */
if (!function_exists('engage_mag_construct_sidebar')) :

    function engage_mag_construct_sidebar()
    {
        /*  * Adds sidebar based on customizer option
      *
           * @since Engage Mag 1.0.0
      */
        global $engage_mag_theme_options;
        $sidebar = $engage_mag_theme_options['engage-mag-sidebar-archive-page'] ? $engage_mag_theme_options['engage-mag-sidebar-archive-page'] : 'right-sidebar';
        if (is_singular()) {
            $sidebar = $engage_mag_theme_options['engage-mag-sidebar-blog-page'] ? $engage_mag_theme_options['engage-mag-sidebar-blog-page'] : 'right-sidebar';
            global $post;
            $single_sidebar = get_post_meta($post->ID, 'engage_mag_sidebar_layout', true);
            if (('default-sidebar' != $single_sidebar) && (!empty($single_sidebar))) {
                $sidebar = $single_sidebar;
            }
        }
        if (is_front_page()) {
            $sidebar = $engage_mag_theme_options['engage-mag-sidebar-front-page'] ? $engage_mag_theme_options['engage-mag-sidebar-front-page'] : 'right-sidebar';
        }
        if (($sidebar == 'right-sidebar') || ($sidebar == 'left-sidebar')) {
            get_sidebar();
        }
    }
endif;
add_action('engage_mag_sidebar', 'engage_mag_construct_sidebar', 10);

/**
 * Display Breadcrumb
 *
 * @param none
 * @return void
 *
 * @since Engage Mag 1.0.0
 *
 */
if (!function_exists('engage_mag_construct_breadcrumb')) :

    function engage_mag_construct_breadcrumb()
    {
        global $engage_mag_theme_options;
        //Check if breadcrumb is enabled from customizer
        if ($engage_mag_theme_options['engage-mag-extra-breadcrumb'] == 1):
            /**
             * Adds Breadcrumb based on customizer option
             *
             * @since Engage Mag 1.0.0
             */
            $breadcrumb_type = $engage_mag_theme_options['engage-mag-breadcrumb-display-from-option'];
            if ($breadcrumb_type == 'plugin-breadcrumb') {
                $breadcrumb_plugin = $engage_mag_theme_options['engage-mag-breadcrumb-display-from-plugins'];
                ?>
                <div class="breadcrumbs">
                    <?php
                    if ((function_exists('yoast_breadcrumb')) && ($breadcrumb_plugin == 'yoast')) {
                        yoast_breadcrumb();
                    } elseif ((function_exists('rank_math_the_breadcrumbs')) && ($breadcrumb_plugin == 'rank-math')) {
                        rank_math_the_breadcrumbs();
                    } elseif ((function_exists('bcn_display')) && ($breadcrumb_plugin == 'navxt')) {
                        bcn_display();
                    }
                    ?>
                </div>
                <?php
            } else {
                ?>
                <div class="breadcrumbs">
                    <?php
                    $breadcrumb_args = array(
                        'container' => 'div',
                        'show_browse' => false
                    );

                    $engage_mag_you_are_here_text = esc_html($engage_mag_theme_options['engage-mag-breadcrumb-text']);
                    if (!empty($engage_mag_you_are_here_text)) {
                        $engage_mag_you_are_here_text = "<span class='breadcrumb'>" . $engage_mag_you_are_here_text . "</span>";
                    }
                    echo "<div class='breadcrumbs init-animate clearfix'>" . $engage_mag_you_are_here_text . "<div id='engage-mag-breadcrumbs' class='clearfix'>";
                    breadcrumb_trail($breadcrumb_args);
                    echo "</div></div>";
                    ?>
                </div>
                <?php
            }
        endif;
    }
endif;
add_action('engage_mag_breadcrumb', 'engage_mag_construct_breadcrumb', 10);


/**
 * Filter to change excerpt lenght size
 *
 * @since 1.0.0
 */
if (!function_exists('engage_mag_alter_excerpt')) :
    function engage_mag_alter_excerpt($length)
    {
        if (is_admin()) {
            return $length;
        }
        global $engage_mag_theme_options;
        $engage_mag_excerpt_length = $engage_mag_theme_options['engage-mag-excerpt-length'];
        if (!empty($engage_mag_excerpt_length)) {
            return $engage_mag_excerpt_length;
        }
        return 50;
    }
endif;
add_filter('excerpt_length', 'engage_mag_alter_excerpt');


/**
 * Post Navigation Function
 *
 * @param null
 * @return void
 *
 * @since 1.0.0
 *
 */
if (!function_exists('engage_mag_posts_navigation')) :
    function engage_mag_posts_navigation()
    {
        global $engage_mag_theme_options;
        $engage_mag_pagination_option = $engage_mag_theme_options['engage-mag-pagination-options'];
        if ($engage_mag_pagination_option == 'default') {
            the_posts_navigation();
        } else {
            echo "<div class='candid-pagination'>";
            the_posts_pagination();
            echo "</div>";
        }
    }
endif;
add_action('engage_mag_action_navigation', 'engage_mag_posts_navigation', 10);


/**
 * Social Sharing Hook *
 * @param int $post_id
 * @return void
 *
 * @since 1.0.0
 *
 */
if (!function_exists('engage_mag_constuct_social_sharing')) :
    function engage_mag_constuct_social_sharing($post_id)
    {
        global $engage_mag_theme_options;
        $engage_mag_enable_blog_sharing = $engage_mag_theme_options['engage-mag-enable-blog-sharing'];
        if (($engage_mag_enable_blog_sharing != 1) && (!is_singular())) {
            return;
        }
        $engage_mag_url = get_the_permalink($post_id);
        $engage_mag_title = get_the_title($post_id);
        $engage_mag_image = get_the_post_thumbnail_url($post_id);

        //sharing url
        $engage_mag_twitter_sharing_url = esc_url('http://twitter.com/share?text=' . $engage_mag_title . '&url=' . $engage_mag_url);
        $engage_mag_facebook_sharing_url = esc_url('https://www.facebook.com/sharer/sharer.php?u=' . $engage_mag_url);
        $engage_mag_pinterest_sharing_url = esc_url('http://pinterest.com/pin/create/button/?url=' . $engage_mag_url . '&media=' . $engage_mag_image . '&description=' . $engage_mag_title);
        $engage_mag_linkedin_sharing_url = esc_url('http://www.linkedin.com/shareArticle?mini=true&title=' . $engage_mag_title . '&url=' . $engage_mag_url);

        ?>
        <div class="meta_bottom">
            <div class="text_share header-text"><?php _e('Share', 'engage-mag'); ?></div>
            <div class="post-share">
                <a target="_blank" href="<?php echo $engage_mag_facebook_sharing_url; ?>">
                    <i class="fa fa-facebook"></i>
                </a>
                <a target="_blank" href="<?php echo $engage_mag_twitter_sharing_url; ?>">
                    <i class="fa fa-twitter"></i>
                </a>
                <a target="_blank" href="<?php echo $engage_mag_pinterest_sharing_url; ?>">
                    <i class="fa fa-pinterest"></i>
                </a>
                <a target="_blank" href="<?php echo $engage_mag_linkedin_sharing_url; ?>">
                    <i class="fa fa-linkedin"></i>
                </a>
            </div>
        </div>
        <?php
    }
endif;
add_action('engage_mag_social_sharing', 'engage_mag_constuct_social_sharing', 10);

if (!function_exists('engage_mag_excerpt_words')) :
    function engage_mag_excerpt_words($post_id, $word_count = 25, $read_more = '')
    {
        $content = get_the_content($post_id);
        $trimmed_content = wp_trim_words($content, $word_count, $read_more);
        return $trimmed_content;

    }
endif;


if (!function_exists('engage_mag_main_carousel')) :
    function engage_mag_main_carousel($cat_id = '')
    {
        global $engage_mag_theme_options;
        $engage_mag_site_layout = $engage_mag_theme_options['engage-mag-site-layout-options'];

        $engage_mag_slider_args = array();
        if (is_rtl()) {
            $engage_mag_slider_args['rtl'] = true;
        }
        $engage_mag_slider_args_encoded = wp_json_encode($engage_mag_slider_args);

        $query_args = array(
            'post_type' => 'post',
            'ignore_sticky_posts' => true,
            'posts_per_page' => 4,
            'cat' => $cat_id
        );

        $query = new WP_Query($query_args);
        if ($query->have_posts()) :
            ?>

            <div class="engage-mag-col">
                <ul class="ct-post-carousel slider hover-prev-next"
                    data-slick='<?php echo $engage_mag_slider_args_encoded; ?>'>
                    <?php
                    while ($query->have_posts()) :
                        $query->the_post();
                        ?>
                        <li>
                            <?php
                            if (has_post_thumbnail()) {
                                if ($engage_mag_site_layout == 'boxed') {
                                    $featured_image = get_the_post_thumbnail_url('', 'engage-mag-carousel-img');
                                } else {
                                    $featured_image = get_the_post_thumbnail_url('', 'engage-mag-carousel-large-img');
                                }

                            } else {
                                if ($engage_mag_site_layout == 'boxed') {
                                    $featured_image = get_template_directory_uri() . '/candidthemes/assets/images/refined-mag-carousel.jpg';
                                } else {
                                    $featured_image = get_template_directory_uri() . '/candidthemes/assets/images/refined-mag-carousel-large.jpg';
                                }
                            }
                            ?>
                            <div class="featured-section-inner ct-post-overlay"
                                 style="background-image: url(<?php echo esc_url($featured_image); ?>)">
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
                            </div> <!-- .featured-section-inner -->
                        </li>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </ul>
            </div><!--.engage-mag-col-->
        <?php
        endif;

    }
endif;

if (!function_exists('engage_mag_is_blog')) :
    function engage_mag_is_blog()
    {
        global $post;
        $posttype = get_post_type($post);
        return (((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ($posttype == 'post')) ? true : false;
    }

endif;