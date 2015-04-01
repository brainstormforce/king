<?php
// Alternative function for wp_remote_get
if(!function_exists('bsf_get_remote_version')) {
	function bsf_get_remote_version($products){
		
		global $bsf_product_validate_url;
		
		$path = base64_decode($bsf_product_validate_url);
		
		$data = array(
				'action' => 'bsf_get_product_versions',
				'ids' => $products
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
			
			if(!$result->error)
				return $result->updated_versions;
			else
				return $result->error;
		}
	}
}
if(!function_exists('bsf_check_product_update')) {
	function bsf_check_product_update(){
		$brainstrom_products = (get_option('brainstrom_products')) ? get_option('brainstrom_products') : array();
				
		$mix = $bsf_product_plugins = $bsf_product_themes = $registered = array();
	
		if(!empty($brainstrom_products)) :
			$bsf_product_plugins = (isset($brainstrom_products['plugins'])) ? $brainstrom_products['plugins'] : array();
			$bsf_product_themes = (isset($brainstrom_products['themes'])) ? $brainstrom_products['themes'] : array();
		endif;
		
		$mix = array_merge($bsf_product_plugins, $bsf_product_themes);
		
		$is_update = false;
				
		if(!empty($mix)) :
			foreach($mix as $key => $product) :
				$constant = strtoupper(str_replace('-', '_', $product['id']));
				$constant = 'BSF_'.$constant.'_CHECK_UPDATES';
				if(defined($constant) && (constant($constant) === 'false' || constant($constant) === false))
					continue;
				array_push($registered, $product['id']);
			endforeach;
		endif;

		if(!empty($registered)) 
		{
			$remote_versions = bsf_get_remote_version($registered);
			
			$brainstrom_bundled_products = (get_option('brainstrom_bundled_products')) ? get_option('brainstrom_bundled_products') : array();
	
			if($remote_versions !== false)
			{
				if(!empty($remote_versions)) 
				{
					$is_bundled_update = false;
					foreach($remote_versions as $rkey => $remote_data)
					{
						$rid = (string)$remote_data->id;
						$remote_version = $remote_data->remote_version;
						$in_house = $remote_data->in_house;
						$on_market = $remote_data->on_market;
						$is_product_free = $remote_data->is_product_free;
						if(!empty($bsf_product_plugins))
						{
							foreach($bsf_product_plugins as $key => $plugin) 
							{
								$pid = (string)$plugin['id'];
								if($pid === $rid)
								{
									$brainstrom_products['plugins'][$key]['remote'] = $remote_version;
									$brainstrom_products['plugins'][$key]['in_house'] = $in_house;
									$brainstrom_products['plugins'][$key]['on_market'] = $on_market;
									$brainstrom_products['plugins'][$key]['is_product_free'] = $is_product_free;
									$is_update = true;
								}
							}
						}
						if(!empty($bsf_product_themes))
						{
							foreach($bsf_product_themes as $key => $theme) 
							{
								$pid = $theme['id'];
								if($pid === $rid)
								{
									$brainstrom_products['themes'][$key]['remote'] = $remote_version;
									$brainstrom_products['themes'][$key]['in_house'] = $in_house;
									$brainstrom_products['themes'][$key]['on_market'] = $on_market;
									$brainstrom_products['themes'][$key]['is_product_free'] = $is_product_free;
									$is_update = true;
								}
							}
						}
						
						if(isset($remote_data->bundled_products) && !empty($remote_data->bundled_products)) {
							if(!empty($brainstrom_bundled_products)) {
								foreach($brainstrom_bundled_products as $bkey => $bp) {
									foreach($remote_data->bundled_products as $rbp) {
										if($rbp->id === $bp->id) {
											$brainstrom_bundled_products[$bkey]->remote = $rbp->remote_version;
											$brainstrom_bundled_products[$bkey]->parent = $rbp->parent;
											$is_bundled_update = true;
										}
									}
								}
							}
						}
					}
					if($is_bundled_update)
						update_option('brainstrom_bundled_products', $brainstrom_bundled_products);
				}
			}
		}
		
		if($is_update)
			update_option('brainstrom_products', $brainstrom_products);
		
		//new Ultimate_Auto_Update(ULTIMATE_VERSION, 'http://ec2-54-183-173-184.us-west-1.compute.amazonaws.com/updates/?'.time(), 'Ultimate_VC_Addons/Ultimate_VC_Addons.php');
	}
}
if(!defined('BSF_CHECK_PRODUCT_UPDATES'))
	$BSF_CHECK_PRODUCT_UPDATES = true;
