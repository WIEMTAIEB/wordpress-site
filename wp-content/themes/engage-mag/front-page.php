<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Engage Mag
 */

get_header();
?>

        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <?php
                /**
                 * engage_mag_action_front_page hook
                 * @package Engage Mag
                 *
                 * @hooked engage_mag_featured_section -  10
                 */
                do_action('engage_mag_action_front_page');
                ?>
            </main><!-- #main -->
        </div><!-- #primary -->

        <?php
        /**
         * engage_mag_sidebar hook
         * @since Engage Mag 1.0.0
         *
         * @hooked engage_mag_sidebar -  10
         */
        do_action('engage_mag_sidebar');
        ?>
<?php

get_footer();