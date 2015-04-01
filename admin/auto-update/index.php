<?php
	$bsf_free_products = bsf_get_free_products();
	$total_free = count($bsf_free_products);
	
	$brainstrom_products_counter = (get_option('brainstrom_products')) ? count(get_option('brainstrom_products')) : count(array());
	if($brainstrom_products_counter == 1 && $total_free == 1)
	{
		?>
        	<div class="bsf-overlay">
            	<div class="bsf-message bsf-pr-header">
                	<h2><?php echo __('Registration is not necessary for '.$bsf_free_products[0]['product_name']) ?></h2>
                    <div class="bsf-pr-decription"><?php echo __('You will automatically get updates for this product.','bsf') ?></div>
            	</div>
        	</div>
        <?php 	
	}
	
	
?>
<?php
	$tab = '';
	$request_product_id = (isset($_GET['id'])) ? $_GET['id'] : '';
	
	$updgrate_action = (isset($_GET['action']) && $_GET['action']==='upgrade') ? $_GET['action'] : '';
	if($updgrate_action === 'upgrade')
	{
		$request_product_id = (isset($_GET['id'])) ? $_GET['id'] : '';
		if($request_product_id !== '')
		{
			if(isset($_GET['bundled']) && $_GET['bundled'] !== '')
				$bundled = $_GET['bundled'];
			else
				$bundled = false;
			?>
            	<div class="clear"></div>
				<div class="wrap">
                	<h2><?php echo __('Upgrading Extension','bsf') ?></h2>
					<?php
                    $response = upgrade_bsf_product($request_product_id, $bundled);
					?>
                    <?php 
						if(isset($response['status']) && $response['status']) :
							$url = ($response['type'] === 'theme') ? 'themes.php' : 'plugins.php';
							$txt = ($response['type'] === 'theme') ? 'theme' : 'plugin';
							$name = (isset($response['name'])) ? $response['name'] : '';
							if($name !== '')
								$url .= '?s='.urldecode($name);
					?>
                    	<a href="<?php echo (is_multisite()) ? network_admin_url($url) : admin_url($url) ?>"><?php echo __('Manage '.$txt.' here','bsf') ?></a> | <a href="<?php echo (is_multisite()) ? network_admin_url('admin.php?page=bsf-registration') : admin_url('admin.php?page=bsf-registration') ?>"><?php echo __('Back to Registration','bsf') ?></a>
                    <?php endif; ?>
            	</div>
         	<?php
			require_once(ABSPATH . 'wp-admin/admin-footer.php');
			exit;
		}
	}
	
	if(isset($_POST['bsf-developer-access'])) {
		//echo $_POST['bsf-developer-access-action'];
		if(isset($_POST['bsf-developer-access-action']) || $_POST['bsf-developer-access-action'] !== '')
		{
			$dev_action = $_POST['bsf-developer-access-action'];
			bsf_grant_developer_access($dev_action);
			$tab = $_POST['active-tab'];
		}
	}
	
	if(isset($_GET['remove-bundled-products']))  {
		if(is_multisite())
			$redirect = network_admin_url('admin.php?page=bsf-registration');
		else
			$redirect = admin_url('admin.php?page=bsf-registration');
		wp_redirect($redirect);
		delete_option('brainstrom_bundled_products');
	}
	
	if(isset($_GET['reset-bsf-users'])) {
		delete_option('brainstrom_users');
		if(is_multisite())
			$redirect = network_admin_url('admin.php?page=bsf-registration');
		else
			$redirect = admin_url('admin.php?page=bsf-registration');
		wp_redirect($redirect);
	}
	
	if(isset($_GET['force-check-update'])) {
		bsf_check_product_update();
		if(is_multisite())
			$redirect = network_admin_url('update-core.php');
		else
			$redirect = admin_url('update-core.php');
		wp_redirect($redirect);
	}
	
	$author = (isset($_GET['author'])) ? true : false;
	$advanced = (isset($_GET['advanced'])) ? true : false;
	$help = (isset($_GET['help'])) ? true : false;
	if($help)
		$tab = 2;
	else if($advanced)
		$tab = 3;
	else if($author)
		$tab = 4;
