<?php // ult_html_before(); ?>
<html>
<head>
	<?php // ult_head_top(); ?>
	<title><?php wp_title(); ?></title>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); 	?>" type="text/css" media="all" />
	<?php// ult_head_bottom(); ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php // ult_body_top(); ?>
	<?php // ult_header_before(); ?>
	<div id="header">
		<?php // ult_header_top(); ?>
		<h1><?php bloginfo( 'name' ); ?></h1>
		<p class="dscription"><?php bloginfo( 'description' ); ?></p>
		<?php // ult_header_bottom(); ?>
	</div><!-- #header -->
	<?php// ult_header_after(); ?>








	<?php // ult_content_before(); ?>
	<div id="content">
		<?php // ult_content_top(); ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php // ult_entry_before(); ?>
			<div <?php post_class( 'entry' ); ?>>
				<?php// ult_entry_top(); ?>
				<h2><?php the_title(); ?></h2>
				<div class="itemtext">
					<?php the_content(); ?>
				</div>
				<?php// ult_entry_bottom(); ?>
			</div>
			<?php // ult_entry_after(); ?>

		<?php endwhile; endif; ?>
		
		<?php // ult_comments_before(); ?>
		<?php comments_template(); ?>
		<?php // ult_comments_after(); ?>

		<?php // ult_content_bottom(); ?>
	</div>
	<?php// ult_content_after(); ?>







	
	<?php // ult_sidebars_before(); ?>
	<div id="sidebar">
		<?php // ult_sidebar_top(); ?>
		<?php dynamic_sidebar( 'sidebar' ); ?>
		<?php // ult_sidebar_bottom(); ?>
	</div><!-- #sidebar-->
	<?php // ult_sidebars_after(); ?>
	
	<?php // ult_footer_before(); ?>
	<div id="footer">
		<?php // ult_footer_top(); ?>
		
		<h3>Footer</h3>
		<p>This is some sample footer text.</p>
		
		<?php // ult_footer_bottom(); ?>
	</div><!-- #footer -->
	<?php // ult_footer_after(); ?>
	<?php // ult_body_bottom(); ?>
	<?php wp_footer(); ?>
</body>
</html>