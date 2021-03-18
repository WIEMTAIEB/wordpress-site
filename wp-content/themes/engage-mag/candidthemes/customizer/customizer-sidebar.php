<?php
/**
 *  Engage Mag Sidebar Option
 *
 * @since Engage Mag 1.0.0
 *
 */
/*Blog Page Options*/
$wp_customize->add_section( 'engage_mag_sidebar_section', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Sidebar Options', 'engage-mag' ),
   'panel' 		 => 'engage_mag_panel',
) );
/*Front Page Sidebar Layout*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-sidebar-blog-page]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-sidebar-blog-page'],
    'sanitize_callback' => 'engage_mag_sanitize_select'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-sidebar-blog-page]', array(
   'choices' => array(
    'right-sidebar'   => __('Right Sidebar','engage-mag'),
    'left-sidebar'    => __('Left Sidebar','engage-mag'),
    'no-sidebar'      => __('No Sidebar','engage-mag'),
    'middle-column'   => __('Middle Column','engage-mag')
),
   'label'     => __( 'Inner Pages Sidebar', 'engage-mag' ),
   'description' => __('This sidebar will work for all Pages', 'engage-mag'),
   'section'   => 'engage_mag_sidebar_section',
   'settings'  => 'engage_mag_options[engage-mag-sidebar-blog-page]',
   'type'      => 'select',
   'priority'  => 10,
) );
/*Archive Page Sidebar Layout*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-sidebar-archive-page]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-sidebar-archive-page'],
    'sanitize_callback' => 'engage_mag_sanitize_select'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-sidebar-archive-page]', array(
   'choices' => array(
    'right-sidebar'   => __('Right Sidebar','engage-mag'),
    'left-sidebar'    => __('Left Sidebar','engage-mag'),
    'no-sidebar'      => __('No Sidebar','engage-mag'),
    'middle-column'   => __('Middle Column','engage-mag')
),
   'label'     => __( 'Archive Page Sidebar', 'engage-mag' ),
   'description' => __('This sidebar will work for all Archive Pages', 'engage-mag'),
   'section'   => 'engage_mag_sidebar_section',
   'settings'  => 'engage_mag_options[engage-mag-sidebar-archive-page]',
   'type'      => 'select',
   'priority'  => 10,
) );