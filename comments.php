<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to ultimate_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Ultimate
 * @since Ultimate 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">

			<?php 
				$ult_cmnt_no = get_comments_number();
				$ult_cmnt_msg = (($ult_cmnt_no == 0 || $ult_cmnt_no == 1) ? 'REPLY' : 'REPLIES')
			 ?>
			<div class="ult-cmnt-circle">
				<span class="ult-cmnt-number"><?php _e( number_format_i18n( get_comments_number()), 'ultimate'); ?></span>
				<span class="ult-cmnt-message"><?php echo $ult_cmnt_msg; ?></span>
			</div>

		</h2>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'ultimate_comment', 'style' => 'ol' ) ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'ultimate' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'ultimate' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'ultimate' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'ultimate' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php comment_form(); ?>

</div><!-- #comments .comments-area -->