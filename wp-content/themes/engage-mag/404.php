<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Engage Mag
 */

get_header();
?>

    <div class="engage-mag-content-container engage-mag-no-thumbnail">
        <div class="engage-mag-content-area">

            <section class="error-404 not-found text-center">
                <header class="page-header">
                    <h1 class="error-404-title"> <?php esc_html_e('404', 'engage-mag'); ?> </h1>
                    <h2 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'engage-mag'); ?></h2>
                </header><!-- .page-header -->

                <div class="page-content">
                    <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'engage-mag'); ?></p>

                    <?php
                    get_search_form();
                    ?>

                </div><!-- .page-content -->
            </section><!-- .error-404 -->

        </div><!-- .engage-mag-content-area -->
    </div><!-- .engage-mag-content-container  -->

<?php
get_footer();
