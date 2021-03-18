<?php
/**
 * Dynamic CSS elements.
 *
 * @package Engage News
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


if (!function_exists('engage_news_dynamic_css')) :
    /**
     * Dynamic CSS
     *
     * @param null
     * @return null
     *
     * @since 1.0.0
     *
     */
    function engage_news_dynamic_css()
    {

        global $engage_mag_theme_options;

        /* Paragraph Font Options */

        $engage_mag_primary_color = $engage_mag_theme_options['engage-mag-primary-color'] ? esc_attr($engage_mag_theme_options['engage-mag-primary-color']) : '#1e73be';


        $engage_mag_header_color = get_header_textcolor();
        $engage_mag_custom_css = '';

        /* Primary Color Section */
        if (!empty($engage_mag_primary_color)) {
            //font-color
            $engage_mag_custom_css .= ".entry-content a, .entry-title a:hover, .related-title a:hover, .posts-navigation .nav-previous a:hover, .post-navigation .nav-previous a:hover, .posts-navigation .nav-next a:hover, .post-navigation .nav-next a:hover, #comments .comment-content a:hover, #comments .comment-author a:hover, .offcanvas-menu nav ul.top-menu li a:hover, .offcanvas-menu nav ul.top-menu li.current-menu-item > a, .error-404-title, #engage-mag-breadcrumbs a:hover, .entry-content a.read-more-text:hover, a:hover, a:visited:hover, .widget_engage_mag_category_tabbed_widget.widget ul.ct-nav-tabs li a  { color : {$engage_mag_primary_color}; }";

            //background-color
            $engage_mag_custom_css .= ".candid-refined-post-format, .refined-magazine-featured-block .refined-magazine-col-2 .candid-refined-post-format, .top-bar,.main-navigation #primary-menu li a:hover, .main-navigation #primary-menu li.current-menu-item > a, .candid-refined-post-format, .engage-mag-featured-block .engage-mag-col-2 .candid-refined-post-format, .trending-title, .search-form input[type=submit], input[type=\"submit\"], ::selection, #toTop, .breadcrumbs span.breadcrumb, article.sticky .engage-mag-content-container, .candid-pagination .page-numbers.current, .candid-pagination .page-numbers:hover, .ct-title-head, .widget-title:before,
.about-author-box .container-title:before, .widget ul.ct-nav-tabs:after, .widget ul.ct-nav-tabs li.ct-title-head:hover, .widget ul.ct-nav-tabs li.ct-title-head.ui-tabs-active { background-color : {$engage_mag_primary_color}; }";

            //border-color
            $engage_mag_custom_css .= ".candid-refined-post-format, .engage-mag-featured-block .engage-mag-col-2 .candid-refined-post-format, blockquote, .search-form input[type=\"submit\"], input[type=\"submit\"], .candid-pagination .page-numbers { border-color : {$engage_mag_primary_color}; }";

            //border-color
            $engage_mag_custom_css .= ".cat-links a { border-color : {$engage_mag_primary_color}; }";
        }

        $enable_category_color = $engage_mag_theme_options['engage-mag-enable-category-color'];
        if ($enable_category_color == 1) {
            $args = array(
                'orderby' => 'id',
                'hide_empty' => 0
            );
            $categories = get_categories($args);
            $wp_category_list = array();
            $i = 1;
            foreach ($categories as $category_list) {
                $wp_category_list[$category_list->cat_ID] = $category_list->cat_name;

                $cat_color = 'cat-' . esc_attr(get_cat_id($wp_category_list[$category_list->cat_ID]));


                if (array_key_exists($cat_color, $engage_mag_theme_options)) {
                    $cat_color_code = $engage_mag_theme_options[$cat_color];
                    $engage_mag_custom_css .= "
                    .cat-{$category_list->cat_ID} .ct-title-head,
                    .cat-{$category_list->cat_ID}.widget-title:before,
                     .cat-{$category_list->cat_ID} .widget-title:before,
                      .ct-cat-item-{$category_list->cat_ID}{
                    border-color: {$cat_color_code}!important;
                    background-color: transparent !important;
                    }
                    ";
                    $engage_mag_custom_css .= "
                    .widget_engage_mag_category_tabbed_widget.widget ul.ct-nav-tabs li a.ct-tab-{$category_list->cat_ID} {
                    color: {$cat_color_code}!important;
                    }
                    ";
                }


                $i++;
            }
        }

        $footer_top_color = esc_attr($engage_mag_theme_options['engage-mag-top-footer-background']);
        if (!empty($footer_top_color)) {
            $engage_mag_custom_css .= "
                    .top-footer {
                    background-color: {$footer_top_color};
                    }
                    ";
        }

        $footer_bottom_color = esc_attr($engage_mag_theme_options['engage-mag-bottom-footer-background']);
        if (!empty($footer_bottom_color)) {
            $engage_mag_custom_css .= "                    
                    footer .site-info {
                    background-color: {$footer_bottom_color};
                    }
                    ";
        }


        wp_add_inline_style('engage-news-style', $engage_mag_custom_css);
    }
endif;
add_action('wp_enqueue_scripts', 'engage_news_dynamic_css', 99);