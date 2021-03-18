<?php
/**
 *  Engage Mag Front Page Option
 *
 * @since Engage Mag 1.0.0
 *
 */

/*
* Front Page Options
*/
$wp_customize->add_panel( 'engage_mag_front_page_panel', array(
 'priority' => 25,
 'capability' => 'edit_theme_options',
 'title' => __( 'Engage Mag Front Page', 'engage-mag' ),
) );

/*Post Carousel Below Slider*/
$wp_customize->add_section( 'engage_mag_post_carousel_below_slider', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Post Carousel Below Slider', 'engage-mag' ),
    'panel' 		 => 'engage_mag_front_page_panel',
) );
/*Enable Post Carousel Below Slider*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-enable-post-carousel-below-slider]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-enable-post-carousel-below-slider'],
    'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-enable-post-carousel-below-slider]', array(
    'label'     => __( 'Enable Post Carousel Below Slider', 'engage-mag' ),
    'description' => __('Enable post carousel below Slider.', 'engage-mag'),
    'section'   => 'engage_mag_post_carousel_below_slider',
    'settings'  => 'engage_mag_options[engage-mag-enable-post-carousel-below-slider]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );

/*callback functions you may missed*/
if ( !function_exists('engage_mag_post_carousel_enable') ) :
    function engage_mag_post_carousel_enable(){
        global $engage_mag_theme_options;
        $engage_mag_theme_options = engage_mag_get_options_value();
        $posts_carousel = absint($engage_mag_theme_options['engage-mag-enable-post-carousel-below-slider']);
        if( 1 == $posts_carousel ){
            return true;
        }
        else{
            return false;
        }
    }
endif;

/*Post carousel*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-post-carousel-below-slider-cat]', array(
  'capability'        => 'edit_theme_options',
  'transport' => 'refresh',
  'default'           => $default['engage-mag-post-carousel-below-slider-cat'],
  'sanitize_callback' => 'absint'
) );
$wp_customize->add_control(
  new engage_mag_Customize_Category_Dropdown_Control(
    $wp_customize,
    'engage_mag_options[engage-mag-post-carousel-below-slider-cat]',
    array(
      'label'     => __( 'Select Category For Post Carousel', 'engage-mag' ),
      'description' => __('From the dropdown select the category for the first column.', 'engage-mag'),
      'section'   => 'engage_mag_post_carousel_below_slider',
      'settings'  => 'engage_mag_options[engage-mag-post-carousel-below-slider-cat]',
      'type'      => 'category_dropdown',
      'priority'  => 15,
      'active_callback'=>'engage_mag_post_carousel_enable'
    )
  )
);


/*Post Carousel Title*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-enable-post-carousel-below-slider-title]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-enable-post-carousel-below-slider-title'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-enable-post-carousel-below-slider-title]', array(
    'label'     => __( 'Title Post Carousel Below Slider', 'engage-mag' ),
    'description' => __('Enter the title of Post Carousel.', 'engage-mag'),
    'section'   => 'engage_mag_post_carousel_below_slider',
    'settings'  => 'engage_mag_options[engage-mag-enable-post-carousel-below-slider-title]',
    'type'      => 'text',
    'priority'  => 15,
    'active_callback'=> 'engage_mag_post_carousel_enable',
) );

/*
* You may missed this section
*/
$wp_customize->add_section( 'engage_mag_you_may_missed_before_footer', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'You May Have Missed This', 'engage-mag' ),
    'panel'          => 'engage_mag_front_page_panel',
) );

