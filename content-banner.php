<?php
/**
 * The template for displaying content in 2 column grid layout
 *
 * Used for Grid Layouts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<?php
	$bl_grid = get_theme_mod('blog_layout');
	$cls = $cls2 = 'col-md-12 col-lg-12 col-xl-12 col-xs-12';
	$post_class = 'col-md-6 col-lg-6 col-xl-6 col-xs-12 col-sm-12 post-item';

	$grid_post_format = get_post_format(); // Get Post Format
?>

<?php if($grid_post_format == "gallery") : ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>

        <?php if(has_post_thumbnail() || has_shortcode( $post->post_content, 'gallery' )) : ?>
			<header class="entry-header <?php echo $cls2; ?>">
				<?php if ( ! post_password_required() && ! is_attachment() ) : ?>
						<?php if( has_shortcode( $post->post_content, 'gallery' ) ) : ?>
							<?php 
							$post_content = $post->post_content;						   
							$post_id =$post->ID;
							ultimate_gallery_shortcode($post_id, $post_content);
							?>
						<?php else : ?>
							the_post_thumbnail();
						<?php endif; ?>
				<?php endif; ?>
			</header><!-- .entry-header -->
        <?php endif; ?>

        <div class="entry-summary <?php echo $cls; ?>">
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			<p class="post-meta">
	        <?php
				$categories_list = get_the_category_list( __( ' ', 'ultimate' ) );
	            echo __('By ','imedica'); echo '<span class="vcard author"><span class="fn">'; the_author_posts_link(); echo '</span></span>';
				echo '<span class="updated post-date"><span class="sep"> | </span>'.get_the_date('d M, Y').'</span>';
				/*if($categories_list){
	            	echo '<span class="sep"> | </span>'; echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'ultimate' ) );
				}*/
	            if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : 
	                echo '<span class="sep"> | </span>'; echo comments_popup_link( __( 'Leave a comment ', 'ultimate' ), __( 'Comment (1)', 'twentyfourteen' ), __( 'Comments (%)', 'ultimate' ) ); 
	            endif;
	            /*if ( !is_single() ){echo '<span class="sep"> | </span>'; echo '<a href="'.get_the_permalink().'" rel="bookmark">'.__('Read More...','imedica').'</a>';}
	            if(is_user_logged_in())
	                echo '<span class="sep"> | </span>'; edit_post_link( __( 'Edit', 'imedica' ), '<span class="edit-link">', '</span>' );*/
	        ?>
	    	</p>
	    	<div class="content-sep"></div>
			<?php the_excerpt(); ?>

		</div> <!-- .entry-summary -->
		
	</article><!-- #post -->

<?php else : ?>	

	<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>

		
			<div class="banner-blog-container">
			        <?php if(has_post_thumbnail()){ ?>
			        	<div class="banner-blog-image">        	
							<?php if ( ! post_password_required()) :
								the_post_thumbnail();
							endif; ?>
						</div> <!-- .banner-blog-image -->
					<?php } else { ?>
						<div class="banner-blog-randombg"></div>
					<?php } // end if ?>

			        <div class="banner-blog-info entry-summary <?php echo $cls; ?>">
						<h1 class="entry-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h1>
						
						<div class="post-meta">
				        	<?php ultimate_post_meta($post); ?>
				    	</div>

					</div> <!-- .banner-blog-info -->

			</div> <!-- .banner-blog-container -->
	
	</article><!-- #post -->

<?php endif; ?>