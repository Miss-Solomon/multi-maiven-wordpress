<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Multi_Maiven
 */

// Get sidebar position from customizer
$sidebar_position = get_theme_mod( 'sidebar_position', 'right' );

// Don't display sidebar if position is set to 'none'
if ( $sidebar_position === 'none' || ! is_active_sidebar( 'primary-sidebar' ) ) {
	return;
}

// Add has-sidebar class to body
add_filter( 'body_class', function( $classes ) use ( $sidebar_position ) {
	$classes[] = 'has-sidebar';
	$classes[] = 'sidebar-' . $sidebar_position;
	return $classes;
} );
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'primary-sidebar' ); ?>
</aside><!-- #secondary -->
