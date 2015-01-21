<?php
/**
 * The template for displaying posts in the Gallery post format
 */
?>
<?php
	$cls = $cls2 = '';
	if(!is_single()){
		if(has_post_thumbnail() || has_shortcode( $post->post_content, 'gallery' )){
			$cls = 'col-md-8 col-lg-8 col-xl-8 col-xs-12';
			$cls2 = 'col-md-4 col-lg-4 col-xl-4 col-xs-12';
		} else {
			$cls = '';
		}
	} else {
		$cls = $cls2 = '';
	}
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if(has_post_thumbnail() || has_shortcode( $post->post_content, 'gallery' ) || is_single()){ ?>
			<header class="entry-header <?php echo $cls2; ?>">
				<?php if ( ! post_password_required() && ! is_attachment() ) : ?>
						   <?php 
							$post_content = $post->post_content;						   
						    $post_id =$post->ID;
						   ultimate_gallery($post_id, $post_content); ?>
						<?php else : ?>
							the_post_thumbnail();
				<?php endif; ?>
	            <?php if(is_single()){ ?>
	            <h1 class="entry-title"><?php the_title(); ?></h1>
	            <?php } ?>
			</header><!-- .entry-header -->
        <?php } ?>

        <?php if ( !is_single() ) : // Only display Excerpts for Search ?>
            <div class="entry-summary <?php echo $cls; ?>">
				<h1 class="entry-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h1>				
				<?php add_filter( 'the_content', 'strip_shortcodes' ); ?>
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ultimate' ) ); ?>
			</div><!-- .entry-summary -->

		<?php else : ?>
			<div class="entry-content <?php echo $cls; ?>">
				<?php add_filter( 'the_content', 'strip_shortcodes' ); ?>
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ultimate' ) ); ?>
				<?php 
					if(function_exists('ultimate_pagination')){
						ultimate_pagination();
					} else {
						wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'ultimate' ), 'after' => '</div>' ) );
					}
				?>
			</div><!-- .entry-content -->
		<?php endif; ?>

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
	        </div><!-- .post-meta -->
        </div><!-- .entry-summary-meta -->
       
	</article><!-- #post -->