<?php
if ( ! function_exists( 'king_number_pagination' ) ) :
    function king_number_pagination($pages = '', $range = 2)
    {  
    	 ob_start();
         $showitems = ($range * 2)+1;  
         global $paged;
         if(empty($paged)) $paged = 1;
         if($pages == '')
         {
             global $wp_query;
             $pages = $wp_query->max_num_pages;
             if(!$pages)
             {
                 $pages = 1;
             }
         }   
         if(1 != $pages)
         {
             echo "<div class='king-pagination'>";
             if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a class='paginate-first' href='".get_pagenum_link(1)."'>&laquo;</a>";
             if($paged > 1 && $showitems < $pages) echo "<a class='paginate-prev' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
             for ($i=1; $i <= $pages; $i++)
             {
                 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                 {
                     echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
                 }
             }
             if ($paged < $pages && $showitems < $pages) echo "<a class='paginate-next' href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
             if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a class='paginate-last' href='".get_pagenum_link($pages)."'>&raquo;</a>";
             echo "</div>\n";
         }
    	 
    	 echo ob_get_clean();
    }
endif;

if ( ! function_exists( 'king_content_nav' ) ) :
    function king_content_nav( $html_id ) {
        global $wp_query;
        $html_id = esc_attr( $html_id );
        if ( $wp_query->max_num_pages > 1 ) : ?>
            <nav id="<?php echo $html_id; ?>" class="navigation clear" role="navigation">
                <h3 class="assistive-text"><?php _e( 'Post navigation', 'king' ); ?></h3>
                <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'king' ) ); ?></div>
                <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'king' ) ); ?></div>
            </nav><!-- #<?php echo $html_id; ?> .navigation -->
        <?php endif;
    }
endif;


if ( ! function_exists( 'king_pagination' ) ) :
    function king_pagination() {
        if( get_theme_mod( 'blog_pagination' )) {
            king_number_pagination();
        } else {
            king_content_nav( 'nav-below' ); 
        }
    }
endif;