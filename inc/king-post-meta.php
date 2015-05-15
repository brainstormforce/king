<?php 
/*
 * King post meta options
 * 
 * @package King
 * @since King 1.0
 */

// Post Meta
if ( ! function_exists( 'king_post_meta' ) ) :
    function king_post_meta() {

        global $post;
        if (! $post)
            return false;
        ob_start();
        ob_end_clean();
        $html = '';

        if( get_theme_mod( 'blog_author_meta', true )) :
            $html .= '<span class="post-meta-item">';
            $html .= __('By ','king'); 
            $html .= '<span class="vcard author"><a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'" title="Posts by '. get_the_author() .'" rel="author">'. get_the_author() .'</a></span>'; 
            $html .= '</span>'; // .post-meta-item
        endif;

        if( get_theme_mod( 'blog_date_meta', true )) :
            $archive_year  = get_the_time('Y');
            $archive_month = get_the_time('m');
            $html .= '<span class="post-meta-item">';
            $html .= '<span class="post-meta-date"><a href="'. get_month_link( $archive_year, $archive_month ) .'">'. get_the_date('d M, Y') .'</a></span>';
            $html .= '</span>'; // .post-meta-item
        endif;

        if( get_theme_mod( 'blog_category_meta', false )) :
            $categories_list = get_the_category_list( __( ' ', 'king' ) );      
            if( $categories_list ) :
                $html .=  '<span class="post-meta-item">';
                $html .=  '<span class="post-meta-category">'. get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'king' ) ) .'</span>';
                $html .=  '</span>'; // .post-meta-item
            endif;
        endif;

        if( get_theme_mod( 'blog_tag_meta', false )) :
            $tag_list = get_the_tag_list( __( ' ', 'king' ) );      
            if( $tag_list ) :
                $html .=  '<span class="post-meta-item">';
                $html .=  '<span class="post-meta-category">'. get_the_tag_list('',', ', '') .'</span>';
                $html .=  '</span>'; // .post-meta-item
            endif;
        endif;

        if( get_theme_mod( 'blog_comment_meta', false )) :
            if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : 
                $num_comments = get_comments_number(); // get_comments_number returns only a numeric value
                if ( $num_comments == 0 ) {
                    $comments = __('Leave a Comment', 'king' );
                } elseif ( $num_comments > 1 ) {
                    $comments = $num_comments . __(' Comments', 'king' );
                } else {
                    $comments = __('1 Comment', 'king' );
                }
                $html .=  '<span class="post-meta-item">';
                $html .=  '<span class="post-meta-comment"><a href="'. esc_url( get_comments_link() ) .'" title="Comment on '. get_the_title() .'">'. $comments .'</a></span>'; 
                $html .=  '</span>'; // .post-meta-item
            endif;
        endif;      

        if( get_theme_mod( 'blog_link_meta', false )) :
            if ( !is_single() ) :
                $html .=  '<span class="post-meta-item">';
                $html .=  '<span class="post-meta-link"><a href="'. esc_url( get_the_permalink() ) .'" rel="bookmark">'.__('Read More...','king') .'</a></span>';
                $html .=  '</span>'; // .post-meta-item
            endif;
        endif;
        
        if( is_user_logged_in() ):
                $html .=  '<span class="post-meta-item">';
                $html .=  '<span class="post-meta-edit"><a class="post-edit-link" href="'. esc_url( get_edit_post_link() ).'">'. __( 'Edit', 'king' ) .'</a></span>';
                $html .=  '</span>'; // .post-meta-item
        endif;

        if ($html != '') :
            echo '<div class="entry-summary-meta">';
            echo '<div class="post-meta">';
            echo $html;
            echo '</div>';
            echo '</div>';
        endif;
    }
    $blog_layout = get_theme_mod('blog_layout', 'grid-3');
    if($blog_layout != 'grid-2' && $blog_layout != 'grid-3' && $blog_layout != 'grid-4') :
        add_action('king_entry_bottom', 'king_post_meta', 10, 1);
    endif;
endif;

// Remove Post Meta From Pages, 404, Grid Blog layout
if ( ! function_exists( 'king_add_post_meta' ) ) :
    function king_add_post_meta() {
        $blog_layout = get_theme_mod('blog_layout', 'grid-3');
        if($blog_layout != 'grid-2' && $blog_layout != 'grid-3' && $blog_layout != 'grid-4') :
            if ( is_single() || is_attachment() ) :
                remove_action('king_entry_bottom', 'king_post_meta', 10);
            endif;
        endif;

        if ( is_page() ) :
            remove_action('king_entry_bottom', 'king_post_meta', 10);
        endif;

        if ( is_single() || is_attachment() ) :
            add_action('king_entry_bottom', 'king_post_meta', 10, 1);
        endif;
    }
    add_action( 'wp', 'king_add_post_meta' );
endif;