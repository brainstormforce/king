<?php
/**
 * The template for displaying posts in the Aside post format
 *
 * @package WordPress
 * @subpackage Ultimate
 * @since Ultimate 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php ult_entry_top(); ?>

	<div class="entry-summary">
		<div class="aside">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ultimate' ) ); ?>
			</div><!-- .entry-content -->
		</div><!-- .aside -->
	</div><!-- .entry-summary -->

<?php ult_entry_bottom(); ?>
</article><!-- #post -->