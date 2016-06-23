<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * This controller contains the functions related to community management
 * @author Teamtweaks
 *
 */

class Community extends MY_Controller {

	function __construct(){ 
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('community_model');
		$this->data['userId']=$this->checkLogin('U');
		$this->data['loginCheck']=$this->checkLogin('U');
	
	}
   
    /**
     * 
     * This function loads the community home page
     */
   	public function index(){	
			redirect('community');
	}
	
	/** 
	 * 
	 * checking the captcha using ajax
	 *
	 */
	function checkCapchaAjax(){
		$captcha = $this->input->post('capcha'); 
		$captcha_org = $this->input->cookie("captcha_org"); 
		if($captcha == $captcha_org){
			echo 'success';
		} else {
			echo 'error';
		}
	}
	
	/**
	 * 
	 * This function loads the events list page
	 */
	public function events_list(){
		
			$email = $this->session->userdata('shopsy_session_user_email');
			$this->data['heading'] =$this->config->item('meta_title').' - Events List';
			$condition_active =array(EVENTS.'.status'=>'active');
			$condition =array_merge(array('eventType'=>'Normal'),$condition_active);
			$orderBy = array('eventDate'=>'desc');
			$splcondition =array_merge(array(EVENTS.'.eventType'=>'Special'),$condition_active);
			$this->data['eventsList'] = $this->community_model->get_all_Events($condition,$orderBy);
			$this->data['spleventsList'] = $this->community_model->get_all_Events($splcondition,$orderBy);
			$this->data['sel_qry'] = $this->community_model->get_all_details(SUBSCRIBERS_LIST,array('subscrip_mail'=>$email));
			//echo '<pre>'; print_r($this->data['sel_qry']); die;
			$this->load->view('site/community/events/eventlist',$this->data);
	}
	
	
	/**
	 * 
	 * This function load a event add pgae
	 */
	public function useraddEvent(){ 
		if ($this->checkLogin('U') == ''){
			redirect('signup');
		}else {
			$evenId=$this->uri->segment('2');
			if($evenId!=''){
			$condition = array(EVENTS.'.id' => $evenId);
			$this->data['eventsList'] = $this->community_model->get_all_Events($condition);
				$this->data['heading'] = 'Edit Event';
			}else{
				$this->data['heading'] = 'Add New Event';
			}
			$this->load->view('site/community/events/addEdit_event_form',$this->data);
		}
	}
	/**
	 * 
	 * This function loads the events list page
	 */
	public function community_home(){ 
		
			$this->data['heading'] = $this->config->item('meta_title').' - Community';
			$this->db->limit(10);
			$this->data['storeBlog'] = $this->community_model->get_all_posts_userview();
			$condition=array('status'=>'Publish');
			$this->data['bannerList'] = $this->community_model->get_all_banner_userview($condition);
			//$condition ='';
			//$this->data['eventsList'] = $this->community_model->get_all_Events($condition);
		//echo '<pre>'; print_r($this->data['bannerList']); die;
			$this->load->view('site/community/community/community_home',$this->data);
		
	}
	
	/**
	 * 
	 * This function edit a event form
	 */
	
