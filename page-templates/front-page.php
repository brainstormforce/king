<?php
/**
 * Template Name: Front Page Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in King consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package King
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