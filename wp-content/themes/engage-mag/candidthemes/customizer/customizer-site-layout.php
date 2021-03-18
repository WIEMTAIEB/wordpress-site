<?php
/**
 *  Engage Mag Site Layout Option
 *
 * @since Engage Mag 1.0.0
 *
 */
/*Site Layout Section*/
$wp_customize->add_section( 'engage_mag_site_layout_section', array(
   'priority'       => 35,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Site Layout Options', 'engage-mag' ),
   'panel'     => 'engage_mag_panel',
) );
/*Site Layout settings*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-site-layout-options]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-site-layout-options'],
    'sanitize_callback' => 'engage_mag_sanitize_select'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-site-layout-options]', array(
   'choices' => array(
    'boxed'    => __('Boxed Layout','engage-mag'),
    'full-width'    => __('Full Width','engage-mag')
),
   'label'     => __( 'Site Layout Option', 'engage-mag' ),
   'description' => __('You can make the overall site full width or boxed in nature.', 'engage-mag'),
   'section'   => 'engage_mag_site_layout_section',
   'settings'  => 'engage_mag_options[engage-mag-site-layout-options]',
   'type'      => 'select',
   'priority'  => 30,
) );

/*callback functions header section*/
if ( !function_exists('engage_mag_boxed_layout_width') ) :
  function engage_mag_boxed_layout_width(){
      global $engage_mag_theme_options;
      $engage_mag_theme_options = engage_mag_get_options_value();
      $boxed_width = esc_attr($engage_mag_theme_options['engage-mag-site-layout-options']);
      if( 'boxed' == $boxed_width ){
          return true;
      }
      else{
          return false;
      }
  }
endif;

/*Site Layout width*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-boxed-width-options]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-boxed-width-options'],
    'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-boxed-width-options]', array(
   'label'     => __( 'Set Boxed Width Range', 'engage-mag' ),
   'description' => __('Make the required width of your boxed layout. Select a custom width for the boxed layout. Minimim is 1200px and maximum is 1500px.', 'engage-mag'),
   'section'   => 'engage_mag_site_layout_section',
   'settings'  => 'engage_mag_options[engage-mag-boxed-width-options]',
   'type'      => 'range',
   'priority'  => 30,
   'input_attrs' => array(
          'min' => 1200,
          'max' => 1500,
        ),
   'active_callback' => 'engage_mag_boxed_layout_width',
) );