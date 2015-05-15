<?php 
/*
 * Include infinite scroll
 *
 * @package King
 * @since King 1.0
 */

function king_infinite_scroll_callback() {
    global $wp_query;
    $blog_layout = get_theme_mod('blog_layout', 'grid-3');
    
    $blog_animation = get_theme_mod('blog_animation', 'fadeIn');
    ?>
        <script type="text/javascript">
            (function($) {
                "use strict";
                
                var stop_scroll = false;
                
                var count = 2;
                var total = <?php echo esc_js($wp_query->max_num_pages); ?>;
                
                
                function loadKingArticle(pageNumber) {
                    stop_scroll = true;
                    $.ajax({
                        url: "<?php echo esc_url( home_url() ); ?>/wp-admin/admin-ajax.php",
                        type: 'POST',
                        data: "action=king_infinite_scroll&page_no=" + pageNumber,
                        success: function(data){
                            var $boxes = $(data);
                            $('#content').append($boxes);
                            stop_scroll = false;
                            $('.king-loader').removeClass('animated').removeClass('fadeInUp');
                            $boxes.each(function(i,box){
                                $(box).addClass('post');
                            });
                            <?php if($blog_layout == 'grid-2' || $blog_layout == 'grid-3' || $blog_layout == 'grid-4') : ?>
                                $('.blog-masonry #content').masonry( 'appended', $boxes, true);
                                $('.blog-masonry #content').imagesLoaded( function() {
                                    setTimeout(function(){
                                        $('.blog-masonry #content').masonry( 'reload' );
                                    },1500);                    
                                });
                            <?php endif; ?>
                            <?php if($blog_animation != 'none') : ?>
                                var animate = $('.king-animation-wrapper').attr('data-king-animate');
                                $boxes.each(function(i,blog){
                                    if(typeof animate === 'undefined' || animate === '')
                                        return;
                                    var appear = $(blog).kingsIsAppear();
                                    $('#content').find('article').css('opacity',0);
                                    if((typeof animate !== 'undefined' && animate !== '') && appear) {
                                        $(blog).addClass('animated').addClass(animate).css('opacity',1);
                                    }
                                });
                            <?php endif; ?>
                        }
                    });
                }               
                $(window).scroll(function(){
                    if($(window).scrollTop() >= ($('#content').height()-($(window).height()-200)))
                    {
                        if (count > total)
                        {
                            return false;
                        }
                        else
                        {
                            if(stop_scroll == true)
                                return false;
                            $('.king-loader').addClass('animated').addClass('fadeInUp');
                            loadKingArticle(count);
                            count++;
                        }
                    }
                });
            })(jQuery);
        </script>
    <?php
}
$blog_pagination = get_theme_mod( 'blog_pagination', 'number' );
if($blog_pagination == 'infinite')
    add_action('wp_footer', 'king_infinite_scroll_callback');

function king_infinite_scroll_ajax_callback() {
    $paged          = $_POST['page_no'];
    $posts_per_page = get_option( 'posts_per_page' );


    # Load the posts
    query_posts( array( 'paged' => $paged, 'post_status' => 'publish' ) );
    get_template_part( 'loop' );

    exit;
}
add_action( 'wp_ajax_king_infinite_scroll', 'king_infinite_scroll_ajax_callback' );           // for logged in user
add_action( 'wp_ajax_nopriv_king_infinite_scroll', 'king_infinite_scroll_ajax_callback' );    // if user not logged in

/* Loader For Infinite Scroll */
function get_king_loader() {
    $output = '<div class="king-bubblingG king-loader">
        <span id="king-bubblingG_1">
        </span>
        <span id="king-bubblingG_2">
        </span>
        <span id="king-bubblingG_3">
        </span>
    </div>';

    echo apply_filters('king_loader_html',$output);
}
add_action('king_loader', 'get_king_loader');