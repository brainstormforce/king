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

	<div class="entry-summary">
		<header><?php _e( 'Link', 'ultimate' ); ?></header>
    </div><!-- .entry-summary -->

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ultimate' ) ); ?>
	</div><!-- .entry-content -->

	<div class="entry-summary-meta">
		<div class="post-meta">
	        <?php ultimate_post_meta(); ?>
	    </div>
    </div><!-- .entry-summary-meta -->

</article><!-- #post -->	
