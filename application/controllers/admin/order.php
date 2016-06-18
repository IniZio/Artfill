<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to Order management 
 * @author Teamtweaks
 *
 */ 

class Order extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('order_model');
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
	
	/**
	 * 
	 * This function loads the order list page
	 */
	public function display_order_paid(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Order List';
			
			if(isset($_GET['status'])){
				$ship_status=$_GET['status'];
				if($ship_status=='All'){
					$condition="";
				} else {
					$condition =array('shipping_status'=>$ship_status);
				}
			}
			$condit = "(`payment_type` != 'COD' AND `payment_type` != 'wire_transfer' AND `payment_type` != 'western_union')";
			$this->data['orderList'] = $this->order_model->view_order_details('Paid',$condition,$condit);
			$this->data['orderDet'] = $this->order_model->view_order_details('Paid');
			$this->data['tot_orders']=$this->data['orderDet']->num_rows();
			$proCount=0;
			$shipcount=0;
			$delcount=0;
			$cancount=0;
			$oamt=0;
			$todayamt=0;
			$monthamt=0;
			
			//echo "<pre>"; print_r($this->data['orderDet']->result()); die;
			
			foreach($this->data['orderDet']->result() as $row){
				if($row->shipping_status=='Processed'){
					$proCount++;
				}
				if($row->shipping_status=='Shipped'){
					$shipcount++;
				}
				if($row->shipping_status=='Delivered'){
					$delcount++;
				}
				if($row->shipping_status=='Cancelled'){
					$cancount++;
				}
				$oamt+=$row->total;	
				
				
				//echo $row->created."<br>";
				$datecreated = date("Y-m-d", strtotime($row->created));
				$query_date = date('Y-m-d H:i:s');
				$first = date('Y-m-01 H:i:s', strtotime($query_date));
				$last  = date('Y-m-t H:i:s', strtotime($query_date));
				
				if($datecreated == date('Y-m-d')){
					$todayamt+=$row->total;
				}
				
				if($row->created >= $first && $row->created <= $last){
					$monthamt+=$row->total;
				}
				
			}
			
// 			echo $oamt."###<br>";
// 			echo $todayamt."###<br>";
// 			echo $monthamt."###<br>";
			
// 			die;
			$this->data['processed']=$proCount;
			$this->data['shipped']=$shipcount;
			$this->data['delivered']=$delcount;
			$this->data['cancelled']=$cancount;	
			$this->data['order_amount']=$oamt;
			$this->data['today_amount']=$todayamt;
			$this->data['month_amount']=$monthamt;
			$this->load->view('admin/order/display_orders',$this->data);
		}
	}
	
	
	public function display_cancelRequested(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Cancel order Requests';
			$condition =array();
			
			$condit = "(`shipping_status` = 'Processed' OR `shipping_status` = 'Approved for Refund')";
			
			$condition['received_status'] = 'Requested Cancel';
			
			$this->data['orderList'] = $this->order_model->view_order_details_cancelled('Pending',$condition,$condit);
			
			//echo $this->db->last_query(); die;
// 			if(isset($_GET['status'])){
// 				$ship_status=$_GET['status'];
// 				if($ship_status=='All'){
// 					$condition="";
// 				} else {
// 					$condition =array('shipping_status'=>$ship_status);
// 				}
// 			}
// 			$this->data['orderList'] = $this->order_model->view_order_details('Paid',$condition);
			
			
// 			$this->data['orderDet'] = $this->order_model->view_order_details('Paid');
// 			$this->data['tot_orders']=$this->data['orderDet']->num_rows();
// 			$proCount=0;
// 			$shipcount=0;
// 			$delcount=0;
// 			$cancount=0;
// 			$oamt=0;
// 			foreach($this->data['orderDet']->result() as $row){
// 				if($row->shipping_status=='Processed'){
// 					$proCount++;
// 				}
// 				if($row->shipping_status=='Shipped'){
// 					$shipcount++;
// 				}
// 				if($row->shipping_status=='Delivered'){
// 					$delcount++;
// 				}
// 				if($row->shipping_status=='Cancelled'){
// 					$cancount++;
// 				}
// 				$oamt+=$row->total;
// 			}
// 			$this->data['processed']=$proCount;
// 			$this->data['shipped']=$shipcount;
// 			$this->data['delivered']=$delcount;
// 			$this->data['cancelled']=$cancount;
// 			$this->data['order_amount']=$oamt;

			$this->load->view('admin/order/display_cancelOrders',$this->data);
		}
	}
	
	
	
	/**
 *
 * This function loads the order list of cod
 */
		public function display_order_cod(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Order Cash On Delivery';
			$this->data['orderList'] = $this->order_model->view_order_cod('COD');
			$this->load->view('admin/order/display_cod_orders',$this->data);
		}
   	}
	     public function display_order_wiretransfer(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Orders By Wire Transfer';
			$this->data['orderList'] = $this->order_model->view_order_wiretransfer('wire_transfer');
			$this->load->view('admin/order/display_wiretransfer_orders',$this->data);
		}
	  }
	  public function display_order_westernunion(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Orders By Western Union';
			$this->data['orderList'] = $this->order_model->view_order_westernunion('western_union');
			$this->load->view('admin/order/display_westernunion_orders',$this->data);
		}
	  }
	/**
 *
 * This function loads the order list of cod pending
 */
	public function display_order_pending(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		} else {
			$this->data['heading'] = 'Order List';
			$condit = "(`payment_type` != 'COD' AND `payment_type` != 'wire_transfer' AND `payment_type` != 'western_union')";
			$condition ='';
			$this->data['orderList'] = $this->order_model->view_order_details('Pending',$condition, $condit);
			$this->data['tot_orders']=$this->data['orderList']->num_rows();
			$oamt=0;
			foreach($this->data['orderList']->result() as $row){
				
				$oamt+=$row->total;	
			}
			$this->data['order_amount']=$oamt;
			$this->load->view('admin/order/display_orders_pending',$this->data);
		}
	}
	public function subviewDetails(){
		echo $this->input->post('dealId');
	
	}
	/**
	 * 
	 * This function loads the order view page
	 */
	public function view_order(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'View Order';
			$user_id = $this->uri->segment(4,0);
			$deal_id = $this->uri->segment(5,0);
			$this->data['ViewList'] = $this->order_model->view_orders($user_id,$deal_id);
			$this->load->view('admin/order/view_orders',$this->data);
		}
	}
	
	/**
	 * 
	 * This function delete the order record from db
	 */
	public function delete_order(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$order_id = $this->uri->segment(4,0);
			$condition = array('id' => $order_id);
			
			$this->order_model->commonDelete(USER_PAYMENT,array('dealCodeNumber'=>$order_id,'status'=>'Pending'));
			
			$this->setErrorMessage('success','Order deleted successfully');
			redirect('admin/order/display_order_pending');
		}
	}
	/**
	 * 
	 * This function reviews the order record from db
	 */
	public function order_review(){
		if ($this->checkLogin('A')==''){
			show_404();
		}else {
			$dealCode = $this->uri->segment(2,0);
			//$order_details = $this->order_model->get_all_details(PAYMENT,array('dealCodeNumber'=>$dealCode,'status'=>'Paid'));
			
				$this->db->select('p.*,pAr.attr_name');
				$this->db->from(PAYMENT.' as p');
				$this->db->join(PRODUCT_ATTRIBUTE.' as pAr' , 'pAr.id = p.attribute_values','left');
				$this->db->where('p.status = "Paid" and p.dealCodeNumber = "'.$dealCode.'"');
				$order_details = $this->db->get();
			
			
			if ($order_details->num_rows()==0){
				show_404();
			}else {
				foreach ($order_details->result() as $order_details_row){
					$this->data['prod_details'][$order_details_row->product_id] = $this->order_model->get_all_details(PRODUCT,array('id'=>$order_details_row->product_id));
				}
				$this->data['order_details'] = $order_details;
				$this->data['heading'] = 'View Order Comments';
				$sortArr1 = array('field'=>'date','type'=>'desc');
				$sortArr = array($sortArr1);
				$this->data['order_comments'] = $this->order_model->get_all_details(REVIEW_COMMENTS,array('deal_code'=>$dealCode),$sortArr);
				$this->load->view('admin/order/display_order_reviews',$this->data);
			}
		}
	}
	/**
	 * 
	 * This function post the comment in order 
	 */

	public function post_order_comment(){
		if ($this->checkLogin('A') != ''){
			$this->order_model->commonInsertUpdate(REVIEW_COMMENTS,'insert',array(),array(),'');
		}
	}
	/**
	 * 
	 * This function update the order status 
	 */
	public function order_update(){
		if ($this->checkLogin('A')==''){
			redirect('admin');
		}else {
			$dealCode = $this->input->post('dealCodeNumber');
			$shipping_status = $this->input->post('shipping_status');
			$dataArr=array('shipping_status'=>$shipping_status);
			
			$refund = $this->input->post('refund_msg');			
			if(isset($refund)){
				$dataArr['cancelledMessage'] = $refund; 
			}

			$condition=array('dealCodeNumber'=>$dealCode);
			$order_details = $this->order_model->update_details(USER_PAYMENT,$dataArr,$condition);
			
			if($order_details){
				$this->setErrorMessage('success','Order Status Updated Successfully');
				echo 'Success';
			}else{
				$this->setErrorMessage('error','Order Status Updated Failed');			
				echo 'error';
			}
			
		}
	}
	
	
	
	
	public function order_update_text(){
		if ($this->checkLogin('A')==''){
			redirect('admin');
		}else {
			 #echo "<pre>"; print_r($_POST);DIE;
			$dealCode = $this->input->post('dealCodeNumber');
			$shipping_status = $this->input->post('shipping_status');
			$dataArr=array('shipping_status'=>$shipping_status);

			$shippingMessage = $this->input->post('shippingMessage');
			
			if($shipping_status == 'Delivered'){
				$dataArr['received_status'] = 'Product received';
			}
			
			if(isset($shippingMessage) && $shippingMessage != ''){
				$dataArr['statusMessage'] = $shippingMessage;
			}
			
			$shippingId = $this->input->post('trackingId');
			if(isset($shippingId) && $shippingId != ''){
				$dataArr['trackingId'] = $shippingId;
			}
			
			$refund = $this->input->post('refund_msg');
			if(isset($refund) && $refund != ''){
				//$dataArr['statusMessage'] = $refund;
				$dataArr['cancelledMessage'] = $refund;
			}
			
			$estdate = $this->input->post('eventDate');
			if(isset($estdate) && $estdate != ''){
				$dataArr['estDate'] = $estdate;
			}
			
			
			//print_r($dataArr);
	
			$condition=array('dealCodeNumber'=>$dealCode);
			
			$order_details = $this->order_model->update_details(USER_PAYMENT,$dataArr,$condition);

			$orderDetails = $this->order_model->get_all_details(USER_PAYMENT,$condition);
			
			$buyerDetails = $this->order_model->get_all_details(USERS,array('id'=>$orderDetails->row()->user_id));
			
			$sellerDetails = $this->order_model->get_all_details(USERS,array('id'=>$orderDetails->row()->sell_id));
			
			$newsid='35';
			
			$orderid = $dealCode;
			$orderstatus = $shipping_status;
			$content .="";
			
			if($orderDetails->row()->statusMessage != ''){
				$content .= "comment : ".$orderDetails->row()->statusMessage."<br>";
			}
			
			if($orderDetails->row()->cancelledMessage != ''){
				$content .= "Your Request for Refund has been Accepted and Refunded.<br>comment : ".$orderDetails->row()->cancelledMessage."<br>";
			}
			
			if($shipping_status == Shipped){
				$content .= "Estimated Delivery Date : ".$orderDetails->row()->estDate."<br>".
							"Shiping Id : ".$orderDetails->row()->trackingId."<br>"; 
			}
			
			$sender_email = $this->data['siteContactMail']; 
			$receive_email =  $buyerDetails->row()->email;
			$cc_mail_id = $sellerDetails->row()->email;
			
			$template_values=$this->order_model->get_newsletter_template_details($newsid);
			$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
			//$discussionurl=base_url().'discussion/'.$orderid;
			
			$viewurl = base_url().'view-order-pre/'.$orderDetails->row()->user_id.'/'.$orderid;
			
			$adminnewstemplateArr=array('email_title'=> $this->config->item('email_title'),'logo'=> $this->data['logo'],'footer_content'=> $this->config->item('footer_content'),'content' => $content,'orderid'=>$orderid,'orderstatus'=>$orderstatus,'viewurl'=>$viewurl);
			extract($adminnewstemplateArr);
			$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
				
			$message .= '<!DOCTYPE HTML>
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width"/><body>';
			include('./newsletter/registeration'.$newsid.'.php');
			$message .= '</body>
		</html>';
			$email_values = array('mail_type'=>'html',
					'from_mail_id'=>$sender_email,
					'to_mail_id'=>$receive_email,
					'cc_mail_id'=>$cc_mail_id,
					'bcc_mail_id'=>$sender_email,
					'subject_message'=>$subject ,
					'body_messages'=>$message
			);
			/*echo $header;
			 echo $message; exit;*/
			//echo '<pre>'; print_r($email_values);	die;
			$email_send_to_common = $this->order_model->common_email_send($email_values);
			
			
			if($order_details){
				$this->setErrorMessage('success','Order Status Updated Successfully');
				//echo 'Success';
				if($shipping_status == 'Cancelled'){
					redirect("admin/order/display_cancelRequested");
				}else{
					redirect("admin/order/display_order_paid");
				}
				
			}else{
				$this->setErrorMessage('error','Order Status Updated Failed');
				//echo 'error';
				if($shipping_status == 'Cancelled'){
					redirect("admin/order/display_cancelRequested");
				}else{
					redirect("admin/order/display_order_paid");
				}
				
			}
				
		}
	}
	
	
	/**
	 * 
	 * This function update the payment status of order in db
	 */
	public function order_payupdate(){
		if ($this->checkLogin('A')==''){
			redirect('admin');
		}else {
			$dealCode = $this->input->post('dealCodeNumber');
			$shipping_status = $this->input->post('payment_status');
			$dataArr=array('status'=>$shipping_status);
			$condition=array('dealCodeNumber'=>$dealCode);
			$order_details = $this->order_model->update_details(USER_PAYMENT,$dataArr,$condition);
			if($order_details){
					$dataArr=array('shipping_status'=>"Delivered");
			        $condition=array('dealCodeNumber'=>$dealCode);
			        $order_details = $this->order_model->update_details(USER_PAYMENT,$dataArr,$condition);
				$this->setErrorMessage('success','Order Status Updated Successfully');
				echo 'Success';
			}else{
				$this->setErrorMessage('error','Order Status Updated Failed');			
				echo 'error';
			}
		}
	}
	
}

/* End of file order.php */
/* Location: ./application/controllers/admin/order.php */