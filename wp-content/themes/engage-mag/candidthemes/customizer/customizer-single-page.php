<?php
/**
 *  Engage Mag Single Page Option
 *
 * @since Engage Mag 1.0.0
 *
 */
/*Single Page Options*/
$wp_customize->add_section( 'engage_mag_single_page_section', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Single Post Options', 'engage-mag' ),
   'panel' 		 => 'engage_mag_panel',
) );

/*Featured Image Option*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-single-page-featured-image]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-single-page-featured-image'],
    'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-single-page-featured-image]', array(
    'label'     => __( 'Enable Featured Image', 'engage-mag' ),
    'description' => __('You can hide or show featured image on single page.', 'engage-mag'),
    'section'   => 'engage_mag_single_page_section',
    'settings'  => 'engage_mag_options[engage-mag-single-page-featured-image]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );

/*Enable Underline in single post link place */
$wp_customize->add_setting( 'engage_mag_options[engage-mag-enable-underline-link]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-enable-underline-link'],
    'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-enable-underline-link]', array(
    'label'     => __( 'Enable Underline on Link', 'engage-mag' ),
    'description' => __('If you enabled this, you will see the underline in the links. You can change it color from the general section of colors.', 'engage-mag'),
    'section'   => 'engage_mag_single_page_section',
    'settings'  => 'engage_mag_options[engage-mag-enable-underline-link]',
    'type'      => 'checkbox',
    'priority'  => 20,
) );

/*Related Post Options*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-single-page-related-posts]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-single-page-related-posts'],
    'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-single-page-related-posts]', array(
    'label'     => __( 'Enable Related Posts', 'engage-mag' ),
    'description' => __('3 Post from similar category will display at the end of the page.', 'engage-mag'),
    'section'   => 'engage_mag_single_page_section',
    'settings'  => 'engage_mag_options[engage-mag-single-page-related-posts]',
    'type'      => 'checkbox',
    'priority'  => 20,
) );
/*callback functions related posts*/
if ( !function_exists('engage_mag_related_post_callback') ) :
    function engage_mag_related_post_callback(){
        global $engage_mag_theme_options;
        $engage_mag_theme_options = engage_mag_get_options_value();
        $related_posts = absint($engage_mag_theme_options['engage-mag-single-page-related-posts']);
        if( 1 == $related_posts ){
            return true;
        }
        else{
            return false;
        }
    }
endif;
/*Related Post Title*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-single-page-related-posts-title]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-single-page-related-posts-title'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-single-page-related-posts-title]', array(
    'label'     => __( 'Related Posts Title', 'engage-mag' ),
    'description' => __('Give the appropriate title for related posts', 'engage-mag'),
    'section'   => 'engage_mag_single_page_section',
    'settings'  => 'engage_mag_options[engage-mag-single-page-related-posts-title]',
    'type'      => 'text',
    'priority'  => 20,
    'active_callback'=>'engage_mag_related_post_callback'
) );