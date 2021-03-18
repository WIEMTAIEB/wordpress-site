<?php
/**
 *  Engage Mag Blog Page Option
 *
 * @since Engage Mag 1.0.0
 *
 */
/*Blog Page Options*/
$wp_customize->add_section('engage_mag_blog_page_section', array(
    'priority' => 20,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __('Blog Section Options', 'engage-mag'),
    'panel' => 'engage_mag_panel',
));
/*Blog Page column number*/
$wp_customize->add_setting('engage_mag_options[engage-mag-column-blog-page]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['engage-mag-column-blog-page'],
    'sanitize_callback' => 'engage_mag_sanitize_select'
));
$wp_customize->add_control('engage_mag_options[engage-mag-column-blog-page]', array(
    'choices' => array(
        'one-column' => __('Single Column', 'engage-mag'),
        'two-columns' => __('Two Column', 'engage-mag'),
        'three-columns' => __('Three Column', 'engage-mag'),
    ),
    'label' => __('Blog Layout Column', 'engage-mag'),
    'description' => __('You can change the blog page and archive page layouts', 'engage-mag'),
    'section' => 'engage_mag_blog_page_section',
    'settings' => 'engage_mag_options[engage-mag-column-blog-page]',
    'type' => 'select',
    'priority' => 10,
));
/*Blog Page Show content from*/
$wp_customize->add_setting('engage_mag_options[engage-mag-content-show-from]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['engage-mag-content-show-from'],
    'sanitize_callback' => 'engage_mag_sanitize_select'
));
$wp_customize->add_control('engage_mag_options[engage-mag-content-show-from]', array(
    'choices' => array(
        'excerpt' => __('Excerpt', 'engage-mag'),
        'content' => __('Content', 'engage-mag')
    ),
    'label' => __('Select Content Display Option', 'engage-mag'),
    'description' => __('You can enable excerpt from Screen Options inside post section of dashboard', 'engage-mag'),
    'section' => 'engage_mag_blog_page_section',
    'settings' => 'engage_mag_options[engage-mag-content-show-from]',
    'type' => 'select',
    'priority' => 10,
));
/*Blog Page excerpt length*/
$wp_customize->add_setting('engage_mag_options[engage-mag-excerpt-length]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['engage-mag-excerpt-length'],
    'sanitize_callback' => 'absint'
));
$wp_customize->add_control('engage_mag_options[engage-mag-excerpt-length]', array(
    'label' => __('Size of Excerpt Content', 'engage-mag'),
    'description' => __('Enter the number per Words to show the content in blog page.', 'engage-mag'),
    'section' => 'engage_mag_blog_page_section',
    'settings' => 'engage_mag_options[engage-mag-excerpt-length]',
    'type' => 'number',
    'priority' => 10,
));
/*Blog Page Pagination Options*/
$wp_customize->add_setting('engage_mag_options[engage-mag-pagination-options]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['engage-mag-pagination-options'],
    'sanitize_callback' => 'engage_mag_sanitize_select'
));
$wp_customize->add_control('engage_mag_options[engage-mag-pagination-options]', array(
    'choices' => array(
        'default' => __('Default', 'engage-mag'),
        'numeric' => __('Numeric', 'engage-mag'),
    ),
    'label' => __('Pagination Types', 'engage-mag'),
    'description' => __('Select the Required Pagination Type', 'engage-mag'),
    'section' => 'engage_mag_blog_page_section',
    'settings' => 'engage_mag_options[engage-mag-pagination-options]',
    'type' => 'select',
    'priority' => 10,
));
/*Blog Page read more text*/
$wp_customize->add_setting('engage_mag_options[engage-mag-read-more-text]', array(
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    'default' => $default['engage-mag-read-more-text'],
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control('engage_mag_options[engage-mag-read-more-text]', array(
    'label' => __('Enter Read More Text', 'engage-mag'),
    'description' => __('Read more text for blog and archive page.', 'engage-mag'),
    'section' => 'engage_mag_blog_page_section',
    'settings' => 'engage_mag_options[engage-mag-read-more-text]',
    'type' => 'text',
    'priority' => 10,
));