/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 * Things like site title, description, and background color changes.
 */

( function( $ ) {

	"use strict";

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

	// Hook into background color/image change and adjust body class value as needed.
	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			var body = $( 'body' );

			if ( ( '#ffffff' == to || '#fff' == to ) && 'none' == body.css( 'background-image' ) )
				body.addClass( 'custom-background-white' );
			else if ( '' == to && 'none' == body.css( 'background-image' ) )
				body.addClass( 'custom-background-empty' );
			else
				body.removeClass( 'custom-background-empty custom-background-white' );
		} );
	} );
	wp.customize( 'background_image', function( value ) {
		value.bind( function( to ) {
			var body = $( 'body' );

			if ( '' != to )
				body.removeClass( 'custom-background-empty custom-background-white' );
			else if ( 'rgb(255, 255, 255)' == body.css( 'background-color' ) )
				body.addClass( 'custom-background-white' );
			else if ( 'rgb(230, 230, 230)' == body.css( 'background-color' ) && '' == _wpCustomizeSettings.values.background_color )
				body.addClass( 'custom-background-empty' );
		} );
	} );

	// Site Width
	wp.customize( 'site_width', function( value ) {
        value.bind( function( to ) {
            $( 'body #main, .boxed .site, .header-box, .header-style2 .primary-menu-container, .header-style2 .nav-menu, .header-style3 .primary-menu-container, .header-style3 .nav-menu, .king-container, .footer-widget-area, .footer-bottom-container, .smile-row, .boxed.king-fixed-menu .site-header' ).attr( 'style', 'max-width:'+to+'px !important' );
        } );
    });

    // Content Width
	wp.customize( 'content_width', function( value ) {
        value.bind( function( to ) {
            $( '#primary' ).attr( 'style', 'width:'+to+'%' );
            $( '#secondary' ).attr( 'style', 'width:'+(100 - to)+'%' );
        } );
    });

    // Copyright Text
	wp.customize( 'copyright_textbox', function( value ) {
		value.bind( function( to ) {
			$( '.footer-bottom-container .site-info' ).text( to );
		} );
	});

} )( jQuery );
