<?php

/**
 * Template Name: Ultimate Full Width / Only For VC
 *
 * Description: We loves full width background for Visual COmposer row as much as
 * you do. Use this page template to set full width background for your rows.
 *
 */

get_header(); ?>

	<div id="primary" class="site-content ult-full-width-template">
		<div id="content" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<div class="entry-content">
							<?php the_content(); ?>
						</div><!-- .entry-content -->

						<footer class="entry-meta">
							<?php edit_post_link( __( 'Edit', 'ultimate' ), '<span class="edit-link">', '</span>' ); ?>
						</footer><!-- .entry-meta -->

					</article><!-- #post -->
			<?php endwhile; // end of the loop. ?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>