<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dragonpay extends Public_Controller {
	public function after_init() {
		$this->set_scripts_and_styles();
	}

	public function index() {

		// $date_atom = "2020-10-14T09:55:36.358";

		// $date_mysql = date("Y-m-d H:i:s", strtotime($date_atom));

		// echo $date_mysql . " from " . $date_atom;

		// die();

		$drp_base_url	= DRP_BASE_URL . "Pay.aspx";

		$tmp_amount		= isset($_GET['amount']) ? $_GET['amount'] : "150.00";

		if (is_numeric($tmp_amount)) {
			$tmp_amount = number_format($tmp_amount, 2, '.', '');
		}
		
		$merchant_id	= DRP_USERNAME;
		$tx_id 			= isset($_GET['txid']) ? $_GET['txid'] : "txbp" . strtotime($this->_today);
		$amount			= $tmp_amount;
		$ccy			= "PHP";
		$email_address	= isset($_GET['email']) ? urldecode($_GET['email'] ) : "marknel.pineda23@gmail.com";
		$description 	= "test";
		$secret_key		= DRP_PASSWORD;

		$digest = sha1("{$merchant_id}:{$tx_id}:{$amount}:{$ccy}:{$description}:{$email_address}:{$secret_key}");

		$redirect = "{$drp_base_url}?" . "merchantid=" . $merchant_id . "&txnid=" . $tx_id . "&amount=" . $amount . "&ccy=" . $ccy . "&description=" . urlencode($description) . "&email=" . urlencode($email_address) . "&digest=" . $digest;
	
		echo "<a href='{$redirect}' target='_blank'>click here!</a>";
	}
}

