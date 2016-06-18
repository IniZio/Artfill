<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to user management 
 * @author Teamtweaks
 *
 */

class Admin_export extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model(array('adminexport_model'));	$this->load->model(array('user_model','seller_model'));
		$this->load->dbutil();
		$this->load->helper('csv');
		if ($this->checkPrivileges('userexcelexport',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the users list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/users/display_user_list');
		}
	}
		
	/**
	 * 
	 * This function loads the users list page
	 */
	
  public function user_export()
  {
    $this->data['heading'] = 'User Details Export';
	$this->load->view('admin/export/user_export',$this->data);
  }
  /**
	 * 
	 * This function Exports products
	 */
  public function export_product()
  {
  		$array=array();
		$fields=array("shopsy_users.full_name as first_name","shopsy_users.last_name as last_name","seller_product_id","product_name","price","price_range","sale_price","product_featured","quantity","max_quantity","purchasedCount","view_count",PRODUCT.".status","pay_status","shipping_type","shipping_cost","taxable_type","tax_cost",PRODUCT.".created");
	     $labels=capitalizeArraywords($fields);
		 $array[]=array($labels);
		 $this->db->select(implode(",",$fields)); 
		 $this->db->join('shopsy_users', 'shopsy_users.id = '.PRODUCT.'.user_id');
	     $where=array();
		 
		 if($this->input->post("fromDate")!=""&&$this->input->post("toDate")!="")
		 {$minvalue=$this->input->post("fromDate");
		 $maxvalue=$this->input->post("toDate");
		 $where[PRODUCT.'.created >=']=$minvalue;
		  $where[PRODUCT.'.created <=']=$maxvalue;

		 }
		 $this->db->where($where);
		 $quer = $this->db->get(PRODUCT);
		 $array []= $quer->result_array();
		 
		 if(count($array[1])==0)
		{	$this->setErrorMessage('error','No Data found to export');		
		 
		 }
		 else
		 {
         array_to_csv($array,'Products_'.date('dMy').'.csv'); 
		die();
		}
         redirect('admin/admin_export/user_export');
		 
  }
  
  /**
	 * 
	 * This function Exports users 
	 */
  
  public function export_user()
  {
  		 $array=array();
		 $fields=array("user_name","full_name","last_name","group","email","status","address","address2","city","district","state","country","postal_code","phone_no","following_count","followers_count","followers","following","gender","email_notifications","refund_amount","paypal_email","created");
	     $labels=capitalizeArraywords($fields);
		 $array[]=array($labels);
		 $where=array("group"=>"User");
		 if($this->input->post("fromDate")!=""&&$this->input->post("toDate")!="")
		 {
		   $minvalue=$this->input->post("fromDate");
		   $maxvalue=$this->input->post("toDate");
		   $where['created >=']=$minvalue;
		   $where['created <=']=$maxvalue;
		 }
	     $array[]=  adminexport_model::getResult(USERS,$where,$fields); // here pass Table name,where condition array,selecting field array
		 

		if(count($array[1])==0)
		{	$this->setErrorMessage('error','No Data found to export');		
		 
		 }
		 else
		 {	
         array_to_csv($array,'Users_'.date('dMy').'.csv'); 
		 die();
		 }
         redirect('admin/admin_export/user_export');
  }
  /**
	 * 
	 * This function Exports seller list 
	 */
  public function export_seller()
  {
  
    
  		 $array=array();
		 $fields=array("user_name","full_name","last_name","group","email","status","address","address2","city","district","state","country","postal_code","phone_no","following_count","followers_count","followers","following","gender","email_notifications","refund_amount","paypal_email","created");
	     $labels=capitalizeArraywords($fields);
		 $array[]=array($labels);
		 $where=array("group"=>"Seller");

	     if($this->input->post("fromDate")!=""&&$this->input->post("toDate")!="")
		 {$minvalue=$this->input->post("fromDate");
		 $maxvalue=$this->input->post("toDate");
		 $where['created >=']=$minvalue;
		 $where['created <=']=$maxvalue;
		 }
         $array[]=  adminexport_model::getResult(USERS,$where,$fields);
        if(count($array[1])==0)
		{	$this->setErrorMessage('error','No Data found to export');		
		 
		 }
		 else
		 { array_to_csv($array,'Sellers_'.date('dMy').'.csv'); 
		 die(); }
         redirect('admin/admin_export/user_export');
  }
  /**
	 * 
	 * This function Exports order pending
	 */
  
    public function export_order1()
  { 
		
		
		  	$fields=array("shopsy_users.full_name","shopsy_users.last_name",PRODUCT.".product_name","sell_id","shopsy_user_payment.price","shopsy_user_payment.quantity","is_coupon_used","coupon_id","discountAmount","giftdiscountAmount","couponCode","coupontype","gift_coupon_used"," 	giftcouponID","giftcouponcode","giftcoupontype","shippingid","billingid","indtotal","sumtotal","total","tax","shippingcost","shippingcountry","shippingcity","shippingstate"," 	paidVoucherStatus","paypal_transaction_id","dealCodeNumber","inserttime","shopsy_user_payment.status","shipping_date","tracking_id","shipping_status","payment_type", 	"attribute_values","product_shipping_cost","product_tax_cost","order_gift","payer_email","received_status","review_status");
		 
		 	$fields1=array("Seller first_name","Seller last_name","User full_name","User last_name",PRODUCT.".product_name","shopsy_user_payment.price","shopsy_user_payment.quantity","is_coupon_used","coupon_id","discountAmount","giftdiscountAmount","couponCode","coupontype","gift_coupon_used"," 	giftcouponID","giftcouponcode","giftcoupontype","shippingid","billingid","indtotal","sumtotal","total","tax","shippingcost","shippingcountry","shippingcity","shippingstate"," 	paidVoucherStatus","paypal_transaction_id","dealCodeNumber","inserttime","shopsy_user_payment.status","shipping_date","tracking_id","shipping_status","payment_type", 	"attribute_values","product_shipping_cost","product_tax_cost","order_gift","payer_email","received_status","review_status");
		 $array=array();
		  
	      $labels=capitalizeArraywords($fields1);
				$array[]=array($labels);
			 
						$this->db->join('shopsy_users', 'shopsy_users.id = .shopsy_user_payment.user_id','inner');
						$this->db->join(PRODUCT, PRODUCT.'.id =shopsy_user_payment.product_id','inner');
						$this->db->select(implode(",",$fields)); 
					$where=array("shopsy_user_payment.status"=>"Pending");
		 
		 if($this->input->post("fromDate")!=""&&$this->input->post("toDate")!="")
		 {$minvalue=$this->input->post("fromDate");
		 $maxvalue=$this->input->post("toDate");
		 $where['shopsy_user_payment.created >=']=$minvalue;
		  $where['shopsy_user_payment.created <=']=$maxvalue;

		 }
		 $this->db->where($where);
						$quer = $this->db->get('shopsy_user_payment');
								$ar1=$quer->result_array();
						foreach($ar1 as $key=>$val)
						{ 
						$this->db->select("full_name as full_name1,last_name as last_name1"); 
						$this->db->where(array("id"=>$val["sell_id"]));
						unset($val["sell_id"]);
						$quer1 = $this->db->get(USERS);
						$ar2=$quer1->result_array(); 
						 foreach($val as $key1=>$val1)
						 {
						  $ar2[0][$key1]=$val1;
						 }
                    
						$array []=$ar2;
           				}	
						
						if(count($array)==1)
		{	$this->setErrorMessage('error','No Data found to export');		
		 
		 }
		 else
		 {	
        array_to_csv($array,'OrderPending_'.date('dMyHis').'.csv'); 
		 die();
		 }
         redirect('admin/admin_export/user_export');
      
		
  
  
  
  }
  
  /**
	 * 
	 * This function Exports order paid
	 */
   
   public function export_order2()
  {
		
		
		  	$fields=array("shopsy_users.full_name","shopsy_users.last_name",PRODUCT.".product_name","sell_id","shopsy_user_payment.price","shopsy_user_payment.quantity","is_coupon_used","coupon_id","discountAmount","giftdiscountAmount","couponCode","coupontype","gift_coupon_used"," 	giftcouponID","giftcouponcode","giftcoupontype","shippingid","billingid","indtotal","sumtotal","total","tax","shippingcost","shippingcountry","shippingcity","shippingstate"," 	paidVoucherStatus","paypal_transaction_id","dealCodeNumber","inserttime","shopsy_user_payment.status","shipping_date","tracking_id","shipping_status","payment_type", 	"attribute_values","product_shipping_cost","product_tax_cost","order_gift","payer_email","received_status","review_status");
		 
		 	$fields1=array("Seller first_name","Seller last_name","User full_name","User last_name",PRODUCT.".product_name","shopsy_user_payment.price","shopsy_user_payment.quantity","is_coupon_used","coupon_id","discountAmount","giftdiscountAmount","couponCode","coupontype","gift_coupon_used"," 	giftcouponID","giftcouponcode","giftcoupontype","shippingid","billingid","indtotal","sumtotal","total","tax","shippingcost","shippingcountry","shippingcity","shippingstate"," 	paidVoucherStatus","paypal_transaction_id","dealCodeNumber","inserttime","shopsy_user_payment.status","shipping_date","tracking_id","shipping_status","payment_type", 	"attribute_values","product_shipping_cost","product_tax_cost","order_gift","payer_email","received_status","review_status");
		 $array=array();
		  
	      $labels=capitalizeArraywords($fields1);
				$array[]=array($labels);
					 
						$this->db->join('shopsy_users', 'shopsy_users.id = .shopsy_user_payment.user_id','inner');
						$this->db->join(PRODUCT, PRODUCT.'.id =shopsy_user_payment.product_id','inner');
						$this->db->select(implode(",",$fields)); 
						$where=array("shopsy_user_payment.status"=>"Paid");
		 
		 if($this->input->post("fromDate")!=""&&$this->input->post("toDate")!="")
		 {$minvalue=$this->input->post("fromDate");
		 $maxvalue=$this->input->post("toDate");
		 $where['shopsy_user_payment.created >=']=$minvalue;
		  $where['shopsy_user_payment.created <=']=$maxvalue;

		 }
		 $this->db->where($where);
		 $quer = $this->db->get('shopsy_user_payment');
						$ar1=$quer->result_array();
						foreach($ar1 as $key=>$val)
						{ 
						$this->db->select("full_name as full_name1,last_name as last_name1"); 
						$this->db->where(array("id"=>$val["sell_id"]));
						unset($val["sell_id"]);
						$quer1 = $this->db->get(USERS);
						$ar2=$quer1->result_array(); 
						 foreach($val as $key1=>$val1)
						 {
						  $ar2[0][$key1]=$val1;
						 }
                    
						$array []=$ar2;
					 	
           				}						
          
		
		if(count($array)==1)
		{	$this->setErrorMessage('error','No Data found to export');		
		 
		 }
		 else
		 {	
        array_to_csv($array,'OrderPaid_'.date('dMyHis').'.csv'); 
		 die();
		 }
         redirect('admin/admin_export/user_export');
  
  
  
  }
}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */