<?php
/**
* Theme Hook Alliance hook stub list.
*
* @package 		king
* @version		1.0
* @since		1.0
*/

/**
 * Define the version of ULT support, in case that becomes useful down the road.
 */
define( 'ULT_HOOKS_VERSION', '1.0' );

/** 
 * Themes and Plugins can check for ult_hooks using current_theme_supports( 'ult_hooks', $hook )
 * to determine whether a theme declares itself to support this specific hook type.
 * 
 * Example:
 * <code>
 * 		// Declare support for all hook types
 * 		add_theme_support( 'ult_hooks', array( 'all' ) );
 * 
 * 		// Declare support for certain hook types only
 * 		add_theme_support( 'ult_hooks', array( 'header', 'content', 'footer' ) );
 * </code>
 */
add_theme_support( 'ult_hooks', array(
	
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
	 * will be able to check whether the version of ULT supplied by the theme
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
 * 		if ( current_theme_supports( 'ult_hooks', 'header' ) )
 * 	  		add_action( 'ult_head_top', 'prefix_header_top' );	
 * </code>
 * 
 * @param bool $bool true
 * @param array $args The hook type being checked
 * @param array $registered All registered hook types
 * 
 * @return bool
 */
function ult_current_theme_supports( $bool, $args, $registered ) {
	return in_array( $args[0], $registered[0] ) || in_array( 'all', $registered[0] );
}
add_filter( 'current_theme_supports-ult_hooks', 'ult_current_theme_supports', 10, 3 );

/**
 * HTML <html> hook
 * Special case, useful for <DOCTYPE>, etc.
 * $ult_supports[] = 'html;
 */
 function ult_html_before() {
	 do_action( 'ult_html_before' );
 }
/**
 * HTML <body> hooks
 * $ult_supports[] = 'body';
 */
 function ult_body_top() {
	 do_action( 'ult_body_top' );
 }

 function ult_body_bottom() {
	 do_action( 'ult_body_bottom' );
 }
 
/**
* HTML <head> hooks
* 
* $ult_supports[] = 'head';
*/
function ult_head_top() {
	do_action( 'ult_head_top' );
}

function ult_head_bottom() {
	do_action( 'ult_head_bottom' );
}

/**
* Semantic <header> hooks
* 
* $ult_supports[] = 'header';
*/
function ult_header_before() {
	do_action( 'ult_header_before' );
}

function ult_header_after() {
	do_action( 'ult_header_after' );
}

function ult_header_top() {
	do_action( 'ult_header_top' );
}

function ult_header_bottom() {
	do_action( 'ult_header_bottom' );
}

/**
* Semantic <content> hooks
* 
* $ult_supports[] = 'content';
*/
function ult_content_before() {
	do_action( 'ult_content_before' );
}

function ult_content_after() {
	do_action( 'ult_content_after' );
}

function ult_content_top() {
	do_action( 'ult_content_top' );
}

function ult_content_bottom() {
	do_action( 'ult_content_bottom' );
}

/**
* Semantic <entry> hooks
* 
* $ult_supports[] = 'entry';
*/
function ult_entry_before() {
	do_action( 'ult_entry_before' );
}

function ult_entry_after() {
	do_action( 'ult_entry_after' );
}

function ult_entry_top() {
	do_action( 'ult_entry_top' );
}

function ult_entry_bottom() {
	do_action( 'ult_entry_bottom' );
}

/**
* Comments block hooks
* 
* $ult_supports[] = 'comments';
*/
function ult_comments_before() {
	do_action( 'ult_comments_before' );
}

function ult_comments_after() {
	do_action( 'ult_comments_after' );
}

/**
* Semantic <sidebar> hooks
* 
* $ult_supports[] = 'sidebar';
*/
function ult_sidebars_before() {
	do_action( 'ult_sidebars_before' );
}

function ult_sidebars_after() {
	do_action( 'ult_sidebars_after' );
}

function ult_sidebar_top() {
	do_action( 'ult_sidebar_top' );
}

function ult_sidebar_bottom() {
	do_action( 'ult_sidebar_bottom' );
}

/**
* Semantic <footer> hooks
* 
* $ult_supports[] = 'footer';
*/
function ult_footer_before() {
	do_action( 'ult_footer_before' );
}

function ult_footer_after() {
	do_action( 'ult_footer_after' );
}

function ult_footer_top() {
	do_action( 'ult_footer_top' );
}

function ult_footer_bottom() {
	do_action( 'ult_footer_bottom' );
}