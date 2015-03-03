<?php 

// Retrive & Embed video from post
if ( ! function_exists( 'king_post_video' ) ) :
function king_post_video() {

    global $post;
    if (! $post)
        return false;
    ob_start();
    ob_end_clean();

    $html = '';

    if ( preg_match('/\[(\[?)(video)(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*+(?:\[(?!\/\2\])[^\[]*+)*+)\[\/\2\])?)(\]?)/', $post->post_content, $matches)) {
        $html .= do_shortcode($matches[0]); 
    }
    elseif ( 
            preg_match('#https?://wordpress.tv/.*#i', $post->post_content, $matches) ||
            preg_match('#http://(www\.)?youtube\.com/watch.*#i', $post->post_content, $matches) ||
            preg_match('#https://(www\.)?youtube\.com/watch.*#i', $post->post_content, $matches) ||
            preg_match('#http://(www\.)?youtube\.com/playlist.*#i', $post->post_content, $matches) ||
            preg_match('#https://(www\.)?youtube\.com/playlist.*#i', $post->post_content, $matches) ||
            preg_match('#http://youtu\.be/.*#i', $post->post_content, $matches) ||
            preg_match('#https://youtu\.be/.*#i', $post->post_content, $matches) ||
            preg_match('#http://blip.tv/.*#i', $post->post_content, $matches) ||
            preg_match('#https?://(.+\.)?vimeo\.com/.*#i', $post->post_content, $matches) ||
            preg_match('#https?://(www\.)?dailymotion\.com/.*#i', $post->post_content, $matches) ||
            preg_match('#http://dai.ly/.*#i', $post->post_content, $matches) ||
            preg_match('#https?://(www\.)?funnyordie\.com/videos/.*#i', $post->post_content, $matches) ||
            preg_match('#https?://(www\.)?hulu\.com/watch/.*#i', $post->post_content, $matches) ||
            preg_match('#https?://(www\.|embed\.)?ted\.com/talks/.*#i', $post->post_content, $matches) ||
            preg_match('#https?://vine.co/v/.*#i', $post->post_content, $matches) 
        ) {
            $embedurl = $matches[0];
            if (!empty($embedurl)) {
                   $var = apply_filters('the_content', "[embed]" . $embedurl . "[/embed]");
            }
            $html .= '<div class="blog-oembed">';
            $html .= $var;
            $html .= '</div>';
    }
    else {
        return false;
    }
    return $html;
}
endif;


// Embed Audio Post
if ( ! function_exists( 'king_post_audio' ) ) :
    function king_post_audio() { // for audio post type - grab

        global $post;
        if (! $post)
            return false;
        ob_start();
        ob_end_clean();

        $html = '';

        if ( 
                preg_match('#https?://(www\.)?mixcloud\.com/.*#i', $post->post_content, $matches) ||
                preg_match('#https?://(www\.)?rdio\.com/.*#i', $post->post_content, $matches) ||
                preg_match('#https?://rd\.io/x/.*#i', $post->post_content, $matches) ||
                preg_match('#https?://(www\.)?soundcloud\.com/.*#i', $post->post_content, $matches) ||
                preg_match('#https?://(open|play)\.spotify\.com/.*#i', $post->post_content, $matches)
            ) {
                $embedurl = $matches[0];
                if (!empty($embedurl)) {
                       $var = apply_filters('the_content', "[embed]" . $embedurl . "[/embed]");
                }
                $html .= '<div class="blog-oembed">';
                $html .= $var;
                $html .= '</div>';
        }
        else {
            return false;
        }
        return $html;
    }

endif;


// Embed social data - Twitter
if ( ! function_exists( 'king_post_social' ) ) :
    function king_post_social() { // for social media embeds

        global $post;
        if (! $post)
            return false;
        ob_start();
        ob_end_clean();

        $html = '';

        if ( preg_match('#https?://(www\.)?twitter\.com/.+?/status(es)?/.*#i', $post->post_content, $matches) ) {
                $embedurl = $matches[0];
                if (!empty($embedurl)) {
                       $var = apply_filters('the_content', "[embed]" . $embedurl . "[/embed]");
                }
                $html .= '<div class="blog-oembed">';
                $html .= $var;
                $html .= '</div>';
        }
        else {
            return false;
        }
        return $html;
    }

endif;