<?php
/**
 * The template for displaying content in Masonry layout
 *
 * Used for Grid Layouts
 *
 * @package King
 * @since King 1.0
 */
?>
<?php
	$cls_big = $cls_small = '';		
	if( has_shortcode($post->post_content, 'gallery') && has_post_format('gallery') ) {
		$cls_big = 'col-lg-8 col-md-8 col-sm-8 col-xs-12';
		$cls_small = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
	}
	elseif( king_post_video() && has_post_format('video') ) {
		$cls_big = 'col-lg-8 col-md-8 col-sm-8 col-xs-12';
		$cls_small = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
	}
	elseif( king_post_audio() && has_post_format('audio') ) {
		$cls_big = 'col-lg-8 col-md-8 col-sm-8 col-xs-12';
		$cls_small = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
	}
	elseif( has_post_thumbnail() || king_post_social() ){
		$cls_big = 'col-lg-8 col-md-8 col-sm-8 col-xs-12';
		$cls_small = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
	} 
	else {
		$cls_big = '';
	}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php king_entry_top(); ?>

	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<div class="featured-post">
			<h2><?php _e( 'Featured Post', 'king' ); ?></h2>
		</div>
	<?php endif; ?>

	<?php if( has_post_thumbnail() || king_post_social() || has_shortcode($post->post_content, 'gallery') || king_post_video() || king_post_audio() ) : ?>
		<header class="entry-header <?php echo $cls_small; ?>">
			<?php if ( has_shortcode($post->post_content, 'gallery') && has_post_format('gallery') ) : ?>
				<div class="blog-featured-media">
					<?php get_post_gallery( $post, true ); ?>
				</div>
			<?php elseif ( king_post_video() && has_post_format('video') ) : ?>
				<?php echo king_post_video(); ?>
			<?php elseif ( king_post_audio() && has_post_format('audio') ) : ?>
				<?php echo king_post_audio(); ?>
			<?php elseif ( king_post_social() ) : ?>
				<?php echo king_post_social(); ?>
			<?php elseif ( has_post_thumbnail() ) : ?>
				<div class="blog-featured-media">
					<?php $blog_thumnail_size = get_theme_mod('blog_featured_image_size', 'full'); ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_post_thumbnail( $blog_thumnail_size ); ?></a>
				</div>
			<?php endif; ?>
		</header><!-- .entry-header -->
	<?php endif; ?>

    <div class="entry-summary <?php echo $cls_big; ?>">
    	<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->	

<?php king_entry_bottom(); ?>
</article><!-- #post -->