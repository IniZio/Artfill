<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to Order management 
 * @author Teamtweaks
 *
 */ 

class Cart extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('cart_model');
		if ($this->checkPrivileges('order',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the order list page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/order/display_order_list');
		}
	}	
	public function abandon_cart_list(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {			
			$this->data['heading']= "Abandoned Cart Product";
			$this->data['cart_list'] = $this->cart_model->get_abandon_list();
			
			$this->load->view('admin/cart/abandoned_cart_list',$this->data);
		}
	}
	public function view_cart_detail(){
		$user_id = $this->uri->segment(4,0);
		$this->data['PrdList'] = $this->cart_model->get_cart_values($user_id);
		//echo $this->db->last_query();
		//echo "<pre>";print_r($this->data['user_acrt_values']->result());die;
		$this->load->view('admin/cart/view_cart_detail',$this->data);
	}
	public function sent_notification(){
		$user_id = $this->uri->segment(4,0);
		$user_mail = $this->uri->segment(5,0);
		$cart_product = $this->cart_model->get_cart_values($user_id);
		//echo "<pre>";print_r($cart_product->result());die;
		$newsid='37';
		$template_values=$this->user_model->get_newsletter_template_details($newsid);
		$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'meta_title'=>$this->config->item('meta_title'));
		extract($adminnewstemplateArr);
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		
							$message .='<!DOCTYPE HTML>
								<html>
								<head>
									<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
									<meta name="viewport" content="width=device-width"/>
									<title>Abandoned Cart</title>
								</head>
								<body>
								<div style="width:1012px;background:#FFFFFF; margin:0 auto;">
								<div style="width:100%;background:#454B56; float:left; margin:0 auto;">
									<div style="padding:20px 0 10px 15px;float:left; width:50%;"><a href="'.base_url().'"><img src="'.base_url().'images/logo/'.$this->data['logo'].'" alt="'.$this->config->item('meta_title').'" style="margin:15px 5px 0; padding:0px; border:none;"></a></div>
									
								</div>			
								
									<div style="width:970px;background:#FFFFFF;float:left; padding:20px; border:1px solid #454B56; ">
									
									<div style="  width:100%; margin-bottom:20px; ">
										
											  Hi '.$cart_product->row()->full_name.' HURRY YOU FORGET TO BUY THOSE THING IN '.$this->config->item('email_title').'
											</div>
										
									<div style="float:left; width:100%;">
										<table width="100%" border="0" cellpadding="0" cellspacing="0">
										 <tr bgcolor="#f3f3f3">
											<td width="17%" style="border-right:1px solid #cecece; text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Bag Items</span></td>
											<td width="43%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Product Name</span></td>
											
											<td width="12%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Qty</span></td>
											<td width="12%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Order Date</span></td>
											<td width="14%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Unit Price</span></td>
											<td width="15%" style="text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">Sub Total</span></td>
										</tr>';
										 
											foreach ($cart_product->result() as $cartRow) { $InvImg = @explode(',',$cartRow->image); 
												$unitPrice = $cartRow->price; 
												$uTot = $unitPrice*$cartRow->quantity;
												if($cartRow->attribute_values != ''){ $atr = '<br>'.$cartRow->attribute_values; }elseif($catRow->attribute_values !=''){$atr = '<br>'.$cartRow->attribute_values; }else{ $atr = '';}
											 $message .= '<tr bgcolor="#f3f3f3">
												
											<td style="border-right:1px solid #cecece; text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;"><img src="'. base_url().PRODUCTPATHTHUMB.$InvImg[0].'" alt="'. stripslashes($cartRow->product_name).'" width="70" /></span></td>
											<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'. stripslashes($cartRow->product_name).$atr.'</span></td>
											
											<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">'. strtoupper($cartRow->quantity).'</span></td>
											<td width="12%" style="border-right:1px solid #cecece;text-align:center;"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center;">'. date("F j, Y g:i a",strtotime($cartRow->created)).'</span></td>											
											<td style="border-right:1px solid #cecece;text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">$'.$unitPrice.'</span></td>
											<td style="text-align:center;border-top:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:30px;  text-align:center;">$'.$uTot .'</span></td>
										</tr>'; 
											//echo "<pre";print_r($cartRow);
											 $cart_amount += $uTot;
										}
										$message .='</table>
										<table style="padding-left: 837px;">
										<tr bgcolor="#f3f3f3">
												<td width="87" style="border-right:1px solid #cecece;"><span style="font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; line-height:38px; text-align:center; width:100%; float:left;">Grand Total</span></td>
												<td width="31"><span style="font-size:12px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#000000; line-height:38px; text-align:center; width:100%;  float:left;">$'. $cart_amount .' </span></td>
											  </tr>
											</table>
									</div>
									</div>
								</div>
								</body>
								</html>';  
								//echo $message;

								if($template_values['sender_name']=='' && $template_values['sender_email']==''){
									$sender_email=$this->config->item('site_contact_mail');
									
									$sender_name=$this->config->item('email_title');
								}else{
									$sender_name=$template_values['sender_name'];
									$sender_email=$template_values['sender_email'];
								}
								$email_values = array('mail_type'=>'html',
													'from_mail_id'=>$sender_email,
													'mail_name'=>$sender_name,
													'to_mail_id'=>$user_mail,
													'subject_message'=>'Abandoned Cart',
													'body_messages'=>$message
												);
													
								#echo '<pre>'; print_r($email_values); die;

								$email_send_to_common = $this->product_model->common_email_send($email_values);#die;
						
						redirect('admin/cart/abandon_cart_list');
	}
	public function change_cart_global(){
	//print_r($this->input->post());die;
	//print_r("dfg"); die;
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->seller_model->activeInactiveCommon(USER_SHOPPING_CART,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				$this->setErrorMessage('success','Seller records deleted successfully');
			}else {
				$this->setErrorMessage('success','Seller records status changed successfully');
			}
			redirect('admin/cart/abandon_cart_list');
		}
	}
	
	function delete_cart_product()
	{
		$id=$this->uri->segment(4,0);
		$this->cart_model->commonDelete(USER_SHOPPING_CART,array('id'=>$id));
		redirect('admin/cart/abandon_cart_list');
		
	}
}

/* End of file order.php */
/* Location: ./application/controllers/admin/order.php */