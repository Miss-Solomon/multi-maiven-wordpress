/**
 * File footer-builder.js.
 *
 * Theme Customizer enhancements for the footer builder.
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
    'use strict';

    // Footer Background Color
    wp.customize( 'mm_footer_bg_color', function( value ) {
        value.bind( function( to ) {
            $( '.site-footer' ).css( 'background-color', to );
        } );
    } );

    // Footer Text Color
    wp.customize( 'mm_footer_text_color', function( value ) {
        value.bind( function( to ) {
            $( '.site-footer' ).css( 'color', to );
        } );
    } );

    // Footer Widget Title Color
    wp.customize( 'mm_footer_widget_title_color', function( value ) {
        value.bind( function( to ) {
            $( '.site-footer .widget-title' ).css( 'color', to );
        } );
    } );

    // Footer Link Color
    wp.customize( 'mm_footer_link_color', function( value ) {
        value.bind( function( to ) {
            $( '.site-footer a' ).css( 'color', to );
        } );
    } );

    // Footer Link Hover Color
    wp.customize( 'mm_footer_link_hover_color', function( value ) {
        value.bind( function( to ) {
            // We can't directly bind hover state, but we can update the CSS variable
            document.documentElement.style.setProperty('--mm-footer-link-hover-color', to);
        } );
    } );

    // Footer Top Padding
    wp.customize( 'mm_footer_padding_top', function( value ) {
        value.bind( function( to ) {
            $( '.site-footer' ).css( 'padding-top', to + 'px' );
        } );
    } );

    // Footer Bottom Padding
    wp.customize( 'mm_footer_padding_bottom', function( value ) {
        value.bind( function( to ) {
            $( '.site-footer' ).css( 'padding-bottom', to + 'px' );
        } );
    } );

    // Footer Border
    wp.customize( 'mm_footer_border', function( value ) {
        value.bind( function( to ) {
            if ( to ) {
                $( '.site-footer' ).css( 'border-top', '1px solid var(--mm-color-border, #e9e9e9)' );
            } else {
                $( '.site-footer' ).css( 'border-top', 'none' );
            }
        } );
    } );

    // Copyright Text
    wp.customize( 'mm_copyright_text', function( value ) {
        value.bind( function( to ) {
            $( '.site-info .copyright' ).html( to );
        } );
    } );

    // Bottom Bar Background Color
    wp.customize( 'mm_bottom_bar_bg_color', function( value ) {
        value.bind( function( to ) {
            $( '.footer-bottom-bar' ).css( 'background-color', to );
        } );
    } );

    // Bottom Bar Text Color
    wp.customize( 'mm_bottom_bar_text_color', function( value ) {
        value.bind( function( to ) {
            $( '.footer-bottom-bar' ).css( 'color', to );
        } );
    } );

} )( jQuery );
