<?php
/**
 * The template for displaying posts in the Video post format
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-summary">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ultimate' ) ); ?>
			</div><!-- .entry-content -->
		</div><!-- .entry-summary -->

		<div class="entry-summary-meta">
			<div class="post-meta">
	            <?php
					$categories_list = get_the_category_list( __( ' ', 'ultimate' ) );
	                echo __('By ','imedica'); echo '<span class="vcard author"><span class="fn">'; the_author_posts_link(); echo '</span></span>';
					echo '<span class="updated post-date"><span class="sep"> | </span>'.get_the_date('d M, Y').'</span>';
					if($categories_list){
	                	echo '<span class="sep"> | </span>'; echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'ultimate' ) );
					}
	                if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : 
	                    echo '<span class="sep"> | </span>'; echo comments_popup_link( __( 'Leave a comment ', 'ultimate' ), __( 'Comment (1)', 'twentyfourteen' ), __( 'Comments (%)', 'ultimate' ) ); 
	                endif;
	                if ( !is_single() ){echo '<span class="sep"> | </span>'; echo '<a href="'.get_the_permalink().'" rel="bookmark">'.__('Read More...','imedica').'</a>';}
	                if(is_user_logged_in())
	                    echo '<span class="sep"> | </span>'; edit_post_link( __( 'Edit', 'imedica' ), '<span class="edit-link">', '</span>' );
	            ?>
	        </div>
        </div><!-- .entry-summary-meta -->
        
	</article><!-- #post -->
