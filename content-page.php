<?php

/**
 * The template used for displaying page content in page.php
 *
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php king_entry_top(); ?>

	<header class="entry-header">
		
		<?php if( has_post_thumbnail() ) : ?>
			<div class="page-featured-img">
				<?php $blog_thumnail_size = get_theme_mod('blog_featured_image_size', 'full'); ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_post_thumbnail( $blog_thumnail_size ); ?></a>
			</div>
		<?php endif; ?>

		<?php $title_bar = get_theme_mod('title_bar_layout', 'style-1'); ?>
		<?php $meta_value = get_post_meta( $post->ID, 'meta-title-bar', true ); ?>
		<?php if(($title_bar == 'disable') || ($meta_value == 'false')) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php endif; ?>

	</header>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'king' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'king' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->

<?php king_entry_bottom(); ?>
</article><!-- #post -->