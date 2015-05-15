<?php
/**
 * The template for displaying posts in the Quote post format
 *
 * @package King
 * @since King 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php king_entry_top(); ?>

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'king' ) ); ?>
	</div><!-- .entry-content -->

<?php king_entry_bottom(); ?>
</article><!-- #post -->	
