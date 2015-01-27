<?php
$fonts = array();
/* Global Default Font */
$default_font_temp = $page_title_font_temp = array();
$default_font = get_theme_mod('default_site_font');
$default_font = explode(':',$default_font);
$default_font_family = isset($default_font[0]) ? $default_font[0] : 'Open Sans';
$default_font_weight = isset($default_font[1]) ? $default_font[1] : '400';
$default_font_style = isset($default_font[2]) ? $default_font[2] : 'normal';
$default_font_temp['family'] = $default_font_family;
if($default_font_style === 'italic')
	$default_font_weight .= $default_font_style;
$default_font_temp['varient'] = $default_font_weight;
array_push($fonts, $default_font_temp);

/* Page Title Font */
$page_title_font = get_theme_mod('page_title_font');
$page_title_font_size = get_theme_mod('page_title_font_size');
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
$widget_title_font = get_theme_mod('widget_title_font');
$widget_title_font_size = get_theme_mod('widget_title_font_size');
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
$post_meta_font = get_theme_mod('post_meta_font');
$post_meta_font_size = get_theme_mod('post_meta_font_size');
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
$menu_font = get_theme_mod('menu_font');
$menu_font_size = get_theme_mod('menu_font_size');
$menu_font = explode(':',$menu_font);
$menu_font_family = isset($menu_font[0]) ? $menu_font[0] : 'Open Sans';
$menu_font_weight = isset($menu_font[1]) ? $menu_font[1] : '400';
$menu_font_style = isset($menu_font[2]) ? $menu_font[2] : 'normal';
$menu_font_temp['family'] = $menu_font_family;
if($menu_font_style === 'italic')
	$menu_font_weight .= $menu_font_style;
$menu_font_temp['varient'] = $menu_font_weight;
array_push($fonts, $menu_font_temp);

/* Breadcrumbs Font */
$breadcrumb_font = get_theme_mod('breadcrumb_font');
$breadcrumb_font_size = get_theme_mod('breadcrumb_font_size');
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
$page_heading_font = get_theme_mod('page_heading_font');
$page_heading_font_size = get_theme_mod('page_heading_font_size');
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
<link href='http://fonts.googleapis.com/css?family=<?php echo $font_str; ?>' rel='stylesheet' type='text/css'>
<style type="text/css">
h1.entry-title, h1.entry-title a{
	font-family:<?php echo $page_title_font_family;?>;
	font-weight:<?php echo $page_title_font_weight;?>;
	font-style:<?php echo $page_title_font_style;?>;
	font-size:<?php echo $page_title_font_size;?>px !important;
}
.widget h3, .widget h3 span{
	font-family:<?php echo $widget_title_font_family;?>;
	font-weight:<?php echo $widget_title_font_weight;?>;
	font-style:<?php echo $widget_title_font_style;?>;
	font-size:<?php echo $widget_title_font_size;?>px !important;
}
.entry-summary .post-meta, .entry-summary .post-meta a, .entry-summary .post-meta span, .entry-summary-meta .post-meta, .entry-summary-meta .post-meta a, .entry-summary-meta .post-meta span {
	font-family:<?php echo $post_meta_font_family;?>;
	font-weight:<?php echo $post_meta_font_weight;?>;
	font-style:<?php echo $post_meta_font_style;?>;
	font-size:<?php echo $post_meta_font_size;?>px !important;
}
ul.nav-menu li a, .main-navigation li ul li a {
	font-family:<?php echo $menu_font_family;?>;
	font-weight:<?php echo $menu_font_weight;?>;
	font-style:<?php echo $menu_font_style;?>;
	font-size:<?php echo $menu_font_size;?>px !important;
}
.ultimate-page-header {
	font-size:<?php echo $page_heading_font_size;?>px !important;
}
.ultimate-page-header .ultimate-breadcrumb *{
	font-family:<?php echo $breadcrumb_font_family;?>;
	font-weight:<?php echo $breadcrumb_font_weight;?>;
	font-style:<?php echo $breadcrumb_font_style;?>;
	font-size:<?php echo $breadcrumb_font_size;?>px !important;
}
.ultimate-page-header .ultimate-breadcrumb-title *{
	font-family:<?php echo $page_heading_font_family;?>;
	font-weight:<?php echo $page_heading_font_weight;?>;
	font-style:<?php echo $page_heading_font_style;?>;
	font-size:<?php echo $page_heading_font_size;?>px !important;
}

body{
	background:<?php echo get_theme_mod( 'site-bg-color' );?>;
}
body *{
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
	body .site.boxed, 
	.header-box, 
	.header-style2 .primary-menu-container, 
	.header-style2 .nav-menu, 
	.header-style3 .primary-menu-container, 
	.header-style3 .nav-menu, 
	.ultimate-container, 
	.footer-widget-area, 
	.footer-bottom-container, 
	.smile-row, 
	.boxed .site-header.ult-fixed-menu {
		max-width: <?php echo get_theme_mod( 'content_width' );?>px !important;
	}
<?php } ?>