?>

<script type="text/javascript">
(function($){
	"use strict";
	$(document).ready(function(){
		if($('body').find('bsf-popup').length == 0)
			$('body').append('<div class="bsf-popup"></div><div class="bsf-popup-message"><div class="bsf-popup-message-inner"></div><span class="bsf-popup-close dashicons dashicons-no-alt"></span></div>');
		$('body').on('click', '.bsf-popup, .bsf-popup-close', function(){
			$('.bsf-popup, .bsf-popup-message').fadeOut(300);
		});
		
		$('body').on('click','.bsf-pr-form-submit', function(){
			var form_id = $(this).attr('data-form-id');
			var $form = $('#'+form_id);
			var $wrapper = $form.parent().parent();

			$wrapper.find('.bsf-spinner').toggleClass('bsf-spinner-show');
			
			var errors = 0;
			$form.parent().find('.bsf-pr-input').each(function(i,input){
				var type = $(input).attr('type');
				var required = $(input).attr('data-required');
				if(required === 'true' || required === true)
				{
					if(type === 'text')
					{
						$(input).removeClass('bsf-pr-input-required');
						if($(input).val() === '')
						{
							$(input).addClass('bsf-pr-input-required');
							errors++;
						}
					}
				}
			});
			if(errors > 0)
			{
				$wrapper.find('.bsf-spinner').toggleClass('bsf-spinner-show');
				return false;
			}
			var data = $form.serialize();
			$.post(ajaxurl, data, function(response) {
				//console.log($.parseJSON(response));
				//return false;
				var result = $.parseJSON(response);
				console.log(result);
				
				if(typeof result === 'undefined' || result === null)
					return false;
				
				var step = $form.find('input[name="step"]').val();

				//result.proceed = true;

				if(result.proceed === 'false' || result.proceed === false)
				{
					var html = '';
					if(typeof result.response.title !== 'undefined')
						html += '<h2><span class="dashicons dashicons-info" style="transform: scale(-1);-web-kit-transform: scale(-1);margin-right: 10px;color: rgb(244, 0, 0);  font-size: 25px;"></span>'+result.response.title+'</h2>';
					if(typeof result.response.message_html !== 'undefined')
						html += '<div class="bsf-popup-message-inner-html">'+result.response.message_html+'</div>';
					$('.bsf-popup-message-inner').html(html);
					$('.bsf-popup, .bsf-popup-message').fadeIn(300);
				}
				else if(result.proceed === 'true' || result.proceed === true)
				{
					if(step === 'step-product-registration') 
					{
						$wrapper.slideUp(200);
						setTimeout(function(){
							$wrapper.append(result.next_action_html);
							$wrapper.find('.bsf-step-1').remove();
							$wrapper.slideDown(300);
						},300);
						
					}
					else
					{
						var html = '';
						if(typeof result.response.title !== 'undefined')
							html += '<h2><span class="dashicons dashicons-yes" style="margin-right: 10px;color: rgb(0, 213, 0);  font-size: 25px;"></span>'+result.response.title+'</h2>';
						if(typeof result.response.message_html !== 'undefined')
							html += '<div class="bsf-popup-message-inner-html">'+result.response.message_html+'</div>';
						$('.bsf-popup-message-inner').html(html);
						$('.bsf-popup, .bsf-popup-message').fadeIn(300);
						setTimeout(function(){
							location.reload();
						},4000);
					}
				}
				$wrapper.find('.bsf-spinner').toggleClass('bsf-spinner-show');
			});
		});
		
		$('body').on('click', '.bsf-registration-form-toggle', function(){
			var toggle = $(this).attr('data-toggle');
			if(toggle === 'show-form')
			{
				//$(this).find('span').removeClass('dashicons-arrow-down-alt2').addClass('dashicons-arrow-up-alt2');
				$(this).find('span').addClass('toggle-icon');
				$(this).next('.bsf-pr-form-wrapper').slideDown(300);
				$(this).attr('data-toggle','hide-form');
			}
			else
			{
				//$(this).find('span').removeClass('dashicons-arrow-up-alt2').addClass('dashicons-arrow-down-alt2');
				$(this).find('span').removeClass('toggle-icon');
				$(this).next('.bsf-pr-form-wrapper').slideUp(300);
				$(this).attr('data-toggle','show-form');
			}
		});
	});
})(jQuery);
</script>
<div class="clear"></div>
<div class="wrap">
	<div class="bsf-pr-header">
		<h2><?php echo __('Product Registration','imedica') ?></h2>
    	<div class="bsf-pr-decription"><?php echo __('Enter your Envato Username and Purchase Key to validate your purchase, receive automatic updates, and unlock Extensions.','bsf'); ?></div>
    </div>
