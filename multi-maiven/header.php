<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Multi_Maiven
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'multi-maiven' ); ?></a>

	<?php
	/**
	 * Hook: mm_before_header
	 *
	 * @hooked Multi_Maiven_Header_Builder::top_bar - 10
	 */
	do_action( 'mm_before_header' );
	?>

	<?php
	/**
	 * Hook: mm_header
	 *
	 * @hooked Multi_Maiven_Header_Builder::header_markup - 10
	 */
	do_action( 'mm_header' );
	?>

	<?php
	/**
	 * Hook: mm_after_header
	 *
	 * @hooked Multi_Maiven_Header_Builder::after_header - 10
	 */
	do_action( 'mm_after_header' );
	?>

	<div id="content" class="site-content">
		<div class="container">
