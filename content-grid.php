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
	$blog_layout = get_theme_mod('blog_layout');

	if ($blog_layout == 'grid-2') {
		$post_class = 'col-md-6 col-lg-6 col-xl-6 col-xs-12 col-sm-12';
	} else if ($blog_layout == 'grid-3') {
		$post_class = 'col-md-4 col-lg-4 col-xl-4 col-xs-12 col-sm-12';
	} else {
		$post_class = 'col-md-3 col-lg-3 col-xl-3 col-xs-12 col-sm-12';
	}

	$grid_post_format = get_post_format(); // Get Post Format
?>


<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>

	<div class="post-container">

        <?php if(has_post_thumbnail() || get_post_gallery()) : ?>
			<header class="entry-header">
				<?php 
					if ( get_post_gallery() ) :
						get_post_gallery();
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