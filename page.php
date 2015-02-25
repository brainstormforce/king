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
 * @subpackage King
 * @since King 1.0
 */
get_header(); ?>
<?php king_content_before(); ?>
<div id="primary" class="site-content">

	<?php king_content_top(); ?>
	<div id="content" role="main">	

		<?php while ( have_posts() ) : the_post(); ?>

			<?php king_entry_before(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php king_entry_after(); ?>
			
			<?php comments_template( '', true ); ?>			

		<?php endwhile; // end of the loop. ?>
	
	</div><!-- #content -->
	<?php king_content_bottom(); ?>	

</div><!-- #primary -->
<?php king_content_after(); ?>
<?php get_footer(); ?>