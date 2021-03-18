<?php
/**
 *  Engage Mag Menu Option
 *
 * @since Engage Mag 1.0.0
 *
 */
/*Menu Options*/
$wp_customize->add_section( 'engage_mag_primary_menu_section', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Menu Section Options', 'engage-mag' ),
   'panel'     => 'engage_mag_panel',
) );

/*Enable Search Icons In Header*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-enable-sticky-primary-menu]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['engage-mag-enable-sticky-primary-menu'],
   'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-enable-sticky-primary-menu]', array(
   'label'     => __( 'Enable Primary Menu Sticky', 'engage-mag' ),
   'description' => __('The main primary menu will be sticky.', 'engage-mag'),
   'section'   => 'engage_mag_primary_menu_section',
   'settings'  => 'engage_mag_options[engage-mag-enable-sticky-primary-menu]',
   'type'      => 'checkbox',
   'priority'  => 5,
) );

/*Enable Search Icons In Header*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-enable-menu-section-search]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['engage-mag-enable-menu-section-search'],
   'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-enable-menu-section-search]', array(
   'label'     => __( 'Enable Search Icons', 'engage-mag' ),
   'description' => __('You can show the search field in header.', 'engage-mag'),
   'section'   => 'engage_mag_primary_menu_section',
   'settings'  => 'engage_mag_options[engage-mag-enable-menu-section-search]',
   'type'      => 'checkbox',
   'priority'  => 5,
) );

/*Enable Home Icons In Menu*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-enable-menu-home-icon]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['engage-mag-enable-menu-home-icon'],
   'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-enable-menu-home-icon]', array(
   'label'     => __( 'Enable Home Icons', 'engage-mag' ),
   'description' => __('Home Icon will displayed in menu.', 'engage-mag'),
   'section'   => 'engage_mag_primary_menu_section',
   'settings'  => 'engage_mag_options[engage-mag-enable-menu-home-icon]',
   'type'      => 'checkbox',
   'priority'  => 5,
) );