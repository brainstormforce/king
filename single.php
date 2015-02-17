<?php
/**
 * The Template for displaying all single posts
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
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php ult_entry_after(); ?>

					<nav class="nav-single clear">
						<h3 class="assistive-text"><?php _e( 'Post navigation', 'ultimate' ); ?></h3>
						<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'ultimate' ) . '</span> %title' ); ?></span>
						<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'ultimate' ) . '</span>' ); ?></span>
					</nav><!-- .nav-single -->
				

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