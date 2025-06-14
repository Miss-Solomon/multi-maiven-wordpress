<?php
/**
 * Header Builder Functionality
 *
 * @package Multi_Maiven
 */

/**
 * Register customizer settings for header builder
 */
function mm_header_builder_customize_register($wp_customize) {
    // Add Header Builder Section
    $wp_customize->add_section('mm_header_builder', array(
        'title'    => __('Header Builder', 'multi-maiven'),
        'priority' => 46,
    ));

    // 1. Sticky Header checkbox
    $wp_customize->add_setting('mm_sticky_header', array(
        'default'           => false,
        'sanitize_callback' => 'mm_sanitize_checkbox',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('mm_sticky_header', array(
        'type'    => 'checkbox',
        'label'   => __('Enable Sticky Header', 'multi-maiven'),
        'section' => 'mm_header_builder',
    ));

    // 2. Enable Top Header checkbox
    $wp_customize->add_setting('show_top_bar', array(
        'default'           => true,
        'sanitize_callback' => 'mm_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('show_top_bar', array(
        'type'    => 'checkbox',
        'label'   => __('Enable Top Header', 'multi-maiven'),
        'section' => 'mm_header_builder',
    ));

    // 3. Only show to logged-in users checkbox
    $wp_customize->add_setting('top_bar_logged_in_only', array(
        'default'           => false,
        'sanitize_callback' => 'mm_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('top_bar_logged_in_only', array(
        'type'    => 'checkbox',
        'label'   => __('Only show Top Header to logged-in users', 'multi-maiven'),
        'section' => 'mm_header_builder',
    ));

    // 4. Reverse Left/Right Layout checkbox
    $wp_customize->add_setting('top_bar_reverse_layout', array(
        'default'           => false,
        'sanitize_callback' => 'mm_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('top_bar_reverse_layout', array(
        'type'    => 'checkbox',
        'label'   => __('Reverse Left/Right Layout', 'multi-maiven'),
        'section' => 'mm_header_builder',
    ));

    // 5. Top Header Bar Background Color
    $wp_customize->add_setting('top_bar_bg_color', array(
        'default'           => '#f9f9f9',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'top_bar_bg_color', array(
        'label'    => __('Top Header Bar Background Color', 'multi-maiven'),
        'section'  => 'mm_header_builder',
    )));

    // 6. Top Header Bar Text Color
    $wp_customize->add_setting('top_bar_text_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'top_bar_text_color', array(
        'label'    => __('Top Header Bar Text Color', 'multi-maiven'),
        'section'  => 'mm_header_builder',
    )));

    // 7. Left Content (e.g. Social Icons)
    $wp_customize->add_setting('top_bar_left', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('top_bar_left', array(
        'type'    => 'textarea',
        'label'   => __('Left Content (e.g. Social Icons)', 'multi-maiven'),
        'section' => 'mm_header_builder',
    ));

    // 8. Center Content (e.g. Promo)
    $wp_customize->add_setting('top_bar_center', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('top_bar_center', array(
        'type'    => 'textarea',
        'label'   => __('Center Content (e.g. Promo)', 'multi-maiven'),
        'section' => 'mm_header_builder',
    ));

    // 9. Right Content (e.g. Login)
    $wp_customize->add_setting('top_bar_right', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('top_bar_right', array(
        'type'    => 'textarea',
        'label'   => __('Right Content (e.g. Login)', 'multi-maiven'),
        'section' => 'mm_header_builder',
    ));

    // 10. Header Background Color
    $wp_customize->add_setting('mm_header_bg_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mm_header_bg_color', array(
        'label'    => __('Header Background Color', 'multi-maiven'),
        'section'  => 'mm_header_builder',
    )));

    // 11. Header Image
    $wp_customize->add_setting('header_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'header_image', array(
        'label'    => __('Header Image', 'multi-maiven'),
        'section'  => 'mm_header_builder',
    )));

    // 12. Header Layout
    $wp_customize->add_setting('mm_header_layout', array(
        'default'           => 'default',
        'sanitize_callback' => 'mm_sanitize_header_layout',
    ));
    $wp_customize->add_control('mm_header_layout', array(
        'type'        => 'select',
        'label'       => __('Header Layout', 'multi-maiven'),
        'section'     => 'mm_header_builder',
        'description' => __('Select the layout for your site header', 'multi-maiven'),
        'choices'     => array(
            'default'  => __('Default (Logo Left, Menu Right)', 'multi-maiven'),
            'centered' => __('Centered Logo', 'multi-maiven'),
            'split'    => __('Split Menu', 'multi-maiven'),
        ),
    ));

    // 13. Logo Position
    $wp_customize->add_setting('mm_logo_position', array(
        'default'           => 'left',
        'sanitize_callback' => 'mm_sanitize_logo_position',
    ));
    $wp_customize->add_control('mm_logo_position', array(
        'type'    => 'radio',
        'label'   => __('Logo Position', 'multi-maiven'),
        'section' => 'mm_header_builder',
        'choices' => array(
            'left'   => __('Left', 'multi-maiven'),
            'center' => __('Center', 'multi-maiven'),
        ),
    ));

    // 14. Top of Header Padding (px)
    $wp_customize->add_setting('mm_header_padding_top', array(
        'default'           => '20',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('mm_header_padding_top', array(
        'type'        => 'range',
        'label'       => __('Top of Header Padding (px)', 'multi-maiven'),
        'section'     => 'mm_header_builder',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 50,
            'step' => 5,
        ),
    ));

    // 15. Bottom of Header Padding (px)
    $wp_customize->add_setting('mm_header_padding_bottom', array(
        'default'           => '20',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('mm_header_padding_bottom', array(
        'type'        => 'range',
        'label'       => __('Bottom of Header Padding (px)', 'multi-maiven'),
        'section'     => 'mm_header_builder',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 50,
            'step' => 5,
        ),
    ));

    // 16. Show Header Border checkbox
    $wp_customize->add_setting('mm_header_border', array(
        'default'           => true,
        'sanitize_callback' => 'mm_sanitize_checkbox',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('mm_header_border', array(
        'type'    => 'checkbox',
        'label'   => __('Show Header Border', 'multi-maiven'),
        'section' => 'mm_header_builder',
    ));

    // 17. Transparent Header on Front Page checkbox
    $wp_customize->add_setting('mm_transparent_header', array(
        'default'           => false,
        'sanitize_callback' => 'mm_sanitize_checkbox',
    ));
    $wp_customize->add_control('mm_transparent_header', array(
        'type'        => 'checkbox',
        'label'       => __('Transparent Header on Front Page', 'multi-maiven'),
        'section'     => 'mm_header_builder',
        'description' => __('Make the header transparent on the front page', 'multi-maiven'),
    ));

    // 18. Menu Position
    $wp_customize->add_setting('mm_menu_position', array(
        'default'           => 'right',
        'sanitize_callback' => 'mm_sanitize_menu_position',
    ));
    $wp_customize->add_control('mm_menu_position', array(
        'type'    => 'radio',
        'label'   => __('Menu Position', 'multi-maiven'),
        'section' => 'mm_header_builder',
        'choices' => array(
            'left'   => __('Left', 'multi-maiven'),
            'center' => __('Center', 'multi-maiven'),
            'right'  => __('Right', 'multi-maiven'),
        ),
    ));
}
add_action('customize_register', 'mm_header_builder_customize_register');

/**
 * Sanitization functions
 */
function mm_sanitize_header_layout($input) {
    $valid_layouts = array('default', 'centered', 'split');
    return in_array($input, $valid_layouts) ? $input : 'default';
}

function mm_sanitize_logo_position($input) {
    $valid_positions = array('left', 'center');
    return in_array($input, $valid_positions) ? $input : 'left';
}

function mm_sanitize_menu_position($input) {
    $valid_positions = array('left', 'center', 'right');
    return in_array($input, $valid_positions) ? $input : 'right';
}

function mm_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}

/**
 * Update the header builder class to use the new customizer settings
 */
function mm_update_header_builder() {
    // This function will be called after the theme is set up
    // to ensure the header builder class uses the new customizer settings
    require_once get_template_directory() . '/parts/header-builder.php';
}
add_action('after_setup_theme', 'mm_update_header_builder', 20);