	public function edit_event_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['event_id'] = $this->uri->segment(4,0);
			$this->data['heading'] = 'Edit Event';
			$condition = array('id' => $this->data['event_id']);
			$this->data['eventsList'] = $this->community_model->get_all_Events($condition);
			//echo '<pre>'; print_r($this->data['eventsList']); die;
			$this->load->view('admin/community/events/addEdit_event_form',$this->data);
		}
	}
	
	/**
	 * 
	 * This function insert a event
	 */
	public function insertEvent(){ 
		if ($this->checkLogin('U') == ''){
			redirect('login');
		}else {
			#print_r($this->input->post());
		// echo url_title($this->input->post('eventTitle'),'-',TRUE); 
		//echo '<pre>'; print_r($_FILES); die;
			$date = $this->input->post('eventDate');
		
			$date = str_replace('/', '-', $date);
				
			$eventDate = date('Y-m-d', strtotime($date));
			//echo($evetDate);die;
			$eventTitle=$this->input->post('eventTitle');
			
			$seourl = url_title($eventTitle,'-',TRUE);
			$excludeArr = array("status","event_id");
			if ($this->input->post('status') != ''){
				$event_status = 'Inactive';
			}else {
				$event_status = 'Active';
			}
				$eventType = $this->input->post('eventType'); 
			if(!empty($_FILES['imagePath']['name'])){ 
				//$config['encrypt_name'] = TRUE;
				$config['overwrite'] = FALSE;
				$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
				
				$config['max_size'] = 2000;
				$config['upload_path'] = './images/community/events';
				$this->load->library('upload', $config);
				if ( $this->upload->do_upload('imagePath')){
					$logoDetails = $this->upload->data();
					$ImageName = $logoDetails['file_name'];
				}else{
					$logoDetails = $this->upload->display_errors();
					$this->setErrorMessage('error',$logoDetails);
					redirect('add-event'.$cat_id);
				}
				$image_data = array( 'imagePath' => $ImageName);
			}else{
				$image_data = array();
			}
			$address = str_replace(' ','+',$this->input->post('eventLocation'));
			$url = "http://maps.google.com/maps/api/geocode/json?address=".$address;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$response = curl_exec($ch);
			curl_close($ch);
			$response = json_decode($response);
			$lat = $response->results[0]->geometry->location->lat;
			$long = $response->results[0]->geometry->location->lng; 

			$dataArr = array('eventDate'=>$eventDate,'eventType'=>$eventType,'status' => $event_status,'event_seourl'=>$seourl,'eventAddDate'=>date('Y-m-d'),'eventAddedby' =>$this->checkLogin('U'),'latitude'=>$lat,'longitude'=>$long);
			#print_r($dataArr);
			$dataArr =array_merge($dataArr,$image_data);
			if ($this->input->post('event_id') != ''){
				$condition=array('id'=>$this->input->post('event_id'));
				$this->community_model->commonInsertUpdate(EVENTS,'update',$excludeArr,$dataArr,$condition);
			}else{
				$this->community_model->commonInsertUpdate(EVENTS,'insert',$excludeArr,$dataArr,$condition='');
			}
			#echo $this->db->last_query(); die;
			
			if($this->lang->line('event_added_successfully')!='') { $event_added_successfully= stripslashes($this->lang->line('event_added_successfully')); } else $event_added_successfully ="Event added successfully";
			$this->setErrorMessage('success',$event_added_successfully);
			redirect('manage-events');
		}
	 }
	/**
	 * 
	 * This function delete the events request records
	 */
	public function change_event_status_global(){
		if(count($_POST['checkbox_id']) > 0 &&  $_POST['statusMode'] != ''){
			$this->community_model->activeInactiveCommon(EVENTS,'id');
			if (strtolower($_POST['statusMode']) == 'delete'){
				if($this->lang->line('event_deleted_successfully')!='') { $event_deleted_successfully= stripslashes($this->lang->line('event_deleted_successfully')); } else $event_deleted_successfully ="Event deleted successfully";
				$this->setErrorMessage('success',$event_deleted_successfully);
			}else {
				if($this->lang->line('event_status_changed_successfully')!='') { $event_status_changed_successfully= stripslashes($this->lang->line('event_status_changed_successfully')); } else $event_status_changed_successfully ="Event  status changed successfully";
			
				$this->setErrorMessage('success',$event_status_changed_successfully);
			}
			redirect('admin/community/display_events_dashboard');
		}
	}
	
	
	/**
	 * 
	 * This function delete the event from db
	 */
	public function delete_event(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$event_id = $this->uri->segment(4,0);
			$condition = array('id' => $event_id);
			$this->community_model->commonDelete(EVENTS,$condition);
			if($this->lang->line('event_deleted_successfully')!='') { $event_deleted_successfully= stripslashes($this->lang->line('event_deleted_successfully')); } else $event_deleted_successfully ="Event deleted successfully";
			$this->setErrorMessage('success',$event_deleted_successfully);
			redirect('admin/community/display_events_dashboard');
		}
	}
	
	/**
	 * 
	 * This function change the event status
	 */
	public function change_event_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$event_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $event_id);
			$this->community_model->update_details(EVENTS,$newdata,$condition);
			if($this->lang->line('event_status_changed_successfully')!='') { $event_status_changed_successfully= stripslashes($this->lang->line('event_status_changed_successfully')); } else $event_status_changed_successfully ="Event  status changed successfully";
			
				$this->setErrorMessage('success',$event_status_changed_successfully);
			redirect('admin/community/display_events_dashboard');
		}
	}
	
	
	/**
	 * 
	 * This function loads the teams list page 
	 */
	public function teams_list(){
		
			$searchPerPage = 10;
		    $paginationNo = $this->uri->segment('2');  
			if($paginationNo == '')
			{
					$paginationNo = 0;
			}
			else
			{
					$paginationNo = $paginationNo;
			}
			
			$this->data['heading'] =$this->config->item('meta_title').' - Teams List';
			//$condition ='';
			$userId=$this->data['userId'];
			$condition=array(TEAMS.'.teamCaptainId !='=>$userId,TEAMS.'.status' => 'Active');
			if($userId!=''){
				$condition=array(TEAMS.'.teamCaptainId !='=>$userId,TEAMS.'.status' => 'Active');
				$condition1=array(TEAMS.'.teamCaptainId '=>$userId);
				$UserteamsList=$this->community_model->get_all_Teams($condition1);
				$this->data['UserteamsList'] = $UserteamsList->result_array();  #echo $this->db->last_query(); echo '<pre>';print_r($this->data['UserteamsList']); die;
			} 
			$this->data['storeBlog'] = $this->community_model->get_all_posts_userview();
			$teamsList=$this->community_model->get_all_Teams($condition,'',$searchPerPage,$paginationNo);
			$allTeamsList=$this->community_model->get_all_Teams($condition)->result_array();
			$this->data['teamsList'] = $teamsList->result_array();
			
			#echo $this->db->last_query(); die;
			
			
			$searchbaseUrl = base_url().$this->uri->segment(1).'/';
			//$product_routes_name = $this->uri->segment(); 
			$config['prev_link'] = '<img src="images/slider_prev_hover.png" />';
			$config['num_links'] = 3;
			$config['display_pages'] = TRUE; 
			$config['next_link'] = '<img src="images/slider_next_hover.png" />';
			$config['base_url'] = $searchbaseUrl;
			$config['total_rows'] = count($allTeamsList); 
			$config["per_page"] = $searchPerPage;
			$config["uri_segment"] = 2;
			$config['first_link'] = '';
			$config['last_link'] = '';
			$this->pagination->initialize($config); 
			 $paginationLink = $this->pagination->create_links();  #echo  'LINK---'.$paginationLink; die;
			$this->data['paginationLink'] = $paginationLink;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
			
			//echo '<pre>'; print_r($this->data['teamsList']->result_array()); die;
			$this->load->view('site/community/teams/teamlist',$this->data);
		
	}
	
	
	/**
	 * 
	 * This function loads the teams Search list page via tags
	 */
	public function teams_searchlist(){
		
			$this->data['heading'] =$this->config->item('meta_title').' - Teams Search List';
			//$condition ='';
			/* $keys=$this->uri->segment('2'); 
			$this->data['storeBlog'] = $this->community_model->get_all_posts_userview();
			//$keysTag=array('teamTags'$keys);
			$this->data['teamsList'] = $this->community_model->get_all_Teams($condition,$keys);
			//echo '<pre>'; print_r($this->data['teamsList']->result_array()); die;
			echo '<pre>'; print_r($this->data['teamsList']); die;*/
			 $keys=$this->uri->segment('2'); 
			 $keysTag=explode('-',$keys);			 
			$this->data['storeBlog'] = $this->community_model->get_all_posts_userview();
			//$keysTag=array('teamTags'$keys);
			$searchResList =array();  
			$condition=array(TEAMS.'.status' => 'Active');
			foreach($keysTag as $key => $Val){
				$serchList=$this->community_model->get_all_Teams($condition,$Val);
				//$searchResList[]= $serchList;
				$searchResList=array_merge($searchResList,$serchList->result_array());
				//echo '<pre>'; print_r($serchList->result_array());
			}
			$this->data['teamsList']=$searchResList;
			$this->load->view('site/community/teams/teamlist',$this->data);
		
	}
	
	/**
	 * 
	 * This function loads the teams Search list page via search form
	 */
	public function teamSearch(){
		
			$this->data['heading'] =$this->config->item('meta_title').' - Teams Search List';
			//$condition ='';
			 $keys=url_title($this->input->post('searcKeys'),'-',TRUE);
			if($keys!=''){
				redirect('teams-search/'.$keys);
			}else{
				redirect('teams');
			}
	}
	
	
	/**
	 * 
	 * This function loads Member Join team
	 */
	public function joinTeam(){
	
			 $teamId= $this->uri->segment(2); 
			 $teamSEOURL= $this->uri->segment(3); 
			 $userId= $this->data['userId'];
		
		if ($this->checkLogin('U') == ''){
			redirect('login?next=join-team/'.$teamId.'/'.$teamSEOURL);
		}else{
			 
			 $Cond1=array('userId'=>$userId);
			 $Condition=array_merge(array('teamId'=> $teamId),$Cond1);
			 $checkDub=$this->community_model->checkDublicatemember($Condition);
			 if(($checkDub->num_rows())==0){
				 $dataArr = array( 'teamId'=> $teamId,'userId'=>$userId,'memberType'=>'Member','joinDate'=>date('Y m d H:i:s'));
				 $this->community_model->commonInsertUpdate(TEAMMEMBERS,'insert',$excludeArr='',$dataArr,$condition='');
				$lg_joined_team=addslashes(artfill_lg('lg_joined_team','You have been joined successfully!'));
				$this->setErrorMessage('success',lg_joined_team);
				redirect('team/'.$teamId.'/'.$teamSEOURL);
			}else{
			$lg_already_joined=addslashes(artfill_lg('lg_already_joined','You have alredy joined in this team!'));
				$this->setErrorMessage('error',lg_already_joined);
				redirect('team/'.$teamId.'/'.$teamSEOURL);
			}
		}	
		
	}
	
	/**
	 * 
	 * This function loads Member leave team
	 */
	public function leaveTeam(){
	
			 $teamId= $this->uri->segment(2); 
			 $teamSEOURL= $this->uri->segment(3); 
			 $userId= $this->data['userId'];
		
		if ($this->checkLogin('U') == ''){
			redirect('login?next=leave-team/'.$teamId.'/'.$teamSEOURL);
		}else{
			 
			 $Cond1=array('userId'=>$userId);
			 $Condition=array_merge(array('teamId'=> $teamId),$Cond1);
			 $checkDub=$this->community_model->checkDublicatemember($Condition);
			 if(($checkDub->num_rows())==0){
			 $lg_not_a_memberin_team=addslashes(artfill_lg('lg_not_a_memberin_team','You are not member in this team!'));
				$this->setErrorMessage('error',lg_not_a_memberin_team);
				redirect('team/'.$teamId.'/'.$teamSEOURL);
			}else{				
				$condition1 = array('userId' => $userId);
				$condition = array_merge(array('teamId' => $teamId),$condition1);
				$this->community_model->commonDelete(TEAMMEMBERS,$condition);
				$this->setErrorMessage('success','You have left from this team!');
				redirect('team/'.$teamId.'/'.$teamSEOURL);
			}
		}	
		
	}
	
	
	/**
	 * 
	 * This function loads the particular team detail page
	 */
	public function team_detail(){
	
			$teamId= $this->uri->segment(2);
			$teamcondition=array(TEAMS.'.id'=>$teamId);
			$this->data['teamsList'] = $this->community_model->get_all_Teams($teamcondition);
			
			$TeamName=$this->data['teamsList']->result_array();
			$condition1 =array('rootId'=>0);
			$condition =array_merge(array(TEAMDISCUSSSION.'.teamId'=>$teamId),$condition1);			
			$this->data['discussionList'] = $this->community_model->get_all_TeamDiscussionwithMemberinfo($condition);
			#echo $this->db->last_query(); die;
			$member_condition1=array('teamId'=>$teamId);
			$member_condition=array_merge(array('memberType'=>'Member'),$member_condition1);
			$this->data['memberList'] = $this->community_model->get_all_Teammemberinfo($member_condition);
			$captain_condition1=array('teamId'=>$teamId);
			$captain_condition=array_merge(array('memberType'=>'Captain'),$captain_condition1);
			
			$this->data['CaptainList'] = $this->community_model->get_all_Teammemberinfo($captain_condition);
			
			//$this->data['discussionList'] = $this->community_model->get_all_TeamDiscussionwithMemberinfo($condition);
			$this->data['segMent2']=$this->uri->segment(2);
			$this->data['segMent3']=$this->uri->segment(3);
			$this->data['heading'] =$TeamName[0]['teamName'].' - '.$this->config->item('meta_title');
			
			//echo $this->db->last_query(); die;
			//echo '<pre>'; print_r($this->data['CaptainList']->result_array()); die;
			$this->load->view('site/community/teams/team_details',$this->data);
		
	}
	
	/**
	 * 
	 * This function loads the particular team members page
	 */
	public function team_members(){
		$teamId= $this->uri->segment(2);
		$segFour= $this->uri->segment(4);
		
			$teamcondition=array(TEAMS.'.id'=>$teamId);
			$this->data['teamsList'] = $this->community_model->get_all_Teams($teamcondition);
			
			$TeamName=$this->data['teamsList']->result_array();
			
			
			$condition1 =array('rootId'=>0);
			$condition =array_merge(array(TEAMDISCUSSSION.'.teamId'=>$teamId),$condition1);			
			$this->data['discussionList'] = $this->community_model->get_all_TeamDiscussionwithMemberinfo($condition);
			$member_condition1=array('teamId'=>$teamId);
			$member_condition=array_merge(array('memberType'=>'Member'),$member_condition1);
			$this->data['memberList'] = $this->community_model->get_all_Teammemberinfo($member_condition);
			//echo $this->db->last_query();
			//echo "<pre>";print_r($this->data['memberList'] );die;
			$captain_condition1=array('teamId'=>$teamId);
			$captain_condition=array_merge(array('memberType'=>'Captain'),$captain_condition1);
			
			$this->data['CaptainList'] = $this->community_model->get_all_Teammemberinfo($captain_condition);
			//echo $this->db->last_query();
		//	echo "<pre>";print_r($this->data['CaptainList'] );die;
			$this->data['discussionList'] = $this->community_model->get_all_TeamDiscussionwithMemberinfo($condition);
			$this->data['segMent2']=$this->uri->segment(2);
			$this->data['segMent3']=$this->uri->segment(3);
			$this->data['segMent4']=$this->uri->segment(4);
			$this->data['heading'] =$TeamName[0]['teamName'].' - '.$this->config->item('meta_title');
			//echo $this->db->last_query(); die;
			//echo '<pre>'; print_r($this->data['CaptainList']->result_array()); die;
			$this->load->view('site/community/teams/team_members',$this->data);
		
	}
	
	/**
	 * 
	 * This function loads the particular team members page
	 */
	public function team_discussions(){
		$teamId= $this->uri->segment(2);
		$segFour= $this->uri->segment(4);
		
			$teamcondition=array(TEAMS.'.id'=>$teamId);
			$this->data['teamsList'] = $this->community_model->get_all_Teams($teamcondition);
			
			$TeamName=$this->data['teamsList']->result_array();
			
			
			$condition1 =array('rootId'=>0);
			$condition =array_merge(array(TEAMDISCUSSSION.'.teamId'=>$teamId),$condition1);			
			$this->data['discussionList'] = $this->community_model->get_all_TeamDiscussionwithMemberinfo($condition);
			$member_condition1=array('teamId'=>$teamId);
			$member_condition=array_merge(array('memberType'=>'Member'),$member_condition1);
			$this->data['memberList'] = $this->community_model->get_all_Teammemberinfo($member_condition);
			$captain_condition1=array('teamId'=>$teamId);
			$captain_condition=array_merge(array('memberType'=>'Captain'),$captain_condition1);
			
			$this->data['CaptainList'] = $this->community_model->get_all_Teammemberinfo($captain_condition);
			
			//$this->data['discussionList'] = $this->community_model->get_all_TeamDiscussionwithMemberinfo($condition);
			$this->data['segMent2']=$this->uri->segment(2);
			$this->data['segMent3']=$this->uri->segment(3);
			$this->data['segMent4']=$this->uri->segment(4);
			$this->data['heading'] =$TeamName[0]['teamName'].' - '.$this->config->item('meta_title');
			//echo $this->db->last_query(); die;
			//echo '<pre>'; print_r($this->data['CaptainList']->result_array()); die;
			$this->load->view('site/community/teams/team_discussions',$this->data);
		
	}
	
	/** 
	 * 
	 * Add New Discussion on team
	 *
	 */
	function AddnewDiscussion()
	{
			//echo '<pre>';
			//print_r($_POST['seller_business']); die;
		    $table = TEAMDISCUSSSION;
			$excludeArray = array("drafts","publish","AddOrEditVal","seller_business");
		    $addEditVal  = $this->getAddEditDetails($excludeArray);
			
			
			$seoArr = array("postdate"=>date('Y-m-d H:i:s'));
			$addEditVal = array_merge($addEditVal,$seoArr);
			$pref ='comment_';
			$insertEditValues = $this->community_model->addEditValues($addEditVal,$table,$pref);
			$rooId=$this->db->insert_id();
        $type = 'success';
		if($this->lang->line('comments_added_successfully')!='') { $message= stripslashes($this->lang->line('comments_added_successfully')); } else $message ="Comments Added Successfully";
				
		$this->setErrorMessage($type,$message);
	
	    redirect('discuss/'.$this->input->post('teamId').'/discuss/'.$rooId);
	}
	
	
	/** 
	 * 
	 * Comments Discussion on team
	 *
	 */  
	function teamdiscussionComment()
	{
			//echo '<pre>';
			//print_r($_POST['seller_business']); die;
		    $table = TEAMDISCUSSSION;
			$excludeArray = array("drafts","publish","AddOrEditVal","seller_business");
		    $addEditVal  = $this->getAddEditDetails($excludeArray);
			
			
			$seoArr = array("postdate"=>date('Y-m-d H:i:s'));
			$addEditVal = array_merge($addEditVal,$seoArr);
			$pref ='comment_';
			$insertEditValues = $this->community_model->addEditValues($addEditVal,$table,$pref);
			
        $type = 'success';
		if($this->lang->line('comments_added_successfully')!='') { $message= stripslashes($this->lang->line('comments_added_successfully')); } else $message ="Comments Added Successfully";
		$this->setErrorMessage($type,$message);
	    redirect('discuss/'.$this->input->post('teamId').'/discuss/'.$this->input->post('rootId'));
	}

	
	/**
	 * 
	 * This function loads the particular Discussion detail page
	 */
	public function discussionDetails(){
			$teamId=$this->data['segMent2']=$this->uri->segment(2);
			$this->data['segMent3']=$this->uri->segment(3);
			$discusId=$this->data['segMent4']=$this->uri->segment(4);
			
			$condition=array(TEAMS.'.id'=>$teamId);
			$this->data['teamsList'] = $this->community_model->get_all_Teams($condition);
			
			$TeamName=$this->data['teamsList']->result_array();
			
			$member_condition=array('teamId'=>$teamId);
			
			$this->data['memberList'] = $this->community_model->get_all_Teammemberinfo($member_condition);
			
			$condition =array(TEAMDISCUSSSION.'.id'=>$discusId);
			$condition_thrd =array(TEAMDISCUSSSION.'.rootId'=>$discusId);			
			$this->data['discussionOrg'] = $this->community_model->get_all_TeamDiscussionwithMemberinfo($condition);
			$this->data['discussionResponse'] = $this->community_model->get_all_TeamDiscussionwithMemberinfo($condition_thrd);
			
			$member_condition1=array('teamId'=>$teamId);
			$member_condition=array_merge(array('memberType'=>'Member'),$member_condition1);
			$this->data['memberList'] = $this->community_model->get_all_Teammemberinfo($member_condition);
			
			$member_condition1=array('teamId'=>$teamId);
			$member_condition=array_merge(array('memberType'=>'Captain'),$member_condition1);
			$this->data['captainList'] = $this->community_model->get_all_Teammemberinfo($member_condition);
			
			$this->data['segMent2']=$this->uri->segment(2);
			$this->data['segMent3']=$this->uri->segment(3);
			$this->data['heading'] =$TeamName[0]['teamName'].' - '.$this->config->item('meta_title');
			//echo $this->db->last_query(); die;
			//echo '<pre>'; print_r($this->data['discussionResponse']->result_array()); die;
			$this->load->view('site/community/teams/discussion_details',$this->data);
		
	}
	
	
	/**
	 * 
	 * This function loads add original thread for team admin
	 */
	public function teamaddnewthread(){
			$teamId=$this->data['segMent2']=$this->uri->segment(2);
			$this->data['segMent3']=$this->uri->segment(3);
			$discusId=$this->data['segMent4']=$this->uri->segment(4);
			$condition_team=array(TEAMS.'.id'=>$teamId);
			$this->data['teamsList'] = $this->community_model->get_all_Teams($condition_team);
			$TeamName=$this->data['teamsList']->result_array();
			$condition =array(TEAMDISCUSSSION.'.id'=>$discusId);
			$condition_thrd =array(TEAMDISCUSSSION.'.rootId'=>$discusId);			
			$this->data['discussionOrg'] = $this->community_model->get_all_TeamDiscussionwithMemberinfo($condition);
			$this->data['discussionResponse'] = $this->community_model->get_all_TeamDiscussionwithMemberinfo($condition_thrd);
			$this->data['segMent2']=$this->uri->segment(2);
			$this->data['segMent3']=$this->uri->segment(3);
			$this->data['heading'] =$TeamName[0]['teamName'].' - '.$this->config->item('meta_title');
			$capmail = getcaptemail($teamId);
			$this->data['cptnmail']=$this->community_model->$capmail[0]->email;
			//echo"<pre>"; print_r($this->data['cptnmail']);die;
			//echo $this->db->last_query(); die;
			//echo '<pre>'; print_r($this->data['discussionResponse']->result_array()); die;
			$this->load->view('site/community/teams/addNew_discussion',$this->data);
		
	}
	
	
	
	/**
	 * 
	 * This function insert a team form
	 */
	public function add_team_form(){
		if ($this->checkLogin('U') == ''){  // Change the not equal to equal
			redirect('signup');
		}else{
		$evenId=$this->uri->segment('2');
			if($evenId!=''){
			$condition = array(TEAMS.'.id' => $evenId);
			$this->data['teamList'] = $this->community_model->get_all_Teams($condition);
			$this->data['heading'] = 'Edit Team';
			}else{
				$this->data['heading'] = 'Add New Team';
			}
			
			$this->load->view('site/community/teams/addEdit_team_form',$this->data);
		}
	}
	
	
	/**
	 * 
	 * This function edit a team form
	 */
	public function edit_team_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['team_id'] = $this->uri->segment(4,0);
			$this->data['heading'] = 'Edit Team';
			$condition = array(TEAMS.'.id' => $this->data['team_id']);
			$this->data['teamList'] = $this->community_model->get_all_Teams($condition);
			//echo '<pre>'; print_r($this->data['teamList']); die;
			$this->load->view('admin/community/teams/addEdit_team_form',$this->data);
		}
	}
	
	
	/**
	 * 
	 * This function insert or Edit a team
	 */
	public function insertTeam(){ 	
		if ($this->checkLogin('U')== ''){
			redirect('signup');
		}else {
		//echo url_title($this->input->post('eventTitle'),'-',TRUE); 
		//echo '<pre>'; print_r($_POST); die;
			$teamName=$this->input->post('teamName');
			$seourl = url_title($teamName,'-',TRUE);
			$excludeArr = array("status","team_id");
			
			
			
			if(!empty($_FILES['teamImage']['name'])){ 
				//$config['encrypt_name'] = TRUE;
				$config['overwrite'] = FALSE;
				$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
				$config['max_size'] = 2000;
				$config['upload_path'] = './images/community/teams';
				$this->load->library('upload', $config);
				if ( $this->upload->do_upload('teamImage')){
					$logoDetails = $this->upload->data();
					$ImageName = $logoDetails['file_name'];
				}else{
					$logoDetails = $this->upload->display_errors();
					$this->setErrorMessage('error',$logoDetails);
					redirect('add-team'.$cat_id);
				}
				$image_data = array('teamImage' => $ImageName);
			}else{
				$image_data = array();
			}

			$dataArr = array( 'teamSeourl'=>$seourl,'teamAddDate'=>date('Y-m-d'),'teamCaptainId'=>$this->checkLogin('U'));
			$dataArr =array_merge($dataArr,$image_data);
			if ($this->input->post('team_id') != ''){
				$condition=array('id'=>$this->input->post('team_id'));
				$this->community_model->commonInsertUpdate(TEAMS,'update',$excludeArr,$dataArr,$condition);
			}else{
				$this->community_model->commonInsertUpdate(TEAMS,'insert',$excludeArr,$dataArr,$condition='');
				 $teamId=$this->db->insert_id(); 
				 $userId= $this->data['userId']; 
				  $excludeArr = array('teamName','teamshortDescription', 'teamDescription','teamRules','teamTags','team_id');
				 $dataArr1 = array( 'teamId'=> $teamId,'captainId'=>$userId,'userId'=>$userId,'memberType'=>'Captain','joinDate'=>date('Y m d H:i:s'));
				
				 $this->community_model->commonInsertUpdate(TEAMMEMBERS,'insert',$excludeArr,$dataArr1,$condition='');
			}
			
			//echo $this->db->last_query(); die;
			
			if($this->lang->line('team_created_successfully')!='') { $team_created_successfully= stripslashes($this->lang->line('team_created_successfully')); } else $team_created_successfully ="Team Created successfully";
			
			$this->setErrorMessage('success',$team_created_successfully);
			redirect('manage-teams');
		}
	}
	
	
	/**
	 * 
	 * This function Edit a team
	 */
	public function editinsertTeam(){ 	
		
		//echo url_title($this->input->post('eventTitle'),'-',TRUE); 
			$teamName=$this->input->post('teamName');
			$seourl = url_title($teamName,'-',TRUE);
			$excludeArr = array("status","team_id");
			
			if(!empty($_FILES['teamImage']['name'])){ 
				//$config['encrypt_name'] = TRUE;
				$config['overwrite'] = TRUE;
				$config['allowed_types'] = '*';
				$config['max_size'] = 5000;
				$config['upload_path'] = $this->input->post('uploadPath');
				$this->load->library('upload', $config);
				
				if ($this->upload->do_upload('teamImage')){
					$logoDetails = $this->upload->data();
					$ImageName = $logoDetails['file_name'];
				}
				$image_data = array('teamImage' => $ImageName);
			}
		
			$dataArr = array( 'teamSeourl'=>$seourl,'teamAddDate'=>date('Y-m-d'),'teamCaptainId'=>$this->checkLogin('U'));
			$dataArr =array_merge($dataArr,$image_data);
			
			$condition=array('id'=>$this->input->post('team_id'));
			//$this->community_model->commonInsertUpdate(TEAMS,'update',$excludeArr,$dataArr,$condition);
			//echo $this->db->last_query(); die;
			$this->setErrorMessage('success','Team Updated successfully');
			redirect('manage-teams');
		
	}
	
	/**
	 * 
	 * This function change the event status
	 */
	public function change_team_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else{
			
			$mode = $this->uri->segment(4,0);
			$team_id = $this->uri->segment(5,0);
			$status = ($mode == '0')?'Inactive':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $team_id);
			$this->community_model->update_details(TEAMS,$newdata,$condition);
			if($this->lang->line('team_status_changed_successfully')!='') { $team_status_changed_successfully= stripslashes($this->lang->line('team_status_changed_successfully')); } else $team_status_changed_successfully ="Team Status Changed Successfully";
			$this->setErrorMessage('success',$team_status_changed_successfully);
			redirect('admin/community/display_teams_dashboard');
		}
	}
	
	
	/**
	 * 
	 * This function edit a team form
	 */
	public function editteamform(){
			$this->data['team_id'] = $this->uri->segment(4,0);
			$this->data['heading'] = 'Edit Team';
			$condition = array(TEAMS.'.id' => $this->data['team_id']);
			$this->data['teamList'] = $this->community_model->get_all_Teams($condition);
			//echo '<pre>'; print_r($this->data['teamList']); die;
			$this->load->view('site/community/teams/Edit_team_form',$this->data);
	}
	
	/**
	 * 
	 * This function delete the team from db
	 */
	public function delete_team(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$team_id = $this->uri->segment(4,0);
			$condition = array('id' => $team_id);
			$this->community_model->commonDelete(TEAMS,$condition);
						if($this->lang->line('team_deleted_successfully')!='') { $team_deleted_successfully= stripslashes($this->lang->line('team_deleted_successfully')); } else $team_deleted_successfully ="Team deleted successfully";
			
			$this->setErrorMessage('success',$team_deleted_successfully);
			redirect('admin/community/display_teams_dashboard');
		}
	}
	
	
	/**
	 * 
	 * This function loads the teams Original Discussion List Page
	 */
	public function display_teams_discussiondashboard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else{
			$this->data['heading'] = 'Team Discussion List';
			$condition =array('rootId'=>'0');
			$this->data['discussionList'] = $this->community_model->get_all_TeamDiscussion($condition);
			echo '<pre>'; print_r($this->data['discussionList']); die;
			//$this->load->view('admin/community/teams/display_teams_dashboard',$this->data);
		}
	}
	
	
	/**
	 * 
	 * This function loads the teams Original Discussion ,Response Member Info  (Public)
	 */
	public function display_teams_discussion(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else{
			$this->data['heading'] = 'Team Discussion List';
			$id=$this->uri->segment(4);
			$condition =array('rootId'=>$id);
			$conditionOrgpost=array(TEAMDISCUSSSION.'.id'=>$id);
			$this->data['discussionList'] = $this->community_model->get_all_TeamDiscussionwithMemberinfo($condition);
			$this->data['orgDiscussion'] = $this->community_model->get_all_TeamDiscussionwithMemberinfo($conditionOrgpost);
			if($id!=''){
				echo '<pre>'; print_r($this->data['orgDiscussion']);
				echo '<pre>'; print_r($this->data['discussionList']); die;
			}else{
				echo '<pre>'; print_r($this->data['discussionList']); die;
			}
			
			//$this->load->view('admin/community/teams/display_teams_dashboard',$this->data);
		}
	}

	/**
	 * 
	 * This function loads the teams Original Discussion ,Response for only team Member Info (Private) 
	 */
	public function display_teams_discussionPrivate(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else{
			$this->data['heading'] = 'Team Discussion List';
			$id=$this->uri->segment(4);
			$condition =array('rootId'=>$id);
			
			
			$conditionOrgpost=array(TEAMDISCUSSSION.'.id'=>$id);
			$this->data['orgDiscussion'] = $this->community_model->get_all_TeamDiscussionOnlyMemberifo($conditionOrgpost);
			$idd=$this->data['orgDiscussion']->result();
			$idd[0]->id;
			
			$this->data['discussionList'] = $this->community_model->get_all_TeamDiscussionOnlyMemberifo($condition);
			
			if($id!=''){
				echo '<pre>'; print_r($this->data['orgDiscussion']);
				echo '<pre>'; print_r($this->data['discussionList']); die;
			}else{
				echo '<pre>'; print_r($this->data['discussionList']); die;
			}
			
			//$this->load->view('admin/community/teams/display_teams_dashboard',$this->data);
		}
	}
	
	/** 
	 * 
	 * Display the google map on community
	 *
	 */
	public function display_gmap(){
	
	/*$add = 'chennai';
	
		$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$add.'&sensor=false');
                       
                       $output= json_decode($geocode);
                       
                        $lat = $output->results[0]->geometry->location->lat; 
                         $long = $output->results[0]->geometry->location->lng;
		$this->load->library('googlemaps');

		$config['center'] = '37.4419, -122.1419';
		$config['zoom'] = 'auto';
		$this->googlemaps->initialize($config);
		
		$marker = array();
		$marker['position'] = '37.429, -122.1419';
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();*/
		
		//$this->load->view('view_file', $data);

			$this->load->view('admin/community/teams/gmap');
		
	}
	
	
	
	/***************Communit Artecl Control*******************/
	
	/** 
	 * 
	 * Blog functon for View Comments
	 *
	 */	
 	function blogsetup(){
		if ($this->checkLogin('U')!='' && $this->session->userdata('userType') == 'Seller'){
			$getBlogSellerDetails = $this->community_model->getSellerDetails($this->checkLogin('U'));
			
			//echo '<pre>';
			//print_r(); die;
			$_SESSION['blogTemp'] = $getBlogSellerDetails[0]['blog_template'];
			$this->load->view('site/community/community/community_control/blog_setup',$this->data);
		}else{
				redirect('login');
		}
	}

	/** 
	 * 
	 * Blog Setup for  User Update
	 *
	 */
 	function userblogsetup(){
		if ($this->checkLogin('U')!='' && $this->session->userdata('userType') == 'Seller'){
			$commentData = $this->community_model->updateBlogSetup();
			redirect('manage-community');
		}else{
			redirect('login');
		}
	}
					
 	/** 
	 * 
	 * Blog Setup for Store Blog
	 *
	 */
	function userBlogPage(){	
		     $sellerId = $this->uri->segment('2'); 
			 $storeName = $this->uri->segment('3');  
			$searchPerPage = 5;
		    $paginationNo = $this->uri->segment('2');  
	     
			if($paginationNo == '')
			{
					$paginationNo = 0;
			}
			else
			{
					$paginationNo = $paginationNo;
			}

		$blogTotal = $this->community_model->get_all_posts_userview();
		$storeBlog = $this->community_model->get_all_posts_userview($searchPerPage,$paginationNo);
		$blogTemplateType = $this->community_model->get_blog_type($_SESSION['sellerId']);
	//	print_r($blogTemplateType); die;
			$searchbaseUrl = base_url().$this->uri->segment('1').'/';
			//$product_routes_name = $this->uri->segment(); 
			$config['prev_link'] = '<img src="images/slider_prev_hover.png" />';
			$config['num_links'] = 3;
			$config['display_pages'] = TRUE; 
			$config['next_link'] = '<img src="images/slider_next_hover.png" />';
			$config['base_url'] = $searchbaseUrl;
			$config['total_rows'] = count($blogTotal); 
			$config["per_page"] = $searchPerPage;
			$config["uri_segment"] = 2;
			$config['first_link'] = '';
			$config['last_link'] = '';
			$this->pagination->initialize($config); 
			 $paginationLink = $this->pagination->create_links(); 
			$this->data['paginationLink'] = $paginationLink;
		    $this->data['blogTotal'] = $blogTotal;
		    $this->data['storeBlog'] = $storeBlog;
			
		    $this->load->view('site/community/community/community_view/blog_template1',$this->data);
	
	}

	/** 
	 * 
	 * Archive Page for  Store Blog
	 *
	 */	
 	function userArchivePage(){
			$searchPerPage = 10;
			$getMonthType = ucfirst($this->uri->segment('2'));   
		    $paginationNo = $this->uri->segment('3');  

			if($paginationNo == '')
			{
				$paginationNo = 0;
			}
			else
			{
				$paginationNo = $paginationNo;
			}

		$blogTotal = $this->community_model->get_all_posts('','',$getMonthType);
		$storeBlog = $this->community_model->get_all_posts($searchPerPage,$paginationNo,$getMonthType);
		
		//echo '<pre>';
		//print_r($storeBlog); die;
			$searchbaseUrl = base_url().$this->uri->segment('1').'/'.$this->uri->segment('2').'/';
			//$product_routes_name = $this->uri->segment(); 
			$config['prev_link'] = '<img src="images/page_prevt_hover.png" />';
			$config['num_links'] = 3;
			$config['display_pages'] = TRUE; 
			$config['next_link'] = '<img src="images/page_next.png" />';
			$config['base_url'] = $searchbaseUrl;
		    $config['total_rows'] = count($blogTotal);  
			$config["per_page"] = $searchPerPage;
			$config["uri_segment"] = 3;
			$config['first_link'] = '';
			$config['last_link'] = '';
			$this->pagination->initialize($config); 
			$paginationLink = $this->pagination->create_links(); 
			$this->data['paginationLink'] = $paginationLink;
		    $this->data['blogTotal'] = $blogTotal;
		    $this->data['storeBlog'] = $storeBlog;
		    $this->load->view('site/community/community/community_view/blog_template1',$this->data);
	}

	/** 
	 * 
	 * General Blog Page
	 *
	 */	
 	function userCommonBlog(){
			$searchPerPage = 10;
			$getMonthType = ucfirst($this->uri->segment('2'));   
		    $paginationNo = $this->uri->segment('2');  

			if($paginationNo == '')
			{
				$paginationNo = 0;
			}
			else
			{
				$paginationNo = $paginationNo;
			}

		$blogTotal = $this->community_model->get_post_common_view('','',$getMonthType='');
		$storeBlog = $this->community_model->get_post_common_view($searchPerPage,$paginationNo,$getMonthType='');
		
		
	//	echo count($blogTotal); die;
		
			$searchbaseUrl = base_url().$this->uri->segment('1').'/'.$this->uri->segment('2').'/';
			//$product_routes_name = $this->uri->segment(); 
			$config['prev_link'] = '<img src="images/page_prevt_hover.png" />';
			$config['num_links'] = 3;
			$config['display_pages'] = TRUE; 
			$config['next_link'] = '<img src="images/page_next.png" />';
			$config['base_url'] = $searchbaseUrl;
		    $config['total_rows'] = count($blogTotal);  
			$config["per_page"] = $searchPerPage;
			$config["uri_segment"] = 2;
			$config['first_link'] = '';
			$config['last_link'] = '';
			$this->pagination->initialize($config); 
			$paginationLink = $this->pagination->create_links(); 
			$this->data['paginationLink'] = $paginationLink;
			//echo count($blogTotal); die;
		    $this->data['blogTotal'] = $blogTotal;
		    $this->data['storeBlog'] = $storeBlog;
		    $this->load->view('site/community/community/community_control/blog_common_template',$this->data);
	}

	/** 
	 * 
	 * Common Page for  Store Blog
	 *
	 */	
 	function userBlogCommon(){
			$searchPerPage = 10;
			//$getMonthType = ucfirst($this->uri->segment('2'));   
		    $paginationNo = $this->uri->segment('3');  

			if($paginationNo == '')
			{
				$paginationNo = 0;
			}
			else
			{
				$paginationNo = $paginationNo;
			}

		$blogTotal = $this->community_model->get_all_posts('','','');
		$storeBlog = $this->community_model->get_all_posts($searchPerPage,$paginationNo,'');
		
		//echo '<pre>';
		//print_r($storeBlog); die;
			$searchbaseUrl = base_url().$this->uri->segment('1').'/'.$this->uri->segment('2').'/';
			//$product_routes_name = $this->uri->segment(); 
			$config['prev_link'] = '<img src="images/page_prevt_hover.png" />';
			$config['num_links'] = 3;
			$config['display_pages'] = TRUE; 
			$config['next_link'] = '<img src="images/page_next.png" />';
			$config['base_url'] = $searchbaseUrl;
		    $config['total_rows'] = count($blogTotal);  
			$config["per_page"] = $searchPerPage;
			$config["uri_segment"] = 3;
			$config['first_link'] = '';
			$config['last_link'] = '';
			$this->pagination->initialize($config); 
			 $paginationLink = $this->pagination->create_links(); 
			$this->data['paginationLink'] = $paginationLink;
		    $this->data['blogTotal'] = $blogTotal;
		    $this->data['storeBlog'] = $storeBlog;
		    $this->load->view('site/community/community/community_view/blog_template1',$this->data);
	}
	
	/** 
	 * 
	 * Blog functon for View Comments
	 *
	 */
 	function blogcommentsview(){
				$this->data['heading'] = $this->config->item('meta_title').' - Comments';
				$this->data['meta_title'] = $this->config->item('meta_title').' - Comments';
				$commentData = $this->community_model->get_all_comments('');
				//echo $this->db->last_query(); die;
				$this->data['commentData'] = $commentData;
				$this->load->view('site/community/community/community_control/blog_comments',$this->data);
	}
	
	
	/** 
	 * 
	 * This function Load team discussions
	 *
	 */	
 	function teamdiscussionview(){
		
		if($this->checkLogin('U')!=''){
				$this->data['heading'] = $this->config->item('meta_title').' - Team Discussion';
				$this->data['meta_title'] = $this->config->item('meta_title').' - Team Discussion';
			$condition1 =array('rootId'=>0);
			$condition2 =array_merge(array(TEAMDISCUSSSION.'.userId'=>$this->checkLogin('U')),$condition1);	
			$condition =array_merge(array(TEAMDISCUSSSION.'.postType'=>'Original'),$condition2);			
			$commentData = $this->community_model->get_all_TeamDiscussionwithMemberinfo($condition);
		$this->data['commentData'] = $commentData;
		//echo '<pre>'; print_r($commentData); die;
		$this->load->view('site/community/community/community_control/team_discussion',$this->data);
		}else{
			redirect('login');
		}
	}	
	
	/** 
	 * 
	 * This function Load team discussions
	 *
	 */	
 	function teamdiscussionThreadview(){
		if($this->checkLogin('U')!=''){
				$this->data['heading'] = $this->config->item('meta_title').' - Team Discussion';
				$this->data['meta_title'] = $this->config->item('meta_title').' - Team Discussion';
			$condition1 =array('rootId'=>$this->uri->segment(2));
			$condition =array_merge(array(TEAMDISCUSSSION.'.postType'=>'Responses'),$condition1);			
			$commentData = $this->community_model->get_all_TeamDiscussionwithMemberinfo($condition);
		$this->data['commentData'] = $commentData;
		//echo '<pre>'; print_r($commentData); die;
		$this->load->view('site/community/community/community_control/team_discussionthrd',$this->data);
		}else{
			redirect('login');
		}
	}
	
	/** 
	 * 
	 * This function delete the comments record from db
	 *
	 */
	public function delete_comments(){
			$comment_id = $this->uri->segment(4);
			$condition = array('comment_id' => $comment_id);
			$this->community_model->commonDelete(NEWSCOMMENT,$condition);
			$this->setErrorMessage('success','Comments deleted successfully');
			redirect('community-post-comments');
	}
	
	/** 
	 * 
	 * This function delete the team discussion record from db
	 *
	 */
	public function delete_discussion(){
			$comment_id = $this->uri->segment(4);
			$condition = array('id' => $comment_id);
			$this->community_model->commonDelete(TEAMDISCUSSSION,$condition);
			$this->setErrorMessage('success','Discussion deleted successfully');
			redirect('manage-discussions');
	}
	
	/** 
	 * 
	 * This function delete the discussion thread record from db
	 *
	 */
	public function delete_discussionThrd(){
			$comment_id = $this->uri->segment(4);
			$rootId=$this->uri->segment(5);
			$condition = array('id' => $comment_id);
			$this->community_model->commonDelete(TEAMDISCUSSSION,$condition);
			$this->setErrorMessage('success','Discussion deleted successfully');
			if($rootId!=''){
				redirect('manage-discussions-thread/'.$rootId);
			}else{
				redirect('manage-discussions');
			}
	}
	
	
	/* 
	*
	* This function update the comment status record from db
	*
	*/
	public function update_comments(){
			$comment_id = $this->uri->segment(4);
			$status = $this->uri->segment(5);
			if($status == 'active'){
				$comment_status = 'inactive';
			}else{
				$comment_status = 'active';					
			}
			$fieldName = 'comment_id';
			$updateList = $comment_id;
			$condition = array('comment_status' => $comment_status);
			$this->community_model->commonUpdate(NEWSCOMMENT,$condition,$fieldName,$updateList);
			$this->setErrorMessage('success','Comments updated successfully');
			redirect('community-post-comments');
	}
	
	/*
	*
	* This function update the comment status record from db
	*
	*/
	public function update_discussion(){
			$comment_id = $this->uri->segment(4);
			$status = $this->uri->segment(5);
			if($status == 'Active'){
				$comment_status = 'Inactive';
			}else{
				$comment_status = 'Active';					
			}
			$fieldName = 'id';
			$updateList = $comment_id;
			 $comment_status; 
			$condition = array('status' => $comment_status);
			$this->community_model->commonUpdate(TEAMDISCUSSSION,$condition,$fieldName,$updateList);
			$this->setErrorMessage('success','Discussion updated successfully');
			redirect('manage-discussions');
	}
	
	/** 
	 * 
	 * This function update the comment status record from db
	 *
	 */
	public function update_discussionThrd(){ 
			$comment_id = $this->uri->segment(4);
			$status = $this->uri->segment(5);
			$rootId = $this->uri->segment(6);
			if($status == 'Active'){
				$comment_status = 'Inactive';
			}else{
				$comment_status = 'Active';					
			}
			$fieldName = 'id';
			$updateList = $comment_id;
			 $comment_status; 
			$condition = array('status' => $comment_status);
			$this->community_model->commonUpdate(TEAMDISCUSSSION,$condition,$fieldName,$updateList);
			$this->setErrorMessage('success','Discussion updated successfully');
			if($rootId!=''){
				redirect('manage-discussions-thread/'.$rootId);
			}else{
				redirect('manage-discussions');
			}
	}
	
	/** 
	 * 
	 * Common active / inactive / deleted function for community
	 *
	 */
	function commentInactiveDeleteFunction()
	{	
			$fieldName = 'comment_id';
			//$redirectTo = 'manage-community';
			$tableName = NEWSCOMMENT;
			$this->commonManageActiveInactive($changeMode,$jobSeekerId,$userType,$paginationNo,$fieldName,$redirectTo,$tableName);
		
	}
	
	
	/** 
	 * 
	 * Common discussion active / inactive / deleted function for community
	 *
	 */
	function discussionInactiveDeleteFunction()
	{	
			$fieldName = 'id';
			//$redirectTo = 'manage-community';
			$tableName = TEAMDISCUSSSION;
			$this->commonTDManageActiveInactive($changeMode,$jobSeekerId,$userType,$paginationNo,$fieldName,$redirectTo,$tableName);
		
	}
						 
 	/** 
	 * 
	 * Blog functon for View Drafts
	 *
	 */
	function blogdraftview(){
		$draftData = $this->community_model->get_all_drafts();
		$this->data['draftData'] = $draftData;
		$this->load->view('site/community/community/community_control/blog_drafts',$this->data);
	}

	/** 
	 * 
	 * Blog functon for View Drafts for particular id
	 *
	 */
 	function blogdraftsingleview(){
		$post_id = $this->uri->segment(4);
		$postViewData = $this->community_model->get_single_posts($post_id);
//		echo '<pre>';
//		print_r($postViewData); die;
		$this->data['postViewData'] = $postViewData;
		$this->load->view('site/community/community/community_control/blog_view_draft',$this->data);
	}
	
	/** 
	 * 
	 * This function delete the draft record from db
	 *
	 */	
	public function delete_drafts(){
			$comment_id = $this->uri->segment(4);
			$condition = array('post_id' => $comment_id);
			$this->community_model->commonDelete(NEWS,$condition);
            $type = 'success';
		   $message =  "Drafts deleted successfully";
		   $this->setErrorMessage($type,$message);

			redirect('blog-drafts');
	}

	/** 
	 * 
	 * Blog functon for Edit Drafts
	 *
	 */	
 	function blogeditdraft(){
		$post_id = $this->uri->segment(4);
		$postData = array();
		$table = NEWS;
		$selectfield='*';
		$fieldName = 'post_id';
		$updateList = $post_id;
		$editpostData = $this->community_model->commonSelect($table,$selectfield,$fieldName,$updateList);
		//echo '<pre>';
		//print_r($editpostData); die;
		$this->data['editpostData'] = $editpostData;
		$this->load->view('site/community/community/community_control/blog_edit_draft',$this->data);
	}
	