<?php
	global $bsf_support_url;
	$brainstrom_users = (get_option('brainstrom_users')) ? get_option('brainstrom_users') : array();
	$bsf_envato_username = $bsf_envato_email = $bsf_token = '';
	if(empty($brainstrom_users)) :
		?>
        	<div class="bsf-user-registration-form-wrapper">
            	<div class="bsf-user-registration-inner-wrapper">
                	<div class="bsf-ur-wrap">
                        <form action="" method="post" id="bsf-user-form" class="bsf-pr-form">
                            <input type="hidden" name="action" value="bsf_register_user"/>
                            <div class="bsf-pr-form-row">
                                <input type="text" name="envato_username" placeholder="<?php echo __('Enter Envato Username','bsf'); ?>" class="bsf-pr-input" data-required="true"/>
                            </div>
                            <div class="bsf-pr-form-row">
                                <input type="text" name="envato_useremail" value="" placeholder="<?php echo __('Enter Email Address','bsf'); ?>" class="bsf-pr-input" data-required="true"/>
                            </div>
                            <div class="bsf-pr-form-row">
                                <input type="checkbox" name="subscribe" id="checkbox-subscribe" checked="checked" data-required="false" /> 
                                <label for="checkbox-subscribe"><?php echo __('Subscribe', 'bsf'); ?></label>
                            </div>
                        </form>
                        <div class="bsf-pr-submit-row">
                            <input type="button" class="bsf-pr-form-submit button-primary bsf-button-primary" data-form-id="bsf-user-form" value="<?php echo __('Register and Proceed','bsf'); ?>"/>
                            <span class="spinner bsf-spinner"></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php
		return false;
	else :
		$bsf_envato_username = $brainstrom_users[0]['username'];
		$bsf_envato_email = $brainstrom_users[0]['email'];
	endif;
?>
<?php
	$brainstrom_bundled_products = (get_option('brainstrom_bundled_products')) ? get_option('brainstrom_bundled_products') : array();
	$brainstrom_bundled_products_keys = array();
	
	if(!empty($brainstrom_bundled_products)) :
		foreach($brainstrom_bundled_products as $bp)
			array_push($brainstrom_bundled_products_keys, $bp->id);
	endif;
	
	$brainstrom_products = (get_option('brainstrom_products')) ? get_option('brainstrom_products') : array();

	$bsf_product_plugins = $bsf_product_themes = array();
	
	if(!empty($brainstrom_products)) :
		$bsf_product_plugins = (isset($brainstrom_products['plugins'])) ? $brainstrom_products['plugins'] : array();
		$bsf_product_themes = (isset($brainstrom_products['themes'])) ? $brainstrom_products['themes'] : array();
	endif;
	
	$plugins = get_plugins();
	$themes = wp_get_themes();
