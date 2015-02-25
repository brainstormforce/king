<?php
/**
 * The template for displaying posts in the Aside post format
 *
 * @package WordPress
 * @subpackage King
 * @since King 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php king_entry_top(); ?>

	<div class="entry-summary">
		<div class="aside">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'king' ) ); ?>
			</div><!-- .entry-content -->
		</div><!-- .aside -->
	</div><!-- .entry-summary -->

<?php king_entry_bottom(); ?>
</article><!-- #post -->