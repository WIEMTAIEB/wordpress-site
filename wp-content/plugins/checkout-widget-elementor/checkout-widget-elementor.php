<?php
/**
 * Plugin Name: Checkout Widgets for Elementor
 * Description: Design your checkout page with  Woocommerce Checkout Widgets for Elementor.
 * Plugin URI:  https://blueplugins.com/
 * Version:     1.4.0
 * Author:      Blue Plugins
 * Author URI:  http://blueplugins.com/
 * Text Domain: ecw-checkout-widget
 * WC requires at least: 3.4
 * WC tested up to: 4.8.0
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
define( 'ECW_PATH', __DIR__ );
define( 'ECW_VERSION', '1.4.0' );
define('ECW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define('ECW_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Main Checkout Widget Elementor Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Checkout_Widget_Elementor {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.4.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {

	    load_plugin_textdomain('ecw-checkout-widget', FALSE, basename(dirname(__FILE__)) . '/languages/');

	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {
		
		
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
			
		}
		
		if ( ! class_exists( 'WooCommerce' )) {
				add_action( 'admin_notices',[$this,'admin_notice_missing_woocommerce_plugin']);
			}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}
		// Create new template for checkout page
		$this->templates = array();	
		
	    $this->templates = array(
			'elementer-checkout' => 'Elementer Checkout',
		);
		if ( file_exists( ECW_PLUGIN_DIR . '/cmb2/init.php' ) ) {
            require_once ECW_PLUGIN_DIR . '/cmb2/init.php';
			//require_once ECW_PLUGIN_DIR . '/cmb2-fontawesome-picker.php';
			
            }
		add_action( 'cmb2_admin_init',[ $this,'ecw_checkout_settings_page']) ;	
		add_filter('theme_page_templates', [ $this, 'ecw_checkout_template' ]);
		add_filter('template_include',[ $this, 'ecw_include_checkout_template']);
		add_filter( 'woocommerce_locate_template',[$this,'ecw_access_woocommerce_templates'], 20, 3 );
		add_action( 'template_redirect',[$this,'ecw_redirect_to_checkout_if_cart']);
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'ecw_action_links' ) );
      		// Add Plugin actions
		
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'ecw_init_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'ecw_widget_categories' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'ecw_widget_styles' ] );
		register_deactivation_hook( __FILE__, [ $this,'elementor_woocommerce_checkout_widget_deactivate'] );
		   
		
		
	}
	
	
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		
		deactivate_plugins( plugin_basename( __FILE__ ) );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'ecw-checkout-widget' ),
			'<strong>' . esc_html__( 'Checkout Widget Elementor', 'ecw-checkout-widget' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'ecw-checkout-widget' ) . '</strong>'
		);

		printf( '<div class="error"><p>%1$s</p></div>', $message );

	}
	
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Woocommerce installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_woocommerce_plugin() {
    
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		deactivate_plugins( plugin_basename( __FILE__ ) );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'ecw-checkout-widget' ),
			'<strong>' . esc_html__( 'Checkout Widget Elementor', 'ecw-checkout-widget' ) . '</strong>',
			'<strong>' . esc_html__( 'Woocommerce', 'ecw-checkout-widget' ) . '</strong>'
		);

		printf( '<div class="error"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'ecw-checkout-widget' ),
			'<strong>' . esc_html__( 'Checkout Widget Elementor', 'ecw-checkout-widget' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'ecw-checkout-widget' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'ecw-checkout-widget' ),
			'<strong>' . esc_html__( 'Checkout Widget Elementor', 'ecw-checkout-widget' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'ecw-checkout-widget' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}
	/*Cmb2 setting page*/
	
	public function ecw_checkout_settings_page() {
		
		 require_once ECW_PLUGIN_DIR . 'includes/general-settings.php';
	
	} 
	/**
	 * Create Checkout Page Template
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	
	public function ecw_checkout_template( $posts_templates ) {
		$posts_templates = array_merge( $posts_templates, $this->templates );
		return $posts_templates;
	}
	
	
	/**
	 * Include Checkout Template
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function ecw_include_checkout_template( $template ) {
		$template_file = get_post_meta( get_the_ID(), '_wp_page_template', TRUE );
		
		
			if($template_file != 'elementer-checkout')
			{
				return $template;
			}
			else
			{
			$template_path = dirname(__FILE__).'/page-template/'.$template_file.'.php';
			 $template = $template_path;
			
			}	
		
       
		return $template;

	}
	
	/**
	 * Access Woocommerce Template Files
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function ecw_access_woocommerce_templates( $template, $template_name, $template_path ) {
			 global $woocommerce;
			 $_template = $template;
			 if ( ! $template_path ) 
			  $template_path = $woocommerce->template_url;
			 $plugin_path  = untrailingslashit( plugin_dir_path( __FILE__ ) )  . '/WooCommerce/';
			  $template = $plugin_path . $template_name;
        			
			   $template = $plugin_path . $template_name;
			
				if ( file_exists( $template ) ) {
				$template = $plugin_path . $template_name;
				}
				else
				{
				$template = $_template;
				}
			
			return $template;
	}
	
	/**
	*Skip cart page function
	*
	*@since 1.0.0
	*
	*@access public
	*
	*/
	
	function ecw_redirect_to_checkout_if_cart() {
			global $woocommerce;
			$settings = get_option('ecw_checkout_settings');
						
			if ( is_cart() && WC()->cart->get_cart_contents_count() > 0 && isset($settings['ecw_skip_cart']) && $settings['ecw_skip_cart'] =='on')
			{
			// Redirect to check out url
			wp_redirect( $woocommerce->cart->get_checkout_url(), '301' );
			exit;
			}
			
		}
		
	/**
    *
	* redirect to setting page after activation
	*
	* @since 1.0.0
	*
	*  @access public
    **/	
	public function ecw_action_links( $links ) {
		$custom_links = array();
		$custom_links[] = '<a href="' . admin_url( 'admin.php?page=ecw_checkout_settings' ) . '">' . __( 'Settings', 'ecw-checkout-widget' ) . '</a>';
		$custom_links[] = '<a style="font-weight: 700; color:#93003c;" href="https://blueplugins.com/product/checkout-widgets-elementor-pro/">' . __( 'Go Pro', 'woocommerce' ) . '</a>';
		return array_merge( $custom_links, $links );
	 }

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function ecw_init_widgets() {

		// Include Widget files
		
		require_once( __DIR__ . '/widgets/checkout-billing-widget.php' );
		require_once( __DIR__ . '/widgets/checkout-order-notes-widget.php' );
		require_once( __DIR__ . '/widgets/checkout-order-table-widget.php' );
		require_once( __DIR__ . '/widgets/checkout-payment-widget.php' );
		
			
		
			
		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Checkout_Billing_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Checkout_Order_Notes_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Checkout_Order_Table_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Checkout_Payment_Widget() );
		
		
		

	}
	
	 /**
	 * Init Styles
	 *
	 * Include style 
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	 
	 public function ecw_widget_styles() {

	 wp_register_style( 'ecw_style', plugins_url( 'asserts/css/ecw_style.css', __FILE__ ) );
	 wp_enqueue_style( 'ecw_style' );

	 }
	

	/**
	 * Init Categories
	 *
	 * Include Categories 
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function ecw_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'woocommerce-checkout',
			[
				'title' => __( 'WooCommerce Checkout', 'ecw-checkout-widget' ),
				'icon' => 'fa fa-plug',
			]
		);
		
	 }
	 
	 
	 /**
	
	 * Include deactivation option 
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	 
	 public function elementor_woocommerce_checkout_widget_deactivate() {
		/* update_option('ecw_check_temp','no');
		if (class_exists( 'WooCommerce' )) {
		$checkout_page_ID = wc_get_page_id( 'checkout' );
		update_post_meta($checkout_page_ID, '_wp_page_template', '' );
		delete_post_meta($checkout_page_ID, '_elementor_edit_mode', 'builder');
	
		} */
    }
	
	 


}

Checkout_Widget_Elementor::instance();