/*You may missed this*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-footer-you-may-missed]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-footer-you-may-missed'],
    'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-footer-you-may-missed]', array(
    'label'     => __( 'Enable You May Missed', 'engage-mag' ),
    'description' => __('Checked to enable you may missed this section above footer.', 'engage-mag'),
    'section'   => 'engage_mag_you_may_missed_before_footer',
    'settings'  => 'engage_mag_options[engage-mag-footer-you-may-missed]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );

/*callback functions you may missed*/
if ( !function_exists('engage_mag_footer_you_may_missed_section') ) :
    function engage_mag_footer_you_may_missed_section(){
        global $engage_mag_theme_options;
        $engage_mag_theme_options = engage_mag_get_options_value();
        $related_posts = absint($engage_mag_theme_options['engage-mag-footer-you-may-missed']);
        if( 1 == $related_posts ){
            return true;
        }
        else{
            return false;
        }
    }
endif;

/*You may have missed Title*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-footer-you-may-missed-title]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-footer-you-may-missed-title'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-footer-you-may-missed-title]', array(
    'label'     => __( 'Title You May Missed', 'engage-mag' ),
    'description' => __('Title for you may missed this.', 'engage-mag'),
    'section'   => 'engage_mag_you_may_missed_before_footer',
    'settings'  => 'engage_mag_options[engage-mag-footer-you-may-missed-title]',
    'type'      => 'text',
    'priority'  => 15,
    'active_callback'=> 'engage_mag_footer_you_may_missed_section',
) );

/*You may missed Category Selection*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-you-missed-select-category]', array(
  'capability'        => 'edit_theme_options',
  'transport' => 'refresh',
  'default'           => $default['engage-mag-you-missed-select-category'],
  'sanitize_callback' => 'absint'
) );
$wp_customize->add_control(
  new engage_mag_Customize_Category_Dropdown_Control(
    $wp_customize,
    'engage_mag_options[engage-mag-you-missed-select-category]',
    array(
      'label'     => __( 'Select Category For You may missed', 'engage-mag' ),
      'description' => __('From the dropdown select the category for the footer you may missed section.', 'engage-mag'),
      'section'   => 'engage_mag_you_may_missed_before_footer',
      'settings'  => 'engage_mag_options[engage-mag-you-missed-select-category]',
      'type'      => 'category_dropdown',
      'priority'  => 15,
      'active_callback'=>'engage_mag_footer_you_may_missed_section'
    )
  )
);

/*
* Sidebar Option for the Front Page
*/
$wp_customize->add_section( 'engage_mag_front_page_sidebar_section', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Sidebar Layout Option', 'engage-mag' ),
    'panel'          => 'engage_mag_front_page_panel',
) );

/*Front Page Sidebar Layout*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-sidebar-front-page]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-sidebar-front-page'],
    'sanitize_callback' => 'engage_mag_sanitize_select'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-sidebar-front-page]', array(
   'choices' => array(
    'right-sidebar'   => __('Right Sidebar','engage-mag'),
    'left-sidebar'    => __('Left Sidebar','engage-mag'),
    'no-sidebar'      => __('No Sidebar','engage-mag'),
    'middle-column'   => __('Middle Column','engage-mag')
),
   'label'     => __( 'Front Page Sidebar', 'engage-mag' ),
   'description' => __('This sidebar will work for Front Page', 'engage-mag'),
   'section'   => 'engage_mag_front_page_sidebar_section',
   'settings'  => 'engage_mag_options[engage-mag-sidebar-front-page]',
   'type'      => 'select',
   'priority'  => 10,
) );

/*
* miscellaneous setting home page
*/
$wp_customize->add_section( 'engage_mag_miscellaneous_settings_home', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Miscellaneous Home Page Settings', 'engage-mag' ),
    'panel'          => 'engage_mag_front_page_panel',
) );

/*Home Page Content*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-front-page-content]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-front-page-content'],
    'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-front-page-content]', array(
    'label'     => __( 'Hide Front Page Content', 'engage-mag' ),
    'description' => __( 'Checked to hide the front page content from front page.', 'engage-mag' ),
    'section'   => 'engage_mag_miscellaneous_settings_home',
    'settings'  => 'engage_mag_options[engage-mag-front-page-content]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );