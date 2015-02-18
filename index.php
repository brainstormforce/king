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
 * @subpackage Ultimate
 * @since Ultimate 1.0
 */
get_header();
$bl = get_theme_mod('blog_layout');
$blog_layout = isset($bl) ? get_theme_mod('blog_layout') : 'normal';
//$cls = ($blog_layout !== 'grid-3' && $blog_layout !== 'grid-4') ? 'col-md-9 col-sm-8 col-xl-12 col-xs-12' : 'col-md-12 col-sm-12 col-xl-12 col-xs-12';
?>
	<div id="primary" class="site-content <?php// echo $cls; ?>">
		<div id="content" role="main" class="clear">
		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
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
			<article id="post-0" class="post no-results not-found">
				<?php if ( current_user_can( 'edit_posts' ) ) :
					// Show a different message to a logged-in user who can add posts.
				?>
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'No posts to display', 'ultimate' ); ?></h1>
					</header>
					<div class="entry-content">
						<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'ultimate' ), admin_url( 'post-new.php' ) ); ?></p>
					</div><!-- .entry-content -->
				<?php else :
					// Show the default message to everyone else.
				?>
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'ultimate' ); ?></h1>
					</header>
					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'ultimate' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				<?php endif; // end current_user_can() check ?>
			</article><!-- #post-0 -->
		<?php endif; // end have_posts() check ?>
		</div><!-- #content -->
		<?php ultimate_pagination(); ?>
	</div><!-- #primary -->


<?php ult_content_after(); ?>
<?php get_footer(); ?>