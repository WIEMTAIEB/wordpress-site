<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Engage Mag
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php

        /**
         * engage_mag_before_main_content hook.
         *
         * @since 0.1
         */
        do_action( 'engage_mag_before_main_content' );


        /**
         * engage_mag_breadcrumb hook.
         *
         * @since 1.0
         * @hooked engage_mag_construct_breadcrumb -  10
         *
         */
        do_action( 'engage_mag_breadcrumb' );

        if ( have_posts() ) :
            ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'engage-mag' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

            /**
             * engage_mag_action_navigation hook
             * @since Engage Mag 1.0.0
             *
             * @hooked engage_mag_posts_navigation -  10
             */
            do_action( 'engage_mag_action_navigation');

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;

        /**
         * engage_mag_after_main_content hook.
         *
         * @since 0.1
         */
        do_action( 'engage_mag_after_main_content' );
		?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
/**
 * engage_mag_sidebar hook
 * @since Engage Mag 1.0.0
 *
 * @hooked engage_mag_sidebar -  10
 */
do_action( 'engage_mag_sidebar');

get_footer();
