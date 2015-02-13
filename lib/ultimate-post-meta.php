<?php 

/* Adds a meta box to the post editing screen */
function ult_custom_meta() {
	add_meta_box( 'ult_meta', __( 'Header & Menu Settings', 'ultimate' ), 'ult_meta_callback', 'page' );
}
add_action( 'add_meta_boxes', 'ult_custom_meta' );
/* Outputs the content of the meta box */
function ult_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'ult_nonce' );
    $ult_stored_meta = get_post_meta( $post->ID );
    $fixed_header = get_theme_mod( 'site_fixed_header' );
   	if($fixed_header): ?>
    <p>
    <div class="ult-row-content">
    	<label><?php _e( 'Enable transparant menu -', 'ultimate' )?></label>
        <label for="meta-radio-one">
            <input type="radio" name="meta-radio" id="meta-radio-one" value="true" <?php 
				if ( isset ( $ult_stored_meta['meta-radio'] ) ) 
					checked( $ult_stored_meta['meta-radio'][0], 'true' ); 
			?>>
            <?php _e( 'Yes', 'ultimate' )?>
        </label>

        <label for="meta-radio-two">
            <input type="radio" name="meta-radio" id="meta-radio-two" value="false" <?php 
				if ( isset ( $ult_stored_meta['meta-radio'] ) ) 
					checked( $ult_stored_meta['meta-radio'][0], 'false' );
				else
					echo 'checked="checked"'; 
			?>>
            <?php _e( 'No', 'ultimate' )?>
        </label>
    </div>
    </p>
     <?php endif; ?>
     <p>
    <div class="ult-row-content">
    	<label><?php _e( 'Enable light menu -', 'ultimate' )?></label>
        <label for="meta-radio-one">
            <input type="radio" name="meta-radio1" id="meta-radio-three" value="true" <?php if ( isset ( $ult_stored_meta['meta-radio1'] ) ) checked( $ult_stored_meta['meta-radio1'][0], 'true' ); ?>>
            <?php _e( 'Yes', 'ultimate' )?>
        </label>
        <label for="meta-radio-two">
            <input type="radio" name="meta-radio1" id="meta-radio-four" value="false" <?php 
				if ( isset ( $ult_stored_meta['meta-radio1'] ) ) 
					checked( $ult_stored_meta['meta-radio1'][0], 'false' ); 
				else
					echo 'checked="checked"';
			?>>
            <?php _e( 'No', 'ultimate' )?>
        </label>
    </div>
	</p>

	<p>
    <div class="ult-row-content">
    	<label><?php _e( 'Enable Breadcrumbs -', 'ultimate' )?></label>
        <label for="meta-radio-five">
            <input type="radio" name="meta-breadcrumb" id="meta-radio-five" value="true" <?php 
            	if ( isset ( $ult_stored_meta['meta-breadcrumb'] ) ) 
            			checked( $ult_stored_meta['meta-breadcrumb'][0], 'true' ); 
            	else
					echo 'checked="checked"';
            	?>>
            <?php _e( 'Yes', 'ultimate' )?>
        </label>
        <label for="meta-radio-six">
            <input type="radio" name="meta-breadcrumb" id="meta-radio-six" value="false" <?php 
				if ( isset ( $ult_stored_meta['meta-breadcrumb'] ) ) 
					checked( $ult_stored_meta['meta-breadcrumb'][0], 'false' ); 
			?>>
            <?php _e( 'No', 'ultimate' )?>
        </label>
    </div>
	</p>
 
    <?php
}
/* Saves the custom meta input */
function ult_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'ult_nonce' ] ) && wp_verify_nonce( $_POST[ 'ult_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
     // Checks for input and saves if needed
	if( isset( $_POST[ 'meta-radio' ] ) ) {
		update_post_meta( $post_id, 'meta-radio', $_POST[ 'meta-radio' ] );
	}
	if( isset( $_POST[ 'meta-radio1' ] ) ) {
		update_post_meta( $post_id, 'meta-radio1', $_POST[ 'meta-radio1' ] );
	}
	if( isset( $_POST[ 'meta-breadcrumb' ] ) ) {
		update_post_meta( $post_id, 'meta-breadcrumb', $_POST[ 'meta-breadcrumb' ] );
	}
}
add_action( 'save_post', 'ult_meta_save' );

/* Add specific CSS class by filter */
add_filter('body_class','ultimate_body_class_name');
function ultimate_body_class_name($classes) {
	global $post;
	
	// add a custom class for transparent header
	$meta_value = get_post_meta( get_the_ID(), 'meta-radio', true );
	$meta_value1 = get_post_meta( get_the_ID(), 'meta-radio1', true );
	if( $meta_value == 'true' ) {
		$classes[] = 'ult-transparent-header';
	}	
	
	if( $meta_value1 == 'true' ) {
		$classes[] = 'ult-light-menu';
	}	 
    return $classes;
	
}