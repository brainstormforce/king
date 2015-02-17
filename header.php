<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Ultimate
 * @since Ultimate 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<?php ult_html_before(); ?><html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<?php ult_head_top(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php ult_head_bottom(); ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php ult_body_top(); ?>
<div id="page" class="site">

	<?php ult_header_before(); ?>
	<div id="header">
		<?php ult_header_top(); ?>
			<?php
				// Select Header Style
				$header_layout = get_theme_mod('header_layout');
				if($header_layout == 'header_2'){
					get_header('style2');
				} 
				else if($header_layout == 'header_3'){
					get_header('style3');
				} 
				else {
					get_header('style1');
				}
			?>
		<?php ult_header_bottom(); ?>
	</div> <!-- #header -->
	<?php ult_header_after(); ?>
	
	<?php 
		// Title & Breadcrumb Bar
		global $post;
		$meta_value = get_post_meta( $post->ID, 'meta-breadcrumb', true );
		if($meta_value != 'false'){
			if(!is_home()){
				get_header('title-bar');
			}
		}
	?>

	<div id="main" class="wrapper">
