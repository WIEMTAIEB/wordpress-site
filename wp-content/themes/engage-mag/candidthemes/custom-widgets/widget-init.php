<?php

if ( ! function_exists( 'engage_mag_load_widgets' ) ) :

    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function engage_mag_load_widgets() {

        // Highlight Post.
        register_widget( 'Engage_Mag_Featured_Post' );

        // Author Widget.
        register_widget( 'Engage_Mag_Author_Widget' );
		
		// Social Widget.
        register_widget( 'Engage_Mag_Social_Widget' );

        // Grid Layout Widget.
        register_widget( 'Engage_Mag_Grid_Post' );

        // Advertisement Widget.
        register_widget( 'Engage_Mag_Advertisement_Widget' );

        //Recent post widget
        register_widget('Engage_Mag_Recent_Post');

        //Post Slider
        register_widget('Engage_Mag_Post_Slider');

        //Thumbnail Posts
        register_widget('Engage_Mag_Thumb_Posts');

        //Category column
        register_widget('Engage_Mag_Category_Column');
    }

endif;
add_action( 'widgets_init', 'engage_mag_load_widgets' );