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
	$cls = $cls2 = '';	
	if(has_post_thumbnail() || $gallery_post ){
		$cls = 'col-md-8 col-lg-8 col-xl-8 col-xs-12';
		$cls2 = 'col-md-4 col-lg-4 col-xl-4 col-xs-12';
	} else {
		$cls = '';
	}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<div class="featured-post">
			<?php _e( 'Featured Post', 'ultimate' ); ?>
		</div>
	<?php endif; ?>


    <?php if(has_post_thumbnail() || $gallery_post ) : ?>
		<div class="entry-header <?php echo $cls2; ?>">
			<?php if ( ! post_password_required() && ! is_attachment() ) :
				if ( $gallery_post ) :
					get_post_gallery( $post, true );
				else :
					the_post_thumbnail('medium-image-blog');
				endif; 
			endif; ?>
		</div><!-- .entry-header -->
    <?php endif; ?>


    <div class="entry-summary <?php echo $cls; ?>">
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

		

	<div class="entry-summary-meta">
	<div class="post-meta">
        <?php ultimate_post_meta($post); ?>
    </div>

	</div><!-- .entry-summary -->

</article><!-- #post -->
