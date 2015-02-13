<?php 
/**
 * Adds Ultimate_Front_Page_Widget widget.
 */
class Ultimate_Front_Page_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {


    

		parent::__construct(
			'ultimate_front_page_widget', // Base ID
			__( 'Ultimate Page Select', 'ultimate' ), // Name
			array( 'description' => __( 'Display content of selected page.', 'ultimate' ), ) // Args
			);

	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	 public function widget( $args, $instance ) {
		extract( $args );
	   // these are the widget options
	   //$title = apply_filters('widget_title', $instance['title']);
	   //$selectbox = $instance['selectbox'];
	   //$image = $instance['image'];


		// Check values		
		$title =  isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title']) : __( '', 'ultimate' );
		$selectbox = isset( $instance['selectbox'] ) ? $instance['selectbox'] : __( '', 'ultimate' );
		$selectbackgrnd = isset( $instance['backgrounds'] ) ? $instance['backgrounds'] : __( '', 'ultimate' );
		$image = isset( $instance['image'] ) ? $instance['image'] : __( '', 'ultimate' );
		$color = isset( $instance['color'] ) ? $instance['color'] : __( '', 'ultimate' );
		$bckgrndSize = isset( $instance['bckgrndSize'] ) ? $instance['bckgrndSize'] : __( '', 'ultimate' );
        $cover = isset( $instance['cover'] ) ? $instance['cover'] : __( '', 'ultimate' );
        $color = isset( $instance['contain'] ) ? $instance['contain'] : __( '', 'ultimate' );
        $color = isset( $instance['initial'] ) ? $instance['initial'] : __( '', 'ultimate' );
        $bckgrndPos = isset( $instance['bckgrndPos'] ) ? $instance['bckgrndPos'] : __( '', 'ultimate' );
        $fixed = isset( $instance['fixed'] ) ? $instance['fixed'] : __( '', 'ultimate' );
        $top = isset( $instance['top'] ) ? $instance['top'] : __( '', 'ultimate' );
        $bottom = isset( $instance['bottom'] ) ? $instance['bottom'] : __( '', 'ultimate' );
        $left = isset( $instance['left'] ) ? $instance['left'] : __( '', 'ultimate' );
        $right = isset( $instance['right'] ) ? $instance['right'] : __( '', 'ultimate' );
        $bckgrndAttc = isset( $instance['bckgrndAttc'] ) ? $instance['bckgrndAttc'] : __( '', 'ultimate' );	
        $fixed = isset( $instance['fixed'] ) ? $instance['fixed'] : __( '', 'ultimate' );
        $top = isset( $instance['top'] ) ? $instance['top'] : __( '', 'ultimate' );
        $bckgrndRpt = isset( $instance['bckgrndRpt'] ) ? $instance['bckgrndRpt'] : __( '', 'ultimate' );
        $repeat = isset( $instance['repeat'] ) ? $instance['repeat'] : __( '', 'ultimate' );
        $repeatx = isset( $instance['repeat-x'] ) ? $instance['repeat-x'] : __( '', 'ultimate' );
        $repeaty = isset( $instance['repeat-y'] ) ? $instance['repeat-y'] : __( '', 'ultimate' );
        $repeatnone = isset( $instance['none'] ) ? $instance['none'] : __( '', 'ultimate' );
		
        echo $bckgrndSize;
        echo $bckgrndPos;
	   // Display the widget
	   echo $before_widget;

	   // Check if title is set
	   if ( $title ) {
	   		echo $before_title . $title . $after_title;
		}

	   // Check if selectbox is set
	   if( $selectbox ) {

			// WP_Query arguments
			$args = array (
				'page_id' => $selectbox,
			);

			// The Query
			$query = new WP_Query( $args );
			while ($query->have_posts()) : $query->the_post(); ?>


				<article id="post-<?php the_ID(); ?>">

					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->


					<?php 

					    if ( $selectbackgrnd == 'Image' && $image || has_post_thumbnail() ) {

						if ( $image ) {
							$widget_bg_image = esc_url($instance['image']);
						}
						else if( has_post_thumbnail() ) { 
							$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'ultimate' ); 
							$widget_bg_image = $featured_image[0];
						}
						else if ( $selectbackgrnd == 'Image' && $image && has_post_thumbnail() ) {
							$widget_bg_image = esc_url($instance['image']);
							$widget_bg_size = esc_url($instance['cover']);
						} ?>

						<div class="widget-thumbnail" style="background: url('<?php echo $widget_bg_image; ?>');background-size: <?php echo $bckgrndSize;?>;
							background-position: <?php echo $bckgrndPos;?>; background-attachment: <?php echo $bckgrndAttc;?>; background-repeat: <?php echo $bckgrndRpt; ?>"></div>

				  <?php } else if ( $selectbackgrnd == 'Color' && $color ) { 
				  	     echo "hi";

						$widget_bg_color = esc_url($instance['color']); ?>

						<div class="widget-thumbnail" style="background:<?php echo $widget_bg_color; ?>"></div> 
					<?php }	?>
					
				</article><!-- #post -->

			<?php
			endwhile;
			wp_reset_postdata();
	   }

