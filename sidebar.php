<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Ultimate
 * @since Ultimate 1.0
 */
?>

<?php ult_sidebars_before(); ?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php ult_sidebar_top(); ?>
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			<?php ult_sidebar_bottom(); ?>
		</div><!-- #secondary -->
	<?php endif; ?>

<?php ult_sidebars_after(); ?>