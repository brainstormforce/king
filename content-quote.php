<?php
/**
 * The template for displaying posts in the Quote post format
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-summary">
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ultimate' ) ); ?>
			</div><!-- .entry-content -->
	    </div><!-- .entry-summary -->

	    <div class="entry-summary-meta">
			<div class="post-meta">
	        	<?php ultimate_post_meta($post); ?>
	    	</div>
        </div><!-- .entry-summary-meta -->

	</article><!-- #post -->
