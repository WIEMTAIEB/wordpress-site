<?php
/**
 * Main Navigation Hook Element.
 *
 * @package Engage Mag
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('engage_mag_constuct_carousel')) {
    /**
     * Add carousel on header
     *
     * @since 1.0.0
     */
    function engage_mag_constuct_carousel()
    {

        if (is_front_page()) {
            global $engage_mag_theme_options;
            $engage_mag_site_layout = $engage_mag_theme_options['engage-mag-site-layout-options'];
            $slider_cat = $engage_mag_theme_options['engage-mag-select-category'];
            $featured_cat = $engage_mag_theme_options['engage-mag-select-category-featured-right'];


            ?>
            <div class="engage-mag-featured-block engage-mag-ct-row refined-awesome-carousel clearfix">
                <?php

                engage_mag_main_carousel($slider_cat);


                $query_args = array(
                    'post_type' => 'post',
                    'ignore_sticky_posts' => true,
                    'posts_per_page' => 4,
                    'cat' => $featured_cat
                );

                $query = new WP_Query($query_args);
                if ($query->have_posts()) :
                    ?>
                    <div class="engage-mag-col engage-mag-col-2">
                        <div class="engage-mag-inner-row clearfix">
                            <?php
                            $i = 1;
                            while ($query->have_posts()) :
                                $query->the_post();
                                ?>
                                <div class="engage-mag-col">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        if ($engage_mag_site_layout == 'boxed') {
                                            $featured_image = get_the_post_thumbnail_url('', 'engage-mag-carousel-img');
                                        } else {
                                            $featured_image = get_the_post_thumbnail_url('', 'engage-mag-carousel-large-img');
                                        }

                                    } else {
                                        if ($engage_mag_site_layout == 'boxed') {
                                            $featured_image = get_template_directory_uri().'/candidthemes/assets/images/refined-mag-carousel.jpg';
                                        } else {
                                            $featured_image = get_template_directory_uri().'/candidthemes/assets/images/refined-mag-carousel-large.jpg';
                                        }
                                    }
                                    ?>
                                    <div class="featured-section-inner ct-post-overlay"
                                         style="background-image: url(<?php echo esc_url($featured_image); ?>)">
                                        <?php
                                        engage_mag_post_formats(get_the_ID());
                                        ?>

                                        <div class="featured-section-details post-content">
                                            <div class="post-meta">
                                                <?php
                                                engage_mag_featured_list_category(get_the_ID());
                                                ?>
                                            </div>
                                            <h3 class="post-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                            <div class="post-meta">
                                                <?php

                                                engage_mag_widget_posted_on();
                                                engage_mag_read_time_slider(get_the_ID());
                                                engage_mag_widget_posted_by();
                                                ?>
                                            </div>
                                        </div>
                                    </div> <!-- .featured-section-inner -->
                                </div><!--.engage-mag-col-->
                                <?php
                                $i++;

                            endwhile;
                            wp_reset_postdata()
                            ?>

                        </div>
                    </div><!--.engage-mag-col-->
                <?php
                endif;
                ?>

            </div><!-- .engage-mag-ct-row-->
            <?php


        }//is_front_page
    }
}
add_action('engage_mag_carousel', 'engage_mag_constuct_carousel', 10);