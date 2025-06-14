/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Color settings
	wp.customize( 'header_bg_color', function( value ) {
		value.bind( function( to ) {
			document.documentElement.style.setProperty('--mm-header-bg-color', to);
		} );
	} );

	wp.customize( 'footer_bg_color', function( value ) {
		value.bind( function( to ) {
			document.documentElement.style.setProperty('--mm-footer-bg-color', to);
		} );
	} );

	wp.customize( 'body_bg_color', function( value ) {
		value.bind( function( to ) {
			document.documentElement.style.setProperty('--mm-body-bg-color', to);
		} );
	} );

	wp.customize( 'link_color', function( value ) {
		value.bind( function( to ) {
			document.documentElement.style.setProperty('--mm-link-color', to);
		} );
	} );

	wp.customize( 'link_hover_color', function( value ) {
		value.bind( function( to ) {
			document.documentElement.style.setProperty('--mm-link-hover-color', to);
		} );
	} );

	// Typography settings
	wp.customize( 'google_font_family', function( value ) {
		value.bind( function( to ) {
			// Update the CSS variable
			document.documentElement.style.setProperty('--mm-font-family', "'" + to + "', sans-serif");
			
			// Update the Google Fonts link
			let fontLink = document.getElementById('multi-maiven-fonts-css');
			if (fontLink) {
				let fontUrl = 'https://fonts.googleapis.com/css?family=' + to.replace(' ', '+') + ':400,700&display=swap';
				fontLink.setAttribute('href', fontUrl);
			}
		} );
	} );

	wp.customize( 'base_font_size', function( value ) {
		value.bind( function( to ) {
			document.documentElement.style.setProperty('--mm-base-font-size', to + 'px');
		} );
	} );

	wp.customize( 'headings_font_size', function( value ) {
		value.bind( function( to ) {
			document.documentElement.style.setProperty('--mm-h1-font-size', to + 'px');
			document.documentElement.style.setProperty('--mm-h2-font-size', Math.round(to * 0.8) + 'px');
			document.documentElement.style.setProperty('--mm-h3-font-size', Math.round(to * 0.7) + 'px');
			document.documentElement.style.setProperty('--mm-h4-font-size', Math.round(to * 0.6) + 'px');
			document.documentElement.style.setProperty('--mm-h5-font-size', Math.round(to * 0.5) + 'px');
			document.documentElement.style.setProperty('--mm-h6-font-size', Math.round(to * 0.4) + 'px');
		} );
	} );

	// Layout settings
	wp.customize( 'logo_alignment', function( value ) {
		value.bind( function( to ) {
			$( '.site-branding' ).css( 'text-align', to );
		} );
	} );

	wp.customize( 'menu_alignment', function( value ) {
		value.bind( function( to ) {
			$( '.main-navigation' ).css( 'text-align', to );
		} );
	} );

	// Footer settings
	wp.customize( 'footer_copyright', function( value ) {
		value.bind( function( to ) {
			$( '.site-info .copyright' ).html( to );
		} );
	} );

	wp.customize( 'footer_credits', function( value ) {
		value.bind( function( to ) {
			$( '.site-info .credits' ).html( to );
		} );
	} );

} )( jQuery );
