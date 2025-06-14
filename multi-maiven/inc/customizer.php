<?php
/**
 * Multi Maiven Theme Customizer
 *
 * @package Multi_Maiven
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function multi_maiven_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'multi_maiven_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'multi_maiven_customize_partial_blogdescription',
			)
		);
	}

	// Add Colors Section
	$wp_customize->add_section(
		'multi_maiven_colors',
		array(
			'title'    => __( 'Colors', 'multi-maiven' ),
			'priority' => 30,
		)
	);

	// Header Background Color
	$wp_customize->add_setting(
		'header_bg_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_bg_color',
			array(
				'label'    => __( 'Header Background Color', 'multi-maiven' ),
				'section'  => 'multi_maiven_colors',
				'settings' => 'header_bg_color',
			)
		)
	);

	// Footer Background Color
	$wp_customize->add_setting(
		'footer_bg_color',
		array(
			'default'           => '#f8f9fa',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_bg_color',
			array(
				'label'    => __( 'Footer Background Color', 'multi-maiven' ),
				'section'  => 'multi_maiven_colors',
				'settings' => 'footer_bg_color',
			)
		)
	);

	// Body Background Color
	$wp_customize->add_setting(
		'body_bg_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'body_bg_color',
			array(
				'label'    => __( 'Body Background Color', 'multi-maiven' ),
				'section'  => 'multi_maiven_colors',
				'settings' => 'body_bg_color',
			)
		)
	);

	// Link Color
	$wp_customize->add_setting(
		'link_color',
		array(
			'default'           => '#0d6efd',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_color',
			array(
				'label'    => __( 'Link Color', 'multi-maiven' ),
				'section'  => 'multi_maiven_colors',
				'settings' => 'link_color',
			)
		)
	);

	// Link Hover Color
	$wp_customize->add_setting(
		'link_hover_color',
		array(
			'default'           => '#0a58ca',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_hover_color',
			array(
				'label'    => __( 'Link Hover Color', 'multi-maiven' ),
				'section'  => 'multi_maiven_colors',
				'settings' => 'link_hover_color',
			)
		)
	);

	// Add Typography Section
	$wp_customize->add_section(
		'multi_maiven_typography',
		array(
			'title'    => __( 'Typography', 'multi-maiven' ),
			'priority' => 40,
		)
	);

	// Google Font Family
	$wp_customize->add_setting(
		'google_font_family',
		array(
			'default'           => 'Roboto',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'google_font_family',
		array(
			'label'    => __( 'Google Font Family', 'multi-maiven' ),
			'section'  => 'multi_maiven_typography',
			'settings' => 'google_font_family',
			'type'     => 'select',
			'choices'  => array(
				'Roboto'      => 'Roboto',
				'Open Sans'   => 'Open Sans',
				'Lato'        => 'Lato',
				'Montserrat'  => 'Montserrat',
				'Raleway'     => 'Raleway',
				'Poppins'     => 'Poppins',
				'Source Sans Pro' => 'Source Sans Pro',
				'Nunito'      => 'Nunito',
				'Ubuntu'      => 'Ubuntu',
				'Playfair Display' => 'Playfair Display',
			),
		)
	);

	// Base Font Size
	$wp_customize->add_setting(
		'base_font_size',
		array(
			'default'           => '16',
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'base_font_size',
		array(
			'label'    => __( 'Base Font Size (px)', 'multi-maiven' ),
			'section'  => 'multi_maiven_typography',
			'settings' => 'base_font_size',
			'type'     => 'number',
			'input_attrs' => array(
				'min'  => 12,
				'max'  => 24,
				'step' => 1,
			),
		)
	);

	// Headings Font Size
	$wp_customize->add_setting(
		'headings_font_size',
		array(
			'default'           => '32',
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'headings_font_size',
		array(
			'label'    => __( 'Headings Base Size (px)', 'multi-maiven' ),
			'description' => __( 'This sets the base size for h1. Other headings are proportionally sized.', 'multi-maiven' ),
			'section'  => 'multi_maiven_typography',
			'settings' => 'headings_font_size',
			'type'     => 'number',
			'input_attrs' => array(
				'min'  => 20,
				'max'  => 48,
				'step' => 1,
			),
		)
	);

	// Add Layout Section
	$wp_customize->add_section(
		'multi_maiven_layout',
		array(
			'title'    => __( 'Layout', 'multi-maiven' ),
			'priority' => 50,
		)
	);

	// Sidebar Position
	$wp_customize->add_setting(
		'sidebar_position',
		array(
			'default'           => 'right',
			'sanitize_callback' => 'multi_maiven_sanitize_select',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'sidebar_position',
		array(
			'label'    => __( 'Sidebar Position', 'multi-maiven' ),
			'section'  => 'multi_maiven_layout',
			'settings' => 'sidebar_position',
			'type'     => 'select',
			'choices'  => array(
				'left'  => __( 'Left', 'multi-maiven' ),
				'right' => __( 'Right', 'multi-maiven' ),
				'none'  => __( 'None', 'multi-maiven' ),
			),
		)
	);

	// Logo Alignment
	$wp_customize->add_setting(
		'logo_alignment',
		array(
			'default'           => 'left',
			'sanitize_callback' => 'multi_maiven_sanitize_select',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'logo_alignment',
		array(
			'label'    => __( 'Logo Alignment', 'multi-maiven' ),
			'section'  => 'multi_maiven_layout',
			'settings' => 'logo_alignment',
			'type'     => 'select',
			'choices'  => array(
				'left'   => __( 'Left', 'multi-maiven' ),
				'center' => __( 'Center', 'multi-maiven' ),
			),
		)
	);

	// Menu Alignment
	$wp_customize->add_setting(
		'menu_alignment',
		array(
			'default'           => 'right',
			'sanitize_callback' => 'multi_maiven_sanitize_select',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'menu_alignment',
		array(
			'label'    => __( 'Menu Alignment', 'multi-maiven' ),
			'section'  => 'multi_maiven_layout',
			'settings' => 'menu_alignment',
			'type'     => 'select',
			'choices'  => array(
				'left'   => __( 'Left', 'multi-maiven' ),
				'center' => __( 'Center', 'multi-maiven' ),
				'right'  => __( 'Right', 'multi-maiven' ),
			),
		)
	);

	// Add Dark Mode Section
	$wp_customize->add_section(
		'multi_maiven_dark_mode',
		array(
			'title'    => __( 'Dark Mode', 'multi-maiven' ),
			'priority' => 60,
		)
	);

	// Dark Mode Toggle
	$wp_customize->add_setting(
		'dark_mode_toggle',
		array(
			'default'           => true,
			'sanitize_callback' => 'multi_maiven_sanitize_checkbox',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'dark_mode_toggle',
		array(
			'label'    => __( 'Enable Dark Mode Toggle', 'multi-maiven' ),
			'section'  => 'multi_maiven_dark_mode',
			'settings' => 'dark_mode_toggle',
			'type'     => 'checkbox',
		)
	);

	// Dark Mode Default
	$wp_customize->add_setting(
		'dark_mode_default',
		array(
			'default'           => 'light',
			'sanitize_callback' => 'multi_maiven_sanitize_select',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'dark_mode_default',
		array(
			'label'    => __( 'Default Mode', 'multi-maiven' ),
			'section'  => 'multi_maiven_dark_mode',
			'settings' => 'dark_mode_default',
			'type'     => 'select',
			'choices'  => array(
				'light' => __( 'Light', 'multi-maiven' ),
				'dark'  => __( 'Dark', 'multi-maiven' ),
			),
		)
	);

	// Dark Mode Toggle Position
	$wp_customize->add_setting(
		'dark_mode_toggle_position',
		array(
			'default'           => 'header',
			'sanitize_callback' => 'multi_maiven_sanitize_select',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'dark_mode_toggle_position',
		array(
			'label'    => __( 'Toggle Position', 'multi-maiven' ),
			'section'  => 'multi_maiven_dark_mode',
			'settings' => 'dark_mode_toggle_position',
			'type'     => 'select',
			'choices'  => array(
				'header' => __( 'Header', 'multi-maiven' ),
				'footer' => __( 'Footer', 'multi-maiven' ),
				'both'   => __( 'Both', 'multi-maiven' ),
			),
		)
	);

	// Add Header Builder Section
	$wp_customize->add_section(
		'multi_maiven_header_builder',
		array(
			'title'    => __( 'Header Builder', 'multi-maiven' ),
			'priority' => 70,
		)
	);

	// Enable Top Bar
	$wp_customize->add_setting(
		'enable_top_bar',
		array(
			'default'           => false,
			'sanitize_callback' => 'multi_maiven_sanitize_checkbox',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'enable_top_bar',
		array(
			'label'    => __( 'Enable Top Bar', 'multi-maiven' ),
			'section'  => 'multi_maiven_header_builder',
			'settings' => 'enable_top_bar',
			'type'     => 'checkbox',
		)
	);

	// Top Bar Content
	$wp_customize->add_setting(
		'top_bar_content',
		array(
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'top_bar_content',
		array(
			'label'    => __( 'Top Bar Content', 'multi-maiven' ),
			'section'  => 'multi_maiven_header_builder',
			'settings' => 'top_bar_content',
			'type'     => 'textarea',
		)
	);

	// Sticky Header
	$wp_customize->add_setting(
		'sticky_header',
		array(
			'default'           => false,
			'sanitize_callback' => 'multi_maiven_sanitize_checkbox',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'sticky_header',
		array(
			'label'    => __( 'Enable Sticky Header', 'multi-maiven' ),
			'section'  => 'multi_maiven_header_builder',
			'settings' => 'sticky_header',
			'type'     => 'checkbox',
		)
	);

	// Transparent Header
	$wp_customize->add_setting(
		'transparent_header',
		array(
			'default'           => false,
			'sanitize_callback' => 'multi_maiven_sanitize_checkbox',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'transparent_header',
		array(
			'label'    => __( 'Enable Transparent Header on Homepage', 'multi-maiven' ),
			'section'  => 'multi_maiven_header_builder',
			'settings' => 'transparent_header',
			'type'     => 'checkbox',
		)
	);

	// Add Footer Builder Section
	$wp_customize->add_section(
		'multi_maiven_footer_builder',
		array(
			'title'    => __( 'Footer Builder', 'multi-maiven' ),
			'priority' => 80,
		)
	);

	// Footer Columns
	$wp_customize->add_setting(
		'footer_columns',
		array(
			'default'           => '4',
			'sanitize_callback' => 'multi_maiven_sanitize_select',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'footer_columns',
		array(
			'label'    => __( 'Footer Widget Columns', 'multi-maiven' ),
			'section'  => 'multi_maiven_footer_builder',
			'settings' => 'footer_columns',
			'type'     => 'select',
			'choices'  => array(
				'1' => __( '1 Column', 'multi-maiven' ),
				'2' => __( '2 Columns', 'multi-maiven' ),
				'3' => __( '3 Columns', 'multi-maiven' ),
				'4' => __( '4 Columns', 'multi-maiven' ),
			),
		)
	);

	// Footer Copyright
	$wp_customize->add_setting(
		'footer_copyright',
		array(
			'default'           => sprintf( __( '© %s - Multi Maiven Theme', 'multi-maiven' ), date( 'Y' ) ),
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'footer_copyright',
		array(
			'label'    => __( 'Footer Copyright Text', 'multi-maiven' ),
			'section'  => 'multi_maiven_footer_builder',
			'settings' => 'footer_copyright',
			'type'     => 'textarea',
		)
	);

	// Footer Credits
	$wp_customize->add_setting(
		'footer_credits',
		array(
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'footer_credits',
		array(
			'label'    => __( 'Footer Credits', 'multi-maiven' ),
			'section'  => 'multi_maiven_footer_builder',
			'settings' => 'footer_credits',
			'type'     => 'textarea',
		)
	);
}
add_action( 'customize_register', 'multi_maiven_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function multi_maiven_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function multi_maiven_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function multi_maiven_customize_preview_js() {
	wp_enqueue_script( 'multi-maiven-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'multi_maiven_customize_preview_js' );

/**
 * Sanitize select field.
 *
 * @param string $input   The input from the setting.
 * @param object $setting The selected setting.
 *
 * @return string $input|$setting->default The input from the setting or the default setting.
 */
