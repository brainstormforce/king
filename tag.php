<?php

/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Ultimate
 * @since Ultimate 1.0
 */
get_header();

$bl = get_theme_mod('blog_layout');
$blog_layout = isset($bl) ? get_theme_mod('blog_layout') : 'normal';
?>
	<section id="primary" class="site-content col-md-9 col-sm-8 col-xl-12 col-xs-12">

		<header class="archive-header">
			<h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', 'ultimate' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>

			<?php if ( tag_description() ) : // Show an optional tag description ?>
				<div class="archive-meta"><?php echo tag_description(); ?></div>
			<?php endif; ?>

		</header><!-- .archive-header -->

		<div id="content" role="main" class="clear">
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
		</div><!-- #content -->
		<?php ultimate_pagination(); ?>

	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>