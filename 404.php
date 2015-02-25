<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage King
 * @since King 1.0
 */
get_header(); ?>	
<?php ult_content_before(); ?>
<div id="primary" class="site-content">

	<?php ult_content_top(); ?>
	<div id="content" role="main">	

		<?php ult_entry_before(); ?>
			<article id="post-0" class="post error404 no-results not-found">
		<?php ult_entry_top(); ?>

			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'king' ); ?></h1>
			</header>
			<div class="entry-content">
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'king' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->

		<?php ult_entry_bottom(); ?>
		</article><!-- #post-0 -->
		<?php ult_entry_after(); ?>
			
	</div><!-- #content -->
	<?php ult_content_bottom(); ?>	

</div><!-- #primary -->
<?php ult_content_after(); ?>
<?php get_footer(); ?>