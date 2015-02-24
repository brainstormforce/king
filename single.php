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

	<?php ult_content_top(); ?>
	<div id="content" role="main">	

		<?php while ( have_posts() ) : the_post(); ?>

			<?php ult_entry_before(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php ult_entry_after(); ?>
			
			<?php comments_template( '', true ); ?>			

		<?php endwhile; // end of the loop. ?>
	
	</div><!-- #content -->
	<?php ult_content_bottom(); ?>	

</div><!-- #primary -->
<?php ult_content_after(); ?>
<?php get_footer(); ?>