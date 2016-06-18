<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * This controller contains the functions related to seller management
 * @author Teamtweaks
 *
 */

class Community extends MY_Controller {

	function __construct(){
        parent::__construct();
		$this->load->helper(array('cookie','date','form'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model('community_model');
		$this->load->model('community_news_model');
		
		if ($this->checkPrivileges('community',$this->privStatus) == FALSE){
			redirect('admin');
		}
    }
    
    /**
     * 
     * This function loads the seller requests page
     */
   	public function index(){	
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			redirect('admin/community/display_events_dashboard');
		}
	}
	/**
	 * 
	 * This function loads the events list page
	 */
	public function display_events_dashboard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else{
			$this->data['heading'] = 'Events List';
			$condition ='';
			$this->data['eventsList'] = $this->community_model->get_all_Events($condition);
			//echo '<pre>'; print_r($this->data); die;
			$this->load->view('admin/community/events/display_events_dashboard',$this->data);
		}
	}
	/**
	 * 
	 * This function insert a event form
	 */
	
	public function add_event_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Add New Event';
			
			$this->load->view('admin/community/events/addEdit_event_form',$this->data);
		}
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
			$condition = array(EVENTS.'.id' => $this->data['event_id']);
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
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			
		// echo url_title($this->input->post('eventTitle'),'-',TRUE); 
		#echo '<pre>'; print_r($_POST); die;
			#echo $this->input->post('eventDate');die;
			/*$date = $this->input->post('eventDate');
		
			$date = str_replace('/', '-', $date); */
			$eventDate=date_format(new DateTime($this->input->post('eventDate')),'Y-m-d');
			$eventTitle=$this->input->post('eventTitle');
			$seourl = url_title($eventTitle,'-',TRUE);
			$excludeArr = array("status","event_id");
			
			if ($this->input->post('status') != ''){
				$event_status = 'Active';
			}else {
				$event_status = 'Inactive';
			}
			
			if ($this->input->post('eventType') != ''){
				$eventType = 'Special';
			}else {
				$eventType = 'Normal';
			}
			
			if(!empty($_FILES['imagePath']['name'])){ 
				//$config['encrypt_name'] = TRUE;
				$config['overwrite'] = FALSE;
				$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
				$config['width']	= 1000;
				$config['height']	= 1000;
				$config['max_size'] = 2000;
				$config['upload_path'] = './images/community/events';
				$this->load->library('upload', $config);
				if ( $this->upload->do_upload('imagePath')){
					$logoDetails = $this->upload->data();
					$ImageName = $logoDetails['file_name'];
				}else{
					$logoDetails = $this->upload->display_errors();
					$this->setErrorMessage('error',$logoDetails);
					redirect('admin/community/add_event_form/'.$cat_id);
				}
				$image_data = array( 'imagePath' => $ImageName);
			}else{
				$image_data = array();
			}

		
			$dataArr = array( 'eventType'=>$eventType,'status' => $event_status,'event_seourl'=>$seourl,'eventDate'=>$eventDate,'eventAddedby'=>'1');
			$dataArr =array_merge($dataArr,$image_data);
			if ($this->input->post('event_id') != ''){
				$condition=array('id'=>$this->input->post('event_id'));
				$this->community_model->commonInsertUpdate(EVENTS,'update',$excludeArr,$dataArr,$condition);
			}else{
				$this->community_model->commonInsertUpdate(EVENTS,'insert',$excludeArr,$dataArr,$condition='');
			}
			
			//echo $this->db->last_query(); die;
			
			$this->setErrorMessage('success','Event added successfully');
			redirect('admin/community/display_events_dashboard');
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
				$this->setErrorMessage('success','Event deleted successfully');
			}else {
				$this->setErrorMessage('success','Event  status changed successfully');
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
			$this->setErrorMessage('success','Event deleted successfully');
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
			$status = ($mode == '0')?'Unpublish':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $event_id);
			$this->community_model->update_details(EVENTS,$newdata,$condition);
			$this->setErrorMessage('success','Event Status Changed Successfully');
			redirect('admin/community/display_events_dashboard');
		}
	}
	
	
	/**
	 * 
	 * This function loads the teams list page
	 */
	public function display_teams_dashboard(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$this->data['heading'] = 'Teams List';
			$condition ='';
			$this->data['teamsList'] = $this->community_model->get_all_Teams($condition);
			//echo '<pre>'; print_r($this->data['teamsList']); die;
			$this->load->view('admin/community/teams/display_teams_dashboard',$this->data);
		}
	}
	
	
	/**
	 * 
	 * This function insert a team form
	 */
	public function add_team_form(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else{
			$this->data['heading'] = 'Add New Team';
			$this->load->view('admin/community/teams/addEdit_team_form',$this->data);
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
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
		//echo url_title($this->input->post('eventTitle'),'-',TRUE); 
		//echo '<pre>'; print_r($_POST); die;
			$teamName=$this->input->post('teamName');
			$seourl = url_title($teamName,'-',TRUE);
			$excludeArr = array("status","team_id");
			
			if ($this->input->post('status') != ''){
				$team_status = 'Active';
			}else {
				$team_status = 'Inactive';
			}
			
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
					redirect('admin/community/add_team_form/'.$cat_id);
				}
				$image_data = array('teamImage' => $ImageName);
			}else{
				$image_data = array();
			}

			$dataArr = array( 'status' => $team_status,'teamCaptainId'=>'1','teamSeourl'=>$seourl,'teamAddDate'=>date('Y-m-d'));
			$dataArr =array_merge($dataArr,$image_data);
			//echo '<pre>'; print_r($dataArr); die;
			if ($this->input->post('team_id') != ''){
				$condition=array('id'=>$this->input->post('team_id'));
				$this->community_model->commonInsertUpdate(TEAMS,'update',$excludeArr,$dataArr,$condition);
				$this->setErrorMessage('success','Team details edited successfully');
			}else{
				$this->community_model->commonInsertUpdate(TEAMS,'insert',$excludeArr,$dataArr,$condition='');
				 $teamId=$this->db->insert_id(); 
				 $userId= 1; 
				  $excludeArr = array('teamName','teamshortDescription', 'teamDescription','teamRules','teamTags','team_id');
				 $dataArr1 = array( 'teamId'=> $teamId,'captainId'=>$userId,'userId'=>$userId,'memberType'=>'Captain','joinDate'=>date('Y m d H:i:s'));
				
				 $this->community_model->commonInsertUpdate(TEAMMEMBERS,'insert',$excludeArr,$dataArr1,$condition='');
				$this->setErrorMessage('success','Team added successfully');
			}
			redirect('admin/community/display_teams_dashboard');
		}
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
			$status = ($mode == '0')?'Unpublish':'Active';
			$newdata = array('status' => $status);
			$condition = array('id' => $team_id);
			$this->community_model->update_details(TEAMS,$newdata,$condition);
			$this->setErrorMessage('success','Team Status Changed Successfully');
			redirect('admin/community/display_teams_dashboard');
		}
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
			$this->setErrorMessage('success','Team deleted successfully');
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
	 * This function loads gmap
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
	
							 /* This function Load team discussions */	
 	function teamdiscussionview(){
		
		if($this->checkLogin('A')!=''){
				$this->data['heading'] = '  Team Discussion';
				$this->data['meta_title'] = ' Team Discussion';
			$condition1 =array('rootId'=>0);
			$condition2 =array_merge(array(TEAMDISCUSSSION.'.teamId'=>$this->uri->segment(4)),$condition1);	
			
			$condition =array_merge(array(TEAMDISCUSSSION.'.postType'=>'Original'),$condition2);			
			$commentData = $this->community_model->get_all_TeamDiscussionwithMemberinfo($condition);
		$this->data['commentData'] = $commentData;
		//echo '<pre>'; print_r($commentData); die;
		$this->load->view('admin/community/teams/display_comments',$this->data);
		}else{
			redirect('admin');
		}
	}
	
	
	 /* This function Load team discussions */	
 	function teamdiscussionThreadview(){
	if($this->checkLogin('A')!=''){
				$this->data['heading'] = $this->config->item('meta_title').' - Team Discussion';
				$this->data['meta_title'] = $this->config->item('meta_title').' - Team Discussion';
			$condition1 =array('rootId'=>$this->uri->segment(4));
			$condition =array_merge(array(TEAMDISCUSSSION.'.postType'=>'Responses'),$condition1);			
			$commentData = $this->community_model->get_all_TeamDiscussionwithMemberinfo($condition);
		$this->data['commentData'] = $commentData;
		//echo '<pre>'; print_r($commentData); die;
		$this->load->view('admin/community/teams/display_discussthread',$this->data);
		}else{
			redirect('admin');
		}
	}
	
	/**
	 * 
	 * This function change the comment page status
	 */
	public function change_discuss_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$cms_id = $this->uri->segment(5,0); 
			$orgNewsid=$this->uri->segment(6,0); 
			$status = ($mode == '0')?'Unpublish':'Active'; 
			$newdata = array('status' => $status);
			$condition = array('id' => $cms_id);
			$this->community_news_model->update_details(TEAMDISCUSSSION,$newdata,$condition);
			//echo $this->db->last_query(); die;
			$this->setErrorMessage('success','Discussion Status Changed Successfully');
			redirect('admin/community/teamdiscussionview/'.$orgNewsid);
		}
	}
	
	/**
	 * 
	 * This function change the comment page status
	 */
	public function change_discussthrd_status(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$mode = $this->uri->segment(4,0);
			$cms_id = $this->uri->segment(5,0); 
			$orgNewsid=$this->uri->segment(6,0); 
			$status = ($mode == '0')?'Unpublish':'Active'; 
			$newdata = array('status' => $status);
			$condition = array('id' => $cms_id);
			$this->community_news_model->update_details(TEAMDISCUSSSION,$newdata,$condition);
			//echo $this->db->last_query(); die;
			$this->setErrorMessage('success','Discussion Status Changed Successfully');
			redirect('admin/community/teamdiscussionThreadview/'.$orgNewsid);
		}
	}
	
	 /* 
	 * This function delete the comment post from db
	 */
	public function delete_discuss(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$cms_id = $this->uri->segment(4,0);
			$condition = array('id' => $cms_id);
			$orgNewsid=$this->uri->segment(5,0); 
			$this->community_news_model->commonDelete(TEAMDISCUSSSION,$condition);
			$this->setErrorMessage('success','Discussion deleted successfully');
			redirect('admin/community/teamdiscussionview/'.$orgNewsid);
		}
	}
	
	/* 
	 * This function delete the comment post from db
	 */
	public function delete_discussthrd(){
		if ($this->checkLogin('A') == ''){
			redirect('admin');
		}else {
			$cms_id = $this->uri->segment(4,0);
			$condition = array('id' => $cms_id);
			$orgNewsid=$this->uri->segment(5,0); 
			$this->community_news_model->commonDelete(TEAMDISCUSSSION,$condition);
			$this->setErrorMessage('success','Discussion deleted successfully');
			redirect('admin/community/teamdiscussionThreadview/'.$orgNewsid);
		}
	}

}

/* End of file community.php */
/* Location: ./application/controllers/admin/community.php */