<?php
/**
 *  Engage Mag Category Color Option
 *
 * @since Engage Mag 1.0.0
 *
 */
/*Category Color Options*/
$wp_customize->add_section('engage_mag_category_color_setting', array(
    'priority'      => 40,
    'title'         => __('Category Color', 'engage-mag'),
    'description'   => __('You can select the different color for each category.', 'engage-mag'),
    'panel'          => 'engage_mag_panel'
));

/*Enable Top Header Section*/
$wp_customize->add_setting( 'engage_mag_options[engage-mag-enable-category-color]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['engage-mag-enable-category-color'],
   'sanitize_callback' => 'engage_mag_sanitize_checkbox'
) );
$wp_customize->add_control( 'engage_mag_options[engage-mag-enable-category-color]', array(
   'label'     => __( 'Enable Category Color', 'engage-mag' ),
   'description' => __('Checked to enable the category color and select the required color for each category.', 'engage-mag'),
   'section'   => 'engage_mag_category_color_setting',
   'settings'  => 'engage_mag_options[engage-mag-enable-category-color]',
   'type'      => 'checkbox',
   'priority'  => 1,
) );

/*callback functions header section*/
if ( !function_exists('engage_mag_colors_active_callback') ) :
  function engage_mag_colors_active_callback(){
      global $engage_mag_theme_options;
      $engage_mag_theme_options = engage_mag_get_options_value();
      $enable_color = absint($engage_mag_theme_options['engage-mag-enable-category-color']);
      if( 1 == $enable_color ){
          return true;
      }
      else{
          return false;
      }
  }
endif;

$i = 1;
$args = array(
    'orderby' => 'id',
    'hide_empty' => 0
);
$categories = get_categories( $args );
$wp_category_list = array();
foreach ($categories as $category_list ) {
    $wp_category_list[$category_list->cat_ID] = $category_list->cat_name;

    $wp_customize->add_setting('engage_mag_options[cat-'.get_cat_id($wp_category_list[$category_list->cat_ID]).']', array(
        'default'           => $default['engage-mag-primary-color'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
    	new WP_Customize_Color_Control(
    		$wp_customize,
		    'engage_mag_options[cat-'.get_cat_id($wp_category_list[$category_list->cat_ID]).']',
		    array(
		    	'label'     => sprintf(__('"%s" Color', 'engage-mag'), $wp_category_list[$category_list->cat_ID] ),
			    'section'   => 'engage_mag_category_color_setting',
			    'settings'  => 'engage_mag_options[cat-'.get_cat_id($wp_category_list[$category_list->cat_ID]).']',
			    'priority'  => $i,
                'active_callback'   => 'engage_mag_colors_active_callback'
		    )
	    )
    );
    $i++;
}