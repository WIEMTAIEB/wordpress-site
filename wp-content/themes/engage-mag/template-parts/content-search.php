<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Engage Mag
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php engage_mag_do_microdata('article'); ?>>
    <?php
    $engage_mag_thumbnail = (has_post_thumbnail()) ? 'engage-mag-has-thumbnail' : 'engage-mag-no-thumbnail';
    ?>
    <div class="engage-mag-content-container <?php echo $engage_mag_thumbnail; ?>">
        <?php
        if (has_post_thumbnail()):
            engage_mag_post_thumbnail();
        endif;
        ?>
        <div class="engage-mag-content-area">
            <header class="entry-header">
                <?php
                if ('post' === get_post_type()) :
                    ?>
                    <div class="entry-meta">
                        <?php
                        engage_mag_list_category(get_the_ID());
                        ?>
                    </div><!-- .entry-meta -->
                <?php endif;
                ?>
                <?php the_title(sprintf('<h2 class="entry-title" '.engage_mag_get_microdata("heading").'><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

                <?php if ('post' === get_post_type()) : ?>
                    <div class="entry-meta">
                        <?php
                        engage_mag_posted_on();
                        engage_mag_posted_by();
                        ?>
                    </div><!-- .entry-meta -->
                <?php endif; ?>
            </header><!-- .entry-header -->

            <div class="entry-summary">
                <?php
                $engage_mag_show_content = 'excerpt';
                if ( $engage_mag_show_content == 'excerpt' ) {
                    the_excerpt();
                } else {
                    the_content();
                }
                ?>
            </div><!-- .entry-summary -->

            <footer class="entry-footer">
                <?php engage_mag_entry_footer(); ?>
            </footer><!-- .entry-footer -->
        </div> <!-- .engage-mag-content-area -->
        <?php
        /**
         * engage_mag_social_sharing hook
         * @since 1.0.0
         *
         * @hooked engage_mag_constuct_social_sharing -  10
         */
        do_action( 'engage_mag_social_sharing' ,get_the_ID() );
        ?>
    </div> <!-- .engage-mag-content-container -->
</article><!-- #post-<?php the_ID(); ?> -->
