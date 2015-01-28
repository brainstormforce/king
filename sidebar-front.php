<?php
/**
 * The sidebar containing the front page widget areas
 *
 * If no active widgets are in either sidebar, hide them completely.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/*
 * The front page widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
if ( ! is_active_sidebar( 'sidebar-3' ) && ! is_active_sidebar( 'sidebar-4' ) && ! is_active_sidebar( 'sidebar-5' ) )
	return;


// If we get this far, we have widgets. Let do this.
?>
<div id="secondary" class="widget-area front-sidebar clear" role="complementary">


	<?php
        $front_sidebars = array("sidebar-3", "sidebar-4", "sidebar-5");
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

<?php /*
	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	<div class="first front-widgets">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div><!-- .first -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
	<div class="second front-widgets">
		<?php dynamic_sidebar( 'sidebar-3' ); ?>
	</div><!-- .second -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
	<div class="third front-widgets">
		<?php dynamic_sidebar( 'sidebar-4' ); ?>
	</div><!-- .second -->
	<?php endif; ?>

*/ ?>	

</div><!-- #secondary -->