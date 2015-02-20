<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Ultimate
 * @since Ultimate 1.0
 */
get_header(); ?>
<?php ult_content_before(); ?>
<div id="primary" class="site-content">	
	
	<?php if ( have_posts() ) : ?>
		<header class="archive-header">
			<h1 class="archive-title"><?php printf( __( 'Search Results for: %s', 'ultimate' ), '<span><a>' . get_search_query() . '</a></span>' ); ?></h1>
		</header><!-- .archive-header -->
	<?php endif; ?>

	<?php ult_content_top(); ?>
	<div id="content" role="main">

		<?php ult_entry_before(); ?>
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
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