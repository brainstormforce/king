<?php
/**
 * The template for displaying posts in the Gallery post format
 *
 * @package King
 * @since King 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php king_entry_top(); ?>

	<header class="entry-header">
		<?php if( has_post_thumbnail() || has_shortcode($post->post_content, 'gallery') ) : ?>
			<div class="blog-featured-media">
				<?php if ( has_shortcode($post->post_content, 'gallery') ) : ?>
					<?php get_post_gallery( $post, true ); ?>
				<?php else : ?>
					<?php $blog_thumnail_size = get_theme_mod('blog_featured_image_size', 'full'); ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_post_thumbnail( $blog_thumnail_size ); ?></a>
				<?php endif; ?>
			</div> <!-- .blog-featured-media -->
		<?php endif; ?>

        <?php if( !is_single() ) : ?>
        	<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
        <?php else : ?>        	
        	<?php $title_bar = get_theme_mod('title_bar_layout', 'style-1'); ?>
			<?php $meta_value = get_post_meta( $post->ID, 'meta-title-bar', true ); ?>
			<?php if(($title_bar == 'disable') || ($meta_value == 'false')) : ?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php endif; ?>
        <?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_single() ) : ?>
		<div class="entry-content">
			<?php add_filter( 'the_content', 'strip_shortcodes' ); ?>
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'king' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'king' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
	<?php endif; ?>		

<?php king_entry_bottom(); ?>
</article><!-- #post -->	