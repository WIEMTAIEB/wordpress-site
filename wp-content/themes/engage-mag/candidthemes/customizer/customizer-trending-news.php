<?php
/**
 *  Engage Mag Top Header Option
 *
 * @since Engage Mag 1.0.0
 *
 */
/*Top Header Options*/
$wp_customize->add_section( 'engage_mag_trending_news_section', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Trending News Options', 'engage-mag' ),
   'panel'     => 'engage_mag_panel',
) );

/*Trending News*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-enable-trending-news]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-enable-trending-news'],
    'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-enable-trending-news]', array(
    'label'     => __( 'Trending News in Header', 'engage-mag' ),
    'description' => __('Trending News will appear on the top header.', 'engage-mag'),
    'section'   => 'engage_mag_trending_news_section',
    'settings'  => 'engage_mag_options[engage-mag-enable-trending-news]',
    'type'      => 'checkbox',
    'priority'  => 5,
) );

/*callback functions header section*/
if ( !function_exists('engage_mag_header_trending_active_callback') ) :
  function engage_mag_header_trending_active_callback(){
      global $engage_mag_theme_options;
      $engage_mag_theme_options = engage_mag_get_options_value();
      $enable_trending = absint($engage_mag_theme_options['engage-mag-enable-trending-news']);
      if( 1 == $enable_trending   ){
          return true;
      }
      else{
          return false;
      }
  }
endif;

/*Trending News Category Selection*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-trending-news-category]', array(
  'capability'        => 'edit_theme_options',
  'transport' => 'refresh',
  'default'           => $default['engage-mag-trending-news-category'],
  'sanitize_callback' => 'absint'
) );
$wp_customize->add_control(
  new engage_mag_Customize_Category_Dropdown_Control(
    $wp_customize,
    'engage_mag_options[engage-mag-trending-news-category]',
    array(
      'label'     => __( 'Select Category For Trending News', 'engage-mag' ),
      'description' => __('Select the category from dropdown. It will appear on the header.', 'engage-mag'),
      'section'   => 'engage_mag_trending_news_section',
      'settings'  => 'engage_mag_options[engage-mag-trending-news-category]',
      'type'      => 'category_dropdown',
      'priority'  => 5,
      'active_callback'=>'engage_mag_header_trending_active_callback'
    )
  )
);

/*Trending News*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-enable-trending-news-text]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-enable-trending-news-text'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-enable-trending-news-text]', array(
    'label'     => __( 'Trending News Text', 'engage-mag' ),
    'description' => __('Write your own text in place of Trending news.', 'engage-mag'),
    'section'   => 'engage_mag_trending_news_section',
    'settings'  => 'engage_mag_options[engage-mag-enable-trending-news-text]',
    'type'      => 'text',
    'priority'  => 5,
    'active_callback'=>'engage_mag_header_trending_active_callback'
) );