<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * This model contains all db functions related to seller requests
 * @author Teamtweaks
 *
 */
class Community_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	/**
    * 
    * Getting Sellers details
    * @param String $condition
    */
   public function get_sellers_details($condition=''){
   		$Query = " select * from ".USERS." ".$condition;
   		return $this->ExecuteQuery($Query);
   }
   /**
	* function to get all event details
	* Param array condition
	* Param string order
	*/
    public function get_all_Events($condition='',$orderBy=''){
	
		$this->db->select(EVENTS.'.*,'.USERS.'.full_name,'.USERS.'.user_name');	
		$this->db->join(USERS, USERS.'.id='.EVENTS.'.eventAddedby');
		$this->db->from(EVENTS);	
		if($condition!=''){ 
			$this->db->where($condition);
		}
		
		if(!empty($orderBy))
		{			 
			foreach($orderBy as $key=>$val)
			{
				$this->db->order_by($key,$val); 
			}
		}else{
			$this->db->order_by('id', 'DESC');
		}
		$query = $this->db->get();
		#echo $this->db->last_query(); die;
		$resultQuery = $query->result();
		return $query; 
   }
   /**
	* function to get all team details
	* Param array conditions
	* Param string tag keys
	* Param Int Items per page
	* Param Int no of pages	
	*/
   public function get_all_Teams($condition=array(),$keysTag='',$searchPerPage='',$paginationNo=''){
		$this->db->select(TEAMS.'.*,'.USERS.'.full_name as fullName,'.USERS.'.thumbnail as userImg,'.USERS.'.email');	
		$this->db->from(TEAMS);
		$this->db->join(USERS, USERS.'.id='.TEAMS.'.teamCaptainId');
	
		if($condition!=''){ 
			$this->db->where($condition);
		}
		   
		if($keysTag!=''){ 
			$this->db->like('teamTags',$keysTag);
		}
		
		//$this->db->where(TEAMS.'.id','20');
		$this->db->order_by(TEAMS.'.id', 'DESC');
		
		if($searchPerPage !='')
		{
			$this->db->limit($searchPerPage,$paginationNo);
		}
		$query = $this->db->get();
		$resultQuery = $query->result();
		#echo $query->num_rows().'<br>';
		#echo $this->db->last_query(); die;
		return $query; 
   }
   /**
	* function to get team discussions
	* Param string condition
	*/
   
   public function get_all_TeamDiscussion($condition=''){
		$this->db->select(TEAMDISCUSSSION.'.*,'.USERS.'.full_name as fullName,'.USERS.'.thumbnail as userImg,'.USERS.'.email');	
		$this->db->from(TEAMDISCUSSSION);
		$this->db->join(USERS, USERS.'.id='.TEAMDISCUSSSION.'.UserId');
	
		if($condition!=''){ 
			$this->db->where($condition);
		}
		$this->db->order_by(TEAMDISCUSSSION.'.postDate', 'DESC');
		$query = $this->db->get();
		$resultQuery = $query->result();
		
		//echo $this->db->last_query(); die;
		return $query; 
   }
   /**
	* function to get Team discussion with member details
	* Param string Condition
	*/
   public function get_all_TeamDiscussionwithMemberinfo($condition=''){
		$this->db->select(TEAMDISCUSSSION.'.*,'.USERS.'.full_name as fullName,'.USERS.'.thumbnail as userImg,'.USERS.'.email,'.USERS.'.user_name,'.TEAMMEMBERS.'.memberType,'.TEAMS.'.teamName,'.TEAMS.'.teamSeourl');	
		$this->db->from(TEAMDISCUSSSION);
		$this->db->join(USERS, USERS.'.id='.TEAMDISCUSSSION.'.userId','right');
		$this->db->join(TEAMS, TEAMS.'.id='.TEAMDISCUSSSION.'.teamId','right');
		$this->db->join(TEAMMEMBERS, TEAMMEMBERS.'.userId='.USERS.'.id');
	
		if($condition!=''){ 
			$this->db->where($condition);
		}
		if($this->uri->segment(1) == 'team'){
			$this->db->where(TEAMDISCUSSSION.'.status','Active');
		}
		$this->db->order_by(TEAMDISCUSSSION.'.postDate', 'DESC');
		$this->db->group_by(TEAMDISCUSSSION.'.id'); 
		$query = $this->db->get();
		$resultQuery = $query->result();
		
		#echo $this->db->last_query(); die;
		return $query; 
   }
   /**
	* function to get Team Member information
	* Param string Condition
	*/
   public function get_all_Teammemberinfo($condition=''){
		$this->db->select(USERS.'.*,'.TEAMS.'.teamName,'.TEAMS.'.teamSeourl,'.TEAMMEMBERS.'.joinDate,'.TEAMMEMBERS.'.memberType,'.SELLER.'.seller_businessname,'.SELLER.'.seourl as shopurl,'.SELLER.'.id as shopId,'.TEAMMEMBERS.'.userId');	
		$this->db->from(TEAMMEMBERS);
		$this->db->join(USERS, USERS.'.id='.TEAMMEMBERS.'.userId');
		$this->db->join(TEAMS, TEAMS.'.id='.TEAMMEMBERS.'.teamId');
		$this->db->join(SELLER, SELLER.'.seller_id='.USERS.'.id','left');
	//print_r($condition); die;
		if($condition!=''){ 
			$this->db->where($condition);
		}
			if($this->uri->segment(4)=='name'){
				$this->db->order_by(USERS.'.full_name', 'ASC');
			}else{
				$this->db->order_by(TEAMMEMBERS.'.joinDate', 'DESC');
			}
		$query = $this->db->get();
		$resultQuery = $query->result();
		
		//echo $this->db->last_query(); die;
		return $query; 
   }
   
   public function get_all_TeamDiscussionOnlyMemberifo($condition=''){
		$this->db->select(TEAMDISCUSSSION.'.*,'.USERS.'.full_name as fullName,'.USERS.'.thumbnail as userImg,'.USERS.'.email,'.TEAMMEMBERS.'.memberType,'.TEAMS.'.teamName,'.TEAMS.'.teamSeourl');	
		$this->db->from(TEAMDISCUSSSION);
		$this->db->join(USERS, USERS.'.id='.TEAMDISCUSSSION.'.userId');
		$this->db->join(TEAMS, TEAMS.'.id='.TEAMDISCUSSSION.'.teamId');
		$this->db->join(TEAMMEMBERS, TEAMMEMBERS.'.userId='.USERS.'.id');
		
	
		if($condition!=''){ 
			$this->db->where($condition);
		}
		$this->db->order_by(TEAMDISCUSSSION.'.postDate', 'DESC');
		$query = $this->db->get();
		$resultQuery = $query->result();
		
		//echo $this->db->last_query(); die;
		return $query; 
   }
   /**
	* function to check any duplicate Member
	* Param string condition
	*/
    public function checkDublicatemember($condition=''){
		
		$this->db->select();
		$this->db->from(TEAMMEMBERS);
		
		if($condition!=''){ 
			$this->db->where($condition);
		}
		
		$query = $this->db->get();
		$resultQuery = $query->result();
		
		//echo $this->db->last_query(); die;
		return $query; 
		
	}
	
	
	
	/************* Community Blog MOdel*****************/
	
	  /* get all Comments Count Front */
    function get_all_comments_front($id)
    {			
		if($id !=''){
			$this->db->where(NEWSCOMMENT.'.comment_post_id',$id);	
		}

   		$this->db->select(NEWSCOMMENT.'.*,'.USER.'.user_name,email,group,'.NEWS.'.posted_user_id');
		$this->db->from(NEWSCOMMENT);
		$this->db->join(USER, USER.'.id ='.NEWSCOMMENT.'.comment_user_id');
		$this->db->join(NEWS, NEWS.'.post_id ='.NEWSCOMMENT.'.comment_post_id');
		$this->db->where(NEWSCOMMENT.'.comment_status','active');
		//$this->db->order_by('comment_status','active');
		
		$query = $this->db->get();
		$resultContent = $query->result_array();
		//echo $this->db->last_query(); die;
		return $resultContent;
    } 
       /* get all Comments  */
    function get_all_comments($id,$type='')
    {			
		if($id !=''){
			$this->db->where(NEWSCOMMENT.'.comment_post_id',$id);	
		}
		if($type == 'front'){
			$this->db->where(NEWSCOMMENT.'.comment_status','active');	
		}
		if($this->session->userdata('shopsy_session_user_id') !=''){
			$this->db->where(NEWSCOMMENT.'.comment_owner_id',$this->session->userdata('shopsy_session_user_id'));
		}else{
			$this->db->where(NEWSCOMMENT.'.comment_owner_id',$this->session->userdata('shopsy_session_user_id'));	
		}
   		$this->db->select(NEWSCOMMENT.'.*,'.USER.'.user_name,email,group,'.NEWS.'.posted_user_id,'.NEWS.'.post_title,'.NEWS.'.post_id');
		$this->db->from(NEWSCOMMENT);
		$this->db->join(USER, USER.'.id ='.NEWSCOMMENT.'.comment_user_id');
		$this->db->join(NEWS, NEWS.'.post_id ='.NEWSCOMMENT.'.comment_post_id');
		
		//$this->db->order_by('comment_status','active');
		
		$query = $this->db->get();
		$resultContent = $query->result_array();
		//echo $this->db->last_query(); die;
		return $resultContent;
    }
	
	  /* get all Team Discussions */
    function get_all_teamDiscussionUSR($id,$type='')
    {			
		if($id !=''){
			$this->db->where(TEAMDISCUSSSION.'.comment_post_id',$id);	
		}
		if($type == 'front'){
			$this->db->where(TEAMDISCUSSSION.'.comment_status','active');	
		}
		if($this->session->userdata('shopsy_session_user_id') !=''){
			$this->db->where(TEAMDISCUSSSION.'.comment_owner_id',$this->session->userdata('shopsy_session_user_id'));
		}else{
			$this->db->where(TEAMDISCUSSSION.'.comment_owner_id',$_SESSION['sellerId']);	
		}
   		$this->db->select(TEAMDISCUSSSION.'.*,'.USER.'.user_name,email,group');
		$this->db->from(TEAMDISCUSSSION);
		$this->db->join(USER, USER.'.id ='.NEWSCOMMENT.'.comment_user_id');
		$this->db->join(NEWS, NEWS.'.post_id ='.NEWSCOMMENT.'.comment_post_id');
		
		//$this->db->order_by('comment_status','active');
		
		$query = $this->db->get();
		$resultContent = $query->result_array();
		//echo $this->db->last_query(); die;
		return $resultContent;
    }

	function get_all_events1($condition=''){
	
		$this->db->select('*');
		$this->db->from(EVENTS);
		if($condition !=''){
			$this->db->where($condition);	
		}
		$this->db->order_by("id", "desc"); 
		$query = $this->db->get();
		$resultContent = $query->result_array();
		return $resultContent;
	}
	
	/***** Get Active All Team********/
	function get_all_team1($condition=''){
	
		$this->db->select('*');
		$this->db->from(TEAMS);
		if($condition !=''){
			$this->db->where($condition);	
		}
		$this->db->order_by("id", "desc"); 
		$query = $this->db->get();
		$resultContent = $query->result_array();
		return $resultContent;
	
	}
	
	/***** Get Active All Banner********/
	function get_all_banner_userview($condition=''){
	
		$this->db->select('*');
		$this->db->from(BANNER);
		if($condition !=''){
			$this->db->where($condition);	
		}
		$this->db->order_by("id", "desc"); 
		$query = $this->db->get();
		$resultContent = $query->result_array();
		return $resultContent;
	
	}
	
       /* get all Posts  */
    function get_all_posts($searchPerPage = '',$paginationNo = '',$getMonthType = '',$type = 'common')
    {	
		if($getMonthType !=''){
			$this->db->where(NEWS.'.posted_month_year',$getMonthType);			
		}
/*		if($type != 'common'){
				$this->db->where('posted_user_id',$this->session->userdata('shopsy_session_user_id'));	
		}
*/	
		/*if($_SESSION['sellerId'] !=''){
			$this->db->where('post_status','active');	
			$this->db->where('posted_user_id',$_SESSION['sellerId']);	
		}else{
			$this->db->where('post_status','active');	
		}*/
		//echo $this->checkLogin('U'); die;
   		$this->db->select(NEWS.'.*,'.USER.'.user_name,email,group,thumbnail,city,country,about_us');
		$this->db->from(NEWS);
		$this->db->join(USER, USER.'.id ='.NEWS.'.posted_user_id');
		
	
		$this->db->where(NEWS.'.posted_user_id !=','0');
		$this->db->order_by(NEWS.".posted_date", "desc"); 
			if($searchPerPage !='')
			{
				$this->db->limit($searchPerPage,$paginationNo);
			}	

		$query = $this->db->get();
		$resultContent = $query->result_array();
		//echo $this->db->last_query(); die;
		return $resultContent;
    }
	/* to get all post user */
	function get_all_postsUsr($cond='',$searchPerPage = '',$paginationNo = '',$getMonthType = '',$type = 'common')
    {	
		if($getMonthType !=''){
			$this->db->where(NEWS.'.posted_month_year',$getMonthType);			
		}
/*		if($type != 'common'){
				$this->db->where('posted_user_id',$this->session->userdata('shopsy_session_user_id'));	
		}
*/	
		/*if($_SESSION['sellerId'] !=''){
			$this->db->where('post_status','active');	
			$this->db->where('posted_user_id',$_SESSION['sellerId']);	
		}else{
			$this->db->where('post_status','active');	
		}*/
		//echo $this->checkLogin('U'); die;
   		$this->db->select(NEWS.'.*,'.USER.'.user_name,email,group,thumbnail,city,country,about_us');
		$this->db->from(NEWS);
		$this->db->join(USER, USER.'.id ='.NEWS.'.posted_user_id');
		if($cond!=''){
			$this->db->where($cond);
		}
	
		$this->db->where(NEWS.'.posted_user_id !=','0');
		$this->db->order_by(NEWS.".posted_date", "desc"); 
			if($searchPerPage !='')
			{
				$this->db->limit($searchPerPage,$paginationNo);
			}	

		$query = $this->db->get();
		$resultContent = $query->result_array();
		//echo $this->db->last_query(); die;
		return $resultContent;
    }
	/* to get all post user viewed Params 1.Int no of items 2.Int no of pages 3.String Month Type 4.String Type */
	function get_all_posts_userview($searchPerPage = '',$paginationNo = '',$getMonthType = '',$type = 'common')
    {	
		if($getMonthType !=''){
			$this->db->where(NEWS.'.posted_month_year',$getMonthType);			
		}
/*		if($type != 'common'){
				$this->db->where('posted_user_id',$this->session->userdata('shopsy_session_user_id'));	
		}
*/	
		/*if($_SESSION['sellerId'] !=''){
			$this->db->where('post_status','active');	
			$this->db->where('posted_user_id',$_SESSION['sellerId']);	
		}else{
			$this->db->where('post_status','active');	
		}*/
		
   		$this->db->select(NEWS.'.*,'.USER.'.user_name,email,group,thumbnail,city,country,about_us');
		$this->db->from(NEWS);
		$this->db->join(USER, USER.'.id ='.NEWS.'.posted_user_id');
		
		$this->db->where('post_status','active');	
		//$this->db->where(NEWS.'.posted_user_id !=','0');
		$this->db->order_by(NEWS.".posted_date", "desc"); 
			if($searchPerPage !='')
			{
				$this->db->limit($searchPerPage,$paginationNo);
			}	

		$query = $this->db->get();
		$resultContent = $query->result_array();
		//echo $this->db->last_query(); die;
		return $resultContent;
    }

        /* get all Particular Posts  */
    function get_single_posts($post_id='')
    {
		//$_SESSION['userId'] = '42';
   		$this->db->select(NEWS.'.*,'.USER.'.user_name,email,group,thumbnail,city,country,about_us,'.SELLER.'.seller_businessname,seller_id');
		$this->db->from(NEWS);
		$this->db->join(USER, USER.'.id ='.NEWS.'.posted_user_id','left');
		$this->db->join(SELLER, USER.'.id ='.SELLER.'.seller_id','left');
		//$this->db->where('posted_user_id',$this->session->userdata('shopsy_session_user_id'));
		$this->db->where('post_id',$post_id);
		$query = $this->db->get();
		$resultContent = $query->result_array();
	//	echo $this->db->last_query(); die;
		return $resultContent;
	}
	       /* get all Posts  */
    function get_all_drafts()
    {	
	//	$_SESSION['userId'] = '42';
   		$this->db->select(NEWS.'.*,'.USER.'.user_name,email,group');
		$this->db->from(NEWS);
		$this->db->join(USER, USER.'.id ='.NEWS.'.posted_user_id');
		$this->db->where('posted_user_id',$this->session->userdata('shopsy_session_user_id'));
		$this->db->where('post_status','draft');
		$this->db->where(NEWS.'.posted_user_id !=',0);
		$query = $this->db->get();
		$resultContent = $query->result_array();
		//echo $this->db->last_query(); die;
		return $resultContent;
    }
	      /* get all Published  */
    function get_all_published()
    {		
		//echo $this->session->userdata('shopsy_session_user_id'); 
		//$_SESSION['userId'] = '42';
   		$this->db->select(NEWS.'.*,'.USER.'.user_name,email,group');
		$this->db->from(NEWS);
		$this->db->join(USER, USER.'.id ='.NEWS.'.posted_user_id');
		$this->db->where('posted_user_id',$this->session->userdata('shopsy_session_user_id'));
		$this->db->where('post_status','active');
		$query = $this->db->get();
		$resultContent = $query->result_array();
		//echo $this->db->last_query(); die;
		return $resultContent;
    }
	function updateBlogSetup(){
		$id = $this->session->userdata('shopsy_session_user_id') ;
		$_SESSION['blogTemp'] = $_POST['tempType'];
		$data = array('blog_template' => $_POST['tempType']);
		$this->db->where('id', $id);
		$this->db->update(USER, $data); 
		return;
	}
	 /* get all drafts Count */
    function get_all_counts($status)
    {	
		if($status != 'draft'){
			$this->db->where('post_status !=','draft');
		}
		//$_SESSION['userId'] = '42';
		$this->db->select('count(post_status) as disp');
		$this->db->from(NEWS);
		$this->db->join(USER, USER.'.id ='.NEWS.'.posted_user_id');
		$this->db->where('posted_user_id',$this->session->userdata('shopsy_session_user_id'));	
		
		if($status != ''){
		$this->db->where('post_status',$status);
		
		}
		$query = $this->db->get();
		$countall = $query->result_array(); 
		return $countall;
		}
					 /* get all Cooments Count */
    function get_allcomment_counts($status)
    {	
		
		//echo $status; die;
		//$_SESSION['userId'] = '42';
		$this->db->select('count(comment_status) as disp');
		$this->db->from(NEWSCOMMENT);
		$this->db->join(USER, USER.'.id ='.NEWSCOMMENT.'.comment_user_id');	
		$this->db->where('comment_owner_id',$this->session->userdata('shopsy_session_user_id'));
			
		if($status != ''){
		$this->db->where('comment_status',$status);
		}
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$countall = $query->result_array(); 
		
			//print_r($countall); die;
		return $countall;
	
		
		}
       /* get all Posts  */
    function get_post_comments($searchPerPage='',$paginationNo='',$postId='')
    {	
		
   		$this->db->select(NEWSCOMMENT.'.*,'.USER.'.user_name,email,group,thumbnail,city,country,about_us');
		$this->db->from(NEWSCOMMENT);
		$this->db->join(NEWS, NEWSCOMMENT.'.comment_post_id ='.NEWS.'.post_id');
		$this->db->join(USER, USER.'.id ='.NEWSCOMMENT.'.comment_user_id');
		$this->db->where(NEWSCOMMENT.'.comment_post_id',$postId);
		$this->db->where(NEWSCOMMENT.'.comment_status','active');
		$this->db->order_by(NEWSCOMMENT.".comment_date", "desc"); 
			if($searchPerPage !='')
			{
				$this->db->limit($searchPerPage,$paginationNo);
			}	

		$query = $this->db->get();
		$resultContent = $query->result_array();
		//echo $this->db->last_query(); die;
		return $resultContent;
    }
	       /* get all Posts  */
    function get_all_posts_common($searchPerPage='',$paginationNo='',$getMonthType='')
    {	
		if($getMonthType !=''){
			$this->db->where(NEWS.'.posted_month_year',$getMonthType);			
		}
   		$this->db->select(NEWS.'.*,'.USER.'.user_name,email,group,thumbnail,city,country,about_us');
		$this->db->from(NEWS);
		$this->db->join(USER, USER.'.id ='.NEWS.'.posted_user_id');
		$this->db->where('post_status !=','draft');
		$this->db->where('post_id !=','0');
		$this->db->order_by(NEWS.".posted_date", "desc"); 
			if($searchPerPage !='')
			{
				$this->db->limit($searchPerPage,$paginationNo);
			}	

		$query = $this->db->get();
		$resultContent = $query->result_array();
		//echo $this->db->last_query(); die;
		return $resultContent;
    }

	       /* get all Posts  */
    function get_post_common_view($searchPerPage='',$paginationNo='',$getMonthType='')
    {	
		if($getMonthType !=''){
			$this->db->where(NEWS.'.posted_month_year',$getMonthType);			
		}
   		$this->db->select(NEWS.'.*,'.USER.'.user_name,email,group,thumbnail,city,country,about_us');
		$this->db->from(NEWS);
		$this->db->join(USER, USER.'.id ='.NEWS.'.posted_user_id');
		$this->db->where(NEWS.'.post_status !=','draft');
		$this->db->where(NEWS.'.posted_user_id !=',0);
		$this->db->where(NEWS.".post_status", "active"); 
		$this->db->order_by(NEWS.".posted_date", "desc"); 
		
			if($searchPerPage !='')
			{
				$this->db->limit($searchPerPage,$paginationNo);
			}	

		$query = $this->db->get();
		$resultContent = $query->result_array();
		//echo $this->db->last_query(); die;
		return $resultContent;
    }

        /* get all Particular Posts  Param Int Id*/
    function get_blog_type($id='')
    {
		
   		$this->db->select(USER.'.blog_template');
		$this->db->from(USER);
		$this->db->where('status','Active');
		$this->db->where('is_verified','Yes');
		$this->db->where('id',$id);
		$query = $this->db->get();
		$resultContent = $query->result_array();
		//echo $this->db->last_query(); die;
		return $resultContent;
	}
	/* to get seller details Param Int SellerId */
	public function getSellerDetails($id=''){
		if($id !=''){
	        	$this->db->where('seller_id',$id);	
		}
   		$this->db->select(SELLER.'.*');
		$this->db->from(SELLER);
		$query = $this->db->get();
		$resultContent = $query->result_array();
		
		return $resultContent;
		
	}   
	public function getcaptemail($id)
	{
		$select_qry = "select t.*, u.email from shopsy_community_teams t LEFT JOIN ".USERS." u on t.teamCaptainId=u.id where t.id =".$id;
		$userdet = $this->ExecuteQuery($select_qry);
		#echo "<pre>";print_r($userdet->result());die;
		return $userdet->result();
		
	}
	
}