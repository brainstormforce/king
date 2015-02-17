<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Ultimate
 * @since Ultimate 1.0
 */



get_header(); ?>

<?php ult_content_before(); ?>
	<div id="primary" class="site-content">
		<div id="content" role="main">
			<?php ult_content_top(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php ult_entry_before(); ?>
						<?php get_template_part( 'content', 'page' ); ?>				
					<?php ult_entry_after(); ?>

					<?php ult_comments_before(); ?>
						<?php comments_template( '', true ); ?>
					<?php ult_comments_after(); ?>

				<?php endwhile; // end of the loop. ?>

			<?php ult_content_bottom(); ?>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php ult_content_after(); ?>

<?php // get_sidebar(); ?>
<?php get_footer(); ?>