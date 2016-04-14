<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to gateway management
 * @author Teamtweaks
 *
 */
class Contactseller_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	/**
    * 
    * This function save the payment settings in a file
    */
   public function savePaymentSettings(){
		$getPaymentSettings = $this->get_all_details(PAYMENT_GATEWAY,array());
		$config = '<?php ';
		foreach($getPaymentSettings->result_array() as $key => $val){
			$value = serialize($val);
			$config .= "\n\$config['payment_$key'] = '$value'; ";
		}
		$config .= ' ?>';
		$file = 'commonsettings/shopsy_payment_settings.php';
		file_put_contents($file, $config);
   }
      /* to get all contact shop details */
    public function get_all_contact_shop_details(){
		$this->db->select('c.*,u.user_name as user_url,s.user_name as seller_url');
		$this->db->from(CONTACTSHOPSELLER.' as c');
		$this->db->join(USERS.' as u','c.user_id=u.id ');
		$this->db->join(USERS.' as s','c.sellerid=s.id ');
		return $this->db->get();
   
   }
   /* to get all contact shop details */
    public function get_all_contact_shop_ask_details(){
		$this->db->select('c.*,u.user_name as user_url,p.seourl as product_url,s.user_name as seller_url');
		$this->db->from(CONTACTSELLER.' as c');
		$this->db->join(USERS.' as u','c.user_id=u.id ');
		$this->db->join(USERS.' as s','c.sellerid=s.id ');
		$this->db->join(PRODUCT.' as p','c.product_id=p.id ');
		return $this->db->get();
   
   }
   
    // To get details of offers in site
   public function get_all_offer_details(){
		$this->db->select('m.*,u.user_name as username,u.id as user_id,s.seller_businessname as shop_name,s.seller_id as shop_id,s.seourl as shop_url,p.id as product_id,p.product_name as product_name,p.seourl as product_seourl,p.image as product_image,p.price as product_price');
		$this->db->from(MAKEOFFER.' as m');
		$this->db->join(USERS.' as u','m.buyer_id=u.id','left');
		$this->db->join(SELLER.' as s','m.seller_id=s.seller_id','left');
		$this->db->join(PRODUCT.' as p','m.product_id=p.id','left');
		$this->db->where('m.type','Offer'); 
		$this->db->where('u.group','Seller'); 		
		$this->db->order_by('m.dateAdded','desc');
		$offerlist= $this->db->get();
		return $offerlist;
   }
   
}