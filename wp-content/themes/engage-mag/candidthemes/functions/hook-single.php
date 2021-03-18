<?php
/**
 * Single Post Hook Element.
 *
 * @package Engage Mag
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
/**
 * Display related posts from same category
 *
 * @param int $post_id
 * @return void
 *
 * @since 1.0.0
 *
 */
if (!function_exists('engage_mag_related_post')) :

    function engage_mag_related_post($post_id)
    {

        global $engage_mag_theme_options;
        if ($engage_mag_theme_options['engage-mag-single-page-related-posts'] == 0) {
            return;
        }
        $count = 0;
            $categories = get_the_category($post_id);
            if ($categories) {
                $category_ids = array();
                $category = get_category($category_ids);
                $categories = get_the_category($post_id);
                foreach ($categories as $category) {
                    $category_ids[] = $category->term_id;
                }
                $count = count($category_ids);

                $engage_mag_cat_post_args = array(
                    'category__in' => $category_ids,
                    'post__not_in' => array($post_id),
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => true
                );

            }
        if ($count >= 1) { ?>
            <div class="related-pots-block">
                <?php
                $engage_mag_related_post_title = esc_html($engage_mag_theme_options['engage-mag-single-page-related-posts-title']);
                if (!empty($engage_mag_related_post_title)):
                    ?>
                    <h2 class="widget-title">
                        <?php echo $engage_mag_related_post_title; ?>
                    </h2>
                <?php
                endif;
                ?>
                <ul class="related-post-entries clearfix">
                    <?php

                    $engage_mag_featured_query = new WP_Query($engage_mag_cat_post_args);

                    while ($engage_mag_featured_query->have_posts()) : $engage_mag_featured_query->the_post();
                        ?>
                        <li>
                            <?php
                            if (has_post_thumbnail()):
                                ?>
                                <figure class="widget-image">
                                    <a href="<?php the_permalink() ?>">
                                        <?php the_post_thumbnail('engage-mag-small-thumb'); ?>
                                    </a>
                                </figure>
                            <?php
                            endif;
                            ?>
                            <div class="featured-desc">
                                <h2 class="related-title">
                                    <a href="<?php the_permalink() ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                                    <div class="entry-meta">
                                        <?php
                                        engage_mag_posted_on();
                                        ?>
                                    </div><!-- .entry-meta -->
                            </div>
                        </li>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </ul>
            </div> <!-- .related-post-block -->
            <?php
        }
    }
endif;
add_action('engage_mag_related_posts', 'engage_mag_related_post', 10, 1);