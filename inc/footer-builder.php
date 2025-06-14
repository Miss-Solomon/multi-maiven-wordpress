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

    // === FOOTER LAYOUT SECTION ===
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'mm_footer_layout_heading', array(
        'type'        => 'hidden',
        'section'     => 'mm_footer_builder',
        'description' => '<h3 style="margin-top:0;border-bottom:1px solid #ddd;padding-bottom:10px;color:#23282d;">' . __('Footer Layout', 'multi-maiven') . '</h3>',
        'priority'    => 5,
    )));

    // 1. Footer Column Count
    $wp_customize->add_setting('mm_footer_column_count', array(
        'default'           => 3,
        'sanitize_callback' => 'mm_sanitize_footer_columns',
        'transport'         => 'refresh', // Requires page refresh to register new widget areas
    ));
    $wp_customize->add_control('mm_footer_column_count', array(
        'type'        => 'select',
        'label'       => __('Footer Columns', 'multi-maiven'),
        'section'     => 'mm_footer_builder',
        'description' => __('Choose the number of footer columns. Each column will have its own widget area.', 'multi-maiven'),
        'choices'     => array(
            1 => __('1 Column', 'multi-maiven'),
            2 => __('2 Columns', 'multi-maiven'),
            3 => __('3 Columns', 'multi-maiven'),
            4 => __('4 Columns', 'multi-maiven'),
        ),
        'priority'    => 10,
    ));

    // === FOOTER MENUS SECTION ===
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'mm_footer_menus_heading', array(
        'type'        => 'hidden',
        'section'     => 'mm_footer_builder',
        'description' => '<h3 style="margin-top:30px;border-bottom:1px solid #ddd;padding-bottom:10px;color:#23282d;">' . __('Footer Menus', 'multi-maiven') . '</h3>',
        'priority'    => 15,
    )));

    // 2. Primary Footer Menu Alignment
    $wp_customize->add_setting('mm_footer_primary_alignment', array(
        'default'           => 'left',
        'sanitize_callback' => 'mm_sanitize_alignment',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('mm_footer_primary_alignment', array(
        'type'        => 'select',
        'label'       => __('Primary Footer Menu Alignment', 'multi-maiven'),
        'section'     => 'mm_footer_builder',
        'description' => __('Set the alignment for the primary footer menu.', 'multi-maiven'),
        'choices'     => array(
            'left'   => __('Left', 'multi-maiven'),
            'center' => __('Center', 'multi-maiven'),
            'right'  => __('Right', 'multi-maiven'),
        ),
        'priority'    => 20,
    ));

    // 3. Secondary Footer Menu Alignment
    $wp_customize->add_setting('mm_footer_secondary_alignment', array(
        'default'           => 'right',
        'sanitize_callback' => 'mm_sanitize_alignment',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('mm_footer_secondary_alignment', array(
        'type'        => 'select',
        'label'       => __('Secondary Footer Menu Alignment', 'multi-maiven'),
        'section'     => 'mm_footer_builder',
        'description' => __('Set the alignment for the secondary footer menu.', 'multi-maiven'),
        'choices'     => array(
            'left'   => __('Left', 'multi-maiven'),
            'center' => __('Center', 'multi-maiven'),
            'right'  => __('Right', 'multi-maiven'),
        ),
        'priority'    => 25,
    ));

    // === FOOTER STYLING SECTION ===
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'mm_footer_styling_heading', array(
        'type'        => 'hidden',
        'section'     => 'mm_footer_builder',
        'description' => '<h3 style="margin-top:30px;border-bottom:1px solid #ddd;padding-bottom:10px;color:#23282d;">' . __('Footer Styling', 'multi-maiven') . '</h3>',
        'priority'    => 30,
    )));

    // 4. Footer Background Color
    $wp_customize->add_setting('mm_footer_bg_color', array(
        'default'           => '#f8fafc',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mm_footer_bg_color', array(
        'label'    => __('Footer Background Color', 'multi-maiven'),
        'section'  => 'mm_footer_builder',
        'settings' => 'mm_footer_bg_color',
        'priority' => 35,
    )));

    // 5. Footer Text Color
    $wp_customize->add_setting('mm_footer_text_color', array(
        'default'           => '#1e293b',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mm_footer_text_color', array(
        'label'    => __('Footer Text Color', 'multi-maiven'),
        'section'  => 'mm_footer_builder',
        'settings' => 'mm_footer_text_color',
        'priority' => 40,
    )));

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
        'priority'    => 45,
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
        'priority'    => 50,
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
        'priority' => 55,
    ));

    // === ADVERTISEMENT SECTION ===
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'mm_footer_ad_heading', array(
        'type'        => 'hidden',
        'section'     => 'mm_footer_builder',
        'description' => '<h3 style="margin-top:30px;border-bottom:1px solid #ddd;padding-bottom:10px;color:#23282d;">' . __('Footer Advertisement', 'multi-maiven') . '</h3>',
        'priority'    => 60,
    )));

    // 9. Show Footer Ad
    $wp_customize->add_setting('mm_show_footer_ad', array(
        'default'           => true,
        'sanitize_callback' => 'mm_sanitize_checkbox',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('mm_show_footer_ad', array(
        'type'        => 'checkbox',
        'label'       => __('Show Footer Advertisement', 'multi-maiven'),
        'section'     => 'mm_footer_builder',
        'description' => __('Display the footer advertisement area above the bottom footer bar.', 'multi-maiven'),
        'priority'    => 65,
    ));

    // === COPYRIGHT SECTION ===
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'mm_copyright_heading', array(
        'type'        => 'hidden',
        'section'     => 'mm_footer_builder',
        'description' => '<h3 style="margin-top:30px;border-bottom:1px solid #ddd;padding-bottom:10px;color:#23282d;">' . __('Copyright & Footer Text', 'multi-maiven') . '</h3>',
        'priority'    => 70,
    )));

    // 10. Copyright Text Editor
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
        'priority'    => 75,
    ));
    
    // === BOTTOM FOOTER BAR SECTION ===
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'mm_bottom_bar_heading', array(
        'type'        => 'hidden',
        'section'     => 'mm_footer_builder',
        'description' => '<h3 style="margin-top:30px;border-bottom:1px solid #ddd;padding-bottom:10px;color:#23282d;">' . __('Bottom Footer Bar', 'multi-maiven') . '</h3>',
        'priority'    => 80,
    )));
    
    // 11. Enable Bottom Footer Bar
    $wp_customize->add_setting('mm_show_bottom_bar', array(
        'default'           => true,
        'sanitize_callback' => 'mm_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('mm_show_bottom_bar', array(
        'type'    => 'checkbox',
        'label'   => __('Enable Bottom Footer Bar', 'multi-maiven'),
        'section' => 'mm_footer_builder',
        'priority' => 85,
    ));
    
    // 12. Reverse Left/Right Layout
    $wp_customize->add_setting('mm_bottom_bar_reverse_layout', array(
        'default'           => false,
        'sanitize_callback' => 'mm_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('mm_bottom_bar_reverse_layout', array(
        'type'    => 'checkbox',
        'label'   => __('Reverse Left/Right Layout', 'multi-maiven'),
        'section' => 'mm_footer_builder',
        'priority' => 90,
    ));
    
    // 13. Bottom Footer Bar Background Color
    $wp_customize->add_setting('mm_bottom_bar_bg_color', array(
        'default'           => '#f9f9f9',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mm_bottom_bar_bg_color', array(
        'label'    => __('Bottom Footer Bar Background Color', 'multi-maiven'),
        'section'  => 'mm_footer_builder',
        'priority' => 95,
    )));
    
    // 14. Bottom Footer Bar Text Color
    $wp_customize->add_setting('mm_bottom_bar_text_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'mm_bottom_bar_text_color', array(
        'label'    => __('Bottom Footer Bar Text Color', 'multi-maiven'),
        'section'  => 'mm_footer_builder',
        'priority' => 100,
    )));
    
    // 15. Left Content
    $wp_customize->add_setting('mm_bottom_bar_left', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('mm_bottom_bar_left', array(
        'type'        => 'textarea',
        'label'       => __('Left Content (e.g. Footer Menu)', 'multi-maiven'),
        'section'     => 'mm_footer_builder',
        'description' => __('Enter content for the left side of the bottom footer bar. HTML is allowed. If left empty and a footer menu is set, it will display the footer menu.', 'multi-maiven'),
        'priority'    => 105,
    ));
    
    // 16. Right Content
    $wp_customize->add_setting('mm_bottom_bar_right', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('mm_bottom_bar_right', array(
        'type'        => 'textarea',
        'label'       => __('Right Content (e.g. Social Icons)', 'multi-maiven'),
        'section'     => 'mm_footer_builder',
        'description' => __('Enter content for the right side of the bottom footer bar. HTML is allowed.', 'multi-maiven'),
        'priority'    => 110,
    ));
}
add_action('customize_register', 'mm_footer_builder_customize_register');

/**
 * Sanitization functions for footer builder
 */
function mm_sanitize_footer_columns($input) {
    $valid_columns = array(1, 2, 3, 4);
    return in_array((int)$input, $valid_columns) ? (int)$input : 3;
}

function mm_sanitize_alignment($input) {
    $valid_alignments = array('left', 'center', 'right');
    return in_array($input, $valid_alignments) ? $input : 'left';
}

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
    $footer_columns = get_theme_mod('mm_footer_column_count', 3);
    $primary_alignment = get_theme_mod('mm_footer_primary_alignment', 'left');
    $secondary_alignment = get_theme_mod('mm_footer_secondary_alignment', 'right');
    $show_footer_ad = get_theme_mod('mm_show_footer_ad', true);
    
    $border_style = $footer_border ? '1px solid var(--mm-color-border)' : 'none';
    
    ?>
    <style type="text/css">
        .site-footer {
            background-color: <?php echo esc_attr($footer_bg_color); ?>;
            color: <?php echo esc_attr($footer_text_color); ?>;
            padding-top: <?php echo esc_attr($footer_padding_top); ?>px;
            padding-bottom: <?php echo esc_attr($footer_padding_bottom); ?>px;
            border-top: <?php echo esc_attr($border_style); ?>;
        }
        .site-footer a {
            color: <?php echo esc_attr($footer_text_color); ?>;
            text-decoration: underline;
        }
        .site-footer a:hover {
            opacity: 0.8;
        }
        
        /* Footer Columns Layout */
        .footer-columns {
            display: grid;
            grid-template-columns: repeat(<?php echo esc_attr($footer_columns); ?>, 1fr);
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        /* Footer Menus Container */
        .footer-menus-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        /* Primary Footer Menu Alignment */
        .footer-menu-align-left {
            text-align: left;
            justify-content: flex-start;
        }
        .footer-menu-align-center {
            text-align: center;
            justify-content: center;
        }
        .footer-menu-align-right {
            text-align: right;
            justify-content: flex-end;
        }
        
        /* Footer Menu Styling */
        .footer-navigation {
            flex: 1;
        }
        .footer-navigation ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
        }
        .footer-navigation li {
            margin: 0 0.75em 0.5em 0;
        }
        .footer-navigation a {
            text-decoration: none;
            display: inline-block;
            padding: 0.25em 0;
        }
        .footer-navigation a:hover {
            text-decoration: underline;
        }
        
        /* Hide footer ad if disabled */
        <?php if (!$show_footer_ad): ?>
        .responsive-footer-ad {
            display: none !important;
        }
        <?php endif; ?>
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .footer-columns {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .footer-menus-container {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            
            .footer-navigation ul {
                justify-content: center;
            }
        }
    </style>
    <?php
}

/**
 * Render footer columns with widget areas
 */
function mm_render_footer_columns() {
    $footer_columns = get_theme_mod('mm_footer_column_count', 3);
    
    if ($footer_columns < 1) {
        return;
    }
    
    echo '<div class="footer-columns">';
    
    for ($i = 1; $i <= $footer_columns; $i++) {
        $sidebar_id = 'footer-column-' . $i;
        
        if (is_active_sidebar($sidebar_id)) {
            echo '<div class="footer-column footer-column-' . esc_attr($i) . '">';
            dynamic_sidebar($sidebar_id);
            echo '</div>';
        }
    }
    
    echo '</div>';
}

/**
 * Render footer menus with alignment
 */
function mm_render_footer_menus() {
    $primary_alignment = get_theme_mod('mm_footer_primary_alignment', 'left');
    $secondary_alignment = get_theme_mod('mm_footer_secondary_alignment', 'right');
    
    // Check if either menu has content
    $has_primary = has_nav_menu('footer-primary');
    $has_secondary = has_nav_menu('footer-secondary');
    
    if (!$has_primary && !$has_secondary) {
        return;
    }
    
    echo '<div class="footer-menus-container">';
    
    // Primary Footer Menu
    if ($has_primary) {
        echo '<div class="footer-primary-menu">';
        mm_display_footer_menu_with_alignment('footer-primary', $primary_alignment, 'footer-primary');
        echo '</div>';
    }
    
    // Secondary Footer Menu
    if ($has_secondary) {
        echo '<div class="footer-secondary-menu">';
        mm_display_footer_menu_with_alignment('footer-secondary', $secondary_alignment, 'footer-secondary');
        echo '</div>';
    }
    
    echo '</div>';
}

/**
 * Enqueue footer builder JavaScript
 */
function mm_footer_builder_scripts() {
    if (is_customize_preview()) {
        $theme = wp_get_theme();
        $version = $theme->get('Version');
        wp_enqueue_script('mm-footer-builder', get_template_directory_uri() . '/js/footer-builder.js', array('customize-preview', 'jquery'), $version, true);
    }
}
add_action('customize_preview_init', 'mm_footer_builder_scripts');