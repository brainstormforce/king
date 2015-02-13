<?php
/**
 * Register postMessage support.
 *
 * Add postMessage support for site title and description for the Customizer.
 *
 * @package WordPress
 * @subpackage Ultimate
 * @since Ultimate 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function ultimate_customize_register( $wp_customize ) {
	
	get_template_part('lib/custom','google_fonts');
	get_template_part('lib/customizer','typography');


	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->remove_control('background_color');
	$wp_customize->remove_control('display_header_text');
	
	$wp_customize->remove_section('header_image');
	$wp_customize->remove_section('title_tagline');
	$wp_customize->remove_section('colors');

	//==========================
	// Sections
	//==========================
	$wp_customize->add_section(
        'layout_setting',
        array(
            'title' => 'Layout Setting',
            'description' => 'Select the site layout and set the default width.',
            'priority' => 1,
        )
    );

    $wp_customize->add_panel( 'blog_panel', array(
	    'priority' => 2,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Blog Settings', 'ultimate' ),
	    'description' => __( 'Customize your blog layout.', 'ultimate' ),
	) );
	$wp_customize->add_section( 'blog_layout_section', array(
	    'priority' => 1,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Layout', 'ultimate' ),
	    'description' => '',
	    'panel' => 'blog_panel',
	) );
	$wp_customize->add_section( 'blog_meta_section', array(
	    'priority' => 2,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Select Post Meta', 'ultimate' ),
	    'description' => '',
	    'panel' => 'blog_panel',
	) );

	$wp_customize->add_section(
        'title_tagline',
        array(
            'title' => 'Header Settings',
            'description' => 'Customize logo and menu.',
            'priority' => 3,
        )
    );
    $wp_customize->add_section(
        'footer_settings',
        array(
            'title' => 'Footer Settings',
            'description' => 'Customize footer credit text.',
            'priority' => 4,
        )
    );
    
    $wp_customize->add_panel( 'colors_panel', array(
	    'priority' => 5,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Color Settings', 'ultimate' ),
	    'description' => __( 'Customize theme color options.', 'ultimate' ),
	) );
	$wp_customize->add_section( 'colors', array(
	    'priority' => 1,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme', 'ultimate' ),
	    'description' => '',
	    'panel' => 'colors_panel',
	) );
	$wp_customize->add_section( 'header_colors', array(
	    'priority' => 2,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Header', 'ultimate' ),
	    'description' => '',
	    'panel' => 'colors_panel',
	) );
	$wp_customize->add_section( 'menu_colors', array(
	    'priority' => 3,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Menu', 'ultimate' ),
	    'description' => '',
	    'panel' => 'colors_panel',
	) );
	$wp_customize->add_section( 'footer_colors', array(
	    'priority' => 4,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Footer', 'ultimate' ),
	    'description' => '',
	    'panel' => 'colors_panel',
	) );

	$wp_customize->add_panel( 'typography_panel', array(
	    'priority' => 6,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Typography Settings', 'ultimate' ),
	    'description' => __( 'Description of what this panel does.', 'ultimate' ),
	) );
	$wp_customize->add_section( 'default_font', array(
	    'priority' => 1,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Default', 'ultimate' ),
	    'description' => '',
	    'panel' => 'typography_panel',
	) );
	$wp_customize->add_section( 'entry_title_font', array(
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Main Content', 'ultimate' ),
	    'description' => '',
	    'panel' => 'typography_panel',
		'priority' => 2,
	) );
	$wp_customize->add_section( 'widget_title_font', array(
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Widgets', 'ultimate' ),
	    'description' => '',
	    'panel' => 'typography_panel',
		'priority' => 3,
	) );
	$wp_customize->add_section( 'menu_font', array(
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Menu', 'ultimate' ),
	    'description' => '',
	    'panel' => 'typography_panel',
		'priority' => 4,
	) );
	$wp_customize->add_section( 'breadcrumb_font', array(
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Breadcrumbs', 'ultimate' ),
	    'description' => '',
	    'panel' => 'typography_panel',
		'priority' => 5,
	) );

	$wp_customize->add_panel( 'advanced_panel', array(
	    'priority' => 7,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Advanced Settings', 'ultimate' ),
	    'description' => __( 'Description of what this panel does.', 'ultimate' ),
	) );
	$wp_customize->add_section( 'general_advanced', array(
	    'priority' => 1,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'General Settings', 'ultimate' ),
	    'description' => '',
	    'panel' => 'advanced_panel',
	) );

	$wp_customize->add_section(
        'reset_default',
        array(
            'title' => 'Reset To Default',
            'description' => 'Type "reset" in text field to confirm the reset and then click the "Save & Publish" button. You need to refresh this page manually after this.',
            'priority' => 999,
        )
    );
	
	//==========================
	// Layout Settings
	//==========================
	$wp_customize->add_setting(
		'site_layout',
		array(
			'default' => 'full-width',
			'sanitize_callback' => 'ultimate_sanitize_callback'
		)
	);	 
	$wp_customize->add_control(
		'site_layout',
		array(
			'type' => 'select',
			'label' => 'Site Layout',
			'section' => 'layout_setting',
			'choices' => array(
				'full-width' => 'Full Width',
				'fluid' => 'Fluid Layout',
				'boxed' => 'Boxed Width',
			),
		)
	);
	
	$wp_customize->add_setting(
    	'content_width',
		array(
			'default' => 1170,
			'sanitize_callback' => 'ultimate_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'content_width',
		array(
			'label' => 'Site Content Width',
			'section' => 'layout_setting',
			'description' =>  'This setting will not be applied to <strong>Fluid Layout</strong>.',
			'type' => 'number',
			'input_attrs' => array(
				'min'   => 420,
				'max'   => 1900,
				'step'  => 10,
				'style' => 'width: 80px;',
			),
		)
	);
	
	$wp_customize->add_setting( 'separator-blog', array(
		'default' => '',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'ultimate_sanitize_callback',
	) );
	$wp_customize->add_control(
		new Ultimate_Separator_Control(
			$wp_customize,
			'separator-blog',
			array(
				'label' => '',
				'section' => 'layout_setting',
				'settings' => 'separator-blog',
			)
		)
	);

	//==========================
	// Blog Settings
	//==========================
	
	// Layout
	$wp_customize->add_setting(
		'blog_layout',
		array(
			'default' => 'normal',
			'sanitize_callback' => 'ultimate_sanitize_callback'
		)
	);	 
	$wp_customize->add_control(
		'blog_layout',
		array(
			'type' => 'select',
			'label' => 'Blog Layout',
			'section' => 'blog_layout_section',
			'choices' => array(
				'normal' => 'Normal - Large Image Layout',
				'medium-image' => 'Medium Image Layout',
				'grid-2' => 'Grid - 2 Column Layout',
				'grid-3' => 'Grid - 3 Column Layout W/O Sidebar',
				'grid-4' => 'Grid - 4 Column Layout W/O Sidebar',
			),
		)
	);

	$wp_customize->add_setting( 
		'separator-5', 
		array(
			'default' => '',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => '',
			'sanitize_callback' => 'ultimate_sanitize_callback',
		) 
	);
	$wp_customize->add_control(
		new Ultimate_Separator_Control(
			$wp_customize,
			'separator-5',
			array(
				'label' => '',
				'section' => 'blog_layout_section',
				'settings' => 'separator-5',
			)
		)
	);

	$wp_customize->add_setting(
    	'blog_masonry_layout',
		array(
			'default' => true,
			'sanitize_callback' => 'ultimate_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'blog_masonry_layout',
		array(
			'label' => 'Enable Masonry',
			'section' => 'blog_layout_section',
			'description' =>  'This setting will be applied to <strong>Only Grid Layouts</strong>.',
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting(
    	'blog_pagination',
		array(
			'default' => true,
			'sanitize_callback' => 'ultimate_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'blog_pagination',
		array(
			'label' => 'Enable Number Pagination',
			'section' => 'blog_layout_section',
			'description' =>  '',
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting(
    	'post_excerpt_length',
		array(
			'default' => 25,
			'sanitize_callback' => 'ultimate_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'post_excerpt_length',
		array(
			'label' => 'Custom Excerpt Length (Words)',
			'section' => 'blog_layout_section',
			'description' =>  '',
			'type'        => 'number',
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 72,
				'step'  => 1,
				'style' => 'width: 80px;',
			),
		)
	);

	// Post Meta
	$wp_customize->add_setting(
    	'blog_author_meta',
		array(
			'default' => true,
			'sanitize_callback' => 'ultimate_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'blog_author_meta',
		array(
			'label' => 'Author',
			'section' => 'blog_meta_section',
			'description' =>  '',
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting(
    	'blog_category_meta',
		array(
			'default' => true,
			'sanitize_callback' => 'ultimate_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'blog_category_meta',
		array(
			'label' => 'Category',
			'section' => 'blog_meta_section',
			'description' =>  '',
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting(
    	'blog_tag_meta',
		array(
			'default' => true,
			'sanitize_callback' => 'ultimate_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'blog_tag_meta',
		array(
			'label' => 'Tag',
			'section' => 'blog_meta_section',
			'description' =>  '',
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting(
    	'blog_comment_meta',
		array(
			'default' => true,
			'sanitize_callback' => 'ultimate_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'blog_comment_meta',
		array(
			'label' => 'Comment',
			'section' => 'blog_meta_section',
			'description' =>  '',
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting(
    	'blog_date_meta',
		array(
			'default' => true,
			'sanitize_callback' => 'ultimate_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'blog_date_meta',
		array(
			'label' => 'Date',
			'section' => 'blog_meta_section',
			'description' =>  '',
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting(
    	'blog_link_meta',
		array(
			'default' => true,
			'sanitize_callback' => 'ultimate_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'blog_link_meta',
		array(
			'label' => 'Link',
			'section' => 'blog_meta_section',
			'description' =>  '',
			'type'        => 'checkbox',
		)
	);
	
	//==========================
	// Header Settings
	//==========================

	$wp_customize->add_setting(
    	'display_description_text',
		array(
			'default' => true,
			'sanitize_callback' => 'ultimate_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'display_description_text',
		array(
			'label' => 'Display Tagline Text',
			'section' => 'title_tagline',
			'description' =>  '',
			'type'        => 'checkbox',
		)
	);


	$wp_customize->add_setting(
		'logo-img',
		array(
			'sanitize_callback' => 'ultimate_sanitize_callback'
		)
	); 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'logo-img',
			array(
				'label' => 'Upload Logo',
				'section' => 'title_tagline',
				'settings' => 'logo-img',
			)
		)
	);
	
	$wp_customize->add_setting(
		'favicon-img',
		array(
			'sanitize_callback' => 'ultimate_sanitize_callback'
		)
	); 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'favicon-img',
			array(
				'label' => 'Upload Favicon',
				'section' => 'title_tagline',
				'settings' => 'favicon-img',
			)
		)
	);
	
	$wp_customize->add_setting(
    	'logo_height',
		array(
			'default' => 80,
			'sanitize_callback' => 'ultimate_sanitize_callback'
		)
	);
	$wp_customize->add_control(
		'logo_height',
		array(
			'label' => 'Header Height',
			'section' => 'title_tagline',
			'type' => 'number',
			'input_attrs' => array(
				'step'  => 1,
				'style' => 'width: 80px;',
			),
		)
	);

	$wp_customize->add_setting(
		'header_layout',
		array(
		    'default' => 'header_1',
			'sanitize_callback' => 'ultimate_sanitize_callback'
		)
	);
	$wp_customize->add_control(
		'header_layout',
		array(
		    'type' => 'select',
		    'label' => 'Header Layout',
		    'section' => 'title_tagline',
		    'choices' => array(
		        'header_1' => 'Header Layout 1',
		        'header_2' => 'Header Layout 2',
		        'header_3' => 'Header Layout 3',
		    ),
		)
	);

	//==========================
	// Footer Settings
	//==========================

	$wp_customize->add_setting(
	    'copyright_textbox',
	    array(
	        'default' => 'Proudly powered by WP Shark @BRAINSTORM',
	        'sanitize_callback' => 'ultimate_sanitize_callback',
	    )
	);
	$wp_customize->add_control(
	    'copyright_textbox',
	    array(
	        'label' => 'Copyright Text',
	        'section' => 'footer_settings',
	        'type' => 'text',
	    )
	);

	$wp_customize->add_setting(
	    'copyright_text_link',
	    array(
	        'default' => 'http://brainstormforce.com/',
	        'sanitize_callback' => 'ultimate_sanitize_callback',
	    )
	);
	$wp_customize->add_control(
	    'copyright_text_link',
	    array(
	        'label' => 'Copyright Text Link',
	        'section' => 'footer_settings',
	        'type' => 'text',
	    )
	);

	$wp_customize->add_setting(
	    'display_copyright',
	    array(
			'default' => true,
			'sanitize_callback' => 'ultimate_sanitize_callback',
		)
	);
	$wp_customize->add_control(
	    'display_copyright',
	    array(
	        'type' => 'checkbox',
	        'label' => 'Display copyright text',
	        'section' => 'footer_settings',
	    )
	);
	

	//==========================
	// Colors Settings
	//==========================
	
	// Theme Colors
	$wp_customize->add_setting(
		'site-color',
		array(
			'default' => '#de5034',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site-color',
			array(
				'label' => 'Site Color',
				'section' => 'colors',
				'settings' => 'site-color',
				'priority' => 1
			)
		)
	);

	$wp_customize->add_setting(
		'site-text-color',
		array(
			'default' => '#707070',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site-text-color',
			array(
				'label' => 'Site Text Color',
				'section' => 'colors',
				'settings' => 'site-text-color',
				'priority' => 2
			)
		)
	);

	$wp_customize->add_setting(
		'page-title-color',
		array(
			'default' => '#333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'page-title-color',
			array(
				'label' => 'Single Page/Post Title Color',
				'section' => 'colors',
				'settings' => 'page-title-color',
				'priority' => 3
			)
		)
	);

	$wp_customize->add_setting(
		'post-meta-color',
		array(
			'default' => '#909090',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'post-meta-color',
			array(
				'label' => 'Post Meta Color',
				'section' => 'colors',
				'settings' => 'post-meta-color',
				'priority' => 4
			)
		)
	);

	$wp_customize->add_setting(
		'post-meta-hover-color',
		array(
			'default' => '#de5034',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'post-meta-hover-color',
			array(
				'label' => 'Post Meta Hover Color',
				'section' => 'colors',
				'settings' => 'post-meta-hover-color',
				'priority' => 5
			)
		)
	);

	$wp_customize->add_setting(
		'sidebar-widget-title-color',
		array(
			'default' => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'sidebar-widget-title-color',
			array(
				'label' => 'Sidebar Widget Title Color',
				'section' => 'colors',
				'settings' => 'sidebar-widget-title-color',
				'priority' => 6
			)
		)
	);
	
	// Header Colors
	$wp_customize->add_setting(
		'header_textcolor',
		array(
			'default' => '#f2f2f2',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_textcolor',
			array(
				'label' => 'Header Text / Link Color',
				'section' => 'header_colors',
				'settings' => 'header_textcolor',
				'priority' => 1
			)
		)
	);

	$wp_customize->add_setting(
		'header-hover-color',
		array(
			'default' => '#de5034',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header-hover-color',
			array(
				'label' => 'Header Link Hover Color',
				'section' => 'header_colors',
				'settings' => 'header-hover-color',
				'priority' => 2
			)
		)
	);

	$wp_customize->add_setting(
		'header-bg-color',
		array(
			'default' => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header-bg-color',
			array(
				'label' => 'Header Background Color',
				'section' => 'header_colors',
				'settings' => 'header-bg-color',
				'priority' => 3
			)
		)
	);
	
	// Menu Colors
	$wp_customize->add_setting(
		'parent-menu-color',
		array(
			'default' => '#dddddd',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'parent-menu-color',
			array(
				'label' => 'Parent Menu Color',
				'section' => 'menu_colors',
				'settings' => 'parent-menu-color',
				'priority' => 1
			)
		)
	);
	
	$wp_customize->add_setting(
		'parent-menu-hover-color',
		array(
			'default' => '#f7f7f7',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'parent-menu-hover-color',
			array(
				'label' => 'Parent Menu Hover Color',
				'section' => 'menu_colors',
				'settings' => 'parent-menu-hover-color',
				'priority' => 2
			)
		)
	);

	$wp_customize->add_setting(
		'parent-menu-bg-color',
		array(
			'default' => '#707070',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'parent-menu-bg-color',
			array(
				'label' => 'Parent Menu Background Color',
				'section' => 'menu_colors',
				'settings' => 'parent-menu-bg-color',
				'priority' => 3
			)
		)
	);
	
	$wp_customize->add_setting(
		'child-menu-link-color',
		array(
			'default' => '#eaeaea',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'child-menu-link-color',
			array(
				'label' => 'Child Menu Color',
				'section' => 'menu_colors',
				'settings' => 'child-menu-link-color',
				'priority' => 4
			)
		)
	);
	
	$wp_customize->add_setting(
		'child-menu-hover-color',
		array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'child-menu-hover-color',
			array(
				'label' => 'Child Menu Hover Color',
				'section' => 'menu_colors',
				'settings' => 'child-menu-hover-color',
				'priority' => 5
			)
		)
	);
	
	$wp_customize->add_setting(
		'child-menu-bg-color',
		array(
			'default' => '#1d1d1d',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'child-menu-bg-color',
			array(
				'label' => 'Child Menu Background',
				'section' => 'menu_colors',
				'settings' => 'child-menu-bg-color',
				'priority' => 6
			)
		)
	);
	
	$wp_customize->add_setting(
		'child-menu-hover-bg-color',
		array(
			'default' => '#de5034',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'child-menu-hover-bg-color',
			array(
				'label' => 'Child Menu Hover Background',
				'section' => 'menu_colors',
				'settings' => 'child-menu-hover-bg-color',
				'priority' => 7
			)
		)
	);
	
	
	// Footer Colors
	$wp_customize->add_setting(
		'footer-widget-title-color',
		array(
			'default' => '#de5034',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer-widget-title-color',
			array(
				'label' => 'Footer Widget Title Color',
				'section' => 'footer_colors',
				'settings' => 'footer-widget-title-color',
				'priority' => 1
			)
		)
	);
	
	$wp_customize->add_setting(
		'footer-color',
		array(
			'default' => '#707070',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer-color',
			array(
				'label' => 'Footer Text Color',
				'section' => 'footer_colors',
				'settings' => 'footer-color',
				'priority' => 2
			)
		)
	);
	
	$wp_customize->add_setting(
		'footer-link-color',
		array(
			'default' => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer-link-color',
			array(
				'label' => 'Footer Link Color',
				'section' => 'footer_colors',
				'settings' => 'footer-link-color',
				'priority' => 3
			)
		)
	);

	$wp_customize->add_setting(
		'footer-link-hover-color',
		array(
			'default' => '#de5034',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer-link-hover-color',
			array(
				'label' => 'Footer Link Hover Color',
				'section' => 'footer_colors',
				'settings' => 'footer-link-hover-color',
				'priority' => 4
			)
		)
	);
	
	$wp_customize->add_setting(
		'footer-bg-color',
		array(
			'default' => '#dddddd',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer-bg-color',
			array(
				'label' => 'Main Footer Background Color',
				'section' => 'footer_colors',
				'settings' => 'footer-bg-color',
				'priority' => 5
			)
		)
	);
	
	$wp_customize->add_setting(
		'small-footer-bg-color',
		array(
			'default' => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'small-footer-bg-color',
			array(
				'label' => 'Small Footer Background Color',
				'section' => 'footer_colors',
				'settings' => 'small-footer-bg-color',
				'priority' => 6
			)
		)
	);
	
	$wp_customize->add_setting(
		'small-footer-text-color',
		array(
			'default' => '#dddddd',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'small-footer-text-color',
			array(
				'label' => 'Small Footer Text / Link Color',
				'section' => 'footer_colors',
				'settings' => 'small-footer-text-color',
				'priority' => 7
			)
		)
	);

	$wp_customize->add_setting(
		'small-footer-link-hover-color',
		array(
			'default' => '#de5034',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'small-footer-link-hover-color',
			array(
				'label' => 'Small Footer Link Hover Color',
				'section' => 'footer_colors',
				'settings' => 'small-footer-link-hover-color',
				'priority' => 8
			)
		)
	);
	
	//==========================
	// Typography Settings
	//==========================

	// Default Fonts
	$wp_customize->add_setting( 'default_site_font', array(
		'default' => 'Open Sans',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'ultimate_sanitize_callback',
	) );
	$wp_customize->add_control(
		new Ultimate_Typography_Control(
			$wp_customize,
			'default_site_font',
			array(
				'label' => 'Default Fonts',
				'section' => 'default_font',
				'settings' => 'default_site_font',
				'priority' => 1,
				'id'	=> 'default_font',
				'description' => '400 regular:400:normal'
			)
		)
	);
	
	// Main Content Font
	$wp_customize->add_setting( 'page_title_font', array(
		'default' => 'Open Sans',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'ultimate_sanitize_callback',
	) );
	$wp_customize->add_control(
		new Ultimate_Typography_Control(
			$wp_customize,
			'page_title_font',
			array(
				'label' => 'Page Title Font',
				'section' => 'entry_title_font',
				'settings' => 'page_title_font',
				'priority' => 1,
				'id'	=> 'entry_title_font',
				'description' => '400 regular:400:normal'
			)
		)
	);

	$wp_customize->add_setting(
    	'page_title_font_size',
		array(
			'default' => 18,
			'sanitize_callback' => 'ultimate_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'page_title_font_size',
		array(
			'label' => 'Font Size (px)',
			'section' => 'entry_title_font',
			'description' =>  '',
			'type'        => 'number',
			'priority' => 2,
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 72,
				'step'  => 1,
				'style' => 'width: 80px;',
			),
		)
	);
	
	$wp_customize->add_setting( 'separator-1', array(
		'default' => '',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'ultimate_sanitize_callback',
	) );
	$wp_customize->add_control(
		new Ultimate_Separator_Control(
			$wp_customize,
			'separator-1',
			array(
				'label' => '',
				'section' => 'entry_title_font',
				'settings' => 'separator-1',
				'priority' => 3,
			)
		)
	);
	
	$wp_customize->add_setting( 'post_meta_font', array(
		'default' => 'Open Sans',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'ultimate_sanitize_callback',
	) );
	$wp_customize->add_control(
		new Ultimate_Typography_Control(
			$wp_customize,
			'post_meta_font',
			array(
				'label' => 'Post Meta Font',
				'section' => 'entry_title_font',
				'settings' => 'post_meta_font',
				'priority' => 4,
				'id'	=> 'entry_title_font',
				'description' => '400 regular:400:normal'
			)
		)
	);

	$wp_customize->add_setting(
    	'post_meta_font_size',
		array(
			'default' => 18,
			'sanitize_callback' => 'ultimate_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'post_meta_font_size',
		array(
			'label' => 'Font Size (px)',
			'section' => 'entry_title_font',
			'description' =>  '',
			'type'        => 'number',
			'priority' => 5,
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 72,
				'step'  => 1,
				'style' => 'width: 80px;',
			),
		)
	);
	
	// Widget Font
	$wp_customize->add_setting( 'widget_title_font', array(
		'default' => 'Open Sans',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'ultimate_sanitize_callback',
	) );
	$wp_customize->add_control(
		new Ultimate_Typography_Control(
			$wp_customize,
			'widget_title_font',
			array(
				'label' => 'Widget Title Font',
				'section' => 'widget_title_font',
				'settings' => 'widget_title_font',
				'priority' => 1,
				'id'	=> 'entry_title_font',
				'description' => '400 regular:400:normal'
			)
		)
	);

	$wp_customize->add_setting(
    	'widget_title_font_size',
		array(
			'default' => 18,
			'sanitize_callback' => 'ultimate_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'widget_title_font_size',
		array(
			'label' => 'Font Size (px)',
			'section' => 'widget_title_font',
			'description' =>  '',
			'type'        => 'number',
			'priority' => 2,
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 72,
				'step'  => 1,
				'style' => 'width: 80px;',
			),
		)
	);
	
	// Menu Fonts
	$wp_customize->add_setting( 'menu_font', array(
		'default' => 'Open Sans',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'ultimate_sanitize_callback',
	) );
	$wp_customize->add_control(
		new Ultimate_Typography_Control(
			$wp_customize,
			'menu_font',
			array(
				'label' => 'Menu Font',
				'section' => 'menu_font',
				'settings' => 'menu_font',
				'priority' => 1,
				'id'	=> 'entry_title_font',
				'description' => '400 regular:400:normal'
			)
		)
	);

	$wp_customize->add_setting(
    	'menu_font_size',
		array(
			'default' => 18,
			'sanitize_callback' => 'ultimate_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'menu_font_size',
		array(
			'label' => 'Font Size (px)',
			'section' => 'menu_font',
			'description' =>  '',
			'type'        => 'number',
			'priority' => 2,
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 72,
				'step'  => 1,
				'style' => 'width: 80px;',
			),
		)
	);
	
	// Breadcrumb Font
	$wp_customize->add_setting( 'breadcrumb_font', array(
		'default' => 'Open Sans',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'ultimate_sanitize_callback',
	) );
	$wp_customize->add_control(
		new Ultimate_Typography_Control(
			$wp_customize,
			'breadcrumb_font',
			array(
				'label' => 'Breadcrumb Font',
				'section' => 'breadcrumb_font',
				'settings' => 'breadcrumb_font',
				'priority' => 1,
				'id'	=> 'entry_title_font',
				'description' => '400 regular:400:normal'
			)
		)
	);

	$wp_customize->add_setting(
    	'breadcrumb_font_size',
		array(
			'default' => 18,
			'sanitize_callback' => 'ultimate_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'breadcrumb_font_size',
		array(
			'label' => 'Font Size (px)',
			'section' => 'breadcrumb_font',
			'description' =>  '',
			'type'        => 'number',
			'priority' => 2,
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 72,
				'step'  => 1,
				'style' => 'width: 80px;',
			),
		)
	);
	
	$wp_customize->add_setting( 'separator-2', array(
		'default' => '',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'ultimate_sanitize_callback',
	) );
	$wp_customize->add_control(
		new Ultimate_Separator_Control(
			$wp_customize,
			'separator-2',
			array(
				'label' => '',
				'section' => 'breadcrumb_font',
				'settings' => 'separator-2',
				'priority' => 3,
			)
		)
	);
	
	$wp_customize->add_setting( 'page_heading_font', array(
		'default' => 'Open Sans',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'ultimate_sanitize_callback',
	) );
	$wp_customize->add_control(
		new Ultimate_Typography_Control(
			$wp_customize,
			'page_heading_font',
			array(
				'label' => 'Page Heading Font',
				'section' => 'breadcrumb_font',
				'settings' => 'page_heading_font',
				'priority' => 4,
				'id'	=> 'entry_title_font',
				'description' => '400 regular:400:normal'
			)
		)
	);

	$wp_customize->add_setting(
    	'page_heading_font_size',
		array(
			'default' => 18,
			'sanitize_callback' => 'ultimate_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'page_heading_font_size',
		array(
			'label' => 'Font Size (px)',
			'section' => 'breadcrumb_font',
			'description' =>  '',
			'type'        => 'number',
			'priority' => 5,
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 72,
				'step'  => 1,
				'style' => 'width: 80px;',
			),
		)
	);
	
	//==========================
	// Advanced Settings
	//==========================

	// General Settings	
	$wp_customize->add_setting(
    	'site_fixed_header',
		array(
			'default' => true,
			'sanitize_callback' => 'ultimate_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'site_fixed_header',
		array(
			'label' => 'Enable Fixed Header',
			'section' => 'general_advanced',
			'description' =>  '',
			'type'        => 'checkbox',
			'priority' => 1,
		)
	);

	$wp_customize->add_setting(
    	'smooth_scroll',
		array(
			'default' => true,
			'sanitize_callback' => 'ultimate_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'smooth_scroll',
		array(
			'label' => 'Enable Smooth Header',
			'section' => 'general_advanced',
			'description' =>  '',
			'type'        => 'checkbox',
			'priority' => 1,
		)
	);

	$wp_customize->add_setting(
    	'scroll_to_top',
		array(
			'default' => true,
			'sanitize_callback' => 'ultimate_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'scroll_to_top',
		array(
			'label' => 'Enable Scroll To Top',
			'section' => 'general_advanced',
			'description' =>  '',
			'type'        => 'checkbox',
			'priority' => 1,
		)
	);


	//==========================
	// Background Image
	//==========================
	$wp_customize->add_setting(
		'site-bg-color',
		array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site-bg-color',
			array(
				'label' => 'Site Background Color',
				'section' => 'background_image',
				'settings' => 'site-bg-color',
				'priority' => 1
			)
		)
	);


	//==========================
	// Reset To Default
	//==========================

	$wp_customize->add_setting( 
		'reset_settings', 
		array(
		    'default' => '',
		    'sanitize_callback' => 'ultimate_sanitize_callback',
		) 
	);
	$wp_customize->add_control(
	    'reset_settings',
	    array(
	        'label' => '',
	        'section' => 'reset_default',
	        'type' => 'text',
	    )
	);


}

add_action( 'customize_register', 'ultimate_customize_register' );
function ultimate_sanitize_callback($input){
	return $input;
}


// Reset Customizer Setting To Default
$customizer_reset = get_theme_mod( 'reset_settings' );
if ($customizer_reset == "reset" || $customizer_reset == "RESET" || $customizer_reset == "Reset") {
	remove_theme_mods();
}