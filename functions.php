<?php
// Set content width value based on the theme's design
if ( ! isset( $content_width ) )
	$content_width = 600;


/**
 * King setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * King supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 *
 * @since King 1.0
 */
function king_setup() {

	// Add theme support for Automatic Feed Links
	add_theme_support( 'automatic-feed-links' );

	// Add theme support for Post Formats
	add_theme_support( 'post-formats', array( 'status', 'quote', 'gallery', 'image', 'video', 'audio', 'link', 'aside' ) );

	// Add theme support for Featured Images
	add_theme_support( 'post-thumbnails' );

	// Add theme support for Custom Background
	$background_args = array(
		'default-color'          => '#e6e6e6',
	);
	add_theme_support( 'custom-background', $background_args );

	// Add theme support for Custom Header
	$header_args = array(
		'default-image'          => '',
		'width'                  => 0,
		'height'                 => 0,
		'flex-width'             => false,
		'flex-height'            => false,
		'uploads'                => false,
		'random-default'         => false,
		'header-text'            => false,
		'default-text-color'     => '',
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $header_args );

	// Add theme support for HTML5 Semantic Markup
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	// Add theme support for document Title tag
	add_theme_support( 'title-tag' );

	// Add theme support for custom CSS in the TinyMCE visual editor
	add_editor_style();

	// Add theme support for Translation
	load_theme_textdomain( 'king', get_template_directory() . '/language' );

	// Declare support for all custom hooks
	add_theme_support( 'king_hooks', array( 'all' ) );

	// Woocommerce Support
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'king_setup' );

/**
 * Enqueue scripts and styles for admin backend
 *
 * @since King 1.0
 */
add_action('admin_enqueue_scripts','king_admin_styles');
function king_admin_styles(){
	$king_admin_url = get_template_directory_uri() . '/inc/admin/assets/';
	wp_enqueue_style('king-admin', $king_admin_url.'css/admin.css');
}

/**
 * Enqueue scripts and styles for front-end.
 *
 * @since King 1.0
 */
