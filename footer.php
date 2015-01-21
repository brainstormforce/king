<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
	<div id="footer">
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
                    $cols = 12 / $n;
			?>
			<div class="main-footer">
				<div class="footer-widget-area">
             <?php
                    foreach($sidebars as $key => $sidebar){
                        echo '<div class="col-sm-'.$cols.'">';
                        dynamic_sidebar($sidebar);
                        echo '</div>'; 
                    }
			  ?>
				</div>
			</div>
          	<?php } ?>
        <footer id="colophon" role="contentinfo">
        	<div class="footer-bottom-container">
                <div class="site-info col-md-6 col-sm-6 col-xl-6 col-xs-12">
                    <?php do_action( 'ultimate_credits' ); ?>
                    <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'ultimate' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'ultimate' ); ?>"><?php printf( __( 'Proudly powered by %s', 'ultimate' ), 'WordPress' ); ?></a>
                </div><!-- .site-info -->
                <div class="footer-menu col-md-6 col-sm-6 col-xl-6 col-xs-12">
                    <?php if ( has_nav_menu( 'footer-menu' ) ) {
                        wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'nav-menu','depth' => 1 ) ); 
                    } ?>
                </div>
			</div>
        </footer><!-- #colophon -->
       </div>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>