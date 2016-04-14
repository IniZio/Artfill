<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * This controller contains the functions related to seller commission tracking
 * @author Teamtweaks
 *
 */

class Commission extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('commission_model','commission');
		$this->load->model('order_model');
		$this->load->model('seller_model');
		if ($this->checkPrivileges('seller',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the seller commission tracking page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			show_404();
		}else {
			redirect('admin/commission/display_commission_lists');
		}
	}
	/**
     * 
     * This function loads the seller commission tracking list Page
     */
	public function display_commission_lists(){
		if ($this->checkLogin('A') == ''){
			show_404();
		}else {
			$this->data['heading'] = 'Site Earnings ';
			$sellerDetails = $this->commission->get_all_details(USERS,array('group'=>'Seller','status'=>'Active'));
			if ($sellerDetails->num_rows()>0){
				foreach ($sellerDetails->result() as $sellerDetailsRow){
					$orderDetails[$sellerDetailsRow->id] = $this->commission->get_total_order_amount($sellerDetailsRow->id);
					$admincommi[$sellerDetailsRow->id] = $this->commission->get_total_order_amounts($sellerDetailsRow->id);
					$disputeDetails[$sellerDetailsRow->id] = $this->commission->get_dispute_order_amount($sellerDetailsRow->id);
					/* echo "<pre>";print_r($orderDetails[$sellerDetailsRow->id]->row());
					echo "<pre>";print_r($admincommi[$sellerDetailsRow->id]->row());
					echo "<pre>";print_r($disputeDetails[$sellerDetailsRow->id]->row());die;
					 */$refund_amt = $sellerDetailsRow->refund_amount;
					$commission_to_admin[$sellerDetailsRow->id] = 0;
					$amount_to_vendor[$sellerDetailsRow->id] = 0;
					$total_amount = 0;
					$this->data['total_amount'][$sellerDetailsRow->id] = $total_amount;
					$total_orders = 0;
					if ($orderDetails[$sellerDetailsRow->id]->num_rows()==1){
						$commission_percentage = $sellerDetailsRow->commision;
						//$total_amount = $orderDetails[$sellerDetailsRow->id]->row()->TotalAmt;
						$user_refund=$this->seller_model->get_all_details(USERS,array('id'=>$sellerDetailsRow->id))->row()->refund_amount;	
						$total_amount = $this->seller_model->get_total_order_amount($sellerDetailsRow->id)->row()->TotalAmt;
						
						
						$total_amount = $total_amount-$user_refund;
						
						
						
						$claim_amount = $orderDetails[$sellerDetailsRow->id]->row()->ClaimAmt;
						
						$this->data['claim_amount'][$sellerDetailsRow->id] = $claim_amount;
						$this->data['total_amount'][$sellerDetailsRow->id] = $total_amount  ;
						$claim_amount = $claim_amount;
						$total_amount = $total_amount - $claim_amount;
						$this->data['commission_to_admin'][$sellerDetailsRow->id] = $commission_to_admin[$sellerDetailsRow->id]= $this->seller_model->get_admin_commission($sellerDetailsRow->id)->row()->admin_commission;
						//$commission_to_admin[$sellerDetailsRow->id] = ($admincommi[$sellerDetailsRow->id]->row()->TotalAmt - $disputeDetails[$sellerDetailsRow->id]->row()->TotalAmt);
						/*  echo "Total amount:".$total_amount."admin commission ".$admincommi[$sellerDetailsRow->id]->row()->TotalAmt."  dispute amt: ".$disputeDetails[$sellerDetailsRow->id]->row()->TotalAmt."<br>";
						echo "commission_to_admin".$commission_to_admin[$sellerDetailsRow->id]."<br>";
						 */ if ($commission_to_admin[$sellerDetailsRow->id]<0)
							$commission_to_admin[$sellerDetailsRow->id]=0;
						$amount_to_vendor[$sellerDetailsRow->id] = $total_amount - $commission_to_admin[$sellerDetailsRow->id];
						if ($amount_to_vendor[$sellerDetailsRow->id]<0)
							$amount_to_vendor[$sellerDetailsRow->id]=0;
						$total_orders = $orderDetails[$sellerDetailsRow->id]->row()->orders;
					}
					$paidDetails = $this->commission->get_total_paid_details($sellerDetailsRow->id);
					$paid_to[$sellerDetailsRow->id] = 0;
					if ($paidDetails->num_rows()==1){
						$paid_to[$sellerDetailsRow->id] = $paidDetails->row()->totalPaid;
						if ($paid_to[$sellerDetailsRow->id]<0)$paid_to[$sellerDetailsRow->id]=0;
					}
					$paid_to_balance[$sellerDetailsRow->id] = $amount_to_vendor[$sellerDetailsRow->id]-$paid_to[$sellerDetailsRow->id];
					if ($paid_to_balance[$sellerDetailsRow->id]<0)$paid_to_balance[$sellerDetailsRow->id]=0;
					$this->data['total_orders'][$sellerDetailsRow->id] = $total_orders;
					
					$this->data['amount_to_vendor'][$sellerDetailsRow->id] = $amount_to_vendor[$sellerDetailsRow->id] ;
					//echo $amount_to_vendor[$sellerDetailsRow->id] ."-". $commission_to_admin[$sellerDetailsRow->id]."<br>" ;
					$this->data['paid_to'][$sellerDetailsRow->id] = $paid_to[$sellerDetailsRow->id];
					$this->data['paid_to_balance'][$sellerDetailsRow->id] = $paid_to_balance[$sellerDetailsRow->id];
				}
			}//die;
			$this->data['sellerDetails'] = $sellerDetails;//die;
			$this->load->view('admin/commission/display_commission_lists',$this->data);
		}
	}
	/**
     * 
     * This function loads the seller commission tracking list Page for Adaptive payment
     */
	public function display_commission_lists_adaptive(){
		if ($this->checkLogin('A') == ''){
			show_404();
		}else {
			$this->data['heading'] = 'Site Earnings ';
			$sellerDetails = $this->commission->get_all_details(USERS,array('group'=>'Seller','status'=>'Active'));
			
			if ($sellerDetails->num_rows()>0){
				foreach ($sellerDetails->result() as $sellerDetailsRow){
					$orderDetails[$sellerDetailsRow->id] = $this->commission->get_total_order_amount_adaptive($sellerDetailsRow->id);		
					#echo '<pre>'; print_r($orderDetails[$sellerDetailsRow->id]->result_array());
					$refund_amt = $sellerDetailsRow->refund_amount;
					$commission_to_admin[$sellerDetailsRow->id] = 0;
					$amount_to_vendor[$sellerDetailsRow->id] = 0;
					$total_amount = 0;
					$cod_amount = 0;
					$this->data['total_amount'][$sellerDetailsRow->id] = $total_amount;
					$total_orders = 0;
					
					if ($orderDetails[$sellerDetailsRow->id]->num_rows()==1){
						$commission_percentage = $sellerDetailsRow->commision;
						$total_amount = $orderDetails[$sellerDetailsRow->id]->row()->TotalAmt;
						$this->data['total_amount'][$sellerDetailsRow->id] = $total_amount;
						$total_amount = $total_amount-$refund_amt;
											
						
						$claim_amount = $orderDetails[$sellerDetailsRow->id]->row()->ClaimAmt;
						$this->data['claim_amount'][$sellerDetailsRow->id] = $claim_amount;
						$claim_amount = $claim_amount;
						$total_amount = $total_amount - $claim_amount;
						
						$commission_to_admin[$sellerDetailsRow->id] = $total_amount*($commission_percentage*0.01);
						if ($commission_to_admin[$sellerDetailsRow->id]<0)$commission_to_admin[$sellerDetailsRow->id]=0;
						$amount_to_vendor[$sellerDetailsRow->id] = $total_amount-$commission_to_admin[$sellerDetailsRow->id];
						if ($amount_to_vendor[$sellerDetailsRow->id]<0)$amount_to_vendor[$sellerDetailsRow->id]=0;
						$total_orders = $orderDetails[$sellerDetailsRow->id]->row()->orders;
					}
					
										
					/**/
					$codDetails[$sellerDetailsRow->id] = $this->commission->get_total_cod_amount($sellerDetailsRow->id);
					$cod_amount = $codDetails[$sellerDetailsRow->id]->row()->TotalAmt;
					$this->data['cod_amount'][$sellerDetailsRow->id] = $cod_amount;
						
					$commission_to_adminCOD[$sellerDetailsRow->id] = $cod_amount*($commission_percentage*0.01);
					if ($commission_to_adminCOD[$sellerDetailsRow->id]<0)$commission_to_adminCOD[$sellerDetailsRow->id]=0;
					
					$codpaidDetails = $this->commission->get_cod_paid_details($sellerDetailsRow->id);
					$cod_paid[$sellerDetailsRow->id] = 0;
					if ($codpaidDetails->num_rows()>0){
						$cod_paid[$sellerDetailsRow->id] = $codpaidDetails->row()->codPaid;
						if ($cod_paid[$sellerDetailsRow->id]<0)$cod_paid[$sellerDetailsRow->id]=0;
					}
					/**/
						
					
					
					$paidDetails = $this->commission->get_total_paid_details($sellerDetailsRow->id);
					$paid_to[$sellerDetailsRow->id] = 0;
					if ($paidDetails->num_rows()==1){
						$paid_to[$sellerDetailsRow->id] = $paidDetails->row()->totalPaid;
						if ($paid_to[$sellerDetailsRow->id]<0)$paid_to[$sellerDetailsRow->id]=0;
					}
					$paid_to_balance[$sellerDetailsRow->id] = $amount_to_vendor[$sellerDetailsRow->id]-$paid_to[$sellerDetailsRow->id];
					if ($paid_to_balance[$sellerDetailsRow->id]<0)$paid_to_balance[$sellerDetailsRow->id]=0;
					$this->data['total_orders'][$sellerDetailsRow->id] = $total_orders;
					$this->data['commission_to_admin'][$sellerDetailsRow->id] = $commission_to_admin[$sellerDetailsRow->id];
					/**/
					$this->data['cod_commision'][$sellerDetailsRow->id] = $commission_to_adminCOD[$sellerDetailsRow->id];
					$this->data['cod_paid'][$sellerDetailsRow->id] = $cod_paid[$sellerDetailsRow->id];
					/**/
					$this->data['amount_to_vendor'][$sellerDetailsRow->id] = $amount_to_vendor[$sellerDetailsRow->id];
					$this->data['paid_to'][$sellerDetailsRow->id] = $paid_to[$sellerDetailsRow->id];
					$this->data['paid_to_balance'][$sellerDetailsRow->id] = $paid_to_balance[$sellerDetailsRow->id];
				}
			}
			
			$this->data['sellerDetails'] = $sellerDetails;
			$this->load->view('admin/commission/display_commission_lists_adaptive',$this->data);
		}
	}
	/**
     * 
     * This function loads the seller paid commission list Page
     */
	public function view_paid_details(){
		if ($this->checkLogin('A') == ''){
			show_404();
		}else {
			$this->data['heading'] = 'Vendor payment details';
			$sid = $this->uri->segment(4,0);
			$this->data['paidDetails'] = $this->commission->get_all_details(VENDOR_PAYMENT,array('vendor_id'=>$sid,'status'=>'success'));
			$this->load->view('admin/commission/view_paid_details',$this->data);
		}
	}
	/**
     * 
     * This function loads the pay form to pay the commission
     */
	public function add_pay_form(){
		if ($this->checkLogin('A') == ''){
			show_404();
		}else {
			$this->data['heading'] = 'Add vendor payment';
			$sid = $this->uri->segment(4,0);
			$this->data['sellerDetails'] = $this->commission->get_all_details(USERS,array('group'=>'Seller','id'=>$sid));
			if ($this->data['sellerDetails']->num_rows()==1){
				$this->data['orderDetails'] = $this->commission->get_total_order_amount($sid);
				#echo "<pre>";print_r($this->data['orderDetails']->row());
				$this->data['dispute'] = $this->commission->get_dispute_order_amount($sid);
				$this->data['orderDetails1'] = $this->commission->get_total_order_amounts($sid);
				$commission_percentage = $this->data['sellerDetails']->row()->commision;
				$total_amount = 0;
				if ($this->data['orderDetails']->num_rows()==1 && $this->data['dispute']->num_rows()==1 &&$this->data['orderDetails1']->num_rows()==1){
					$total_amount = $this->data['orderDetails']->row()->TotalAmt;
					$admin_commi = $this->data['orderDetails1']->row()->TotalAmt;
					$disput_amt=$this->data['dispute']->row()->TotalAmt;
				}
				#echo "admin_commi".$admin_commi."disput_amt".$disput_amt."<br>";;
				$this->data['total_amount'] = $total_amount;
				$total_amount = $total_amount-$this->data['sellerDetails']->row()->refund_amount;
				$commission_to_admin = ($admin_commi - $disput_amt);
				#echo $commission_to_admin;die;
				if ($commission_to_admin<0)$commission_to_admin=0;
				$amount_to_vendor = $total_amount - $commission_to_admin-$this->data['orderDetails']->row()->ClaimAmt;
				if ($amount_to_vendor<0)$amount_to_vendor=0;
				$this->data['paidDetails'] = $this->commission->get_total_paid_details($sid);
				$paid_to = 0;
				if ($this->data['paidDetails']->num_rows()==1){
					$paid_to = $this->data['paidDetails']->row()->totalPaid;
					if ($paid_to<0)$paid_to=0;
				}
				$paid_to_balance = $amount_to_vendor-$paid_to;
				if ($paid_to_balance<0)$paid_to_balance=0;
				$this->data['commission_to_admin'] = $commission_to_admin;
				$this->data['amount_to_vendor'] = $amount_to_vendor;
				$this->data['paid_to'] = $paid_to;
				$this->data['paid_to_balance'] = $paid_to_balance;
				$this->load->view('admin/commission/add_vendor_payment',$this->data);
			}else {
				show_404();
			}
		}
	}
	/**
     * 
     * This function makes payment & update value in db
     */
	public function add_vendor_payment(){
		if ($this->checkLogin('A') == ''){
			show_404();
		}else {
			if (!$this->data['demoserverChk']){
				
				/*$balance = $this->input->post('balance_due');
				$amount = $this->input->post('amount');
				if ($amount>$balance){
					$this->setErrorMessage('error','Amount exceeds the balance due');
					echo "<script>window.history.go(-1);</script>";exit();
				}else {
					$trans_id = $this->input->post('transaction_id');
					$duplicateCheck = $this->commission->get_all_details(VENDOR_PAYMENT,array('transaction_id'=>$trans_id));
					if ($duplicateCheck->num_rows()>0){
						$this->setErrorMessage('error','Transaction id already exists');
						echo "<script>window.history.go(-1);</script>";exit();
					}else {
						$excludeArr = array('balance_due');
						$this->commission->commonInsertUpdate(VENDOR_PAYMENT,'insert',$excludeArr,array());
						$this->setErrorMessage('success','Payment added successfully');
						redirect('admin/commission/view_paid_details/'.$this->input->post('vendor_id'));
					}
				}*/		
				$balance = $this->input->post('balance_due');
				$amount = $this->input->post('amount');
				$seller_id = $this->input->post('vendor_id');
				if ($amount>$balance){
					$this->setErrorMessage('error','Amount exceeds the balance due');
					echo "<script>window.history.go(-1);</script>";exit();
				}else {
					$randNumber = time();
					$key = 'team-shopsy-clone-tweaks';
					$encrypted_string = $this->encrypt->encode($randNumber, $key);
					
					$dataArr = array(
						'transaction_id'	=>	$randNumber,
						'payment_type'		=>	'paypal',
						'amount'			=>	$amount,
						'status'			=>	'pending',
						'vendor_id'			=>	$seller_id
					);
					$this->commission->simple_insert(VENDOR_PAYMENT,$dataArr);
					$this->data['randNumber'] = $randNumber;
					$this->data['code'] = $encrypted_string;
					$this->data['amount'] = $amount;
					$this->data['admin_id'] = $this->encrypt->encode($this->checkLogin('A'), $key);
					$this->data['seller_id'] = $this->encrypt->encode($seller_id, $key);
					$this->data['paypal_email'] = $this->input->post('paypal_email');
					$this->data['currencyList'] = $this->commission->get_all_details(CURRENCY,array('default_currency'=>'Yes'));
					#echo "<pre>";print_r($this->data['currencyList']->row());die;
					$this->load->view('admin/commission/paypal_form',$this->data);
				}
		
			}else {
				$this->setErrorMessage('error','You are in demo mode. Settings cannot be changed');
				redirect('admin/commission/display_commission_lists');
			}
}
	}
	/**
     * 
     * This function makes payment & update value in db
     */
	public function add_vendor_payment_manual(){
		if ($this->checkLogin('A') == ''){
			show_404();
		}else {
			$balance = $this->input->post('balance_due');
			$amount = $this->input->post('amount');
			if ($amount>$balance){
				$this->setErrorMessage('error','Amount exceeds the balance due');
				echo "<script>window.history.go(-1);</script>";exit();
			}else {
				$trans_id = $this->input->post('transaction_id');
				$duplicateCheck = $this->commission->get_all_details(VENDOR_PAYMENT,array('transaction_id'=>$trans_id));
				if ($duplicateCheck->num_rows()>0){
					$this->setErrorMessage('error','Transaction id already exists');
					echo "<script>window.history.go(-1);</script>";exit();
				}else {
					$excludeArr = array('balance_due');
					$this->commission->commonInsertUpdate(VENDOR_PAYMENT,'insert',$excludeArr,array());
					$this->setErrorMessage('success','Payment added successfully');
					redirect('admin/commission/view_paid_details/'.$this->input->post('vendor_id'));
				}
			}
		
		}
	}
	/**
     * 
     * This function loads payment success page
     */
	public function display_payment_success(){
		
			$msg = $this->input->get('msg');
			if ($msg == 'success'){
				$key = 'team-shopsy-clone-tweaks';
				$randNumber = $this->encrypt->decode($this->input->get('trans'), $key);
				$seller_id = $this->encrypt->decode($this->input->get('sellId'),$key);
				$admin_id = $this->encrypt->decode($this->input->get('modeVal'),$key);
				
				$dataArr = array('status'=>'success');
				$this->commission->update_details(VENDOR_PAYMENT,$dataArr,array('transaction_id'=>$randNumber,'vendor_id'=>$seller_id));
				$this->commission->update_details(USERS,array('send_req'=>'No','withdraw_amt'=>0.00),array('id'=>$seller_id));
					
				$this->data['heading'] = 'Payment Success';
				$this->load->view('admin/commission/payment_success',$this->data);
				
			}
		
	}
	/**
     * 
     * This function loads payment failure page
     */
	public function display_payment_failed(){
		if ($this->checkLogin('A')!=''){
			$this->data['heading'] = 'Payment Failure';
			$this->load->view('admin/commission/payment_failed',$this->data);
		}else {
			show_404();
		}
	}
	/**
     * 
     * This function loads cod list page
     */
	public function display_cod_lists(){
		if ($this->checkLogin('A') == ''){
			show_404();
		}else {
			$this->data['heading'] = 'COD Earnings ';
			$sellerDetails = $this->commission->get_all_details(USERS,array('group'=>'Seller','status'=>'Active'));
			if ($sellerDetails->num_rows()>0){
				foreach ($sellerDetails->result() as $sellerDetailsRow){
					$cod_amount = 0;
					$total_orders = 0;
					$commission_percentage = $sellerDetailsRow->commision;
					/**/
					$codDetails[$sellerDetailsRow->id] = $this->commission->get_total_cod_amount($sellerDetailsRow->id);
					$cod_amount = $codDetails[$sellerDetailsRow->id]->row()->TotalAmt;
					$this->data['cod_amount'][$sellerDetailsRow->id] = $cod_amount;
					
					$total_orders = $codDetails[$sellerDetailsRow->id]->row()->orders;
					$this->data['cod_orders'][$sellerDetailsRow->id] = $total_orders;
						
					$commission_to_adminCOD[$sellerDetailsRow->id] = $cod_amount*($commission_percentage*0.01);
					if ($commission_to_adminCOD[$sellerDetailsRow->id]<0)$commission_to_adminCOD[$sellerDetailsRow->id]=0;
					
					$codpaidDetails = $this->commission->get_cod_paid_details($sellerDetailsRow->id);
					$cod_paid[$sellerDetailsRow->id] = 0;
					if ($codpaidDetails->num_rows()>0){
						$cod_paid[$sellerDetailsRow->id] = $codpaidDetails->row()->codPaid;
						if ($cod_paid[$sellerDetailsRow->id]<0)$cod_paid[$sellerDetailsRow->id]=0;
					}
					
					$this->data['cod_commision'][$sellerDetailsRow->id] = $commission_to_adminCOD[$sellerDetailsRow->id];
					$this->data['cod_paid'][$sellerDetailsRow->id] = $cod_paid[$sellerDetailsRow->id];
					/**/
					
				}
			}
			
			$this->data['sellerDetails'] = $sellerDetails;
			$this->load->view('admin/commission/display_cod_lists',$this->data);
		}
	}
	/**
     * 
     * This function loads cod view page of a seller
     */
	public function view_cod_details(){
		if ($this->checkLogin('A') == ''){
			show_404();
		}else {
			$this->data['heading'] = 'COD payment details';
			$sid = $this->uri->segment(4,0);
			$this->data['codDetails'] = $this->commission->get_all_details(COD_PAYMENT,array('seller_id'=>$sid));
			$this->load->view('admin/commission/view_cod_details',$this->data);
		}
	}
	/**
     * 
     * This function exports csv of commission tracking 
     */
	function export_csv()
	{
		$sellerDetails = $this->commission->get_all_details(USERS,array('group'=>'Seller','status'=>'Active'));
			if ($sellerDetails->num_rows()>0){
				foreach ($sellerDetails->result() as $sellerDetailsRow) {
					$payEmail[$sellerDetailsRow->id] = $this->commission->get_seller_paypal_email($sellerDetailsRow->id);
					#echo '<pre>'; print_r($payEmail->result());die;
					$orderDetails[$sellerDetailsRow->id] = $this->commission->get_total_order_amount($sellerDetailsRow->id);
					#var_dump($orderDetails[$sellerDetailsRow->id]); exit;
					$refund_amt = $sellerDetailsRow->refund_amount;
					$commission_to_admin[$sellerDetailsRow->id] = 0;
					$amount_to_vendor[$sellerDetailsRow->id] = 0;
					$total_amount = 0;
					$this->data['total_amount'][$sellerDetailsRow->id] = $total_amount;
					#echo '<pre>'; print_r($orderDetails[$sellerDetailsRow->id]); exit;
					if ($orderDetails[$sellerDetailsRow->id]->num_rows()==1){
						$commission_percentage = $sellerDetailsRow->commision;
						#print_r($commission_percentage); exit;
						$total_amount = $orderDetails[$sellerDetailsRow->id]->row()->TotalAmt;
						$this->data['total_amount'][$sellerDetailsRow->id] = $total_amount;
						$total_amount = $total_amount-$refund_amt;
						#print_r($total_amount); exit;
						$claim_amount = $orderDetails[$sellerDetailsRow->id]->row()->ClaimAmt;
						$this->data['claim_amount'][$sellerDetailsRow->id] = $claim_amount;
						$total_amount = $total_amount - $claim_amount;
						$commission_to_admin[$sellerDetailsRow->id] = $total_amount*($commission_percentage*0.01);
						if ($commission_to_admin[$sellerDetailsRow->id]<0)$commission_to_admin[$sellerDetailsRow->id]=0;
						$amount_to_vendor[$sellerDetailsRow->id] = $total_amount-$commission_to_admin[$sellerDetailsRow->id];
						if ($amount_to_vendor[$sellerDetailsRow->id]<0)$amount_to_vendor[$sellerDetailsRow->id]=0;
					}
					$paidDetails = $this->commission->get_total_paid_details($sellerDetailsRow->id);
					$paid_to[$sellerDetailsRow->id] = 0;
					if ($paidDetails->num_rows()==1){
						$paid_to[$sellerDetailsRow->id] = $paidDetails->row()->totalPaid;
						if ($paid_to[$sellerDetailsRow->id]<0)$paid_to[$sellerDetailsRow->id]=0;
					}
					$paid_to_balance[$sellerDetailsRow->id] = $amount_to_vendor[$sellerDetailsRow->id]-$paid_to[$sellerDetailsRow->id];
					if ($paid_to_balance[$sellerDetailsRow->id]<0)$paid_to_balance[$sellerDetailsRow->id]=0;
					//$this->data['total_orders'][$sellerDetailsRow->id] = $total_orders;
					//$this->data['commission_to_admin'][$sellerDetailsRow->id] = $commission_to_admin[$sellerDetailsRow->id];
					$amount_to_vendor[$sellerDetailsRow->id] = $amount_to_vendor[$sellerDetailsRow->id];
					//$this->data['paid_to'][$sellerDetailsRow->id] = $paid_to[$sellerDetailsRow->id];
					$paid_to_balance[$sellerDetailsRow->id] = $paid_to_balance[$sellerDetailsRow->id];
					
					$fee_cond = array();
					$get_fees = $this->commission->get_all_details(ADMIN_SETTINGS,$fee_cond);
					$show_fees = $get_fees->row()->payment_fee;
					
					$percentage = $show_fees;
					$total_payment[$sellerDetailsRow->id] = $paid_to_balance[$sellerDetailsRow->id];
					$this->data['formula'][$sellerDetailsRow->id] = (($percentage/100)*$total_payment[$sellerDetailsRow->id]);
					$formula[$sellerDetailsRow->id] = $this->data['formula'][$sellerDetailsRow->id];
				}
			}
		#echo '<pre>'; print_r($sellerDetails->result());die;
			
		$out = '';	$payidval=0;
		if ($sellerDetails->num_rows()>0){
			foreach ($sellerDetails->result() as $sellerDetailsRow){
				if($sellerDetailsRow->id != 1){
					
					if(round($paid_to_balance[$sellerDetailsRow->id]) > 0){
						$payidval = 1;
						$out .= $payEmail[$sellerDetailsRow->id]->row()->payemail.',';
						$out .= '$'.$paid_to_balance[$sellerDetailsRow->id].',';
						$out .= 'USD,';
						$out .= 'Thank you for your business';
						$out .= "\n";
						
						$dataArr = array(
						'transaction_id'	=>	time(),
						'payment_type'		=>	'paypal',
						'amount'			=>	$paid_to_balance[$sellerDetailsRow->id],						
						'status'			=>	'pending',
						'vendor_id'			=>	$sellerDetailsRow->id
						);
					$this->commission->simple_insert(VENDOR_PAYMENT,$dataArr);
						
					}
				}
			}
			
		header('Content-type: application/ms-excel');
		header("Content-type: text/x-csv");
		header("Content-type: text/csv");
		header("Content-type: application/csv");
		header("Content-Disposition: attachment; filename=paymentlist_".date('Y-m-d').".csv");

			if($payidval == 1){
				echo $out;
				exit;
			}else{
				$this->setErrorMessage('error','No Balance payment in seller list');
				redirect('admin/commission/display_commission_lists');
			}
		}
	}
	/**
     * 
     * This function loads payment success page for bulk payment
     */
	function paid_vendor()
	{
		$dataArr = array('status'=>	'success');
		$this->commission->update_details(VENDOR_PAYMENT,$dataArr,array('pay_status_csv'=>'1'));
		$this->setErrorMessage('success','Balance Paid Successfully');
		redirect('admin/commission/display_commission_lists');
	}	
}

/* End of file commission.php */
/* Location: ./application/controllers/admin/commission.php */