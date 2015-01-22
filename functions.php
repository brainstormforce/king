<?php
// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 625;
/**
 * Ultimate setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Ultimate supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Ultimate 1.0
 */
function ultimate_setup() {
	/*
	 * Makes Ultimate available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Ultimate, use a find and replace
	 * to change 'ultimate' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'ultimate', get_template_directory() . '/languages' );
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'video', 'quote', 'status', 'gallery', 'audio') );
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menu( 'primary', __( 'Primary Menu', 'ultimate' ) );
	register_nav_menu( 'footer-menu', __( 'Footer Menu', 'ultimate' ) );
	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );
	// Default RSS feed links
	add_theme_support( 'automatic-feed-links' );
	
	// Support post_thumbnail
	add_theme_support( 'the_post_thumbnail' );
	
	// Default custom header
	add_theme_support( 'custom-header' );
		
	// Woocommerce Support
	add_theme_support( 'woocommerce' );
	
	// Add support to <title> tag
	add_theme_support( "title-tag" );
	
	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'ultimate_setup' );
/**
 * Return the Google font stylesheet URL if available.
 *
 * The use of Open Sans by default is localized. For languages that use
 * characters not supported by the font, the font can be disabled.
 *
 * @since Ultimate 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function ultimate_get_font_url() {
	$font_url = '';
	/* translators: If there are characters in your language that are not supported
	 * by Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'ultimate' ) ) {
		$subsets = 'latin,latin-ext';
		/* translators: To add an additional Open Sans character subset specific to your language,
		 * translate this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language.
		 */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'ultimate' );
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
 * Enqueue scripts and styles for front-end.
 *
 * @since Ultimate 1.0
 */
function ultimate_scripts_styles() {
	global $wp_styles;
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	wp_enqueue_style( 'ultimate-fonts', get_template_directory_uri().'/css/entypo.css');
	wp_enqueue_style( 'ultimate-fonts', get_template_directory_uri().'/css/font-awesome.css');
	// Loads our main stylesheet.
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'ultimate-bootstrap', get_template_directory_uri().'/css/bootstrap-grids.css');
		
	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'ultimate-ie', get_template_directory_uri() . '/css/ie.css', array( 'ultimate-style' ), '20121010' );
	
	wp_enqueue_script('jQuery');
	$wp_styles->add_data( 'ultimate-ie', 'conditional', 'lt IE 9' );
    wp_enqueue_script('jquery.bootstrap.min', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'),'1.0.0',true);
    //wp_enqueue_script('jquery.bootstrap.min');
	
	// Load Masonry Javascript
	if ( get_theme_mod('blog_layout') !== 'normal' ) {
		if ( is_home() || is_front_page() || is_archive() || is_search() || is_category() ) {
			wp_enqueue_script('jquery-masonry');
			add_action('wp_footer', 'ultimate_masonry_blog');
		}
	}

	// Slick SLider
	wp_enqueue_style( 'slick-slider-css', get_template_directory_uri().'/css/slick/slick.css');
	wp_register_script( 'slick-slider-script', get_template_directory_uri() . '/js/slick.min.js' );
    wp_enqueue_script( 'slick-slider-script' );

	wp_register_script( 'smooth-scroll-script', get_template_directory_uri() . '/js/SmoothScroll.js' );
    wp_enqueue_script( 'smooth-scroll-script' );
	
    wp_register_script('jquery.functions', get_template_directory_uri() . '/js/functions.js', array('jquery'),'1.0.0',true);
    wp_enqueue_script('jquery.functions');
	
}
add_action( 'wp_enqueue_scripts', 'ultimate_scripts_styles' );

/**
 * Filter TinyMCE CSS path to include Google Fonts.
 *
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @uses ultimate_get_font_url() To get the Google Font stylesheet URL.
 *
 * @since Ultimate 1.0
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string Filtered CSS path.
 */
function ultimate_mce_css( $mce_css ) {
	$font_url = ultimate_get_font_url();
	if ( empty( $font_url ) )
		return $mce_css;
	if ( ! empty( $mce_css ) )
		$mce_css .= ',';
	$mce_css .= esc_url_raw( str_replace( ',', '%2C', $font_url ) );
	return $mce_css;
}
add_filter( 'mce_css', 'ultimate_mce_css' );

/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Ultimate 1.0
 */
