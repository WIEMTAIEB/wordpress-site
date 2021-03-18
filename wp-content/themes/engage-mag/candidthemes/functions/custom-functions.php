<?php
/**
 * Front page hook for all WordPress Conditions
 *
 * @param null
 * @return null
 *
 * @since Engage Mag 1.1.0
 *
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('engage_mag_front_page')) :

    function engage_mag_front_page()
    {

        if (is_active_sidebar('engage-mag-home-widget-area')) {
            dynamic_sidebar('engage-mag-home-widget-area');
        }
        global $engage_mag_theme_options;
        $engage_mag_front_page_content = $engage_mag_theme_options['engage-mag-front-page-content'];

        if (false == $engage_mag_front_page_content) {
            if ('posts' == get_option('show_on_front')) {
                if (have_posts()) :
                    /* Start the Loop */

                    echo "<div class='engage-mag-article-wrapper refined-front-loop-block clearfix'>";
                    while (have_posts()) : the_post();

                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part('template-parts/content', get_post_format());
                    endwhile;
                    echo '</div>';
                    /**
                     * engage_mag_post_navigation hook
                     * @since Engage Mag 1.0.0
                     *
                     * @hooked engage_mag_posts_navigation -  10
                     */
                    do_action('engage_mag_action_navigation');

                else :
                    get_template_part('template-parts/content', 'none');
                endif;
            } else {
                while (have_posts()) : the_post();
                    get_template_part('template-parts/content', 'page');

                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) {
                        comments_template();
                    }
                endwhile; // End of the loop.
            }
        }
    }

endif;
add_action('engage_mag_action_front_page', 'engage_mag_front_page', 10);

/**
 * Function to list categories of a post
 *
 * @param int $post_id
 * @return void Lists of categories with its link
 *
 * @since 1.0.0
 *
 */
if (!function_exists('engage_mag_list_category')) :
    function engage_mag_list_category($post_id = 0)
    {

        if (0 == $post_id) {
            global $post;
            if (isset($post->ID)) {
                $post_id = $post->ID;
            }
        }
        if (0 == $post_id) {
            return null;
        }
        $categories = get_the_category($post_id);
        $separator = '&nbsp;';
        $output = '';
        if ($categories) {
            $output .= '<span class="cat-name"><i class="fa fa-folder-open"></i>';
            foreach ($categories as $category) {
                $output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '"  rel="category tag">' . esc_html($category->cat_name) . '</a>' . $separator;
            }
            $output .= '</span>';
            echo trim($output, $separator);
        }

    }
endif;


/**
 * Function to modify tag clouds font size
 *
 * @param none
 * @return array $args
 *
 * @since 1.0.0
 *
 */
if (!function_exists('engage_mag_tag_cloud_widget')) :
    function engage_mag_tag_cloud_widget($args)
    {
        $args['largest'] = 12; //largest tag
        $args['smallest'] = 12; //smallest tag
        $args['unit'] = 'px'; //tag font unit
        return $args;
    }
endif;
add_filter('widget_tag_cloud_args', 'engage_mag_tag_cloud_widget');


/**
 * Callback functions for comments
 *
 * @param $comment
 * @param $args
 * @param $depth
 * @return void
 *
 * @since 1.0.0
 *
 */