/*
*
* Blog functon for View Posts
*
*/	
 	function blogpostview(){
	
	$this->data['heading'] = $this->config->item('meta_title').' - All Post';
				$this->data['meta_title'] = $this->config->item('meta_title').' - All Post';
		if($this->checkLogin('U') !=''){
		$cond=array(NEWS.'.posted_user_id'=>$this->checkLogin('U'));
			$postData = $this->community_model->get_all_postsUsr($cond);
			$this->data['postData'] = $postData;
			$this->load->view('site/community/community/community_control/blog_all_posts',$this->data);
		}else{
			redirect('login');
		}
	}
	
						 
	/*
	* 
	* Blog functon for View Posts
	* 
	*/	
 	function eventmanageview(){
		if($this->checkLogin('U') !=''){
		$this->data['heading'] =$this->config->item('meta_title').' - Manage Events';
			$condition=array('eventAddedby'=>$this->checkLogin('U'));
			$postData = $this->community_model->get_all_events1($condition);
			$this->data['postData'] = $postData;
			$this->load->view('site/community/community/community_control/blog_all_events',$this->data);
		}else{
			redirect('login');
		}
	}
	
	/*
	* 
	* Blog functon for View Posts
	* 
	*/
 	function teammanageview(){
		if($this->checkLogin('U') !=''){
		$this->data['heading'] =$this->config->item('meta_title').' - Manage Teams';
			$condition=array('teamCaptainId'=>$this->checkLogin('U'));
			$postData = $this->community_model->get_all_team1($condition);
			$this->data['postData'] = $postData;
			$this->load->view('site/community/community/community_control/blog_all_teams',$this->data);
		}else{
			redirect('login');
		}
	}
	
	
	/*
	* 
	* Blog functon for View Posts for particular id
	* 
	*/
 	function blogpostsingleview(){
		$post_id = $this->uri->segment(4);
		$this->data['heading'] =$this->config->item('meta_title').' - Manage News';
		$postViewData = $this->community_model->get_single_posts($post_id);
		$this->data['postViewData'] = $postViewData;
		$this->load->view('site/community/community/community_control/blog_view_post',$this->data);
	}


	/*
	* 
	* Blog functon for Add Posts
	* 
	*/
 	function blogaddpost(){
		if($this->checkLogin('U') !=''){
		$this->data['heading'] =$this->config->item('meta_title').' - Manage News';
			$postData = array();
			$this->data['postData'] = $postData;
			$this->load->view('site/community/community/community_control/blog_addedit_post',$this->data);
		}else{
			redirect('');	
		}
	}

	/*
	* 
	* Blog functon for Edit Posts
	* 
	*/	
 	function blogeditpost(){
		$post_id = $this->uri->segment(4);
		$postData = array();
		$table = NEWS;
		$selectfield='*';
		$fieldName = 'post_id';
		$updateList = $post_id;
		$editpostData = $this->community_model->commonSelect($table,$selectfield,$fieldName,$updateList);
		$this->data['editpostData'] = $editpostData;
		$this->load->view('site/community/community/community_control/blog_addedit_post',$this->data);
	}

	/*
	* 
	* Blog view add edit function start
	* 
	*/
	function blogAddEditValues()
	{
			//echo '<pre>';
			//print_r($_POST); die;
			$_SESSION['userId'] = '42';
		    $table = NEWS;
			$excludeArray = array("drafts","publish","AddOrEditVal","post_status");
		    $addEditVal  = $this->getAddEditDetails($excludeArray);
			$seourl = url_title($_POST['post_title'], '_', TRUE);
			$curMonthName = date("F-Y");
			$seoArr = array("seourl"=>$seourl,"posted_month_year"=>$curMonthName);
			$addEditVal = array_merge($addEditVal,$seoArr);
			if(!empty($_FILES['post_image']['name'])){ 
				//$config['encrypt_name'] = TRUE;
				$config['overwrite'] = FALSE;
				$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
				$config['max_size'] = 2000;
				$config['upload_path'] = './images/community/news';
				$this->load->library('upload', $config);
				if ( $this->upload->do_upload('post_image')){
					$logoDetails = $this->upload->data();
					$ImageName = $logoDetails['file_name'];
					@copy('./images/community/news/'.$ImageName, './images/community/news/thumb/'.$ImageName);
					$this->ImageResizeWithCrop(145, 145, $ImageName, './images/community/news/thumb/');
					@copy('./images/community/news/'.$ImageName, './images/community/news/album/'.$ImageName);
					$this->ImageResizeWithCrop(450, 350, $ImageName, './images/community/news/album/');
					$imagesVal=$timeImg.$ImageName;
				}else{
					$logoDetails = $this->upload->display_errors();
					$this->setErrorMessage('error',$logoDetails);
					redirect('add-event'.$cat_id);
				}
				$image_data = array( 'post_image' => $imagesVal);
			}else{
				$image_data = array();
			}
			$addEditVal = array_merge($addEditVal,$image_data);
		//	print_r($addEditVal); die;
			$pref ='post_';
			$insertEditValues = $this->community_model->addEditValues($addEditVal,$table,$pref);
			
        $type = 'success';
		if($_POST['post_status']=='active'){
		if($this->lang->line('news_upsated')!='') { $message= stripslashes($this->lang->line('news_upsated')); } else $message ="News Updated Successfully!";
		}else{
		if($this->lang->line('news_upsate_post_change')!='') { $message= stripslashes($this->lang->line('news_upsate_post_change')); } else $message ="News Updated Successfully! If you want post change status active!";
		}
		$this->setErrorMessage($type,$message);
	    redirect('manage-community');
	}

	/*
	* 
	* This function delete the posts record from db
	* 
	*/
	public function delete_posts(){
			$comment_id = $this->uri->segment(4);
			$condition = array('post_id' => $comment_id);
			$this->community_model->commonDelete(NEWS,$condition);
            $type = 'success';
			if($this->lang->line('news_deleted')!='') { $message= stripslashes($this->lang->line('news_deleted')); } else $message ="News deleted successfully";
		
		 //  $message =  "News deleted successfully";
		   $this->setErrorMessage($type,$message);

			redirect('manage-community');
	}
	
	/*
	* 
	* This function delete the events record from db
	* 
	*/
	public function delete_event_v(){
			$comment_id = $this->uri->segment(4);
			$condition = array('id' => $comment_id);
			$this->community_model->commonDelete(EVENTS,$condition);
            $type = 'success';
		  if($this->lang->line('event_deleted_successfully')!='') { $message= stripslashes($this->lang->line('event_deleted_successfully')); } else $message ="Event deleted successfully";
		   $this->setErrorMessage($type,$message);

			redirect('manage-events');
	}
	
	/*
	* 
	* This function delete the team record from db
	* 
	*/
	public function delete_team_v(){
			$comment_id = $this->uri->segment(4);
			$condition = array('id' => $comment_id);
			$this->community_model->commonDelete(TEAMS,$condition);
            $type = 'success';
			if($this->lang->line('team_deleted_successfully')!='') { $message= stripslashes($this->lang->line('team_deleted_successfully')); } else $message ="Team deleted successfully";
		  
		   $this->setErrorMessage($type,$message);

			redirect('manage-teams');
	}
	
	/*
	* 
	* This function update the posts status record from db
	*
	*/
	public function update_posts(){
			$comment_id = $this->uri->segment(4);
			$status = $this->uri->segment(5);
			if($status == 'active'){
				$comment_status = 'inactive';
			}else{
				$comment_status = 'active';					
			}
			$fieldName = 'post_id';
			$updateList = $comment_id;
			$condition = array('post_status' => $comment_status);
			$this->community_model->commonUpdate(NEWS,$condition,$fieldName,$updateList);
            $type = 'success';
		   if($this->lang->line('news_upsated')!='') { $message= stripslashes($this->lang->line('news_upsated')); } else $message ="News updated successfully";
		   
		    $this->setErrorMessage($type,$message);
			redirect('manage-community');
	}
	
	/*
	* 
	* This function update the event record from db
	* 
	*/
	public function update_events(){
			$comment_id = $this->uri->segment(4);
			$status = $this->uri->segment(5);
			//echo $status; die;
			if($status == 'Active'){
				$comment_status = 'Inactive';
			}else{
				$comment_status = 'Active';					
			}
			$fieldName = 'id';
			$updateList = $comment_id;
			$condition = array('status' => $comment_status);
			//echo $comment_status; die;
			$this->community_model->commonUpdate(EVENTS,$condition,$fieldName,$updateList);
			//echo $this->db->last_query(); die;
            $type = 'success';
		    if($this->lang->line('event_updateed')!='') { $message= stripslashes($this->lang->line('event_updateed')); } else $message ="Event updated successfully";
		    
		    $this->setErrorMessage($type,$message);
			redirect('manage-events');
	}
	
	/*
	* 
	* This function update the team record from db
	* 
	*/
	public function update_teams(){
			$comment_id = $this->uri->segment(4);
			$status = $this->uri->segment(5);
			//echo $status; die;
			if($status == 'Active'){
				$comment_status = 'Inactive';
			}else{
				$comment_status = 'Active';					
			}
			$fieldName = 'id';
			$updateList = $comment_id;
			$condition = array('status' => $comment_status);
			//echo $comment_status; die;
			$this->community_model->commonUpdate(TEAMS,$condition,$fieldName,$updateList);
			//echo $this->db->last_query(); die;
            $type = 'success';
		    if($this->lang->line('team_updated_successfully')!='') { $message= stripslashes($this->lang->line('team_updated_successfully')); } else $message ="Team updated successfully";
		    $this->setErrorMessage($type,$message);
			redirect('manage-teams');
	}


	/*
	* 
	* This function View the Particular Posts  from db
	* 
	*/
	public function view_particluar_posts(){
			$comment_id = $this->uri->segment(4);
			$status = $this->uri->segment(5);
			if($status == 'active'){
				$comment_status = 'inactive';
			}else{
				$comment_status = 'active';					
			}
			$fieldName = 'post_id';
			$updateList = $comment_id;
			$condition = array('post_status' => $comment_status);
			$this->community_model->commonUpdate(NEWS,$condition,$fieldName,$updateList);
            $type = 'success';
			 if($this->lang->line('comments_updateed')!='') { $message= stripslashes($this->lang->line('comments_updateed')); } else $message ="Comments updated successfully";
		    
		    $this->setErrorMessage($type,$message);
			redirect('manage-community');
	}

	/*
	* 
	* Blog functon for View Unpublished
	* 
	*/
 	function blogunpublishview(){
		
		$table = NEWS;
		$selectfield='*';
		$fieldName = 'post_status';
		$updateList = 'inactive';
		$unpublishData = $this->community_model->commonSelect($table,$selectfield,$fieldName,$updateList);
		$this->data['unpublishData'] = $unpublishData;
		$this->load->view('site/community/community/community_control/blog_all_unpublish',$this->data);
	}
 
	/*
	* 
	* Blog functon for View Published for particular id
	* 
	*/
 	function blogpublishsingleview(){
		$post_id = $this->uri->segment(4);
		$postViewData = $this->community_model->get_single_posts($post_id);
//		echo '<pre>';
//		print_r($postViewData); die;
		$this->data['postViewData'] = $postViewData;
		$this->load->view('site/community/community/community_control/blog_view_publish',$this->data);
	}
	
	/*
	* 
	* Blog functon for View published
	* 
	*/
 	function blogpublishview(){
		$publishData = $this->community_model->get_all_published();
		$this->data['publishData'] = $publishData;
		$this->load->view('site/community/community/community_control/blog_all_publish',$this->data);
	}
	
	/*
	* 
	* Blog  Post Active/Inactive/Delete function start
	* 
	*/
		
	function productActiveInactiveDeleteFunction() {	
			$fieldName = 'post_id';
			$tableName = NEWS;
			$this->commonManageActiveInactive($changeMode,$jobSeekerId,$userType,$paginationNo,$fieldName,$redirectTo,$tableName);
	 }
	
	/*
	* 
	* This function delete the team record from db
	* 
	*/	
	function eventActiveInactiveDeleteFunction() {	
			$fieldName = 'id';
			$tableName = EVENTS;
			$this->commonEManageActiveInactive($changeMode,$jobSeekerId,$userType,$paginationNo,$fieldName,$redirectTo,$tableName);
	 }
	
	/*
	* 
	* This function delete the team record from db
	* 
	*/
	function teamActiveInactiveDeleteFunction() {	
			$fieldName = 'id';
			$tableName = TEAMS;
			$this->commonEManageActiveInactive($changeMode,$jobSeekerId,$userType,$paginationNo,$fieldName,$redirectTo,$tableName);
	 }
	
	/*
	* 
	* Attribute  Active/Inactive/Delete function end
	* param String $changeMode
	* param String $jobSeekerId
	* param String $userType
	* param String $paginationNo
	* param String $fieldName
	* param String $redirectTo
	* param String $tableName
	* 
	*/
	function commonManageActiveInactive($changeMode,$jobSeekerId,$userType,$paginationNo,$fieldName,$redirectTo,$tableName)
	{
	
		/* active/inactive/delete for single  start */
	
				$statusMode = $this->input->post('statusMode');
				$seekerCheckbox = $this->input->post('seekerCheckbox');
				$pagename = $this->input->post('pagename');
				
				//echo $pagenameId;
				//echo $statusMode;
				//echo "<pre>";print_r($seekerCheckbox);die;die;
				if($statusMode == 'active')
				{
					$value = 'active';
				}
				else if($statusMode == 'inactive')
				{
					$value = 'inactive';
				}
				else
				{
					$value = 'delete';
				}
				if($pagename == 'community-post-comments'){
					$updateValues = array('comment_status'=>$value);
				}else{
					$updateValues = array('post_status'=>$value);
				}
				$userList = $seekerCheckbox;
				if($value != 'delete')
				{
					$commonActiveInactive = $this->community_model->commonActiveInactive($tableName,$fieldName,$userList,$updateValues);
					
					$type = 'success';
					$message = ucfirst($value).' Successfully';
					$this->setErrorMessage($type,$message);
					
					//echo'gfgg'; die;
					
					redirect($pagename);
					
				}
				else
				{
				
				
					$commonDelete = $this->community_model->CommonGeneralDelete($tableName,$fieldName,$userList);
					
					$type = 'success';
					if($this->lang->line('del_success')!='') { $message= stripslashes($this->lang->line('del_success')); } else $message ="Deleted Successfully";
					$this->setErrorMessage($type,$message);
					if($pagenameId!=''){
						redirect($pagename.'/'.$pagenameId);
					}else{ 
						redirect($pagename);
					}
				}
			
			/* active/inactive/delete for multiple  end*/
	}
	
	/*
	* 
	* Attribute  Active/Inactive/Delete function end
	* param String $changeMode
	* param String $jobSeekerId
	* param String $userType
	* param String $paginationNo
	* param String $fieldName
	* param String $redirectTo
	* param String $tableName
	* 
	*/	
	function commonEManageActiveInactive($changeMode,$jobSeekerId,$userType,$paginationNo,$fieldName,$redirectTo,$tableName)
	{
	
		/* active/inactive/delete for single  start */
	
				$statusMode = $this->input->post('statusMode');
				$seekerCheckbox = $this->input->post('seekerCheckbox');
				$pagename = $this->input->post('pagename');
				//echo $statusMode;
				//echo "<pre>";print_r($seekerCheckbox);die;die;
				if($statusMode == 'Active')
				{
					$value = 'Active';
				}
				else if($statusMode == 'Inactive')
				{
					$value = 'Inactive';
				}
				else
				{
					$value = 'delete';
				}
				if($pagename == 'manage-events'){
				$updateValues = array('status'=>$value);
				}else{
				
				$updateValues = array('status'=>$value);
				
				}
				$userList = $seekerCheckbox;
				if($value != 'delete')
				{
					$commonActiveInactive = $this->community_model->commonActiveInactive($tableName,$fieldName,$userList,$updateValues);
					
					$type = 'success';
					//$message = ucfirst($value).' Successfully';
					if($value == "Inactive")
					{
						if($this->lang->line('inact_success')!='') { $message= stripslashes($this->lang->line('inact_success')); } else $message ="Inactive Successfully";
					}else{
						if($this->lang->line('act_success')!='') { $message= stripslashes($this->lang->line('act_success')); } else $message ="Active Successfully";
						
						
					}
					$this->setErrorMessage($type,$message);
					
					//echo'gfgg'; die;
					
					redirect($pagename);
					
				}
				else
				{

					$commonDelete = $this->community_model->CommonGeneralDelete($tableName,$fieldName,$userList);
					
					$type = 'success';
					if($this->lang->line('del_success')!='') { $message= stripslashes($this->lang->line('del_success')); } else $message ="Deleted Successfully";
					$this->setErrorMessage($type,$message);
					
					redirect($pagename);
				}
			
			/* active/inactive/delete for multiple  end*/
	}
	
	/*
	* 
	* Common Team Discussion Active/Inactive/Delete function end
	* param String $changeMode
	* param String $jobSeekerId
	* param String $userType
	* param String $paginationNo
	* param String $fieldName
	* param String $redirectTo
	* param String $tableName
	* 
	*/
	function commonTDManageActiveInactive($changeMode,$jobSeekerId,$userType,$paginationNo,$fieldName,$redirectTo,$tableName)
	{
	
		/* active/inactive/delete for single  start */
	
				$statusMode = $this->input->post('statusMode');
				$seekerCheckbox = $this->input->post('seekerCheckbox');
				$pagename = $this->input->post('pagename');
				$pagenameId =$this->input->post('pagenameId');
				//echo $statusMode;
				//echo $pagename; die;
				//echo "<pre>";print_r($seekerCheckbox);die;die;
				if($statusMode == 'Active')
				{
					$value = 'Active';
				}
				else if($statusMode == 'Inactive')
				{
					$value = 'Inactive';
				}
				else
				{
					$value = 'delete';
				}
				if($pagename == 'manage-discussions'){
				$updateValues = array('status'=>$value);
				}else{
				
				$updateValues = array('status'=>$value);
				
				}
				$userList = $seekerCheckbox;
				if($value != 'delete')
				{
					$commonActiveInactive = $this->community_model->commonActiveInactive($tableName,$fieldName,$userList,$updateValues);
					
					$type = 'success';
					//$message = ucfirst($value).' Successfully';
					if($value == "Inactive")
					{
						if($this->lang->line('inact_success')!='') { $message= stripslashes($this->lang->line('inact_success')); } else $message ="Inactive Successfully";
					}else{
						if($this->lang->line('act_success')!='') { $message= stripslashes($this->lang->line('act_success')); } else $message ="Active Successfully";
						
						
					}
					$this->setErrorMessage($type,$message);
					
					//echo'gfgg'; die;
					
					redirect($pagename.'/'.$pagenameId);
					
				}
				else
				{

					$commonDelete = $this->community_model->CommonGeneralDelete($tableName,$fieldName,$userList);
					
					$type = 'success';
					//$message = 'Deleted Successfully';
					if($this->lang->line('del_success')!='') { $message= stripslashes($this->lang->line('del_success')); } else $message ="Deleted Successfully";
					
					$this->setErrorMessage($type,$message);
					
					redirect($pagename.'/'.$pagenameId);
				}
			
			/* active/inactive/delete for multiple  end*/
	}
	
	/*
	* 
	* Common Team Manage Active/Inactive/Delete function end
	* param String $changeMode
	* param String $jobSeekerId
	* param String $userType
	* param String $paginationNo
	* param String $fieldName
	* param String $redirectTo
	* param String $tableName
	* 
	*/
	function commonTManageActiveInactive($changeMode,$jobSeekerId,$userType,$paginationNo,$fieldName,$redirectTo,$tableName)
	{
	
		/* active/inactive/delete for single  start */
	
				$statusMode = $this->input->post('statusMode');
				$seekerCheckbox = $this->input->post('seekerCheckbox');
				$pagename = $this->input->post('pagename');
				//echo $statusMode;
				//echo "<pre>";print_r($seekerCheckbox);die;die;
				if($statusMode == 'Active')
				{
					$value = 'Active';
				}
				else if($statusMode == 'Inactive')
				{
					$value = 'Inactive';
				}
				else
				{
					$value = 'delete';
				}
				if($pagename == 'manage-teams'){
				$updateValues = array('status'=>$value);
				}else{
				
				$updateValues = array('status'=>$value);
				
				}
				$userList = $seekerCheckbox;
				if($value != 'delete')
				{
					$commonActiveInactive = $this->community_model->commonActiveInactive($tableName,$fieldName,$userList,$updateValues);
					
					$type = 'success';
					//$message = ucfirst($value).' Successfully';
					if($value == "Inactive")
					{
						if($this->lang->line('inact_success')!='') { $message= stripslashes($this->lang->line('inact_success')); } else $message ="Inactive Successfully";
					}else{
						if($this->lang->line('act_success')!='') { $message= stripslashes($this->lang->line('act_success')); } else $message ="Active Successfully";
						
						
					}
					$this->setErrorMessage($type,$message);
					
					//echo'gfgg'; die;
					
					redirect($pagename);
					
				}
				else
				{

					$commonDelete = $this->community_model->CommonGeneralDelete($tableName,$fieldName,$userList);
					
					$type = 'success';
					//$message = 'Deleted Successfully';
					if($this->lang->line('del_success')!='') { $message= stripslashes($this->lang->line('del_success')); } else $message ="Deleted Successfully";
					$this->setErrorMessage($type,$message);
					
					redirect($pagename);
				}
			
			/* active/inactive/delete for multiple  end*/
	}

	/*
	* 
	* Blog Post Comment Page for Store Blog
	* 
	*/	
 	function userPostComments(){
			$searchPerPage = 3;
		    $paginationNo = $this->uri->segment('3');  
			if($paginationNo == '')
			{
					$paginationNo = 0;
			}
			else
			{
					$paginationNo = $paginationNo;
			}
		//$blogTotal = $this->community_model->get_all_posts();
		$postId = $this->uri->segment('1'); 
		$getTotalComments = $this->community_model->get_post_comments('','',$postId); 
		$getPostDetails = $this->community_model->get_single_posts($postId);
		$getPostComments = $this->community_model->get_post_comments($searchPerPage,$paginationNo,$postId);
		//echo '<pre>';
		//print_r($getPostDetails); die;
			$searchbaseUrl = base_url().$this->uri->segment('1').'/'.$this->uri->segment('2').'/';
			//$product_routes_name = $this->uri->segment(); 

			$config['prev_link'] = '<img src="images/slider_prev_hover.png" />';
			$config['num_links'] = 3;
			$config['display_pages'] = TRUE; 
			$config['next_link'] = '<img src="images/slider_next_hover.png" />';
			$config['base_url'] = $searchbaseUrl;
			$config['total_rows'] = count($getTotalComments); 
			$config["per_page"] = $searchPerPage;
			$config["uri_segment"] = 3;
			$config['first_link'] = '';
			$config['last_link'] = '';
			$this->pagination->initialize($config); 
			 $paginationLink = $this->pagination->create_links(); 
			$this->data['paginationLink'] = $paginationLink;

		  
		   $this->data['getPostComments'] = $getPostComments;
		   $this->data['getPostDetails'] = $getPostDetails;
           $this->load->view('site/community/community/community_view/blog_post_comments',$this->data);
	}
	
    /*
	* 
	* Add Comments to post
	*
	*/
	function commentAddValues()
	{
			//echo '<pre>';
			//print_r($_POST); 
		    $table = NEWSCOMMENT;
			$excludeArray = array("drafts","publish","AddOrEditVal","seller_business");
		    $addEditVal  = $this->getAddEditDetails($excludeArray);
			$seourl = url_title($_POST['comments_title'], '_', TRUE);
			$curMonthName = date("F-Y");
			$seoArr = array("seourl"=>$seourl,"comment_month_year"=>$curMonthName,'comment_user_id'=>$this->data['userId']);
			$addEditVal = array_merge($addEditVal,$seoArr);
			$pref ='comment_';
			$insertEditValues = $this->community_model->addEditValues($addEditVal,$table,$pref);
			//echo $this->db->last_query(); die;
			$type = 'success';
			if($this->lang->line('comments_added_successfully')!='') { $message= stripslashes($this->lang->line('comments_added_successfully')); } else $message ="Comments Added Successfully";
			$this->setErrorMessage($type,$message);
			redirect('community-newslist');
	}

	

}

/* End of file community.php */
/* Location: ./application/controllers/admin/community.php */