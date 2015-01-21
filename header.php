<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="icon" href="<?php echo get_theme_mod( 'favicon-img' ); ?>" type="image/x-png"/>
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>
<?php get_template_part( 'lib/custom', 'style' );?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site <?php echo get_theme_mod('site_layout'); ?>">

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

    <?php
	// if(!is_home())
	// 		get_header('title-bar');
	?>
	<script>
	
	jQuery( function() {
        jQuery('.menu-toggle-wrap').click( function() {
        	jQuery('.nav-menu').toggle()});
	});

	jQuery(document).ready(function($) {
    	$("li.menu-item-has-children").click(function () {
      		$(this).toggleClass("ulopen");
    	});
    	$("li.page_item_has_children").click(function () {
      		$(this).toggleClass("ulopen");
    	});  
    	  	
        $(this).find("li.page_item_has_children > a").after( "<span class='ent entarrow-down7'></span>" );
        $(this).find("li.menu-item-has-children > a").after( "<span class='ent entarrow-down7'></span>" );
   	});
   /*	jQuery(document).ready(function($) {
   	var icn=$(this);
    	console.log($(this));
  		$('li:has(div.mega-menu)').parent().addClass('menu-item-has-mega-menu');
	});*/
	</script>
