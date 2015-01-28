<?php
/**
 * The template for displaying Author Archive pages
 *
 * Used to display archive-type pages for posts by an author.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
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
			<h1 class="archive-title"><?php printf( __( 'Author Archives: %s', 'ultimate' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
		</header><!-- .archive-header -->

		<?php
		// If a user has filled out their description, show a bio on their entries.
		if ( get_the_author_meta( 'description' ) ) : ?>
			<div class="author-info">
				<div class="author-avatar">
					<?php
					/**
					 * Filter the author bio avatar size.
					 *
					 * @since Twenty Twelve 1.0
					 *
					 * @param int $size The height and width of the avatar in pixels.
					 */
					$author_bio_avatar_size = apply_filters( 'ultimate_author_bio_avatar_size', 68 );
					echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
					?>
				</div><!-- .author-avatar -->
				<div class="author-description">
					<h2><?php printf( __( 'About %s', 'ultimate' ), get_the_author() ); ?></h2>
					<p><?php the_author_meta( 'description' ); ?></p>
				</div><!-- .author-description	-->
			</div><!-- .author-info -->
		<?php endif; ?>
		
		<div id="content" role="main" class="<?php if($blog_layout == 'grid-2' || $blog_layout == 'grid-3' || $blog_layout == 'grid-4'): ?> blog-masonry <?php else: ?> blog-normal <?php endif; ?> clear">
		<?php if ( have_posts() ) : ?>
			<?php
				/* Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				 *
				 * We reset this later so we can run the loop
				 * properly with a call to rewind_posts().
				 */
				the_post();
			?>
			
			<?php
				/* Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();
			?>
			<?php // ultimate_content_nav( 'nav-above' ); ?>
			
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
		<?php 
			if(function_exists('ultimate_pagination')){
				ultimate_pagination();
			} else {
				ultimate_content_nav( 'nav-below' );
			}
		?>
	</section><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>