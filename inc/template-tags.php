<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Multi_Maiven
 */

if ( ! function_exists( 'multi_maiven_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function multi_maiven_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'multi-maiven' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'multi_maiven_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function multi_maiven_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'multi-maiven' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'multi_maiven_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function multi_maiven_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'multi-maiven' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'multi-maiven' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'multi-maiven' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'multi-maiven' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'multi-maiven' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'multi-maiven' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'multi_maiven_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function multi_maiven_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

/**
 * Display SVG icons in social links menu.
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function multi_maiven_nav_menu_social_icons( $item_output, $item, $depth, $args ) {
	// Change SVG icon inside social links menu if there is supported URL.
	if ( 'social' === $args->theme_location ) {
		$svg = multi_maiven_get_social_icon( $item->url );
		
		if ( empty( $svg ) ) {
			$svg = '<span class="icon icon-link"></span>';
		}
		
		$item_output = str_replace( $args->link_before, $svg, $item_output );
	}
	
	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'multi_maiven_nav_menu_social_icons', 10, 4 );

/**
 * Returns an array of supported social links (URL and icon name).
 *
 * @return array $social_links_icons
 */
function multi_maiven_social_links_icons() {
	// Supported social links icons.
	$social_links_icons = array(
		'facebook.com'    => 'facebook',
		'instagram.com'   => 'instagram',
		'linkedin.com'    => 'linkedin',
		'twitter.com'     => 'twitter',
		'pinterest.com'   => 'pinterest',
		'youtube.com'     => 'youtube',
		'github.com'      => 'github',
		'behance.net'     => 'behance',
		'dribbble.com'    => 'dribbble',
		'wordpress.org'   => 'wordpress',
		'wordpress.com'   => 'wordpress',
		'medium.com'      => 'medium',
		'tumblr.com'      => 'tumblr',
		'reddit.com'      => 'reddit',
		'vimeo.com'       => 'vimeo',
		'flickr.com'      => 'flickr',
		'telegram.org'    => 'telegram',
		'whatsapp.com'    => 'whatsapp',
		'tiktok.com'      => 'tiktok',
	);

	/**
	 * Filter Multi Maiven social links icons.
	 *
	 * @param array $social_links_icons Array of social links icons.
	 */
	return apply_filters( 'multi_maiven_social_links_icons', $social_links_icons );
}

/**
 * Get SVG icon for social link.
 *
 * @param string $url URL of the social link.
 * @return string SVG icon HTML.
 */
function multi_maiven_get_social_icon( $url ) {
	// Return empty if URL is empty.
	if ( empty( $url ) ) {
		return '';
	}
	
	// Get icon name based on URL.
	$icon_name = '';
	$social_links_icons = multi_maiven_social_links_icons();
	
	foreach ( $social_links_icons as $domain => $icon ) {
		if ( strpos( $url, $domain ) !== false ) {
			$icon_name = $icon;
			break;
		}
	}
	
	// Return empty if icon name is empty.
	if ( empty( $icon_name ) ) {
		return '';
	}
	
	// Return icon HTML
	return '<span class="icon icon-' . esc_attr( $icon_name ) . '"></span>';
}
