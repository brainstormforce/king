<?php 
/**
 * WooCommerce
 *
 * @since King 1.0
 */
if ( ! function_exists( 'king_woocommerce_activated' ) ) {
	function king_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { 


			/**
			 * WooCommerce - Shop Page Structure
			 *
			 * @since King 1.0
			 */

			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
			remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

			add_action('woocommerce_before_main_content', 'king_woocommerce_before_main_content', 10);
			add_action('woocommerce_after_main_content', 'king_woocommerce_after_main_content', 10);

			function king_woocommerce_before_main_content() {
				echo '<div id="primary" class="site-content">';
			}

			function king_woocommerce_after_main_content() {
				echo '</div>';
			}

			/**
			 * WooCommerce - Sidebar Position
			 *
			 * @since King 1.0
			 */

			$sidebar_pos = get_theme_mod('sidebar_position', 'no-sidebar');
			if ($sidebar_pos == 'no-sidebar') :
				if ( is_woocommerce()) :
					remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
				endif;
			endif;			
		}
	}
}
add_action( 'wp', 'king_woocommerce_activated' );