<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * User related functions to auction and bidding
 * @author Teamtweaks
 *
 */

class Store extends MY_Controller { 
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form','email'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['selectSeller_details']=$this->seller_model->get_sellers_data(SELLER,array());
		$shopInformations=$this->seller_model->get_all_details(SELLER,array('seller_id'=>$this->checkLogin('U')));				
		$this->data['currentshopurl'] = $shopInformations->row()->seourl;
    }
    
  
	/** 
	* 
	* list of shipping policies
	*
	**/
	public function shippingPolicy(){
		if($this->checkLogin('U')!=''){
			$shopurl=$this->uri->segment(2);
			$seller_id=$this->checkLogin('U');			
			$selectCol="`id`,`seller_id`";
			$sellerChk = $this->product_model->get_column_details(SELLER,array('seourl'=>$shopurl),$selectCol);
			if($sellerChk->num_rows()>0){
				if($sellerChk->row()->seller_id==$seller_id){
					
					$this->data['heading']='Shipping Policies';
					$this->load->view('site/shop/shipping_policy',$this->data);
				}else{
					show_404();
				}
			}else{
				show_404();
			}
		}else{
			$this->setErrorMessage('error','Login Required.');
			redirect('login');
		}
	}
	/** 
	* 
	* list of return policies
	*
	**/
	public function returnPolicy(){
		if($this->checkLogin('U')!=''){
			$shopurl=$this->uri->segment(2);
			$seller_id=$this->checkLogin('U');			
			$selectCol="`id`,`seller_id`";
			$sellerChk = $this->product_model->get_column_details(SELLER,array('seourl'=>$shopurl),$selectCol);
			if($sellerChk->num_rows()>0){
				if($sellerChk->row()->seller_id==$seller_id){
					
					$this->data['heading']='Return Policies';
					$this->load->view('site/shop/return_policy',$this->data);
				}else{
					show_404();
				}
			}else{
				show_404();
			}
		}else{
			$this->setErrorMessage('error','Login Required.');
			redirect('login');
		}
	}
	
}
/* End of file store.php */
/* Location: ./application/controllers/site/store.php */