<?php
/**
 * Header Hook Element.
 *
 * @package Engage Mag
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('engage_mag_footer_start')) {
    /**
     * Add footer start tag.
     *
     * @param none
     * @return void
     *
     * @since 1.0.0
     *
     */
    function engage_mag_footer_start()
    {
        ?>
        <footer id="colophon" class="site-footer">
        <?php
    }
}
add_action('engage_mag_footer', 'engage_mag_footer_start', 5);

if (!function_exists('engage_mag_footer_widget')) {
    /**
     * Add footer top widget blocks
     *
     * @param none
     * @return void
     *
     * @since 1.0.0
     *
     */
    function engage_mag_footer_widget()
    {
        //Check if there are widgets on any footer sidebar
        if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')) {
            ?>

            <div class="top-footer">
                <div class="container-inner clearfix">
                    <?php
                    $count = 0;
                    for ($i = 1; $i <= 3; $i++) {
                        if (is_active_sidebar('footer-' . $i)) {
                            $count++;
                        }
                    }
                    $column = $count;
                    $column_class = 'widget-column footer-active-' . absint($count);
                    for ($i = 1; $i <= 4; $i++) {
                        if (is_active_sidebar('footer-' . $i)) {
                            ?>
                            <div class="ct-col-<?php echo esc_attr($column); ?>">
                                <?php dynamic_sidebar('footer-' . $i); ?>
                            </div>
                            <?php
                        }
                    }

                    ?>
                </div> <!-- .container-inner -->
            </div> <!-- .top-footer -->
            <?php
        }
    }
}
add_action('engage_mag_footer', 'engage_mag_footer_widget', 15);


if (!function_exists('engage_mag_footer_siteinfo')) {
    /**
     * Add footer site info block
     *
     * @param none
     * @return void
     * @since 1.0.0
     *
     */
    function engage_mag_footer_siteinfo()
    {
        ?>

        <div class="site-info" <?php engage_mag_do_microdata('footer'); ?>>
            <div class="container-inner">
                <?php
                global $engage_mag_theme_options;
                $engage_mag_copyright = wp_kses_post($engage_mag_theme_options['engage-mag-footer-copyright']);
                if (!empty($engage_mag_copyright)):
                    ?>
                    <span class="copy-right-text"><?php echo $engage_mag_copyright; ?></span><br>
                <?php
                endif; //$engage_mag_copyright
                ?>
                <a href="<?php echo esc_url(__('https://wordpress.org/', 'engage-mag')); ?>" target="_blank">
                    <?php
                    /* translators: %s: CMS name, i.e. WordPress. */
                    printf(esc_html__('Proudly powered by %s', 'engage-mag'), 'WordPress');
                    ?>
                </a>
                <span class="sep"> | </span>
                <?php
                /* translators: 1: Theme name, 2: Theme author. */
                printf(esc_html__('Theme: %1$s by %2$s.', 'engage-mag'), 'Engage Mag', '<a href="https://www.candidthemes.com/" target="_blank">Candid Themes</a>');
                ?>
            </div> <!-- .container-inner -->
        </div><!-- .site-info -->
        <?php
    }
}
add_action('engage_mag_footer', 'engage_mag_footer_siteinfo', 20);


if (!function_exists('engage_mag_footer_end')) {
    /**
     * Add footer end tag.
     *
     * @param none
     * @return void
     *
     * @since 1.0.0
     *
     */
    function engage_mag_footer_end()
    {
        ?>
        </footer><!-- #colophon -->
        <?php
    }
}
add_action('engage_mag_footer', 'engage_mag_footer_end', 25);

if (!function_exists('engage_mag_construct_gototop')) {
    /**
     * Add Go to Top Button on Site.
     *
     * @param none
     * @return void
     *
     * @since 1.0.0
     *
     */
    function engage_mag_construct_gototop()
    {
        global $engage_mag_theme_options;
        if ($engage_mag_theme_options['engage-mag-go-to-top'] == 1):
            ?>
            <a id="toTop" class="go-to-top" href="#" title="<?php esc_attr_e('Go to Top', 'engage-mag'); ?>">
                <i class="fa fa-angle-double-up"></i>
            </a>
        <?php
        endif;

    }
}
add_action('engage_mag_gototop', 'engage_mag_construct_gototop', 10);


//hooks you may missed section
if (!function_exists('engage_mag_you_may_missed')) {
    /**
     * Add you may missed section
     *
     * @param none
     * @return void
     *
     * @since 1.0.0
     *
     */
    function engage_mag_you_may_missed()
    {
        global $engage_mag_theme_options;
        $sec_enable = absint($engage_mag_theme_options['engage-mag-footer-you-may-missed']);
        $post_cat = absint($engage_mag_theme_options['engage-mag-you-missed-select-category']);
        $sec_title = esc_html($engage_mag_theme_options['engage-mag-footer-you-may-missed-title']);

        if ($sec_enable == 0) {
            return;
        }
        ?>
        <div class="ct-missed-block widget">
            <div class="container-inner">
            <?php
            if($sec_title){
                ?>
                <h2 class="widget-title"> <?php echo $sec_title; ?> </h2>
                <?php
            }
            ?>
            <?php
            $query_args = array(
                'post_type' => 'post',
                'ignore_sticky_posts' => true,
                'posts_per_page' => 4,
                'cat' => $post_cat
            );

            $query = new WP_Query($query_args);
            if ($query->have_posts()) :
                ?>
                <div class="ct-grid-post clearfix">
                    <?php
                    while ($query->have_posts()) :
                        $query->the_post();
                        ?>
                        <div class="ct-col ct-four-cols">
                            <section class="ct-grid-post-list">
                                <?php
                                if (has_post_thumbnail()) {
                                    ?>
                                    <div class="post-thumb">
                                        <?php
                                        engage_mag_post_formats(get_the_ID());
                                        ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('engage-mag-carousel-img'); ?>
                                        </a>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="post-content mt-10">
                                        <div class="post-meta">
                                            <?php
                                            engage_mag_list_category(get_the_ID());
                                            ?>
                                        </div>
                                    <h3 class="post-title">
                                        <a href="<?php the_permalink(); ?>"
                                        ><?php the_title(); ?></a>
                                    </h3>
                                        <div class="post-meta">
                                            <?php
                                                engage_mag_posted_on_color();
                                                engage_mag_read_time_words_count(get_the_ID());
                                            ?>
                                        </div>
                                </div><!-- Post content end -->
                            </section>
                        </div><!--.engage-mag-col-->
                    <?php
                    endwhile;
                    wp_reset_postdata()
                    ?>

                </div>

            <?php
            endif;
            ?>
            </div>
        </div>
        <?php
    }
}
add_action('engage_mag_you_may_missed_hook', 'engage_mag_you_may_missed', 10);