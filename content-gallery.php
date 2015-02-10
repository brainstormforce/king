<?php
/**
 * The template for displaying posts in the Gallery post format
 */
?>
<?php
	$gallery_post = has_shortcode( $post->post_content, 'gallery' );
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if(has_post_thumbnail() || $gallery_post) : ?>
			<header class="entry-header">
				<?php 
					if ( $gallery_post ) :
						get_post_gallery( $post, true );
					else :
						the_post_thumbnail('full');
					endif; 
				?>
	            <?php if(is_single()){ ?>
	            	<h1 class="entry-title"><?php the_title(); ?></h1>
	            <?php } ?>
			</header><!-- .entry-header -->
        <?php endif; ?>

        <?php if ( !is_single() ) : // Only display Excerpts for Search ?>
            <div class="entry-summary">
				<h1 class="entry-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h1>				
				<?php add_filter( 'the_content', 'strip_shortcodes' ); ?>
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ultimate' ) ); ?>
			</div><!-- .entry-summary -->

		<?php else : ?>
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