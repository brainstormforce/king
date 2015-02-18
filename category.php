<?php
/**
 * The template for displaying Category pages
 *
 * Used to display archive-type pages for posts in a category.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 */
get_header();

$bl = get_theme_mod('blog_layout');
$blog_layout = isset($bl) ? get_theme_mod('blog_layout') : 'normal';
?>

<?php ult_content_before(); ?>
<div id="primary" class="site-content">
	
	<?php ult_content_top(); ?>
	<div id="content" role="main" class="clear">

		<?php ult_entry_before(); ?>
		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */
			while ( have_posts() ) : the_post(); ?>
	        	<?php if($blog_layout == 'grid-2' || $blog_layout == 'grid-3' || $blog_layout == 'grid-4'): ?>
					<?php get_template_part( 'content', 'blog-grid' ); ?>
	            <?php else: ?>
	            	<?php get_template_part( 'content', get_post_format() ); ?>
	            <?php endif; ?>
			<?php endwhile; ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
		<?php ult_entry_after(); ?>
		
	</div><!-- #content -->
	<?php ult_content_bottom(); ?>

</div><!-- #primary -->
<?php ult_content_after(); ?>
<?php get_footer(); ?>