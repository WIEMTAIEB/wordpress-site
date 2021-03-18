<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Engage Mag
 */

?>
</div> <!-- .container-inner -->
</div><!-- #content -->
<?php
if (is_active_sidebar('above-footer')) {
    ?>
    <div class="ct-above-footer">
        <div class="container-inner">
            <?php dynamic_sidebar('above-footer'); ?>
        </div>
    </div>
    <?php
}
?>
<?php

/**
 * engage_mag_you_may_missed hook.
 *
 * @since 1.0.0
 *
 */

do_action('engage_mag_you_may_missed_hook');

/**
 * engage_mag_footer_instagram_feed hook.
 *
 * @since 1.0.0
 *
 */

do_action('engage_mag_footer_instagram_feed_action');

/**
 * engage_mag_before_footer hook.
 *
 * @since 1.0.0
 *
 */
do_action('engage_mag_before_footer');


/**
 * engage_mag_header hook.
 *
 * @since 1.0.0
 *
 * @hooked engage_mag_footer_start - 5
 * @hooked engage_mag_footer_socials - 10
 * @hooked engage_mag_footer_widget - 15
 * @hooked engage_mag_footer_siteinfo - 20
 * @hooked engage_mag_footer_end - 25
 */
do_action('engage_mag_footer');
?>

<?php
/**
 * engage_mag_construct_gototop hook
 *
 * @since 1.0.0
 *
 */
do_action('engage_mag_gototop');

?>

<?php

/**
 * engage_mag_after_footer hook.
 *
 * @since 1.0.0
 *
 */
do_action('engage_mag_after_footer');
?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
