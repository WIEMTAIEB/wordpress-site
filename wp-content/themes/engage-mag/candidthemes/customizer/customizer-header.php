<?php
/**
 *  Engage Mag Header Option
 *
 * @since Engage Mag 1.0.0
 *
 */
/*Top Header Options*/
$wp_customize->add_section( 'engage_mag_header_ads_section', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Header Ads Options', 'engage-mag' ),
   'panel' 		 => 'engage_mag_panel',
) );
/*callback functions header section*/
if ( !function_exists('engage_mag_ads_header_active_callback') ) :
  function engage_mag_ads_header_active_callback(){
      global $engage_mag_theme_options;
      $engage_mag_theme_options = engage_mag_get_options_value();
      $enable_ads_header = absint($engage_mag_theme_options['engage-mag-enable-ads-header']);
      if( 1 == $enable_ads_header ){
          return true;
      }
      else{
          return false;
      }
  }
endif;

/*Enable Header Ads Section*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-enable-ads-header]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['engage-mag-enable-ads-header'],
   'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-enable-ads-header]', array(
   'label'     => __( 'Show Header Advertisement', 'engage-mag' ),
   'description' => __('Checked to Enable the header ads. Select either image or google adsense.', 'engage-mag'),
   'section'   => 'engage_mag_header_ads_section',
   'settings'  => 'engage_mag_options[engage-mag-enable-ads-header]',
   'type'      => 'checkbox',
   'priority'  => 10,
) );


/*Header Ads Image*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-header-ads-image]', array(
    'capability'    => 'edit_theme_options',
    'default'     => $default['engage-mag-header-ads-image'],
    'sanitize_callback' => 'engage_mag_sanitize_image'
) );
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'engage_mag_options[engage-mag-header-ads-image]',
        array(
            'label'   => __( 'Header Ad Image', 'engage-mag' ),
            'section'   => 'engage_mag_header_ads_section',
            'settings'  => 'engage_mag_options[engage-mag-header-ads-image]',
            'type'      => 'image',
            'priority'  => 10,
            'active_callback' => 'engage_mag_ads_header_active_callback',
            'description' => __( 'Recommended image size of 728*90', 'engage-mag' )
        )
    )
);

/*Ads Image Link*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-header-ads-image-link]', array(
    'capability'    => 'edit_theme_options',
    'default'     => $default['engage-mag-header-ads-image-link'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-header-ads-image-link]', array(
    'label'   => __( 'Header Ads Image Link', 'engage-mag' ),
    'section'   => 'engage_mag_header_ads_section',
    'settings'  => 'engage_mag_options[engage-mag-header-ads-image-link]',
    'type'      => 'url',
    'active_callback' => 'engage_mag_ads_header_active_callback',
    'priority'  => 10
) );