<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Engage Mag
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php engage_mag_do_microdata('article'); ?>>
    <?php
    global $engage_mag_theme_options;
    $engage_mag_show_image = 1;
    if(is_singular()) {
        $engage_mag_show_image = $engage_mag_theme_options['engage-mag-single-page-featured-image'];
    }
    $engage_mag_show_content = $engage_mag_theme_options['engage-mag-content-show-from'];
    $engage_mag_thumbnail = (has_post_thumbnail() && ($engage_mag_show_image == 1)) ? 'engage-mag-has-thumbnail' : 'engage-mag-no-thumbnail';
    ?>
    <div class="engage-mag-content-container <?php echo $engage_mag_thumbnail; ?>">
        <?php
        if ($engage_mag_thumbnail == 'engage-mag-has-thumbnail'):
            ?>
            <div class="post-thumb">
                <?php
                engage_mag_post_formats(get_the_ID());
                engage_mag_post_thumbnail();
                ?>
            </div>
        <?php
        endif;
        ?>
        <div class="engage-mag-content-area">
            <header class="entry-header">

                <div class="post-meta">
                    <?php
                    engage_mag_list_category(get_the_ID());
                    ?>
                </div>
                <?php

                if (is_singular()) :
                    the_title('<h1 class="entry-title" ' . engage_mag_get_microdata("heading") . '>', '</h1>');
                else :
                    the_title('<h2 class="entry-title" ' . engage_mag_get_microdata("heading") . '><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                endif;

                if ('post' === get_post_type()) :
                    ?>
                    <div class="entry-meta">
                        <?php
                        engage_mag_posted_on();
                        engage_mag_read_time_words_count(get_the_ID());
                        engage_mag_posted_by();
                        ?>
                    </div><!-- .entry-meta -->
                <?php endif; ?>
            </header><!-- .entry-header -->


            <div class="entry-content">
                <?php
                if (is_singular()) :
                    the_content();
                else :
                    if ($engage_mag_show_content == 'excerpt') {
                        the_excerpt();
                    } else {
                        the_content();
                    }
                endif;

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'engage-mag'),
                    'after' => '</div>',
                ));
                ?>

                <?php
                $engage_mag_read_more_text = $engage_mag_theme_options['engage-mag-read-more-text'];
                if ((!is_single()) && ($engage_mag_show_content == 'excerpt')) {
                    if (!empty($engage_mag_read_more_text)) { ?>
                        <p><a href="<?php the_permalink(); ?>" class="read-more-text">
                                <?php echo esc_html($engage_mag_read_more_text); ?>

                            </a></p>
                        <?php
                    }
                }
                ?>
            </div>
            <!-- .entry-content -->

            <footer class="entry-footer">
                <?php engage_mag_entry_footer(); ?>
            </footer><!-- .entry-footer -->

            <?php
            /**
             * engage_mag_social_sharing hook
             * @since 1.0.0
             *
             * @hooked engage_mag_constuct_social_sharing -  10
             */
            do_action('engage_mag_social_sharing', get_the_ID());
            ?>
        </div> <!-- .engage-mag-content-area -->
    </div> <!-- .engage-mag-content-container -->
</article><!-- #post-<?php the_ID(); ?> -->
