<?php
/*
 * Add Custom RGBA Color Control
 * Reference - http://pluto.kiwi.nz/2014/07/how-to-add-a-color-control-with-alphaopacity-to-the-wordpress-theme-customizer/
 *
 * @package King
 * @since King 1.0
 */

class King_RGBA_Control extends WP_Customize_Control {
    
    public $type = 'alphacolor';
    public $palette = true;
    public $default = '#3FADD7';

    protected function render() {
        $id = 'customize-control-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) );
        $class = 'customize-control customize-control-' . $this->type; ?>
        <li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
            <?php $this->render_content(); ?>
        </li>
    <?php }

    public function render_content() { ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <input type="text" data-palette="<?php echo $this->palette; ?>" data-default-color="<?php echo $this->default; ?>" value="<?php echo intval( $this->value() ); ?>" class="king-color-control" <?php $this->link(); ?>  />
        </label>
    <?php }
}