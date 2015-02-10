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

	<div class="post-container">

        <?php if(has_post_thumbnail() || $gallery_post) : ?>
			<header class="entry-header">
				<?php 
					if ( $gallery_post ) :
						get_post_gallery( $post, true );
					else :
						the_post_thumbnail();
					endif; 
				?>
			</header><!-- .entry-header -->
        <?php endif; ?>

        <div class="entry-summary">
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			<div class="post-meta">
	        	<?php ultimate_post_meta($post); ?>
	    	</div>
	    	<div class="content-sep"></div>
			<?php the_excerpt(); ?>

		</div> <!-- .entry-summary -->

	</div> <!-- .post-container -->
	
</article><!-- #post -->