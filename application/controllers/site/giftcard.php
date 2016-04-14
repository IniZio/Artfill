<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * User related functions
 * @author Teamtweaks
 *
 */

class Giftcard extends MY_Controller { 
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model(array('giftcards_model','product_model'));
		
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['likedProducts'] = array();
	 	if ($this->data['loginCheck'] != ''){
	 		$this->data['likedProducts'] = $this->product_model->get_all_details(PRODUCT_LIKES,array('user_id'=>$this->checkLogin('U')));
	 	}
    }
    
  
	/**
	 * 
	 * 
	 */
	
	/*public function index(){
	 	$this->data['heading'] = 'Giftcard'; 
	 	$relatedProducts = $this->product_model->view_product_details(" where p.quantity>0 and p.status='Publish' and u.group='Seller' and u.status='Active' or p.status='Publish' and p.quantity > 0 and p.user_id=0");
		$this->data['relatedProductsArr'] = $relatedProducts->result();
	 	$this->load->view('site/giftcards/giftcards.php',$this->data);
	}*/
	
	/**
	 * 
	 * This function is used for view the gift cards
	 * 
	 */
	public function index(){
		if ($this->checkLogin('U')!=''){
			$this->data['heading'] = 'Giftcard'; 
			$relatedProducts = $this->product_model->view_product_details(" where p.quantity>0 and p.status='Publish' and u.group='Seller' and u.status='Active' or p.status='Publish' and p.quantity > 0 and p.user_id=0");
			$giftDetails = $this->product_model->get_all_details(GIFTCARDS_SETTINGS,array('status'=>'Enable'));
			#echo "<pre>";print_r($giftDetails->result());die;
			$this->data['relatedProductsArr'] = $relatedProducts->result();
			$this->data['giftcardDetails'] = $giftDetails->result();
			
			
			$this->load->view('site/giftcards/giftcards.php',$this->data);
		}else{
			redirect('login');
		}
	}
	
	/**
	 * 
	 * This function is used for view the gift cards
	 * 
	 */
	public function print_at_home(){
		if ($this->checkLogin('U')!=''){
			$this->data['heading'] = 'Giftcard'; 
			$relatedProducts = $this->product_model->view_product_details(" where p.quantity>0 and p.status='Publish' and u.group='Seller' and u.status='Active' or p.status='Publish' and p.quantity > 0 and p.user_id=0");
			$giftDetails = $this->product_model->get_all_details(GIFTCARDS_SETTINGS,array('status'=>'Enable'));
			$this->data['relatedProductsArr'] = $relatedProducts->result();
			$this->data['giftcardDetails'] = $giftDetails->result();
			
			
			$this->load->view('site/giftcards/giftcards_print_home',$this->data);
		}else{
			redirect('login');
		}
	}
	
	/**
	 * 
	 * This function is used for edit the gift cards
	 * param int $id
	 * 
	 */
	public function edit($id){
	 	$this->data['heading'] = 'Giftcard'; 
	 	$relatedProducts = $this->product_model->view_product_details(" where p.quantity>0 and p.status='Publish' and u.group='Seller' and u.status='Active' or p.status='Publish' and p.quantity > 0 and p.user_id=0");
		
		$giftDetails = $this->product_model->get_all_details(GIFTCARDS_SETTINGS,array('status'=>'Enable'));
		$this->data['giftCard'] = $giftCard = $this->product_model->get_all_details(GIFTCARDS_TEMP,array('id'=>$id))->row();
		$this->data['relatedProductsArr'] = $relatedProducts->result();
				
		$this->data['giftcardDetails'] = $giftDetails->result();
		#echo "<pre>"; print_r($giftCard); die;
	 	$this->load->view('site/giftcards/giftcards.php',$this->data);
	}
	
	/**
	 * 
	 * This function is used for insert the gift cards to cart
	 * param int $id
	 * 
	 */
	public function insertEditGiftcard(){
		#echo "<pre>";print_r("adsfasd");die;
		$excludeArr= array('id');
		$dataArrVal = array();
		foreach($this->input->post() as $key => $val){
			if(!(in_array($key,$excludeArr))){
				$dataArrVal[$key] = trim(addslashes($val));
			}
		}
		
		$default_cur_get=$this->giftcards_model->get_all_details(CURRENCY,array('default_currency'=>'Yes','status'=>'Active'));
		$user_cur_get=$this->giftcards_model->get_all_details(USERS,array('id'=>$this->checkLogin('U')));
		$default_cur=$default_cur_get->row()->currency_code;
		$user_cur=$user_cur_get->row()->currency;
		$curval=1;
		$price_value= $this->input->post('price_value');
		if($default_cur != $user_cur){
			$curval=$this->data['currencyValue'];
			$price_value= $this->input->post('price_value')/$curval;
		}
		
		$datestring = "%Y-%m-%d 23:59:59";
		$code = $this->get_rand_str('10');
		$exp_days = $this->config->item('giftcard_expiry_days');
		
		$dataArry_data = array('price_value'=>$price_value,'expiry_date' => mdate($datestring,strtotime($exp_days.' days')), 'code' => $code,'user_id' => $this->data['common_user_id']);
		$dataArr = array_merge($dataArrVal,$dataArry_data);
		
		#echo "<pre>";  print_r($dataArr); die;
		if($this->input->post('id')==''){
			$this->giftcards_model->simple_insert(GIFTCARDS_TEMP,$dataArr);
		}else{
			unset($dataArr['user_id']);
			$condition = array('id'=>$this->input->post('id'));
			$this->giftcards_model->update_details(GIFTCARDS_TEMP,$dataArr,$condition);
		}
		
		
		if ($this->data['loginCheck'] != ''){
			//echo $this->giftcards_model->mini_cart_view($this->data['common_user_id']); 
			redirect('cart');
	 	}else{
			redirect('login');
			//echo 'login';
		}
	}
	

}

/* End of file user.php */
/* Location: ./application/controllers/site/user.php */