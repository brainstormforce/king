<?php
/**
 * The template for displaying posts in the Link post format
 *
 * @package WordPress
 * @subpackage Ultimate
 * @since Ultimate 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php ult_entry_top(); ?>

	<div class="entry-summary">
		<header><?php _e( 'Link', 'ultimate' ); ?></header>
    </div><!-- .entry-summary -->

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ultimate' ) ); ?>
	</div><!-- .entry-content -->

	<?php ultimate_post_meta(); ?>

<?php ult_entry_bottom(); ?>
</article><!-- #post -->	
