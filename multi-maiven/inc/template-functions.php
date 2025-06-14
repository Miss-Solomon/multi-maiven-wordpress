<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Multi_Maiven
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function multi_maiven_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Add a class if dark mode is enabled by default
	$dark_mode_default = get_theme_mod( 'dark_mode_default', 'light' );
	if ( 'dark' === $dark_mode_default ) {
		$classes[] = 'dark-mode';
	}

	return $classes;
}
add_filter( 'body_class', 'multi_maiven_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function multi_maiven_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'multi_maiven_pingback_header' );

/**
 * Add custom image sizes.
 */
function multi_maiven_add_image_sizes() {
	add_image_size( 'multi-maiven-featured', 1200, 600, true );
	add_image_size( 'multi-maiven-thumbnail', 600, 400, true );
}
add_action( 'after_setup_theme', 'multi_maiven_add_image_sizes' );

/**
 * Add custom image sizes to the media library.
 *
 * @param array $sizes Image sizes.
 * @return array
 */
function multi_maiven_custom_image_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'multi-maiven-featured' => __( 'Featured Image', 'multi-maiven' ),
		'multi-maiven-thumbnail' => __( 'Thumbnail', 'multi-maiven' ),
	) );
}
add_filter( 'image_size_names_choose', 'multi_maiven_custom_image_sizes' );

/**
 * Add preconnect for Google Fonts.
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function multi_maiven_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'multi-maiven-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'multi_maiven_resource_hints', 10, 2 );

/**
 * Add async/defer attributes to enqueued scripts.
 *
 * @param string $tag    The script tag.
 * @param string $handle The script handle.
 * @return string
 */
function multi_maiven_script_loader_tag( $tag, $handle ) {
	// Add async attribute to Google Fonts
	if ( 'multi-maiven-fonts' === $handle ) {
		return str_replace( ' src', ' async defer src', $tag );
	}

	// Add defer attribute to non-critical scripts
	$scripts_to_defer = array( 'multi-maiven-navigation', 'multi-maiven-skip-link-focus-fix' );
	foreach ( $scripts_to_defer as $defer_script ) {
		if ( $defer_script === $handle ) {
			return str_replace( ' src', ' defer src', $tag );
		}
	}

	return $tag;
}
add_filter( 'script_loader_tag', 'multi_maiven_script_loader_tag', 10, 2 );

/**
 * Modify the excerpt length.
 *
 * @param int $length Excerpt length.
 * @return int
 */
function multi_maiven_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'multi_maiven_excerpt_length' );

/**
 * Modify the excerpt more string.
 *
 * @param string $more The excerpt more string.
 * @return string
 */
function multi_maiven_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'multi_maiven_excerpt_more' );

/**
 * Add a wrapper to the content.
 *
 * @param string $content The content.
 * @return string
 */
function multi_maiven_content_wrapper( $content ) {
	if ( is_singular() && in_the_loop() && is_main_query() ) {
		return '<div class="entry-content-wrapper">' . $content . '</div>';
	}

	return $content;
}
add_filter( 'the_content', 'multi_maiven_content_wrapper' );

/**
 * Add a wrapper to the excerpt.
 *
 * @param string $excerpt The excerpt.
 * @return string
 */
function multi_maiven_excerpt_wrapper( $excerpt ) {
	if ( is_singular() && in_the_loop() && is_main_query() ) {
		return '<div class="entry-excerpt-wrapper">' . $excerpt . '</div>';
	}

	return $excerpt;
}
add_filter( 'the_excerpt', 'multi_maiven_excerpt_wrapper' );

/**
 * Add a class to the post thumbnail.
 *
 * @param string $html          The post thumbnail HTML.
 * @param int    $post_id       The post ID.
 * @param int    $post_image_id The post image ID.
 * @return string
 */
function multi_maiven_post_thumbnail_class( $html, $post_id, $post_image_id ) {
	$html = str_replace( 'attachment-', 'img-fluid attachment-', $html );
	return $html;
}
add_filter( 'post_thumbnail_html', 'multi_maiven_post_thumbnail_class', 10, 3 );

/**
 * Add a class to the avatar.
 *
 * @param string $class The avatar class.
 * @return string
 */
function multi_maiven_avatar_class( $class ) {
	$class = str_replace( "class='avatar", "class='avatar img-fluid", $class );
	return $class;
}
add_filter( 'get_avatar', 'multi_maiven_avatar_class' );

/**
 * Add a class to the comment reply link.
 *
 * @param string $link The comment reply link.
 * @return string
 */
function multi_maiven_comment_reply_link( $link ) {
	$link = str_replace( "class='comment-reply-link", "class='comment-reply-link btn btn-sm btn-outline-primary", $link );
	return $link;
}
add_filter( 'comment_reply_link', 'multi_maiven_comment_reply_link' );

/**
 * Add a class to the edit comment link.
 *
 * @param string $link The edit comment link.
 * @return string
 */
function multi_maiven_edit_comment_link( $link ) {
	$link = str_replace( "class='comment-edit-link", "class='comment-edit-link btn btn-sm btn-outline-secondary", $link );
	return $link;
}
add_filter( 'edit_comment_link', 'multi_maiven_edit_comment_link' );

