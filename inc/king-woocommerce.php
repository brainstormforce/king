<?php 
/**
 * WooCommerce - Shop Page Structure
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