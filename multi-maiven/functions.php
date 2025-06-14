<?php
/**
 * Multi Maiven functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Multi_Maiven
 */

if ( ! defined( 'MULTI_MAIVEN_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'MULTI_MAIVEN_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function multi_maiven_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'multi-maiven', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Add support for block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Register menus
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'multi-maiven' ),
			'footer'  => esc_html__( 'Footer Menu', 'multi-maiven' ),
		)
	);
}
add_action( 'after_setup_theme', 'multi_maiven_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function multi_maiven_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Primary Sidebar', 'multi-maiven' ),
			'id'            => 'primary-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'multi-maiven' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'multi_maiven_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function multi_maiven_scripts() {
	// Enqueue main stylesheet
	wp_enqueue_style( 'multi-maiven-style', get_stylesheet_uri(), array(), MULTI_MAIVEN_VERSION );
	
	// Enqueue custom CSS
	wp_enqueue_style( 'multi-maiven-custom', get_template_directory_uri() . '/assets/css/custom.css', array(), MULTI_MAIVEN_VERSION );
	
	// Enqueue main JavaScript file
	wp_enqueue_script( 'multi-maiven-script', get_template_directory_uri() . '/assets/js/main.js', array(), MULTI_MAIVEN_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'multi_maiven_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Block Patterns.
 */
require get_template_directory() . '/inc/block-patterns.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Dequeue unnecessary block styles.
 */
function multi_maiven_dequeue_block_styles() {
	// Keep only core block styles
	wp_dequeue_style( 'wp-block-library-theme' );
	
	// Add more dequeues here as needed
}
add_action( 'wp_enqueue_scripts', 'multi_maiven_dequeue_block_styles', 100 );

/**
 * Load Google Fonts asynchronously.
 */
function multi_maiven_load_google_fonts() {
	// Get the font family from customizer
	$google_font_family = get_theme_mod('google_font_family', 'Roboto');
	$google_font_family_slug = str_replace(' ', '+', $google_font_family);
	
	// Add preconnect for Google Fonts
	add_filter('wp_resource_hints', function($urls, $relation_type) {
		if ('preconnect' === $relation_type) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		}
		return $urls;
	}, 10, 2);
	
	// Enqueue the font with display=swap for better performance
	wp_enqueue_style(
		'multi-maiven-google-fonts',
		"https://fonts.googleapis.com/css2?family={$google_font_family_slug}:wght@400;500;700&display=swap",
		array(),
		MULTI_MAIVEN_VERSION
	);
}
add_action('wp_enqueue_scripts', 'multi_maiven_load_google_fonts');
