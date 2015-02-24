<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package WordPress
 * @subpackage Ultimate
 * @since Ultimate 1.0
 */
?>

<article id="post-0" class="post no-results not-found">
<?php ult_entry_top(); ?>

	<header class="entry-header">
		<h1 class="entry-title"><?php _e( 'Nothing Found', 'ultimate' ); ?></h1>
	</header>

	<div class="entry-content">
		<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'ultimate' ); ?></p>
		<?php get_search_form(); ?>
	</div><!-- .entry-content -->

<?php ult_entry_bottom(); ?>	
</article><!-- #post-0 -->