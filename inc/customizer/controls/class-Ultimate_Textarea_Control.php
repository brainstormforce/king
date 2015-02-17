<?php

class Ultimate_Textarea_Control extends WP_Customize_Control {

	public $type = 'textarea';
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

			<textarea class="of-input" rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			
		</label>
		<?php
	}

}
