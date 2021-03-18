<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Engage_News_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once get_stylesheet_directory() . '/inc/customizer-pro/section-pro.php';

		// Register custom section types.
		$manager->register_section_type( 'Engage_News_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Engage_News_Customize_Section_Pro(
				$manager,
				'engage-news',
				array(
					'title'    => esc_html__( 'Unlock More Features', 'engage-news' ),
					'pro_text' => esc_html__( 'Upgrade To Pro',  'engage-news' ),
					'pro_url'  => 'https://www.candidthemes.com/themes/engage-news-pro/',
					'priority' => 0
				)
			)
		);
	}


	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {
		require_once get_stylesheet_directory() . '/inc/customizer-pro/section-pro.php';


		wp_enqueue_script( 'engage-news-customize-controls', trailingslashit( get_stylesheet_directory_uri() ) . '/inc/customizer-pro/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'engage-news-customize-controls', trailingslashit( get_stylesheet_directory_uri() ) . '/inc/customizer-pro/customize-controls.css' );
	}
}
// Doing this customizer thang!
Engage_News_Customize::get_instance();