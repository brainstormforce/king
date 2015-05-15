<?php
/**
 * The template for displaying posts in the Aside post format
 *
 * @package King
 * @since King 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php king_entry_top(); ?>

	<div class="entry-summary">
		<div class="aside">

			<?php if( !is_single() ) : ?>
	        	<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	        <?php else : ?>        	
	        	<?php $title_bar = get_theme_mod('title_bar_layout', 'style-1'); ?>
				<?php $meta_value = get_post_meta( $post->ID, 'meta-title-bar', true ); ?>
				<?php if(($title_bar == 'disable') || ($meta_value == 'false')) : ?>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php endif; ?>
	        <?php endif; ?>

			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'king' ) ); ?>
			</div><!-- .entry-content -->
		</div><!-- .aside -->
	</div><!-- .entry-summary -->

<?php king_entry_bottom(); ?>
</article><!-- #post -->