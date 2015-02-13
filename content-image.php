<?php
/**
 * The template for displaying posts in the Image post format
 *
 * @package WordPress
 * @subpackage Ultimate
 * @since Ultimate 1.0
 */
?>

	<!--/////////////////////////////////////////////////////-->


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ultimate' ) ); ?>
	</div><!-- .entry-content -->

	<header class="entry-header">
		<?php if( !is_single() ) : ?>
        	<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
        	<h6><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time></h6>
        <?php else : ?>        	
        	<h1 class="entry-title"><?php the_title(); ?></h1>
        	<h6><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time></h6>
        <?php endif; ?>
	</header><!-- .entry-header -->


	<?php ultimate_post_meta(); ?>

</article><!-- #post -->
