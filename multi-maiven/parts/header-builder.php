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
        $sticky_header = get_theme_mod( 'sticky_header', false );
        $transparent_header = get_theme_mod( 'transparent_header', false );
        
        // Add custom classes to body
        add_filter( 'body_class', function( $classes ) use ( $sticky_header, $transparent_header ) {
            if ( $sticky_header ) {
                $classes[] = 'has-sticky-header';
            }
            
            if ( $transparent_header ) {
                $classes[] = 'has-transparent-header';
            }
            
            return $classes;
        } );
        
        // Add inline styles if needed
        if ( $sticky_header || $transparent_header ) {
            $custom_css = '';
            
            if ( $sticky_header ) {
                $custom_css .= '.site-header { position: sticky; top: 0; z-index: 1000; }';
                $custom_css .= '.admin-bar .site-header { top: 32px; }';
                $custom_css .= '@media screen and (max-width: 782px) { .admin-bar .site-header { top: 46px; } }';
            }
            
            if ( $transparent_header ) {
                $custom_css .= '.site-header { background-color: transparent; position: absolute; width: 100%; }';
                $custom_css .= '.site-header .site-title a, .site-header .site-description, .site-header .main-navigation a { color: #fff; }';
            }
            
            if ( ! empty( $custom_css ) ) {
                echo '<style type="text/css">' . $custom_css . '</style>';
            }
        }
    }

    /**
     * Top bar markup
     */
    public function top_bar() {
        $enable_top_bar = get_theme_mod( 'enable_top_bar', false );
        $top_bar_content = get_theme_mod( 'top_bar_content', '' );
        
        if ( ! $enable_top_bar ) {
            return;
        }
        
        ?>
        <div class="top-bar">
            <div class="container">
                <?php echo wp_kses_post( $top_bar_content ); ?>
            </div>
        </div>
        <?php
    }

    /**
     * Header markup
     */
    public function header_markup() {
        $logo_alignment = get_theme_mod( 'logo_alignment', 'left' );
        $menu_alignment = get_theme_mod( 'menu_alignment', 'right' );
        $sticky_header = get_theme_mod( 'sticky_header', false );
        $transparent_header = get_theme_mod( 'transparent_header', false );
        
        // Header classes
        $header_classes = array( 'site-header' );
        
        if ( $sticky_header ) {
            $header_classes[] = 'sticky-header';
        }
        
        if ( $transparent_header ) {
            $header_classes[] = 'transparent-header';
        }
        
        // Branding classes
        $branding_classes = array( 'site-branding' );
        
        if ( $logo_alignment === 'center' ) {
            $branding_classes[] = 'text-center';
        } else {
            $branding_classes[] = 'text-left';
        }
        
        // Navigation classes
        $nav_classes = array( 'main-navigation' );
        $nav_classes[] = 'menu-' . $menu_alignment;
        
        ?>
        <header id="masthead" class="<?php echo esc_attr( implode( ' ', $header_classes ) ); ?>">
            <div class="container">
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
    $enable_dark_mode = get_theme_mod( 'enable_dark_mode', false );
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
