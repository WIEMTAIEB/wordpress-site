<?php
/**
 *  Engage Mag Logo Option
 *
 * @since Engage Mag 1.0.0
 *
 */
/*Logo Options*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-custom-logo-position]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-custom-logo-position'],
    'sanitize_callback' => 'engage_mag_sanitize_select'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-custom-logo-position]', array(
   'choices' => array(
    'default'    => __('Left Align','engage-mag'),
    'center'    => __('Center Logo','engage-mag')
),
   'label'     => __( 'Logo Position Option', 'engage-mag' ),
   'description' => __('Your logo will be in the center position.', 'engage-mag'),
   'section'   => 'title_tagline',
   'settings'  => 'engage_mag_options[engage-mag-custom-logo-position]',
   'type'      => 'select',
   'priority'  => 30,
) );