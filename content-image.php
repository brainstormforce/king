<?php
/**
 * The template for displaying posts in the Image post format
 *
 * @package WordPress
 * @subpackage King
 * @since King 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php king_entry_top(); ?>

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'king' ) ); ?>
	</div><!-- .entry-content -->

	<header class="entry-header">
		<?php if( !is_single() ) : ?>
        	<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
        	<h6><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time></h6>
        <?php else : ?>        	
        	<?php $title_bar = get_theme_mod('title_bar_layout', 'style-1'); ?>
			<?php $meta_value = get_post_meta( $post->ID, 'meta-title-bar', true ); ?>
			<?php if(($title_bar == 'disable') || ($meta_value == 'false')) : ?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php endif; ?>
        	<h6><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time></h6>
        <?php endif; ?>
	</header><!-- .entry-header -->

<?php king_entry_bottom(); ?>
</article><!-- #post -->
