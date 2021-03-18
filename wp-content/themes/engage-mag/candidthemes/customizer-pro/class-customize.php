<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Engage_Mag_Customize {

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
		require_once get_template_directory() . '/candidthemes/customizer-pro/section-pro.php';

		// Register custom section types.
		$manager->register_section_type( 'Engage_Mag_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Engage_Mag_Customize_Section_Pro(
				$manager,
				'engage-mag',
				array(
					'title'    => esc_html__( 'Unlock More Features', 'engage-mag' ),
					'pro_text' => esc_html__( 'Upgrade To Pro',  'engage-mag' ),
					'pro_url'  => 'https://www.candidthemes.com/themes/engage-mag-pro/',
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
		require_once get_template_directory() . '/candidthemes/customizer-pro/section-pro.php';


		wp_enqueue_script( 'engage-mag-customize-controls', trailingslashit( get_template_directory_uri() ) . '/candidthemes/customizer-pro/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'engage-mag-customize-controls', trailingslashit( get_template_directory_uri() ) . '/candidthemes/customizer-pro/customize-controls.css' );
	}
}
// Doing this customizer thang!
Engage_Mag_Customize::get_instance();

if ( ! class_exists( 'Engage_Mag_Customize_Static_Text_Control' ) ){
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;
class Engage_Mag_Customize_Static_Text_Control extends WP_Customize_Control {
	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'static-text';

	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}

	protected function render_content() {
			?>
		<div class="description customize-control-description">
			
			<h2><?php esc_html_e('About Engage Mag', 'engage-mag')?></h2>
			<p><?php esc_html_e('Engage Mag is clean and minimal WordPress theme for blog website.', 'engage-mag')?> </p>
			<p>
			<a href="<?php echo esc_url('https://engage.candidthemes.com/'); ?>" target="_blank"><?php esc_html_e( 'Engage Mag Demos', 'engage-mag' ); ?></a>
			</p>
			<h3><?php esc_html_e('Documentation', 'engage-mag')?></h3>
			<p><?php esc_html_e('Read documentation to learn more about theme.', 'engage-mag')?> </p>
			<p>
				<a href="<?php echo esc_url('http://docs.candidthemes.com/engage-mag/'); ?>" target="_blank"><?php esc_html_e( 'Engage Mag Documentation', 'engage-mag' ); ?></a>
			</p>
			
			<h3><?php esc_html_e('Support', 'engage-mag')?></h3>
			<p><?php esc_html_e('For support, Kindly contact us and we would be happy to assist!', 'engage-mag')?> </p>
			
			<p>
				<a href="<?php echo esc_url('https://www.candidthemes.com/themes/'); ?>" target="_blank"><?php esc_html_e( 'Engage Mag Support', 'engage-mag' ); ?></a>
			</p>
			<h3><?php esc_html_e( 'Rate This Theme', 'engage-mag' ); ?></h3>
			<p><?php esc_html_e('If you like Engage Mag Kindly Rate this Theme', 'engage-mag')?> </p>
			<p>
				<a href="<?php echo esc_url('https://wordpress.org/support/theme/engage-mag/reviews/#new-post'); ?>" target="_blank"><?php esc_html_e( 'Add Your Review', 'engage-mag' ); ?></a>
			</p>
			</div>
			
		<?php
	}

}
}
