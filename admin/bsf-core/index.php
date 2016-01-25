<?php
/*
Plugin Name: Brainstorm Core
Plugin URI: https://brainstormforce.com
Author: Brainstorm Force
Author URI: https://brainstormforce.com
Version: 1.0
Description: Brainstorm Core
Text Domain: bsf
*/

/*
	Instrunctions - Product Registration & Updater
	# Copy "auto-upadater" folder to admin folder
	# Change "include_once" and "require_once" directory path as per your "auto-updater" path (Line no. 72, 78, 79)

*/
/* product registration */
require_once 'auto-update/admin-functions.php';
require_once 'auto-update/updater.php';

if(!function_exists('bsf_convert_core_path_to_relative')) {
	function bsf_convert_core_path_to_relative($path) {
		global $bsf_core_url;
		$plugin_dir = basename(PLUGINDIR);
		$theme_dir = basename(get_theme_root());
		if (strpos($path, $theme_dir) !== false) {
		    return rtrim(get_template_directory_uri().'/admin/bsf-core/', '/');
		}
		elseif(strpos($path, $plugin_dir) !== false) {
			return rtrim(plugin_dir_url( __FILE__ ),'/');
		}
		return false;
	}
}

add_action('admin_init', 'set_bsf_core_constant',1);
	if(!function_exists('set_bsf_core_constant')) {
	function set_bsf_core_constant() {
		if(!defined('BSF_CORE')) {
			define('BSF_CORE',true);
		}
	}
}

if ( ! function_exists( 'register_bsf_products_registration_page' ) ) {
	function register_bsf_products_registration_page() {
		if ( defined( 'BSF_UNREG_MENU' ) && ( BSF_UNREG_MENU === true || BSF_UNREG_MENU === 'true' ) ) {
			return false;
		}
		if ( empty ( $GLOBALS['admin_page_hooks']['bsf-registration'] ) ) {
			$place = bsf_get_free_menu_position( 200, 1 );
			if ( ! defined( 'BSF_MENU_POS' ) ) {
				define( 'BSF_MENU_POS', $place );
			}
			if(is_multisite()) {
				$page = add_menu_page('Brainstorm Force', 'Brainstorm', 'administrator', 'bsf-registration', 'bsf_registration','',$place);
			}
			else {
				if(defined('BSF_REG_MENU_TO_SETTINGS') && (BSF_REG_MENU_TO_SETTINGS == true || BSF_REG_MENU_TO_SETTINGS == 'true')) {
					$page = add_options_page('Brainstorm Force', 'Brainstorm', 'administrator', 'bsf-registration', 'bsf_registration' );
				}
				else {
					$page = add_dashboard_page( 'Brainstorm Force', 'Brainstorm', 'administrator', 'bsf-registration', 'bsf_registration' );
				}
			}
		}
	}
}
if ( ! function_exists( 'bsf_registration' ) ) {
	function bsf_registration() {
		include_once 'auto-update/index.php';
	}
}

if ( is_multisite() ) {
	add_action( 'network_admin_menu', 'register_bsf_products_registration_page', 98 );
} else {
	add_action( 'admin_menu', 'register_bsf_products_registration_page', 98 );
}

/*
	Instrunctions - Plugin Installer
	# Copy "plugin-installer" folder to theme's admin folder
	# Change "include_once" and "require_once" directory path as per your "plugin-installer" path (Line no. 101, 113)
*/
add_action( 'admin_init', 'init_bsf_plugin_installer' );
if ( ! function_exists( 'init_bsf_plugin_installer' ) ) {
	function init_bsf_plugin_installer() {
		require_once 'plugin-installer/admin-functions.php';
	}
}

if(!is_multisite())
	add_action('admin_menu', 'register_bsf_extension_page',999);
else
	add_action('network_admin_menu', 'register_bsf_extension_page_network',999);
if(!function_exists('register_bsf_extension_page')) {
	function register_bsf_extension_page() {
		add_submenu_page( 'imedica_options', __('Extensions','bsf'), __('Extensions','bsf'), 'manage_options', 'bsf-extensions', 'bsf_extensions_callback' );
	}
}
if(!function_exists('register_bsf_extension_page_network')) {
	function register_bsf_extension_page_network() {
		add_submenu_page( 'bsf-registration', __('Extensions','bsf'), __('Extensions','bsf'), 'manage_options', 'bsf-extensions', 'bsf_extensions_callback' );
	}
}
if ( ! function_exists( 'bsf_extensions_callback' ) ) {
	function bsf_extensions_callback() {
		include_once 'plugin-installer/index.php';
	}
}

if(!function_exists('bsf_extract_product_id')) {
	function bsf_extract_product_id($path) {
		$id = false;
		$file = rtrim($path,'/').'/admin/bsf.yml';
		$file_fallback = rtrim($path,'/').'/bsf.yml';
		if(is_file($file))
			$file = $file;
		else if(is_file($file_fallback))
			$file = $file_fallback;
		else
			return false;
		$filelines = file_get_contents($file);
		if(stripos($filelines,'ID:[') !== false) {
			preg_match_all("/ID:\[(.*?)\]/", $filelines, $matches);
			if(isset($matches[1])) {
				$id = (isset($matches[1][0])) ? $matches[1][0] : '';
			}
		}
		return $id;
	}
}

