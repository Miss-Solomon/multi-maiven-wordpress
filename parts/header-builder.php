<?php
/**
 * Header Builder
 *
 * @package Multi_Maiven
 */

/**
 * Header builder class
 */
class Multi_Maiven_Header_Builder {
    /**
     * Instance
     *
     * @var object
     */
    private static $instance;

    /**
     * Get instance
     */
    public static function get_instance() {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     */
    public function __construct() {
        // Register hooks
        add_action( 'wp_head', array( $this, 'header_styles' ) );
        add_action( 'mm_before_header', array( $this, 'top_bar' ), 10 );
        add_action( 'mm_header', array( $this, 'header_markup' ), 10 );
        add_action( 'mm_after_header', array( $this, 'after_header' ), 10 );
    }

    /**
     * Add custom header styles
     */
    public function header_styles() {
        // Get customizer settings
        $sticky_header = get_theme_mod( 'mm_sticky_header', false );
        $transparent_header = get_theme_mod( 'mm_transparent_header', false );
        $header_padding_top = get_theme_mod( 'mm_header_padding_top', '20' );
        $header_padding_bottom = get_theme_mod( 'mm_header_padding_bottom', '20' );
        $header_border = get_theme_mod( 'mm_header_border', true );
        $header_bg_color = get_theme_mod( 'mm_header_bg_color', '#ffffff' );
        
        // Top bar styles
        $show_top_bar = get_theme_mod( 'show_top_bar', true );
        $top_bar_bg_color = get_theme_mod( 'top_bar_bg_color', '#f9f9f9' );
        $top_bar_text_color = get_theme_mod( 'top_bar_text_color', '#333333' );
        
        // Add custom classes to body
        add_filter( 'body_class', function( $classes ) use ( $sticky_header, $transparent_header ) {
            if ( $sticky_header ) {
                $classes[] = 'has-sticky-header';
            }
            
            if ( $transparent_header && is_front_page() ) {
                $classes[] = 'has-transparent-header';
            }
            
            return $classes;
        } );
        
        // Prepare custom CSS
        $custom_css = '';
        
        // Header styles
        $custom_css .= ".site-header { background-color: {$header_bg_color}; }";
        $custom_css .= ".header-container { padding-top: {$header_padding_top}px; padding-bottom: {$header_padding_bottom}px; }";
        $custom_css .= ".header-container { border-bottom: " . ($header_border ? '1px solid var(--mm-color-border, #e9e9e9)' : 'none') . "; }";
        
        // Top bar styles
        if ( $show_top_bar ) {
            $custom_css .= ".top-bar { background-color: {$top_bar_bg_color}; color: {$top_bar_text_color}; }";
        }
        
        // Sticky header styles
        if ( $sticky_header ) {
            $custom_css .= '.site-header { position: sticky; top: 0; z-index: 1000; }';
            $custom_css .= '.admin-bar .site-header { top: 32px; }';
            $custom_css .= '@media screen and (max-width: 782px) { .admin-bar .site-header { top: 46px; } }';
        }
        
        // Transparent header styles
        if ( $transparent_header && is_front_page() ) {
            $custom_css .= '.site-header { background-color: transparent; position: absolute; width: 100%; }';
            $custom_css .= '.site-header .site-title a, .site-header .site-description, .site-header .main-navigation a { color: #fff; }';
        }
        
        // Output the CSS if not empty
        if ( ! empty( $custom_css ) ) {
            echo '<style type="text/css">' . $custom_css . '</style>';
        }
    }

    /**
     * Top bar markup
     */
    public function top_bar() {
        $show_top_bar = get_theme_mod( 'show_top_bar', true );
        $top_bar_logged_in_only = get_theme_mod( 'top_bar_logged_in_only', false );
        $top_bar_reverse_layout = get_theme_mod( 'top_bar_reverse_layout', false );
        
        // Check if top bar should be displayed
        if ( ! $show_top_bar ) {
            return;
        }
        
        // Check if top bar should only be shown to logged-in users
        if ( $top_bar_logged_in_only && ! is_user_logged_in() ) {
            return;
        }
        
        // Get top bar content
        $top_bar_left = get_theme_mod( 'top_bar_left', '' );
        $top_bar_center = get_theme_mod( 'top_bar_center', '' );
        $top_bar_right = get_theme_mod( 'top_bar_right', '' );
        
        // Reverse layout if needed
        if ( $top_bar_reverse_layout ) {
            $temp = $top_bar_left;
            $top_bar_left = $top_bar_right;
            $top_bar_right = $temp;
        }
        
        // Only display if there's content
        if ( empty( $top_bar_left ) && empty( $top_bar_center ) && empty( $top_bar_right ) ) {
            return;
        }
        
        ?>
        <div class="top-bar">
            <div class="container">
                <div class="top-bar-content">
                    <?php if ( ! empty( $top_bar_left ) ) : ?>
                        <div class="top-bar-left">
                            <?php echo wp_kses_post( $top_bar_left ); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ( ! empty( $top_bar_center ) ) : ?>
                        <div class="top-bar-center">
                            <?php echo wp_kses_post( $top_bar_center ); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ( ! empty( $top_bar_right ) ) : ?>
                        <div class="top-bar-right">
                            <?php echo wp_kses_post( $top_bar_right ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Header markup
     */
    public function header_markup() {
        // Get header layout settings
        $header_layout = get_theme_mod( 'mm_header_layout', 'default' );
        $logo_position = get_theme_mod( 'mm_logo_position', 'left' );
        $menu_position = get_theme_mod( 'mm_menu_position', 'right' );
        $sticky_header = get_theme_mod( 'mm_sticky_header', false );
        $transparent_header = get_theme_mod( 'mm_transparent_header', false );
        $header_image = get_theme_mod( 'header_image', '' );
        
        // Header classes
        $header_classes = array( 'site-header' );
        $header_classes[] = 'header-layout-' . $header_layout;
        
        if ( $sticky_header ) {
            $header_classes[] = 'sticky-header';
        }
        
        if ( $transparent_header && is_front_page() ) {
            $header_classes[] = 'transparent-header';
        }
        
        // Container classes
        $container_classes = array( 'header-container' );
        
        if ( $header_layout === 'centered' ) {
            $container_classes[] = 'flex-column';
        } else {
            $container_classes[] = 'flex-row';
        }
        
        // Branding classes
        $branding_classes = array( 'site-branding' );
        
        if ( $logo_position === 'center' ) {
            $branding_classes[] = 'text-center';
        } else {
            $branding_classes[] = 'text-left';
        }
        
        // Navigation classes
        $nav_classes = array( 'main-navigation' );
        $nav_classes[] = 'menu-' . $menu_position;
        
        // Header background image
        $header_style = '';
        if ( ! empty( $header_image ) ) {
            $header_style = ' style="background-image: url(' . esc_url( $header_image ) . ');"';
        }
        
        ?>
        <header id="masthead" class="<?php echo esc_attr( implode( ' ', $header_classes ) ); ?>"<?php echo $header_style; ?>>
            <div class="container">
                <div class="<?php echo esc_attr( implode( ' ', $container_classes ) ); ?>">
                    <?php if ( $header_layout === 'split' ) : ?>
                        <!-- Split menu layout -->
                        <nav class="split-menu left-menu">
                            <?php
                            $left_menu = get_theme_mod( 'mm_left_menu', '' );
                            if ( ! empty( $left_menu ) ) {
                                wp_nav_menu(
                                    array(
                                        'menu'           => $left_menu,
                                        'container'      => false,
                                        'menu_class'     => 'menu left-header-menu',
                                        'theme_location' => 'none',
                                    )
                                );
                            }
                            ?>
                        </nav>
                    <?php endif; ?>
                    
                    <div class="<?php echo esc_attr( implode( ' ', $branding_classes ) ); ?>">
                        <?php
                        if ( has_custom_logo() ) :
                            the_custom_logo();
                        else :
                            ?>
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                            <?php
                            $multi_maiven_description = get_bloginfo( 'description', 'display' );
                            if ( $multi_maiven_description || is_customize_preview() ) :
                                ?>
                                <p class="site-description"><?php echo $multi_maiven_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div><!-- .site-branding -->

                    <nav id="site-navigation" class="<?php echo esc_attr( implode( ' ', $nav_classes ) ); ?>">
                        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                            <span class="screen-reader-text"><?php esc_html_e( 'Menu', 'multi-maiven' ); ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <rect x="2" y="5" width="20" height="2"></rect>
                                <rect x="2" y="11" width="20" height="2"></rect>
                                <rect x="2" y="17" width="20" height="2"></rect>
                            </svg>
                        </button>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'menu_id'        => 'primary-menu',
                                'container'      => false,
                                'fallback_cb'    => function() {
                                    echo '<ul id="primary-menu" class="menu">';
                                    echo '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Add a menu', 'multi-maiven' ) . '</a></li>';
                                    echo '</ul>';
                                },
                            )
                        );
                        ?>
                    </nav><!-- #site-navigation -->
                    
                    <?php do_action( 'mm_header_extras' ); ?>
                </div><!-- .header-container -->
            </div><!-- .container -->
        </header><!-- #masthead -->
        <?php
    }

