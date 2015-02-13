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
	$cls_big = $cls_small = '';		
	if( has_shortcode($post->post_content, 'gallery') && has_post_format('gallery') ) {
		$cls_big = 'col-lg-8 col-md-8 col-sm-8 col-xs-12';
		$cls_small = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
	}
	elseif( ultimate_post_video() && has_post_format('video') ) {
		$cls_big = 'col-lg-8 col-md-8 col-sm-8 col-xs-12';
		$cls_small = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
	}
	elseif( ultimate_post_audio() && has_post_format('audio') ) {
		$cls_big = 'col-lg-8 col-md-8 col-sm-8 col-xs-12';
		$cls_small = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
	}
	elseif( has_post_thumbnail() || ultimate_post_social() ){
		$cls_big = 'col-lg-8 col-md-8 col-sm-8 col-xs-12';
		$cls_small = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
	} 
	else {
		$cls_big = '';
	}
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<div class="featured-post">
				<h2><?php _e( 'Featured Post', 'ultimate' ); ?></h2>
			</div>
		<?php endif; ?>

		<?php if( has_post_thumbnail() || ultimate_post_social() || has_shortcode($post->post_content, 'gallery') || ultimate_post_video() || ultimate_post_audio() ) : ?>
			<header class="entry-header <?php echo $cls_small; ?>">
				<?php if ( has_shortcode($post->post_content, 'gallery') ) : ?>
					<div class="blog-featured-media">
						<?php get_post_gallery( $post, true ); ?>
					</div>
				<?php elseif ( ultimate_post_video() ) : ?>
					<?php echo ultimate_post_video(); ?>
				<?php elseif ( ultimate_post_audio() ) : ?>
					<?php echo ultimate_post_audio(); ?>
				<?php elseif ( ultimate_post_social() ) : ?>
					<?php echo ultimate_post_social(); ?>
				<?php elseif ( has_post_thumbnail() ) : ?>
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
