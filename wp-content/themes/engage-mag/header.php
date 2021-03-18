<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Engage Mag
 */
global $engage_mag_theme_options;
$engage_mag_theme_options = engage_mag_get_options_value();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> <?php engage_mag_do_microdata('body'); ?>>
<?php
//wp_body_open hook from WordPress 5.2
if (function_exists('wp_body_open')) {
    wp_body_open();
}
?>
<div id="page" class="site">
    <?php
    /**
     * engage_mag_before_header hook.
     *
     * @since 1.0.0
     *
     * @hooked engage_mag_do_skip_to_content_link - 10
     *
     */
    do_action('engage_mag_before_header');


    /**
     * engage_mag_header_start_container hook.
     *
     * @since 1.0.0
     *
     */
    do_action('engage_mag_header_start');

    /**
     * engage_mag_header hook.
     *
     * @since 1.0.0
     *
     * @hooked engage_mag_construct_header - 10
     */
    do_action('engage_mag_header');

    /**
     * engage_mag_header_end_container hook.
     *
     * @since 1.0.0
     *
     */
    do_action('engage_mag_header_end');

    /**
     * engage_mag_after_header hook.
     *
     * @since 1.0.0
     *
     */
    do_action('engage_mag_after_header');


    if (($engage_mag_theme_options['engage-mag-enable-trending-news'] == 1) && (is_front_page()) ):
        do_action('engage_mag_trending_news');
    endif;

    //Check if slider is enabled from customizer
    if ($engage_mag_theme_options['engage-mag-enable-slider'] == 1):
            /**
             * engage_mag_carousel hook.
             *
             * @since 1.0.0
             *
             * @hooked engage_mag_constuct_carousel - 10
             */
            do_action('engage_mag_carousel');
    endif;
    
    if (($engage_mag_theme_options['engage-mag-enable-post-carousel-below-slider'] == 1) && (is_front_page())):
        /**
         * engage_mag_post_carousel_customizer hook.
         *
         * @since 1.0.0
         *
         */
        do_action('engage_mag_post_carousel_customizer_hook');
    endif;
    ?>


    <div id="content" class="site-content">
        <?php
        $container_class = !is_page_template('elementor_header_footer') ? 'container-inner ct-container-main' : 'container-outer ct-container-main';
        ?>
        <div class="<?php echo $container_class; ?> clearfix">