<?php
/**
 * Ads Image Widget
 *
 * @package Engage Mag
 */
if (!class_exists('Engage_Mag_Advertisement_Widget')) :
    /**
     * Advertisement widget class.
     *
     * @since Engage Mag 1.0.0
     */
    class Engage_Mag_Advertisement_Widget extends WP_Widget {

        function __construct() {
            $opts  = array(
                'classname'                   => 'engage_mag_advertisement',
                'description'                 => __( 'Small (125*125) Advertisement.', 'engage-mag' ),
                'customize_selective_refresh' => true,
            );
            $control_ops = array( 'width' => 200, 'height' => 250 );
            parent::__construct( false, $name = __( 'Engage Mag(125*125) Advertisement', 'engage-mag' ), $opts );
        }

    /**
     * Echo the widget content.
     *
     * @since 1.0.0
     *
     * @param array $args Display arguments including before_title, after_title,
     *                        before_widget, and after_widget.
     * @param array $instance The settings for the particular instance of the widget.
     */
        function widget( $args, $instance ) {
        extract( $args );
        extract( $instance );

        $title       = isset( $instance['title'] ) ? $instance['title'] : '';
        $image_array = array();
        $link_array  = array();

        for ( $i = 1; $i < 5; $i ++ ) {
            $image_link = 'engage_mag_ads_image_link_' . $i;
            $image_url  = 'engage_mag_ads_image_url_' . $i;

            $image_link = isset( $instance[ $image_link ] ) ? $instance[ $image_link ] : '';
            $image_url  = isset( $instance[ $image_url ] ) ? $instance[ $image_url ] : '';
            if ( ! empty( $image_link ) ) {
                array_push( $link_array, $image_link );
            }
            if ( ! empty( $image_url ) ) {
                array_push( $image_array, $image_url );
            }
        }
        echo $before_widget;
        ?>

        <div class="advertisement_125x125">
            <?php if ( ! empty( $title ) ) { ?>
                <div class="advertisement-title">
                    <?php echo $before_title . esc_html( $title ) . $after_title; ?>
                </div>
                <?php
            }
            $output = '';
            if ( ! empty( $image_array ) ) {
                $image_id  = attachment_url_to_postid( $image_url );
                $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                $output    .= '<div class="advertisement-content">';
                for ( $i = 1; $i < 5; $i ++ ) {
                    $j = $i - 1;
                    if ( ! empty( $image_array[ $j ] ) ) {
                        if ( ! empty( $link_array[ $j ] ) ) {
                            $output .= '<a href="' . $link_array[ $j ] . '" class="single_ad_125x125" target="_blank" rel="nofollow">
                                 <img src="' . $image_array[ $j ] . '" width="125" height="125" alt="' . $image_alt . '">
                              </a>';
                        } else {
                            $output .= '<img src="' . $image_array[ $j ] . '" width="125" height="125" alt="' . $image_alt . '">';
                        }
                    }
                }
                $output .= '</div>';
                echo $output;
            }
            ?>
        </div>
        <?php
        echo $after_widget;
    }
    /**
     * Update widget instance.
     *
     * @since 1.0.0
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            {@see WP_Widget::form()}.
     * @param array $old_instance Old settings for this instance.
     * @return array Settings to save or bool false to cancel saving.
     */
    function update( $new_instance, $old_instance ) {
        $instance          = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        for ( $i = 1; $i < 5; $i ++ ) {
            $image_link = 'engage_mag_ads_image_link_' . $i;
            $image_url  = 'engage_mag_ads_image_url_' . $i;

            $instance[ $image_link ] = esc_url_raw( $new_instance[ $image_link ] );
            $instance[ $image_url ]  = esc_url_raw( $new_instance[ $image_url ] );
        }

        return $instance;
    }

        /**
         * Output the settings update form.
         *
         * @since 1.0.0
         *
         * @param array $instance Current settings.
         * @return void
         */

        function form( $instance ) {
            // Defaults.
            $defaults = array(
                'title'                => esc_html__('Advertisement', 'engage-mag'),
                'engage_mag_ads_image_url_1'  => '',
                'engage_mag_ads_image_url_2'  => '',
                'engage_mag_ads_image_url_3'  => '',
                'engage_mag_ads_image_url_4'  => '',
                'engage_mag_ads_image_link_1' => '',
                'engage_mag_ads_image_link_2' => '',
                'engage_mag_ads_image_link_3' => '',
                'engage_mag_ads_image_link_4' => '',

            );
            $instance = wp_parse_args((array)$instance, $defaults);

            $title    = esc_attr( $instance['title'] );
            for ( $i = 1; $i < 5; $i ++ ) {
                $image_link = 'engage_mag_ads_image_link_' . $i;
                $image_url  = 'engage_mag_ads_image_url_' . $i;

                $instance[ $image_link ] = esc_url( $instance[ $image_link ] );
                $instance[ $image_url ]  = esc_url( $instance[ $image_url ] );
            }
            ?>

            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'engage-mag' ); ?></label>
                <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <label><?php _e( 'Add your Advertisement 125x125 Images Here', 'engage-mag' ); ?></label>
            <?php
            for ( $i = 1; $i < 5; $i ++ ) {
                $image_link = 'engage_mag_ads_image_link_' . $i;
                $image_url  = 'engage_mag_ads_image_url_' . $i;
                ?>
                <p>
                    <label for="<?php echo $this->get_field_id( $image_link ); ?>"> <?php _e( 'Advertisement Image Link ', 'engage-mag' );
                    echo $i; ?></label>
                    <input type="text" class="widefat" id="<?php echo $this->get_field_id( $image_link ); ?>" name="<?php echo $this->get_field_name( $image_link ); ?>" value="<?php echo $instance[ $image_link ]; ?>" />
                </p>
                <p>
                   <label for="<?php echo $this->get_field_id($image_url); ?>">
                    <?php _e('Upload Advertisement Image', 'engage-mag'); ?>
                </label>
                
                <br/>
                <?php
                if (isset($instance[$image_url]) && $instance[$image_url] != '') :
                    echo '<img class="widefat custom_media_image" src="' . esc_url($instance[$image_url]) . '" />';
                endif;
                ?>
                <div class="media-uploader" id="<?php echo $this->get_field_id( $image_url ); ?>">
                    <input type="text" class="widefat custom_media_url"
                    name="<?php echo $this->get_field_name($image_url); ?>"
                    id="<?php echo $this->get_field_id($image_url); ?>" value="<?php
                    if (isset($instance[$image_url]) && $instance[$image_url] != '') :
                        echo esc_url($instance[$image_url]);
                    endif;
                    ?>">

                    <input type="button" class="button button-primary custom_media_button" id="custom_media_button"
                    name="<?php echo $this->get_field_name($image_url); ?>"
                    value="<?php esc_attr_e('Upload Image', 'engage-mag') ?>"/>
                </div>
            </p>
        <?php } ?>

        <?php
    }

}
endif;

add_action('admin_enqueue_scripts', 'engage_mag_ads_widgets_backend_enqueue');
function engage_mag_ads_widgets_backend_enqueue()
{
    wp_register_script('engage-mag-custom-widgets', get_template_directory_uri() . '/candidthemes/assets/js/widget.js', array('jquery'), true);
    wp_enqueue_media();
    wp_enqueue_script('engage-mag-custom-widgets');
}