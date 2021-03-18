<?php
/**
 * Engage Mag Theme Customizer
 *
 * @package Engage Mag
 */
/**
 * Load Customizer Defult Settings
 *
 * Default value for the customizer set here.
 */
require get_template_directory() . '/candidthemes/customizer/customizer-default-values.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function engage_mag_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'engage_mag_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'engage_mag_customize_partial_blogdescription',
		) );
	}
	/**
	 * Load Customizer Settings
	 *
	 * All the settings for appearance > customize
	 */
	require get_template_directory() . '/candidthemes/customizer/customizer-main-panel.php';


	/*Getting Home Page Widget Area on Main Panel*/
	$engage_mag_home_section = $wp_customize->get_section( 'sidebar-widgets-engage-mag-home-widget-area' );
	if ( ! empty( $engage_mag_home_section ) ) {
		$engage_mag_home_section->panel = '';
		$engage_mag_home_section->title = esc_html__( 'Home Page Widget Area ', 'engage-mag' );
		$engage_mag_home_section->priority = 26;
	}
}
add_action( 'customize_register', 'engage_mag_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function engage_mag_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function engage_mag_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function engage_mag_customize_preview_js() {
	wp_enqueue_script( 'engage-mag-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '1.0.0', true );
}
add_action( 'customize_preview_init', 'engage_mag_customize_preview_js' );

/**
 * Customizer Styles
 */
function engage_mag_customizer_css() {
    wp_enqueue_style('engage-mag-customizer-css', get_template_directory_uri() . '/candidthemes/assets/css/customizer-style.css', array(), '1.0.0');
}
add_action( 'customize_controls_enqueue_scripts', 'engage_mag_customizer_css' );
