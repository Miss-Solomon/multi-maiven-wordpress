<?php
/**
 * Footer Builder Functionality
 *
 * @package Multi_Maiven
 */

/**
 * Register customizer settings for footer builder
 */
function mm_footer_builder_customize_register($wp_customize) {
    // Add Footer Builder Section
    $wp_customize->add_section('mm_footer_builder', array(
        'title'    => __('Footer Builder', 'multi-maiven'),
        'priority' => 47,
    ));

    // Main Footer Settings
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'mm_main_footer_heading', array(
        'type'        => 'hidden',
        'section'     => 'mm_footer_builder',
        'description' => '<h3 style="margin-top:10px;border-bottom:1px solid #ddd;padding-bottom:10px;color:#23282d;">' . __('Main Footer', 'multi-maiven') . '</h3>',
        'priority'    => 1,
    )));

    // 1. Footer Background Color
    $wp_customize->add_setting('mm_footer_bg_color', array(
        'default'           => '#f8fafc',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mm_footer_bg_color', array(
        'label'    => __('Footer Background Color', 'multi-maiven'),
        'section'  => 'mm_footer_builder',
        'settings' => 'mm_footer_bg_color',
        'priority' => 2,
    )));

    // 2. Footer Text Color
    $wp_customize->add_setting('mm_footer_text_color', array(
        'default'           => '#1e293b',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mm_footer_text_color', array(
        'label'    => __('Footer Text Color', 'multi-maiven'),
        'section'  => 'mm_footer_builder',
        'settings' => 'mm_footer_text_color',
        'priority' => 3,
    )));

    // 3. Footer Column Layout
    $wp_customize->add_setting('mm_footer_columns', array(
        'default'           => '4',
        'sanitize_callback' => 'mm_sanitize_footer_columns',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('mm_footer_columns', array(
        'type'        => 'select',
        'label'       => __('Footer Column Layout', 'multi-maiven'),
        'section'     => 'mm_footer_builder',
        'description' => __('Select the number of columns for the footer widgets', 'multi-maiven'),
        'choices'     => array(
            '1' => __('1 Column (100%)', 'multi-maiven'),
            '2' => __('2 Columns (50% / 50%)', 'multi-maiven'),
            '3' => __('3 Columns (33% / 33% / 33%)', 'multi-maiven'),
            '4' => __('4 Columns (25% / 25% / 25% / 25%)', 'multi-maiven'),
            '2-1' => __('2 Columns (75% / 25%)', 'multi-maiven'),
            '1-2' => __('2 Columns (25% / 75%)', 'multi-maiven'),
            '1-1-2' => __('3 Columns (25% / 25% / 50%)', 'multi-maiven'),
            '2-1-1' => __('3 Columns (50% / 25% / 25%)', 'multi-maiven'),
        ),
        'priority'    => 4,
    ));

    // 4. Enable Footer Widgets
    $wp_customize->add_setting('mm_enable_footer_widgets', array(
        'default'           => true,
        'sanitize_callback' => 'mm_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('mm_enable_footer_widgets', array(
        'type'    => 'checkbox',
        'label'   => __('Enable Footer Widgets', 'multi-maiven'),
        'section' => 'mm_footer_builder',
        'priority' => 5,
    ));

    // 5. Enable Advertising Widget
    $wp_customize->add_setting('mm_enable_footer_ad', array(
        'default'           => false,
        'sanitize_callback' => 'mm_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('mm_enable_footer_ad', array(
        'type'        => 'checkbox',
        'label'       => __('Enable Advertising Widget Area', 'multi-maiven'),
        'description' => __('Display a full-width widget area above the footer columns', 'multi-maiven'),
        'section'     => 'mm_footer_builder',
        'priority'    => 6,
    ));

    // 6. Footer Top Padding
    $wp_customize->add_setting('mm_footer_padding_top', array(
        'default'           => '30',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('mm_footer_padding_top', array(
        'type'        => 'range',
        'label'       => __('Footer Top Padding (px)', 'multi-maiven'),
        'section'     => 'mm_footer_builder',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 100,
            'step' => 5,
        ),
        'priority'    => 7,
    ));

    // 7. Footer Bottom Padding
    $wp_customize->add_setting('mm_footer_padding_bottom', array(
        'default'           => '30',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('mm_footer_padding_bottom', array(
        'type'        => 'range',
        'label'       => __('Footer Bottom Padding (px)', 'multi-maiven'),
        'section'     => 'mm_footer_builder',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 100,
            'step' => 5,
        ),
        'priority'    => 8,
    ));

    // 8. Show Footer Border
    $wp_customize->add_setting('mm_footer_border', array(
        'default'           => true,
        'sanitize_callback' => 'mm_sanitize_checkbox',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('mm_footer_border', array(
        'type'    => 'checkbox',
        'label'   => __('Show Footer Top Border', 'multi-maiven'),
        'section' => 'mm_footer_builder',
        'priority' => 9,
    ));

    // 9. Footer Widget Title Color
    $wp_customize->add_setting('mm_footer_widget_title_color', array(
        'default'           => '#1e293b',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mm_footer_widget_title_color', array(
        'label'    => __('Footer Widget Title Color', 'multi-maiven'),
        'section'  => 'mm_footer_builder',
        'settings' => 'mm_footer_widget_title_color',
        'priority' => 10,
    )));

    // 10. Footer Link Color
    $wp_customize->add_setting('mm_footer_link_color', array(
        'default'           => '#0d6efd',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mm_footer_link_color', array(
        'label'    => __('Footer Link Color', 'multi-maiven'),
        'section'  => 'mm_footer_builder',
        'settings' => 'mm_footer_link_color',
        'priority' => 11,
    )));

    // 11. Footer Link Hover Color
    $wp_customize->add_setting('mm_footer_link_hover_color', array(
        'default'           => '#0a58ca',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mm_footer_link_hover_color', array(
        'label'    => __('Footer Link Hover Color', 'multi-maiven'),
        'section'  => 'mm_footer_builder',
        'settings' => 'mm_footer_link_hover_color',
        'priority' => 12,
    )));

    // 12. Mobile Footer Layout
    $wp_customize->add_setting('mm_footer_mobile_layout', array(
        'default'           => 'stack',
        'sanitize_callback' => 'mm_sanitize_footer_mobile_layout',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('mm_footer_mobile_layout', array(
        'type'        => 'radio',
        'label'       => __('Mobile Footer Layout', 'multi-maiven'),
        'section'     => 'mm_footer_builder',
        'description' => __('Choose how footer columns display on mobile devices', 'multi-maiven'),
        'choices'     => array(
            'stack'   => __('Stack (Full Width)', 'multi-maiven'),
            'grid'    => __('Grid (Two Columns)', 'multi-maiven'),
        ),
        'priority'    => 13,
    ));
    
    // Bottom Footer Bar Settings
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'mm_bottom_bar_heading', array(
        'type'        => 'hidden',
        'section'     => 'mm_footer_builder',
        'description' => '<h3 style="margin-top:30px;border-bottom:1px solid #ddd;padding-bottom:10px;color:#23282d;">' . __('Bottom Footer Bar', 'multi-maiven') . '</h3>',
        'priority'    => 20,
    )));
    
    // 13. Enable Bottom Footer Bar
    $wp_customize->add_setting('mm_show_bottom_bar', array(
        'default'           => true,
        'sanitize_callback' => 'mm_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('mm_show_bottom_bar', array(
        'type'    => 'checkbox',
        'label'   => __('Enable Bottom Footer Bar', 'multi-maiven'),
        'section' => 'mm_footer_builder',
        'priority' => 21,
    ));
    
    // 14. Reverse Left/Right Layout
    $wp_customize->add_setting('mm_bottom_bar_reverse_layout', array(
        'default'           => false,
        'sanitize_callback' => 'mm_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('mm_bottom_bar_reverse_layout', array(
        'type'    => 'checkbox',
        'label'   => __('Reverse Left/Right Layout', 'multi-maiven'),
        'section' => 'mm_footer_builder',
        'priority' => 22,
    ));
    
    // 15. Bottom Footer Bar Background Color
    $wp_customize->add_setting('mm_bottom_bar_bg_color', array(
        'default'           => '#f9f9f9',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mm_bottom_bar_bg_color', array(
        'label'    => __('Bottom Footer Bar Background Color', 'multi-maiven'),
        'section'  => 'mm_footer_builder',
        'priority' => 23,
    )));
    
    // 16. Bottom Footer Bar Text Color
    $wp_customize->add_setting('mm_bottom_bar_text_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mm_bottom_bar_text_color', array(
        'label'    => __('Bottom Footer Bar Text Color', 'multi-maiven'),
        'section'  => 'mm_footer_builder',
        'priority' => 24,
    )));
    
    // 17. Left Content
    $wp_customize->add_setting('mm_bottom_bar_left', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('mm_bottom_bar_left', array(
        'type'        => 'textarea',
        'label'       => __('Left Content (e.g. Footer Menu)', 'multi-maiven'),
        'section'     => 'mm_footer_builder',
        'description' => __('Enter content for the left side of the bottom footer bar. HTML is allowed. If left empty and a footer menu is set, it will display the footer menu.', 'multi-maiven'),
        'priority'    => 25,
    ));
    
    // 18. Right Content
    $wp_customize->add_setting('mm_bottom_bar_right', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('mm_bottom_bar_right', array(
        'type'        => 'textarea',
        'label'       => __('Right Content (e.g. Social Icons)', 'multi-maiven'),
        'section'     => 'mm_footer_builder',
        'description' => __('Enter content for the right side of the bottom footer bar. HTML is allowed.', 'multi-maiven'),
        'priority'    => 26,
    ));
    
    // Copyright Text Settings
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'mm_copyright_heading', array(
        'type'        => 'hidden',
        'section'     => 'mm_footer_builder',
        'description' => '<h3 style="margin-top:30px;border-bottom:1px solid #ddd;padding-bottom:10px;color:#23282d;">' . __('Copyright Text', 'multi-maiven') . '</h3>',
        'priority'    => 30,
    )));
    
    // 19. Copyright Text Editor
    $wp_customize->add_setting('mm_copyright_text', array(
        'default'           => sprintf(
            /* translators: %1$s: Theme name, %2$s: Theme author. */
            __('Proudly powered by WordPress | Theme: %1$s by %2$s.', 'multi-maiven'),
            'Multi Maiven',
            '<a href="#">Your Name</a>'
        ),
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('mm_copyright_text', array(
        'type'        => 'textarea',
        'label'       => __('Copyright Text', 'multi-maiven'),
        'section'     => 'mm_footer_builder',
        'description' => __('Enter your copyright text or other footer information. HTML is allowed.', 'multi-maiven'),
        'priority'    => 31,
    ));
}
add_action('customize_register', 'mm_footer_builder_customize_register');

/**
 * Sanitization functions
 */
function mm_sanitize_footer_columns($input) {
    $valid_columns = array('1', '2', '3', '4', '2-1', '1-2', '1-1-2', '2-1-1');
    return in_array($input, $valid_columns) ? $input : '4';
}

function mm_sanitize_footer_mobile_layout($input) {
    $valid_layouts = array('stack', 'grid');
    return in_array($input, $valid_layouts) ? $input : 'stack';
}

/**
 * Register footer widget areas
 */
function mm_register_footer_widget_areas() {
    // Footer Advertising Widget Area
    register_sidebar(array(
        'name'          => __('Footer Advertising', 'multi-maiven'),
        'id'            => 'footer-ad',
        'description'   => __('Add widgets here to appear in the full-width advertising area above the footer.', 'multi-maiven'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    
    // Footer Column Widget Areas
    $columns = get_theme_mod('mm_footer_columns', '4');
    $column_count = 4; // Default to 4 columns
    
    // Determine how many widget areas to register based on the layout
    if ($columns === '1') {
        $column_count = 1;
    } elseif (in_array($columns, array('2', '2-1', '1-2'))) {
        $column_count = 2;
    } elseif (in_array($columns, array('3', '1-1-2', '2-1-1'))) {
        $column_count = 3;
    }
    
    // Register the widget areas
    for ($i = 1; $i <= $column_count; $i++) {
        register_sidebar(array(
            'name'          => sprintf(__('Footer Column %d', 'multi-maiven'), $i),
            'id'            => 'footer-' . $i,
            'description'   => sprintf(__('Add widgets here to appear in footer column %d.', 'multi-maiven'), $i),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));
    }
}
add_action('widgets_init', 'mm_register_footer_widget_areas');

/**
 * Register footer menu locations
 */
function mm_register_footer_menus() {
    register_nav_menus(array(
        'footer'       => __('Footer Menu', 'multi-maiven'),
        'footer-left'  => __('Footer Left Menu', 'multi-maiven'),
        'footer-right' => __('Footer Right Menu', 'multi-maiven'),
    ));
}
add_action('after_setup_theme', 'mm_register_footer_menus');

/**
 * Output footer elements based on customizer settings
 */
function mm_footer_elements() {
    // Apply footer styles
    $footer_bg_color = get_theme_mod('mm_footer_bg_color', '#f8fafc');
    $footer_text_color = get_theme_mod('mm_footer_text_color', '#1e293b');
    $footer_padding_top = get_theme_mod('mm_footer_padding_top', '30');
    $footer_padding_bottom = get_theme_mod('mm_footer_padding_bottom', '30');
    $footer_border = get_theme_mod('mm_footer_border', true);

    // Add inline styles
    add_action('wp_head', 'mm_footer_inline_styles');
}
add_action('after_setup_theme', 'mm_footer_elements');

/**
 * Output footer inline styles
 */
function mm_footer_inline_styles() {
    $footer_bg_color = get_theme_mod('mm_footer_bg_color', '#f8fafc');
    $footer_text_color = get_theme_mod('mm_footer_text_color', '#1e293b');
    $footer_padding_top = get_theme_mod('mm_footer_padding_top', '30');
    $footer_padding_bottom = get_theme_mod('mm_footer_padding_bottom', '30');
    $footer_border = get_theme_mod('mm_footer_border', true);
    $footer_widget_title_color = get_theme_mod('mm_footer_widget_title_color', '#1e293b');
    $footer_link_color = get_theme_mod('mm_footer_link_color', '#0d6efd');
    $footer_link_hover_color = get_theme_mod('mm_footer_link_hover_color', '#0a58ca');
    
    $bottom_bar_bg_color = get_theme_mod('mm_bottom_bar_bg_color', '#f9f9f9');
    $bottom_bar_text_color = get_theme_mod('mm_bottom_bar_text_color', '#333333');
    
    $border_style = $footer_border ? '1px solid var(--mm-color-border, #e9e9e9)' : 'none';
    
    ?>
    <style type="text/css">
        .site-footer {
            background-color: <?php echo esc_attr($footer_bg_color); ?>;
            color: <?php echo esc_attr($footer_text_color); ?>;
            padding-top: <?php echo esc_attr($footer_padding_top); ?>px;
            padding-bottom: <?php echo esc_attr($footer_padding_bottom); ?>px;
            border-top: <?php echo esc_attr($border_style); ?>;
        }
        .site-footer .widget-title {
            color: <?php echo esc_attr($footer_widget_title_color); ?>;
        }
        .site-footer a {
            color: <?php echo esc_attr($footer_link_color); ?>;
        }
        .site-footer a:hover {
            color: <?php echo esc_attr($footer_link_hover_color); ?>;
        }
        .footer-bottom-bar {
            background-color: <?php echo esc_attr($bottom_bar_bg_color); ?>;
            color: <?php echo esc_attr($bottom_bar_text_color); ?>;
        }
    </style>
    <?php
}

/**
 * Enqueue footer builder JavaScript
 */
function mm_footer_builder_scripts() {
    if (is_customize_preview()) {
        $theme = wp_get_theme();
        $version = $theme->get('Version');
        wp_enqueue_script('mm-footer-builder', get_template_directory_uri() . '/assets/js/footer-builder.js', array('customize-preview', 'jquery'), $version, true);
    }
}
add_action('customize_preview_init', 'mm_footer_builder_scripts');

/**
 * Update the footer builder class to use the new customizer settings
 */
function mm_update_footer_builder() {
    // This function will be called after the theme is set up
    // to ensure the footer builder class uses the new customizer settings
    require_once get_template_directory() . '/parts/footer-builder.php';
}
add_action('after_setup_theme', 'mm_update_footer_builder', 20);