?>

    <div class="inside">
    	<?php			
			foreach($plugins as $plugin => $plugin_data)
			{
				if(trim($plugin_data['Author']) === 'Brainstorm Force')
				{
					if(!empty($bsf_product_plugins)) :
						foreach($bsf_product_plugins as $key => $bsf_product_plugin)
						{
							$temp = array();
							$bsf_template = $bsf_product_plugin['template'];
							if($plugin == $bsf_template)
							{
								$temp['product_info'] = $bsf_product_plugin;
								$plugin_data = array_merge($plugin_data, $temp);
							}
						}
					endif;
					$bsf_plugins[$plugin] = $plugin_data;
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
							$temp = array();
							$bsf_template = $bsf_product_theme['template'];
							if($theme == $bsf_template)
							{
								$temp['product_info'] = $bsf_product_theme;
								$theme_data = array_merge((array)$theme_data, $temp);
							}
						}
					endif;
					$bsf_themes[$theme] = $theme_data;
				}
			}
			
			//echo '<pre>';
			//print_r($bsf_themes);
			//echo '</pre>';
			
			//echo '<pre>';
			//print_r($bsf_plugins);
			//echo '</pre>';
		?>
        <h2 class="nav-tab-wrapper">
        	<a href="#bsf-licence-tab" class="nav-tab <?php echo ($tab == '' || $tab == '1') ? 'nav-tab-active' : '' ?>">Licenses</a>
            <a href="#bsf-help-tab" class="nav-tab <?php echo ($tab == '2') ? 'nav-tab-active' : '' ?>">Help</a>
            <?php if($author) : ?>
            	<a href="#bsf-author-tab" class="nav-tab <?php echo ($tab == '3') ? 'nav-tab-active' : '' ?>">Debug</a>
            <?php endif; ?>
        </h2>
        	<div id="bsf-licence-tab" class="bsf-tab <?php echo ($tab == '' || $tab == '1') ? 'bsf-tab-active' : '' ?>">
            	<div class="inner">
            	<table class="wp-list-table widefat fixed licenses">
                	<thead>
                    	<tr>
                        	<th scope="col" class="manage-column column-product_name">Product</th>
                            <th scope="col" class="manage-column column-product_version">Version</th>
                            <th scope="col" class="manage-column column-product_version">Envato Username</th>
                            <th scope="col" class="manage-column column-product_status">License Key</th>
                            <th scope="col" class="manage-column column-product_action">Action</th>
                     	</tr>
                    </thead>
                    <tfoot>
                    	<tr>
                        	<th scope="col" class="manage-column column-product_name">Product</th>
                            <th scope="col" class="manage-column column-product_version">Version</th>
                            <th scope="col" class="manage-column column-product_version">Envato Username</th>
                            <th scope="col" class="manage-column column-product_status">License Key</th>
                            <th scope="col" class="manage-column column-product_action">Action</th>
                     	</tr>
                    </tfoot>
                    <tbody>
                    	<?php 
							$count = $registered_licence = 0;							
							if(!empty($bsf_plugins)) :
								foreach($bsf_plugins as $plugin => $plugin_data) :
							
									$readonly = '';
									
									if(!isset($plugin_data['product_info']))
										continue;
										
									$info = $plugin_data['product_info'];
									
									$status = (isset($info['status'])) ? $info['status'] : '';
									
									$envato_username = (isset($info['envato_username'])) ? $info['envato_username'] : $bsf_envato_username;
									$envato_useremail = (isset($info['envato_useremail'])) ? $info['envato_useremail'] : $bsf_envato_email;
									$purchase_key = (isset($info['purchase_key'])) ? $info['purchase_key'] : '';
									$type = (isset($info['type'])) ? $info['type'] : 'plugin';
									$template = (isset($info['template'])) ? $info['template'] : $plugin;
									$id = (isset($info['id'])) ? $info['id'] : '';
									$version = (isset($plugin_data['Version'])) ? $plugin_data['Version'] : '';
									$name = $plugin_data['Name'];
									
									if($request_product_id!='')
										$init_single_product_show = true;
									else
										$init_single_product_show = false;
										
									if($id === '')
										continue;
										
									if(in_array($id,$brainstrom_bundled_products_keys))
										continue;
										
									if($init_single_product_show && $request_product_id !== $id)
										continue;
																		
									$step = (isset($plugin_data['step']) && $plugin_data['step'] != '') ? $plugin_data['step'] : 'step-product-registration';
									
									$common_data = ' data-product-id="'.$id.'" ';
									$common_data .= ' data-envato_useremail="'.$envato_useremail.'" ';
									$common_data .= ' data-product-type="'.$type.'" ';
									$common_data .= ' data-template="'.$template.'" ';
									$common_data .= ' data-version="'.$version.'" ';
									$common_data .= ' data-step="'.$step.'" ';
									$common_data .= ' data-product-name="'.$name.'" ';
									
									$mod = ($count%2);
									$alternate = ($mod) ? 'alternate' : '';
									$row_id = 'bsf-row-'.$count;
									
									if($status === 'registered')
									{
										$readonly = ' readonly="readonly" ';
										$common_data .= ' data-action="bsf_deregister_product" ';
										$registered_licence++;
									}
									else
									{
										$common_data .= ' data-action="bsf_register_product" ';	
									}
									?>
										<tr id="<?php echo $row_id ?>" class="<?php echo $alternate.' '.$status ?>">
											<td><?php echo $name ?></td>
											<td><?php echo $plugin_data['Version'] ?></td>
                                            <td><input type="text" class="bsf-form-input" name="envato_username" data-required="true" value="<?php echo $envato_username ?>" <?php echo $readonly ?>/></td>
                                            <td><input type="text" class="bsf-form-input" name="purchase_key" data-required="true" value="<?php echo $purchase_key ?>" <?php echo $readonly ?>/></td>
                                            <td>
                                            	<?php if($status !== 'registered') : ?>
                                            		<input type="button" class="button button-primary bsf-submit-button" value="Register" data-row-id="<?php echo $row_id ?>" <?php echo $common_data; ?>/> <span class="spinner bsf-spinner"></span>
                                               	<?php else : ?>
                                                	<input type="button" class="button bsf-submit-button-deregister" value="De-register" data-row-id="<?php echo $row_id ?>" <?php echo $common_data; ?>/> <span class="spinner bsf-spinner"></span>
                                                <?php endif; ?>
                                         	</td>
										</tr>  
									<?php
									$count++;
								endforeach;
							endif;
							
							if(!empty($bsf_themes)) :
								
								foreach($bsf_themes as $theme => $theme_data) :

									//echo '<pre>';
									//print_r($theme_data);
									//echo '</pre>';
									$readonly = '';
									
									if(isset($theme_data['product_info']))
										$info = $theme_data['product_info'];
									else
										continue;
									$status = (isset($info['status'])) ? $info['status'] : '';
									
									$envato_username = (isset($info['envato_username'])) ? $info['envato_username'] : $bsf_envato_username;
									$envato_useremail = (isset($info['envato_useremail'])) ? $info['envato_useremail'] : $bsf_envato_email;
									$purchase_key = (isset($info['purchase_key'])) ? $info['purchase_key'] : '';
									$type = (isset($info['type'])) ? $info['type'] : 'theme';
									$template = (isset($info['template'])) ? $info['template'] : $plugin;
									$id = (isset($info['id'])) ? $info['id'] : '';
									
									if($request_product_id!='')
										$init_single_product_show = true;
									else
										$init_single_product_show = false;
										
									if($init_single_product_show && $request_product_id !== $id)
										continue;
									
									$version = bsf_get_current_version($template, $type);
									$name = bsf_get_current_name($template, $type);
									
									$step = (isset($theme_data['step']) && $theme_data['step'] != '') ? $theme_data['step'] : 'step-product-registration';
									
									$common_data = ' data-product-id="'.$id.'" ';
									$common_data .= ' data-envato_useremail="'.$envato_useremail.'" ';
									$common_data .= ' data-product-type="'.$type.'" ';
									$common_data .= ' data-template="'.$template.'" ';
									$common_data .= ' data-version="'.$version.'" ';
									$common_data .= ' data-step="'.$step.'" ';
									$common_data .= ' data-product-name="'.$name.'" ';
									
									$mod = ($count%2);
									$alternate = ($mod) ? 'alternate' : '';
									$row_id = 'bsf-row-'.$count;
									
									if($status === 'registered')
									{
										$readonly = ' readonly="readonly" ';
										$common_data .= ' data-action="bsf_deregister_product" ';
										$registered_licence++;
									}
									else
									{
										$common_data .= ' data-action="bsf_register_product" ';	
									}
									?>
										<tr id="<?php echo $row_id ?>" class="<?php echo $alternate.' '.$status ?>">
											<td><?php echo $name ?></td>
											<td><?php echo $version ?></td>
                                            <td><input type="text" class="bsf-form-input" name="envato_username" data-required="true" value="<?php echo $envato_username ?>" <?php echo $readonly ?>/></td>
                                            <td><input type="text" class="bsf-form-input" name="purchase_key" data-required="true" value="<?php echo $purchase_key ?>" <?php echo $readonly ?>/></td>
                                            <td>
                                            	<?php if($status !== 'registered') : ?>
                                            		<input type="button" class="button button-primary bsf-submit-button" value="Register" data-row-id="<?php echo $row_id ?>" <?php echo $common_data; ?>/> <span class="spinner bsf-spinner"></span>
                                               	<?php else : ?>
                                                	<input type="button" class="button bsf-submit-button-deregister" value="De-register" data-row-id="<?php echo $row_id ?>" <?php echo $common_data; ?>/> <span class="spinner bsf-spinner"></span>
                                                <?php endif; ?>
                                         	</td>
										</tr>  
									<?php
									$count++;
								endforeach;
							endif;
						?>
                    </tbody>
                </table>
                </div>
            </div><!-- bsf-licence-tab -->
            <div id="bsf-help-tab" class="bsf-tab <?php echo ($tab == '2') ? 'bsf-tab-active' : '' ?>">
            	<div class="inner">
                	<table class="wp-list-table widefat fixed bsf-users">
                        <thead>
                            <tr>
                                <th scope="col" class="manage-column column-product_version">User</th>
                                <th scope="col" class="manage-column column-product_status">Support Link</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php
                                foreach($brainstrom_users as $key => $bsf_user):
                                    $bsf_envato_username = $bsf_user['username'];
                                    $bsf_envato_email = $bsf_user['email'];
                                    $bsf_token = $bsf_user['token'];
									$alternate_user = ($key%2) ? '' : 'alternate';
                                    ?>
                                    	<tr class="<?php echo $alternate_user ?>">
                                        	<td><?php echo $bsf_envato_username ?></td>
                                            <td>
                                            	<?php if($registered_licence > 0) : ?>
                                                    <?php
														if(count($brainstrom_users) === 1) {
															if($bsf_envato_email === '') {
																?>
                                                                	<a href="<?php echo (is_multisite()) ? network_admin_url('admin.php?page=bsf-registration?reset-bsf-users&noheader=true') : admin_url('admin.php?page=bsf-registration?reset-bsf-users') ?>">Click to set email address</a>
                                                                <?php
															}
															else {
																?>
                                                                    <a href="<?php echo $bsf_support_url ?>?bsf-reg-access=<?php echo urlencode(base64_encode($bsf_envato_username)) ?>&bsf-reg-token=<?php echo $bsf_token; ?>" class="" target="_blank">
                                                                        <?php echo __('Click to visit our Support Center','bsf'); ?>
                                                                    </a>
                                                                <?php
															}
														}
														else {
															?>
                                                            	<a href="<?php echo $bsf_support_url ?>?bsf-reg-access=<?php echo urlencode(base64_encode($bsf_envato_username)) ?>&bsf-reg-token=<?php echo $bsf_token; ?>" class="" target="_blank">
																	<?php echo __('Click to visit our Support Center','bsf'); ?>
                                                                </a>
                                                            <?php
														}
													?>
                                              	<?php else : ?>
                                                	<?php echo __('Validate licence to Single Signon to our Support Center','bsf') ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php
                                endforeach;
                            ?>
                    	</tbody>
                	</table>
                    <br/>
                    <form action="" method="post">
                    	<?php 
							if($registered_licence > 0)
								 $disabled = '';
							else
								$disabled = 'disabled="disabled"';
							$developer_access = get_option('developer_access');
							if($developer_access)
							{
								$button_text = 'Revoke developer access';
								$action = 'revoke';
							}
							else
							{
								$button_text = 'Allow developer access';
								$action = 'grant';
							}
						?>
                        <input type="hidden" name="bsf-developer-access-action" value="<?php echo $action ?>"/>
                        <input type="hidden" name="active-tab" value="2"/>
                    	<input type="submit" class="button-primary" name="bsf-developer-access" value="<?php echo $button_text ?>" <?php echo $disabled ?>/>
                    </form>
                </div>
            </div><!-- bsf-help-tab -->
            <div id="bsf-advanced-tab" class="bsf-tab <?php echo ($tab == '3') ? 'bsf-tab-active' : '' ?>">
            	<div class="inner">
                	<table>
                        <tr>
                            <td>
                            	<?php
									if(is_multisite())
										$reset_url = network_admin_url('admin.php?page=bsf-registration&force-check-update&noheader=true');
									else
										$reset_url = admin_url('admin.php?page=bsf-registration&force-check-update&noheader=true');
								?>
								<a class="button-primary" href="<?php echo $reset_url ?>"><?php echo __('Check Updates Now','bsf') ?></a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- bsf-advacned-tab -->
            <?php if($author) : ?>
			<div id="bsf-author-tab" class="bsf-tab <?php echo ($tab == '4') ? 'bsf-tab-active' : '' ?>">
            	<div class="inner">
                	<table>
                    	<tr>
                            <td>
                            	<?php
									if(is_multisite())
										$url = network_admin_url('admin.php?page=bsf-registration&remove-bundled-products&noheader=true');
									else
										$url = admin_url('admin.php?page=bsf-registration&remove-bundled-products&noheader=true');
								?>
								<a class="button-primary" href="<?php echo $url ?>"><?php echo __('Remove Bundled Products','bsf') ?></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            	<?php
									if(is_multisite())
										$reset_url = network_admin_url('admin.php?page=bsf-registration&reset-bsf-users&noheader=true');
									else
										$reset_url = admin_url('admin.php?page=bsf-registration&reset-bsf-users&noheader=true');
								?>
								<a class="button-primary" href="<?php echo $reset_url ?>"><?php echo __('Reset Users','bsf') ?></a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- bsf-author-tab -->
            <?php endif; ?>
    </div>
