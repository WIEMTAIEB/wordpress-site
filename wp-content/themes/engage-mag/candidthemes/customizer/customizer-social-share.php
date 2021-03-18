<?php
/**
 *  Engage Mag Social Share Option
 *
 * @since Engage Mag 1.0.0
 *
 */
/*Top Header Options*/
$wp_customize->add_section( 'engage_mag_social_share_section', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Social Share Options', 'engage-mag' ),
   'panel'     => 'engage_mag_panel',
) );

/*Blog Page Social Share*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-enable-blog-sharing]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['engage-mag-enable-blog-sharing'],
    'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-enable-blog-sharing]', array(
    'label'     => __( 'Enable Social Sharing', 'engage-mag' ),
    'description' => __('Checked to Enable Social Sharing In Home Page,  Search Page and Archive page.', 'engage-mag'),
    'section'   => 'engage_mag_social_share_section',
    'settings'  => 'engage_mag_options[engage-mag-enable-blog-sharing]',
    'type'      => 'checkbox',
    'priority'  => 10,
) );