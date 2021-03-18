<?php
/**
 * The template for displaying archive pages
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
             * engage_mag_before_main_content hook.
             *
             * @since 1.0
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

            if (have_posts()) : ?>

            <header class="page-header">
                <?php
                the_archive_title('<h1 class="page-title">', '</h1>');
                the_archive_description('<div class="archive-description">', '</div>');
                ?>
            </header><!-- .page-header -->


            <div class="ct-post-list">
                <?php

                echo "<div class='engage-mag-article-wrapper clearfix'>";
                /* Start the Loop */
                while (have_posts()) :
                    the_post();

                    /*
                     * Include the Post-Type-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                     */
                    get_template_part('template-parts/content', get_post_type());

                endwhile;
                echo '</div>';

                /**
                 * engage_mag_action_navigation hook
                 * @since Engage Mag 1.0.0
                 *
                 * @hooked engage_mag_posts_navigation -  10
                 */
                do_action('engage_mag_action_navigation');

                else :

                    get_template_part('template-parts/content', 'none');

                endif;
                ?>
            </div>
            <?php

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