</div>
<script type="text/javascript">
(function($){
	"use strict";
	$(document).ready(function(){
		$('body').on('click','.bsf-submit-button', function(){
			var row_id = $(this).attr('data-row-id');
			var $row = $('#'+row_id);
			
			var errors = 0;
			
			$row.find('.bsf-spinner').toggleClass('bsf-spinner-show');
			
			var username = $row.find('input[name="envato_username"]').val();
			var purchase_key = $row.find('input[name="purchase_key"]').val();
			
			var product_id = $(this).attr('data-product-id');
			var useremail = $(this).attr('data-envato_useremail');
			var product_type = $(this).attr('data-product-type');
			var template = $(this).attr('data-template');
			var version = $(this).attr('data-version');
			var step = $(this).attr('data-step');
			var product_name = $(this).attr('data-product-name');
			
			var action = $(this).attr('data-action');
			
			var admin_url = '<?php echo (is_multisite()) ? rtrim(network_admin_url(),'/') : rtrim(admin_url(),'/'); ?>';
			
			$row.find('.bsf-form-input').each(function(i,input){
				var type = $(input).attr('type');
				var required = $(input).attr('data-required');
				if(required === 'true' || required === true)
				{
					if(type === 'text')
					{
						$(input).removeClass('bsf-pr-input-required');
						if($(input).val() === '')
						{
							$(input).addClass('bsf-pr-input-required');
							errors++;
						}
					}
				}
			});
			if(errors > 0)
			{
				$row.find('.bsf-spinner').toggleClass('bsf-spinner-show');
				return false;
			}
			
			var data = {
				action: action,
				envato_username: username,
				envato_useremail: useremail,
				purchase_key: purchase_key,
				type: product_type,
				id: product_id,
				product: template,
				version: version,
				step: step,
				product_name: product_name
			};
			
			$.post(ajaxurl, data, function(response) {
				//console.log($.parseJSON(response));
				//return false;
				var result = $.parseJSON(response);
				console.log(result);
				
				if(typeof result === 'undefined' || result === null)
					return false;
				
				//result.proceed = true;

				if(result.proceed === 'false' || result.proceed === false)
				{
					var html = '';
					if(typeof result.response.title !== 'undefined')
						html += '<h2><span class="dashicons dashicons-info" style="transform: scale(-1);-web-kit-transform: scale(-1);margin-right: 10px;color: rgb(244, 0, 0);  font-size: 25px;"></span>'+result.response.title+'</h2>';
					if(typeof result.response.message_html !== 'undefined')
						html += '<div class="bsf-popup-message-inner-html">'+result.response.message_html+'</div>';
					$('.bsf-popup-message-inner').html(html);
					$('.bsf-popup, .bsf-popup-message').fadeIn(300);
				}
				else if(result.proceed === 'true' || result.proceed === true)
				{
					var html = '';
					if(typeof result.response.title !== 'undefined')
						html += '<h2><span class="dashicons dashicons-yes" style="margin-right: 10px;color: rgb(0, 213, 0);  font-size: 25px;"></span>'+result.response.title+'</h2>';
					if(typeof result.response.message_html !== 'undefined')
						html += '<div class="bsf-popup-message-inner-html">'+result.response.message_html+'</div>';
					$('.bsf-popup-message-inner').html(html);
					$('.bsf-popup, .bsf-popup-message').fadeIn(300);
					if(typeof result.after_registration_action !== 'undefined' && result.after_registration_action !== '')
						window.location.href = admin_url+'/'+result.after_registration_action;
					else
						location.reload();
				}
				$row.find('.bsf-spinner').toggleClass('bsf-spinner-show');
			});
		}); //end of submit button
		
		$('body').on('click','.bsf-submit-button-deregister',function(){
			var row_id = $(this).attr('data-row-id');
			var $row = $('#'+row_id);
			
			var errors = 0;
			
			$row.find('.bsf-spinner').toggleClass('bsf-spinner-show');
			
			var username = $row.find('input[name="envato_username"]').val();
			var purchase_key = $row.find('input[name="purchase_key"]').val();
			
			var product_id = $(this).attr('data-product-id');
			var product_type = $(this).attr('data-product-type');
			var template = $(this).attr('data-template');
			var version = $(this).attr('data-version');
			var name = $(this).attr('data-product-name');
			
			var action = $(this).attr('data-action');
			
			var data = {
				action: action,
				envato_username: username,
				purchase_key: purchase_key,
				type: product_type,
				id: product_id,
				product: template,
				version: version,
				product_name: name
			};
			
			console.log(data);
			
			$.post(ajaxurl, data, function(response) {
				//console.log($.parseJSON(response));
				//return false;
				console.log(response);
				//return false;
				var result = $.parseJSON(response);
				var html = '';
				if(typeof result.response.title !== 'undefined')
					html += '<h2><span class="dashicons dashicons-yes" style="margin-right: 10px;color: rgb(0, 213, 0);  font-size: 25px;"></span>'+result.response.title+'</h2>';
				if(typeof result.response.message_html !== 'undefined')
					html += '<div class="bsf-popup-message-inner-html">'+result.response.message_html+'</div>';
				$('.bsf-popup-message-inner').html(html);
				$('.bsf-popup, .bsf-popup-message').fadeIn(300);
				if(result.proceed === 'true' || result.proceed === true)
				{
					//setTimeout(function(){
						location.reload();
					//},2000);
				}
			});
			
		}); // end of de-registering licence
		
		$('body').on('click','.nav-tab',function(event){
			event.preventDefault();
			$('.nav-tab').removeClass('nav-tab-active');
			$(this).addClass('nav-tab-active');
			var tab = $(this).attr('href');
			$('.bsf-tab').fadeOut(200);
			setTimeout(function(){
				$(tab).fadeIn(200);
			},200);
		}); // end of tabs functionality
	});
})(jQuery);
</script>