<?php 
/**
 *  Engage Mag Breadcrumb Settings Option
 *
 * @since Engage Mag 1.0.0
 *
 */
/*Breadcrumb Options*/
$wp_customize->add_section( 'engage_mag_breadcrumb_options', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Breadcrumb Settings', 'engage-mag' ),
    'panel'          => 'engage_mag_panel',
) );

/*Breadcrumb Enable*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-extra-breadcrumb]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-extra-breadcrumb'],
    'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-extra-breadcrumb]', array(
    'label'     => __( 'Enable Breadcrumb', 'engage-mag' ),
    'description' => __( 'Breadcrumb will appear on all pages except home page', 'engage-mag' ),
    'section'   => 'engage_mag_breadcrumb_options',
    'settings'  => 'engage_mag_options[engage-mag-extra-breadcrumb]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );

/*callback functions breadcrumb enable*/
if ( !function_exists('engage_mag_breadcrumb_selection_enable') ) :
  function engage_mag_breadcrumb_selection_enable(){
      global $engage_mag_theme_options;
      $engage_mag_theme_options = engage_mag_get_options_value();
      $enable_bc = absint($engage_mag_theme_options['engage-mag-extra-breadcrumb']);
      if( $enable_bc == true){
          return true;
      }
      else{
          return false;
      }
  }
endif;

/*Show Breadcrumb Types Selection*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-breadcrumb-display-from-option]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-breadcrumb-display-from-option'],
    'sanitize_callback' => 'engage_mag_sanitize_select'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-breadcrumb-display-from-option]', array(
    'choices' => array(
        'theme-default'    => __('Theme Default Breadcrumb','engage-mag'),
        'plugin-breadcrumb'    => __('Plugins Breadcrumb','engage-mag')
    ),
    'label'     => __( 'Select the Breadcrumb Show Option', 'engage-mag' ),
    'description' => __('Theme has its own breadcrumb. If you want to use the plugin breadcrumb, you need to enable the breadcrumb on the respected plugins first. Check plugin settings and enable it.', 'engage-mag'),
    'section'   => 'engage_mag_breadcrumb_options',
    'settings'  => 'engage_mag_options[engage-mag-breadcrumb-display-from-option]',
    'type'      => 'select',
    'priority'  => 15,
    'active_callback'=> 'engage_mag_breadcrumb_selection_enable',
) );

/*callback functions breadcrumb*/
if ( !function_exists('engage_mag_breadcrumb_selection_option') ) :
  function engage_mag_breadcrumb_selection_option(){
      global $engage_mag_theme_options;
      $engage_mag_theme_options = engage_mag_get_options_value();
      $enable_breadcrumb = absint($engage_mag_theme_options['engage-mag-extra-breadcrumb']);
      $breadcrumb_selection = esc_attr($engage_mag_theme_options['engage-mag-breadcrumb-display-from-option']);
      if( 'theme-default' == $breadcrumb_selection && $enable_breadcrumb == true){
          return true;
      }
      else{
          return false;
      }
  }
endif;

/*callback functions breadcrumb*/
if ( !function_exists('engage_mag_breadcrumb_selection_plugin') ) :
  function engage_mag_breadcrumb_selection_plugin(){
      global $engage_mag_theme_options;
      $engage_mag_theme_options = engage_mag_get_options_value();
      $enable_breadcrumb_plugin = absint($engage_mag_theme_options['engage-mag-extra-breadcrumb']);
      $breadcrumb_selection_plugin = esc_attr($engage_mag_theme_options['engage-mag-breadcrumb-display-from-option']);
      if( 'plugin-breadcrumb' == $breadcrumb_selection_plugin && $enable_breadcrumb_plugin == true){
          return true;
      }
      else{
          return false;
      }
  }
endif;

/*Breadcrumb Text*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-breadcrumb-text]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-breadcrumb-text'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-breadcrumb-text]', array(
    'label'     => __( 'Breadcrumb Text', 'engage-mag' ),
    'description' => __( 'Write your own text in place of You are Here', 'engage-mag' ),
    'section'   => 'engage_mag_breadcrumb_options',
    'settings'  => 'engage_mag_options[engage-mag-breadcrumb-text]',
    'type'      => 'text',
    'priority'  => 15,
    'active_callback' => 'engage_mag_breadcrumb_selection_option',
) );


/*Show Breadcrumb From Plugins*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-breadcrumb-display-from-plugins]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-breadcrumb-display-from-plugins'],
    'sanitize_callback' => 'engage_mag_sanitize_select'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-breadcrumb-display-from-plugins]', array(
    'choices' => array(
        'yoast'    => __('Yoast SEO Breadcrumb','engage-mag'),
        'rank-math'    => __('Rank Math Breadcrumb','engage-mag'),
        'navxt'    => __('Breadcrumb NavXT','engage-mag')
    ),
    'label'     => __( 'Select the Breadcrumb From Plugins', 'engage-mag' ),
    'description' => __('Theme has its own breadcrumb. If you want to use the plugin breadcrumb, you need to enable the breadcrumb on the respected plugins first. Check plugin settings and enable it.', 'engage-mag'),
    'section'   => 'engage_mag_breadcrumb_options',
    'settings'  => 'engage_mag_options[engage-mag-breadcrumb-display-from-plugins]',
    'type'      => 'select',
    'priority'  => 15,
    'active_callback'=> 'engage_mag_breadcrumb_selection_plugin',
) );