<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Multi_Maiven
 */

?>
		</div><!-- .container -->
	</div><!-- #content -->

	<?php
	/**
	 * Hook: mm_before_footer
	 *
	 * @hooked Multi_Maiven_Footer_Builder::before_footer - 10
	 */
	do_action( 'mm_before_footer' );
	?>

	<?php
	/**
	 * Hook: mm_footer
	 *
	 * @hooked Multi_Maiven_Footer_Builder::footer_markup - 10
	 */
	do_action( 'mm_footer' );
	?>

	<?php
	/**
	 * Hook: mm_after_footer
	 *
	 * @hooked Multi_Maiven_Footer_Builder::after_footer - 10
	 */
	do_action( 'mm_after_footer' );
	?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
