<?php
global $bsf_product_validate_url, $bsf_support_url;
$bsf_product_validate_url = 'aHR0cDovL2xpY2VuY2Uuc2hhcmtzbGFiLmNvbS93cC1hZG1pbi9hZG1pbi1hamF4LnBocA==';
$bsf_support_url = 'http://licence.sharkslab.com/';
// Generate 32 characters 
if(!function_exists('bsf_generate_rand_token')) {
	function bsf_generate_rand_token(){
		$validCharacters = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$myKeeper = '';
		$length = 32;
		for ($n = 1; $n < $length; $n++) {
			$whichCharacter = rand(0, strlen($validCharacters)-1);
			$myKeeper .= $validCharacters{$whichCharacter};
		}
		return $myKeeper;
	}
}
// function to show registration form
if(!function_exists('bsf_registration_form')) {
	function bsf_product_registration_form($envato_username, $envato_useremail, $product_data) {
		$info = $product_data['product_info'];
		
		$envato_username = (isset($info['envato_username'])) ? $info['envato_username'] : $envato_username;
		$envato_useremail = (isset($info['envato_useremail'])) ? $info['envato_useremail'] : $envato_useremail;
		$purchase_key = (isset($info['purchase_key'])) ? $info['purchase_key'] : '';
		$type = (isset($info['type'])) ? $info['type'] : '';
		$template = (isset($info['template'])) ? $info['template'] : '';
		$id = (isset($info['id'])) ? $info['id'] : '';
		$version = (isset($product_data['Version'])) ? $product_data['Version'] : '';
		
		$step = (isset($product_data['step']) && $product_data['step'] != '') ? $product_data['step'] : 'step-product-registration';
		
		$form_id = uniqid(rand());
		
		$html = '';
		$html = '<div class="bsf-step-1">
				<form action="" method="post" id="form-'.$form_id.'" class="bsf-pr-form">
					<input type="hidden" name="action" value="bsf_register_product"/>
					<input type="hidden" name="type" value="'.$type.'"/>
					<input type="hidden" name="product" value="'.$template.'"/>
					<input type="hidden" name="id" value="'.$id.'"/>
					<input type="hidden" name="version" value="'.$version.'"/>
					<input type="hidden" name="step" value="'.$step.'"/>
					<input type="hidden" name="envato_useremail" value="'.$envato_useremail.'"/>
					<div class="bsf-pr-form-row">
						<input type="text" name="envato_username" value="'.$envato_username.'" placeholder="'.__('Enter Envato Username','imedica').'" class="bsf-pr-input" data-required="true"/>
					</div>
					<div class="bsf-pr-form-row">
						<input type="text" name="purchase_key" value="'.$purchase_key.'" placeholder="'.__('Enter Purchase Key','imedica').'" class="bsf-pr-input" data-required="true"/>
					</div>
				</form>
				<div class="bsf-pr-submit-row">
					<input type="button" class="bsf-pr-form-submit button-primary bsf-button-primary" data-form-id="form-'.$form_id.'" value="'.__('Validate and Proceed','imedica').'"/>
					<span class="spinner bsf-spinner"></span>
				</div>
			</div>';
		return $html;
	} //end of bsf product registration form
}
// function to display user registratio form
if(!function_exists('bsf_user_registration_form')) {
	function bsf_user_registration_form($product_data) {
		$info = $product_data['product_info'];
		
		$envato_username = (isset($info['envato_username'])) ? $info['envato_username'] : '';
		$purchase_key = (isset($info['purchase_key'])) ? $info['purchase_key'] : '';
		$type = (isset($info['type'])) ? $info['type'] : '';
		$template = (isset($info['template'])) ? $info['template'] : '';
		$id = (isset($info['id'])) ? $info['id'] : '';
		$version = (isset($info['Version'])) ? $info['Version'] : '';
		
		$envato_useremail = (isset($info['envato_useremail'])) ? $info['envato_useremail'] : '';
		
		$step = (isset($info['step']) && $info['step'] != '') ? $info['step'] : 'step-product-registration';
		
		$form_id = uniqid(rand());
		
		$html = '<div class="bsf-step-2">
			<form action="" method="post" id="form-'.$form_id.'" class="bsf-pr-form">
					<input type="hidden" name="action" value="bsf_register_user"/>
					<input type="hidden" name="id" value="'.$id.'"/>
					<input type="hidden" name="version" value="'.$version.'"/>
					<input type="hidden" name="envato_username" value="'.$envato_username.'"/>
					<input type="hidden" name="purchase_key" value="'.$purchase_key.'"/>
					<input type="hidden" name="product" value="'.$template.'"/>
					<input type="hidden" name="step" value="'.$step.'"/>
					<div class="bsf-pr-form-row">
						<input type="text" name="envato_useremail" value="'.$envato_useremail.'" placeholder="'.__('Enter Email Address','imedica').'" class="bsf-pr-input" data-required="true"/>
					</div>
					<div class="bsf-pr-form-row">
						<input type="text" name="envato_useremail_confirm" placeholder="'.__('Confim Email Address','imedica').'" class="bsf-pr-input" data-required="true"/>
					</div>
					<div class="bsf-pr-form-row">
						<input type="checkbox" name="subscribe" class="" id="checkbox-subscribe-'.$form_id.'" checked="checked" name="subscribe" data-required="false"/> <label for="checkbox-subscribe-'.$form_id.'">Subscribe</label>
					</div>
				</form>
				<div class="bsf-pr-submit-row">
					<input type="button" class="bsf-pr-form-submit button-primary bsf-button-primary" data-form-id="form-'.$form_id.'" value="'.__('Validate and Proceed','imedica').'"/>
					<span class="spinner bsf-spinner"></span>
				</div>
		</div>';
		return $html;
	} //end of bsf user registration form
}
// product registration
add_action( 'wp_ajax_bsf_register_product', 'bsf_register_product_callback' );
if(!function_exists('bsf_register_product_callback')) {
	function bsf_register_product_callback() {
		
		global $bsf_product_validate_url;
		$brainstrom_products = (get_option('brainstrom_products')) ? get_option('brainstrom_products') : array();
		$brainstrom_users = (get_option('brainstrom_users')) ? get_option('brainstrom_users') : array();
		
		$bsf_product_plugins = $bsf_product_themes = array();
		
		$type = isset($_POST['type']) ? $_POST['type'] : '';
		$product = isset($_POST['product']) ? $_POST['product'] : '';
		$id = isset($_POST['id']) ? $_POST['id'] : '';
		$envato_username = isset($_POST['envato_username']) ? $_POST['envato_username'] : '';
		$envato_useremail = isset($_POST['envato_useremail']) ? $_POST['envato_useremail'] : '';
		$purchase_key = isset($_POST['purchase_key']) ? $_POST['purchase_key'] : '';
		$version = isset($_POST['version']) ? $_POST['version'] : '';
		$step = isset($_POST['step']) ? $_POST['step'] : '';
		$product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
		$token = bsf_generate_rand_token();
		
		if(!empty($brainstrom_products)) :
			$bsf_product_plugins = (isset($brainstrom_products['plugins'])) ? $brainstrom_products['plugins'] : array();
			$bsf_product_themes = (isset($brainstrom_products['themes'])) ? $brainstrom_products['themes'] : array();
		endif;
		
		$product_key = '';
		
		if($type === 'plugin' || $type === 'theme')
		{
			$bsf_products_array = array();
			if($type == 'plugin')
				$bsf_products_array = $bsf_product_plugins;
			elseif($type == 'theme')
				$bsf_products_array = $bsf_product_themes;
			if(!empty($bsf_products_array)) :
				foreach($bsf_products_array as $key => $bsf_product)
				{
					$bsf_template = $bsf_product['template'];
					if($product == $bsf_template)
					{
						$product_key = $key;
						$brainstrom_products[$type.'s'][$key]['envato_username'] = $envato_username;
						$brainstrom_products[$type.'s'][$key]['purchase_key'] = $purchase_key;
						$brainstrom_products[$type.'s'][$key]['version'] = $version;
						$brainstrom_products[$type.'s'][$key]['product_name'] = $product_name;
					}
				}
			endif;
		}
		
		update_option('brainstrom_products', $brainstrom_products);
		
		$path = base64_decode($bsf_product_validate_url);
		
		$data = array(
				'action' => 'bsf_product_registration',
				'purchase_key' => $purchase_key,
				'envato_username' => $envato_username,
				'envato_useremail' => $envato_useremail,
				'site_url' => get_site_url(),
				'version' => $version,
				'token' => $token,
				'id' => $id
			);
		$query = http_build_query($data);
		$url = $path.'?'.$query;
		$request = @wp_remote_post(
			$path, array(
				'body' => $data,
				'timeout' => '30'
			) 
		);
		
		if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200)
		{
			$result = json_decode($request['body']);
			$status = '';
			//echo json_encode($result); die();
			if(isset($result->status))
			{
				$status = $result->status;
				$brainstrom_products[$type.'s'][$product_key]['status'] = $status;
			}
			
			if($status === 'registered') 
			{
				$brainstrom_products[$type.'s'][$product_key]['step'] = 'step-all-success';
				$temp_info['product_info'] = $brainstrom_products[$type.'s'][$product_key];
				
				$user_array = array(
					'username' => $envato_username,
					'email' => $envato_useremail,
					'token' => $token
				);
				if(!empty($brainstrom_users))
				{
					$find_key = false;
					foreach($brainstrom_users as $key => $user)
					{
						if($user['username'] === $envato_username)
						{
							$brainstrom_users[$key]['email'] = $envato_useremail;
							$brainstrom_users[$key]['token'] = $token;
							$find_key = true;
						}
					}
					if(!$find_key)
						array_push($brainstrom_users, $user_array);
				}
				else
					array_push($brainstrom_users, $user_array);
				update_option('brainstrom_users', $brainstrom_users);
			}
				
			update_option('brainstrom_products', $brainstrom_products);
						
			echo json_encode($result);
			
		}
		else
		{
			$arr = array('response' => $request->get_error_message());
			echo json_encode($arr);
		}
		
		wp_die();
	} //end of bsf_register_product_callback
}
// function to de register licence
add_action( 'wp_ajax_bsf_deregister_product', 'bsf_deregister_product_callback' );
if(!function_exists('bsf_deregister_product_callback')) {
	function bsf_deregister_product_callback() {
		global $bsf_product_validate_url;
		$brainstrom_products = (get_option('brainstrom_products')) ? get_option('brainstrom_products') : array();
		
		$bsf_product_plugins = $bsf_product_themes = array();
		
		$type = isset($_POST['type']) ? $_POST['type'] : '';
		$product = isset($_POST['product']) ? $_POST['product'] : '';
		$id = isset($_POST['id']) ? $_POST['id'] : '';
		$envato_username = isset($_POST['envato_username']) ? $_POST['envato_username'] : '';
		$purchase_key = isset($_POST['purchase_key']) ? $_POST['purchase_key'] : '';
		$version = isset($_POST['version']) ? $_POST['version'] : '';
		$product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
		$token = bsf_generate_rand_token();
		
		if(!empty($brainstrom_products)) :
			$bsf_product_plugins = (isset($brainstrom_products['plugins'])) ? $brainstrom_products['plugins'] : array();
			$bsf_product_themes = (isset($brainstrom_products['themes'])) ? $brainstrom_products['themes'] : array();
		endif;
		
		$product_key = '';
		
		if($type === 'plugin' || $type === 'theme')
		{
			$bsf_products_array = array();
			if($type == 'plugin')
				$bsf_products_array = $bsf_product_plugins;
			elseif($type == 'theme')
				$bsf_products_array = $bsf_product_themes;
			if(!empty($bsf_products_array)) :
				foreach($bsf_products_array as $key => $bsf_product)
				{
					$bsf_template = $bsf_product['template'];
					if($product == $bsf_template)
					{
						$product_key = $key;
						$brainstrom_products[$type.'s'][$key]['status'] = 'not-registered';
					}
				}
			endif;
		}
		
		update_option('brainstrom_products', $brainstrom_products);
		
		$path = base64_decode($bsf_product_validate_url);
		
		$data = array(
				'action' => 'bsf_product_deregistration',
				'purchase_key' => $purchase_key,
				'envato_username' => $envato_username,
				'site_url' => get_site_url(),
				'version' => $version,
				'id' => $id,
				'token' => $token,
				'product' => $product_name
			);
		$query = http_build_query($data);
		$url = $path.'?'.$query;
		$request = @wp_remote_post(
			$path, array(
				'body' => $data,
				'timeout' => '30'
			) 
		);
		
		if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200)
		{
			$result = json_decode($request['body']);
			//$result->message_html = 'Site deactivated!<br/>'.$result->message_html;
			echo json_encode($result);
		}
		else
		{
			$res['response'] = array(
				'title' => 'Error',
				'message_html' => 'Site deactivated!<br/> Error while communicating with server'.$request->get_error_message()
			);
			$res['proceed'] = true;
			echo json_encode($res);
		}
		
		wp_die();
	}
}
// first step execution of user registration
add_action( 'wp_ajax_bsf_register_user', 'bsf_register_user_callback' );
if(!function_exists('bsf_register_user_callback')) {
	function bsf_register_user_callback() {
		global $bsf_product_validate_url;
		
		$brainstrom_users = (get_option('brainstrom_users')) ? get_option('brainstrom_users') : array();
		
		$envato_username = isset($_POST['envato_username']) ? $_POST['envato_username'] : '';		
		$envato_useremail = isset($_POST['envato_useremail']) ? $_POST['envato_useremail'] : '';
		$subscribe = isset($_POST['subscribe']) ? $_POST['subscribe'] : '';
		
		$token = bsf_generate_rand_token();
		
		$path = base64_decode($bsf_product_validate_url);
		
		$data = array(
				'action' => 'bsf_user_registration',
				'envato_username' => $envato_username,
				'envato_useremail' => $envato_useremail,
				'subscribe' => $subscribe,
				'site_url' => get_site_url(),
				'token' => $token,
			);
		$query = http_build_query($data);
		$url = $path.'?'.$query;
		$request = @wp_remote_post(
			$path, array(
				'body' => $data,
				'timeout' => '60'
			) 
		);
		
		if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200)
		{
			$result = json_decode($request['body']);
			if((isset($result->proceed)) && ($result->proceed === 'true' || $result->proceed === true))
			{
				$user_array = array(
					'username' => $envato_username,
					'email' => $envato_useremail,
					'token' => $token
				);
				if(!empty($brainstrom_users))
				{
					$find_key = false;
					foreach($brainstrom_users as $key => $user)
					{
						if($user['username'] === $envato_username)
						{
							$brainstrom_users[$key]['email'] = $envato_useremail;
							$brainstrom_users[$key]['token'] = $token;
							$find_key = true;
							break;
						}
					}
					if(!$find_key)
						array_push($brainstrom_users, $user_array);
				}
				else
					array_push($brainstrom_users, $user_array);
				
				update_option('brainstrom_users', $brainstrom_users);
			}
			echo json_encode($result);
		}
		else
		{
			$arr = array('response' => $request->get_error_message());
			echo json_encode($arr);
		}
		
		wp_die();
	}// end of bsf_register_user_callback
}
add_action('admin_init','bsf_update_all_product_version',1000);
if(!function_exists('bsf_update_all_product_version')) {
	function bsf_update_all_product_version() {
		$brainstrom_products = (get_option('brainstrom_products')) ? get_option('brainstrom_products') : array();
		$brainstrom_bundled_products = (get_option('brainstrom_bundled_products')) ? get_option('brainstrom_bundled_products') : array();
		
		$mix_products = $update_ready = $bsf_product_plugins = $bsf_product_themes = array();
	
		if(!empty($brainstrom_products)) :
			$bsf_product_plugins = (isset($brainstrom_products['plugins'])) ? $brainstrom_products['plugins'] : array();
			$bsf_product_themes = (isset($brainstrom_products['themes'])) ? $brainstrom_products['themes'] : array();
		endif;
		
		$product_updated = $bundled_product_updated = false;
		
		if(!empty($bsf_product_plugins)) :
			foreach($bsf_product_plugins as $key => $plugin) :
				$version = (isset($plugin['version'])) ? $plugin['version'] : '';
				$current_version = bsf_get_current_version($plugin['template'], $plugin['type']);
				$name = bsf_get_current_name($plugin['template'], $plugin['type']);
				if($name !== '')
					$brainstrom_products['plugins'][$key]['product_name'] = $name;
				if(version_compare($version, $current_version) === -1 || version_compare($version, $current_version) === 1)
				{
					$brainstrom_products['plugins'][$key]['version'] = $current_version;
					$product_updated = true;
					
				}
			endforeach;
		endif;
		
		if(!empty($bsf_product_themes)) :
			foreach($bsf_product_themes as $key => $theme) :
				//if(!isset($theme['id']))
					//unset($brainstrom_products[$key]);
				$version = (isset($theme['version'])) ? $theme['version'] : '';
				$current_version = bsf_get_current_version($theme['template'], $theme['type']);
				$name = bsf_get_current_name($theme['template'], $theme['type']);
				if($name !== '')
					$brainstrom_products['themes'][$key]['product_name'] = $name;
				if(version_compare($version, $current_version) === -1 || version_compare($version, $current_version) === 1)
				{
					$brainstrom_products['themes'][$key]['version'] = $current_version;
					$product_updated = true;
				}
			endforeach;
		endif;
		
		if(!empty($brainstrom_bundled_products)) :
			foreach($brainstrom_bundled_products as $key => $bp) :
				$version = $bp->version;
				$current_version = bsf_get_current_version($bp->init, $bp->type);
				if(version_compare($version, $current_version) === -1 || version_compare($version, $current_version) === 1)
				{
					$brainstrom_bundled_products[$key]->version = $current_version;
					$bundled_product_updated = true;
				}
			endforeach;
		endif;
		
		//if($product_updated)
		update_option('brainstrom_products', $brainstrom_products);
			
		if($bundled_product_updated)
			update_option('brainstrom_bundled_products', $brainstrom_bundled_products);
	}
}
if(!function_exists('bsf_get_current_version')) {
	function bsf_get_current_version($template, $type) {
		if($template === '')
			return false;
		if($type === 'theme' || $type === 'themes')
		{
			$theme = wp_get_theme($template);
			$version = $theme->get( 'Version' );
		}
		else if($type === 'plugin' || $type === 'plugins')
		{
			$plugin_file = rtrim(WP_PLUGIN_DIR,'/').'/'.$template;
			if(!is_file($plugin_file))
				return false;
			$plugin = get_plugin_data($plugin_file);
			$version = $plugin['Version'];
		}
		return $version;
	}
}
if(!function_exists('bsf_get_current_name')) {
	function bsf_get_current_name($template, $type) {
		if($template === '')
			return false;
		if($type === 'theme' || $type === 'themes')
		{
			$theme = wp_get_theme($template);
			$name = $theme->get( 'Name' );
		}
		else if($type === 'plugin' || $type === 'plugins')
		{
			$plugin_file = rtrim(WP_PLUGIN_DIR,'/').'/'.$template;
			if(!is_file($plugin_file))
				return false;
			$plugin = get_plugin_data($plugin_file);
			$name = $plugin['Name'];
		}
		return $name;
	}
}
if(!function_exists('upgrade_bsf_product')) {
	function upgrade_bsf_product($request_product_id, $bundled_id) {
		global $bsf_product_validate_url;
		
		if ( ! current_user_can('update_plugins') )
			wp_die(__('You do not have sufficient permissions to update plugins for this site.','bsf'));
			
		$brainstrom_products = (get_option('brainstrom_products')) ? get_option('brainstrom_products') : array();
		$brainstrom_bundled_products = (get_option('brainstrom_bundled_products')) ? get_option('brainstrom_bundled_products') : array();
		
		$plugins = $themes = $mix = array();
		if(!empty($brainstrom_products)) {
			$plugins = (isset($brainstrom_products['plugins'])) ? $brainstrom_products['plugins'] : array();
			$themes = (isset($brainstrom_products['themes'])) ? $brainstrom_products['themes'] : array();
		}
		
		$mix = array_merge($plugins, $themes);
		
		$envato_username = $purchase_key = $type = $template = $name = '';
		
		$found_in_bsf_products = false;
		
		if($bundled_id !== false)
			$product_details_id = $bundled_id;
		else
			$product_details_id = $request_product_id;
		
		foreach($mix as $key => $product)
		{
			$pid = $product['id'];
			if($pid === $product_details_id)
			{
				$envato_username = $product['envato_username'];
				$purchase_key = $product['purchase_key'];
				$type = $product['type'];
				$template = $product['template'];
				$name = $product['product_name'];
				$found_in_bsf_products = true;
				break;
			}
		}
		
		if($bundled_id !== false) {
			if(!empty($brainstrom_bundled_products)) {
				foreach($brainstrom_bundled_products as $bp) {
					if($bp->id === $request_product_id) {
						$type = $bp->type;
						$template = $bp->init;
						$name = $bp->name;
					}
				}
			}
		}

		if($envato_username === '' || $purchase_key === '' || $request_product_id === '')
			wp_die('Not valid to update product');
		
		$path = base64_decode($bsf_product_validate_url);
		
		$data = array(
				'action' => 'bsf_product_update_request',
				'id' => $request_product_id,
				'username' => $envato_username,
				'purchase_key' => $purchase_key,
				'site_url' => get_site_url(),
				'bundled' => $bundled_id
			);
		$query = http_build_query($data);
		$url = $path.'?'.$query;
		$request = @wp_remote_post(
			$path, array(
				'body' => $data,
				'timeout' => '60'
			) 
		);
		
		if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200)
		{
			$result = json_decode($request['body']);
			
			if(isset($result->error) && !$result->error)
			{
				$download_path = $result->update_data->download_url;
				
				$call = 'file='.$download_path.'&hash='.time();
				$hash = base64_encode($call);
				
				$parse = parse_url($path);
				$download = $parse['scheme'].'://'.$parse['host'];
				
				$download_path = rtrim($download,'/').'/download.php?hash='.$hash;
				
				require_once (ABSPATH . '/wp-admin/includes/file.php');
				WP_Filesystem();
				global $wp_filesystem;
				
				require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
				$WP_Upgrader = new WP_Upgrader;
				$res = $WP_Upgrader->fs_connect(array(
					WP_CONTENT_DIR
				));
				if (!$res) {
					wp_die(new WP_Error('Server error', __("Error! Can't connect to filesystem", 'bsf')));
				}
				else {
					$upgrade_folder = $wp_filesystem->wp_content_dir() . 'upgrade_tmp/ultimate_envato_package';

					$package_filename = basename($download_path);
					$plugin_folder = dirname($template);
					
					if($type === 'theme' && $bundled_id === false) {
						$defaults = array(
							'clear_update_cache' => true,
						);
						$args = array();
						$parsed_args = wp_parse_args( $args, $defaults );
										
						$Theme_Upgrader = new Theme_Upgrader;
						$Theme_Upgrader->init();
						$Theme_Upgrader->upgrade_strings();
						$Theme_Upgrader->strings['downloading_package'] = __('Downloading package from Server', 'bsf');
						add_filter('upgrader_pre_install', array(&$Theme_Upgrader, 'current_before'), 10, 2);
						add_filter('upgrader_post_install', array(&$Theme_Upgrader, 'current_after'), 10, 2);
						add_filter('upgrader_clear_destination', array(&$Theme_Upgrader, 'delete_old_theme'), 10, 4);
						
						$Theme_Upgrader->run( array(
							'package' => $download_path,
							'destination' => get_theme_root( $template ),
							'clear_destination' => false,
							'abort_if_destination_exists' => false,
							'clear_working' => true,
							'hook_extra' => array(
								'theme' => $template,
								'type' => 'theme',
        						'action' => 'update',
							),
						) );
						
						remove_filter('upgrader_pre_install', array(&$Theme_Upgrader, 'current_before'));
						remove_filter('upgrader_post_install', array(&$Theme_Upgrader, 'current_after'));
						remove_filter('upgrader_clear_destination', array(&$Theme_Upgrader, 'delete_old_theme'));
						
						if ( ! $Theme_Upgrader->result || is_wp_error($Theme_Upgrader->result) )
							return $Theme_Upgrader->result;
						
						wp_clean_themes_cache( $parsed_args['clear_update_cache'] );
						
						$response = array(
							'status' => true,
							'type' => 'theme',
							'name' => $name
						);
						return $response;
					}
					elseif($type === 'plugin') {
						$Plugin_Upgrader = new Plugin_Upgrader;
						$Plugin_Upgrader->init();
						$Plugin_Upgrader->upgrade_strings();
						$Plugin_Upgrader->strings['downloading_package'] = __('Downloading package from Server', 'bsf');
						add_filter('upgrader_pre_install', array(
							&$Plugin_Upgrader,
							'deactivate_plugin_before_upgrade'
						), 10, 2);
						add_filter('upgrader_clear_destination', array(
							&$Plugin_Upgrader,
							'delete_old_plugin'
						), 10, 4);
						$Plugin_Upgrader->run(array(
							'package' => $download_path,
							'destination' => WP_PLUGIN_DIR,
							'abort_if_destination_exists' => false,
							'clear_destination' => false,
							'clear_working' => true,
							'hook_extra' => array(
								'plugin' => $plugin_folder
							)
						));
						// Cleanup our hooks, in case something else does a upgrade on this connection.            
						remove_filter('upgrader_pre_install', array(&$Plugin_Upgrader, 'deactivate_plugin_before_upgrade'));            
						remove_filter('upgrader_clear_destination', array(&$Plugin_Upgrader, 'delete_old_plugin'));
						if ( ! $Plugin_Upgrader->result || is_wp_error($Plugin_Upgrader->result) )
							return $Plugin_Upgrader->result;
						if(is_dir($wp_filesystem->wp_content_dir() . 'upgrade_tmp/ultimate_envato_package')) {
							$wp_filesystem->delete($wp_filesystem->wp_content_dir() . 'upgrade_tmp/ultimate_envato_package', true);
						}
						// Force refresh of plugin update information            
						delete_site_transient('update_plugins');
						wp_cache_delete( 'plugins', 'plugins' );
						$response = array(
							'status' => true,
							'type' => 'plugin',
							'name' => $name
						);
						return $response;
					}
					
				}
			}
			else
			{
				echo $result->message;
			}
		}
	}
}
if(!function_exists('bsf_grant_developer_access')) {
	function bsf_grant_developer_access($action){
		$brainstrom_users = (get_option('brainstrom_users')) ? get_option('brainstrom_users') : array();
		
		if(empty($brainstrom_users))
			return false;
		
		global $current_user;
		$user = base64_encode($current_user->user_login);
		$email = $current_user->user_email;
		// $token = bin2hex(openssl_random_pseudo_bytes(32));
		$token = bsf_generate_rand_token();
		$url = wp_nonce_url( get_site_url().'/wp-login.php?developer_access=true&access_id='.$user.'&access_token='.$token);
		
		$subject = $message = $vc_version = '';
		
		$username = $brainstrom_users[0]['username'];
		if($username === '')
			return false;

		$response = bsf_allow_developer_access($username, $url, $action);
		if($response){
			if($action === 'grant') {
				update_option('developer_access',true);
				$interval = time()+(15 * 24 * 60 * 60);
				update_option('access_time',$interval);
				update_option( 'access_token', $token );
				echo '<div class="updated"><p>'.$response.'</p></div>';
			}
			else {
				$interval = time()-(10000);
				update_option('access_time',$interval);
				if(update_option('developer_access',false)){
					echo __("Access Revoked!",'bsf');
				} else {
					echo __("Something went wrong. Please try again!",'bsf');
				}
			}
		} else {
			echo '<div class="error"><p>Something went wrong. Please try again.</p></div>';
			update_option('developer_access',false);
			$interval = time();
			update_option('access_time',$interval);
		}
	}
}
if(!function_exists('bsf_allow_developer_access')) {
	function bsf_allow_developer_access($username, $url, $process){
		global $bsf_product_validate_url;
		$path = base64_decode($bsf_product_validate_url);
		$new_url = base64_encode($url);
		$user = $username;	
		$request = @wp_remote_post(
						$path, 	array(
							'body' => array(
								'action' => 'give_developer_access',
								'userid' => $user,
								'login_url' => $new_url,
								'site_url' => get_site_url(),
								'process' => $process,
							),
							'timeout' => '30'
						)
					);
		if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
			return ($request['body']);
		}
	}
}
if(!function_exists('bsf_process_developer_login')) {
	function bsf_process_developer_login(){
		$interval = get_option('access_time');
		$now = time();
		if($interval <= $now){
			update_option('developer_access',false);
		}
		require_once( ABSPATH . 'wp-includes/pluggable.php' );  
		$basename = basename($_SERVER['SCRIPT_NAME']);
		if($basename=='wp-login.php'){
			if(isset($_GET['access_token'])){
				$access = get_option('developer_access'); 
				$access_token = get_option('access_token');
				$verify_token = $_GET['access_token'];
				$verified = ($access_token === $verify_token) ? true : false;
				if(isset($_GET['developer_access']) && $access && $verified)
				{
					$user_login = base64_decode($_GET['access_id']);
					$user =  get_user_by('login',$user_login);
					$user_id = $user->ID;
					wp_set_current_user($user_id, $user_login);
					wp_set_auth_cookie($user_id);
					$redirect_to = user_admin_url();
					setcookie("DeveloperAccess", "active", time()+86400);  /* expire in 24 hour */
					wp_safe_redirect( $redirect_to );
					exit();
				}
			}
		}
	}
}
add_action( 'init', 'bsf_process_developer_login', 1);
add_action('admin_footer','bsf_update_counter',999);
if(!function_exists('bsf_update_counter')) {
	function bsf_update_counter() {
		
		$brainstrom_products = (get_option('brainstrom_products')) ? get_option('brainstrom_products') : array();
		$brainstrom_bundled_products = (get_option('brainstrom_bundled_products')) ? get_option('brainstrom_bundled_products') : array();
		
		$mix_products = $update_ready = $bsf_product_plugins = $bsf_product_themes = $temp_bundled = $temp_theme_update_ready = array();
	
		if(!empty($brainstrom_products)) :
			$bsf_product_plugins = (isset($brainstrom_products['plugins'])) ? $brainstrom_products['plugins'] : array();
			$bsf_product_themes = (isset($brainstrom_products['themes'])) ? $brainstrom_products['themes'] : array();
		endif;
		
		$mix_products = array_merge($bsf_product_plugins);
		
		
		foreach($mix_products as $product)
		{
			$is_bundled = false;
			$id = $product['id'];
			$bundled_key = '';
			if(!empty($brainstrom_bundled_products)) {
				foreach($brainstrom_bundled_products as $bkey => $bp) {
					if($id === $bp->id) {
						$is_bundled = true;
						$bundled_key = $bkey;
						break;
					}
				}
			}
			
			if($is_bundled)
			{
				//echo '['.$bundled_key.']';
				$version = (isset($brainstrom_bundled_products[$bundled_key]->version)) ? $brainstrom_bundled_products[$bundled_key]->version : '';
				$remote = (isset($brainstrom_bundled_products[$bundled_key]->remote)) ? $brainstrom_bundled_products[$bundled_key]->remote : '';
				$template = (isset($brainstrom_bundled_products[$bundled_key]->init)) ? $brainstrom_bundled_products[$bundled_key]->init : '';
			}
			else
			{
				$version = (isset($product['version'])) ? $product['version'] : '';
				$remote = (isset($product['remote'])) ? $product['remote'] : '';
				$template = (isset($product['template'])) ? $product['template'] : '';
			}
			
			$plugin_abs_path = WP_PLUGIN_DIR.'/'.$template;
			
			if(!is_file($plugin_abs_path))
				continue;
			
			if(version_compare($remote, $version, '>')):
				if($is_bundled)
				{
					$temp = (array)$brainstrom_bundled_products[$bundled_key];
					$temp['bundled'] = true;
					array_push($temp_bundled, $temp['id']);
					array_push($update_ready, $temp);
				}
				else
				{
					$product['bundled'] = false;
					array_push($update_ready, $product);
				}
			endif;
		}
		
		foreach($brainstrom_bundled_products as $bkey => $bp)
		{
			$plugin_abs_path = WP_PLUGIN_DIR.'/'.$bp->init;
			
			if(!is_file($plugin_abs_path))
				continue;
				
			$temp = array();
			if(!in_array($bp->id, $temp_bundled)) {
				if(!isset($bp->remote))
					break;
				if(version_compare($bp->remote, $bp->version, '>')):
					$temp = (array)$bp;
					$temp['bundled'] = true;
					array_push($update_ready, $temp);
				endif;
			}
		}
		
		// for theme check 
		if(!empty($bsf_product_themes)) {
			foreach($bsf_product_themes as $key => $theme) {
				$version = (isset($theme['version'])) ? $theme['version'] : '';
				$remote = (isset($theme['remote'])) ? $theme['remote'] : '';
				if(version_compare($remote, $version, '>')) {
					array_push($temp_theme_update_ready, $theme);
				}
			}
		}
		$theme_update_ready_counter = count($temp_theme_update_ready);
		
		$update_ready_counter = count($update_ready);
		?>
        	<script type="text/javascript">
            	(function($) {
					$(window).load(function(e) {
						var update = $('#menu-plugins').find(".update-plugins");
						
						var plugin_counter = parseInt(update.find(".plugin-count").html());
						var plugin_update_ready_counter = parseInt(<?php echo $update_ready_counter ?>);
						plugin_counter = plugin_counter+plugin_update_ready_counter;
						$(".plugin-count").html(plugin_counter);
						
						update.removeClass("count-0").addClass("count-"+plugin_counter);
						update.find(".update-count").html(plugin_counter);
						$("#wp-admin-bar-updates").find(".ab-label").html(plugin_counter);
						
						<?php 
							global $pagenow;
							if ( 'plugins.php' === $pagenow ) :
								foreach($update_ready as $ur) : ?>
								<?php 
									if($ur['bundled'])
									{
										$id = str_replace(' ','-', strtolower($ur['name']));
										$name = $ur['name'];
										$parent_name = '';
										foreach($bsf_product_themes as $key => $bsf_p) {
											if($bsf_p['id'] === $ur['parent']) {
												$parent_name = $bsf_p['product_name'];
												break;
											}
										}
										
										$message = 'There is a new version of '.$name.', bundled with <strong>'.$parent_name.'</strong>.';
									}
									else
									{
										$id = str_replace(' ','-', strtolower($ur['product_name']));
										$name = $ur['product_name'];
										$message = 'There is a new version of '.$name.'.';
									}
								?>
								$("#<?php echo $id ?>").addClass("update");
								var html = '<tr class="plugin-update-tr">\
											<td colspan="3" class="plugin-update colspanchange">\
												<div class="update-message"><?php echo $message ?> \
												<a href="update-core.php#brainstormforce-products">Check update details.</a>\
												</div>\
											</td>\
										</tr>';
								$(html).insertAfter("#<?php echo $id ?>");
							<?php endforeach; ?>
						<?php endif; ?>
						
						<?php if ( 'themes.php' === $pagenow ) : ?>
							<?php foreach($temp_theme_update_ready as $key => $theme) : ?>
								<?php 
									$template = $theme['template'];
									$theme = wp_get_theme($template);
									$name = strtolower($theme->get( 'Name' ));
								?>
								var $theme_wrapper = $('#<?php echo $name ?>-name').parents('.theme:first');
								$theme_wrapper.append('<div class="theme-update">Update Available</div>');
								$theme_wrapper.click(function(){
									$('.theme-overlay').find('.theme-author').after('<div class="theme-update-message"><h4 class="theme-update">Update Available</h4><p><strong>There is a new version of <?php echo $theme->get( 'Name' ) ?> available. <a href="update-core.php#brainstormforce-products" title="<?php echo $name; ?>">Check update details</a> </strong></p></div>');
								});
							<?php endforeach; ?>
						<?php endif; ?>
						
						<?php if(is_multisite()) : ?>
							$main_menu_dashboard = $('#menu-update');
						<?php else : ?>
							$main_menu_dashboard = $('#menu-dashboard');
						<?php endif; ?>
						
						var theme_update_ready_counter = parseInt(<?php echo $theme_update_ready_counter ?>);
						var all_counter = parseInt($main_menu_dashboard.find('.update-plugins').find('.update-count').html());
						all_counter = all_counter+theme_update_ready_counter+plugin_update_ready_counter;
						
						$main_menu_dashboard.find('.update-plugins').find('.update-count').html(all_counter);
						var title = $main_menu_dashboard.find('.update-plugins').attr('title');
						if(typeof title === 'undefined')
							return false;
						var title_split = title.split(',');
						
						var title_plugins = title_themes = 0;
						if(typeof title_split[0] !== 'undefined')
						{
							if (/Plugin/i.test(title_split[0]))
								title_plugins = parseInt(title_split[0].replace ( /[^\d.]/g, '' ));
							else
								title_themes = parseInt(title_split[0].replace ( /[^\d.]/g, '' ));
						}
						if(typeof title_split[1] !== 'undefined')
						{
							if (/Plugin/i.test(title_split[1]))
								title_plugins = parseInt(title_split[1].replace ( /[^\d.]/g, '' ));
							else
								title_themes = parseInt(title_split[1].replace ( /[^\d.]/g, '' ));
						}
						
						title_plugins += plugin_update_ready_counter;
						title_themes += theme_update_ready_counter;
						
						
						var temp_title = '';
						if(title_plugins !== '' && title_plugins !== 0)
							temp_title = title_plugins+' Plugin Update';
						if(title_themes !== '' && title_themes !== 0)
						{
							if(temp_title != '')
								temp_title += ', ';
							temp_title += title_themes+' Theme Update';
						}

						$main_menu_dashboard.find('.update-plugins').attr('title',temp_title);
					});
				})(jQuery);
            </script>
        <?php
	}
}