/**
 * Add a class to the cancel comment reply link.
 *
 * @param string $link The cancel comment reply link.
 * @return string
 */
function multi_maiven_cancel_comment_reply_link( $link ) {
	$link = str_replace( "id='cancel-comment-reply-link'", "id='cancel-comment-reply-link' class='btn btn-sm btn-outline-danger'", $link );
	return $link;
}
add_filter( 'cancel_comment_reply_link', 'multi_maiven_cancel_comment_reply_link' );

/**
 * Add a class to the submit button.
 *
 * @param string $button The submit button.
 * @return string
 */
function multi_maiven_comment_form_submit_button( $button ) {
	$button = str_replace( "class='submit'", "class='submit btn btn-primary'", $button );
	return $button;
}
add_filter( 'comment_form_submit_button', 'multi_maiven_comment_form_submit_button' );

/**
 * Add a class to the comment form fields.
 *
 * @param array $fields The comment form fields.
 * @return array
 */
function multi_maiven_comment_form_fields( $fields ) {
	foreach ( $fields as $key => $field ) {
		$fields[ $key ] = str_replace( "class='comment-form-", "class='comment-form-group comment-form-", $field );
		$fields[ $key ] = str_replace( "<input", "<input class='form-control'", $field );
	}
	return $fields;
}
add_filter( 'comment_form_default_fields', 'multi_maiven_comment_form_fields' );

/**
 * Add a class to the comment form comment field.
 *
 * @param string $field The comment form comment field.
 * @return string
 */
function multi_maiven_comment_form_field_comment( $field ) {
	$field = str_replace( "class='comment-form-comment'", "class='comment-form-group comment-form-comment'", $field );
	$field = str_replace( "<textarea", "<textarea class='form-control'", $field );
	return $field;
}
add_filter( 'comment_form_field_comment', 'multi_maiven_comment_form_field_comment' );

/**
 * Add a class to the search form.
 *
 * @param string $form The search form.
 * @return string
 */
function multi_maiven_search_form( $form ) {
	$form = str_replace( "class='search-form'", "class='search-form form-inline'", $form );
	$form = str_replace( "class='search-field'", "class='search-field form-control mr-2'", $form );
	$form = str_replace( "class='search-submit'", "class='search-submit btn btn-primary'", $form );
	return $form;
}
add_filter( 'get_search_form', 'multi_maiven_search_form' );

/**
 * Add a class to the password form.
 *
 * @param string $form The password form.
 * @return string
 */
function multi_maiven_password_form( $form ) {
	$form = str_replace( "class='post-password-form'", "class='post-password-form form'", $form );
	$form = str_replace( "<input name='post_password'", "<input class='form-control' name='post_password'", $form );
	$form = str_replace( "<input type='submit'", "<input class='btn btn-primary' type='submit'", $form );
	return $form;
}
add_filter( 'the_password_form', 'multi_maiven_password_form' );

/**
 * Add a class to the gallery.
 *
 * @param string $gallery The gallery.
 * @return string
 */
function multi_maiven_gallery_style( $gallery ) {
	$gallery = str_replace( "class='gallery", "class='gallery row", $gallery );
	$gallery = str_replace( "<dl class='gallery-item", "<dl class='gallery-item col-md-4", $gallery );
	return $gallery;
}
add_filter( 'gallery_style', 'multi_maiven_gallery_style' );

/**
 * Add a class to the navigation.
 *
 * @param string $navigation The navigation.
 * @return string
 */
function multi_maiven_navigation_markup_template( $template, $class ) {
	$template = str_replace( "class='$class'", "class='$class navigation'", $template );
	$template = str_replace( "class='nav-links'", "class='nav-links pagination'", $template );
	return $template;
}
add_filter( 'navigation_markup_template', 'multi_maiven_navigation_markup_template', 10, 2 );

/**
 * Add a class to the page links.
 *
 * @param string $output The page links.
 * @return string
 */
function multi_maiven_wp_link_pages_link( $output ) {
	$output = str_replace( "class='page-numbers'", "class='page-numbers btn btn-sm btn-outline-primary'", $output );
	$output = str_replace( "class='page-numbers current'", "class='page-numbers current btn btn-sm btn-primary'", $output );
	return $output;
}
add_filter( 'wp_link_pages_link', 'multi_maiven_wp_link_pages_link' );

/**
 * Add a class to the posts navigation.
 *
 * @param string $template The posts navigation template.
 * @return string
 */
function multi_maiven_posts_navigation( $template ) {
	$template = str_replace( "class='nav-previous", "class='nav-previous btn btn-outline-primary", $template );
	$template = str_replace( "class='nav-next", "class='nav-next btn btn-outline-primary", $template );
	return $template;
}
add_filter( 'get_the_posts_navigation', 'multi_maiven_posts_navigation' );

/**
 * Add a class to the post navigation.
 *
 * @param string $template The post navigation template.
 * @return string
 */
function multi_maiven_post_navigation( $template ) {
	$template = str_replace( "class='nav-previous", "class='nav-previous btn btn-outline-primary", $template );
	$template = str_replace( "class='nav-next", "class='nav-next btn btn-outline-primary", $template );
	return $template;
}
add_filter( 'get_the_post_navigation', 'multi_maiven_post_navigation' );
