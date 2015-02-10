<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Ultimate
 * @since Ultimate 1.0
 */
?>
<?php
	$cls = $cls2 = '';
	if(!is_single()){
		if(has_post_thumbnail()){
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
	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<div class="featured-post">
			<?php _e( 'Featured Post', 'ultimate' ); ?>
		</div>
	<?php endif; ?>

    <?php if(has_post_thumbnail() || is_single()){ ?>
		<header class="entry-header <?php echo $cls2; ?>">
			<?php if ( ! post_password_required() && ! is_attachment() ) :
				the_post_thumbnail();
			endif; ?>
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
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

	<?php else : ?>
		<div class="entry-content <?php echo $cls; ?>">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ultimate' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'ultimate' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
	<?php endif; ?>

		

	<div class="entry-summary-meta">
	<div class="post-meta">
        <?php ultimate_post_meta($post); ?>
    </div>

	<footer class="entry-meta">
		<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
			<div class="author-info">
				<div class="author-avatar">
					<?php
					/** This filter is documented in author.php */
					$author_bio_avatar_size = apply_filters( 'ultimate_author_bio_avatar_size', 68 );
					echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
					?>
				</div><!-- .author-avatar -->
				<div class="author-description">
					<h2><?php printf( __( 'About %s', 'ultimate' ), get_the_author() ); ?></h2>
					<p><?php the_author_meta( 'description' ); ?></p>
					<div class="author-link">
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
							<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'ultimate' ), get_the_author() ); ?>
						</a>
					</div><!-- .author-link	-->
				</div><!-- .author-description -->
			</div><!-- .author-info -->
		<?php endif; ?>
	</footer><!-- .entry-meta -->

	</div><!-- .entry-summary -->

</article><!-- #post -->
