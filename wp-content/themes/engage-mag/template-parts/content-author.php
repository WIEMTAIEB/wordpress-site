<?php
/**
 * The template for displaying Author Bio
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Engage Mag
 */
?>
<div class="about-author-box <?php echo (1 != get_option('show_avatars')) ? 'no-author-avatar' : ''; ?>">
    <h2 class="container-title"><?php _e('Written by:', 'engage-mag'); ?></h2>
    <div class="about-author clearfix">
        <?php if (1 == get_option('show_avatars')): ?>
            <figure class="about-author-avatar">
                <?php echo get_avatar(get_the_author_meta('user_email'), '80', ''); ?>
            </figure>
        <?php endif; ?>
        <div class="about-author-bio-wrap">
            <div class="about-top">
                <h3 class="about-author-name">
                    <?php the_author_posts_link(); ?>
                    <span class="about-author-posts-num">
                        <i class="fa fa-pencil"></i>
                        <?php echo number_format_i18n(get_the_author_posts()); ?>
                        <?php _e(' Posts', 'engage-mag'); ?></span>
                </h3>
            </div>
            <div class="about-author-bio"><?php the_author_meta('description'); ?></div>
            <a class="about-author-posts-link" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                <i class="fa fa-hand-o-right"></i><?php _e('View All Posts', 'engage-mag'); ?></a>

                <?php do_action('engage_mag_author_links'); ?>
        </div>
    </div>
</div>
