<?php
/**
 * Template Name: Front Page Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Ultimate consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 */
get_header(); ?>

	<div id="primary" class="site-content col-md-12 col-sm-12 col-xl-12 col-xs-12 clear">
		<div id="content" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>

			<?php if ( is_active_sidebar( 'sidebar-front-main' ) ) : ?>
				<div class="frontpage-main-widget-area clear">
				<?php dynamic_sidebar( 'sidebar-front-main' ); ?>
				</div><!-- .first -->
			<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar( 'front' ); ?>
<?php get_footer(); ?>