function ultimate_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'ultimate_page_menu_args' );
/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since Ultimate 1.0
 */
function ultimate_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'ultimate' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'ultimate' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Front Page Main Widget Area', 'ultimate' ),
		'id' => 'sidebar-2',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'ultimate' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'First Front Page Widget Area', 'ultimate' ),
		'id' => 'sidebar-3',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'ultimate' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Second Front Page Widget Area', 'ultimate' ),
		'id' => 'sidebar-4',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'ultimate' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Third Front Page Widget Area', 'ultimate' ),
		'id' => 'sidebar-5',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'ultimate' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Widget Area 1', 'ultimate' ),
		'id' => 'sidebar-footer-1',
		'description' => __( 'Appears in footer sidebar widget area at first position.', 'ultimate' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widget Area 2', 'ultimate' ),
		'id' => 'sidebar-footer-2',
		'description' => __( 'Appears in footer sidebar widget area at second position.', 'ultimate' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widget Area 3', 'ultimate' ),
		'id' => 'sidebar-footer-3',
		'description' => __( 'Appears in footer sidebar widget area at third position.', 'ultimate' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widget Area 4', 'ultimate' ),
		'id' => 'sidebar-footer-4',
		'description' => __( 'Appears in footer sidebar widget area at fourth position.', 'ultimate' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'ultimate_widgets_init' );
if ( ! function_exists( 'ultimate_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Ultimate 1.0
 */
function ultimate_content_nav( $html_id ) {
	global $wp_query;
	$html_id = esc_attr( $html_id );
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation clear" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'ultimate' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'ultimate' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'ultimate' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;
if ( ! function_exists( 'ultimate_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own ultimate_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Ultimate 1.0
 */
function ultimate_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'ultimate' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'ultimate' ), '<span class="edit-link">', '</span>' ); ?></p>
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
						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'ultimate' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'ultimate' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'ultimate' ); ?></p>
			<?php endif; ?>
			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'ultimate' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'ultimate' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;
if ( ! function_exists( 'ultimate_entry_meta' ) ) :
/**
 * Set up post entry meta.
 *
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own ultimate_entry_meta() to override in a child theme.
 *
 * @since Ultimate 1.0
 */
function ultimate_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ' ', 'ultimate' ) );
	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ' ', 'ultimate' ) );
	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'ultimate' ), get_the_author() ) ),
		get_the_author()
	);
	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'ultimate' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'ultimate' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'ultimate' );
	}
	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
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
 * @since Ultimate 1.0
 *
 * @param array $classes Existing class values.
 * @return array Filtered class values.
 */
function ultimate_body_class( $classes ) {
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
	if ( empty( $background_image ) ) {
		if ( empty( $background_color ) )
			$classes[] = 'custom-background-empty';
		elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
			$classes[] = 'custom-background-white';
	}
	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'ultimate-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';
	if ( ! is_multi_author() )
		$classes[] = 'single-author';
	return $classes;
}
add_filter( 'body_class', 'ultimate_body_class' );
/**
 * Adjust content width in certain contexts.
 *
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since Ultimate 1.0
 */
function ultimate_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 960;
	}
}
add_action( 'template_redirect', 'ultimate_content_width' );
/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Ultimate 1.0
 */
function ultimate_customize_preview_js() {
	wp_enqueue_script( 'ultimate-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130301', true );
}
add_action( 'customize_preview_init', 'ultimate_customize_preview_js' );


/**
 * Include Javascript Snippet For Masonry Blog
 *
 * @since Ultimate 1.0
 */
function ultimate_masonry_blog() { 
?>
	<script type="text/javascript">
		// Apply Masonry Effect To Blog
		jQuery(window).load(function() {
			var container = document.querySelector('.blog-masonry');
			var msnry = new Masonry( container, {
				columnWidth: '.post',
				itemSelector: '.post'
			});
		});
	</script>
<?php
}

