<?php
/**
 * The template for displaying content in Masonry layout
 *
 * Used for Grid Layouts
 *
 * @package WordPress
 * @subpackage Ultimate
 * @since Ultimate 1.0
 */
?>
<?php
	$gallery_post = has_shortcode( $post->post_content, 'gallery' );
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="grid-post-container">

        <?php if(has_post_thumbnail() || $gallery_post) : ?>
			<div class="grid-post-media">
				<?php 
					if ( $gallery_post ) :
						get_post_gallery( $post, true );
					else :
						the_post_thumbnail();
					endif; 
				?>
			</div><!-- .grid-post-media -->
        <?php endif; ?>

        <div class="grid-post-content">
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			<div class="post-meta">
	        	<?php ultimate_post_meta($post); ?>
	    	</div>
	    	<div class="content-sep"></div>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		</div> <!-- .grid-post-content -->

	</div> <!-- .grid-post-container -->
	
</article><!-- #post -->