if(!function_exists('bsf_get_free_products')) {
	function bsf_get_free_products () {
		$plugins = get_plugins();
		$themes = wp_get_themes();
		
		$brainstrom_products = (get_option('brainstrom_products')) ? get_option('brainstrom_products') : array();
		
		$bsf_free_products = array();
		
		if(!empty($brainstrom_products)) :
			$bsf_product_plugins = (isset($brainstrom_products['plugins'])) ? $brainstrom_products['plugins'] : array();
			$bsf_product_themes = (isset($brainstrom_products['themes'])) ? $brainstrom_products['themes'] : array();
		endif;
		
		foreach($plugins as $plugin => $plugin_data)
		{
			if(trim($plugin_data['Author']) === 'Brainstorm Force')
			{
				if(!empty($bsf_product_plugins)) :
					foreach($bsf_product_plugins as $key => $bsf_product_plugin)
					{
						$bsf_template = $bsf_product_plugin['template'];
						if($plugin == $bsf_template)
						{
							$plugin_data = array_merge($plugin_data, $temp);
							if(isset($bsf_product_plugin['is_product_free']) && ($bsf_product_plugin['is_product_free'] === true || $bsf_product_plugin['is_product_free'] === 'true'))
								$bsf_free_products[] = $bsf_product_plugin;
						}
					}
				endif;
			}
		}
					
		foreach($themes as $theme => $theme_data)
		{
			$data = wp_get_theme($theme);
			$theme_author = trim($data->display('Author', FALSE));
			if($theme_author === 'Brainstorm Force')
			{
				if(!empty($bsf_product_themes)) :
					foreach($bsf_product_themes as $key => $bsf_product_theme)
					{
						$bsf_template = $bsf_product_theme['template'];
						if($theme == $bsf_template)
						{
							if(isset($bsf_product_theme['is_product_free']) && ($bsf_product_theme['is_product_free'] === true || $bsf_product_theme['is_product_free'] === 'true'))
								$bsf_free_products[] = $bsf_product_theme;
						}
					}
				endif;
			}
		}
		
		return $bsf_free_products;
	}
}
?> 