/* Adds a meta box to the post editing screen */
function ult_custom_meta() {
	add_meta_box( 'ult_meta', __( 'Header & Menu Settings', 'ultimate' ), 'ult_meta_callback', 'page' );
}
add_action( 'add_meta_boxes', 'ult_custom_meta' );
/* Outputs the content of the meta box */
function ult_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'ult_nonce' );
    $ult_stored_meta = get_post_meta( $post->ID );
    $fixed_header = get_theme_mod( 'site_fixed_header' );
   	if($fixed_header): ?>
    <p>
    <div class="ult-row-content">
    	<label><?php _e( 'Enable transparant menu -', 'ultimate' )?></label>
        <label for="meta-radio-one">
            <input type="radio" name="meta-radio" id="meta-radio-one" value="true" <?php 
				if ( isset ( $ult_stored_meta['meta-radio'] ) ) 
					checked( $ult_stored_meta['meta-radio'][0], 'true' ); 
			?>>
            <?php _e( 'Yes', 'ultimate' )?>
        </label>

        <label for="meta-radio-two">
            <input type="radio" name="meta-radio" id="meta-radio-two" value="false" <?php 
				if ( isset ( $ult_stored_meta['meta-radio'] ) ) 
					checked( $ult_stored_meta['meta-radio'][0], 'false' );
				else
					echo 'checked="checked"'; 
			?>>
            <?php _e( 'No', 'ultimate' )?>
        </label>
    </div>
    </p>
     <?php endif; ?>
     <p>
    <div class="ult-row-content">
    	<label><?php _e( 'Enable light menu -', 'ultimate' )?></label>
        <label for="meta-radio-one">
            <input type="radio" name="meta-radio1" id="meta-radio-three" value="true" <?php if ( isset ( $ult_stored_meta['meta-radio1'] ) ) checked( $ult_stored_meta['meta-radio1'][0], 'true' ); ?>>
            <?php _e( 'Yes', 'ultimate' )?>
        </label>
        <label for="meta-radio-two">
            <input type="radio" name="meta-radio1" id="meta-radio-four" value="false" <?php 
				if ( isset ( $ult_stored_meta['meta-radio1'] ) ) 
					checked( $ult_stored_meta['meta-radio1'][0], 'false' ); 
				else
					echo 'checked="checked"';
			?>>
            <?php _e( 'No', 'ultimate' )?>
        </label>
    </div>
	</p>

	<p>
    <div class="ult-row-content">
    	<label><?php _e( 'Enable Breadcrumbs -', 'ultimate' )?></label>
        <label for="meta-radio-five">
            <input type="radio" name="meta-breadcrumb" id="meta-radio-five" value="true" <?php 
            	if ( isset ( $ult_stored_meta['meta-breadcrumb'] ) ) 
            			checked( $ult_stored_meta['meta-breadcrumb'][0], 'true' ); 
            	else
					echo 'checked="checked"';
            	?>>
            <?php _e( 'Yes', 'ultimate' )?>
        </label>
        <label for="meta-radio-six">
            <input type="radio" name="meta-breadcrumb" id="meta-radio-six" value="false" <?php 
				if ( isset ( $ult_stored_meta['meta-breadcrumb'] ) ) 
					checked( $ult_stored_meta['meta-breadcrumb'][0], 'false' ); 
			?>>
            <?php _e( 'No', 'ultimate' )?>
        </label>
    </div>
	</p>
 
    <?php
}
/* Saves the custom meta input */
function ult_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'ult_nonce' ] ) && wp_verify_nonce( $_POST[ 'ult_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
     // Checks for input and saves if needed
	if( isset( $_POST[ 'meta-radio' ] ) ) {
		update_post_meta( $post_id, 'meta-radio', $_POST[ 'meta-radio' ] );
	}
	if( isset( $_POST[ 'meta-radio1' ] ) ) {
		update_post_meta( $post_id, 'meta-radio1', $_POST[ 'meta-radio1' ] );
	}
	if( isset( $_POST[ 'meta-breadcrumb' ] ) ) {
		update_post_meta( $post_id, 'meta-breadcrumb', $_POST[ 'meta-breadcrumb' ] );
	}
}
add_action( 'save_post', 'ult_meta_save' );

/* Add specific CSS class by filter */
add_filter('body_class','ultimate_body_class_name');
function ultimate_body_class_name($classes) {
	global $post;
	
	// add a custom class for transparent header
	$meta_value = get_post_meta( get_the_ID(), 'meta-radio', true );
	$meta_value1 = get_post_meta( get_the_ID(), 'meta-radio1', true );
	if( $meta_value == 'true' ) {
		$classes[] = 'ult-transparent-header';
	}	
	
	if( $meta_value1 == 'true' ) {
		$classes[] = 'ult-light-menu';
	}	 
    return $classes;
	
}
require_once('theme-customizer.php');
require_once('lib/ultimate-breadcrumbs.php');
require_once('lib/ultimate-widget.php');

function wpt_register_js() {
    wp_register_script('jquery.bootstrap.min', get_template_directory_uri() . '/js/bootstrap.min.js', 'array(jquery)');
    wp_enqueue_script('jquery.bootstrap.min');
}

// add_action( 'init', 'wpt_register_js' );
function wpt_register_css() {
   // wp_register_style( 'bootstrap.min', get_template_directory_uri() . '/css/bootstrap.min.css' );
   // wp_enqueue_style( 'bootstrap.min' );

    wp_register_style( 'pratik.css', get_template_directory_uri() . '/css/pratik.css' );
    wp_enqueue_style( 'pratik.css' );

    wp_register_style( 'supriya.css', get_template_directory_uri() . '/css/supriya.css' );
    wp_enqueue_style( 'supriya.css' );
}
add_action( 'wp_enqueue_scripts', 'wpt_register_css' );

/**
 * Enqueue script for custom customize control.
 */
function custom_customize_enqueue() {
	echo '<style type="text/css">
			li#customize-control-favicon-img .thumbnail-image img {
				max-width: 18px;
				text-align: center;
				margin: 10px auto;
				display: block;
			}
		  </style>';
}
add_action( 'customize_controls_enqueue_scripts', 'custom_customize_enqueue' );

