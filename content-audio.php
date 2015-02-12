<?php
/**
 * The template for displaying posts in the Audio post format
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php ultimate_post_audio($post); ?>
        <?php if( !is_single() ) : ?>
        	<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
        <?php else : ?>        	
        	<h1 class="entry-title"><?php the_title(); ?></h1>
        <?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary-meta">
		<div class="post-meta">
	        <?php ultimate_post_meta($post); ?>
	    </div>
    </div><!-- .entry-summary-meta -->

</article><!-- #post -->