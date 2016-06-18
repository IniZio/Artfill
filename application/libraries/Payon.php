<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payon {
	public $payment_type = 'DB';
	private $amount;
	public $payonValue;
	public $url;
	public $currency;
	public function __construct(){
		//$this->amount = number_format($amount,2);
		$this->_obj =& get_instance();
		$payonDetails = unserialize($this->_obj->config->item('payment_7'));
		$this->payonValue = (object)  unserialize($payonDetails['settings']);
		$this->currency = $this->_obj->data['currencyType'];
		if($this->payonValue->mode == 'sandbox'){
			$this->url = 'https://test.oppwa.com/';
		}else{
			$this->url = 'https://oppwa.com/';
		}
	}
	public function get_checkout_id_script($amount){
		$url = $this->url."v1/checkouts";
		$data = "authentication.userId=".$this->payonValue->user_ID.      //8a8294174d0595bb014d05d829e701d1
			"&authentication.password=".$this->payonValue->password.								//9TnJPc2n9h
			"&authentication.entityId=".$this->payonValue->entity_ID.		//8a8294174d0595bb014d05d82e5b01d2
			"&paymentType=DB" .
			"&amount=".$amount.
			"&currency=SAR";//.$this->currency;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		if(curl_errno($ch)) {
			return curl_error($ch);
		}
		curl_close($ch);
		return array('payment_id'=>json_decode($response)->id,'script_url'=>$this->url.'v1/paymentWidgets.js?checkoutId='.json_decode($response)->id);		
	}
        public function getPaymentStatus($id = '') {
                $url = $this->url."v1/checkouts/".$id ."/payment".
                        "?authentication.userId=".$this->payonValue->user_ID.
                        "&authentication.password=".$this->payonValue->password.
                        "&authentication.entityId=".$this->payonValue->entity_ID;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                if(curl_errno($ch)) {
                        return curl_error($ch);
                }
                curl_close($ch);
                return json_decode($response, true);
        }        

}