<?php
/**
 * Register postMessage support.
 *
 * Add postMessage support for site title and description for the Customizer.
 *
 * @package WordPress
 * @subpackage King
 * @since King 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function king_customize_register( $wp_customize ) {

	// Enque Required JS & CSS
	add_action( 'customize_controls_print_styles', 'customizer_scripts' );
	function customizer_scripts() {
		$king_admin_url = get_template_directory_uri() . '/inc/admin/assets/';
		wp_enqueue_style( 'king-customizer-css', $king_admin_url . 'css/customizer.css' );
		wp_enqueue_style( 'king-customizer-ui',  $king_admin_url . 'css/jquery-ui-1.10.0.custom.css' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-slider' );
	}
	
	// Add Controls
	get_template_part('inc/admin/customizer/controls/class','King_Separator_Control');
	get_template_part('inc/admin/customizer/controls/class','King_Typography_Control');
	get_template_part('inc/admin/customizer/controls/class','King_Sliderui_Control');
	get_template_part('inc/admin/customizer/controls/class','King_Textarea_Control');

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
	    'title' => __( 'Blog Settings', 'king' ),
	    'description' => __( 'Customize your blog layout.', 'king' ),
	) );
	$wp_customize->add_section( 'blog_layout_section', array(
	    'priority' => 1,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Layout', 'king' ),
	    'description' => '',
	    'panel' => 'blog_panel',
	) );
	$wp_customize->add_section( 'blog_featured_image', array(
	    'priority' => 2,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Fetured Image', 'king' ),
	    'description' => '',
	    'panel' => 'blog_panel',
	) );
	$wp_customize->add_section( 'blog_meta_section', array(
	    'priority' => 3,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Select Post Meta', 'king' ),
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
        'title_bar',
        array(
            'title' => 'Page Title Bar',
            'description' => 'Customize page title bar',
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
	    'title' => __( 'Color Settings', 'king' ),
	    'description' => __( 'Customize theme color options.', 'king' ),
	) );
	$wp_customize->add_section( 'colors', array(
	    'priority' => 1,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme', 'king' ),
	    'description' => '',
	    'panel' => 'colors_panel',
	) );
	$wp_customize->add_section( 'header_colors', array(
	    'priority' => 2,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Header', 'king' ),
	    'description' => '',
	    'panel' => 'colors_panel',
	) );
	$wp_customize->add_section( 'menu_colors', array(
	    'priority' => 3,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Menu', 'king' ),
	    'description' => '',
	    'panel' => 'colors_panel',
	) );
	$wp_customize->add_section( 'footer_colors', array(
	    'priority' => 4,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Footer', 'king' ),
	    'description' => '',
	    'panel' => 'colors_panel',
	) );

	$wp_customize->add_panel( 'typography_panel', array(
	    'priority' => 6,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Typography Settings', 'king' ),
	    'description' => __( 'Description of what this panel does.', 'king' ),
	) );
	$wp_customize->add_section( 'default_font', array(
	    'priority' => 1,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Default', 'king' ),
	    'description' => '',
	    'panel' => 'typography_panel',
	) );
	$wp_customize->add_section( 'site_tagline_title_font', array(
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Site Title & Tagline', 'king' ),
	    'description' => '',
	    'panel' => 'typography_panel',
		'priority' => 2,
	) );
	$wp_customize->add_section( 'entry_title_font', array(
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Main Content', 'king' ),
	    'description' => '',
	    'panel' => 'typography_panel',
		'priority' => 2,
	) );	
	$wp_customize->add_section( 'widget_title_font', array(
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Widgets', 'king' ),
	    'description' => '',
	    'panel' => 'typography_panel',
		'priority' => 3,
	) );
	$wp_customize->add_section( 'menu_font', array(
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Menu', 'king' ),
	    'description' => '',
	    'panel' => 'typography_panel',
		'priority' => 4,
	) );
	$wp_customize->add_section( 'breadcrumb_font', array(
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Breadcrumbs', 'king' ),
	    'description' => '',
	    'panel' => 'typography_panel',
		'priority' => 5,
	) );

	$wp_customize->add_panel( 'advanced_panel', array(
	    'priority' => 7,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Advanced Options', 'king' ),
	    'description' => __( 'Advanced options of your theme', 'king' ),
	) );
	$wp_customize->add_section( 'general_advanced', array(
	    'priority' => 1,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'General Settings', 'king' ),
	    'description' => '',
	    'panel' => 'advanced_panel',
	) );
	$wp_customize->add_section( 'custom_code', array(
		'priority' => 999,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Custom Code', 'king' ),
	    'description' => 'Put Custom Scripts & CSS here.',
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
			'sanitize_callback' => 'king_sanitize_callback'
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
		'sidebar_position',
		array(
			'default' => 'no-sidebar',
			'sanitize_callback' => 'king_sanitize_callback'
		)
	);	 
	$wp_customize->add_control(
		'sidebar_position',
		array(
			'type' => 'select',
			'label' => 'Sidebar Position',
			'section' => 'layout_setting',
			'choices' => array(
				'right-sidebar' => 'Right Sidebar',
				'left-sidebar' => 'Left Sidebar',
				'no-sidebar' => 'No Sidebar',
			),
		)
	);

	$wp_customize->add_setting( 
		'separator-width', 
		array(
			'default' => '',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => '',
			'sanitize_callback' => 'king_sanitize_callback',
		) 
	);
	$wp_customize->add_control(
		new King_Separator_Control(
			$wp_customize,
			'separator-width',
			array(
				'label' => '',
				'section' => 'layout_setting',
				'settings' => 'separator-width',
			)
		)
	);
	
	$wp_customize->add_setting(
    	'site_width',
		array(
			'default' => 1170,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'king_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		new King_Sliderui_Control(
			$wp_customize,
			'site_width',
			array(
				'label' => 'Site Width (px)',
				'section' => 'layout_setting',
				'settings' => 'site_width',
				'type' => 'slider',
				'subtitle' => '',
				'description' =>  'This setting will not be applied to <strong>Fluid Layout</strong>.',				
				'choices' => array(
					'min'   => 420,
					'max'   => 1900,
					'step'  => 10,
					'style' => '',
				),
			)
		)
	);

	$wp_customize->add_setting(
    	'content_width',
		array(
			'default' => 75,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'king_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		new King_Sliderui_Control(
			$wp_customize,
			'content_width',
			array(
				'label' => 'Primary Content Width (%)',
				'section' => 'layout_setting',
				'settings' => 'content_width',
				'type' => 'slider',
				'subtitle' => '',
				'description' =>  'Set primary content width (except sidebar)',				
				'choices' => array(
					'min'   => 10,
					'max'   => 90,
					'step'  => 1,
					'style' => '',
				),
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
			'default' => 'grid-3',
			'sanitize_callback' => 'king_sanitize_callback'
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
				'grid-3' => 'Grid - 3 Column Layout',
				'grid-4' => 'Grid - 4 Column Layout',
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
			'sanitize_callback' => 'king_sanitize_callback',
		) 
	);
	$wp_customize->add_control(
		new King_Separator_Control(
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
			'sanitize_callback' => 'king_sanitize_callback',
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
		'blog_animation',
		array(
			'default' => 'fadeIn',
			'sanitize_callback' => 'king_sanitize_callback'
		)
	);	 
	$wp_customize->add_control(
		'blog_animation',
		array(
			'type' => 'select',
			'label' => 'Blog Animation',
			'section' => 'blog_layout_section',
			'choices' => array(
				'fadeIn'      => 'Fade In',
				'fadeInUp'    => 'Fade In Up',
				'fadeInUpBig' => 'Fade In Up Big',
				'zoomIn'      => 'Zoom In',
				'bounceIn'    => 'Bounce In',
				'bounceInUp'  => 'Bounce In Up',
				'none'		  => 'No Animation',				
			),
		)
	);


	$wp_customize->add_setting(
		'blog_pagination',
		array(
			'default' => 'number',
			'sanitize_callback' => 'king_sanitize_callback'
		)
	);	 
	$wp_customize->add_control(
		'blog_pagination',
		array(
			'type' => 'select',
			'label' => 'Blog Pagination',
			'section' => 'blog_layout_section',
			'choices' => array(
				'number' => 'Number Pagination',
				'infinite' => 'Infinite Scroll',
				'traditional' => 'Traditional Pagination',
			),
		)
	);

	$wp_customize->add_setting(
    	'post_excerpt_length',
		array(
			'default' => 25,
			'sanitize_callback' => 'king_sanitize_callback',
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

	// Featured Image
	// Retrive all registered image sizes
	$featureed_image_sizes = array();
	$get_intermediate_image_sizes = get_intermediate_image_sizes();
	$featureed_image_sizes['full'] = 'full';
	foreach( $get_intermediate_image_sizes as $_size ) {
		$featureed_image_sizes[$_size] = $_size;
	}

	$wp_customize->add_setting(
		'blog_featured_image_size',
		array(
			'default' => 'full',
			'sanitize_callback' => 'king_sanitize_callback'
		)
	);	 
	$wp_customize->add_control(
		'blog_featured_image_size',
		array(
			'type' => 'select',
			'label' => 'Select Fetured Image Size',
			'section' => 'blog_featured_image',
			'choices' => $featureed_image_sizes,
		)
	);

	$wp_customize->add_setting(
		'blog_featured_image_effect',
		array(
			'default' => 'king-blur',
			'sanitize_callback' => 'king_sanitize_callback'
		)
	);	 
	$wp_customize->add_control(
		'blog_featured_image_effect',
		array(
			'type' => 'select',
			'label' => 'Select Fetured Image Hover Effect',
			'section' => 'blog_featured_image',
			'choices' => array(
				'king-blur' => 'Blur',				
				'king-grayscale' => 'Grayscale',
				'king-sepia' => 'Sepia',
				'king-hue-rotate' => 'Hue Rotate',
				'king-blog-overlay' => 'Theme Color Overlay',				
				'king-none' => 'None',
			),
		)
	);

	// Post Meta
	$wp_customize->add_setting(
    	'blog_author_meta',
		array(
			'default' => true,
			'sanitize_callback' => 'king_sanitize_callback',
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
			'default' => false,
			'sanitize_callback' => 'king_sanitize_callback',
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
			'default' => false,
			'sanitize_callback' => 'king_sanitize_callback',
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
			'default' => false,
			'sanitize_callback' => 'king_sanitize_callback',
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
			'sanitize_callback' => 'king_sanitize_callback',
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
			'default' => false,
			'sanitize_callback' => 'king_sanitize_callback',
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
			'default' => false,
			'sanitize_callback' => 'king_sanitize_callback',
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
			'sanitize_callback' => 'king_sanitize_callback'
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
			'sanitize_callback' => 'king_sanitize_callback'
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
			'default' => 90,
			'sanitize_callback' => 'king_sanitize_callback'
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
			'sanitize_callback' => 'king_sanitize_callback'
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
	// Page Title Bar Settings
	//==========================
	$wp_customize->add_setting(
		'title_bar_layout',
		array(
			'default' => 'style-1',
			'sanitize_callback' => 'king_sanitize_callback'
		)
	);	 
	$wp_customize->add_control(
		'title_bar_layout',
		array(
			'type' => 'select',
			'label' => 'Display Page Title Bar',
			'section' => 'title_bar',
			'choices' => array(
				'style-1' => 'Enable',
				'disable' => 'Disable',
			),
		)
	);

	$wp_customize->add_setting(
		'breadcrumb_bar',
		array(
			'default' => 'enable',
			'sanitize_callback' => 'king_sanitize_callback'
		)
	);	 
	$wp_customize->add_control(
		'breadcrumb_bar',
		array(
			'type' => 'select',
			'label' => 'Display Breadcrumb',
			'section' => 'title_bar',
			'choices' => array(
				'enable' => 'Enable',
				'disable' => 'Disable',
			),
		)
	);

	//==========================
	// Footer Settings
	//==========================

	$wp_customize->add_setting(
	    'copyright_textbox',
	    array(
	        'default' => 'King WordPress Theme by Brainstorm Force',
	        'sanitize_callback' => 'king_sanitize_callback',
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
	        'default' => 'https://www.brainstormforce.com/',
	        'sanitize_callback' => 'king_sanitize_callback',
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
			'sanitize_callback' => 'king_sanitize_callback',
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
			'default' => '#333333',
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
			'default' => '#f1f1f1',
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
		'sanitize_callback' => 'king_sanitize_callback',
	) );
	$wp_customize->add_control(
		new King_Typography_Control(
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

	// Site Title & Tagline
	$wp_customize->add_setting( 'site_title_font', array(
		'default' => 'Open Sans',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'king_sanitize_callback',
	) );
	$wp_customize->add_control(
		new King_Typography_Control(
			$wp_customize,
			'site_title_font',
			array(
				'label' => 'Site Title Font',
				'section' => 'site_tagline_title_font',
				'settings' => 'site_title_font',
				'priority' => 1,
				'id'	=> 'site_tagline_title_font',
				'description' => '400 regular:400:normal'
			)
		)
	);

	$wp_customize->add_setting(
    	'site_title_font_size',
		array(
			'default' => 24,
			'sanitize_callback' => 'king_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'site_title_font_size',
		array(
			'label' => 'Font Size (px)',
			'section' => 'site_tagline_title_font',
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

	$wp_customize->add_setting( 'site_title_seperator', array(
		'default' => '',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'king_sanitize_callback',
	) );
	$wp_customize->add_control(
		new King_Separator_Control(
			$wp_customize,
			'site_title_seperator',
			array(
				'label' => '',
				'section' => 'site_tagline_title_font',
				'settings' => 'site_title_seperator',
				'priority' => 3,
			)
		)
	);
	
	$wp_customize->add_setting( 'tagline_font', array(
		'default' => 'Open Sans',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'king_sanitize_callback',
	) );
	$wp_customize->add_control(
		new King_Typography_Control(
			$wp_customize,
			'tagline_font',
			array(
				'label' => 'Tagline Font',
				'section' => 'site_tagline_title_font',
				'settings' => 'tagline_font',
				'priority' => 4,
				'id'	=> 'site_tagline_title_font',
				'description' => '400 regular:400:normal'
			)
		)
	);

	$wp_customize->add_setting(
    	'tagline_font_size',
		array(
			'default' => 14,
			'sanitize_callback' => 'king_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'tagline_font_size',
		array(
			'label' => 'Font Size (px)',
			'section' => 'site_tagline_title_font',
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
	
	// Main Content Font
	$wp_customize->add_setting( 'page_title_font', array(
		'default' => 'Open Sans',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'king_sanitize_callback',
	) );
	$wp_customize->add_control(
		new King_Typography_Control(
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
			'default' => 20,
			'sanitize_callback' => 'king_sanitize_callback',
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
		'sanitize_callback' => 'king_sanitize_callback',
	) );
	$wp_customize->add_control(
		new King_Separator_Control(
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
		'sanitize_callback' => 'king_sanitize_callback',
	) );
	$wp_customize->add_control(
		new King_Typography_Control(
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
			'default' => 12,
			'sanitize_callback' => 'king_sanitize_callback',
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
	$wp_customize->add_setting( 
		'widget_title_font', 
		array(
			'default' => 'Open Sans',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => '',
			'sanitize_callback' => 'king_sanitize_callback',
	) );
	$wp_customize->add_control(
		new King_Typography_Control(
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
			'sanitize_callback' => 'king_sanitize_callback',
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
	$wp_customize->add_setting( 
		'menu_font', 
		array(
			'default' => 'Open Sans',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => '',
			'sanitize_callback' => 'king_sanitize_callback',
	) );
	$wp_customize->add_control(
		new King_Typography_Control(
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
			'default' => 13,
			'sanitize_callback' => 'king_sanitize_callback',
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

	$wp_customize->add_setting( 
		'separator-menu', 
		array(
			'default' => '',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => '',
			'sanitize_callback' => 'king_sanitize_callback',
		) 
	);
	$wp_customize->add_control(
		new King_Separator_Control(
			$wp_customize,
			'separator-menu',
			array(
				'label' => '',
				'section' => 'menu_font',
				'settings' => 'separator-menu',
				'priority' => 3,
			)
		)
	);

	$wp_customize->add_setting( 
		'submenu_font', 
		array(
			'default' => 'Open Sans',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => '',
			'sanitize_callback' => 'king_sanitize_callback',
	) );
	$wp_customize->add_control(
		new King_Typography_Control(
			$wp_customize,
			'submenu_font',
			array(
				'label' => 'Sub Menu Font',
				'section' => 'menu_font',
				'settings' => 'submenu_font',
				'priority' => 4,
				'id'	=> 'entry_title_font',
				'description' => '400 regular:400:normal'
			)
		)
	);

	$wp_customize->add_setting(
    	'submenu_font_size',
		array(
			'default' => 12,
			'sanitize_callback' => 'king_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'submenu_font_size',
		array(
			'label' => 'Sub Font Size (px)',
			'section' => 'menu_font',
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
	
	// Breadcrumb Font
	$wp_customize->add_setting( 'breadcrumb_font', array(
		'default' => 'Open Sans',
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'transport' => '',
		'sanitize_callback' => 'king_sanitize_callback',
	) );
	$wp_customize->add_control(
		new King_Typography_Control(
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
			'default' => 13,
			'sanitize_callback' => 'king_sanitize_callback',
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
		'sanitize_callback' => 'king_sanitize_callback',
	) );
	$wp_customize->add_control(
		new King_Separator_Control(
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
		'sanitize_callback' => 'king_sanitize_callback',
	) );
	$wp_customize->add_control(
		new King_Typography_Control(
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
			'default' => 17,
			'sanitize_callback' => 'king_sanitize_callback',
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
			'sanitize_callback' => 'king_sanitize_callback',
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
			'sanitize_callback' => 'king_sanitize_callback',
		)
	);
	$wp_customize->add_control(
		'smooth_scroll',
		array(
			'label' => 'Enable Smooth Scroll',
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
			'sanitize_callback' => 'king_sanitize_callback',
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

	// Custom Code
	$wp_customize->add_setting( 
		'custom_css', 
		array(
		    'default' => '',
		    'sanitize_callback' => 'king_sanitize_callback',
		) 
	);
	$wp_customize->add_control(
		new King_Textarea_Control(
			$wp_customize,
			'custom_css',
			array(
				'label' => 'Custom CSS',
				'section' => 'custom_code',
				'type' => 'textarea',
				'description' =>  'This setting will add custom CSS (Write your CSS without style tag)',
			)
		)
	);

	$wp_customize->add_setting( 
		'custom_script', 
		array(
		    'default' => '',
		    'sanitize_callback' => 'king_sanitize_callback',
		) 
	);
	$wp_customize->add_control(
		new King_Textarea_Control(
			$wp_customize,
			'custom_script',
			array(
				'label' => 'Custom Script',
				'section' => 'custom_code',
				'type' => 'textarea',
				'description' =>  'This setting will add custom Script (Write your CSS with script tag)',
			)
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
		    'sanitize_callback' => 'king_sanitize_callback',
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


	// Post Values For Live Preview
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'site_width' )->transport 		= 'postMessage';
	$wp_customize->get_setting( 'content_width' )->transport 	= 'postMessage';
	$wp_customize->get_setting( 'copyright_textbox' )->transport= 'postMessage';
	

}

add_action( 'customize_register', 'king_customize_register' );
function king_sanitize_callback($input){
	return $input;
}

// Reset Customizer Setting To Default
$customizer_reset = get_theme_mod( 'reset_settings' );
if ($customizer_reset == "reset" || $customizer_reset == "RESET" || $customizer_reset == "Reset") {
	remove_theme_mods();
}

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since King 1.0
 */
function king_customize_preview_js() {
	wp_enqueue_script( 'king-customizer', get_template_directory_uri() . '/inc/admin/assets/js/theme-customizer.js', array( 'customize-preview' ), '20130301', true );
}
add_action( 'customize_preview_init', 'king_customize_preview_js' );