if (!function_exists('engage_mag_commment_list')) :

    function engage_mag_commment_list($comment, $args, $depth)
    {
        $args['avatar_size'] = apply_filters('engage_mag_comment_avatar_size', 50);

        if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) : ?>

            <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
            <div class="comment-body">
                <?php _e('Pingback:', 'engage-mag'); // WPCS: XSS OK. ?><?php comment_author_link(); ?><?php edit_comment_link(__('Edit', 'engage-mag'), '<span class="edit-link">', '</span>'); ?>
            </div>

        <?php else : ?>

            <li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>
            <article id="div-comment-<?php comment_ID(); ?>"
                     class="comment-body" <?php engage_mag_do_microdata('comment-body'); ?>>
                <footer class="comment-meta">
                    <?php
                    if (0 != $args['avatar_size']) {
                        echo get_avatar($comment, $args['avatar_size']);
                    }
                    ?>
                    <div class="comment-author-info">
                        <div class="comment-author vcard" <?php engage_mag_do_microdata('comment-author'); ?>>
                            <?php printf('<span itemprop="name" class="fn"><strong>%s</strong></span>', get_comment_author_link()); ?>
                        </div><!-- .comment-author -->

                        <div class="entry-meta comment-metadata">
                                    <span><i class="fa fa-calendar"></i><a
                                                href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                                        <time datetime="<?php comment_time('c'); ?>" itemprop="datePublished">
                                    <?php printf( // WPCS: XSS OK.
                                    /* translators: 1: date, 2: time */
                                        _x('%1$s at %2$s', '1: date, 2: time', 'engage-mag'),
                                        get_comment_date(),
                                        get_comment_time()
                                    ); ?>s
                                    </time>
                                </a></span>
                            <?php edit_comment_link(__('Edit', 'engage-mag'), '<span class="edit-link"><i class="fa fa-pencil"></i> ', '</span>'); ?>
                            <?php
                            comment_reply_link(array_merge($args, array(
                                'add_below' => 'div-comment',
                                'depth' => $depth,
                                'max_depth' => $args['max_depth'],
                                'before' => '<span class="reply"><i class="fa fa-comment-o"></i> ',
                                'after' => '</span>',
                            )));
                            ?>
                        </div><!-- .comment-metadata -->
                    </div><!-- .comment-author-info -->

                    <?php if ('0' == $comment->comment_approved) : ?>
                        <p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'engage-mag'); // WPCS: XSS OK. ?></p>
                    <?php endif; ?>
                </footer><!-- .comment-meta -->

                <div class="comment-content" itemprop="text">
                    <?php comment_text(); ?>
                </div><!-- .comment-content -->
            </article><!-- .comment-body -->
        <?php
        endif;
    }
endif;

/**
 * Add sidebar class in body
 *
 * @since 1.0.0
 *
 */
if (!function_exists('engage_mag_custom_body_class')) :
    function engage_mag_custom_body_class($classes)
    {
        global $engage_mag_theme_options;
        $engage_mag_sidebar = $engage_mag_theme_options['engage-mag-sidebar-archive-page'];
        if (is_singular()) {
            $engage_mag_sidebar = $engage_mag_theme_options['engage-mag-sidebar-blog-page'];
            global $post;
            $single_sidebar = get_post_meta($post->ID, 'engage_mag_sidebar_layout', true);
            if (('default-sidebar' != $single_sidebar) && (!empty($single_sidebar))) {
                $engage_mag_sidebar = $single_sidebar;
            }
        }
        if (is_front_page()) {
            $engage_mag_sidebar = $engage_mag_theme_options['engage-mag-sidebar-front-page'];
        }
        $engage_mag_sticky_sidebar = $engage_mag_theme_options['engage-mag-enable-sticky-sidebar'];
        $engage_mag_site_layout = $engage_mag_theme_options['engage-mag-site-layout-options'];
        $body_background = esc_attr(get_background_color());
        if ($body_background != 'fff' && $body_background != 'ffffff') {
            $classes[] = 'ct-bg';
        }
        if ($engage_mag_site_layout == 'boxed') {
            $classes[] = 'ct-boxed';
        } else {
            $classes[] = 'ct-full-layout';
        }
        
        if ($engage_mag_sticky_sidebar == 1) {
            $classes[] = 'ct-sticky-sidebar';
        }
        if ($engage_mag_sidebar == 'no-sidebar') {
            $classes[] = 'no-sidebar';
        } elseif ($engage_mag_sidebar == 'left-sidebar') {
            $classes[] = 'left-sidebar';
        } elseif ($engage_mag_sidebar == 'middle-column') {
            $classes[] = 'middle-column';
        } else {
            $classes[] = 'right-sidebar';
        }
        return $classes;
    }
endif;

add_filter('body_class', 'engage_mag_custom_body_class');

/**
 * Remove ... From Excerpt
 *
 * @since 1.0.0
 *
 */
if (!function_exists('engage_mag_excerpt_more')) :
    function engage_mag_excerpt_more($more)
    {
        if (!is_admin()) {
            return '';
        }
    }
endif;
add_filter('excerpt_more', 'engage_mag_excerpt_more');


/**
 * Add class in post list
 *
 * @since 1.0.0
 *
 */
add_filter('post_class', 'engage_mag_post_column_class');
function engage_mag_post_column_class($classes)
{
    global $engage_mag_theme_options;
    if (!is_singular()) {
        $classes[] = esc_attr($engage_mag_theme_options['engage-mag-column-blog-page']);
    }else{
        $classes[] = 'card-single-article';
    }
    return $classes;
}


