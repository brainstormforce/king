<?php
class Ultimate_Typography_Control extends WP_Customize_Control {
    public $type = 'typography';
 
    public function render_content() {
		$value = $this->value();
		$value = explode(':',$value);
		$default_style = isset($value[1]) && isset($value[2]) ? $value[1].':'.$value[2] : $this->description;
        ?>
        <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <select id="<?php echo $this->id; ?>" class="google_fonts_form_field Ultimate_Typography_Control" default[font_style]="<?php echo $default_style; ?>">
        <?php
        $fonts = ultimate_get_fonts_array();
        foreach ( $fonts as $font_data ): ?>
            <option value="<?php echo $font_data['font_family'] . ':' . $font_data['font_styles']; ?>" data-font_types="<?php echo $font_data['font_types']; ?>" data-font_family ="<?php echo $font_data['font_family']; ?>" data-font_styles="<?php echo $font_data['font_styles']; ?>" class="wp-ult-typography" <?php echo( strtolower( $value[0] ) == strtolower( $font_data['font_family'] ) || strtolower( $value[0] ) == strtolower( $font_data['font_family'] ) . ':' . $font_data['font_styles'] ? 'selected="selected"' : '' ); ?> ><?php echo $font_data['font_family']; ?></option>
        <?php endforeach; ?>
        </select> <br />
        <label class="customize-control-title"><?php _e('Font Style','ultimate'); ?></label>
        <select id="<?php echo $this->id.'_font-style'; ?>"></select>
        <br />
        <input type="hidden" class="<?php echo $this->id; ?>" value="<?php echo $this->value(); ?>" <?php $this->link(); ?> />
        </label>
        <script type="text/javascript">
		jQuery(document).ready(function(){
			var $font_style_dropdown_el = jQuery('#<?php echo $this->id; ?>_font-style');
			var str = jQuery('#<?php echo $this->id; ?>').find(":selected").data('font_types');
			var def = jQuery('#<?php echo $this->id; ?>').find(":selected").text();
            var str_arr=str.split(',');
            var oel='';
			var default_f_style=jQuery('#<?php echo $this->id; ?>').attr('default[font_style]');
            for( var str_inner in str_arr ) {
                var str_arr_inner=str_arr[str_inner].split(':');
                var sel="";
				if(_.isString(default_f_style) && default_f_style.length>0 && str_arr[str_inner]==default_f_style) {
                    sel='selected="selected"';
                }
                oel=oel+'<option '+sel+' value="'+str_arr[str_inner]+'" data-font_family="'+def+'" data-font_weight="'+str_arr_inner[1]+'" data-font_style="'+str_arr_inner[2]+'" class="'+str_arr_inner[2]+'_'+str_arr_inner[1]+'" >'+str_arr_inner[0]+'</option>';
            }
			 $font_style_dropdown_el.html(oel);
			 jQuery('#<?php echo $this->id; ?>').trigger('change');
			 jQuery('#<?php echo $this->id; ?>_font-style').trigger('change');
			 //ultimateGenerateFont();
			 var $font_family = jQuery('#<?php echo $this->id; ?>').find(":selected").text();
			var $font_weight =jQuery('#<?php echo $this->id; ?>_font-style').find(":selected").data('font_weight');
			var $font_style =jQuery('#<?php echo $this->id; ?>_font-style').find(":selected").data('font_style');
			var $input = jQuery('.<?php echo $this->id; ?>');
			var cf = $font_family+':'+$font_weight+':'+$font_style;
			$input.val(cf);
			$input.trigger('change');
		});
		jQuery('#<?php echo $this->id; ?>').on('change',function(){
			var $font_style_dropdown_el = jQuery('#<?php echo $this->id; ?>_font-style');
			var str = jQuery('#<?php echo $this->id; ?>').find(":selected").data('font_types');
            var str_arr=str.split(',');
            var oel='';
			var default_f_style=jQuery('#<?php echo $this->id; ?>').attr('default[font_style]');
            for( var str_inner in str_arr ) {
                var str_arr_inner=str_arr[str_inner].split(':');
                var sel="";
				var custom_str = str_arr_inner[1]+':'+str_arr_inner[2];
				if(_.isString(default_f_style) && default_f_style.length>0 && custom_str==default_f_style) {
                    sel='selected="selected"';
                }
                oel=oel+'<option '+sel+' value="'+custom_str+'" data-font_weight="'+str_arr_inner[1]+'" data-font_style="'+str_arr_inner[2]+'" class="'+str_arr_inner[2]+'_'+str_arr_inner[1]+'" >'+str_arr_inner[0]+'</option>';

            }
            $font_style_dropdown_el.html(oel);
			jQuery('#<?php echo $this->id; ?>_font-style').trigger('change');
			//ultimateGenerateFont();
			var $font_family = jQuery('#<?php echo $this->id; ?>').find(":selected").text();
			var $font_weight =jQuery('#<?php echo $this->id; ?>_font-style').find(":selected").data('font_weight');
			var $font_style =jQuery('#<?php echo $this->id; ?>_font-style').find(":selected").data('font_style');
			var $input = jQuery('.<?php echo $this->id; ?>');
			var cf = $font_family+':'+$font_weight+':'+$font_style;
			$input.val(cf);
			$input.trigger('change');
		});
		jQuery('#<?php echo $this->id; ?>_font-style').on('change',function(){
			//ultimateGenerateFont();
			var $font_family = jQuery('#<?php echo $this->id; ?>').find(":selected").text();
			var $font_weight =jQuery('#<?php echo $this->id; ?>_font-style').find(":selected").data('font_weight');
			var $font_style =jQuery('#<?php echo $this->id; ?>_font-style').find(":selected").data('font_style');
			var $input = jQuery('.<?php echo $this->id; ?>');
			var cf = $font_family+':'+$font_weight+':'+$font_style;
			$input.val(cf);
			$input.trigger('change');
		});
		function ultimateGenerateFont(){
			var $font_family = jQuery('#<?php echo $this->id; ?>').find(":selected").text();
			var $font_weight =jQuery('#<?php echo $this->id; ?>_font-style').find(":selected").data('font_weight');
			var $font_style =jQuery('#<?php echo $this->id; ?>_font-style').find(":selected").data('font_style');
			var $input = jQuery('.<?php echo $this->id; ?>');
			var cf = $font_family+':'+$font_weight+':'+$font_style;
			$input.val(cf);
			$input.trigger('change');
		}
		</script>
        <?php
    }
}

class Ultimate_Separator_Control extends WP_Customize_Control {
    public $type = 'separator';
 
    public function render_content() {
		?>
        	<div class="ultimate-separator"></div>
            <style type="text/css">
			li.customize-control.customize-control-separator {
				display: block;
				width: 320px;
				height: 28px;
				position: relative;
				left: -20px;
				background: #F7F7F7;
				border: 1px solid #F0F0F0;
				margin: 15px 0;
			}
			.customize-control-title {
				margin-top: 10px;
			}
			</style>
        <?php
	}
}