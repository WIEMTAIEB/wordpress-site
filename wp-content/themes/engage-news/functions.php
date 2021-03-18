<?php
/**
 *Recommended way to include parent theme styles.
 *(Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
 */
//after theme setup hook for background color
if (!function_exists('engage_news_setup')) :
    function engage_news_setup()
    {

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('refined_magazine_custom_background_args', array(
            'default-color' => '#ffffff ',
            'default-image' => '',
        )));

    }
endif;
add_action('after_setup_theme', 'engage_news_setup');
/**
 * Loads the child theme textdomain.
 */
function engage_news_load_language()
{
    load_child_theme_textdomain('engage-news');
}

add_action('after_setup_theme', 'engage_news_load_language');

/**
 * Enqueue Style
 */
add_action('wp_enqueue_scripts', 'engage_news_style', 20);
function engage_news_style()
{
    wp_dequeue_style('google-fonts');
    wp_enqueue_style('engage-news-heading', '//fonts.googleapis.com/css?family=Saira+Condensed|Muli&display=swap');
    wp_enqueue_style('engage-news-parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('engage-news-style', get_stylesheet_directory_uri() . '/style.css', array('engage-news-parent-style'));
}

/**
 * Engage Mag Theme Customizer default values
 *
 * @package Engage Mag
 */
if ( !function_exists('engage_mag_default_theme_options_values') ) :
    function engage_mag_default_theme_options_values() {
        $default_theme_options = array(

             /*General Colors*/
            'engage-mag-primary-color' => '#1e73be',
            'engage-mag-site-title-hover'=> '',
            'engage-mag-site-tagline'=> '',
            
            /*Top Header Colors*/
            'engage-mag-top-header-background-color'=> '',
            'engage-mag-top-header-trending-background-color'=> '',
            'engage-mag-top-header-trending-text-color'=> '',
            'engage-mag-top-header-text-color'=>'',
            'engage-mag-top-header-text-hover'=>'',

            /*Logo Section Colors*/
            'engage-mag-logo-section-background' => '',

            /*Footer Color*/
            'engage-mag-top-footer-background'=>'#073761',
            'engage-mag-bottom-footer-background'=>'#022544',

            /*logo position*/
            'engage-mag-custom-logo-position'=> 'center',

            /*Site Layout Options*/
            'engage-mag-site-layout-options'=>'boxed',
            'engage-mag-boxed-width-options'=> 1500,


            /*Top Header Section Default Value*/
            'engage-mag-enable-top-header'=> true,
            'engage-mag-enable-top-header-social'=> true,
            'engage-mag-enable-top-header-menu'=> true,
            'engage-mag-enable-top-header-date' => true,
            'engage-mag-top-header-date-format'=>'default-date',
            
            /*Treding News*/
            'engage-mag-enable-trending-news' => true,
            'engage-mag-enable-trending-news-text'=> esc_html__('Hot News','engage-news'),
            'engage-mag-trending-news-category'=> 0,

            /*Menu Section*/
            'engage-mag-enable-menu-section-search'=> true,
            'engage-mag-enable-sticky-primary-menu'=> true,
            'engage-mag-enable-menu-home-icon' => true,

            /*Header Ads Default Value*/
            'engage-mag-enable-ads-header'=> false,
            'engage-mag-header-ads-image'=> '',
            'engage-mag-header-ads-image-link'=> '',

            /*Slider Section Default Value*/
            'engage-mag-enable-slider' => true,
            'engage-mag-select-category'=> 0,
            'engage-mag-select-category-featured-right' => 0,            

            /*Sidebars Default Value*/
            'engage-mag-sidebar-blog-page'=>'right-sidebar',
            'engage-mag-sidebar-front-page' => 'right-sidebar',
            'engage-mag-sidebar-archive-page'=> 'right-sidebar',

            /*Blog Page Default Value*/
            'engage-mag-column-blog-page'=> 'one-column',
            'engage-mag-blog-layout'=> 'normal',
            'engage-mag-content-show-from'=>'excerpt',
            'engage-mag-excerpt-length'=>25,
            'engage-mag-pagination-options'=>'numeric',
            'engage-mag-read-more-text'=> esc_html__('Read More','engage-news'),

            /*Single Page Default Value*/
            'engage-mag-single-page-featured-image'=> true,
            'engage-mag-single-page-related-posts'=> true,
            'engage-mag-single-page-related-posts-title'=> esc_html__('Related Posts','engage-news'),
            'engage-mag-enable-underline-link' => true,            

            /*Sticky Sidebar Options*/
            'engage-mag-enable-sticky-sidebar'=> true,

            /*Social Share Options*/
            'engage-mag-enable-blog-sharing'=> false,

            /*Footer Section*/
            'engage-mag-footer-copyright' =>  esc_html__('All Rights Reserved 2021.','engage-news'),
            'engage-mag-go-to-top'=> true,            
            'engage-mag-footer-you-may-missed' => true,
            'engage-mag-you-missed-select-category'=> 0,
            'engage-mag-footer-you-may-missed-title' =>  esc_html__('You May Also Like','engage-news'),

            /*Front Page Options*/
            'engage-mag-enable-post-carousel-below-slider'=> true,
            'engage-mag-post-carousel-below-slider-cat'=> 0,
            'engage-mag-enable-post-carousel-below-slider-title'=> esc_html__('Featured Posts Carousel','engage-news'),

            /*Breadcrumb Options*/
            'engage-mag-breadcrumb-display-from-option'=> 'theme-default',
            'engage-mag-extra-breadcrumb'=> true,
            'engage-mag-breadcrumb-text'=>  esc_html__('You are Here','engage-news'),
            'engage-mag-breadcrumb-display-from-plugins'=>'yoast',
            
            /*Extra Options*/
            'engage-mag-extra-preloader'=> true,
            'engage-mag-extra-hide-default-thumbnails' => false,
            'engage-mag-extra-hide-read-time' => false,
            'engage-mag-extra-hide-read-time-words'=> 200,
            
            /*Home Page Content Hide*/
            'engage-mag-front-page-content' => false,

            /*Category Color*/
            'engage-mag-enable-category-color' => false,

        );
        return apply_filters( 'engage_mag_default_theme_options_values', $default_theme_options );
    }
endif;


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function engage_news_customize_register( $wp_customize ) {

    $default = engage_mag_default_theme_options_values();

    /* Logo Section Colors */

    $wp_customize->add_section(
        'footer_colors',
        array(
            'title' => __( 'Footer Section Colors', 'engage-news' ),
            'panel' => 'colors',
        )
    );

    /* Colors background top footer */
    $wp_customize->add_setting( 'engage_mag_options[engage-mag-top-footer-background]',
        array(
            'default'           => $default['engage-mag-top-footer-background'],
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'engage_mag_options[engage-mag-top-footer-background]',
            array(
                'label'       => esc_html__( 'Top Footer Background Color', 'engage-news' ),
                'description' => esc_html__( 'Will change the color of background footer.', 'engage-news' ),
                'section'     => 'footer_colors',
            )
        )
    );
    /* Colors background bottom footer */
    $wp_customize->add_setting( 'engage_mag_options[engage-mag-bottom-footer-background]',
        array(
            'default'           => $default['engage-mag-bottom-footer-background'],
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'engage_mag_options[engage-mag-bottom-footer-background]',
            array(
                'label'       => esc_html__( 'Bottom Footer Background Color', 'engage-news' ),
                'description' => esc_html__( 'Will change the color of background footer.', 'engage-news' ),
                'section'     => 'footer_colors',
            )
        )
    );

    //remove upgarde to pro from parent theme 
    $wp_customize->remove_section( 'engage-mag');

    //remove about theme from customizer
    $wp_customize->remove_section( 'engage_mag_about_theme_section');

}
add_action( 'customize_register', 'engage_news_customize_register', 999 );

/**
 * Load new thumbnail widget
 */
require get_stylesheet_directory() . '/candid-three-column-widget.php';

/**
 * Implement the Custom Header feature.
 */
require get_stylesheet_directory() . '/inc/custom-header.php';
/**
 * Implement the Dynamic CSS on child theme
 */
require get_stylesheet_directory() . '/inc/dynamic-css.php';

if (!function_exists('engage_mag_constuct_carousel')) {
    /**
     * Add carousel on header
     *
     * @since 1.0.0
     */
    function engage_mag_constuct_carousel()
    {

        if (is_front_page()) {
            global $engage_mag_theme_options;
            $engage_mag_site_layout = $engage_mag_theme_options['engage-mag-site-layout-options'];
            $slider_cat = $engage_mag_theme_options['engage-mag-select-category'];
            $featured_cat = $engage_mag_theme_options['engage-mag-select-category-featured-right'];


            ?>
            <div class="engage-mag-featured-block engage-mag-ct-row refined-awesome-carousel clearfix">
                <?php

                engage_mag_main_carousel($slider_cat);


                $query_args = array(
                    'post_type' => 'post',
                    'ignore_sticky_posts' => true,
                    'posts_per_page' => 3,
                    'cat' => $featured_cat
                );

                $query = new WP_Query($query_args);
                if ($query->have_posts()) :
                    ?>
                    <div class="engage-mag-col engage-mag-col-2">
                        <div class="engage-mag-inner-row clearfix">
                            <?php
                            $i=1;
                            while ($query->have_posts()) :
                                $query->the_post();



                                $col_class = '';
                                if ($i == 3) {
                                    $col_class = 'engage-mag-col-full';

                                }
                                if (has_post_thumbnail()) {
                                    if($i == 3) {
                                        if ($engage_mag_site_layout == 'boxed') {
                                            $featured_image = get_the_post_thumbnail_url('', 'engage-mag-carousel-img-landscape');
                                        } else {
                                            $featured_image = get_the_post_thumbnail_url('', 'engage-mag-carousel-large-img-landscape');
                                        }
                                    }else{
                                        if ($engage_mag_site_layout == 'boxed') {
                                            $featured_image = get_the_post_thumbnail_url('', 'engage-mag-carousel-img');
                                        } else {
                                            $featured_image = get_the_post_thumbnail_url('', 'engage-mag-carousel-large-img');
                                        }
                                    }
                                }else{
                                    if($i == 3) {
                                        if ($engage_mag_site_layout == 'boxed') {
                                            $featured_image = get_template_directory_uri().'/candidthemes/assets/images/refined-mag-carousel-landscape.jpg';
                                        } else {
                                            $featured_image = get_template_directory_uri().'/candidthemes/assets/images/refined-mag-carousel-large-landscape.jpg';
                                        }
                                    }else{
                                        if ($engage_mag_site_layout == 'boxed') {
                                            $featured_image = get_template_directory_uri().'/candidthemes/assets/images/refined-mag-carousel.jpg';
                                        } else {
                                            $featured_image = get_template_directory_uri().'/candidthemes/assets/images/refined-mag-carousel-large.jpg';
                                        }
                                    }
                                }
                                ?>
                                <div class="engage-mag-col <?php echo $col_class; ?>">
                                    <div class="featured-section-inner ct-post-overlay" style="background-image: url(<?php echo esc_url($featured_image); ?>)">
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
                                </div><!--.engage-mag-col-->
                                <?php
                                $i++;

                            endwhile;
                            wp_reset_postdata()
                            ?>

                        </div>
                    </div><!--.engage-mag-col-->
                <?php
                endif;
                ?>

            </div><!-- .engage-mag-ct-row-->
            <?php


        }//is_front_page
    }
}


if (!function_exists('engage_mag_footer_siteinfo')) {
    /**
     * Add footer site info block
     *
     * @param none
     * @return void
     * @since 1.0.0
     *
     */
    function engage_mag_footer_siteinfo()
    {
        ?>

        <div class="site-info" <?php engage_mag_do_microdata('footer'); ?>>
            <div class="container-inner">
                <?php
                global $engage_mag_theme_options;
                $engage_mag_copyright = wp_kses_post($engage_mag_theme_options['engage-mag-footer-copyright']);
                if (!empty($engage_mag_copyright)):
                    ?>
                    <span class="copy-right-text"><?php echo $engage_mag_copyright; ?></span><br>
                <?php
                endif; //$engage_mag_copyright
                ?>
                <a href="<?php echo esc_url(__('https://wordpress.org/', 'engage-news')); ?>" target="_blank">
                    <?php
                    /* translators: %s: CMS name, i.e. WordPress. */
                    printf(esc_html__('Proudly powered by %s', 'engage-news'), 'WordPress');
                    ?>
                </a>
                <span class="sep"> | </span>
                <?php
                /* translators: 1: Theme name, 2: Theme author. */
                printf(esc_html__('Theme: %1$s by %2$s.', 'engage-news'), 'Engage News', '<a href="https://www.candidthemes.com/" target="_blank">Candid Themes</a>');
                ?>
            </div> <!-- .container-inner -->
        </div><!-- .site-info -->
        <?php
    }
}



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
            <div class="text_share header-text"><?php _e('Share', 'engage-news'); ?></div>
            <div class="post-share">
                <a target="_blank" href="<?php echo $engage_mag_facebook_sharing_url; ?>">
                    <i class="fa fa-facebook"></i>
                    <?php _e('Facebook', 'engage-news'); ?>
                </a>
                <a target="_blank" href="<?php echo $engage_mag_twitter_sharing_url; ?>">
                    <i class="fa fa-twitter"></i>
                    <?php _e('Twitter', 'engage-news'); ?>
                </a>
                <a target="_blank" href="<?php echo $engage_mag_pinterest_sharing_url; ?>">
                    <i class="fa fa-pinterest"></i>
                    <?php _e('Pinterest', 'engage-news'); ?>
                </a>
                <a target="_blank" href="<?php echo $engage_mag_linkedin_sharing_url; ?>">
                    <i class="fa fa-linkedin"></i>
                    <?php _e('Linkedin', 'engage-news'); ?>
                </a>
            </div>
        </div>
        <?php
    }
endif;

/**
 * upgrade to pro
 */
require get_stylesheet_directory() . '/inc/customizer-pro/class-customize.php';