<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 */
$blog_layout = get_theme_mod('blog_layout', 'grid-3');
if ( have_posts() ) :
	/* Start the Loop */
	while ( have_posts() ) : the_post();
		if($blog_layout == 'grid-2' || $blog_layout == 'grid-3' || $blog_layout == 'grid-4') { 
			get_template_part( 'content', 'blog-grid' );
		}
		else if($blog_layout == 'medium-image') { 
	        get_template_part( 'content', 'blog-medium' );
	    } 
		else { 
	        get_template_part( 'content', get_post_format() );
	    }
	endwhile;
endif;
