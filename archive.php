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
$bl = get_theme_mod('blog_layout');
//$blog_layout = isset($bl) ? get_theme_mod('blog_layout') : 'normal'; 
if ($bl == 'grid-2' || $bl == 'grid-3' || $bl == 'grid-4') {
	$blog_layout = 'grid-2';
} else {
	$blog_layout = 'normal';
}
?>
	<section id="primary" class="site-content col-md-9 col-sm-8 col-xl-12 col-xs-12 <?php echo $blog_layout; ?>">

		<header class="archive-header">
			<h1 class="archive-title"><?php
				if ( is_day() ) :
					printf( __( 'Daily Archives: %s', 'ultimate' ), '<span>' . get_the_date() . '</span>' );
				elseif ( is_month() ) :
					printf( __( 'Monthly Archives: %s', 'ultimate' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'ultimate' ) ) . '</span>' );
				elseif ( is_year() ) :
					printf( __( 'Yearly Archives: %s', 'ultimate' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'ultimate' ) ) . '</span>' );
				else :
					_e( 'Archives', 'ultimate' );
				endif;
			?></h1>
		</header><!-- .archive-header -->

		<div id="content" role="main" class="clear">
			<?php if ( have_posts() ) : ?>
				
				<?php /* Start the Loop */
					while ( have_posts() ) : the_post(); ?>
		        	<?php if($blog_layout == 'grid-2' || $blog_layout == 'grid-3' || $blog_layout == 'grid-4'): ?>
						<?php get_template_part( 'content', 'grid' ); ?>
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