    /**
     * After header markup
     */
    public function after_header() {
        // Add any additional markup after the header
    }
}

// Initialize the header builder
Multi_Maiven_Header_Builder::get_instance();

/**
 * Add dark mode toggle to header extras
 */
function multi_maiven_dark_mode_toggle() {
    $enable_dark_mode = get_theme_mod( 'dark_mode_toggle', true );
    $dark_mode_toggle_position = get_theme_mod( 'dark_mode_toggle_position', 'header' );
    
    if ( ! $enable_dark_mode || ( $dark_mode_toggle_position !== 'header' && $dark_mode_toggle_position !== 'both' ) ) {
        return;
    }
    
    ?>
    <div class="dark-mode-toggle-container header-toggle">
        <button class="dark-mode-toggle" aria-label="<?php esc_attr_e( 'Toggle Dark Mode', 'multi-maiven' ); ?>" title="<?php esc_attr_e( 'Toggle Dark Mode', 'multi-maiven' ); ?>">
            <span class="toggle-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path class="sun-icon" d="M12 18a6 6 0 1 1 0-12 6 6 0 0 1 0 12zm0-2a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM11 1h2v3h-2V1zm0 19h2v3h-2v-3zM3.515 4.929l1.414-1.414L7.05 5.636 5.636 7.05 3.515 4.93zM16.95 18.364l1.414-1.414 2.121 2.121-1.414 1.414-2.121-2.121zm2.121-14.85l1.414 1.415-2.121 2.121-1.414-1.414 2.121-2.121zM5.636 16.95l1.414 1.414-2.121 2.121-1.414-1.414 2.121-2.121zM23 11v2h-3v-2h3zM4 11v2H1v-2h3z"/>
                    <path class="moon-icon" d="M10 7a7 7 0 0 0 12 4.9v.1c0 5.523-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2h.1A6.979 6.979 0 0 0 10 7z"/>
                </svg>
            </span>
        </button>
    </div>
    <?php
}
add_action( 'mm_header_extras', 'multi_maiven_dark_mode_toggle' );

