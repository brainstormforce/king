<?php
/**
 * The template for displaying posts in the Status post format
 *
 * @package WordPress
 * @subpackage Ultimate
 * @since Ultimate 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-summary">
			<div class="entry-header">
				<header>
					<h1><?php the_author(); ?></h1>
					<h2><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'ultimate' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php echo get_the_date(); ?></a></h2>
				</header>
				<?php
				$status_avatar = apply_filters( 'ultimate_status_avatar', 48 );
				echo get_avatar( get_the_author_meta( 'ID' ), $status_avatar );
				?>
			</div><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ultimate' ) ); ?>
			</div><!-- .entry-content -->

	    </div><!-- .entry-summary -->

	    <div class="entry-summary-meta">
			<div class="post-meta">
	        	<?php ultimate_post_meta($post); ?>
	    	</div>
        </div><!-- .entry-summary-meta -->

	</article><!-- #post -->
