<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 */
get_header();

$blog_layout = get_theme_mod('blog_layout', 'grid-3');
?>

<?php king_content_before(); ?>
<div id="primary" class="site-content">

	<?php king_content_top(); ?>
	<div id="content" role="main" class="clear">

		<?php king_entry_before(); ?>
		<?php if ( have_posts() ) : ?>			
			<?php /* Start the Loop */
				while ( have_posts() ) : the_post(); ?>
	        	<?php if($blog_layout == 'grid-2' || $blog_layout == 'grid-3' || $blog_layout == 'grid-4') { ?>
					<?php get_template_part( 'content', 'blog-grid' ); ?>
	            <?php } else if($blog_layout == 'medium-image') { ?>
	            	<?php get_template_part( 'content', 'blog-medium' ); ?>
	            <?php } else { ?>
	            	<?php get_template_part( 'content', get_post_format() ); ?>
	            <?php } ?>
			<?php endwhile; ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>			
		<?php endif; ?>
		<?php king_entry_after(); ?>

	</div><!-- #content -->
	<?php king_content_bottom(); ?>	

</div><!-- #primary -->
<?php king_content_after(); ?>
<?php get_footer(); ?>