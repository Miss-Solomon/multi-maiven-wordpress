<?php
/**
 * Block Patterns
 *
 * @package Multi_Maiven
 */

/**
 * Register Block Pattern Category.
 */
function multi_maiven_register_block_pattern_category() {
	register_block_pattern_category(
		'multi-maiven',
		array( 'label' => __( 'Multi Maiven', 'multi-maiven' ) )
	);
}
add_action( 'init', 'multi_maiven_register_block_pattern_category', 9 );

/**
 * Register Block Patterns.
 */
function multi_maiven_register_block_patterns() {
	// Blog Grid Cards Pattern.
	register_block_pattern(
		'multi-maiven/blog-grid-cards',
		array(
			'title'       => __( 'Blog Grid Cards', 'multi-maiven' ),
			'description' => _x( 'A grid of blog posts displayed as cards with featured images, titles, and excerpts.', 'Block pattern description', 'multi-maiven' ),
			'categories'  => array( 'multi-maiven' ),
			'content'     => '<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"border":{"width":"1px","radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"backgroundColor":"background","className":"mm-card-shadow"} -->
<div class="wp-block-group mm-card-shadow has-background-background-color has-background" style="border-width:1px;border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"4px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/placeholder-1.jpg" alt="' . esc_attr__( 'Sample Image', 'multi-maiven' ) . '" style="border-radius:4px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">' . esc_html__( 'Blog Post Title 1', 'multi-maiven' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . esc_html__( 'This is a sample excerpt for the first blog post. Replace this with your own content.', 'multi-maiven' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button">' . esc_html__( 'Read More', 'multi-maiven' ) . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"border":{"width":"1px","radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"backgroundColor":"background","className":"mm-card-shadow"} -->
<div class="wp-block-group mm-card-shadow has-background-background-color has-background" style="border-width:1px;border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"4px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/placeholder-2.jpg" alt="' . esc_attr__( 'Sample Image', 'multi-maiven' ) . '" style="border-radius:4px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">' . esc_html__( 'Blog Post Title 2', 'multi-maiven' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . esc_html__( 'This is a sample excerpt for the second blog post. Replace this with your own content.', 'multi-maiven' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button">' . esc_html__( 'Read More', 'multi-maiven' ) . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"border":{"width":"1px","radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"backgroundColor":"background","className":"mm-card-shadow"} -->
<div class="wp-block-group mm-card-shadow has-background-background-color has-background" style="border-width:1px;border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"4px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/placeholder-3.jpg" alt="' . esc_attr__( 'Sample Image', 'multi-maiven' ) . '" style="border-radius:4px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">' . esc_html__( 'Blog Post Title 3', 'multi-maiven' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . esc_html__( 'This is a sample excerpt for the third blog post. Replace this with your own content.', 'multi-maiven' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button">' . esc_html__( 'Read More', 'multi-maiven' ) . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->',
		)
	);

	// Feature Columns Pattern.
	register_block_pattern(
		'multi-maiven/feature-columns',
		array(
			'title'       => __( 'Feature Columns', 'multi-maiven' ),
			'description' => _x( 'Three columns with icons, headings, and descriptions for highlighting features or services.', 'Block pattern description', 'multi-maiven' ),
			'categories'  => array( 'multi-maiven' ),
			'content'     => '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"backgroundColor":"background","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide has-background-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--50)">' . esc_html__( 'Our Features', 'multi-maiven' ) . '</h2>
<!-- /wp:heading -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-column" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"large","linkDestination":"none","className":"is-style-rounded"} -->
<figure class="wp-block-image aligncenter size-large is-resized is-style-rounded"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/icon-1.png" alt="' . esc_attr__( 'Feature Icon', 'multi-maiven' ) . '" width="64" height="64"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":3} -->
<h3 class="wp-block-heading has-text-align-center">' . esc_html__( 'Feature One', 'multi-maiven' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">' . esc_html__( 'This is a brief description of your first feature. Explain the benefits and value it provides to your users.', 'multi-maiven' ) . '</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-column" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"large","linkDestination":"none","className":"is-style-rounded"} -->
<figure class="wp-block-image aligncenter size-large is-resized is-style-rounded"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/icon-2.png" alt="' . esc_attr__( 'Feature Icon', 'multi-maiven' ) . '" width="64" height="64"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":3} -->
<h3 class="wp-block-heading has-text-align-center">' . esc_html__( 'Feature Two', 'multi-maiven' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">' . esc_html__( 'This is a brief description of your second feature. Explain the benefits and value it provides to your users.', 'multi-maiven' ) . '</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-column" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"large","linkDestination":"none","className":"is-style-rounded"} -->
<figure class="wp-block-image aligncenter size-large is-resized is-style-rounded"><img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/icon-3.png" alt="' . esc_attr__( 'Feature Icon', 'multi-maiven' ) . '" width="64" height="64"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":3} -->
<h3 class="wp-block-heading has-text-align-center">' . esc_html__( 'Feature Three', 'multi-maiven' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">' . esc_html__( 'This is a brief description of your third feature. Explain the benefits and value it provides to your users.', 'multi-maiven' ) . '</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
		)
	);

	// Icon List Pattern.
	register_block_pattern(
		'multi-maiven/icon-list',
		array(
			'title'       => __( 'Icon List', 'multi-maiven' ),
			'description' => _x( 'A list with custom icons, perfect for highlighting benefits or features.', 'Block pattern description', 'multi-maiven' ),
			'categories'  => array( 'multi-maiven' ),
			'content'     => '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"backgroundColor":"background","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide has-background-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--40)">' . esc_html__( 'Key Benefits', 'multi-maiven' ) . '</h2>
<!-- /wp:heading -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:list {"className":"mm-icon-list"} -->
<ul class="mm-icon-list"><!-- wp:list-item -->
<li>' . esc_html__( 'Benefit one with detailed explanation of how this helps users', 'multi-maiven' ) . '</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>' . esc_html__( 'Benefit two with detailed explanation of how this helps users', 'multi-maiven' ) . '</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>' . esc_html__( 'Benefit three with detailed explanation of how this helps users', 'multi-maiven' ) . '</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:list {"className":"mm-icon-list"} -->
<ul class="mm-icon-list"><!-- wp:list-item -->
<li>' . esc_html__( 'Benefit four with detailed explanation of how this helps users', 'multi-maiven' ) . '</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>' . esc_html__( 'Benefit five with detailed explanation of how this helps users', 'multi-maiven' ) . '</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>' . esc_html__( 'Benefit six with detailed explanation of how this helps users', 'multi-maiven' ) . '</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
		)
	);

	// CTA Button Block Pattern.
	register_block_pattern(
		'multi-maiven/cta-button',
		array(
			'title'       => __( 'CTA Button Block', 'multi-maiven' ),
			'description' => _x( 'A call-to-action section with heading, description, and prominent button.', 'Block pattern description', 'multi-maiven' ),
			'categories'  => array( 'multi-maiven' ),
			'content'     => '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","right":"var:preset|spacing|50","left":"var:preset|spacing|50"}},"border":{"radius":"8px"}},"backgroundColor":"primary","textColor":"background","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide has-background-color has-primary-background-color has-text-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center","textColor":"background"} -->
<h2 class="wp-block-heading has-text-align-center has-background-color has-text-color">' . esc_html__( 'Ready to Get Started?', 'multi-maiven' ) . '</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">' . esc_html__( 'Join thousands of satisfied customers who have already taken the first step towards success.', 'multi-maiven' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"background","textColor":"primary","width":100,"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","right":"var:preset|spacing|50","bottom":"var:preset|spacing|30","left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link has-primary-color has-background-background-color has-text-color has-background wp-element-button" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--50)">' . esc_html__( 'Get Started Now', 'multi-maiven' ) . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->',
		)
	);

	// Hero Section Pattern.
	register_block_pattern(
		'multi-maiven/hero-section',
		array(
			'title'       => __( 'Hero Section', 'multi-maiven' ),
			'description' => _x( 'A hero section with heading, description, and call-to-action buttons.', 'Block pattern description', 'multi-maiven' ),
			'categories'  => array( 'multi-maiven' ),
			'content'     => '<!-- wp:cover {"url":"' . esc_url( get_template_directory_uri() ) . '/assets/images/hero-bg.jpg","id":123,"dimRatio":60,"overlayColor":"primary","minHeight":80,"minHeightUnit":"vh","contentPosition":"center center","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}}} -->
<div class="wp-block-cover alignfull" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80);min-height:80vh"><span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim-60 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-123" alt="' . esc_attr__( 'Hero Background', 'multi-maiven' ) . '" src="' . esc_url( get_template_directory_uri() ) . '/assets/images/hero-bg.jpg" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"layout":{"type":"constrained","contentSize":"800px"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":1,"textColor":"background","fontSize":"huge"} -->
<h1 class="wp-block-heading has-text-align-center has-background-color has-text-color has-huge-font-size">' . esc_html__( 'Welcome to Multi Maiven', 'multi-maiven' ) . '</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"background","fontSize":"large"} -->
<p class="has-text-align-center has-background-color has-text-color has-large-font-size">' . esc_html__( 'A powerful WordPress theme with modular header/footer builder, customizer controls, and block patterns.', 'multi-maiven' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"background","textColor":"primary"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-primary-color has-background-background-color has-text-color has-background wp-element-button">' . esc_html__( 'Get Started', 'multi-maiven' ) . '</a></div>
<!-- /wp:button -->

<!-- wp:button {"textColor":"background","className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-background-color has-text-color wp-element-button">' . esc_html__( 'Learn More', 'multi-maiven' ) . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->',
		)
	);
}
add_action( 'init', 'multi_maiven_register_block_patterns' );
