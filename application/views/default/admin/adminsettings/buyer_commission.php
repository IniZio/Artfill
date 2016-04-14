<?php
class buyer_commission extends MY_Controller {

   function __construct()
    {
        parent::__construct();
		//$this->load->library('sitemap'); 
		// $this->load->helper('download');
		// $this->load->helper('xml');		
		// $this->load->helper('file');
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('admin_model');
    }
    
/**
 *
 * This function loads the sitemap creation form
 */

    function index()
    {
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			if (!$this->data['demoserverChk']){
				if ($this->checkPrivileges('admin','2') == TRUE){
			
					$this->data['heading'] = 'Edit buyer commission';
				
					$this->load->view('admin/adminsettings/edit_buyer_commission',$this->data);
				
				}else {
					redirect('admin');
				}
			}else{
				$this->data['heading'] = 'Edit buyer commission';
				
				$this->load->view('admin/adminsettings/edit_buyer_commission',$this->data);

			}
		}
    }

    public function change_buyer_commission_form()
    {
    	if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			if (!$this->data['demoserverChk']){
				if ($this->checkPrivileges('admin','2') == TRUE){
					$this->data['heading'] = 'Buyer commission';
					$this->data['buyer_commission_value'] = $this->admin_model->getAdminSettings()->row()->buyer_commission;
					$this->load->view('admin/adminsettings/edit_buyer_commission',$this->data);
				}else {
					redirect('admin');
				}
			}else{
				$this->data['heading'] = 'Buyer';
				$this->data['buyer_commission_value'] = $this->admin_model->getAdminSettings()->row()->buyer_commission;
				$this->load->view('admin/adminsettings/edit_buyer_commission',$this->data);
			}	
		}
    }
	  
    public function change_buyer_commission()
	{	
		if (!$this->data['demoserverChk']){
			$mode = ADMIN_SETTINGS;
			$buyer_commission = $this->input->post('buyer_commission_value');
			$newdata = array('buyer_commission' => $buyer_commission_value);
			$condition = array('id' => '1');
			if($mode == ADMIN_SETTINGS){
				$this->admin_model->update_details($mode,$newdata,$condition);
				$this->setErrorMessage('success','Buyer commission changed successfully');
			}
			else $this->setErrorMessage('error','You do not have the privilage');
		}			
		redirect('admin/buyer_commission/change_buyer_commission_form');
	}
}

?>