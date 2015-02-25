<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage King
 * @since King 1.0
 */
?>

<?php king_sidebars_before(); ?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php king_sidebar_top(); ?>
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			<?php king_sidebar_bottom(); ?>
		</div><!-- #secondary -->
	<?php endif; ?>

<?php king_sidebars_after(); ?>