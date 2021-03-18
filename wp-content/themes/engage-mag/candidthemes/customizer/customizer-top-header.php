<?php
/**
 *  Engage Mag Top Header Option
 *
 * @since Engage Mag 1.0.0
 *
 */
/*Top Header Options*/
$wp_customize->add_section( 'engage_mag_header_section', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Top Header Options', 'engage-mag' ),
   'panel' 		 => 'engage_mag_panel',
) );
/*callback functions header section*/
if ( !function_exists('engage_mag_header_active_callback') ) :
  function engage_mag_header_active_callback(){
      global $engage_mag_theme_options;
      $engage_mag_theme_options = engage_mag_get_options_value();
      $enable_header = absint($engage_mag_theme_options['engage-mag-enable-top-header']);
      if( 1 == $enable_header ){
          return true;
      }
      else{
          return false;
      }
  }
endif;
/*Enable Top Header Section*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-enable-top-header]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['engage-mag-enable-top-header'],
   'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-enable-top-header]', array(
   'label'     => __( 'Enable Top Header', 'engage-mag' ),
   'description' => __('Checked to show the top header section like search and social icons', 'engage-mag'),
   'section'   => 'engage_mag_header_section',
   'settings'  => 'engage_mag_options[engage-mag-enable-top-header]',
   'type'      => 'checkbox',
   'priority'  => 5,
) );
/*Enable Social Icons In Header*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-enable-top-header-social]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['engage-mag-enable-top-header-social'],
   'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-enable-top-header-social]', array(
   'label'     => __( 'Enable Social Icons', 'engage-mag' ),
   'description' => __('You can show the social icons here. Manage social icons from Appearance > Menus. Social Menu will display here.', 'engage-mag'),
   'section'   => 'engage_mag_header_section',
   'settings'  => 'engage_mag_options[engage-mag-enable-top-header-social]',
   'type'      => 'checkbox',
   'priority'  => 5,
   'active_callback'=>'engage_mag_header_active_callback'
) );

/*Enable Menu in top Header*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-enable-top-header-menu]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-enable-top-header-menu'],
    'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-enable-top-header-menu]', array(
    'label'     => __( 'Menu in Header', 'engage-mag' ),
    'description' => __('Top Header Menu will display here. Go to Appearance < Menu.', 'engage-mag'),
    'section'   => 'engage_mag_header_section',
    'settings'  => 'engage_mag_options[engage-mag-enable-top-header-menu]',
    'type'      => 'checkbox',
    'priority'  => 5,
    'active_callback'=>'engage_mag_header_active_callback'
) );

/*Enable Date in top Header*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-enable-top-header-date]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-enable-top-header-date'],
    'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-enable-top-header-date]', array(
    'label'     => __( 'Date in Header', 'engage-mag' ),
    'description' => __('Enable Date in Header', 'engage-mag'),
    'section'   => 'engage_mag_header_section',
    'settings'  => 'engage_mag_options[engage-mag-enable-top-header-date]',
    'type'      => 'checkbox',
    'priority'  => 5,
    'active_callback'=>'engage_mag_header_active_callback'
) );

/*Date format*/
$wp_customize->add_setting('engage_mag_options[engage-mag-top-header-date-format]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['engage-mag-top-header-date-format'],
    'sanitize_callback' => 'engage_mag_sanitize_select'
));
$wp_customize->add_control('engage_mag_options[engage-mag-top-header-date-format]', array(
    'choices' => array(
        'default-date' => __('Theme Default Date Format', 'engage-mag'),
        'core-date' => __('Setting Date Fromat', 'engage-mag'),
    ),
    'label' => __('Select Date Format in Header', 'engage-mag'),
    'description' => __('You can have default format for date or Setting > General date format.', 'engage-mag'),
    'section' => 'engage_mag_header_section',
    'settings' => 'engage_mag_options[engage-mag-top-header-date-format]',
    'type' => 'select',
    'priority' => 5,
    'active_callback'=> 'engage_mag_header_active_callback',
));