function king_scripts_styles() {
	global $wp_styles;
	
	// Loads our main stylesheet.
	wp_register_style( 'king-style', get_stylesheet_uri(), array( 'king-slick-slider' ), '1.0.0', 'all' );
	wp_enqueue_style( 'king-style' );
	wp_register_style( 'king-bootstrap-grid', get_template_directory_uri().'/inc/css/bootstrap-grids.css', false, '1.0.0', 'all' );
	wp_enqueue_style( 'king-bootstrap-grid' );
	wp_register_style( 'king-font-icons', get_template_directory_uri().'/inc/css/font-awesome.min.css', false, '4.3.0', 'all' );
	wp_enqueue_style( 'king-font-icons' );
		
	// Loads the Internet Explorer specific stylesheet.
	$wp_styles->add('king-ie', get_template_directory_uri() . '/inc/css/ie.css');
	$wp_styles->add_data('king-ie', 'conditional', 'lte IE 9');
	$wp_styles->enqueue(array('king-ie'));

	// Add global jQuery
	wp_enqueue_script('jquery');

	// Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use)
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Bootstrap Javascript
	wp_register_script( 'king-bootstrap-script', get_template_directory_uri() . '/inc/js/jquery.bootstrap.min.js', array( 'jquery' ), '3.3.1', true );
	wp_enqueue_script( 'king-bootstrap-script' );
	
	// Load Masonry Javascript
	$masonry_blog_layout = get_theme_mod('blog_masonry_layout', true);
	$blog_layout = get_theme_mod('blog_layout', 'grid-3');
	if($blog_layout == 'grid-2' || $blog_layout == 'grid-3' || $blog_layout == 'grid-4') :
		if ( $masonry_blog_layout ) :
			if ( is_home() || is_archive() || is_search() ) :
				wp_enqueue_script('jquery-masonry');
			endif;
		endif;
	endif;

	// Slick Slider
	wp_register_style( 'king-slick-slider', get_template_directory_uri().'/inc/css/slick/slick.css', false, '1.4.0', 'all' );
	wp_enqueue_style( 'king-slick-slider' );
	wp_register_script( 'king-slick-slider-script', get_template_directory_uri() . '/inc/js/jquery.slick.min.js', array( 'jquery' ), '1.4.0', true );
	wp_enqueue_script( 'king-slick-slider-script' );

    // Justified Grid Gallery
    wp_register_style( 'king-justified-gallery', get_template_directory_uri().'/inc/css/justifiedGallery.min.css', false, '3.5.1', 'all' );
	wp_enqueue_style( 'king-justified-gallery' );
	wp_register_script( 'king-justified-gallery-script', get_template_directory_uri() . '/inc/js/jquery.justifiedGallery.min.js', array( 'jquery' ), '3.5.1', true );
	wp_enqueue_script( 'king-justified-gallery-script' );

    // Smooth Scroll
    wp_register_script( 'king-smooth-scroll-script', get_template_directory_uri() . '/inc/js/jquery.smoothScroll.min.js', array( 'jquery' ), '1.2.1', true );
	$smooth_scroll = get_theme_mod( 'smooth_scroll', true );
   	if($smooth_scroll) {
   		wp_enqueue_script( 'king-smooth-scroll-script' );
	}

	// Lightbox - Colorbox
	wp_register_style( 'king-colorbox', get_template_directory_uri().'/inc/css/colorbox/colorbox.css', false, '1.5.2', 'all' );
	wp_enqueue_style( 'king-colorbox' );
	wp_register_script( 'king-colorbox-script', get_template_directory_uri() . '/inc/js/jquery.colorbox.min.js', array( 'jquery' ), '1.5.2', true );
	wp_enqueue_script( 'king-colorbox-script' );

	// Theme JavaScript	
	wp_register_script( 'king-javascript', get_template_directory_uri() . '/inc/js/functions.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'king-javascript' );

	// Menu CSS
	wp_register_style( 'king-menu-css', get_template_directory_uri() . '/inc/css/menu.css', false, '1.0.0', 'all' );
    wp_enqueue_style( 'king-menu-css' );
	
	// Animate CSS
	wp_register_style( 'king-animate-css', get_template_directory_uri() . '/inc/css/animate.css', false, '1.0.0', 'all' );
    wp_enqueue_style( 'king-animate-css' );
	
}
add_action( 'wp_enqueue_scripts', 'king_scripts_styles' );

/**
 * King include basic functions.
 *
 */

require_once('inc/admin/customizer/customizer.php');
require_once('inc/admin/customizer/customizer-style.php');
require_once('inc/king-theme-hooks.php');
require_once('inc/king-breadcrumbs.php');
require_once('inc/king-pagination.php');
require_once('inc/king-post-gallery.php');
require_once('inc/king-post-meta.php');
require_once('inc/king-meta-box.php');
require_once('inc/king-oembeds.php');
require_once('inc/king-animation.php');
require_once('inc/king-infinite-scroll.php');
require_once('inc/king-widget.php');
require_once('inc/king-hex-rgba.php');
require_once('inc/king-woocommerce.php');


/**
 * Admin Menu
 *
 * Add customizer Link in Admin Menu Bar
 *
 * @since King 1.0
 *
 */
add_action('admin_bar_menu', 'king_add_toolbar_items', 100);
function king_add_toolbar_items($admin_bar){
	$king_admin_url = admin_url( 'customize.php', 'admin' );
    $admin_bar->add_menu( array(
        'id'    => 'customizer-item',
        'title' => '<span class="ab-icon"></span> Theme Options',
        'href'  => $king_admin_url,
        'meta'  => array(
            'title' => __('King Theme Options', 'king'),  
            'class' => 'customizer_menu_item_class'          
        ),
    ));
}


/**
 * Register menus in theme 
 *
 * Added two location primary & footer menu
 *
 * @since King 1.0
 *
 */

if ( ! function_exists( 'king_navigation_menus' ) ) :

	// Register Navigation Menus
	function king_navigation_menus() {

		$locations = array(
			'primary' => __( 'Primary Menu', 'king' ),
			'footer-menu' => __( 'Footer Menu', 'king' ),
		);
		register_nav_menus( $locations );
	}

	// Hook into the 'init' action
	add_action( 'init', 'king_navigation_menus' );

endif;


/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since King 1.0
 */
if ( ! function_exists( 'king_sidebar' ) ) :
	function king_sidebar() {
		register_sidebar( array(
			'name' => __( 'Main Sidebar', 'king' ),
			'id' => 'sidebar-1',
			'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'king' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>',
		) );
		register_sidebar( array(
			'name' => __( 'Footer Widget Area 1', 'king' ),
			'id' => 'sidebar-footer-1',
			'description' => __( 'Appears in footer sidebar widget area at first position.', 'king' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		
		register_sidebar( array(
			'name' => __( 'Footer Widget Area 2', 'king' ),
			'id' => 'sidebar-footer-2',
			'description' => __( 'Appears in footer sidebar widget area at second position.', 'king' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		
		register_sidebar( array(
			'name' => __( 'Footer Widget Area 3', 'king' ),
			'id' => 'sidebar-footer-3',
			'description' => __( 'Appears in footer sidebar widget area at third position.', 'king' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		
		register_sidebar( array(
			'name' => __( 'Footer Widget Area 4', 'king' ),
			'id' => 'sidebar-footer-4',
			'description' => __( 'Appears in footer sidebar widget area at fourth position.', 'king' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'name' => __( 'Front Page Main Widget Area', 'king' ),
			'id' => 'sidebar-front-main',
			'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'king' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'name' => __( 'First Front Page Widget Area', 'king' ),
			'id' => 'sidebar-front-1',
			'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'king' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'name' => __( 'Second Front Page Widget Area', 'king' ),
			'id' => 'sidebar-front-2',
			'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'king' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'name' => __( 'Third Front Page Widget Area', 'king' ),
			'id' => 'sidebar-front-3',
			'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'king' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
	}
	add_action( 'widgets_init', 'king_sidebar' );
endif;



/**
 * Return the Google font stylesheet URL if available.
 *
 * The use of Open Sans by default is localized. For languages that use
 * characters not supported by the font, the font can be disabled.
 *
 * @since King 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function king_get_font_url() {
	$font_url = '';
	/* translators: If there are characters in your language that are not supported
	 * by Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'king' ) ) {
		$subsets = 'latin,latin-ext';
		/* translators: To add an additional Open Sans character subset specific to your language,
		 * translate this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language.
		 */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'king' );
		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';
		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:400italic,700italic,400,700',
			'subset' => $subsets,
		);
		$font_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
	}
	return $font_url;
}

/**
 * Filter TinyMCE CSS path to include Google Fonts.
 *
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @uses king_get_font_url() To get the Google Font stylesheet URL.
 *
 * @since King 1.0
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string Filtered CSS path.
 */
function king_mce_css( $mce_css ) {
	$font_url = king_get_font_url();
	if ( empty( $font_url ) )
		return $mce_css;
	if ( ! empty( $mce_css ) )
		$mce_css .= ',';
	$mce_css .= esc_url_raw( str_replace( ',', '%2C', $font_url ) );
	return $mce_css;
}
add_filter( 'mce_css', 'king_mce_css' );

/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since King 1.0
 */
function king_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'king_page_menu_args' );

/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own king_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since King 1.0
 */
if ( ! function_exists( 'king_comment' ) ) :
function king_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'king' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'king' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'king' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'king' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'king' ); ?></p>
			<?php endif; ?>
			<div class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'king' ), '<p class="edit-link">', '</p>' ); ?>
			</div><!-- .comment-content -->
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'king' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since King 1.0
 *
 * @param array $classes Existing class values.
 * @return array Filtered class values.
 */
function king_body_class( $classes ) {

	$background_color = get_background_color();
	$background_image = get_background_image();

	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';

	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';

		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}

	if ( empty( $background_image ) ) :
		if ( empty( $background_color ) ) :
			$classes[] = 'custom-background-empty';
		elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) ) :
			$classes[] = 'custom-background-white';
		endif;
	endif;

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'king-fonts', 'queue' ) ) :
		$classes[] = 'custom-font-enabled';
	endif;

	if ( ! is_multi_author() ) :
		$classes[] = 'single-author';
	endif;

	// Site Layout
	$classes[] = get_theme_mod('site_layout', 'full-width');

	// Blog Layout
	$classes[] = get_theme_mod('blog_layout', 'grid-3');

	$blog_layout = get_theme_mod('blog_layout', 'grid-3');
	if($blog_layout == 'grid-2' || $blog_layout == 'grid-3' || $blog_layout == 'grid-4') :
		$classes[] = 'blog-grid';
	endif;

	// Enable Masonry Layout
	$masonry_layout = get_theme_mod('blog_masonry_layout', true);
	if($blog_layout == 'grid-2' || $blog_layout == 'grid-3' || $blog_layout == 'grid-4') :
		if ($masonry_layout) :
			$classes[] = 'blog-masonry';
		endif;
	endif;

	// Is not singular
	if ( ! is_singular() ) :
		$classes[] = 'not-singular';
	endif;

	// Sidebar Position
	$sidebar_position = get_theme_mod('sidebar_position', 'no-sidebar');
	$classes[] = $sidebar_position;	

	// Title Bar
	$title_bar = get_theme_mod('title_bar_layout', 'style-1');
	if( $title_bar == 'disable' ) :
		$classes[] = 'no-title-bar';
	else :
		$classes[] = 'title-bar';
	endif;

	// If fixed menu
	$fixed_header = get_theme_mod( 'site_fixed_header', true );
	if($fixed_header) :
		$classes[] = 'king-fixed-menu';
	endif;

	// Transparent header
	$transparent_header = get_post_meta( get_the_ID(), 'meta-transparent-header', true );
	if( $transparent_header == 'true' ) {
		$classes[] = 'king-transparent-header';
	}

	// King Full Width Template
	if ( is_page_template( 'page-templates/king-full-width.php' ) ) {
		$classes[] = 'page-template-king-full-width';
	}

	return $classes;
}
add_filter( 'body_class', 'king_body_class' );


