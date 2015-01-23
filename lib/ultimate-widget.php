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
		$image = isset( $instance['image'] ) ? $instance['image'] : __( '', 'ultimate' );
		$color = isset( $instance['background_color'] ) ? $instance['background_color'] : __( '', 'ultimate' );

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

					<?php }

					if ( $color ) { 

						$widget_bg_color = esc_url($instance['background_color']); ?>

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
		$defaults = array('background_color' => '#e3e3e3');
		$instance = wp_parse_args( (array) $instance, $defaults ); 

		// Check values		
		$title = isset( $instance['title'] ) ? $instance['title'] : __( '', 'ultimate' );
		$selectbox = isset( $instance['selectbox'] ) ? $instance['selectbox'] : __( '', 'ultimate' );	
		$image = isset( $instance['image'] ) ? $instance['image'] : __( '', 'ultimate' );	
        $color = isset( $instance['background_color'] ) ? $instance['background_color'] : __( '', 'ultimate' );
      
		$background = isset( $instance['background'] ) ? $instance['background'] : __( '', 'ultimate' );	
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

		<p>
		<label for="<?php echo $this->get_field_id('background'); ?>"><?php _e('Select Background', 'ultimate'); ?></label>
		<select name="<?php echo $this->get_field_name('background'); ?>" id="<?php echo $this->get_field_id('background'); ?>" class="widefat">
			<option id="bgnone" value="bgnone" <?php if($background == 'bgnone') { echo 'selected="selected"'; }?>><?php _e('None', 'ultimate'); ?></option>
			<option id="bgimage" value="bgimage" <?php if($background == 'bgimage') { echo 'selected="selected"'; }?>><?php _e('Image', 'ultimate'); ?></option>
			<option id="bgcolor" value="bgcolor" <?php if($background == 'bgcolor') { echo 'selected="selected"'; }?>><?php _e('Color', 'ultimate'); ?></option>
		</select>
		</p>
		<?php 

		

		?>
		<script>

		jQuery(document).ready(function($) {
		$('.my-color-picker').wpColorPicker();
		});
		</script>

		 <label for="<?php echo $this->get_field_id( 'background_color' ); ?>">Background Color</label><br />
         
         <input class="my-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo esc_attr( $instance['background_color'] );?>" />     

		
		

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
		$instance['image'] = ( isset( $new_instance['image'] ) ) ? strip_tags( $new_instance['image'] ) : '';
		$instance['background_color'] = ( isset( $new_instance['background_color'] ) ) ? strip_tags( $new_instance['background_color'] ) : '';

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


/******************************************************************/
/**
 * Adds ultimate_contact_widget widget.
 */
class ultimate_contact_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
		
		'ultimate_contact_widget', // Base ID 		
		__('Ultimate contact Details', 'wpb_widget_domain'), // Widget name 
				array( 'description' => __( 'Sample widget Contact Details', 'wpb_widget_domain' ), ) ); // Widget description
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
		$selectbox = isset( $instance['name'] ) ? $instance['name'] : __( '', 'ultimate' );
	
				$title     = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title']) : __( '', 'ultimate' );
				$name      = isset( $instance['name'] ) ? $instance['name'] : __( '', 'ultimate' );
				$address   = isset( $instance['address'] ) ? $instance['address'] : __( '', 'ultimate' );
				$telephone = isset( $instance['telephone'] ) ? $instance['telephone'] : __( '', 'ultimate' );
				$mobile    = isset( $instance['mobile'] ) ? $instance['mobile'] : __( '', 'mobile' );
				$email     = isset( $instance['email'] ) ? $instance['email'] : __( '', 'email' );
				$fax       = isset( $instance['fax'] ) ? $instance['fax'] : __( '', 'fax' );
				$website   = isset( $instance['website'] ) ? $instance['website'] : __( '', 'ultimate' );

			
			   echo $before_widget;

			   // Check if title is set
			   if ( $title ) {
			   		echo $before_title . $title . $after_title;
				}

					// This is where you run the code and display the output ?>
					<div class="cntc-widget">
							<ul>
								<?php if ( !empty( $name ) ) : ?>
									<li class="entuser"><?php echo $name; ?></li>
								<?php else : ?>
									<li><?php echo $name; ?></li>
								<?php endif; ?>
								<?php if( !empty( $address ) ) : ?>
									<li class="entlocation"><?php echo $address; ?></li>
								<?php else : ?>	
									<li><?php echo $address; ?></li>
								<?php endif; ?>
								<?php if( !empty( $telephone ) ) : ?>
									<li class="entphone"><?php echo $telephone; ?></li>
								<?php else : ?>	
									<li><?php echo $telephone; ?></li>
								<?php endif; ?>
								<?php if( !empty( $mobile ) ): ?>
									<li class="entmobile"><?php echo $mobile; ?></li>
								<?php else : ?>	
									<li><?php echo $mobile; ?></li>
								<?php endif; ?>	
								<?php if( !empty( $email ) ) : ?>
									<li class="entmail"><?php echo $email; ?></li>
								<?php else : ?>
									<li><?php echo $email; ?></li>		
								<?php endif; ?>
								<?php if( !empty( $fax ) ) : ?>		
									<li class="entprinter"><?php echo $fax; ?></li>
                                <?php else : ?>   
                                	<li><?php echo $fax; ?></li>
                                <?php endif; ?>	
                                <?php if( !empty( $website ) ) : ?>
									<li class="entearth"><?php echo $website; ?></li>
                                <?php else : ?>
                                	<li><?php echo $website; ?></li>
                                <?php endif; ?>	
							</ul>
					</div>
					<style>
					.cntc-widget ul{margin: 0;padding: 0;line-height: 2em;font-family: 'Open Sans';font-size: 14px;width: 100%;position: relative;display: block;text-decoration: none;list-style: none;}
					.cntc-widget ul li{margin: 0;padding: 0;position: relative;display: block;padding-left: 20px;}
					.cntc-widget ul li:hover{cursor: pointer;}
					.entlocation:before, .entuser:before, .entearth:before, .entprinter:before, .entmail:before, .entphone:before, .entmobile:before{font-family: entypo;font-size: 14px;line-height: 1.84em;padding: 0;position: absolute;left: 0;margin-top: 2px;}
					</style>
		<?php 	echo $args['after_widget'];  }
		
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */ 
	public function form( $instance ) {

		// Check values		
		$title     = isset( $instance['title'] ) ? apply_filters('widget_title', $instance['title']) : __( '', 'ultimate' );
		$name      = isset( $instance['name'] ) ? $instance['name'] : __( '', 'ultimate' );
		$address   = isset( $instance['address'] ) ? $instance['address'] : __( '', 'ultimate' );
		$telephone = isset( $instance['telephone'] ) ? $instance['telephone'] : __( '', 'ultimate' );
		$mobile    = isset( $instance['mobile'] ) ? $instance['mobile'] : __( '', 'mobile' );
		$email     = isset( $instance['email'] ) ? $instance['email'] : __( '', 'email' );
		$fax       = isset( $instance['fax'] ) ? $instance['fax'] : __( '', 'fax' );
		$website   = isset( $instance['website'] ) ? $instance['website'] : __( '', 'ultimate' );
		// Widget admin form
	?>
	    <p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'ultimate'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Name:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Address:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php echo esc_attr( $address ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'telephone' ); ?>"><?php _e( 'Telephone:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'telephone' ); ?>" name="<?php echo $this->get_field_name( 'telephone' ); ?>" type="text" value="<?php echo esc_attr( $telephone ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'mobile' ); ?>"><?php _e( 'Mobile:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'mobile' ); ?>" name="<?php echo $this->get_field_name( 'mobile' ); ?>" type="text" value="<?php echo esc_attr( $mobile ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Email:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo esc_attr( $email ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'fax' ); ?>"><?php _e( 'Fax:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'fax' ); ?>" name="<?php echo $this->get_field_name( 'fax' ); ?>" type="text" value="<?php echo esc_attr( $fax ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'website' ); ?>"><?php _e( 'Website:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'website' ); ?>" name="<?php echo $this->get_field_name( 'website' ); ?>" type="text" value="<?php echo esc_attr( $website ); ?>" />
		</p>

    <?php   }
	
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
		$instance = array();

		$instance['title'] = ( isset( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['name'] = ( ! empty( $new_instance['name'] ) ) ? strip_tags( $new_instance['name'] ) : '';
		$instance['address'] = ( ! empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';
		$instance['telephone'] = ( ! empty( $new_instance['telephone'] ) ) ? strip_tags( $new_instance['telephone'] ) : '';
		$instance['mobile'] = ( ! empty( $new_instance['mobile'] ) ) ? strip_tags( $new_instance['mobile'] ) : '';
		$instance['email'] = ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';
		$instance['fax'] = ( ! empty( $new_instance['fax'] ) ) ? strip_tags( $new_instance['fax'] ) : '';
		$instance['website'] = ( ! empty( $new_instance['website'] ) ) ? strip_tags( $new_instance['website'] ) : '';

		return $instance;
	}
}

// Register and load the widget
function ultimate_register_contact_widget() {

	register_widget( 'ultimate_contact_widget' );
}
add_action( 'widgets_init', 'ultimate_register_contact_widget' );
?>