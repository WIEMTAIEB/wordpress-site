<?php
/**
 *  Engage Mag Footer Option
 *
 * @since Engage Mag 1.0.0
 *
 */
/*Footer Options*/
$wp_customize->add_section( 'engage_mag_footer_section', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Footer Options', 'engage-mag' ),
   'panel' 		 => 'engage_mag_panel',
) );
/*Copyright Setting*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-footer-copyright]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-footer-copyright'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-footer-copyright]', array(
    'label'     => __( 'Copyright Text', 'engage-mag' ),
    'description' => __('Enter your own copyright text.', 'engage-mag'),
    'section'   => 'engage_mag_footer_section',
    'settings'  => 'engage_mag_options[engage-mag-footer-copyright]',
    'type'      => 'text',
    'priority'  => 15,
) );

/*Go to Top Setting*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-go-to-top]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-go-to-top'],
    'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-go-to-top]', array(
    'label'     => __( 'Enable Go to Top', 'engage-mag' ),
    'description' => __('Checked to Enable Go to Top', 'engage-mag'),
    'section'   => 'engage_mag_footer_section',
    'settings'  => 'engage_mag_options[engage-mag-go-to-top]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );