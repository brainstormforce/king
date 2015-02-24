<?php
/**
 * The template for displaying content in Masonry layout
 *
 * Used for Grid Layouts
 *
 * @package WordPress
 * @subpackage Ultimate
 * @since Ultimate 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php ult_entry_top(); ?>

	<div class="grid-post-container">

		<?php if( has_post_thumbnail() || ultimate_post_social() || has_shortcode($post->post_content, 'gallery') || ultimate_post_video() || ultimate_post_audio() ) : ?>
			<div class="grid-post-media">
				<?php if ( has_shortcode($post->post_content, 'gallery') && has_post_format('gallery') ) : ?>
					<?php get_post_gallery( $post, true ); ?>
				<?php elseif ( ultimate_post_video() && has_post_format('video') ) : ?>
					<?php echo ultimate_post_video(); ?>
				<?php elseif ( ultimate_post_audio() && has_post_format('audio') ) : ?>
					<?php echo ultimate_post_audio(); ?>
				<?php elseif ( ultimate_post_social() ) : ?>
					<?php echo ultimate_post_social(); ?>
				<?php elseif ( has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_post_thumbnail(); ?></a>
				<?php endif; ?>
			</div><!-- .grid-post-media -->
        <?php endif; ?>

        <div class="grid-post-content">
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			<?php ultimate_post_meta(); ?>
			<div class="content-sep"></div>

			<?php if( !ultimate_post_social() ) : ?>				
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
			<?php endif; ?>

		</div> <!-- .grid-post-content -->

	</div> <!-- .grid-post-container -->
	
<?php ult_entry_bottom(); ?>	
</article><!-- #post -->