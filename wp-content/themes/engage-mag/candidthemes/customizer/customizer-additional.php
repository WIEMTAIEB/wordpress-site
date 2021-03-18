<?php 
/**
 *  Engage Mag Additional Settings Option
 *
 * @since Engage Mag 1.0.0
 *
 */
/*Extra Options*/
$wp_customize->add_section( 'engage_mag_extra_options', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Extra Options', 'engage-mag' ),
    'panel'          => 'engage_mag_panel',
) );

/*Preloader Enable*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-extra-preloader]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-extra-preloader'],
    'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-extra-preloader]', array(
    'label'     => __( 'Enable Preloader', 'engage-mag' ),
    'description' => __( 'It will enable the preloader on the website.', 'engage-mag' ),
    'section'   => 'engage_mag_extra_options',
    'settings'  => 'engage_mag_options[engage-mag-extra-preloader]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );

/*Hide Default Images*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-extra-hide-default-thumbnails]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-extra-hide-default-thumbnails'],
    'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-extra-hide-default-thumbnails]', array(
    'label'     => __( 'Hide Default Thumbnail From Widgets', 'engage-mag' ),
    'description' => __( 'You can hide the thumbnail from here or replace by adding featured image on each posts. Edit the post and check the thumbnail is missing.', 'engage-mag' ),
    'section'   => 'engage_mag_extra_options',
    'settings'  => 'engage_mag_options[engage-mag-extra-hide-default-thumbnails]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );

/*Hide Read More Time*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-extra-hide-read-time]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-extra-hide-read-time'],
    'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-extra-hide-read-time]', array(
    'label'     => __( 'Hide Reading Time', 'engage-mag' ),
    'description' => __( 'You can hide the reading time in whole site.', 'engage-mag' ),
    'section'   => 'engage_mag_extra_options',
    'settings'  => 'engage_mag_options[engage-mag-extra-hide-read-time]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );

/* Read More Number Words*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-extra-hide-read-time-words]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-extra-hide-read-time-words'],
    'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-extra-hide-read-time-words]', array(
    'label'     => __( 'Reading Time Words per Minute', 'engage-mag' ),
    'description' => __( 'Enter the number of Words users can read per minute.', 'engage-mag' ),
    'section'   => 'engage_mag_extra_options',
    'settings'  => 'engage_mag_options[engage-mag-extra-hide-read-time-words]',
    'type'      => 'number',
    'priority'  => 15,
) );