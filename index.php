<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage King
 * @since King 1.0
 */
get_header(); 
$blog_layout = get_theme_mod('blog_layout', 'normal');
?>
<?php king_content_before(); ?>
<div id="primary" class="site-content">	

	<?php king_content_top(); ?>
	<div id="content" role="main" class="clear">

		<?php king_entry_before(); ?>
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>			
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
		<?php endif; // end have_posts() check ?>
		<?php king_entry_after(); ?>
	
	</div><!-- #content -->
	<?php king_content_bottom(); ?>

</div><!-- #primary -->
<?php king_content_after(); ?>
<?php get_footer(); ?>