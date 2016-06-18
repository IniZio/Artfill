<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to user management
 * @author Teamtweaks
 *
 */
class Shipping_model extends My_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function saveShippingSettings(){
		$getShippingSettings = $this->get_all_details(SHIPPIN_METHODS,array());
		$config = '<?php ';
		foreach($getShippingSettings->result_array() as $key => $val){
			$value = serialize($val);
			$config .= "\n\$config['shipping_$key'] = '$value'; ";
		}
		$config .= ' ?>';
		$file = 'commonsettings/shopsy_shipping_settings.php';
		file_put_contents($file, $config);
	}
}