/**
 * Extend the default WordPress post classes.
 *
 * Extends the default WordPress post class to denote: grid layouts
 *
 * @since King 1.0
 *
 * @param array $classes Existing class values.
 * @return array Filtered class values.
 */
function king_post_class( $classes ) {

	global $post;

	$blog_layout = get_theme_mod('blog_layout', 'grid-3');
	if ( !is_singular() ) :	
		if ($blog_layout == 'grid-2') {
			$classes[] = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
		} else if ($blog_layout == 'grid-3') {
			$classes[] = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
		} else if ($blog_layout == 'grid-4') {
			$classes[] = 'col-lg-3 col-md-3 col-sm-4 col-xs-12';
		} else {
			$classes[] = '';
		}
	endif;

	$classes[] = get_theme_mod('blog_featured_image_effect', 'king-blur');

	return $classes;
}
add_filter( 'post_class', 'king_post_class' );


/**
 * Adjust content width in certain contexts.
 * site_width
 * Adjusts  value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since King 1.0
 */
function king_site_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $site_width;
		$site_width = 960;
	}
}
add_action( 'template_redirect', 'king_site_width' );


/**
 * Include Javascript Snippet For Masonry Blog
 *
 * @since King 1.0
 */
function king_masonry_blog() {
	// Load Masonry Javascript
	$masonry_blog_layout = get_theme_mod('blog_masonry_layout', true);
	$blog_layout = get_theme_mod('blog_layout', 'grid-3');
	if($blog_layout == 'grid-2' || $blog_layout == 'grid-3' || $blog_layout == 'grid-4') :
		if ( $masonry_blog_layout ) :
			if ( is_home() || is_archive() || is_search() ) : ?>
				<script type="text/javascript">
					(function($) {
						"use strict";
						function blog_masonry() {
							$('.blog-masonry #content').imagesLoaded(function () {
								$('.blog-masonry #content').masonry({
									columnWidth: '.post',
									itemSelector: '.post',
									transitionDuration: 0
								});
							});
						}
						$(document).ready(function() { blog_masonry(); });
						$(window).load(function(){
							setTimeout(function(){
								$('.blog-masonry #content').masonry('reload');
							},1000);
							
						});			
						//$(window).on('resize',function() { blog_masonry(); });
					})(jQuery);
				</script>
			<?php
			endif;
		endif;
	endif;
}
add_action('wp_footer', 'king_masonry_blog');

