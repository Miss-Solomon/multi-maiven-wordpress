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
        // Check if advertising widget area is enabled
        $enable_footer_ad = get_theme_mod( 'mm_enable_footer_ad', false );
        
        if ( $enable_footer_ad && is_active_sidebar( 'footer-ad' ) ) {
            ?>
            <div class="footer-advertising">
                <div class="container">
                    <?php dynamic_sidebar( 'footer-ad' ); ?>
                </div>
            </div>
            <?php
        }
    }

    /**
     * Footer markup
     */
    public function footer_markup() {
        // Get footer settings
        $enable_footer_widgets = get_theme_mod( 'mm_enable_footer_widgets', true );
        $footer_columns = get_theme_mod( 'mm_footer_columns', '4' );
        $mobile_layout = get_theme_mod( 'mm_footer_mobile_layout', 'stack' );
        
        // Footer classes
        $footer_classes = array( 'site-footer' );
        
        if ( $mobile_layout === 'grid' ) {
            $footer_classes[] = 'footer-mobile-grid';
        } else {
            $footer_classes[] = 'footer-mobile-stack';
        }
        
        ?>
        <footer id="colophon" class="<?php echo esc_attr( implode( ' ', $footer_classes ) ); ?>">
            <?php if ( $enable_footer_widgets ) : ?>
                <div class="footer-widgets">
                    <div class="container">
                        <div class="footer-widgets-inner footer-columns-<?php echo esc_attr( $footer_columns ); ?>">
                            <?php $this->render_footer_columns( $footer_columns ); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php $this->render_bottom_footer_bar(); ?>
        </footer><!-- #colophon -->
        <?php
    }

    /**
     * Render footer columns based on layout
     *
     * @param string $layout Footer column layout.
     */
    private function render_footer_columns( $layout ) {
        // Set column count and widths based on layout
        $columns = array();
        
        switch ( $layout ) {
            case '1':
                $columns[] = array( 'id' => 'footer-1', 'width' => '100%' );
                break;
                
            case '2':
                $columns[] = array( 'id' => 'footer-1', 'width' => '50%' );
                $columns[] = array( 'id' => 'footer-2', 'width' => '50%' );
                break;
                
            case '3':
                $columns[] = array( 'id' => 'footer-1', 'width' => '33.33%' );
                $columns[] = array( 'id' => 'footer-2', 'width' => '33.33%' );
                $columns[] = array( 'id' => 'footer-3', 'width' => '33.33%' );
                break;
                
            case '4':
                $columns[] = array( 'id' => 'footer-1', 'width' => '25%' );
                $columns[] = array( 'id' => 'footer-2', 'width' => '25%' );
                $columns[] = array( 'id' => 'footer-3', 'width' => '25%' );
                $columns[] = array( 'id' => 'footer-4', 'width' => '25%' );
                break;
                
            case '2-1':
                $columns[] = array( 'id' => 'footer-1', 'width' => '75%' );
                $columns[] = array( 'id' => 'footer-2', 'width' => '25%' );
                break;
                
            case '1-2':
                $columns[] = array( 'id' => 'footer-1', 'width' => '25%' );
                $columns[] = array( 'id' => 'footer-2', 'width' => '75%' );
                break;
                
            case '1-1-2':
                $columns[] = array( 'id' => 'footer-1', 'width' => '25%' );
                $columns[] = array( 'id' => 'footer-2', 'width' => '25%' );
                $columns[] = array( 'id' => 'footer-3', 'width' => '50%' );
                break;
                
            case '2-1-1':
                $columns[] = array( 'id' => 'footer-1', 'width' => '50%' );
                $columns[] = array( 'id' => 'footer-2', 'width' => '25%' );
                $columns[] = array( 'id' => 'footer-3', 'width' => '25%' );
                break;
                
            default:
                $columns[] = array( 'id' => 'footer-1', 'width' => '25%' );
                $columns[] = array( 'id' => 'footer-2', 'width' => '25%' );
                $columns[] = array( 'id' => 'footer-3', 'width' => '25%' );
                $columns[] = array( 'id' => 'footer-4', 'width' => '25%' );
                break;
        }
        
        // Render columns
        foreach ( $columns as $column ) {
            ?>
            <div class="footer-column" style="width: <?php echo esc_attr( $column['width'] ); ?>;">
                <?php if ( is_active_sidebar( $column['id'] ) ) : ?>
                    <?php dynamic_sidebar( $column['id'] ); ?>
                <?php endif; ?>
            </div>
            <?php
        }
    }

    /**
     * Render bottom footer bar
     */
    private function render_bottom_footer_bar() {
        // Get bottom bar settings
        $show_bottom_bar = get_theme_mod( 'mm_show_bottom_bar', true );
        
        if ( ! $show_bottom_bar ) {
            // If bottom bar is disabled, just show copyright text
            ?>
            <div class="site-info">
                <div class="container">
                    <div class="copyright">
                        <?php echo wp_kses_post( get_theme_mod( 'mm_copyright_text', sprintf(
                            /* translators: %1$s: Theme name, %2$s: Theme author. */
                            __( 'Proudly powered by WordPress | Theme: %1$s by %2$s.', 'multi-maiven' ),
                            'Multi Maiven',
                            '<a href="#">Your Name</a>'
                        ) ) ); ?>
                    </div>
                </div>
            </div>
            <?php
            return;
        }
        
        // Get more bottom bar settings
        $reverse_layout = get_theme_mod( 'mm_bottom_bar_reverse_layout', false );
        $left_content = get_theme_mod( 'mm_bottom_bar_left', '' );
        $right_content = get_theme_mod( 'mm_bottom_bar_right', '' );
        
        // Swap left and right content if reverse layout is enabled
        if ( $reverse_layout ) {
            $temp = $left_content;
            $left_content = $right_content;
            $right_content = $temp;
        }
        
        ?>
        <div class="footer-bottom-bar">
            <div class="container">
                <div class="footer-bottom-bar-inner">
                    <div class="footer-bottom-left">
                        <?php if ( ! empty( $left_content ) ) : ?>
                            <?php echo wp_kses_post( $left_content ); ?>
                        <?php elseif ( has_nav_menu( 'footer' ) ) : ?>
                            <nav class="footer-navigation">
                                <?php
                                wp_nav_menu( array(
                                    'theme_location' => 'footer',
                                    'menu_class'     => 'footer-menu',
                                    'depth'          => 1,
                                    'container'      => false,
                                ) );
                                ?>
                            </nav>
                        <?php endif; ?>
                    </div>
                    
                    <div class="footer-bottom-right">
                        <?php if ( ! empty( $right_content ) ) : ?>
                            <?php echo wp_kses_post( $right_content ); ?>
                        <?php elseif ( has_nav_menu( 'footer-right' ) ) : ?>
                            <nav class="footer-right-navigation">
                                <?php
                                wp_nav_menu( array(
                                    'theme_location' => 'footer-right',
                                    'menu_class'     => 'footer-right-menu',
                                    'depth'          => 1,
                                    'container'      => false,
                                ) );
                                ?>
                            </nav>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="site-info">
            <div class="container">
                <div class="copyright">
                    <?php echo wp_kses_post( get_theme_mod( 'mm_copyright_text', sprintf(
                        /* translators: %1$s: Theme name, %2$s: Theme author. */
                        __( 'Proudly powered by WordPress | Theme: %1$s by %2$s.', 'multi-maiven' ),
                        'Multi Maiven',
                        '<a href="#">Your Name</a>'
                    ) ) ); ?>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * After footer markup
     */
    public function after_footer() {
        // Add dark mode toggle to footer if enabled
        $enable_dark_mode = get_theme_mod( 'dark_mode_toggle', true );
        $dark_mode_toggle_position = get_theme_mod( 'dark_mode_toggle_position', 'header' );
        
        if ( $enable_dark_mode && ( $dark_mode_toggle_position === 'footer' || $dark_mode_toggle_position === 'both' ) ) {
            ?>
            <div class="dark-mode-toggle-container footer-toggle">
                <button class="dark-mode-toggle" aria-label="<?php esc_attr_e( 'Toggle Dark Mode', 'multi-maiven' ); ?>" title="<?php esc_attr_e( 'Toggle Dark Mode', 'multi-maiven' ); ?>">
                    <span class="toggle-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path class="sun-icon" d="M12 18a6 6 0 1 1 0-12 6 6 0 0 1 0 12zm0-2a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM11 1h2v3h-2V1zm0 19h2v3h-2v-3zM3.515 4.929l1.414-1.414L7.05 5.636 5.636 7.05 3.515 4.93zM16.95 18.364l1.414-1.414 2.121 2.121-1.414 1.414-2.121-2.121zm2.121-14.85l1.414 1.415-2.121 2.121-1.414-1.414 2.121-2.121zM5.636 16.95l1.414 1.414-2.121 2.121-1.414-1.414 2.121-2.121zM23 11v2h-3v-2h3zM4 11v2H1v-2h3z"/>
                            <path class="moon-icon" d="M10 7a7 7 0 0 0 12 4.9v.1c0 5.523-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2h.1A6.979 6.979 0 0 0 10 7z"/>
                        </svg>
                    </span>
                    <span class="toggle-label"><?php esc_html_e( 'Toggle Dark Mode', 'multi-maiven' ); ?></span>
                </button>
            </div>
            <?php
        }
    }
}

// Initialize the footer builder
Multi_Maiven_Footer_Builder::get_instance();
