<form action="<?php echo home_url(); ?>/" method="get" id="searchform">
    <fieldset>
        <div id="searchbox">
            <input class="input" name="s" type="text" id="s" value="<?php _e( 'type here...' , 'ultimate' ); ?>" onfocus="if (this.value == '<?php _e( 'type here...' , 'ultimate' ) ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'type here...' , 'ultimate' ) ?>';}">
            <button type="submit" id="searchsubmit" class="ultimate-bkg ultimate-bkg-dark-hover"><i class="ent entsearch"></i></button>
        </div>
	</fieldset>
</form>
