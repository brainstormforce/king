<?php
/**
 * The template for displaying image attachments
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package King
 * @since King 1.0
 */
get_header(); ?>
<?php king_content_before(); ?>
<div id="primary" class="site-content">

	<?php king_content_top(); ?>
	<div id="content" role="main">	

		<?php while ( have_posts() ) : the_post(); ?>

			<?php king_entry_before(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment' ); ?>>
				<?php king_entry_top(); ?>
					
					<?php $title_bar = get_theme_mod('title_bar_layout', 'style-1'); ?>
					<?php $meta_value = get_post_meta( $post->ID, 'meta-title-bar', true ); ?>
					<?php if(($title_bar == 'disable') || ($meta_value == 'false')) : ?>
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</header><!-- .entry-header -->
					<?php endif; ?>				

					<div class="entry-content">
						<div class="entry-attachment">
							<div class="attachment">
								<?php $next_attachment_url = get_attachment_link(); ?>
								<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
									<?php echo wp_get_attachment_image( $post->ID, 'full' ); ?>
									<?php if ( ! empty( $post->post_excerpt ) ) : ?>
										<div class="entry-caption">
											<?php the_excerpt(); ?>
										</div>
									<?php endif; ?>
								</a>								
							</div><!-- .attachment -->
						</div><!-- .entry-attachment -->
						<div class="entry-description">
							<?php the_content(); ?>
						</div><!-- .entry-description -->
					</div><!-- .entry-content -->

				<?php king_entry_bottom(); ?>
				</article><!-- #post -->

				<?php king_entry_after(); ?>
			
			<?php comments_template( '', true ); ?>			

		<?php endwhile; // end of the loop. ?>
	
	</div><!-- #content -->
	<?php king_content_bottom(); ?>	

</div><!-- #primary -->
<?php king_content_after(); ?>
<?php get_footer(); ?>