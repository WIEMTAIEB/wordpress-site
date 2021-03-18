<?php
/**
 *  Engage Mag Slider Featured Section Option
 *
 * @since Engage Mag 1.0.0
 *
 */
/*Slider Options*/
$wp_customize->add_section( 'engage_mag_slider_section', array(
 'priority'       => 14,
 'capability'     => 'edit_theme_options',
 'theme_supports' => '',
 'title'          => __( 'Featured Section', 'engage-mag' ),
 'panel' 		 => 'engage_mag_front_page_panel',
) );
/*callback functions slider*/
if ( !function_exists('engage_mag_slider_active_callback') ) :
  function engage_mag_slider_active_callback(){
    global $engage_mag_theme_options;
    $engage_mag_theme_options = engage_mag_get_options_value();
    $enable_slider = absint($engage_mag_theme_options['engage-mag-enable-slider']);
    if( 1 == $enable_slider ){
      return true;
    }
    else{
      return false;
    }
  }
endif;
/*Slider Enable Option*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-enable-slider]', array(
 'capability'        => 'edit_theme_options',
 'transport' => 'refresh',
 'default'           => $default['engage-mag-enable-slider'],
 'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-enable-slider]', array(
 'label'     => __( 'Enable Featured Section', 'engage-mag' ),
 'description' => __('Checked to Featured Section In Home Page.', 'engage-mag'),
 'section'   => 'engage_mag_slider_section',
 'settings'  => 'engage_mag_options[engage-mag-enable-slider]',
 'type'      => 'checkbox',
 'priority'  => 10,
) );
/*Slider Category Left Selection*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-select-category]', array(
  'capability'        => 'edit_theme_options',
  'transport' => 'refresh',
  'default'           => $default['engage-mag-select-category'],
  'sanitize_callback' => 'absint'
) );
$wp_customize->add_control(
  new engage_mag_Customize_Category_Dropdown_Control(
    $wp_customize,
    'engage_mag_options[engage-mag-select-category]',
    array(
      'label'     => __( 'Select Category For Featured Left Section', 'engage-mag' ),
      'description' => __('From the dropdown select the category for the featured left section. Category having post will display in below dropdown.', 'engage-mag'),
      'section'   => 'engage_mag_slider_section',
      'settings'  => 'engage_mag_options[engage-mag-select-category]',
      'type'      => 'category_dropdown',
      'priority'  => 10,
      'active_callback'=>'engage_mag_slider_active_callback'
    )
  )
);

/*Slider Category Right Selection*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-select-category-featured-right]', array(
  'capability'        => 'edit_theme_options',
  'transport' => 'refresh',
  'default'           => $default['engage-mag-select-category-featured-right'],
  'sanitize_callback' => 'absint'
) );
$wp_customize->add_control(
  new engage_mag_Customize_Category_Dropdown_Control(
    $wp_customize,
    'engage_mag_options[engage-mag-select-category-featured-right]',
    array(
      'label'     => __( 'Select Category For Featured Right Section', 'engage-mag' ),
      'description' => __('From the dropdown select the category for the featured right section. Category having post will display in below dropdown.', 'engage-mag'),
      'section'   => 'engage_mag_slider_section',
      'settings'  => 'engage_mag_options[engage-mag-select-category-featured-right]',
      'type'      => 'category_dropdown',
      'priority'  => 10,
      'active_callback'=>'engage_mag_slider_active_callback'
    )
  )
);