require_once('admin/meta.php');
require_once('admin/megamenu-admin-walker.php');
require_once('lib/ultimate-menu-walker.php');
require_once('lib/ultimate-pagination.php');


if ( ! function_exists( 'ultimate_gallery' ) ) :

function ultimate_gallery( $post_id , $post_content ) {

	if( has_shortcode( $post_content , 'gallery' ) ) :
		$gallery = get_post_gallery_images( $post_id );
		$galleryslider = "ultimate-gallery-".$post_id;
		$image_list ='<div class="ultimate-gallery '.$galleryslider.'"/>';
		$image_list .= '<div class="ultimate-gallery-slider">';                       
		foreach( $gallery as $image ) {
			// Loop through each image in each gallery
			$image_list .= '<div class="ultimate-gallery-img"><img src=" ' . str_replace('-150x150','',$image) . ' "  /></div>';
		}
		$image_list .= '</div>';
		$image_list .= '</div>';
		echo $image_list; 
		?>

		<script type="text/javascript">
			// Apply Masonry Effect To Blog
			jQuery(window).load(function() {
				jQuery('.ultimate-gallery-slider').slick({
					adaptiveHeight: true
				});
			});
		</script>

<?php
	endif; 
}
endif; 



/**
 * Custom contact widget
 *
 * @since Ultimate 1.0
 */
//contact form widget
// Creating the widget 
class ultimate_contact_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'ultimate_contact_widget', 

// Widget name will appear in UI
__('Ultimate contact Details', 'wpb_widget_domain'), 

// Widget description
array( 'description' => __( 'Sample widget Contact Details', 'wpb_widget_domain' ), ) );
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
$name = $instance[ 'name' ];
$address = $instance[ 'address' ];
$telephone = $instance[ 'telephone' ];
$mobile = $instance[ 'mobile' ];
$email = $instance[ 'email' ];
$fax = $instance[ 'fax' ];
$website = $instance[ 'website' ];
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output ?>
<div class="cntc-widget">
	<ul>
		<?php if( !empty( $name ) ) : ?>
		<li class="entuser"><?php echo $name; ?></li>
		<?php else :?>
		<li><?php echo $name; ?></li>
		<?php endif;?>
		<?php if( !empty( $address ) ) : ?>
		<li class="entlocation"><?php echo $address; ?></li>
		<?php else :?>
		<li><?php echo $address; ?></li>
		<?php endif;?>
		<?php if( !empty( $telephone ) ) : ?>
		<li class="entphone"><?php echo $telephone; ?></li>
		<?php else :?>
		<li><?php echo $telephone; ?></li>
		<?php endif;?>
		<?php if( !empty( $mobile ) ) : ?>
		<li class="entmobile"><?php echo $mobile; ?></li>
		<?php else : ?>
		<li><?php echo $mobile; ?></li>
		<?php endif; ?>
		<?php if( !empty( $email ) ) : ?>
		<li class="entmail"><?php echo $email; ?></li>
		<?php else : ?>
		<li><?php echo $email; ?></li>
		<?php endif; ?>
		<?php if( !empty( $fax ) ) : ?>
		<li class="entprinter"><?php echo $fax; ?></li>
		<?php else : ?>
		<li><?php echo $fax; ?></li>
		<?php endif; ?>
		<?php if( !empty( $website ) ) : ?>
		<li class="entearth"><?php echo $website; ?></li>
		<?php else :?>
		<li><?php echo $website; ?></li>
		<?php endif; ?>
	</ul>