/**
 * Localize dark mode settings
 */
function multi_maiven_localize_dark_mode_settings() {
    $enable_dark_mode = get_theme_mod( 'dark_mode_toggle', true );
    
    if ( ! $enable_dark_mode ) {
        return;
    }
    
    $dark_mode_default = get_theme_mod( 'dark_mode_default', 'light' );
    $dark_mode_toggle_position = get_theme_mod( 'dark_mode_toggle_position', 'header' );
    
    // Prepare labels and icons for the toggle
    $labels = array(
        'dark' => esc_html__( 'Dark Mode', 'multi-maiven' ),
        'light' => esc_html__( 'Light Mode', 'multi-maiven' ),
    );
    
    // SVG icons for light/dark mode
    $icons = array(
        'dark' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="sun-icon" d="M12 18a6 6 0 1 1 0-12 6 6 0 0 1 0 12zm0-2a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM11 1h2v3h-2V1zm0 19h2v3h-2v-3zM3.515 4.929l1.414-1.414L7.05 5.636 5.636 7.05 3.515 4.93zM16.95 18.364l1.414-1.414 2.121 2.121-1.414 1.414-2.121-2.121zm2.121-14.85l1.414 1.415-2.121 2.121-1.414-1.414 2.121-2.121zM5.636 16.95l1.414 1.414-2.121 2.121-1.414-1.414 2.121-2.121zM23 11v2h-3v-2h3zM4 11v2H1v-2h3z"/></svg>',
        'light' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="moon-icon" d="M10 7a7 7 0 0 0 12 4.9v.1c0 5.523-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2h.1A6.979 6.979 0 0 0 10 7z"/></svg>',
    );
    
    wp_localize_script( 'multi-maiven-dark-mode', 'multiMaivenDarkMode', array(
        'defaultMode'    => $dark_mode_default,
        'togglePosition' => $dark_mode_toggle_position,
        'labels'         => $labels,
        'icons'          => $icons,
    ) );
}
add_action( 'wp_enqueue_scripts', 'multi_maiven_localize_dark_mode_settings', 20 );
