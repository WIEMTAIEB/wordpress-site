<?php
/**
 *  Engage Mag Sticky Sidebar Option
 *
 * @since Engage Mag 1.0.0
 *
 */

/*Sticky Sidebar*/
$wp_customize->add_section( 'engage_mag_sticky_sidebar', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Sticky Sidebar', 'engage-mag' ),
    'panel' 		 => 'engage_mag_panel',
) );
/*Sticky Sidebar Setting*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-enable-sticky-sidebar]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-enable-sticky-sidebar'],
    'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-enable-sticky-sidebar]', array(
    'label'     => __( 'Sticky Sidebar Option', 'engage-mag' ),
    'description' => __('Enable and Disable sticky sidebar from this section.', 'engage-mag'),
    'section'   => 'engage_mag_sticky_sidebar',
    'settings'  => 'engage_mag_options[engage-mag-enable-sticky-sidebar]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );