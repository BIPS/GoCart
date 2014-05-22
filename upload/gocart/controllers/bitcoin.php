<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bitcoin extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->add_package_path(APPPATH . 'packages/payment/bips/');
		$this->load->library(array('bips', 'go_cart'));
		$this->load->helper('form_helper');
	}
	
	function index()
	{
		$this->CI =& get_instance();
		$settings = $this->CI->Settings_model->get_settings('bips');

		$BIPS = $_POST;
		$hash = hash('sha512', $BIPS['transaction']['hash'] . $settings["bips_secret"]);

		header('HTTP/1.1 200 OK');
		print '1';

		if ($BIPS['hash'] == $hash && $BIPS['status'] == 1)
		{
			$transaction_number = intval($BIPS["custom"]["orderid"]);

			//update transaction table
			$this->db->where('order_number', $transaction_number);
			$this->db->update('gc_orders', array('status' => 'Processing'));
			
			$this->load->library('email');
			
			$config['mailtype'] = 'html';
			$this->email->initialize($config);

			$this->email->from($this->config->item('email'), 'System');

			$this->email->to($this->config->item('email'));
			
			$this->email->subject("Order " . $transaction_number . " paid");
			$this->email->message("A customer just paid for order number " . $transaction_number);

			$this->email->send();
		}
	}	
}