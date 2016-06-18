<?php
	/**
	* Feature Key class
	*/
	class FeatureKey extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->helper(array('cookie','date','form'));
			$this->load->model('admin_model');
		}

		public function key_list(){
			if ($this->checkLogin('A') == ''){
				redirect('admin');
			}else{
				if ($this->checkPrivileges('admin','2') == TRUE){
			
					$this->data['heading'] = 'Feature key';
					$condition = array();
					$this->data['featurekeys'] = $this->admin_model->get_all_details(FEATUREKEYS,$condition);
				
					$this->load->view('admin/adminsettings/featurekey_slist',$this->data);
				
				}else {
					redirect('admin');
				}
			}
		}


	}
?>