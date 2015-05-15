<?php 
/*
 * Meta box options
 *
 * @package King
 * @since King 1.0
 */

/* Adds a meta box to the post editing screen */
function king_custom_meta() {
    $screens = array( 'post', 'page' );
    foreach ( $screens as $screen ) {
        add_meta_box( 'king_meta', __( 'King Options', 'king' ), 'king_meta_callback', $screen, 'advanced', 'high' );
    }	
}
add_action( 'add_meta_boxes', 'king_custom_meta' );
/* Outputs the content of the meta box */
function king_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'king_nonce' );
    $king_stored_meta = get_post_meta( $post->ID );

    $fixed_header = get_theme_mod( 'site_fixed_header', true );
   	if($fixed_header): ?>
        <p>
        <?php $meta_transparent_header = isset($king_stored_meta['meta-transparent-header'][0]) ? $king_stored_meta['meta-transparent-header'][0] : 'false'; ?>
        <div class="king-row-content">
            <label><?php _e( 'Enable Transparant Header -', 'king' )?></label>
            <label><input type="radio" name="meta-transparent-header" value="true" <?php if($meta_transparent_header == 'true') echo 'checked'; ?>><?php _e( 'Yes', 'king' )?></label>
            <label><input type="radio" name="meta-transparent-header" value="false" <?php if($meta_transparent_header == 'false') echo 'checked'; ?>><?php _e( 'No', 'king' )?></label>
        </div>
        </p>
    <?php endif; ?>

	<p>
    <?php 
        $customizer_title_bar = get_theme_mod('title_bar_layout', 'style-1');
        if ($customizer_title_bar == 'disable') :
            $meta_title_bar = 'false';
        else :
            $meta_title_bar = isset($king_stored_meta['meta-title-bar'][0]) ? $king_stored_meta['meta-title-bar'][0] : 'true';
        endif;
    ?>
    <div class="king-row-content">
    	<label><?php _e( 'Enable Title Bar -', 'king' )?></label>
        <label><input type="radio" name="meta-title-bar" value="true" <?php if($meta_title_bar == 'true') echo 'checked'; ?>><?php _e( 'Yes', 'king' )?></label>
        <label><input type="radio" name="meta-title-bar" value="false" <?php if($meta_title_bar == 'false') echo 'checked'; ?>><?php _e( 'No', 'king' )?></label>
    </div>
	</p>

    <p>
    <?php 
        $customizer_breadcrumb_bar = get_theme_mod('breadcrumb_bar', 'enable');
        if ($customizer_breadcrumb_bar == 'disable') :
            $meta_breadcrumb_bar = 'false';
        else :
            $meta_breadcrumb_bar = isset($king_stored_meta['meta-breadcrumb-bar'][0]) ? $king_stored_meta['meta-breadcrumb-bar'][0] : 'true';
        endif;
    ?>
    <div class="king-row-content">
        <label><?php _e( 'Enable Breadcrumb -', 'king' )?></label>
        <label><input type="radio" name="meta-breadcrumb-bar" value="true" <?php if($meta_breadcrumb_bar == 'true') echo 'checked'; ?>><?php _e( 'Yes', 'king' )?></label>
        <label><input type="radio" name="meta-breadcrumb-bar" value="false" <?php if($meta_breadcrumb_bar == 'false') echo 'checked'; ?>><?php _e( 'No', 'king' )?></label>
    </div>
    </p>
 
    <?php
}
/* Saves the custom meta input */
function king_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'king_nonce' ] ) && wp_verify_nonce( $_POST[ 'king_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    // Checks for input and saves if needed
	if( isset( $_POST[ 'meta-transparent-header' ] ) ) {
		update_post_meta( $post_id, 'meta-transparent-header', $_POST[ 'meta-transparent-header' ] );
	}
	if( isset( $_POST[ 'meta-title-bar' ] ) ) {
		update_post_meta( $post_id, 'meta-title-bar', $_POST[ 'meta-title-bar' ] );
	}
    if( isset( $_POST[ 'meta-breadcrumb-bar' ] ) ) {
        update_post_meta( $post_id, 'meta-breadcrumb-bar', $_POST[ 'meta-breadcrumb-bar' ] );
    }
}
add_action( 'save_post', 'king_meta_save' );