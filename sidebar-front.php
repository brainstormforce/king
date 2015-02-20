<?php
/**
 * The sidebar containing the front page widget areas
 *
 * If no active widgets are in either sidebar, hide them completely.
 *
 * @package WordPress
 * @subpackage Ultimate
 * @since Ultimate 1.0
 */

/*
 * The front page widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
if ( ! is_active_sidebar( 'sidebar-front-1' ) && ! is_active_sidebar( 'sidebar-front-2' ) && ! is_active_sidebar( 'sidebar-front-3' ) )
	return;


// If we get this far, we have widgets. Let do this.
?>
<div id="secondary-front" class="widget-area front-sidebar clear" role="complementary">

	<?php
        $front_sidebars = array("sidebar-front-1", "sidebar-front-2", "sidebar-front-3");
        $fn = 0;
        foreach($front_sidebars as $fkey => $front_sidebar){
            if(is_active_sidebar($front_sidebar)){
                $fn++;
            } else {
                unset($front_sidebars[$fkey]);
            }
        }
        if($fn !== 0){
            $fron_cols = 12 / $fn;
	
		    foreach($front_sidebars as $fkey => $front_sidebar){
		        echo '<div class="col-sm-'.$fron_cols.'">';
		        dynamic_sidebar($front_sidebar);
		        echo '</div>'; 
		    }
		} 
	?>

</div><!-- #secondary -->