<?php
/**
 * The template for displaying posts in the Gallery post format
 */
?>
<?php
	$gallery_post = has_shortcode( $post->post_content, 'gallery' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php if(has_post_thumbnail() || $gallery_post) : ?>
			<div class="blog-featured-media">
				<?php 
					if ( $gallery_post ) :
						get_post_gallery( $post, true );
					else :
						the_post_thumbnail('full');
					endif; 
				?> 
			</div> <!-- .blog-featured-media -->
		<?php endif; ?>

        <?php if( !is_single() ) : ?>
        	<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
        <?php else : ?>        	
        	<h1 class="entry-title"><?php the_title(); ?></h1>
        <?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_single() ) : ?>
		<div class="entry-content">
			<?php add_filter( 'the_content', 'strip_shortcodes' ); ?>
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ultimate' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'ultimate' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
	<?php endif; ?>		

	<div class="entry-summary-meta">
		<div class="post-meta">
	        <?php ultimate_post_meta($post); ?>
	    </div>
    </div><!-- .entry-summary-meta -->

</article><!-- #post -->	