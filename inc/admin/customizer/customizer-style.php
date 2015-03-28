<?php
add_action('wp_head', 'king_custom_style');

if(!function_exists("king_custom_style")) :

	function king_custom_style() {
		$fonts = array();
		/* Global Default Font */
		$default_font_temp = $page_title_font_temp = array();
		$default_font = get_theme_mod('default_site_font', 'Open Sans');
		$default_font = explode(':',$default_font);
		$default_font_family = isset($default_font[0]) ? $default_font[0] : 'Open Sans';
		$default_font_weight = isset($default_font[1]) ? $default_font[1] : '400';
		$default_font_style = isset($default_font[2]) ? $default_font[2] : 'normal';
		$default_font_temp['family'] = $default_font_family;
		if($default_font_style === 'italic')
			$default_font_weight .= $default_font_style;
		$default_font_temp['varient'] = $default_font_weight;
		array_push($fonts, $default_font_temp);

		/* Site Title Font */
		$site_title_font = get_theme_mod('site_title_font', 'Open Sans');
		$site_title_font_size = get_theme_mod('site_title_font_size', '24');
		$site_title_font = explode(':',$site_title_font);
		$site_title_font_family = isset($site_title_font[0]) ? $site_title_font[0] : 'Open Sans';
		$site_title_font_weight = isset($site_title_font[1]) ? $site_title_font[1] : '400';
		$site_title_font_style = isset($site_title_font[2]) ? $site_title_font[2] : 'normal';
		$site_title_font_temp['family'] = $site_title_font_family;
		if($site_title_font_style === 'italic')
			$site_title_font_weight .= $site_title_font_style;
		$site_title_font_temp['varient'] = $site_title_font_weight;
		array_push($fonts, $site_title_font_temp);

		/* Tagline Font */
		$tagline_font = get_theme_mod('tagline_font', 'Open Sans');
		$tagline_font_size = get_theme_mod('tagline_font_size', '14');
		$tagline_font = explode(':',$tagline_font);
		$tagline_font_family = isset($tagline_font[0]) ? $tagline_font[0] : 'Open Sans';
		$tagline_font_weight = isset($tagline_font[1]) ? $tagline_font[1] : '400';
		$tagline_font_style = isset($tagline_font[2]) ? $tagline_font[2] : 'normal';
		$tagline_font_temp['family'] = $tagline_font_family;
		if($tagline_font_style === 'italic')
			$tagline_font_weight .= $tagline_font_style;
		$tagline_font_temp['varient'] = $tagline_font_weight;
		array_push($fonts, $tagline_font_temp);

		/* Page Title Font */
		$page_title_font = get_theme_mod('page_title_font', 'Open Sans');
		$page_title_font_size = get_theme_mod('page_title_font_size', '20');
		$page_title_font = explode(':',$page_title_font);
		$page_title_font_family = isset($page_title_font[0]) ? $page_title_font[0] : 'Open Sans';
		$page_title_font_weight = isset($page_title_font[1]) ? $page_title_font[1] : '400';
		$page_title_font_style = isset($page_title_font[2]) ? $page_title_font[2] : 'normal';
		$page_title_font_temp['family'] = $page_title_font_family;
		if($page_title_font_style === 'italic')
			$page_title_font_weight .= $page_title_font_style;
		$page_title_font_temp['varient'] = $page_title_font_weight;
		array_push($fonts, $page_title_font_temp);

		/* Widget Title Font */
		$widget_title_font = get_theme_mod('widget_title_font', 'Open Sans');
		$widget_title_font_size = get_theme_mod('widget_title_font_size', '18');
		$widget_title_font = explode(':',$widget_title_font);
		$widget_title_font_family = isset($widget_title_font[0]) ? $widget_title_font[0] : 'Open Sans';
		$widget_title_font_weight = isset($widget_title_font[1]) ? $widget_title_font[1] : '400';
		$widget_title_font_style = isset($widget_title_font[2]) ? $widget_title_font[2] : 'normal';
		$widget_title_font_temp['family'] = $widget_title_font_family;
		if($widget_title_font_style === 'italic')
			$widget_title_font_weight .= $widget_title_font_style;
		$widget_title_font_temp['varient'] = $widget_title_font_weight;
		array_push($fonts, $widget_title_font_temp);

		/* Post Meta Font */
		$post_meta_font = get_theme_mod('post_meta_font', 'Open Sans');
		$post_meta_font_size = get_theme_mod('post_meta_font_size', '12');
		$post_meta_font = explode(':',$post_meta_font);
		$post_meta_font_family = isset($post_meta_font[0]) ? $post_meta_font[0] : 'Open Sans';
		$post_meta_font_weight = isset($post_meta_font[1]) ? $post_meta_font[1] : '400';
		$post_meta_font_style = isset($post_meta_font[2]) ? $post_meta_font[2] : 'normal';
		$post_meta_font_temp['family'] = $post_meta_font_family;
		if($post_meta_font_style === 'italic')
			$post_meta_font_weight .= $post_meta_font_style;
		$post_meta_font_temp['varient'] = $post_meta_font_weight;
		array_push($fonts, $post_meta_font_temp);


		/* Menu Font */
		$menu_font = get_theme_mod('menu_font', 'Open Sans');
		$menu_font_size = get_theme_mod('menu_font_size', '13');
		$menu_font = explode(':',$menu_font);
		$menu_font_family = isset($menu_font[0]) ? $menu_font[0] : 'Open Sans';
		$menu_font_weight = isset($menu_font[1]) ? $menu_font[1] : '400';
		$menu_font_style = isset($menu_font[2]) ? $menu_font[2] : 'normal';
		$menu_font_temp['family'] = $menu_font_family;
		if($menu_font_style === 'italic')
			$menu_font_weight .= $menu_font_style;
		$menu_font_temp['varient'] = $menu_font_weight;
		array_push($fonts, $menu_font_temp);

		/* Sub Menu Font */
		$submenu_font = get_theme_mod('submenu_font', 'Open Sans');
		$submenu_font_size = get_theme_mod('submenu_font_size', '12');
		$submenu_font = explode(':',$submenu_font);
		$submenu_font_family = isset($submenu_font[0]) ? $submenu_font[0] : 'Open Sans';
		$submenu_font_weight = isset($submenu_font[1]) ? $submenu_font[1] : '400';
		$submenu_font_style = isset($submenu_font[2]) ? $submenu_font[2] : 'normal';
		$submenu_font_temp['family'] = $submenu_font_family;
		if($submenu_font_style === 'italic')
			$submenu_font_weight .= $submenu_font_style;
		$submenu_font_temp['varient'] = $submenu_font_weight;
		array_push($fonts, $submenu_font_temp);

		/* Breadcrumbs Font */
		$breadcrumb_font = get_theme_mod('breadcrumb_font', 'Open Sans');
		$breadcrumb_font_size = get_theme_mod('breadcrumb_font_size', '13');
		$breadcrumb_font = explode(':',$breadcrumb_font);
		$breadcrumb_font_family = isset($breadcrumb_font[0]) ? $breadcrumb_font[0] : 'Open Sans';
		$breadcrumb_font_weight = isset($breadcrumb_font[1]) ? $breadcrumb_font[1] : '400';
		$breadcrumb_font_style = isset($breadcrumb_font[2]) ? $breadcrumb_font[2] : 'normal';
		$breadcrumb_font_temp['family'] = $breadcrumb_font_family;
		if($breadcrumb_font_style === 'italic')
			$breadcrumb_font_weight .= $breadcrumb_font_style;
		$breadcrumb_font_temp['varient'] = $breadcrumb_font_weight;
		array_push($fonts, $breadcrumb_font_temp);

		/* Page Heading Font */
		$page_heading_font = get_theme_mod('page_heading_font', 'Open Sans');
		$page_heading_font_size = get_theme_mod('page_heading_font_size', '17');
		$page_heading_font = explode(':',$page_heading_font);
		$page_heading_font_family = isset($page_heading_font[0]) ? $page_heading_font[0] : 'Open Sans';
		$page_heading_font_weight = isset($page_heading_font[1]) ? $page_heading_font[1] : '400';
		$page_heading_font_style = isset($page_heading_font[2]) ? $page_heading_font[2] : 'normal';
		$page_heading_font_temp['family'] = $page_heading_font_family;
		if($page_heading_font_style === 'italic')
			$page_heading_font_weight .= $page_heading_font_style;
		$page_heading_font_temp['varient'] = $page_heading_font_weight;
		array_push($fonts, $page_heading_font_temp);

		/* Generate google font query */
		$font_family_array = array();
		foreach($fonts as $key => $font)
		{
			array_push($font_family_array, $font['family']);
		}

		$font_family_array = array_unique($font_family_array);

		$font_main = array();

		foreach($font_family_array as $font_family)
		{
			$temp_font = $temp = array();
			foreach($fonts as $font)
			{
				if($font['family'] == $font_family)
				{
					array_push($temp, $font['varient']);
				}
			}
			$temp = array_unique($temp);
			$temp_font['family'] = $font_family;
			$temp_font['call'] = $temp;
			array_push($font_main, $temp_font);
		}

		$font_str = '';
		foreach($font_main as $key => $fonts){
			if($key)
			$font_str .= '|';
			$font_str .= urlencode($fonts['family']).':';
			$font_str .= implode(",",$fonts['call']);
		}

		?>
		<link href='//fonts.googleapis.com/css?family=<?php echo $font_str; ?>' rel='stylesheet' type='text/css'>
		<style type="text/css">
		h1.site-title, h1.site-title a {
			font-family:<?php echo $site_title_font_family;?>;
			font-weight:<?php echo $site_title_font_weight;?>;
			font-style:<?php echo $site_title_font_style;?>;
			font-size:<?php echo $site_title_font_size;?>px;
		}
		h2.site-description, h2.site-description * {
			font-family:<?php echo $tagline_font_family;?>;
			font-weight:<?php echo $tagline_font_weight;?>;
			font-style:<?php echo $tagline_font_style;?>;
			font-size:<?php echo $tagline_font_size;?>px;
		}
		h1.entry-title, h1.entry-title a{
			font-family:<?php echo $page_title_font_family;?>;
			font-weight:<?php echo $page_title_font_weight;?>;
			font-style:<?php echo $page_title_font_style;?>;
			font-size:<?php echo $page_title_font_size;?>px;
		}
		.widget h3, .widget h3 span{
			font-family:<?php echo $widget_title_font_family;?>;
			font-weight:<?php echo $widget_title_font_weight;?>;
			font-style:<?php echo $widget_title_font_style;?>;
			font-size:<?php echo $widget_title_font_size;?>px;
		}
		.entry-summary .post-meta, .entry-summary .post-meta a, .entry-summary .post-meta span, .entry-summary-meta .post-meta, .entry-summary-meta .post-meta a, .entry-summary-meta .post-meta span {
			font-family:<?php echo $post_meta_font_family;?>;
			font-weight:<?php echo $post_meta_font_weight;?>;
			font-style:<?php echo $post_meta_font_style;?>;
			font-size:<?php echo $post_meta_font_size;?>px;
		}
		ul.nav-menu li a, .nav-menu li a {
			font-family:<?php echo $menu_font_family;?>;
			font-weight:<?php echo $menu_font_weight;?>;
			font-style:<?php echo $menu_font_style;?>;
			font-size:<?php echo $menu_font_size;?>px;
		}
		ul.children li a, ul.sub-menu li a {
			font-family:<?php echo $submenu_font_family;?>;
			font-weight:<?php echo $submenu_font_weight;?>;
			font-style:<?php echo $submenu_font_style;?>;
			font-size:<?php echo $submenu_font_size;?>px;
		}
		.king-page-header {
			font-size:<?php echo $page_heading_font_size;?>px;
		}
		.king-page-header .king-breadcrumb *{
			font-family:<?php echo $breadcrumb_font_family;?>;
			font-weight:<?php echo $breadcrumb_font_weight;?>;
			font-style:<?php echo $breadcrumb_font_style;?>;
			font-size:<?php echo $breadcrumb_font_size;?>px !important;
		}
		.king-page-header .king-breadcrumb-title *{
			font-family:<?php echo $page_heading_font_family;?>;
			font-weight:<?php echo $page_heading_font_weight;?>;
			font-style:<?php echo $page_heading_font_style;?>;
			font-size:<?php echo $page_heading_font_size;?>px !important;
		}

		body{
			background:<?php echo get_theme_mod( 'site-bg-color', '#ffffff' );?>;
		}
		body {
			font-family:<?php echo $default_font_family;?>;
			font-weight:<?php echo $default_font_weight;?>;
			font-style:<?php echo $default_font_style;?>;
		}

		/**
		* 1.0 Layout Settings
		*
		* Applying website content width, which sets from customizer
		*/
		<?php if(get_theme_mod('site_layout') !== 'fluid') {?>
			body #main, 
			.boxed .site, 
			.header-box, 
			.header-style2 .primary-menu-container, 
			.header-style2 .nav-menu, 
			.header-style3 .primary-menu-container, 
			.header-style3 .nav-menu, 
			.king-container, 
			.footer-widget-area, 
			.footer-bottom-container, 
			.smile-row, 
			.boxed.king-fixed-menu .site-header {
				max-width: <?php echo get_theme_mod( 'site_width', '1170' );?>px !important;
			}
		<?php } ?>

		<?php if ( get_theme_mod('sidebar_position') != 'no-sidebar') : ?>
			@media only screen and (min-width: 768px) {
				#primary {
					width: <?php echo get_theme_mod( 'content_width', '75' );?>%;
				}
				#secondary {
					width: <?php echo ( 100 - get_theme_mod( 'content_width', '75' ));?>%;
				}
			}
		<?php endif; ?>

		/**
		* 2.0 Header Settings
		*
		* Applying header hight, which sets from customizer
		*/
		@media only screen and (min-width: 768px) {
			.site-header, 
			.header-style2 .header-search,
			.header-style3 .header-box {
				min-height: <?php echo get_theme_mod( 'logo_height', '90' );?>px;
			}
			.site-header, 
			.king-main-menu-container div.nav-menu, 
			.king-main-menu-container .primary-menu-container, 
			.header-logo *,
			.site-header h1, 
			.site-header h2 {
				line-height: <?php echo get_theme_mod( 'logo_height', '90' );?>px;
			}
		}

		/**
		* 3.0 Header Colors
		*
		* Applying header colors, which sets from customizer
		*/

		/**
		* 3.1 Theme Color
		*/
		a,
		a:visited,
		.widget-area .widget a, 
		.tagcloud a, 
		.widget-area .widget a:visited,
		.menu-toggle:hover, 
		.menu-toggle:focus, 
		button:hover, 
		input[type="submit"]:hover, 
		input[type="button"]:hover, 
		input[type="reset"]:hover, 
		article.post-password-required input[type=submit]:hover, 
		.comments-link a, 
		.entry-meta a, 
		.site-header h1 a:hover, 
		.site-header h2 a:hover,
		.post-meta a:hover,
		.slick-prev:before, 
		.slick-next:before {
			color:<?php echo get_theme_mod('site-color', '#de5034'); ?>;
		}
		button#searchsubmit, 
		.menu-toggle, 
		button, 
		input[type="submit"], 
		input[type="button"], 
		input[type="reset"],
		.menu-toggle:hover, 
		.menu-toggle:focus, 
		button:hover, 
		input[type="submit"]:hover, 
		input[type="button"]:hover, 
		input[type="reset"]:hover, 
		article.post-password-required input[type=submit]:hover, 
		.menu-toggle, 
		input[type="submit"], 
		input[type="button"], 
		input[type="reset"], 
		article.post-password-required input[type=submit], 
		.bypostauthor cite span,
		.king-scroll-top {
			border-color:<?php echo get_theme_mod('site-color', '#de5034'); ?>;
		}
		button#searchsubmit, 
		.menu-toggle, 
		button, 
		input[type="submit"], 
		input[type="button"], 
		input[type="reset"], 
		.menu-toggle, 
		input[type="submit"], 
		input[type="button"], 
		input[type="reset"], 
		article.post-password-required input[type=submit], 
		.bypostauthor cite span, 
		.king-pagination a, 
		.king-pagination .current,
		.king-scroll-top,
		.widget_tag_cloud .tagcloud a:hover,
		.main-footer .widget_tag_cloud .tagcloud a:hover,
		.king-bubblingG span {
			background:<?php echo get_theme_mod('site-color', '#de5034'); ?>;
		}
		.format-aside .aside {
			border-left-color: <?php echo get_theme_mod('site-color', '#de5034'); ?>;
		}
		.king-blog-overlay .blog-featured-media a:hover:after {	
			background: <?php echo hex2rgba( get_theme_mod('site-color', '#de5034'), 0.35); ?>
		}
		@media only screen and (min-width: 768px) {
			.main-navigation .nav-menu .sub-menu, 
			.main-navigation .nav-menu .children {
				border-top-color: <?php echo get_theme_mod('site-color', '#de5034'); ?>;
			}
			.main-navigation .nav-menu .sub-menu li a:hover, 
			.main-navigation .nav-menu .children li a:hover {
				background: <?php echo get_theme_mod('site-color', '#de5034'); ?>;
			}
		}

		/**
		* 3.2 Theme Text Color
		*/
		body,
		p {
			color: <?php echo get_theme_mod('site-text-color', '#707070'); ?>;
		}

		/**
		* 3.2 Page / Post Title Color
		*/
		h1.entry-title {
			color: <?php echo get_theme_mod('page-title-color', '#333333'); ?>;	
		}

		/**
		* 3.2 Post Meta Color
		*/
		.post-meta,
		.post-meta a,
		.entry-summary p.post-meta {
			color: <?php echo get_theme_mod('post-meta-color', '#909090'); ?>;
		}

		/**
		* 3.2 Post Meta Hover Color
		*/
		.post-meta a:hover {
			color: <?php echo get_theme_mod('post-meta-hover-color', '#de5034'); ?>;
		}

		/**
		* 3.2 Sidebar Widget Title Color
		*/
		.widget h3.widget-title {
			color: <?php echo get_theme_mod('sidebar-widget-title-color', '#333333'); ?>;
		}


		/**
		* 3.2 Header Background Color
		*/
		.header-box,
		.site-header, 
		.king-transparent-header .site-header.king-sticky-menu,
		.site-header.header-style2,
		.site-header.header-style3 {
			background: <?php echo get_theme_mod( 'header-bg-color', '#333333' );?>;
		}

		.king-fixed-menu.king-transparent-header .king-sticky-menu {
			background: <?php echo get_theme_mod( 'header-bg-color', '#333333' );?> !important;
		}

		/**
		* 3.3 Parent Menu Color
		*/
		.main-navigation .nav-menu > li > a,
		.main-navigation .nav-menu > ul > li > a {
			color: <?php echo get_theme_mod('parent-menu-color', '#dddddd'); ?>;
		}

		/**
		* 3.4 Parent Menu Hover Color
		*/
		.main-navigation .nav-menu > li > a:hover,
		.main-navigation .nav-menu > ul > li > a:hover {
			color: <?php echo get_theme_mod('parent-menu-hover-color', '#f7f7f7'); ?>;
		}

		/**
		* 3.5 Parent Menu BG Color
		*/
		.header-style2 .main-navigation,
		.header-style3 .main-navigation {
			background: <?php echo get_theme_mod( 'parent-menu-bg-color', '#707070' );?>;
		}

		@media only screen and (min-width: 768px) {

			/**
			* 3.6 Child Menu Link Color
			*/
			.main-navigation .nav-menu .sub-menu li a, 
			.main-navigation .nav-menu .children li a {
				color: <?php echo get_theme_mod('child-menu-link-color', '#eaeaea'); ?>;
			}

			/**
			* 3.7 Child Menu Hover Color
			*/
			.main-navigation .nav-menu .sub-menu li a:hover, 
			.main-navigation .nav-menu .children li a:hover {
				color: <?php echo get_theme_mod('child-menu-hover-color', '#ffffff'); ?>;
			}

			/**
			* 3.8 Child Menu Background Color
			*/
			.main-navigation .nav-menu .sub-menu, 
			.main-navigation .nav-menu .children {
				background: <?php echo get_theme_mod('child-menu-bg-color', '#1d1d1d'); ?>;
			}

			/**
			* 3.9 Child Menu Hover Background Color
			*/
			.main-navigation .nav-menu .sub-menu li a:hover, 
			.main-navigation .nav-menu .children li a:hover {
				background: <?php echo get_theme_mod('child-menu-hover-bg-color', '#de5034'); ?>;
			}
			.main-navigation .nav-menu .sub-menu, 
			.main-navigation .nav-menu .children {
				border-top-color: <?php echo get_theme_mod('child-menu-hover-bg-color', '#de5034'); ?>;
			}
		}

		/**
		* 3.10 Header Text Color
		*/
		h1.site-title, 
		h1.site-title a, 
		h2.site-description, 
		h2.site-description *,
		.site-header .blog-description {
			color: <?php echo get_theme_mod('header_textcolor', '#f2f2f2'); ?>;
		}

		/**
		* 3.11 Header Link Hover Color
		*/
		h1.site-title a:hover,
		h1.site-title a:focus{
			color: <?php echo get_theme_mod('header-hover-color', '#de5034'); ?> !important;
		}


		/**
		* 4.0 Footer Colors
		*
		* Applying footer colors, which sets from customizer
		*/

		/**
		* 4.1 Footer Widget Title Color
		*/
		#footer h3.widget-title {
			color:<?php echo get_theme_mod('footer-widget-title-color', '#de5034'); ?>;
		}

		/**
		* 4.2 Footer Text Color
		*/
		.main-footer *{
			color: <?php echo get_theme_mod('footer-color', '#707070'); ?>;
		}


		/**
		* 4.3 Footer Link Color
		*/
		.main-footer a {
			color: <?php echo get_theme_mod('footer-link-color', '#333333'); ?>;
		}


		/**
		* 4.4 Footer Link Hover Color
		*/
		.main-footer a:hover {
			color: <?php echo get_theme_mod('footer-link-hover-color', '#de5034'); ?>;
		}


		/**
		* 4.5 Main Footer Background Color
		*/
		.main-footer{
			background: <?php echo get_theme_mod('footer-bg-color', '#f1f1f1'); ?>;
		}

		/**
		* 4.6 Small Footer Background Color
		*/
		footer[role="contentinfo"]{
			background: <?php echo get_theme_mod('small-footer-bg-color', '#333333'); ?>;
			border-top-color: <?php echo get_theme_mod('small-footer-bg-color', '#333333'); ?>;
		}

		/**
		* 4.7 Small Footer Text / Link Color
		*/
		footer[role="contentinfo"] *, 
		footer[role="contentinfo"] a{
			color: <?php echo get_theme_mod('small-footer-text-color', '#dddddd'); ?>;
		}

		/**
		* 4.8 Small Footer Link Hover Color
		*/
		footer[role="contentinfo"] a:hover {
			color: <?php echo get_theme_mod('small-footer-link-hover-color', '#de5034'); ?>;
		}

		/**
		* 5.0 King Infinite Loader
		*/
		@-moz-keyframes bubblingG {
			0% {
				width: 8px;
				height: 8px;
				background-color: <?php echo get_theme_mod('site-color', '#de5034'); ?>;
				-moz-transform: translateY(0);
			}
			100% {
				width: 18px;
				height: 18px;
				background-color:white;
				-moz-transform: translateY(-16px);
			}
		}

		@-webkit-keyframes bubblingG {
			0% {
				width: 8px;
				height: 8px;
				background-color: <?php echo get_theme_mod('site-color', '#de5034'); ?>;
				-webkit-transform: translateY(0);
			}
			100% {
				width: 18px;
				height: 18px;
				background-color:white;
				-webkit-transform: translateY(-16px);
			}
		}

		@-ms-keyframes bubblingG {
			0% {
				width: 8px;
				height: 8px;
				background-color: <?php echo get_theme_mod('site-color', '#de5034'); ?>;
				-ms-transform: translateY(0);
			}
			100% {
				width: 18px;
				height: 18px;
				background-color:white;
				-ms-transform: translateY(-16px);
			}
		}

		@-o-keyframes bubblingG {
			0% {
				width: 8px;
				height: 8px;
				background-color: <?php echo get_theme_mod('site-color', '#de5034'); ?>;
				-o-transform: translateY(0);
			}
			100% {
				width: 18px;
				height: 18px;
				background-color:white;
				-o-transform: translateY(-16px);
			}
		}

		@keyframes bubblingG {
			0% {
				width: 8px;
				height: 8px;
				background-color: <?php echo get_theme_mod('site-color', '#de5034'); ?>;
				transform: translateY(0);
			}
			100% {
				width: 18px;
				height: 18px;
				background-color:white;
				transform: translateY(-16px);
			}
		} 

		</style>

		<?php
	}
endif;