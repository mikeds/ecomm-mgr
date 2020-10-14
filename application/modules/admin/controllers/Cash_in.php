<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash_in extends Admin_Controller {
	private
		$_account_data = NULL;
		
	public function after_init() {
		$this->set_scripts_and_styles();

		$this->_account_data = $this->get_account_data();
	}

	public function index() {
		$this->_data['redirect_dragonpay']	= base_url() . "cash-in-dragonpay";



		$this->_data['title']  		= "CASH IN";
		$this->set_template("cash_in/index", $this->_data);
	}

	public function dragonpay() {
		$this->_data['form_url']		= base_url() . "cash-in-dragonpay";
		$this->_data['notification'] 	= $this->session->flashdata('notification');

		$account_results            = $this->_account_data['results'];
        $admin_oauth_bridge_id		= $account_results['admin_oauth_bridge_id'];
        $account_oauth_bridge_id    = $account_results['oauth_bridge_id'];
		$wallet_address             = $account_results['wallet_address'];
		$email_address 				= $account_results['email_address'];

		$transaction_type_id			= "txtype_cashin2";
		$description 					= "BambuPAY cash-in";
		$this->_data['note_message']	= $this->generate_notification('danger', 'Alert: After successfully request browser may redirect to Dragonpay website for secured payment process.');

		if ($_POST) {
			if ($this->form_validation->run('validate')) {
				$amount = $this->input->post("amount");

				if (is_decimal($amount) || !is_numeric($amount)) {
					$this->session->set_flashdata('notification', $this->generate_notification('warning', 'Invalid Amount, please input numeric and non-decimal numbers.'));
                    redirect($this->_data['form_url']);
				}

				$fee = 0;

				$dragonpay_id = $this->generate_code(
					array(
						$amount, 
						$fee, 
						$transaction_type_id, 
						$account_oauth_bridge_id, 
						$admin_oauth_bridge_id
					),
					"crc32"
				);

				$tx_results = $this->create_transaction_dragonpay(
					$dragonpay_id,
					$amount, 
					$fee, 
					$transaction_type_id, 
					$account_oauth_bridge_id, 
					$admin_oauth_bridge_id
				);

				$total_amount = $amount + $fee;

				$tx_id = $tx_results['transaction_id'];

				$redirect_url = $this->generate_dragonpay_tx_url(
					$tx_id,
					$total_amount,
					$email_address,
					$description
				);

				redirect($redirect_url);
			}
		}

		$this->_data['title']  		= "CASH IN via Dragonpay";
		$this->set_template("cash_in/form_dragonpay", $this->_data);
	}
}
