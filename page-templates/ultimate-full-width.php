<?php

/**
 * Template Name: Ultimate Full Width / Only For VC
 *
 * Description: We loves full width background for Visual COmposer row as much as
 * you do. Use this page template to set full width background for your rows.
 *
 */

get_header(); ?>
<?php ult_content_before(); ?>
<div id="primary" class="site-content ult-full-width-template">

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