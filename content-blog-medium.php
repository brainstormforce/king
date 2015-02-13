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
	$cls_big = $cls_small = '';	
	if(has_post_thumbnail() || $gallery_post /*|| has_post_format('video') || has_post_format('audio') */){
		$cls_big = 'col-lg-8 col-md-8 col-sm-8 col-xs-12';
		$cls_small = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
	} else {
		$cls_big = '';
	}
?>

<?php /*if(has_post_format('video')): ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header <?php echo $cls_small; ?>">
			<?php ultimate_post_video($post); ?>
		</header><!-- .entry-header -->

	    <div class="entry-summary <?php echo $cls_big; ?>">
	    	<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->	

		<?php ultimate_post_meta(); ?>

	</article><!-- #post -->	

<?php elseif (has_post_format('audio')): ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header <?php echo $cls_small; ?>">
			<?php ultimate_post_audio($post); ?>
		</header><!-- .entry-header -->

	    <div class="entry-summary <?php echo $cls_big; ?>">
	    	<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->	

		<?php ultimate_post_meta(); ?>

	</article><!-- #post -->	

<?php else : */?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<div class="featured-post">
				<h2><?php _e( 'Featured Post', 'ultimate' ); ?></h2>
			</div>
		<?php endif; ?>

		<?php if(has_post_thumbnail() || $gallery_post ) : ?>
			<header class="entry-header <?php echo $cls_small; ?>">
				<?php if ( $gallery_post ) : ?>
					<div class="blog-featured-media">
						<?php get_post_gallery( $post, true ); ?>
					</div>
				<?php else : ?>
					<div class="blog-featured-media">
						<?php the_post_thumbnail('medium-image-blog'); ?>
					</div>
				<?php endif; ?>
			</header><!-- .entry-header -->
		<?php endif; ?>

	    <div class="entry-summary <?php echo $cls_big; ?>">
	    	<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->	

		<?php ultimate_post_meta(); ?>

	</article><!-- #post -->

<?php// endif; ?>
