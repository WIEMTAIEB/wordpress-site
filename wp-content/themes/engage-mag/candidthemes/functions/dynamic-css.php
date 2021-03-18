<?php
/**
 * Dynamic CSS elements.
 *
 * @package Engage Mag
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


if (!function_exists('engage_mag_dynamic_css')) :
    /**
     * Dynamic CSS
     *
     * @since 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function engage_mag_dynamic_css()
    {

        global $engage_mag_theme_options;
    
        /* Paragraph Font Options */

        $engage_mag_primary_color = $engage_mag_theme_options['engage-mag-primary-color'] ?  esc_attr( $engage_mag_theme_options['engage-mag-primary-color'] ) : '#ff0000';
    


        $engage_mag_header_color = get_header_textcolor();
        $engage_mag_custom_css = '';

        if (!empty($engage_mag_header_color)) {
            $engage_mag_custom_css .= ".site-branding h1, .site-branding p.site-title,.ct-dark-mode .site-title a, .site-title, .site-title a { color: #{$engage_mag_header_color}; }";
        }

        $engage_mag_site_title_hover_color = esc_attr( $engage_mag_theme_options['engage-mag-site-title-hover'] );
        if (!empty($engage_mag_site_title_hover_color)) {
            $engage_mag_custom_css .= ".ct-dark-mode .site-title a:hover,.site-title a:hover, .site-title a:visited:hover, .ct-dark-mode .site-title a:visited:hover { color: {$engage_mag_site_title_hover_color}; }";
        }

        $engage_mag_site_desc_color = esc_attr( $engage_mag_theme_options['engage-mag-site-tagline'] );
        if (!empty($engage_mag_site_desc_color)) {
            $engage_mag_custom_css .= ".ct-dark-mode .site-branding  .site-description, .site-branding  .site-description { color: {$engage_mag_site_desc_color}; }";
        }

        /* Primary Color Section */
        if (!empty($engage_mag_primary_color)) {
            //font-color
            $engage_mag_custom_css .= ".entry-content a, .entry-title a:hover, .related-title a:hover, .posts-navigation .nav-previous a:hover, .post-navigation .nav-previous a:hover, .posts-navigation .nav-next a:hover, .post-navigation .nav-next a:hover, #comments .comment-content a:hover, #comments .comment-author a:hover, .offcanvas-menu nav ul.top-menu li a:hover, .offcanvas-menu nav ul.top-menu li.current-menu-item > a, .error-404-title, #engage-mag-breadcrumbs a:hover, .entry-content a.read-more-text:hover, a:hover, a:visited:hover, .widget_engage_mag_category_tabbed_widget.widget ul.ct-nav-tabs li a  { color : {$engage_mag_primary_color}; }";

            //background-color
            $engage_mag_custom_css .= ".candid-refined-post-format, .refined-magazine-featured-block .refined-magazine-col-2 .candid-refined-post-format, .cat-links a,.top-bar,.main-navigation #primary-menu li a:hover, .main-navigation #primary-menu li.current-menu-item > a, .candid-refined-post-format, .engage-mag-featured-block .engage-mag-col-2 .candid-refined-post-format, .trending-title, .search-form input[type=submit], input[type=\"submit\"], ::selection, #toTop, .breadcrumbs span.breadcrumb, article.sticky .engage-mag-content-container, .candid-pagination .page-numbers.current, .candid-pagination .page-numbers:hover, .ct-title-head, .widget-title:before,
.about-author-box .container-title:before, .widget ul.ct-nav-tabs:after, .widget ul.ct-nav-tabs li.ct-title-head:hover, .widget ul.ct-nav-tabs li.ct-title-head.ui-tabs-active, .cat-links a { background-color : {$engage_mag_primary_color}; }";

            //border-color
            $engage_mag_custom_css .= ".candid-refined-post-format, .engage-mag-featured-block .engage-mag-col-2 .candid-refined-post-format, blockquote, .search-form input[type=\"submit\"], input[type=\"submit\"], .candid-pagination .page-numbers { border-color : {$engage_mag_primary_color}; }";
        }

        $enable_category_color = $engage_mag_theme_options['engage-mag-enable-category-color'];
        if($enable_category_color == 1){
            $args = array(
                'orderby' => 'id',
                'hide_empty' => 0
            );
            $categories = get_categories( $args );
            $wp_category_list = array();
            $i = 1;
            foreach ($categories as $category_list ) {
                $wp_category_list[$category_list->cat_ID] = $category_list->cat_name;

                $cat_color = 'cat-'.esc_attr( get_cat_id($wp_category_list[$category_list->cat_ID]) );



                if(array_key_exists($cat_color, $engage_mag_theme_options)) {
                    $cat_color_code = $engage_mag_theme_options[$cat_color];
                    $engage_mag_custom_css .= "
                    .cat-{$category_list->cat_ID} .ct-title-head,
                    .cat-{$category_list->cat_ID}.widget-title:before,
                     .cat-{$category_list->cat_ID} .widget-title:before,
                      .ct-cat-item-{$category_list->cat_ID}{
                    background: {$cat_color_code}!important;
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

        $enable_underline_link = $engage_mag_theme_options['engage-mag-enable-underline-link'];
        if($enable_underline_link == true){
            $engage_mag_custom_css .= ".entry-content a {  text-decoration: underline; } .entry-content a.read-more-text { text-decoration: none; } ";
        }
        $logo_section_color = esc_attr( $engage_mag_theme_options['engage-mag-logo-section-background'] );
        if(!empty($logo_section_color)){
            $engage_mag_custom_css .= ".logo-wrapper-block{background-color : {$logo_section_color}; }";
        }

        $box_width = absint($engage_mag_theme_options['engage-mag-boxed-width-options']);
        if(!empty($box_width)){
            $engage_mag_custom_css .= "@media (min-width: 1600px){.ct-boxed #page{max-width : {$box_width}px; }}";
        }
        if($box_width < 1370){
            $engage_mag_custom_css .= "@media (min-width: 1450px){.ct-boxed #page{max-width : {$box_width}px; }}";
        }



        wp_add_inline_style('engage-mag-style', $engage_mag_custom_css);
    }
endif;
add_action('wp_enqueue_scripts', 'engage_mag_dynamic_css', 99);