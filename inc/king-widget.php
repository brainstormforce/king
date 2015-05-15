<?php 
/**
 * Adds King_Front_Page_Widget widget.
 *
 * @package King
 * @since King 1.0
 */

class King_Front_Page_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'king_front_page_widget', // Base ID
			__( 'King Page Select', 'king' ), // Name
			array( 'description' => __( 'Display content of selected page.', 'king' ), ) // Args
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
		$title =  isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title']) : __( '', 'king' );
		$selectbox = isset( $instance['selectbox'] ) ? $instance['selectbox'] : __( '', 'king' );	
		$image = isset( $instance['image'] ) ? $instance['image'] : __( '', 'king' );

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


					<?php if ( $image || has_post_thumbnail() ) {

						if ( $image ) {
							$widget_bg_image = esc_url($instance['image']);
						}
						else if( has_post_thumbnail() ) { 
							$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'king' ); 
							$widget_bg_image = $featured_image[0];
						}
						else if ( $image && has_post_thumbnail() ) {
							$widget_bg_image = esc_url($instance['image']);
						} ?>

						<div class="widget-thumbnail" style="background-image: url('<?php echo $widget_bg_image; ?>')"></div>

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
		
		// Check values		
		$title = isset( $instance['title'] ) ? $instance['title'] : __( '', 'king' );
		$selectbox = isset( $instance['selectbox'] ) ? $instance['selectbox'] : __( '', 'king' );	
		$image = isset( $instance['image'] ) ? $instance['image'] : __( '', 'king' );	

		$background = isset( $instance['background'] ) ? $instance['background'] : __( '', 'king' );	
		?>

		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'king'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('selectbox'); ?>"><?php _e('Select Page', 'king'); ?></label>
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

		<p>
		<label for="<?php echo $this->get_field_id('background'); ?>"><?php _e('Select Background', 'king'); ?></label>
		<select name="<?php echo $this->get_field_name('background'); ?>" id="<?php // echo $this->get_field_id('background'); ?>pratik" class="widefat">
			<option id="bgnone" value="bgnone" <?php if($background == 'bgnone') { echo 'selected="selected"'; }?>><?php _e('None', 'king'); ?></option>
			<option id="bgimage" value="bgimage" <?php if($background == 'bgimage') { echo 'selected="selected"'; }?>><?php _e('Image', 'king'); ?></option>
			<option id="bgcolor" value="bgcolor" <?php if($background == 'bgcolor') { echo 'selected="selected"'; }?>><?php _e('Color', 'king'); ?></option>
		</select>
		</p>

		<p class="bgnone">bgnone</p>
		<p class="bgimage">bgimage</p>
		<p class="bgcolor">bgcolor</p>

		<p>
        <label for="<?php echo $this->get_field_id('image'); ?>">Background Image</label><br />
		<?php
		if ( $image != '' ) {
		echo '<img class="king_media_image" src="' . $image . '" style="margin:10px 0;padding:0;max-width:100%;float:left;display:inline-block" /><br />';
		}
		?>
		<input type="text" class="widefat king_media_url" name="<?php echo $this->get_field_name('image'); ?>" id="<?php echo $this->get_field_id('image'); ?>" value="<?php echo $image; ?>" style="display: none;">
		<input type="button" class="button button-primary king_media_button" id="king_media_button" name="<?php echo $this->get_field_name('image'); ?>" value="Upload Image" style="margin-top:5px;" />
		</p>

		<?php
	}

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
		$instance['image'] = ( isset( $new_instance['image'] ) ) ? strip_tags( $new_instance['image'] ) : '';
		return $instance;
	}

} // class King_Front_Page_Widget

// register King_Front_Page_Widget widget
function king_register_page_select_widget() {
    register_widget( 'King_Front_Page_Widget' );
}
add_action( 'widgets_init', 'king_register_page_select_widget' );

// add admin scripts
add_action('admin_enqueue_scripts', 'king_widget_script');
function king_widget_script() {
    wp_enqueue_media();
	wp_enqueue_style('thickbox');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
    wp_register_script( 'king-widget-script', get_template_directory_uri() . '/inc/js/jquery.colorbox.min.js', false, '1.0.0', true );
	wp_enqueue_script( 'king-widget-script' );
}

?>