/**
 * Include Scroll To Top Feature
 *
 * @since King 1.0
 */
function king_scroll_to_top() {
?>
	<script type="text/javascript">
	jQuery(function() {
		jQuery('.king-scroll-top').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			  var target = jQuery(this.hash);
			  target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
			  if (target.length) {
				jQuery('html,body').animate({
				  scrollTop: target.offset().top
				}, 1000);
				return false;
			  }
			}
		});
		jQuery(document).scroll(function(){
			var wh = jQuery(window).height()/3;
			if (jQuery(this).scrollTop() > wh) {
				jQuery('.king-scroll-top').addClass('king-scroll-top-show');
			} else {
				jQuery('.king-scroll-top').removeClass('king-scroll-top-show');
			}
		});
	});
	</script>
	<a class="king-scroll-top" href="#page"><span class="fa fa-angle-up"></span></a>
	<!--End Smooth Scroll-->
<?php
}
$scroll_to_top = get_theme_mod( 'scroll_to_top', true );
if($scroll_to_top) {
	add_action('wp_footer', 'king_scroll_to_top');
}

/**
 * Custom Excerpt Length
 *
 * @since King 1.0
 */
if ( ! function_exists( 'king_excerpt_length' ) ) :
	function king_excerpt_length( $length ) {
		$excerpt_length = get_theme_mod( 'post_excerpt_length', '25' );
		return $excerpt_length;
	}
	add_filter( 'excerpt_length', 'king_excerpt_length', 999 );
