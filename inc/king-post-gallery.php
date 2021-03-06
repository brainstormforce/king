<?php
/*
 * Gallery Options
 *
 * @package King
 * @since King 1.0
 */


// Add new field in gallery settings
add_action('print_media_templates', 'king_media_templates');
function king_media_templates(){

  // define your backbone template;
  // the "tmpl-" prefix is required,
  // and your input field should have a data-setting attribute
  // matching the shortcode name
  ?>
  <script type="text/html" id="tmpl-king-gallery-setting">
    <label class="setting">
      <span><?php _e('Gallery Type', 'king'); ?></span>
      <select data-setting="gallery_type">
        <option value="slideshow"> Slideshow </option>
        <option value="metro"> Metro </option>
        <option value="grid"> Grid </option>
      </select>
    </label>
  </script>

  <script>

    jQuery(document).ready(function(){

      // add your shortcode attribute and its default value to the
      // gallery settings list; $.extend should work as well...
      _.extend(wp.media.gallery.defaults, {
        gallery_type: 'slideshow'
      });

      // merge default gallery settings template with yours
      wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
        template: function(view){
          return wp.media.template('gallery-settings')(view)
               + wp.media.template('king-gallery-setting')(view);
        }
      });

    });

  </script>
  <?php
};

/**
* Overrite the HTML output of gallery shortcode to the custom output for carousel slider
*/
function king_gallery_shortcode( $output = '', $atts ) {

    $ids = '';
    extract( shortcode_atts( array(
        'ids' => '',
        'gallery_type' => '',
        'columns' => '',
        'link' => '',
        'size' => ''        
    ), $atts ) );
    $images = explode( ",", $ids );
    $smgid  = 'gallery_' . uniqid();

    $gallery_type = (esc_attr($gallery_type) == '' ? 'default' : esc_attr($gallery_type));
    $columns = (esc_attr($columns) == '' ? '3' : esc_attr($columns));
    $size = (esc_attr($size) == '' ? 'thumbnail' : esc_attr($size));
    $link = (esc_attr($link) == '' ? 'post' : esc_attr($link));

    ob_start();

    if ( count( $images ) > 1 ) {
        

        if (($gallery_type == "metro")) { // If gallery Type is Metro 

            ?>

                <div id="<?php echo $smgid; ?>" class="king-justified-grid-gallery">
                    <div class="king-justified-grid">
                        <?php 
                            $n = 0;
                            foreach ( $images as $id ) {
                                $cls = ( $n == 0 ) ? 'active' : '';

                                $image_full_attributes = wp_get_attachment_image_src( $id, 'full' );
                                $image_full_url = $image_full_attributes[0];

                                $image_attachment_url = get_attachment_link($id);

                                if ($link == 'post') {
                                    $image_link = $image_attachment_url;
                                } else if ($link == 'file') {
                                    $image_link = $image_full_url;
                                } else {
                                    $image_link = '#';
                                }

                                $image_attributes = wp_get_attachment_image_src(  $id, $size );
                                $image_url = $image_attributes[0];

                                $image_info_array = (array)get_post($id);
                                $image_caption = $image_info_array['post_excerpt'];

                                if ( isset( $id ) && $id !== '' ) { ?>
                                    <a <?php if($link == 'file') { 
                                            echo 'rel="king-lightbox" class="king-lightbox"'; 
                                        }?> 
                                        href="<?php echo $image_link; ?>" 
                                        <?php if($link == 'none') { 
                                            echo 'onclick=" return false;"';
                                        }?>
                                        title="<?php echo $image_caption; ?>">
                                        <img src="<?php echo $image_url; ?>" alt="<?php echo $image_caption; ?>"/>
                                    </a>
                                <?php 
                                }
                                $n ++;
                            } 
                        ?>
                    </div> <!-- .king-justified-grid -->
                </div> <!-- .king-justified-grid-gallery -->

        <?php } else if (($gallery_type == "grid")) { // If gallery Type is Grid ?>

                <div id="<?php echo $smgid; ?>" class="king-grid-gallery king-grid-column-<?php echo $columns;?> clear">
                    <?php 
                            $n = 0;
                            foreach ( $images as $id ) {
                                $cls = ( $n == 0 ) ? 'active' : '';

                                $image_full_attributes = wp_get_attachment_image_src( $id, 'full' );
                                $image_full_url = $image_full_attributes[0];

                                $image_attachment_url = get_attachment_link($id);

                                if ($link == 'post') {
                                    $image_link = $image_attachment_url;
                                } else if ($link == 'file') {
                                    $image_link = $image_full_url;
                                } else {
                                    $image_link = '#';
                                }

                                $image_attributes = wp_get_attachment_image_src(  $id, $size );
                                $image_url = $image_attributes[0];

                                $image_info_array = (array)get_post($id);
                                $image_caption = $image_info_array['post_excerpt'];

                                if ( isset( $id ) && $id !== '' ) { ?>
                                    <a <?php if($link == 'file') { 
                                            echo 'rel="king-lightbox" class="king-lightbox"'; 
                                        }?> 
                                        href="<?php echo $image_link; ?>" 
                                        <?php if($link == 'none') { 
                                            echo 'onclick=" return false;"';
                                        }?>
                                        title="<?php echo $image_caption; ?>">
                                        <img src="<?php echo $image_url; ?>" alt="<?php echo $image_caption; ?>"/>
                                        <h4 class="text-center king-grid-img-caption"><?php echo $image_caption;?></h4>
                                    </a>
                                <?php 
                                }
                                $n ++;
                            } 
                        ?>
                </div><!-- .king-grid-gallery -->


        <?php } else { // If gallery Type is Slideshow ?>

            <div id="<?php echo $smgid; ?>" class="king-slideshow-gallery" data-slidesToShow="<?php echo $columns;?>" data-slidesToScroll="<?php echo $columns;?>">  
                <?php 
                    $n = 0;
                    foreach ( $images as $id ) {
                        $cls = ( $n == 0 ) ? 'active' : '';

                        $image_full_attributes = wp_get_attachment_image_src( $id, 'full' );
                        $image_full_url = $image_full_attributes[0];

                        $image_attachment_url = get_attachment_link($id);

                        if ($link == 'post') {
                            $image_link = $image_attachment_url;
                        } else if ($link == 'file') {
                            $image_link = $image_full_url;
                        } else {
                            $image_link = '#';
                        }

                        $image_attributes = wp_get_attachment_image_src(  $id, $size );
                        $image_url = $image_attributes[0];

                        $image_info_array = (array)get_post($id);
                        $image_caption = $image_info_array['post_excerpt'];

                        if ( isset( $id ) && $id !== '' ) { ?>
                            <a <?php if($link == 'file') { 
                                    echo 'rel="king-lightbox" class="king-lightbox"'; 
                                }?> 
                                href="<?php echo $image_link; ?>" 
                                <?php if($link == 'none') { 
                                    echo 'onclick=" return false;"';
                                }?>
                                title="<?php echo $image_caption; ?>">
                                <img src="<?php echo $image_url; ?>" alt="<?php echo $image_caption; ?>"/>
                                <?php if( $columns == 1 && is_singular()) {?>
                                    <h4 class="text-center"><?php echo $image_caption;?></h4>
                                <?php } ?>
                            </a>
                        <?php 
                        }
                        $n ++;
                    } 
                ?>
            </div>
            
        <?php } ?>

    <?php
    } elseif ( count( $images ) == 1 ) {
        ?>
        <div id="<?php echo $smgid; ?>" class="king-carousel carousel slide" data-ride="carousel">
            <?php $n = 0;
            foreach ( $images as $id ) {
                $cls              = ( $n == 0 ) ? 'active' : '';
                $image_attributes = wp_get_attachment_image_src( $id, 'full' );
                if ( $id !== '' ) {
                    ?>
                    <div class="item <?php echo $cls; ?>"><img src="<?php echo $image_attributes[0]; ?>" alt="Gallery image"/></div>
                <?php
                }
                $n ++;
            } ?>
        </div>
    <?php
    }
    echo ob_get_clean();
}
add_filter( 'post_gallery', 'king_gallery_shortcode', 10, 4 );