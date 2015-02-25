<?php

/**
 * The template used for displaying page content in page.php
 *
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php ult_entry_top(); ?>

	<header class="entry-header">
		<?php // if ( ! is_page_template( 'page-templates/front-page.php' ) ) : ?>
			<?php if( has_post_thumbnail() ) : ?>
				<div class="page-featured-img">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_post_thumbnail('full'); ?></a>
				</div>
			<?php endif; ?>
		<?php // endif; ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'king' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'king' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->

<?php ult_entry_bottom(); ?>
</article><!-- #post -->