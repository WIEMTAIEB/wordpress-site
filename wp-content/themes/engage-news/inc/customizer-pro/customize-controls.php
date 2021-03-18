<?php
/**
     * A class to create a option separator in customizer section 
     *
     *@since 1.0.0
     */
    class Engage_News_Customize_Section_Separator extends WP_Customize_Control {
        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'engage_news_separator';

        /**
         * Displays the control content.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function render_content() {
    ?>
        <div class="engage-news-customize-section-wrap">
            <label>
                <span class="engage-news-customize-control-title"><h4><?php echo esc_html( $this->label ); ?></h4></span>
            </label>
        </div>
    <?php
        }
    }