endif;

/**
 * Add new image Size for Medium Image Blog
 *
 * @since King 1.0
 */
add_image_size( 'medium-image-blog', 330, 215, true ); // (cropped)
add_filter( 'image_size_names_choose', 'king_image_sizes' );
function king_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'medium-image-blog' => __( 'Medium Blog Image', 'king' ),
    ) );
}

/**
 * Sidebar Position
 *
 * @since King 1.0
 */
if ( ! function_exists( 'king_sidebar_position' ) ) :
	function king_sidebar_position() {

		$sidebar_pos = get_theme_mod('sidebar_position', 'no-sidebar');
		if ($sidebar_pos != 'no-sidebar') :

			if ( !is_page_template( 'page-templates/king-full-width.php' ) && !is_page_template( 'page-templates/front-page.php' )) :
				add_action('king_content_after','get_sidebar', 10, 1);
			endif;

		endif;
	}
	add_action( 'wp', 'king_sidebar_position' );
endif;

/**
 * Fevicom Image
 *
 * @since King 1.0
 */
if ( ! function_exists( 'king_favicon' ) ) :
	function king_favicon() {
		$favicom_image = get_theme_mod( 'favicon-img' );
		if ($favicom_image)
		echo '<link rel="icon" href="'. get_theme_mod( 'favicon-img' ) .'" type="image/x-png"/>';
	}
	add_action('king_head_bottom', 'king_favicon');
endif;

/**
 * Custom CSS
 *
 * @since King 1.0
 */
if ( ! function_exists( 'king_custom_css' ) ) :
	function king_custom_css() {
		$custom_css = get_theme_mod( 'custom_css' );
		if ($custom_css)
		echo '<style type="text/css">'. $custom_css .'</style>';
	}
	add_action('wp_head', 'king_custom_css');
endif;

/**
 * Custom Script
 *
 * @since King 1.0
 */
if ( ! function_exists( 'king_custom_script' ) ) :
	function king_custom_script() {
		$custom_script = get_theme_mod( 'custom_script' );
		if ($custom_script)
		echo $custom_script;
	}
	add_action('wp_footer', 'king_custom_script');
endif;

/**
 * Next / Previous post link on single page
 *
 * @since King 1.0
 */
if ( ! function_exists( 'king_single_post_navigation' ) ) :
	function king_single_post_navigation() { ?>
		<?php if(is_attachment()) : ?>
			<nav class="nav-single clear">
			<h3 class="assistive-text"><?php _e( 'Image navigation', 'king' ); ?></h3>			
			<span class="nav-previous"><?php previous_image_link( false, __( '<span class="meta-nav">&larr; Previous</span>', 'king' ) ); ?></span>
			<span class="nav-next"><?php next_image_link( false, __( '<span class="meta-nav">Next &rarr;</span>', 'king' ) ); ?></span>
			</nav><!-- .nav-single -->
		<?php elseif(is_single()) : ?>
			<nav class="nav-single clear">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'king' ); ?></h3>
			<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'king' ) . '</span> %title' ); ?></span>
			<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'king' ) . '</span>' ); ?></span>
			</nav><!-- .nav-single -->
		<?php endif; ?>
		<?php
	} 
	add_action('king_entry_after', 'king_single_post_navigation');
endif;

/**
 * Header Text on Archive Pages
 *
 * @since King 1.0
 */
