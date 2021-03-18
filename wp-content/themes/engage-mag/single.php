<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Engage Mag
 */

get_header();
global $engage_mag_theme_options;
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php
            /**
             * engage_mag_before_main_content hook.
             *
             * @since 0.1
             */
            do_action('engage_mag_before_main_content');

            /**
             * engage_mag_breadcrumb hook.
             *
             * @since 1.0
             * @hooked engage_mag_construct_breadcrumb -  10
             *
             */
            do_action('engage_mag_breadcrumb');
            ?>

            <?php

            while (have_posts()) :
                the_post();

                get_template_part('template-parts/content', get_post_type());

                the_post_navigation();

                /**
                 * engage_mag_after_single_post_navigation hook
                 * @since Engage Mag 1.0.0
                 *
                 */
                do_action('engage_mag_after_single_post_navigation');


                /**
                 * engage_mag_related_posts hook
                 * @since Engage Mag 1.0.0
                 *
                 * @hooked engage_mag_related_posts -  10
                 */
                do_action('engage_mag_related_posts', get_the_ID());

                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

            endwhile; // End of the loop.

            /**
             * engage_mag_after_main_content hook.
             *
             * @since 0.1
             */
            do_action('engage_mag_after_main_content');
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

get_footer();
