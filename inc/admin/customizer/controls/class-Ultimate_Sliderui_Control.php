<?php

class Ultimate_Sliderui_Control extends WP_Customize_Control {

	public $type = 'slider';
	public $description = '';
	public $subtitle = '';

	public function render_content() { ?>
		<label>
			<?php if ( '' != $this->label ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>

			<?php if ( '' != $this->subtitle ) : ?>
				<div class="customizer-subtitle"><?php echo $this->subtitle; ?></div>
			<?php endif; ?>

			<?php if ( '' != $this->description ) : ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>

			<input type="text" id="input_<?php echo $this->id; ?>" style="<?php echo $this->choices['style']; ?>" class="ultimate-customizer-slider" value="<?php echo $this->value(); ?>" <?php $this->link(); ?>/>
			
		</label>

		<div id="slider_<?php echo $this->id; ?>" class="ss-slider"></div>
		<script>
		jQuery(document).ready(function($) {
			$( '#slider_<?php echo $this->id; ?>' ).slider({
					value : <?php echo $this->value(); ?>,
					min   : <?php echo $this->choices['min']; ?>,
					max   : <?php echo $this->choices['max']; ?>,
					step  : <?php echo $this->choices['step']; ?>,
					slide : function( event, ui ) { $( '#input_<?php echo $this->id; ?>' ).val(ui.value).keyup(); }
			});
			$( '#input_<?php echo $this->id; ?>' ).attr("value", $( '#slider_<?php echo $this->id; ?>' ).slider( "value" ) );
		});
		</script>
		<?php

	}
}