/**
* 2.0 Header Settings
*
* Applying header hight, which sets from customizer
*/
@media only screen and (min-width: 768px) {
	.site-header, 
	.header-style2 .header-search,
	.header-style3 .header-box {
		min-height: <?php echo get_theme_mod( 'logo_height' );?>px;
	}
	.site-header, 
	.ult-main-menu-container div.nav-menu, 
	.ult-main-menu-container .primary-menu-container, 
	.header-logo *,
	.site-header h1, 
	.site-header h2 {
		line-height: <?php echo get_theme_mod( 'logo_height' );?>px;
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
.post-meta a:hover {
	color:<?php echo get_theme_mod('site-color'); ?>;
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
.ult-scroll-top {
	border-color:<?php echo get_theme_mod('site-color'); ?>;
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
.ultimate-pagination a, 
.ultimate-pagination .current,
.ult-scroll-top,
.widget_tag_cloud .tagcloud a:hover,
.main-footer .widget_tag_cloud .tagcloud a:hover {
	background:<?php echo get_theme_mod('site-color'); ?>;
}
.format-aside .aside {
	border-left-color: <?php echo get_theme_mod('site-color'); ?>;
}
@media only screen and (min-width: 768px) {
	.main-navigation .nav-menu .sub-menu, 
	.main-navigation .nav-menu .children {
		border-top-color: <?php echo get_theme_mod('site-color'); ?>;
	}
	.main-navigation .nav-menu .sub-menu li a:hover, 
	.main-navigation .nav-menu .children li a:hover {
		background: <?php echo get_theme_mod('site-color'); ?>;
	}
}

/**
* 3.2 Theme Text Color
*/
body,
.entry-content p, 
.entry-summary p, 
.comment-content p, 
.mu_register p {
	color: <?php echo get_theme_mod('site-text-color'); ?>;
}

/**
* 3.2 Page / Post Title Color
*/
h1.entry-title {
	color: <?php echo get_theme_mod('page-title-color'); ?>;	
}

/**
* 3.2 Post Meta Color
*/
.post-meta,
.post-meta a,
.entry-summary p.post-meta {
	color: <?php echo get_theme_mod('post-meta-color'); ?>;
}

/**
* 3.2 Post Meta Hover Color
*/
.post-meta a:hover {
	color: <?php echo get_theme_mod('post-meta-hover-color'); ?>;
}

/**
* 3.2 Sidebar Widget Title Color
*/
.widget h3.widget-title {
	color: <?php echo get_theme_mod('sidebar-widget-title-color'); ?>;
}


/**
* 3.2 Header Background Color
*/
.header-box,
.site-header, 
.ult-transparent-header .site-header.ult-sticky-menu,
.site-header.header-style2,
.site-header.header-style3 {
	background: <?php echo get_theme_mod( 'header-bg-color' );?>;
}

/**
* 3.3 Parent Menu Color
*/
.main-navigation .nav-menu > li > a,
.main-navigation .nav-menu > ul > li > a {
	color: <?php echo get_theme_mod('parent-menu-color'); ?>;
}

/**
* 3.4 Parent Menu Hover Color
*/
.main-navigation .nav-menu > li > a:hover,
.main-navigation .nav-menu > ul > li > a:hover {
	color: <?php echo get_theme_mod('parent-menu-hover-color'); ?>;
}

/**
* 3.5 Parent Menu BG Color
*/
.header-style2 .main-navigation,
.header-style3 .main-navigation {
	background: <?php echo get_theme_mod( 'parent-menu-bg-color' );?>;
}

@media only screen and (min-width: 768px) {

	/**
	* 3.6 Child Menu Link Color
	*/
	.main-navigation .nav-menu .sub-menu li a, 
	.main-navigation .nav-menu .children li a {
		color: <?php echo get_theme_mod('child-menu-link-color'); ?>;
	}

	/**
	* 3.7 Child Menu Hover Color
	*/
	.main-navigation .nav-menu .sub-menu li a:hover, 
	.main-navigation .nav-menu .children li a:hover {
		color: <?php echo get_theme_mod('child-menu-hover-color'); ?>;
	}

	/**
	* 3.8 Child Menu Background Color
	*/
	.main-navigation .nav-menu .sub-menu, 
	.main-navigation .nav-menu .children {
		background: <?php echo get_theme_mod('child-menu-bg-color'); ?>;
	}

	/**
	* 3.9 Child Menu Hover Background Color
	*/
	.main-navigation .nav-menu .sub-menu li a:hover, 
	.main-navigation .nav-menu .children li a:hover {
		background: <?php echo get_theme_mod('child-menu-hover-bg-color'); ?>;
	}
	.main-navigation .nav-menu .sub-menu, 
	.main-navigation .nav-menu .children {
		border-top-color: <?php echo get_theme_mod('child-menu-hover-bg-color'); ?>;
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
	color: #<?php echo get_theme_mod('header_textcolor'); ?>;
}

/**
* 3.11 Header Link Hover Color
*/
h1.site-title a:hover,
h1.site-title a:focus{
	color: <?php echo get_theme_mod('header-hover-color'); ?> !important;
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
	color:<?php echo get_theme_mod('footer-widget-title-color'); ?>;
}

/**
* 4.2 Footer Text Color
*/
.main-footer *{
	color: <?php echo get_theme_mod('footer-color'); ?>;
}


/**
* 4.3 Footer Link Color
*/
.main-footer a {
	color: <?php echo get_theme_mod('footer-link-color'); ?>;
}


/**
* 4.4 Footer Link Hover Color
*/
.main-footer a:hover {
	color: <?php echo get_theme_mod('footer-link-hover-color'); ?>;
}


/**
* 4.5 Main Footer Background Color
*/
.main-footer{
	background: <?php echo get_theme_mod('footer-bg-color'); ?>;
}

/**
* 4.6 Small Footer Background Color
*/
footer[role="contentinfo"]{
	background: <?php echo get_theme_mod('small-footer-bg-color'); ?>;
	border-top-color: <?php echo get_theme_mod('small-footer-bg-color'); ?>;
}

/**
* 4.7 Small Footer Text / Link Color
*/
footer[role="contentinfo"] *, 
footer[role="contentinfo"] a{
	color: <?php echo get_theme_mod('small-footer-text-color'); ?>;
}

/**
* 4.8 Small Footer Link Hover Color
*/
footer[role="contentinfo"] a:hover {
	color: <?php echo get_theme_mod('small-footer-link-hover-color'); ?>;
}

</style>