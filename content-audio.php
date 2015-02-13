<?php
/**
 * The template for displaying posts in the Audio post format
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php if ( ultimate_post_audio() && !is_single() ) : ?>
			<?php echo ultimate_post_audio(); ?>
		<?php endif; ?>

        <?php if( !is_single() ) : ?>
        	<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
        <?php else : ?>        	
        	<h1 class="entry-title"><?php the_title(); ?></h1>
        <?php endif; ?>

	</header><!-- .entry-header -->

	<?php if ( !is_single() ) : ?>
		<?php if ( !ultimate_post_audio() ) : ?>
	        <div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php endif; ?>
	<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ultimate' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'ultimate' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
	<?php endif; ?>

	<?php ultimate_post_meta(); ?>	

</article><!-- #post -->