<?php

/**
 * Template Name: King Full Width / Only For VC
 *
 * Description: We loves full width background for Visual COmposer row as much as
 * you do. Use this page template to set full width background for your rows.
 *
 * @package King
 * @since King 1.0
 */

get_header(); ?>
<?php king_content_before(); ?>
<div id="primary" class="site-content king-full-width-template">

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