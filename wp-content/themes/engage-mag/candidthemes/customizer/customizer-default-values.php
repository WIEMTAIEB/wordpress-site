<?php
/**
 * Engage Mag Theme Customizer default values
 *
 * @package Engage Mag
 */
if ( !function_exists('engage_mag_default_theme_options_values') ) :
    function engage_mag_default_theme_options_values() {
        $default_theme_options = array(

             /*General Colors*/
            'engage-mag-primary-color' => '#ff0000',
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

            /*logo position*/
            'engage-mag-custom-logo-position'=> 'default',

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
            'engage-mag-enable-trending-news-text'=> esc_html__('Trending News','engage-mag'),
            'engage-mag-trending-news-category'=> 0,

            /*Menu Section*/
            'engage-mag-enable-menu-section-search'=> true,
            'engage-mag-enable-sticky-primary-menu'=> true,
            'engage-mag-enable-menu-home-icon' => true,

            /*Header Ads Default Value*/
            'engage-mag-enable-ads-header'=> false,
            'engage-mag-header-ads-image'=> '',
            'engage-mag-header-ads-image-link'=> 'https://www.candidthemes.com/themes/engage-mag/',

            /*Slider Section Default Value*/
            'engage-mag-enable-slider' => true,
            'engage-mag-select-category'=> 0,
            'engage-mag-select-category-featured-right' => 0,            

            /*Sidebars Default Value*/
            'engage-mag-sidebar-blog-page'=>'right-sidebar',
            'engage-mag-sidebar-front-page' => 'right-sidebar',
            'engage-mag-sidebar-archive-page'=> 'right-sidebar',

            /*Blog Page Default Value*/
            'engage-mag-column-blog-page'=> 'three-columns',
            'engage-mag-blog-layout'=> 'normal',
            'engage-mag-content-show-from'=>'excerpt',
            'engage-mag-excerpt-length'=>25,
            'engage-mag-pagination-options'=>'numeric',
            'engage-mag-read-more-text'=> esc_html__('Read More','engage-mag'),

            /*Single Page Default Value*/
            'engage-mag-single-page-featured-image'=> true,
            'engage-mag-single-page-related-posts'=> true,
            'engage-mag-single-page-related-posts-title'=> esc_html__('Related Posts','engage-mag'),
            'engage-mag-enable-underline-link' => true,            

            /*Sticky Sidebar Options*/
            'engage-mag-enable-sticky-sidebar'=> true,

            /*Social Share Options*/
            'engage-mag-enable-blog-sharing'=> false,

            /*Footer Section*/
            'engage-mag-footer-copyright' =>  esc_html__('All Rights Reserved 2021.','engage-mag'),
            'engage-mag-go-to-top'=> true,            
            'engage-mag-footer-you-may-missed' => true,
            'engage-mag-you-missed-select-category'=> 0,
            'engage-mag-footer-you-may-missed-title' =>  esc_html__('You May Have Missed','engage-mag'),

            /*Front Page Options*/
            'engage-mag-enable-post-carousel-below-slider'=> true,
            'engage-mag-post-carousel-below-slider-cat'=> 0,
            'engage-mag-enable-post-carousel-below-slider-title'=> esc_html__('Featured Posts Carousel','engage-mag'),

            /*Breadcrumb Options*/
            'engage-mag-breadcrumb-display-from-option'=> 'theme-default',
            'engage-mag-extra-breadcrumb'=> true,
            'engage-mag-breadcrumb-text'=>  esc_html__('You are Here','engage-mag'),
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
 *  Engage Mag Theme Options and Settings
 *
 * @since Engage Mag 1.0.0
 *
 * @param null
 * @return array engage_mag_get_options_value
 *
 */
if ( !function_exists('engage_mag_get_options_value') ) :
    function engage_mag_get_options_value() {
        $engage_mag_default_theme_options_values = engage_mag_default_theme_options_values();
        $engage_mag_get_options_value = get_theme_mod( 'engage_mag_options');
        if( is_array( $engage_mag_get_options_value )){
            return array_merge( $engage_mag_default_theme_options_values, $engage_mag_get_options_value );
        }
        else{
            return $engage_mag_default_theme_options_values;
        }
    }
endif;