if ( ! function_exists( 'king_archive_header_text' ) ) :
	function king_archive_header_text() { ?>
		<?php if(is_archive()) : ?>

			<?php if(is_date()) : ?>

				<header class="archive-header">
					<h1 class="archive-title"><?php
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'king' ), '<span>' . get_the_date() . '</span>' );
						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'king' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'king' ) ) . '</span>' );
						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'king' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'king' ) ) . '</span>' );
						else :
							_e( 'Archives', 'king' );
						endif;
					?></h1>
				</header><!-- .archive-header -->

			<?php elseif(is_category()) : ?>

				<header class="archive-header">
					<h1 class="archive-title"><?php printf( __( 'Category Archives: %s', 'king' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
					<?php if ( category_description() ) : // Show an optional category description ?>
						<div class="archive-meta"><?php echo category_description(); ?></div>
					<?php endif; ?>
				</header><!-- .archive-header -->

			<?php elseif(is_tag()) : ?>

					<header class="archive-header">
						<h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', 'king' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>
						<?php if ( tag_description() ) : // Show an optional tag description ?>
							<div class="archive-meta"><?php echo tag_description(); ?></div>
						<?php endif; ?>
					</header><!-- .archive-header -->

			<?php elseif(is_author()) : ?>

				<header class="archive-header">
					<h1 class="archive-title"><?php printf( __( 'Author Archives: %s', 'king' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
				</header><!-- .archive-header -->

				<?php
				// If a user has filled out their description, show a bio on their entries.
				if ( get_the_author_meta( 'description' ) ) : ?>
					<div class="author-info">
						<div class="author-avatar">
							<?php
								$author_bio_avatar_size = apply_filters( 'king_author_bio_avatar_size', 68 );
								echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
							?>
						</div><!-- .author-avatar -->
						<div class="author-description">
							<h2><?php printf( __( 'About %s', 'king' ), get_the_author() ); ?></h2>
							<p><?php the_author_meta( 'description' ); ?></p>
						</div><!-- .author-description	-->
					</div><!-- .author-info -->
				<?php endif; ?>

			<?php endif; ?>

		<?php endif; ?>

		<?php
	}	
	add_action('king_content_top', 'king_archive_header_text');
endif;

/**
 * Header Layout
 *
 * @since King 1.0
 */
if ( ! function_exists( 'king_header_layout' ) ) :
	function king_header_layout() { 
		$header_layout = get_theme_mod('header_layout', 'header_1');
		if($header_layout == 'header_2'){
			get_header('style2');
		} 
		else if($header_layout == 'header_3'){
			get_header('style3');
		} 
		else {
			get_header('style1');
		}
	}	
	add_action('king_header_bottom', 'king_header_layout');
endif;

/**
 * Title & Breadcrumb Bar
 *
 * @since King 1.0
 */
if ( ! function_exists( 'king_title_breadcrumb_bar' ) ) :
	function king_title_breadcrumb_bar() { ?>

		<?php
			global $post;

			$title_bar = get_theme_mod('title_bar_layout', 'style-1');
			$meta_value = get_post_meta( $post->ID, 'meta-title-bar', true );

			$breadcrumb_bar = get_theme_mod('breadcrumb_bar', 'enable');
			$meta_breadcrumb_value = get_post_meta( $post->ID, 'meta-breadcrumb-bar', true );
			if(($breadcrumb_bar == 'enable') && ($meta_breadcrumb_value == 'true')) :
				$title_bar_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
			else:
				$title_bar_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
			endif;

			if(!is_home() && ($title_bar != 'disable') ) :

				if($meta_value != 'false') : ?>

					<div class="king-page-header">
						<div class="king-row">
							<div class="king-container">
								<div class="<?php echo $title_bar_class; ?> text-left king-title">
									<?php
										if(is_404()){
											$title = _e( '404 - Page Not Found!', 'king' ); ;
										} elseif(is_search()){
											$title = _e( 'Search Results For: ' . get_search_query(), 'king' );
										} elseif(is_archive()){
											if(is_date()) :
												if ( is_day() ) :
													$title = _e( 'Daily Archives: ' . get_the_date(), 'king' ); ;
												elseif ( is_month() ) :
													$title = _e( 'Monthly Archives: ' . get_the_date( _x( 'F Y', 'monthly archives date format', 'king' )), 'king' );
												elseif ( is_year() ) :
													$title = _e( 'Yearly Archives: ' . get_the_date( _x( 'Y', 'yearly archives date format', 'king' )), 'king' );
												endif;
											elseif(is_category()) :
												$title =  _e( 'Category Archives: ' . single_cat_title( '', false ), 'king' );
											elseif(is_tag()) :
												$title =  _e( 'Tag Archives: ' . single_tag_title( '', false ), 'king' );
											elseif(is_author()) :
												$title =  _e( 'Author Archives: ' . get_the_author(), 'king' );
											else :
												$title = _e( 'Archives', 'king' );
											endif;
										} else {
											if( is_home() && get_option('page_for_posts') ) {
												$blog_page_id = get_option('page_for_posts');
												$title = get_page($blog_page_id)->post_title;
											} else {
												$title = $post->post_title;
											}
										}
										echo '<div class="king-breadcrumb-title">';
										echo '<h3>'. __($title, 'king') .'</h3>';
										echo '</div>';
									?>
								</div>
								<?php if(($breadcrumb_bar == 'enable') && ($meta_breadcrumb_value == 'true')) : ?>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right king-breadcrumb">
										<?php
											if( function_exists('king_breadcrumb')) {
												king_breadcrumb();
											}
										?>
									</div>
								<?php endif; ?>
							</div><!-- .king-container --> 
						</div><!-- .king-row --> 
					</div><!-- .king-page-header --> 

				<?php endif; ?>
			<?php endif; ?>
		<?php 
	}	
	add_action('king_header_after', 'king_title_breadcrumb_bar');
endif;

/**
 * Author Bio
 *
 * @since King 1.0
 */
if ( ! function_exists( 'king_author_bio' ) ) :
	function king_author_bio() { ?>
		<?php if( is_single() ) : ?>		
			<footer class="entry-meta">
				<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
					<div class="author-info">
						<div class="author-avatar">
							<?php
							/** This filter is documented in author.php */
							$author_bio_avatar_size = apply_filters( 'king_author_bio_avatar_size', 68 );
							echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
							?>
						</div><!-- .author-avatar -->
						<div class="author-description">
							<h2><?php printf( __( 'About %s', 'king' ), get_the_author() ); ?></h2>
							<p><?php the_author_meta( 'description' ); ?></p>
							<div class="author-link">
								<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'king' ), get_the_author() ); ?>
								</a>
							</div><!-- .author-link	-->
						</div><!-- .author-description -->
					</div><!-- .author-info -->
				<?php endif; ?>
			</footer><!-- .entry-meta -->
		<?php endif; ?>	
	<?php 
	}	
	add_action('king_entry_bottom', 'king_author_bio', 20, 1);
endif;

/**
 * Custom Search Form
 *
 * @since King 1.0
 */
if ( ! function_exists( 'king_search_form' ) ) :
	function king_search_form( $form ) {
		$value_placeholder = __( "type here..." , "king" );
		$placeholder = __( "'type here...'" , "king" );
		$empty_placeholder = __( "''" , "king" );
		$form = '<form action="' . esc_url(home_url( "/" )) . '" method="get" id="searchform">
				<fieldset>
				<div id="searchbox">
				<input class="input" name="s" type="text" id="s" value="'.  $value_placeholder .'" onfocus="if (this.value == '. $placeholder .') {this.value = '. $empty_placeholder .' }" onblur="if (this.value == '. $empty_placeholder .') {this.value = '. $placeholder .'}">
				<button type="submit" id="searchsubmit" class="king-bkg king-bkg-dark-hover"><i class="fa fa-search"></i></button>
				</div>
				</fieldset>
				</form>';
		return $form;
	}
	add_filter( 'get_search_form', 'king_search_form' );
endif;

// Front Page Bottom Sidebar
if ( ! function_exists( 'king_front_page_bottom_sidebar' ) ) :
	function king_front_page_bottom_sidebar() {
		if (is_page_template( 'page-templates/front-page.php' )) {
			get_sidebar('front');
		}
	}
	add_action('king_content_after', 'king_front_page_bottom_sidebar', 20, 1);
endif;

// Front Page Content Sidebar
if ( ! function_exists( 'king_front_page_content_sidebar' ) ) :
	function king_front_page_content_sidebar() { 
		?>
		<?php if ( is_active_sidebar( 'sidebar-front-main' ) ) : ?>
			<div class="frontpage-main-widget-area clear">
				<?php dynamic_sidebar( 'sidebar-front-main' ); ?>
			</div><!-- .first -->
		<?php endif; ?>
		<?php
	}
	add_action('king_entry_after', 'king_front_page_content_sidebar', 10, 1);
endif;



?>