	   echo $after_widget;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );

		// Check values		
		$title = isset( $instance['title'] ) ? $instance['title'] : __( '', 'ultimate' );
		$selectbox = isset( $instance['selectbox'] ) ? $instance['selectbox'] : __( '', 'ultimate' );
        $backgrounds = $instance['backgrounds'] ;	
        $image = isset( $instance['image'] ) ? $instance['image'] : __( '', 'ultimate' );
        $color = isset( $instance['color'] ) ? $instance['color'] : __( '', 'ultimate' );
        $bckgrndSize = $instance['bckgrndSize'] ;	
        $cover = isset( $instance['cover'] ) ? $instance['cover'] : __( '', 'ultimate' );
        $color = isset( $instance['contain'] ) ? $instance['contain'] : __( '', 'ultimate' );
        $color = isset( $instance['initial'] ) ? $instance['initial'] : __( '', 'ultimate' );
        $bckgrndPos = $instance['bckgrndPos'] ;	
        $fixed = isset( $instance['fixed'] ) ? $instance['fixed'] : __( '', 'ultimate' );
        $top = isset( $instance['top'] ) ? $instance['top'] : __( '', 'ultimate' );
        $bottom = isset( $instance['bottom'] ) ? $instance['bottom'] : __( '', 'ultimate' );
        $left = isset( $instance['left'] ) ? $instance['left'] : __( '', 'ultimate' );
        $right = isset( $instance['right'] ) ? $instance['right'] : __( '', 'ultimate' );
        $bckgrndAttc = $instance['bckgrndAttc'] ;	
        $fixed = isset( $instance['fixed'] ) ? $instance['fixed'] : __( '', 'ultimate' );
        $top = isset( $instance['top'] ) ? $instance['top'] : __( '', 'ultimate' );
        $bckgrndRpt = $instance['bckgrndRpt'] ;	
        $repeat = isset( $instance['repeat'] ) ? $instance['repeat'] : __( '', 'ultimate' );
        $repeatx = isset( $instance['repeat-x'] ) ? $instance['repeat-x'] : __( '', 'ultimate' );
        $repeaty = isset( $instance['repeat-y'] ) ? $instance['repeat-y'] : __( '', 'ultimate' );
        $repeatnone = isset( $instance['none'] ) ? $instance['none'] : __( '', 'ultimate' );
     
        echo $bckgrndSize;
        echo $image;
        echo $color;
        echo $bckgrndPos;
        echo $fixed1;
      	
		?>

		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'ultimate'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('selectbox'); ?>"><?php _e('Select Page', 'ultimate'); ?></label>
		<select name="<?php echo $this->get_field_name('selectbox'); ?>" id="<?php echo $this->get_field_id('selectbox'); ?>" class="widefat">
		<?php
		global $post;
		$posts = get_pages();
		foreach( $posts as $post ) : setup_postdata($post); ?>
			<option id="<?php echo $post->ID; ?>" value="<?php echo $post->ID; ?>" <?php if($selectbox == $post->ID) { echo 'selected="selected"'; }?>><?php the_title(); ?></option>
		<?php endforeach; 
		wp_reset_postdata();
		?>
		</select>
		</p>

      <label for="<?php echo $this->get_field_id('backgrounds'); ?>">Select Background 
      	<?php $uid = uniqid(); ?>
        <select class='widefat' id="<?php //echo $this->get_field_id('backgrounds'); ?>selectBoxId_<?php echo $uid;  ?>" name="<?php echo $this->get_field_name('backgrounds'); ?>" type="text">
        <option value='None'<?php echo ($backgrounds =='None')?'selected':''; ?>>None</option>
        <option value='Image'<?php echo ($backgrounds =='Image')?'selected':''; ?>><?php _e('Image', 'ultimate'); ?></option> 
        <option value='Color'<?php echo ($backgrounds =='Color')?'selected':''; ?>>Color</option> 
        </select>                
      </label>



    <?php if( $backgrounds == 'Image') {?>
    	<div class="imageBox" style="display:block;">
			<p>
				<label for="<?php echo $this->get_field_id('image'); ?>">Background Image</label><br />
					<?php
					if ( $image != '' ) {

					echo '<img class="ultimate_media_image" src="' . $image . '" style="margin:10px 0;padding:0;max-width:100%;float:left;display:inline-block" /><br />';
					}
					?>
				<input type="text" class="widefat ultimate_media_url" name="<?php echo $this->get_field_name('image'); ?>" id="<?php echo $this->get_field_id('image'); ?>" value="<?php echo $image; ?>" style="display: none;">
				<input type="button" class="button button-primary ultimate_media_button" id="ultimate_media_button" name="<?php echo $this->get_field_name('image'); ?>" value="Upload Image" style="margin-top:5px;" />
			</p>
			
				<label for="<?php echo $this->get_field_id('bckgrndSize'); ?>">Background Size
					<?php $uid = uniqid(); ?>
					<select class='widefat' id="<?php //echo $this->get_field_id('backgrounds'); ?>bckgrndSize_<?php echo $uid;  ?>" name="<?php echo $this->get_field_name('bckgrndSize'); ?>" type="text">
					<option value='cover'<?php echo ($bckgrndSize =='cover')?'selected':''; ?>>cover</option>
					<option value='contain'<?php echo ($bckgrndSize =='contain')?'selected':''; ?>>contain</option> 
					<option value='initial'<?php echo ($bckgrndSize =='initial')?'selected':''; ?>>initial</option> 
					</select>                
				</label>
			    <label for="<?php echo $this->get_field_id('bckgrndPos'); ?>">Background Position 
					<?php $uid = uniqid(); ?>
					<select class='widefat' id="<?php //echo $this->get_field_id('backgrounds'); ?>bckgrndPos_<?php echo $uid;  ?>" name="<?php echo $this->get_field_name('bckgrndPos'); ?>" type="text">
					<option value='fixed'<?php echo ($bckgrndPos =='fixed')?'selected':''; ?>>fixed</option>
					<option value='top'<?php echo ($bckgrndPos =='top')?'selected':''; ?>>top</option> 
					<option value='bottom'<?php echo ($bckgrndPos =='bottom')?'selected':''; ?>>bottom</option>
					<option value='left'<?php echo ($bckgrndPos =='left')?'selected':''; ?>>left</option> 
					<option value='right'<?php echo ($bckgrndPos =='right')?'selected':''; ?>>right</option>
					</select>                
				</label>
			
				<label for="<?php echo $this->get_field_id('bckgrndAttc'); ?>">Background Attachment 
					<?php $uid = uniqid(); ?>
					<select class='widefat' id="<?php //echo $this->get_field_id('backgrounds'); ?>bckgrndAttc_<?php echo $uid;  ?>" name="<?php echo $this->get_field_name('bckgrndAttc'); ?>" type="text">
					<option value='fixed'<?php echo ($bckgrndPos =='fixed')?'selected':''; ?>>fixed</option>
					<option value='scroll'<?php echo ($bckgrndPos =='scroll')?'selected':''; ?>>scroll</option> 
					</select>                
				</label>

				<label for="<?php echo $this->get_field_id('bckgrndRpt'); ?>">Background Position 
					<?php $uid = uniqid(); ?>
					<select class='widefat' id="<?php //echo $this->get_field_id('backgrounds'); ?>bckgrndRpt_<?php echo $uid;  ?>" name="<?php echo $this->get_field_name('bckgrndRpt'); ?>" type="text">
					<option value='repeat'<?php echo ($bckgrndRpt =='repeat')?'selected':''; ?>>repeat</option>
					<option value='repeat-x'<?php echo ($bckgrndRpt =='repeat-x')?'selected':''; ?>>repeat-x</option> 
					<option value='repeat-y'<?php echo ($bckgrndRpt =='repeat-y')?'selected':''; ?>>repeat-y</option>
					<option value='none'<?php echo ($bckgrndRpt =='none')?'selected':''; ?>>none</option> 
					</select>                
				</label>
						
		</div>
	<?php  }elseif ( $backgrounds == 'Color') { ?>
    <div class="colorBox" style="display:block;">

			 <label for="<?php echo $this->get_field_id( 'color' ); ?>">Background Color</label><br />
	         <input class="my-color-picker" type="text" id="<?php echo $this->get_field_id( 'color' ); ?>" name="<?php echo $this->get_field_name( 'color' ); ?>" value="<?php echo esc_attr( $instance['color'] );?>" />     
     	</div>
     <?php } ?>	

     <div>
		<div class="imageBox" style="display:none;">
			<p>
				<label for="<?php echo $this->get_field_id('image'); ?>">Background Image</label><br />
					<?php
					if ( $image != '' ) {
					echo '<img class="ultimate_media_image" src="' . $image . '" style="margin:10px 0;padding:0;max-width:100%;float:left;display:inline-block" /><br />';
					}
					?>
				<input type="text" class="widefat ultimate_media_url" name="<?php echo $this->get_field_name('image'); ?>" id="<?php echo $this->get_field_id('image'); ?>" value="<?php echo $image; ?>" style="display: none;">
				<input type="button" class="button button-primary ultimate_media_button" id="ultimate_media_button" name="<?php echo $this->get_field_name('image'); ?>" value="Upload Image" style="margin-top:5px;" />
			</p>
			<P>
				 <label for="<?php echo $this->get_field_id('bckgrndSize'); ?>">Select Background 
					<?php $uid = uniqid(); ?>
					<select class='widefat' id="<?php //echo $this->get_field_id('backgrounds'); ?>backgroundSize_<?php echo $uid;  ?>" name="<?php echo $this->get_field_name('bckgrndSize'); ?>" type="text">
					<option value='cover'<?php echo ($bckgrndSize =='cover')?'selected':''; ?>>cover</option>
					<option value='contain'<?php echo ($bckgrndSize =='contain')?'selected':''; ?>>contain</option> 
					<option value='initial'<?php echo ($bckgrndSize =='initial')?'selected':''; ?>>initial</option> 
					</select>                
				</label>
			</p>

		
		</div>

		<div class="colorBox" style="display:none;">
			 <label for="<?php echo $this->get_field_id( 'color' ); ?>">Background Color</label><br />
	         <input class="my-color-picker" type="text" id="<?php echo $this->get_field_id( 'color' ); ?>" name="<?php echo $this->get_field_name( 'color' ); ?>" value="<?php echo esc_attr( $instance['color'] );?>" />     
     	</div>
     </div>
			
	<script>
		jQuery(document).ready(function(){
			var select = jQuery("#selectBoxId_<?php echo $uid;  ?>");
			jQuery('body').on('change','#selectBoxId_<?php echo $uid;  ?>',function(){
				var data = jQuery(this).val();
				switch(data){
					case 'Image':
						jQuery(document).trigger('image_uploader_selected');
						break;

					case 'Color':
						jQuery(document).trigger('color_picker_selected');
						break;
					case 'None':
						jQuery(document).trigger('no_selection');
						break;
				}
			});
		});

		jQuery(document).on('image_uploader_selected',function(){
			jQuery(".bgnone").css("display", "none");
            jQuery(".imageBox").css("display", "block");
            jQuery(".colorBox").css("display", "none"); 
		});

		jQuery(document).on('color_picker_selected',function(){
			 jQuery(".bgnone").css("display", "none");
             jQuery(".imageBox").css("display", "none");
             jQuery(".colorBox").css("display", "block"); 
		});

		jQuery(document).on('no_selection',function(){
			 jQuery(".bgnone").css("display", "none");
             jQuery(".imageBox").css("display", "none");
             jQuery(".colorBox").css("display", "none"); 
		});

