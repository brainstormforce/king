	<p>
				<label for="<?php echo $this->get_field_id('imagebackgrounds'); ?>">Background Size 
				<?php $uid = uniqid(); ?>
					<select class='widefat' id="<?php //echo $this->get_field_id('backgrounds'); ?>backgroundSize" name="<?php echo $this->get_field_name('backgrounds'); ?>" type="text">
					<option value='Cover'<?php echo ($backgrounds =='Cover')?'selected':''; ?>>Cover</option>
					<option value='Contain'<?php echo ($backgrounds =='Contain')?'selected':''; ?>>Contain</option> 
					<option value='Initial'<?php echo ($backgrounds =='Initial')?'selected':''; ?>>Initial</option> 
					</select>                
				</label>

			</p>



<p>
				<label for="<?php echo $this->get_field_id('bkgrndPos'); ?>">Background Position 
				<?php $uid = uniqid(); ?>
					<select class='widefat' id="<?php //echo $this->get_field_id('backgrounds'); ?>backgroundPos_<?php echo $uid; ?>" name="<?php echo $this->get_field_name('bkgrndPos'); ?>" type="text">
					<option value='Fixed'<?php echo ($bkgrndPos =='Fixed')?'selected':''; ?>>Fixed</option>
					<option value='Top'<?php echo ($bkgrndPos =='Top')?'selected':''; ?>>Top</option> 
					<option value='Bottom'<?php echo ($bkgrndPos =='Bottom')?'selected':''; ?>>Bottom</option>
					<option value='Left'<?php echo ($bkgrndPos =='Left')?'selected':''; ?>>Left</option> 
					<option value='Right'<?php echo ($bkgrndPos =='Right')?'selected':''; ?>>Right</option>
					</select>         
				</label>

			</p>


			$instance['bkgrndPos'] = ( isset( $new_instance['bkgrndPos'] ) ) ? strip_tags( $new_instance['bkgrndPos'] ) : '';
		$instance['Fixed'] = ( isset( $new_instance['Fixed'] ) ) ? strip_tags( $new_instance['Fixed'] ) : '';
		$instance['Top'] = ( isset( $new_instance['Top'] ) ) ? strip_tags( $new_instance['Top'] ) : '';
		$instance['Bottom'] = ( isset( $new_instance['Bottom'] ) ) ? strip_tags( $new_instance['Bottom'] ) : '';
		$instance['Left'] = ( isset( $new_instance['Left'] ) ) ? strip_tags( $new_instance['Left'] ) : '';
		$instance['Right'] = ( isset( $new_instance['Right'] ) ) ? strip_tags( $new_instance['Right'] ) : '';

		<p>
				<label for="<?php echo $this->get_field_id('bkgrndPos'); ?>">Background Position 
				<?php $uid = uniqid(); ?>
					<select class='widefat' id="<?php //echo $this->get_field_id('backgrounds'); ?>backgroundPos_<?php echo $uid; ?>" name="<?php echo $this->get_field_name('bkgrndPos'); ?>" type="text">
					<option value='Fixed'<?php echo ($bkgrndPos =='Fixed')?'selected':''; ?>>Fixed</option>
					<option value='Top'<?php echo ($bkgrndPos =='Top')?'selected':''; ?>>Top</option> 
					<option value='Bottom'<?php echo ($bkgrndPos =='Bottom')?'selected':''; ?>>Bottom</option>
					<option value='Left'<?php echo ($bkgrndPos =='Left')?'selected':''; ?>>Left</option> 
					<option value='Right'<?php echo ($bkgrndPos =='Right')?'selected':''; ?>>Right</option>
					</select>         
				</label>

			</p>


			 $bkgrndPos = $instance['bkgrndPos'] ;
        $cover = isset( $instance['Fixed'] ) ? $instance['Fixed'] : __( '', 'ultimate' );
        $contain = isset( $instance['Top'] ) ? $instance['Top'] : __( '', 'ultimate' );
        $initial = isset( $instance['Bottom'] ) ? $instance['Bottom'] : __( '', 'ultimate' );
        $contain = isset( $instance['Left'] ) ? $instance['Left'] : __( '', 'ultimate' );
        $initial = isset( $instance['Right'] ) ? $instance['Right'] : __( '', 'ultimate' );


         $bkgrndPos =isset( $instance['bkgrndPos'] ) ? $instance['bkgrndPos'] : __( '', 'ultimate' );
        $cover = isset( $instance['Fixed'] ) ? $instance['Fixed'] : __( '', 'ultimate' );
        $contain = isset( $instance['Top'] ) ? $instance['Top'] : __( '', 'ultimate' );
        $initial = isset( $instance['Bottom'] ) ? $instance['Bottom'] : __( '', 'ultimate' );
        $contain = isset( $instance['Left'] ) ? $instance['Left'] : __( '', 'ultimate' );
        $initial = isset( $instance['Right'] ) ? $instance['Right'] : __( '', 'ultimate' );


        --------------------------------------------------------------------------

        	<p>
				<label for="<?php echo $this->get_field_id('imagebackgrounds'); ?>">Background Size 
				<?php $uid = uniqid(); ?>
					<select class='widefat' id="<?php //echo $this->get_field_id('backgrounds'); ?>backgroundSize_<?php echo $uid; ?>" name="<?php echo $this->get_field_name('imagebackgrounds'); ?>" type="text">
					<option value='Cover'<?php echo ($imagebackgrounds =='Cover')?'selected':''; ?>>Cover</option>
					<option value='Contain'<?php echo ($imagebackgrounds =='Contain')?'selected':''; ?>>Contain</option> 
					<option value='Initial'<?php echo ($imagebackgrounds =='Initial')?'selected':''; ?>>Initial</option>
					</select>         
				</label>

			</p>
        