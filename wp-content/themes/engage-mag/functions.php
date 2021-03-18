<?php

/**
 * Engage Mag functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Engage Mag
 */
// This theme requires WordPress 5.3 or later.
if ( version_compare( $GLOBALS['wp_version'], '5.3', '<' ) ) {
    require get_template_directory() . '/inc/back-compat.php';
}

if ( !function_exists( 'engage_mag_setup' ) ) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function engage_mag_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Engage Mag, use a find and replace
         * to change 'engage-mag' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'engage-mag' );
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );
        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );
        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );
        add_image_size(
            'engage-mag-carousel-img',
            783,
            450,
            true
        );
        add_image_size(
            'engage-mag-carousel-img-landscape',
            783,
            225,
            true
        );
        add_image_size(
            'engage-mag-carousel-large-img',
            1000,
            574,
            true
        );
        add_image_size(
            'engage-mag-carousel-large-img-landscape',
            1000,
            287,
            true
        );
        add_image_size( 'engage-mag-large-thumb', 1170, 9999 );
        add_image_size(
            'engage-mag-small-thumb',
            350,
            220,
            true
        );
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'menu-1'      => esc_html__( 'Primary', 'engage-mag' ),
            'top-menu'    => esc_html__( 'Top Menu', 'engage-mag' ),
            'social-menu' => esc_html__( 'Social Menu', 'engage-mag' ),
        ) );
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        ) );
        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'engage_mag_custom_background_args', array(
            'default-color' => 'fefefe',
            'default-image' => '',
        ) ) );
        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 400,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );
        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', array(
            'image',
            'video',
            'gallery',
            'audio'
        ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );
        /*
         * Add theme support for gutenberg block
         */
        add_theme_support( 'align-wide' );
        
        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );
        
        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );
        
        // Add support for default block styles.
        add_theme_support( 'wp-block-styles' );
        
        // Add support for Yoast SEO Breadcrumbs.
        add_theme_support( 'yoast-seo-breadcrumbs' );

        // Add support for custom line height controls.
        add_theme_support( 'custom-line-height' );

        // Add support for experimental link color control.
        add_theme_support( 'experimental-link-color' );

        // Add support for experimental cover block spacing.
        add_theme_support( 'custom-spacing' );

        // Add support for custom units.
        // This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
        add_theme_support( 'custom-units' );
    }

}
add_action( 'after_setup_theme', 'engage_mag_setup' );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function engage_mag_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'engage_mag_content_width', 640 );
}

add_action( 'after_setup_theme', 'engage_mag_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function engage_mag_widgets_init()
{
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'engage-mag' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'engage-mag' ),
        'before_widget' => '<div class="sidebar-widget-container"><section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section></div> ',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Home Page Widget Area', 'engage-mag' ),
        'id'            => 'engage-mag-home-widget-area',
        'description'   => esc_html__( 'Add widgets here for home page.', 'engage-mag' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget 1', 'engage-mag' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Add widgets here.', 'engage-mag' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget 2', 'engage-mag' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Add widgets here.', 'engage-mag' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Widget 3', 'engage-mag' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Add widgets here.', 'engage-mag' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Above Footer(Full Width)', 'engage-mag' ),
        'id'            => 'above-footer',
        'description'   => esc_html__( 'Add widgets here.', 'engage-mag' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}

add_action( 'widgets_init', 'engage_mag_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function engage_mag_scripts()
{
    /*google font  */
    global  $engage_mag_theme_options ;

    wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Prata|Muli&display=swap' );
    /*Font-Awesome-master*/
    wp_enqueue_style(
        'font-awesome',
        get_template_directory_uri() . '/candidthemes/assets/framework/Font-Awesome/css/font-awesome.min.css',
        array(),
        '4.7.0'
    );
    wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/candidthemes/assets/framework/slick/slick.css' );
    wp_enqueue_style( 'slick-theme-css', get_template_directory_uri() . '/candidthemes/assets/framework/slick/slick-theme.css' );
    wp_enqueue_script(
        'slick',
        get_template_directory_uri() . '/candidthemes/assets/framework/slick/slick.min.js',
        array( 'jquery' ),
        '20151217',
        true
    );
    wp_enqueue_style(
        'magnific-popup',
        get_template_directory_uri() . '/candidthemes/assets/framework/magnific/magnific-popup.css',
        array(),
        '20151217'
    );
    wp_enqueue_style( 'engage-mag-style', get_stylesheet_uri() );
    wp_style_add_data( 'engage-mag-style', 'rtl', 'replace' );
    wp_enqueue_script( 'jquery-ui-tabs' );
    wp_enqueue_script(
        'engage-mag-navigation',
        get_template_directory_uri() . '/js/navigation.js',
        array(),
        '20151215',
        true
    );
    wp_enqueue_script(
        'marquee',
        get_template_directory_uri() . '/candidthemes/assets/framework/marquee/jquery.marquee.js',
        array(),
        '20151215',
        true
    );
    wp_enqueue_script(
        'engage-mag-skip-link-focus-fix',
        get_template_directory_uri() . '/js/skip-link-focus-fix.js',
        array(),
        '20151215',
        true
    );
    wp_enqueue_script(
        'magnific-popup',
        get_template_directory_uri() . '/candidthemes/assets/framework/magnific/jquery.magnific-popup.js',
        array( 'jquery' ),
        '20151215'
    );
    /*Sticky Sidebar*/
    if ( absint( $engage_mag_theme_options['engage-mag-enable-sticky-sidebar'] ) == 1 ) {
        wp_enqueue_script(
            'theia-sticky-sidebar',
            get_template_directory_uri() . '/candidthemes/assets/js/theia-sticky-sidebar.js',
            array(),
            '20151215',
            true
        );
    }
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    wp_enqueue_script(
        'engage-mag-custom',
        get_template_directory_uri() . '/candidthemes/assets/js/engage-mag-custom.js',
        array( 'jquery' ),
        '20151215',
        true
    );
}

add_action( 'wp_enqueue_scripts', 'engage_mag_scripts' );
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require get_template_directory() . '/inc/jetpack.php';
}
/**
 * Load Core File
 */
require get_template_directory() . '/candidthemes/core.php';