<?php
/**
 * Footer Builder
 *
 * @package Multi_Maiven
 */

/**
 * Footer builder class
 */
class Multi_Maiven_Footer_Builder {
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
        add_action( 'mm_before_footer', array( $this, 'before_footer' ), 10 );
        add_action( 'mm_footer', array( $this, 'footer_markup' ), 10 );
        add_action( 'mm_after_footer', array( $this, 'after_footer' ), 10 );
    }

    /**
     * Before footer markup
     */
    public function before_footer() {
        // Add any additional markup before the footer
    }

    /**
     * Footer markup
     */
    public function footer_markup() {
        $footer_columns = get_theme_mod( 'footer_columns', 4 );
        $footer_copyright = get_theme_mod( 'footer_copyright', '&copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) . '. All rights reserved.' );
        
        // Footer classes
        $footer_classes = array( 'site-footer' );
        
        ?>
        <footer id="colophon" class="<?php echo esc_attr( implode( ' ', $footer_classes ) ); ?>">
            <?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
                <div class="footer-widgets">
                    <div class="container">
                        <div class="footer-widgets-inner">
                            <?php for ( $i = 1; $i <= $footer_columns; $i++ ) : ?>
                                <?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>
                                    <div class="footer-widget-area footer-widget-area-<?php echo esc_attr( $i ); ?>">
                                        <?php dynamic_sidebar( 'footer-' . $i ); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="site-info">
                <div class="container">
                    <?php do_action( 'mm_footer_extras' ); ?>
                    <div class="copyright">
                        <?php echo wp_kses_post( $footer_copyright ); ?>
                    </div>
                </div>
            </div>
        </footer><!-- #colophon -->
        <?php
    }

    /**
     * After footer markup
     */
    public function after_footer() {
        // Add any additional markup after the footer
    }
}

// Initialize the footer builder
Multi_Maiven_Footer_Builder::get_instance();

/**
 * Register footer widget areas
 */
function multi_maiven_register_footer_widget_areas() {
    $footer_columns = get_theme_mod( 'footer_columns', 4 );
    
    for ( $i = 1; $i <= $footer_columns; $i++ ) {
        register_sidebar(
            array(
                'name'          => sprintf( esc_html__( 'Footer %d', 'multi-maiven' ), $i ),
                'id'            => 'footer-' . $i,
                'description'   => sprintf( esc_html__( 'Add widgets here to appear in footer column %d.', 'multi-maiven' ), $i ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );
    }
}
add_action( 'widgets_init', 'multi_maiven_register_footer_widget_areas' );

/**
 * Add dark mode toggle to footer extras
 */
function multi_maiven_footer_dark_mode_toggle() {
    $enable_dark_mode = get_theme_mod( 'enable_dark_mode', false );
    $dark_mode_toggle_position = get_theme_mod( 'dark_mode_toggle_position', 'header' );
    
    if ( ! $enable_dark_mode || ( $dark_mode_toggle_position !== 'footer' && $dark_mode_toggle_position !== 'both' ) ) {
        return;
    }
    
    ?>
    <div class="dark-mode-toggle-container footer-toggle">
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
add_action( 'mm_footer_extras', 'multi_maiven_footer_dark_mode_toggle' );

/**
 * Add footer styles based on customizer settings
 */
function multi_maiven_footer_styles() {
    $footer_bg_color = get_theme_mod( 'footer_bg_color', '#f8f9fa' );
    
    if ( $footer_bg_color ) {
        $custom_css = '.site-footer { background-color: ' . esc_attr( $footer_bg_color ) . '; }';
        wp_add_inline_style( 'multi-maiven-style', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'multi_maiven_footer_styles', 20 );