</div>
<style>
.cntc-widget ul{
	margin: 0;
	padding: 0;
	line-height: 2em;
	font-family: 'Open Sans';
	font-size: 14px;
	width: 100%;
	position: relative;
	display: block;
	text-decoration: none;
	list-style: none;
}
.cntc-widget ul li{
	margin: 0;
	padding: 0;
	position: relative;
	display: block;
}
.cntc-widget ul li:hover{
	cursor: pointer;
}
.entlocation:before, .entuser:before, .entearth:before, .entprinter:before, .entmail:before, .entphone:before, .entmobile:before{
	font-family: entypo;
	font-size: 12px;
	line-height: 1.84em;
	padding: 0;
	position: absolute;
	left: 0;
}
</style>
<?php 
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'name' ] ) || isset( $instance[ 'address' ] ) || isset( $instance[ 'telephone' ] ) || isset( $instance[ 'mobile' ] ) || isset( $instance[ 'email' ] ) || isset( $instance[ 'fax' ] ) || isset( $instance[ 'website' ] ) ) {
$name = $instance[ 'name' ];
$address = $instance[ 'address' ];
$telephone = $instance[ 'telephone' ];
$mobile = $instance[ 'mobile' ];
$email = $instance[ 'email' ];
$fax = $instance[ 'fax' ];
$website = $instance[ 'website' ];
}
else {
$name = __( 'New name', 'wpb_widget_domain' );
$address = __( 'New address', 'wpb_widget_domain' );
$telephone = __( 'New telephone', 'wpb_widget_domain' );
$mobile = __( 'New mobile', 'wpb_widget_domain' );
$email = __( 'New email', 'wpb_widget_domain' );
$fax = __( 'New fax', 'wpb_widget_domain' );
$website = __( 'New website', 'wpb_widget_domain' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Name:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Address:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php echo esc_attr( $address ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'telephone' ); ?>"><?php _e( 'Telephone:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'telephone' ); ?>" name="<?php echo $this->get_field_name( 'telephone' ); ?>" type="text" value="<?php echo esc_attr( $telephone ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'mobile' ); ?>"><?php _e( 'Mobile:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'mobile' ); ?>" name="<?php echo $this->get_field_name( 'mobile' ); ?>" type="text" value="<?php echo esc_attr( $mobile ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Email:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo esc_attr( $email ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'fax' ); ?>"><?php _e( 'Fax:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'fax' ); ?>" name="<?php echo $this->get_field_name( 'fax' ); ?>" type="text" value="<?php echo esc_attr( $fax ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id( 'website' ); ?>"><?php _e( 'Website:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'website' ); ?>" name="<?php echo $this->get_field_name( 'website' ); ?>" type="text" value="<?php echo esc_attr( $website ); ?>" />
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['name'] = ( ! empty( $new_instance['name'] ) ) ? strip_tags( $new_instance['name'] ) : '';
$instance['address'] = ( ! empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';
$instance['telephone'] = ( ! empty( $new_instance['telephone'] ) ) ? strip_tags( $new_instance['telephone'] ) : '';
$instance['mobile'] = ( ! empty( $new_instance['mobile'] ) ) ? strip_tags( $new_instance['mobile'] ) : '';
$instance['email'] = ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';
$instance['fax'] = ( ! empty( $new_instance['fax'] ) ) ? strip_tags( $new_instance['fax'] ) : '';
$instance['website'] = ( ! empty( $new_instance['website'] ) ) ? strip_tags( $new_instance['website'] ) : '';
return $instance;
}
} // Class wpb_widget ends here

// Register and load the widget
function wpb_load_widget() {

	register_widget( 'ultimate_contact_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
?>