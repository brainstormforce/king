<?php
/**
* The template for displaying the footer
*
* Contains footer content and the closing of the #main and #page div elements.
*
* @package WordPress
* @subpackage King
* @since King 1.0
*/
?>

    </div><!-- #main .wrapper -->

    <?php ult_footer_before(); ?>
    <div id="footer">
        <?php ult_footer_top(); ?>
        <?php
        $sidebars = array("sidebar-footer-1", "sidebar-footer-2", "sidebar-footer-3", "sidebar-footer-4");
        $n = 0;
        foreach($sidebars as $key => $sidebar){
            if(is_active_sidebar($sidebar)){
                $n++;
            } else {
                unset($sidebars[$key]);
            }
        }
        if($n !== 0){
            $cols = 12 / $n; ?>

            <div class="main-footer">
                <div class="footer-widget-area">
                    <?php
                        foreach($sidebars as $key => $sidebar){
                            echo '<div class="col-sm-'.$cols.'">';
                            dynamic_sidebar($sidebar);
                            echo '</div>'; 
                        }
                    ?>
                </div> <!-- .footer-widget-area -->
            </div> <!-- .main-footer -->

            <?php 
        } ?>

        <footer id="colophon" role="contentinfo">
            <div class="footer-bottom-container">

                <?php 
                    // Change footer class w.r.t. to copyright text
                    if( (get_theme_mod( 'display_copyright' ) != '') && (has_nav_menu( 'footer-menu' ) ) ) { 
                        $footer_class = "col-md-6 col-sm-6 col-xl-6 col-xs-12";
                    } 
                    else { 
                        $footer_class = "col-md-12 col-sm-12 col-xl-12 col-xs-12";
                    } 
                ?>

                <?php if( get_theme_mod( 'display_copyright', true ) != '') : ?>
                    <div class="site-info <?php echo $footer_class; ?>">
                        <?php if( get_theme_mod( 'copyright_text_link', true ) == '') { ?>
                            <?php echo get_theme_mod( 'copyright_textbox', 'Proudly powered by WP Shark @BRAINSTORM' ); ?>
                        <?php } else { ?>
                            <a href="<?php echo get_theme_mod( 'copyright_text_link', 'http://www.brainstormforce.com/' ); ?>" title="<?php echo get_theme_mod( 'copyright_textbox', 'Proudly powered by WP Shark @BRAINSTORM' ); ?>"><?php echo get_theme_mod( 'copyright_textbox', 'Proudly powered by WP Shark @BRAINSTORM' ); ?></a>
                        <?php } // end if ?>
                    </div><!-- .site-info -->
                <?php endif; ?>

                <?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
                    <div class="footer-menu <?php echo $footer_class; ?>">                    
                        <?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'nav-menu','depth' => 1 ) ); ?>                  
                    </div> <!-- .footer-menu -->
                <?php endif; ?>

            </div> <!-- .footer-bottom-container -->
        </footer> <!-- #colophon -->
        <?php ult_footer_bottom(); ?>

    </div> <!-- #footer -->
    <?php ult_footer_after(); ?>

</div><!-- #page -->
<?php ult_body_bottom(); ?>
<?php wp_footer(); ?>
</body>
</html>