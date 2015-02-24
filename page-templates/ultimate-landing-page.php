<?php

/**
 * Template Name: Ultimate Landing Page W/O Header, Footer & Sidebar
 *
 * Description: Sometimes you need a landing page without header & footer. 
 * By using this template you can build such landing pages. 
 *
 */
get_header(); ?>
<?php ult_content_before(); ?>
<div id="primary" class="site-content ult-landing-page-template">

	<?php ult_content_top(); ?>
	<div id="content" role="main">	

		<?php while ( have_posts() ) : the_post(); ?>

			<?php ult_entry_before(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php ult_entry_after(); ?>
			
			<?php comments_template( '', true ); ?>			

		<?php endwhile; // end of the loop. ?>
	
	</div><!-- #content -->
	<?php ult_content_bottom(); ?>	

</div><!-- #primary -->
<?php ult_content_after(); ?>
<?php get_footer(); ?>