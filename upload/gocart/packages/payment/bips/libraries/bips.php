<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BIPS
{
	var $CI;
	var	$method_name;
	
	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->lang->load('bips');
		
		$this->method_name	= lang('bips');
	}
	
	function checkout_form($post = false)
	{
		$settings	= $this->CI->Settings_model->get_settings('bips');
		$enabled	= $settings['enabled'];
		
		$form = array();

		if ($enabled == 1)
		{
			$form['name']	= $this->method_name;
			$form['form']	= false;
		}
		
		return $form;
	}

	function checkout_check()
	{
		return false;
	}
	
	function description()
	{
		return lang('bips');
	}
	
	function install()
	{
		$config['bips_api'] = ''; // BIPS API Key
		$config['bips_secret'] = ''; // BIPS Merchant Secret
		$config['currency'] = 'USD';  //default USD
		$config['enabled'] = '0';

		$this->CI->Settings_model->save_settings('bips', $config);
	}
	
	function uninstall()
	{
		$this->CI->Settings_model->delete_settings('bips');
	}
	
	function process_payment()
	{
		$process = false;

		if ($process)
		{
			return lang('processing_error');
		}
		else
		{
						
			return false;
		}
		
	}
	
	function form($post	= false)
	{
		$this->CI->load->helper('form');

		if (!$post)
		{
			$settings = $this->CI->Settings_model->get_settings('bips');
		}
		else
		{
			$settings = $post;
		}

		return $this->CI->load->view('bips_form', array('settings' => $settings), true);
	}
	
	function check()
	{	
		$error	= false;

		if($error)
		{
			return $error;
		}
		else
		{
			$this->CI->Settings_model->save_settings('bips', array('bips_api' => $_POST['bips_api'], 'bips_secret' => $_POST['bips_secret'], 'enabled' => $_POST['enabled']));
			
			return false;
		}
	}
	
	function complete_payment($data)
	{
		$settings = $this->CI->Settings_model->get_settings('bips');

		$ch = curl_init();
		curl_setopt_array($ch, array(
		CURLOPT_URL => 'https://BIPS.me/api/v1/invoice',
		CURLOPT_USERPWD => $settings['bips_api'],
		CURLOPT_POSTFIELDS => 'price=' . number_format($this->CI->go_cart->total(), 2, '.', '') . '&currency=' . $this->CI->go_cart->CI->config->config['currency'] . '&item=Cart&custom=' . json_encode(array('orderid' => $data['order_id'], 'returnurl' => rawurlencode($this->CI->go_cart->CI->config->config['base_url'] . 'index.php/secure/my_account'), 'cancelurl' => rawurlencode($this->CI->go_cart->CI->config->config['base_url'] . 'index.php/secure/my_account'))),
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_HTTPAUTH => CURLAUTH_BASIC));
		$rurl = curl_exec($ch);
		curl_close($ch);

		redirect($rurl);
	}
}