</script>

	<script type="text/javascript">
	jQuery(document).ready(function($) {
	$('.my-color-picker').wpColorPicker();
	});
	</script>

	<?php }

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		// Fields		
		$instance['title'] = ( isset( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['selectbox'] = ( isset( $new_instance['selectbox'] ) ) ? strip_tags( $new_instance['selectbox'] ) : '';
		$instance['backgrounds'] = ( isset( $new_instance['backgrounds'] ) ) ? strip_tags( $new_instance['backgrounds'] ) : '';
		$instance['image'] = ( isset( $new_instance['image'] ) ) ? strip_tags( $new_instance['image'] ) : '';
		$instance['color'] = ( isset( $new_instance['color'] ) ) ? strip_tags( $new_instance['color'] ) : '';
		$instance['bckgrndSize'] = ( isset( $new_instance['bckgrndSize'] ) ) ? strip_tags( $new_instance['bckgrndSize'] ) : '';
		$instance['cover'] = ( isset( $new_instance['cover'] ) ) ? strip_tags( $new_instance['cover'] ) : '';
		$instance['contain'] = ( isset( $new_instance['contain'] ) ) ? strip_tags( $new_instance['contain'] ) : '';
		$instance['initial'] = ( isset( $new_instance['initial'] ) ) ? strip_tags( $new_instance['initial'] ) : '';
		$instance['bckgrndPos'] = ( isset( $new_instance['bckgrndPos'] ) ) ? strip_tags( $new_instance['bckgrndPos'] ) : '';
		$instance['fixed'] = ( isset( $new_instance['fixed'] ) ) ? strip_tags( $new_instance['fixed'] ) : '';
		$instance['top'] = ( isset( $new_instance['top'] ) ) ? strip_tags( $new_instance['top'] ) : '';
		$instance['bottom'] = ( isset( $new_instance['bottom'] ) ) ? strip_tags( $new_instance['bottom'] ) : '';
		$instance['left'] = ( isset( $new_instance['left'] ) ) ? strip_tags( $new_instance['left'] ) : '';
		$instance['right'] = ( isset( $new_instance['right'] ) ) ? strip_tags( $new_instance['right'] ) : '';
		$instance['bckgrndAttc'] = ( isset( $new_instance['bckgrndAttc'] ) ) ? strip_tags( $new_instance['bckgrndAttc'] ) : '';
		$instance['fixed'] = ( isset( $new_instance['fixed'] ) ) ? strip_tags( $new_instance['fixed'] ) : '';
		$instance['top'] = ( isset( $new_instance['top'] ) ) ? strip_tags( $new_instance['top'] ) : '';
		$instance['bckgrndRpt'] = ( isset( $new_instance['bckgrndRpt'] ) ) ? strip_tags( $new_instance['bckgrndRpt'] ) : '';
		$instance['repeat'] = ( isset( $new_instance['repeat'] ) ) ? strip_tags( $new_instance['repeat'] ) : '';
		$instance['repeat-x'] = ( isset( $new_instance['repeat-x'] ) ) ? strip_tags( $new_instance['repeat-x'] ) : '';
		$instance['repeat-y'] = ( isset( $new_instance['repeat-y'] ) ) ? strip_tags( $new_instance['repeat-y'] ) : '';
		$instance['none'] = ( isset( $new_instance['none'] ) ) ? strip_tags( $new_instance['none'] ) : '';
		
		return $instance;
	}

} // class Ultimate_Front_Page_Widget

// register Ultimate_Front_Page_Widget widget
function ultimate_register_page_select_widget() {
    register_widget( 'Ultimate_Front_Page_Widget' );
}
add_action( 'widgets_init', 'ultimate_register_page_select_widget' );

// add admin scripts
add_action('admin_enqueue_scripts', 'ultimate_widget_script');
function ultimate_widget_script() {
    wp_enqueue_media();
	wp_enqueue_style('thickbox');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
    wp_enqueue_script('ultimate_widget_script', get_template_directory_uri() . '/js/widget.js', false, '1.0', true);
}
