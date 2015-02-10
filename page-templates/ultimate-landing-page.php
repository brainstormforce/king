<?php

/**
 * Template Name: Ultimate Landing Page W/O Header, Footer & Sidebar
 *
 * Description: Sometimes you need a landing page without header & footer. 
 * By using this template you can build such landing pages. 
 *
 */
?>
<!DOCTYPE html>
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
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="page" class="site <?php echo get_theme_mod('site_layout'); ?>">
		<div id="main" class="wrapper">
		    <div id="primary" class="site-content ult-landing-page-template">
				<div id="content" role="main">
					<?php while ( have_posts() ) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

								<div class="entry-content">
									<?php the_content(); ?>
								</div><!-- .entry-content -->

							</article><!-- #post -->
					<?php endwhile; // end of the loop. ?>
				</div><!-- #content -->
			</div><!-- #primary -->
		</div><!-- #main .wrapper -->
	</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>