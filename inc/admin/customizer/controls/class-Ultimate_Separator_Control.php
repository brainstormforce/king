<?php
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