<?php
/**
 * The template for displaying posts in the Gallery post format
 */
?>
<?php
	$cls = $cls2 = '';
	if(!is_single()){
		if(has_post_thumbnail() || has_shortcode( $post->post_content, 'gallery' )){
			$cls = 'col-md-8 col-lg-8 col-xl-8 col-xs-12';
			$cls2 = 'col-md-4 col-lg-4 col-xl-4 col-xs-12';
		} else {
			$cls = '';
		}
	} else {
		$cls = $cls2 = '';
	}
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if(has_post_thumbnail() || has_shortcode( $post->post_content, 'gallery' ) || is_single()){ ?>
			<header class="entry-header <?php echo $cls2; ?>">
				<?php 
					if ( ! post_password_required() && ! is_attachment() ) {
						get_post_gallery();
					} else {
						the_post_thumbnail();
					} 
				?>
	            <?php if(is_single()){ ?>
	            	<h1 class="entry-title"><?php the_title(); ?></h1>
	            <?php } ?>
			</header><!-- .entry-header -->
        <?php } ?>

        <?php if ( !is_single() ) : // Only display Excerpts for Search ?>
            <div class="entry-summary <?php echo $cls; ?>">
				<h1 class="entry-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h1>				
				<?php add_filter( 'the_content', 'strip_shortcodes' ); ?>
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ultimate' ) ); ?>
			</div><!-- .entry-summary -->

		<?php else : ?>
			<div class="entry-content <?php echo $cls; ?>">
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