add_action( 'admin_init', 'init_bsf_core' );
if(!function_exists('init_bsf_core')) {
	function init_bsf_core() {
		$plugins = get_plugins();
		$themes = wp_get_themes();

		$bsf_products = array();
		foreach($plugins as $plugin => $plugin_data)
		{
			if(trim($plugin_data['Author']) === 'Brainstorm Force')
			{
				$plugin_data['type'] = 'plugin';
				$plugin_data['template'] = $plugin;
				$plugin_data['path'] = dirname(realpath(WP_PLUGIN_DIR.'/'.$plugin));
				$id = bsf_extract_product_id($plugin_data['path']);
				if($id !== false)
					$plugin_data['id'] = $id; // without readme.txt filename
				array_push($bsf_products, $plugin_data);
			}
		}

		foreach($themes as $theme => $theme_data)
		{
			$temp = array();
			$theme_author = trim($theme_data->display('Author', FALSE));
			if($theme_author === 'Brainstorm Force')
			{
				$temp['Name'] = $theme_data->get('Name');
				$temp['ThemeURI'] = $theme_data->get('ThemeURI');
				$temp['Description'] = $theme_data->get('Description');
				$temp['Author'] = $theme_data->get('Author');
				$temp['AuthorURI'] = $theme_data->get('AuthorURI');
				$temp['Version'] = $theme_data->get('Version');
				$temp['type'] = 'theme';
				$temp['template'] = $theme;
				$temp['path'] = realpath(get_theme_root().'/'.$theme);
				$id = bsf_extract_product_id($temp['path']);
				if($id !== false)
					$temp['id'] = $id; // without readme.txt filename
				array_push($bsf_products, $temp);
			}
		}

		$brainstrom_products = ( get_option( 'brainstrom_products' ) ) ? get_option( 'brainstrom_products' ) : array();

		if(!empty($bsf_products)) {
			foreach ($bsf_products as $key => $product) {
				if(!(isset($product['id'])) || $product['id'] === '')
					continue;
				if(isset($brainstrom_products[$product['type'].'s'][$product['id']]))
					$bsf_product_info = $brainstrom_products[$product['type'].'s'][$product['id']];
				else
					$bsf_product_info = array();
				$bsf_product_info['template'] = $product['template'];
				$bsf_product_info['type'] = $product['type'];
				$bsf_product_info['id'] = $product['id'];
				$brainstrom_products[$product['type'].'s'][$product['id']] = $bsf_product_info;
			}
		}

		update_option('brainstrom_products', $brainstrom_products);
	}
}
if(is_multisite()) {
	$brainstrom_products = (get_option('brainstrom_products')) ? get_option('brainstrom_products') : array();
	if(!empty($brainstrom_products)) {
		$bsf_product_themes = (isset($brainstrom_products['themes'])) ? $brainstrom_products['themes'] : array();
		if(!empty($bsf_product_themes)) {
			foreach ($bsf_product_themes as $id => $theme) {
				global $bsf_theme_template;
				$template = $theme['template'];
				$bsf_theme_template = $template;
			}
		}
	}
}
// assets
add_action( 'admin_enqueue_scripts', 'register_bsf_core_admin_styles', 1 );
if(!function_exists('register_bsf_core_admin_styles')) {
	function register_bsf_core_admin_styles($hook) {
		//echo '--------------------------------------........'.$hook;die();

		// bsf core style
		$hook_array = array(
			'toplevel_page_bsf-registration',
			'imedica_page_bsf-extensions',
			'brainstorm_page_bsf-extensions',
			'update-core.php',
			'dashboard_page_bsf-registration',
			'index_page_bsf-registration',
			'admin_page_bsf-extensions',
			'settings_page_bsf-registration'
		);
		$hook_array = apply_filters('bsf_core_style_screens',$hook_array);
		if(in_array($hook, $hook_array)){
			// add function here
			global $bsf_core_path;
			$bsf_core_url = bsf_convert_core_path_to_relative($bsf_core_path);
			$path = $bsf_core_url.'/assets/css/style.css';
			wp_register_style( 'bsf-core-admin', $path );
			wp_enqueue_style( 'bsf-core-admin' );
		}

		// frosty script
		$hook_frosty_array = array();
		$hook_frosty_array = apply_filters('bsf_core_frosty_screens',$hook_frosty_array);
		if(in_array($hook, $hook_frosty_array)){
			global $bsf_core_path;
			$bsf_core_url = bsf_convert_core_path_to_relative($bsf_core_path);

			$path = $bsf_core_url.'/assets/js/frosty.js';
			$css_path = $bsf_core_url.'/assets/css/frosty.css';

			wp_register_script( 'bsf-core-frosty', $path );
			wp_enqueue_script( 'bsf-core-frosty' );

			wp_register_style( 'bsf-core-frosty-style', $css_path );
			wp_enqueue_style( 'bsf-core-frosty-style' );
		}
	}
}
if(is_multisite()) {
	add_action('admin_print_scripts', 'print_bsf_styles');
	if(!function_exists('print_bsf_styles')) {
		function print_bsf_styles() {
			global $bsf_core_path;
			$bsf_core_url = bsf_convert_core_path_to_relative($bsf_core_path);

			$path = $bsf_core_url.'/assets/fonts';

			echo "<style>
				@font-face {
					font-family: 'brainstorm';
					src:url('".$path."/brainstorm.eot');
					src:url('".$path."/brainstorm.eot') format('embedded-opentype'),
						url('".$path."/brainstorm.woff') format('woff'),
						url('".$path."/brainstorm.ttf') format('truetype'),
						url('".$path."/brainstorm.svg') format('svg');
					font-weight: normal;
					font-style: normal;
				}
				.toplevel_page_bsf-registration > div.wp-menu-image:before {
					content: \"\\e603\" !important;
					font-family: 'brainstorm' !important;
					speak: none;
					font-style: normal;
					font-weight: normal;
					font-variant: normal;
					text-transform: none;
					line-height: 1;
					-webkit-font-smoothing: antialiased;
					-moz-osx-font-smoothing: grayscale;
				}
			</style>";
		}
	}
}
?>