else
	$BSF_CHECK_PRODUCT_UPDATES = BSF_CHECK_PRODUCT_UPDATES;

if((false === get_transient( 'bsf_check_product_updates') && ($BSF_CHECK_PRODUCT_UPDATES === true || $BSF_CHECK_PRODUCT_UPDATES === 'true') )) {
	echo 'Checking Updates<br/>';
	bsf_check_product_update();
	set_transient( 'bsf_check_product_updates', true, 12*60*60 );
}
if(!function_exists('get_bsf_product_upgrade_link')) {
	function get_bsf_product_upgrade_link($product) {
		$brainstrom_products = (get_option('brainstrom_products')) ? get_option('brainstrom_products') : array();
		
		$mix = $bsf_product_plugins = $bsf_product_themes = $registered = array();
	
		if(!empty($brainstrom_products)) :
			$bsf_product_plugins = (isset($brainstrom_products['plugins'])) ? $brainstrom_products['plugins'] : array();
			$bsf_product_themes = (isset($brainstrom_products['themes'])) ? $brainstrom_products['themes'] : array();
		endif;
		
		$mix = array_merge($bsf_product_plugins, $bsf_product_themes);
		
		$status = (isset($product['status'])) ? $product['status'] : '';
		$name = ($product['bundled']) ? $product['name'] : $product['product_name'];
		$free = ($product['is_product_free']) ? $product['is_product_free'] : false;
		
		$id = $product['id'];
		$original_id = $id;
		
		$not_registered_msg = 'Activate your licence for one click update.';

		if($product['bundled'])
		{
			$parent = $product['parent'];
			foreach($mix as $key => $bsf_p) {
				if($bsf_p['id'] === $parent) {
					$status = (isset($bsf_p['status'])) ? $bsf_p['status'] : '';
					$product_name = (isset($bsf_p['product_name'])) ? $bsf_p['product_name'] : '';
					$id = $parent;
					break;
				}
			}
			$not_registered_msg = 'This is bundled with '.$product_name.', Activate '.$product_name.'\'s licence for one click update.';
		}
		
		if(!$free) {		
			if($status === 'registered' || ($premium === 'false' || $premium === false))
			{
				$request = 'admin.php?page=bsf-registration&action=upgrade&id='.$original_id;
				if($product['bundled'])
					$request .= '&bundled='.$id;
				if(is_multisite())
					$link = '<a href="'.wp_nonce_url( network_admin_url($request)).'">'.__('Update '.$name.'.', 'bsf').'</a>';
				else
					$link = '<a href="'.wp_nonce_url( admin_url($request)).'">'.__('Update '.$name.'.', 'bsf').'</a>';
			}
			else
			{
				if(is_multisite())
					$link = '<a href="'.wp_nonce_url( network_admin_url('admin.php?page=bsf-registration&id='.$id)).'">'.__($not_registered_msg, 'bsf').'</a>';
				else
					$link = '<a href="'.wp_nonce_url( admin_url('admin.php?page=bsf-registration&id='.$id)).'">'.__($not_registered_msg, 'bsf').'</a>';
			}
		}
		else {
			$request = 'admin.php?page=bsf-registration&action=upgrade&id='.$original_id;
			if(is_multisite())
				$link = '<a href="'.wp_nonce_url( network_admin_url($request)).'">'.__('Update '.$name.'.', 'bsf').'</a>';
			else
				$link = '<a href="'.wp_nonce_url( admin_url($request)).'">'.__('Update '.$name.'.', 'bsf').'</a>';
		}
		return $link;
	}
}
add_action( 'core_upgrade_preamble', 'list_bsf_products_updates', 999 );
if(!function_exists('list_bsf_products_updates')) {
	function list_bsf_products_updates() {
		$brainstrom_products = (get_option('brainstrom_products')) ? get_option('brainstrom_products') : array();
		$brainstrom_bundled_products = (get_option('brainstrom_bundled_products')) ? get_option('brainstrom_bundled_products') : array();

		$mix_products = $update_ready = $bsf_product_plugins = $bsf_product_themes = $temp_bundled = array();
	
		if(!empty($brainstrom_products)) :
			$bsf_product_plugins = (isset($brainstrom_products['plugins'])) ? $brainstrom_products['plugins'] : array();
			$bsf_product_themes = (isset($brainstrom_products['themes'])) ? $brainstrom_products['themes'] : array();
		endif;
		
		$mix_products = array_merge($bsf_product_plugins, $bsf_product_themes);
		
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
				$type = (isset($brainstrom_bundled_products[$bundled_key]->type)) ? $brainstrom_bundled_products[$bundled_key]->type : 'plugin';
			}
			else
			{
				$version = (isset($product['version'])) ? $product['version'] : '';
				$remote = (isset($product['remote'])) ? $product['remote'] : '';
				$template = (isset($product['template'])) ? $product['template'] : '';
				$type = (isset($product['type'])) ? $product['type'] : '';
			}
			
			if($type === 'theme')
			{
				$product_abs_path = WP_CONTENT_DIR.'/themes/'.$template;
				if(!is_dir($product_abs_path))
					continue;
			}
			else
			{
				$product_abs_path = WP_PLUGIN_DIR.'/'.$template;
				if(!is_file($product_abs_path))
					continue;
			}
				
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
			if(!isset($bp->remote))
				continue;
				
			$temp = array();
			if(!in_array($bp->id, $temp_bundled)) {
				if(version_compare($bp->remote, $bp->version, '>')):
					$temp = (array)$bp;
					$temp['bundled'] = true;
					array_push($update_ready, $temp);
				endif;
			}
		}
		
		//die();
				
		echo '<h3 id="brainstormforce-products">Brainstorm Force - ' . __( 'Products', 'bsf' ) . '</h3>';
		
		if(!empty($update_ready)) :
			echo '<p>'. __( 'The following plugins from Brainstorm Force have new versions available.', 'bsf' ).'</p>';
			?>
            <table class="widefat" cellspacing="0" id="update-plugins-table">
                <thead>
                <tr>
                    <th scope="col" class="manage-column"><label><?php _e( 'Name', 'bsf' ); ?></label></th>
                    <th scope="col" class="manage-column"><label><?php _e( 'Installed Version', 'bsf' ); ?></label></th>
                    <th scope="col" class="manage-column"><label><?php _e( 'Latest Version', 'bsf' ); ?></label></th>
                    <th scope="col" class="manage-column"><label><?php _e( 'Actions', 'bsf' ); ?></label></th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th scope="col" class="manage-column"><label><?php _e( 'Name', 'bsf' ); ?></label></th>
                    <th scope="col" class="manage-column"><label><?php _e( 'Installed Version', 'bsf' ); ?></label></th>
                    <th scope="col" class="manage-column"><label><?php _e( 'Latest Version', 'bsf' ); ?></label></th>
                    <th scope="col" class="manage-column"><label><?php _e( 'Actions', 'bsf' ); ?></label></th>
                </tr>
                </tfoot>
                <tbody class="plugins">
					<?php
                    foreach($update_ready as $product) :
						$is_bundled = $product['bundled'];
						
						if($is_bundled)
						{
							if(!isset($product['init']))
								continue;
							if(trim($product['init']) === '' || $product['init'] === false)
								continue;
						}
						else
						{
							if(!isset($product['template']))
								continue;
							if(trim($product['template']) === '' || $product['template'] === false)
								continue;
						}
                    $upgradeLink = get_bsf_product_upgrade_link($product);
                    ?>
                        
                        <tr class='active'>
                            <td class='plugin-title'><strong><?php echo ($product['bundled']) ? $product['name'] : $product['product_name'] ?></strong><?php _e( 'You have version '.$product['version'].' installed. Update to '.$product['remote'], 'bsf' );?></td>
                            <td style='vertical-align:middle'><strong><?php echo __($product['version'], 'bsf'); ?></strong></td>
                            <td style='vertical-align:middle'><strong><?php echo __($product['remote'], 'bsf'); ?></strong></td>
                            <td style='vertical-align:middle'><?php echo $upgradeLink; ?></td>
                      	</tr>
                            
                    <?php
                    endforeach;
					?>
                </tbody>
            </table>
           	<?php
		else :
			echo '<p>' . __( 'Your plugins from Brainstorm Force are all up to date.', 'bsf' ) . '</p>';
		endif;
	}
}
?>