<?php
/**
* Theme Hook Alliance hook stub list.
*
* @package 		king
* @version		1.0
* @since		1.0
*/

/**
 * Define the version of King support, in case that becomes useful down the road.
 */
define( 'King_hooks_VERSION', '1.0' );

/** 
 * Themes and Plugins can check for king_hooks using current_theme_supports( 'king_hooks', $hook )
 * to determine whether a theme declares itself to support this specific hook type.
 * 
 * Example:
 * <code>
 * 		// Declare support for all hook types
 * 		add_theme_support( 'king_hooks', array( 'all' ) );
 * 
 * 		// Declare support for certain hook types only
 * 		add_theme_support( 'king_hooks', array( 'header', 'content', 'footer' ) );
 * </code>
 */
add_theme_support( 'king_hooks', array(
	
	/**
	 * As a Theme developer, use the 'all' parameter, to declare support for all
	 * hook types.
	 * Please make sure you then actually reference all the hooks in this file,
	 * Plugin developers depend on it!
	 */
	'all',
	
	/**
	 * Themes can also choose to only support certain hook types.
	 * Please make sure you then actually reference all the hooks in this type
	 * family.
	 * 
	 * When the 'all' parameter was set, specific hook types do not need to be
	 * added explicitly.
	 */
	'html',
	'body',
	'head',
	'header',
	'content',
	'entry',
	'comments',
	'sidebars',
	'sidebar',
	'footer',
	
	/**
	 * If/when WordPress Core implements similar methodology, Themes and Plugins
	 * will be able to check whether the version of King supplied by the theme
	 * supports Core hooks.
	 */
//	'core'
) );

/**
 * Determines, whether the specific hook type is actually supported.
 * 
 * Plugin developers should always check for the support of a <strong>specific</strong>
 * hook type before hooking a callback function to a hook of this type.
 * 
 * Example:
 * <code>
 * 		if ( current_theme_supports( 'king_hooks', 'header' ) )
 * 	  		add_action( 'king_head_top', 'prefix_header_top' );	
 * </code>
 * 
 * @param bool $bool true
 * @param array $args The hook type being checked
 * @param array $registered All registered hook types
 * 
 * @return bool
 */
function king_current_theme_supports( $bool, $args, $registered ) {
	return in_array( $args[0], $registered[0] ) || in_array( 'all', $registered[0] );
}
add_filter( 'current_theme_supports-king_hooks', 'king_current_theme_supports', 10, 3 );

/**
 * HTML <html> hook
 * Special case, useful for <DOCTYPE>, etc.
 * $king_supports[] = 'html;
 */
 function king_html_before() {
	 do_action( 'king_html_before' );
 }
/**
 * HTML <body> hooks
 * $king_supports[] = 'body';
 */
 function king_body_top() {
	 do_action( 'king_body_top' );
 }

 function king_body_bottom() {
	 do_action( 'king_body_bottom' );
 }
 
/**
* HTML <head> hooks
* 
* $king_supports[] = 'head';
*/
function king_head_top() {
	do_action( 'king_head_top' );
}

function king_head_bottom() {
	do_action( 'king_head_bottom' );
}

/**
* Semantic <header> hooks
* 
* $king_supports[] = 'header';
*/
function king_header_before() {
	do_action( 'king_header_before' );
}

function king_header_after() {
	do_action( 'king_header_after' );
}

function king_header_top() {
	do_action( 'king_header_top' );
}

function king_header_bottom() {
	do_action( 'king_header_bottom' );
}

/**
* Semantic <content> hooks
* 
* $king_supports[] = 'content';
*/
function king_content_before() {
	do_action( 'king_content_before' );
}

function king_content_after() {
	do_action( 'king_content_after' );
}

function king_content_top() {
	do_action( 'king_content_top' );
}

function king_content_bottom() {
	do_action( 'king_content_bottom' );
}

/**
* Semantic <entry> hooks
* 
* $king_supports[] = 'entry';
*/
function king_entry_before() {
	do_action( 'king_entry_before' );
}

function king_entry_after() {
	do_action( 'king_entry_after' );
}

function king_entry_top() {
	do_action( 'king_entry_top' );
}

function king_entry_bottom() {
	do_action( 'king_entry_bottom' );
}

/**
* Comments block hooks
* 
* $king_supports[] = 'comments';
*/
function king_comments_before() {
	do_action( 'king_comments_before' );
}

function king_comments_after() {
	do_action( 'king_comments_after' );
}

/**
* Semantic <sidebar> hooks
* 
* $king_supports[] = 'sidebar';
*/
function king_sidebars_before() {
	do_action( 'king_sidebars_before' );
}

function king_sidebars_after() {
	do_action( 'king_sidebars_after' );
}

function king_sidebar_top() {
	do_action( 'king_sidebar_top' );
}

function king_sidebar_bottom() {
	do_action( 'king_sidebar_bottom' );
}

/**
* Semantic <footer> hooks
* 
* $king_supports[] = 'footer';
*/
function king_footer_before() {
	do_action( 'king_footer_before' );
}

function king_footer_after() {
	do_action( 'king_footer_after' );
}

function king_footer_top() {
	do_action( 'king_footer_top' );
}

function king_footer_bottom() {
	do_action( 'king_footer_bottom' );
}