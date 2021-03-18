<?php
/**
 * Recommended plugins
 *
 * @package Prefer 1.0.0
 */

if ( ! function_exists( 'engage_mag_recommended_plugins' ) ) :

    /**
     * Recommend plugin list.
     *
     * @since 1.0.0
     */
    function engage_mag_recommended_plugins() {

        $plugins = array(
            array(
                'name'     => esc_html__( 'One Click Demo Import', 'engage-mag' ),
                'slug'     => 'one-click-demo-import',
                'required' => false,
            ),
            array(
                'name'     => __( 'Candid Advanced Toolset', 'engage-mag' ),
                'slug'     => 'candid-advanced-toolset',
                'required' => false,
            ),
        );

        tgmpa( $plugins );

    }

endif;

add_action( 'tgmpa_register', 'engage_mag_recommended_plugins' );