function multi_maiven_sanitize_select( $input, $setting ) {
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Sanitize checkbox field.
 *
 * @param bool $checked Whether or not a box is checked.
 *
 * @return bool
 */
function multi_maiven_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Output the CSS variables for the theme.
 */
function multi_maiven_customizer_css() {
	// Get the colors from the customizer.
	$header_bg_color = get_theme_mod( 'header_bg_color', '#ffffff' );
	$footer_bg_color = get_theme_mod( 'footer_bg_color', '#f8f9fa' );
	$body_bg_color = get_theme_mod( 'body_bg_color', '#ffffff' );
	$link_color = get_theme_mod( 'link_color', '#0d6efd' );
	$link_hover_color = get_theme_mod( 'link_hover_color', '#0a58ca' );

	// Get the typography from the customizer.
	$google_font_family = get_theme_mod( 'google_font_family', 'Roboto' );
	$base_font_size = get_theme_mod( 'base_font_size', '16' );
	$headings_font_size = get_theme_mod( 'headings_font_size', '32' );

	// Get the layout from the customizer.
	$logo_alignment = get_theme_mod( 'logo_alignment', 'left' );
	$menu_alignment = get_theme_mod( 'menu_alignment', 'right' );

	// Calculate heading sizes
	$h1_size = $headings_font_size . 'px';
	$h2_size = round( $headings_font_size * 0.8 ) . 'px';
	$h3_size = round( $headings_font_size * 0.7 ) . 'px';
	$h4_size = round( $headings_font_size * 0.6 ) . 'px';
	$h5_size = round( $headings_font_size * 0.5 ) . 'px';
	$h6_size = round( $headings_font_size * 0.4 ) . 'px';

	// Prepare the CSS.
	$css = "
	:root {
		--mm-header-bg-color: {$header_bg_color};
		--mm-footer-bg-color: {$footer_bg_color};
		--mm-body-bg-color: {$body_bg_color};
		--mm-link-color: {$link_color};
		--mm-link-hover-color: {$link_hover_color};
		--mm-font-family: '{$google_font_family}', sans-serif;
		--mm-base-font-size: {$base_font_size}px;
		--mm-h1-font-size: {$h1_size};
		--mm-h2-font-size: {$h2_size};
		--mm-h3-font-size: {$h3_size};
		--mm-h4-font-size: {$h4_size};
		--mm-h5-font-size: {$h5_size};
		--mm-h6-font-size: {$h6_size};
	}

	body {
		font-family: var(--mm-font-family);
		font-size: var(--mm-base-font-size);
		background-color: var(--mm-body-bg-color);
	}

	.site-header {
		background-color: var(--mm-header-bg-color);
	}

	.site-footer {
		background-color: var(--mm-footer-bg-color);
	}

	a {
		color: var(--mm-link-color);
	}

	a:hover, a:focus {
		color: var(--mm-link-hover-color);
	}

	h1 { font-size: var(--mm-h1-font-size); }
	h2 { font-size: var(--mm-h2-font-size); }
	h3 { font-size: var(--mm-h3-font-size); }
	h4 { font-size: var(--mm-h4-font-size); }
	h5 { font-size: var(--mm-h5-font-size); }
	h6 { font-size: var(--mm-h6-font-size); }

	.site-branding {
		text-align: {$logo_alignment};
	}

	.main-navigation {
		text-align: {$menu_alignment};
	}
	";

	// Output the CSS.
	wp_add_inline_style( 'multi-maiven-style', $css );
}
add_action( 'wp_enqueue_scripts', 'multi_maiven_customizer_css' );

/**
 * Note: Google Fonts loading is now handled in functions.php with the multi_maiven_load_google_fonts() function
 * which implements preconnect and font-display:swap for better performance.
 */