if (!function_exists('engage_mag_editor_assets')) {
    /**
     * Add styles and fonts for the editor.
     */
    function engage_mag_editor_assets()
    {
        wp_enqueue_style( 'engage-mag-editor-styles', get_theme_file_uri( 'css/editor-styles.css' ) );

        wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Prata|Muli&display=swap' );

        $refined_magazine_custom_css = '
        .edit-post-visual-editor.editor-styles-wrapper{ font-family: Muli;}

        .editor-post-title__block .editor-post-title__input,
        .editor-styles-wrapper h1,
        .editor-styles-wrapper h2,
        .editor-styles-wrapper h3,
        .editor-styles-wrapper h4,
        .editor-styles-wrapper h5,
        .editor-styles-wrapper h6{font-family:Prata;} 
        ';

        wp_add_inline_style( 'engage-mag-editor-styles', $refined_magazine_custom_css );
    }

    add_action('enqueue_block_editor_assets', 'engage_mag_editor_assets');
}


/**
 * Post Formats
 *
 * @since  Engage Mag 1.0.0
 */
if (!function_exists('engage_mag_post_formats')):
    function engage_mag_post_formats($post_id)
    {
        global $engage_mag_theme_options;
            $post_formats = get_post_format($post_id);
            switch ($post_formats) {
                case "image":
                    $post_formats = "<div class='candid-refined-post-format'><i class='fa fa-image'></i></div>";
                    break;
                case "video":
                    $post_formats = "<div class='candid-refined-post-format'><i class='fa fa-video-camera'></i></div>";

                    break;
                case "gallery":
                    $post_formats = "<div class='candid-refined-post-format'><i class='fa fa-camera'></i></div>";
                    break;
                case "audio":
                    $post_formats = "<div class='candid-refined-post-format'><i class='fa fa-volume-up'></i></div>";
                    break;
                default:
                    $post_formats = "";
            }

            echo $post_formats;
     }

endif;


/* Word read count Pagination */
if (!function_exists('engage_mag_read_time_words_count')) :
    /**
     * @param $content
     *
     * @return string
     */
    function engage_mag_read_time_words_count($post_id)
    {
        global $engage_mag_theme_options;
        $engage_mag_read_time = $engage_mag_theme_options['engage-mag-extra-hide-read-time'];
        if ($engage_mag_read_time != 1) {
            engage_mag_read_time($post_id);

        }
    }

endif;


/* Word read count Pagination */
if (!function_exists('engage_mag_read_time_slider')) :
    /**
     * @param $content
     *
     * @return string
     */
    function engage_mag_read_time_slider($post_id)
    {
            engage_mag_read_time($post_id);

    }

endif;


/* Word read count Pagination */
if (!function_exists('engage_mag_read_time')) :
    /**
     * @param $content
     *
     * @return string
     */
    function engage_mag_read_time($post_id)
    {
        global $engage_mag_theme_options;
        $content = apply_filters('the_content', get_post_field('post_content', $post_id));
        $read_words = $engage_mag_theme_options['engage-mag-extra-hide-read-time-words'];
        $decode_content = html_entity_decode($content);
        $filter_shortcode = do_shortcode($decode_content);
        $strip_tags = wp_strip_all_tags($filter_shortcode, true);
        $count = str_word_count($strip_tags);
        $word_per_min = (absint($count) / $read_words);
        $word_per_min = ceil($word_per_min);

        if (absint($word_per_min) > 0) {
            $word_count_strings = sprintf(_n('%s min read', '%s min read', number_format_i18n($word_per_min), 'engage-mag'), number_format_i18n($word_per_min));
            if ('post' == get_post_type($post_id)):
                echo '<span class="min-read"><i class="fa fa-clock-o" aria-hidden="true"></i>';
                echo esc_html($word_count_strings);
                echo '</span>';
            endif;

        }
    }

endif;

if (!function_exists('engage_mag_add_menu_description')) :
function engage_mag_add_menu_description( $item_output, $item, $depth, $args ) {

    if( 'menu-1' == $args->theme_location  && $item->description )
        $item_output = str_replace( '</a>', '<span class="menu-description">' . $item->description . '</span></a>', $item_output );

    return $item_output;
}
endif;
add_filter( 'walker_nav_menu_start_el', 'engage_mag_add_menu_description', 10, 4 );
