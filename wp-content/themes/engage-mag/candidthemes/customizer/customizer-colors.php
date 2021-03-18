<?php
/**
 *  Engage Mag Color Option
 *
 * @since Engage Mag 1.0.0
 *
 */

$wp_customize->add_panel(
    'colors',
    [
        'title'    => __( 'Color Options', 'engage-mag' ),
        'priority' => 30, // Before Additional CSS.
    ]
);
$wp_customize->add_section(
    'colors',
    array(
        'title' => __( 'General Colors', 'engage-mag' ),
        'panel' => 'colors',
    )
);

/* Site Title hover color */
$wp_customize->add_setting( 'engage_mag_options[engage-mag-site-title-hover]',
    array(
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'engage_mag_options[engage-mag-site-title-hover]',
        array(
            'label'       => esc_html__( 'Site Title Hover Color', 'engage-mag' ),
            'description' => esc_html__( 'It will change the color of site title in hover.', 'engage-mag' ),
            'section'     => 'colors',
        )
    )
);

/* Site tagline color */
$wp_customize->add_setting( 'engage_mag_options[engage-mag-site-tagline]',
    array(
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'engage_mag_options[engage-mag-site-tagline]',
        array(
            'label'       => esc_html__( 'Site Tagline Color', 'engage-mag' ),
            'description' => esc_html__( 'It will change the color of site tagline color.', 'engage-mag' ),
            'section'     => 'colors',
        )
    )
);

/* Primary Color Section Inside Core Color Option */
$wp_customize->add_setting( 'engage_mag_options[engage-mag-primary-color]',
    array(
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'engage_mag_options[engage-mag-primary-color]',
        array(
            'label'       => esc_html__( 'Primary Color', 'engage-mag' ),
            'description' => esc_html__( 'Applied to main color of site.', 'engage-mag' ),
            'section'     => 'colors',
        )
    )
);



/* Logo Section Colors */

$wp_customize->add_section(
    'logo_colors',
    array(
        'title' => __( 'Logo Section Colors', 'engage-mag' ),
        'panel' => 'colors',
    )
);

/* Colors background the logo */
$wp_customize->add_setting( 'engage_mag_options[engage-mag-logo-section-background]',
    array(
        'default'           => $default['engage-mag-logo-section-background'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'engage_mag_options[engage-mag-logo-section-background]',
        array(
            'label'       => esc_html__( 'Background Color', 'engage-mag' ),
            'description' => esc_html__( 'Will change the color of background logo.', 'engage-mag' ),
            'section'     => 'logo_colors',
        )
    )
);