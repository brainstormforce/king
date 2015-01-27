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
		echo $image;
		$color = isset( $instance['color'] ) ? $instance['color'] : __( '', 'ultimate' );
		echo $color;
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


				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->


					<?php 

					    if ( $image || has_post_thumbnail() ) {

						if ( $image ) {
							$widget_bg_image = esc_url($instance['image']);
						}
						else if( has_post_thumbnail() ) { 
							$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'ultimate' ); 
							$widget_bg_image = $featured_image[0];
						}
						else if ( $image && has_post_thumbnail() ) {
							$widget_bg_image = esc_url($instance['image']);
						} ?>

						<div class="widget-thumbnail" style="background: url('<?php echo $widget_bg_image; ?>')"></div>

					<?php }elseif ( $color ) { 

						$widget_bg_color = esc_url($instance['color']); ?>

						<div class="widget-thumbnail" style="background:<?php echo $widget_bg_color; ?>"></div>
						
					<?php } ?>
					
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
        echo $backgrounds;
        echo $image;
        echo $color;
      	
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