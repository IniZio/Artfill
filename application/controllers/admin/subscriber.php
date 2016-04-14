<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This controller contains the functions related to user management 
 * @author Teamtweaks
 *
 */

class Subscriber extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('claim_model');
		$this->load->model('location_model');
		if ($this->checkPrivileges('currency',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
	
	/**
    * 
    * This function loads the claim list page
    */
   /*	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/location/display_user_list');
		}
	}*/
	
	public function constantcontact()
	{
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Constant Contact';
			$this->load->view('admin/subscriber/constantcontact',$this->data);
		}
	}
	
	public function save_constantcontact()
	{if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			if ($this->checkPrivileges('admin','2') == TRUE){
			
				$smtp_settings_val = $this->input->post();
				$config = '<?php ';
				foreach($smtp_settings_val as $key => $val){
					$value = addslashes($val);
					$config .= "\n\$config['$key'] = '$value'; ";
				}
				$config .= "\n ?>";
				$file = 'constantcontact_settings.php';
				file_put_contents($file, $config);
				$this->setErrorMessage('success','constant contact updated successfully');
				redirect('admin/subscriber/constantcontact');
			
			}else {
				redirect('admin');
			}
		}
		
	}
	
	public function mailchimp()
	{
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Mailchimp Settings';
			$this->load->view('admin/subscriber/mailchimp',$this->data);
		}
		
	}
	
	public function save_mailchimp()
	{
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			if ($this->checkPrivileges('admin','2') == TRUE){
					
				$smtp_settings_val = $this->input->post();
				$config = '<?php ';
				foreach($smtp_settings_val as $key => $val){
					$value = addslashes($val);
					$config .= "\n\$config['$key'] = '$value'; ";
				}
				$config .= "\n ?>";
				$file = 'mailchimp_settings.php';
				file_put_contents($file, $config);
				$this->setErrorMessage('success','Mailchimp settings updated successfully');
				redirect('admin/subscriber/mailchimp');
					
			}else {
				redirect('admin');
			}
		}
		
		
	}
	
	public function zohocrm()
	{
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Zohocrm Settings';
			$this->load->view('admin/subscriber/zohocrm',$this->data);
		}
	
	}
	 public function getAuth()
    {
        $username = $this->input->post('username');//"sophia@casperon.in";
        $password =  $this->input->post('password');//"IP_101995010";
        $param = "SCOPE=ZohoCRM/crmapi&EMAIL_ID=".$username."&PASSWORD=".$password;
        $ch = curl_init("https://accounts.zoho.com/apiauthtoken/nb/create");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);//standard i/o streams 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
        $result = curl_exec($ch);
		//echo "<pre>";print_r();
        /*This part of the code below will separate the Authtoken from the result.
        Remove this part if you just need only the result*/
        $anArray = explode("\n",$result);
		//print_r($anArray);die;
        $authToken = explode("=",$anArray['2']);
        $cmp = strcmp($authToken['0'],"AUTHTOKEN");
       // echo $anArray['2'].""; 
		if ($cmp == 0)
        {
      //  echo "Created Authtoken is : ".$authToken['1'];die;
			$res['authtokens']=$authToken['1'];
			echo json_encode($res);
        }
		$causes = explode("=",$anArray['2']);
        $cmp = strcmp($authToken['0'],"CAUSE");
		if ($cmp == 0)
        {      
			$res['causes']=$authToken['1'];
			echo json_encode($res);
        }
        curl_close($ch);
    }  

		public function save_zohocrm()
		{
			if ($this->checkLogin('A') == ''){
				redirect('admin');
			}else {
				if ($this->checkPrivileges('admin','2') == TRUE){
						
					$smtp_settings_val = $this->input->post();
					$config = '<?php ';
					foreach($smtp_settings_val as $key => $val){
						$value = addslashes($val);
						$config .= "\n\$config['$key'] = '$value'; ";
					}
					$config .= "\n ?>";
					$file = 'zohocrm_settings.php';
					file_put_contents($file, $config);
					$this->setErrorMessage('success','Zohocrm settings updated successfully');
					redirect('admin/subscriber/zohocrm');
						
				}else {
					redirect('admin');
				}
			}
			
		}
}