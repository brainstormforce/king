<?php 

/**
 * Include Animation For Blog Posts
 *
 * @since King 1.0
 */
$blog_animation = get_theme_mod('blog_animation', 'fadeIn');
if($blog_animation != 'none') :
    add_action('king_content_top','king_animation_before_wrapper');
    function king_animation_before_wrapper() {
        echo '<div class="king-animation-wrapper" data-king-animate="'. get_theme_mod('blog_animation', 'fadeIn') .'">';
    }
    add_action('king_content_bottom','king_animation_after_wrapper');
    function king_animation_after_wrapper() {
        echo '</div>';
    }
endif;

function king_animations_callback() {
    $blog_animation = get_theme_mod('blog_animation', 'fadeIn');
    if($blog_animation != 'none') :
        if ( is_home() || is_archive() || is_search() ) : 
        ?>
            <script type="text/javascript">
                (function($) {
                    "use strict";
                    $.fn.kingsIsAppear = function(options) { 
                        var defaults = {
                            viewport: 90, //in percentage
                        };
            
                        var options = $.extend(defaults, options);
                        var ws = jQuery(window).scrollTop();
                        var wh = $(window).height();
                        var viewport = 100 - options.viewport;
                        var viewport_pixel = wh - (wh * (viewport/100));
                        var offset = $(this).offset().top;
                        var position = offset - ws;
                        if(position <= viewport_pixel)
                            return true;
                        else
                            return false;
                    }
                    
                    function kingsAnimateBlog() {
                        var animate = $('.king-animation-wrapper').attr('data-king-animate');
                        $('.king-animation-wrapper').find('article').each(function(i,blog){
                            if(typeof animate === 'undefined' || animate === '')
                                return;
                            var appear = $(blog).kingsIsAppear();
                            $('#content').find('article').css('opacity',0);
                            if((typeof animate !== 'undefined' && animate !== '') && appear) {
                                $(blog).addClass('animated').addClass(animate).css('opacity',1);
                            }
                        });
                    }
                    
                    $(document).ready(function(){
                        kingsAnimateBlog();
                    });
                    $(window).scroll(function(){
                        kingsAnimateBlog();
                    });
                        
                })(jQuery);
            </script>
        <?php
        endif;
    endif;
}
add_action('wp_footer', 'king_animations_callback');