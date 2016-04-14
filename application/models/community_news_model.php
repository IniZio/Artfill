<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Community_news_model extends My_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
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
		}else if($_SESSION['sellerId']!=''){
			$this->db->where(NEWSCOMMENT.'.comment_owner_id',$_SESSION['sellerId']);	
		}else{
			$this->db->where(NEWSCOMMENT.'.comment_status','active');	
			}
   		$this->db->select(NEWSCOMMENT.'.*,'.USER.'.user_name,email,group,'.NEWS.'.posted_user_id');
		$this->db->from(NEWSCOMMENT);
		$this->db->join(USER, USER.'.id ='.NEWSCOMMENT.'.comment_user_id');
		$this->db->join(NEWS, NEWS.'.post_id ='.NEWSCOMMENT.'.comment_post_id');
		
		//$this->db->order_by('comment_status','active');
		
		$query = $this->db->get();
		$resultContent = $query->result_array();
		//echo $this->db->last_query(); die;
		return $resultContent;
    }

      /* get all Posts  */
    function get_all_posts_withoutlogin($searchPerPage = '',$paginationNo = '',$getMonthType = '',$type = 'common')
    {	
		if($getMonthType !=''){
			$this->db->where(NEWS.'.posted_month_year',$getMonthType);			
		}
/*		if($type != 'common'){
				$this->db->where('posted_user_id',$this->session->userdata('shopsy_session_user_id'));	
		}
*/	
		if($_SESSION['sellerId'] !=''){
			$this->db->where('post_status','active');	
			$this->db->where('posted_user_id',$_SESSION['sellerId']);	
		}else{
		$this->db->where(NEWS.'.posted_user_id',$this->session->userdata('shopsy_session_user_id'));	
		}
   		$this->db->select(NEWS.'.*,'.USER.'.user_name,email,group,thumbnail,city,country,about_us');
		$this->db->from(NEWS);
		$this->db->join(USER, USER.'.id ='.NEWS.'.posted_user_id');
		$this->db->where('post_status !=','draft');
		
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
		if($_SESSION['sellerId'] !=''){
			$this->db->where('post_status','active');	
			$this->db->where('posted_user_id',$_SESSION['sellerId']);	
		}else{
			$this->db->where(NEWS.'.posted_user_id',$this->session->userdata('shopsy_session_user_id'));
		}
   		$this->db->select(NEWS.'.*,'.USER.'.user_name,email,group,thumbnail,city,country,about_us');
		$this->db->from(NEWS);
		$this->db->join(USER, USER.'.id ='.NEWS.'.posted_user_id');
		$this->db->where('post_status !=','draft');
		
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
        /* get all Particular Posts  */
    function get_single_posts($post_id='')
    {
		//$_SESSION['userId'] = '42';
   		$this->db->select(NEWS.'.*,'.USER.'.user_name,full_name,email,group,thumbnail,city,country,about_us,'.SELLER.'.seller_businessname,seller_id');
		$this->db->from(NEWS);
		$this->db->join(USER, USER.'.id ='.NEWS.'.posted_user_id');
		$this->db->join(SELLER, USER.'.id ='.SELLER.'.seller_id');
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
   		$this->db->select(NEWS.'.*,'.USER.'.user_name,full_name,email,group');
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
   		$this->db->select(NEWS.'.*,'.USER.'.user_name,full_name,email,group');
		$this->db->from(NEWS);
		$this->db->join(USER, USER.'.id ='.NEWS.'.posted_user_id');
		$this->db->where('posted_user_id',$this->session->userdata('shopsy_session_user_id'));
		$this->db->where('post_status','active');
		$query = $this->db->get();
		$resultContent = $query->result_array();
		
		return $resultContent;
    }
	/* to u[date blog setup */
	function updateBlogSetup(){
		$id = $this->session->userdata('shopsy_session_user_id') ;
		$_SESSION['blogTemp'] = $_POST['tempType'];
		$data = array('blog_template' => $_POST['tempType']);
		$this->db->where('id', $id);
		$this->db->update(USER, $data); 

		$data = array('blog_template' => $_POST['tempType']);
		$this->db->where('seller_id', $id);
		$this->db->update(SELLER, $data); 

        // echo $this->db->last_query(); die;
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
		
   		$this->db->select(NEWSCOMMENT.'.*,'.USER.'.user_name,full_name,email,group,thumbnail,city,country,about_us');
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
   		$this->db->select(NEWS.'.*,'.USER.'.user_name,full_name,email,group,thumbnail,city,country,about_us');
		$this->db->from(NEWS);
		$this->db->join(USER, USER.'.id ='.NEWS.'.posted_user_id');
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
   		$this->db->select(NEWS.'.*,'.USER.'.user_name,full_name,email,group,thumbnail,city,country,about_us');
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

        /* get all Particular Posts  */
    function get_blog_type($id='')
    {
   		$this->db->select(USER.'.blog_template');
		$this->db->from(USER);
		$this->db->where('status','Active');
		//$this->db->where('is_verified','Yes');
		$this->db->where('id',$id);
		$query = $this->db->get();
		$resultContent = $query->result_array();
		//echo $this->db->last_query(); die;
		return $resultContent;
	}
	
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

	       /* get  Posts Comments  */
    function get_posts_comments($post_id='')
    {	
   		//$this->db->select(NEWSCOMMENTS.'.*,'.POST.'.user_name,full_name,email,group,thumbnail,city,country,about_us');
		$this->db->select(NEWSCOMMENT.'.*,'.NEWS.'.post_title');
		$this->db->from(NEWSCOMMENT);
		$this->db->join(NEWS, NEWS.'.post_id ='.NEWSCOMMENT.'.comment_post_id');
		//$this->db->join(NEWSCOMMENT, NEWSCOMMENT.'.comment_post_id ='.NEWS.'.post_id');
		//$this->db->where('post_status !=','draft');
		$this->db->where(NEWSCOMMENT.'.comment_post_id ',$post_id);
		$this->db->order_by(NEWSCOMMENT.".comment_date", "desc"); 

		$query = $this->db->get();
		$resultContent = $query->result_array();
		//echo $this->db->last_query(); die;
		return $resultContent;
    }
						 /* get all Cooments Count */
    function get_allcomment_counts_dashboard($status)
    {	
		
		//echo $status; die;
		//$_SESSION['userId'] = '42';
		$this->db->select('count(comment_status) as disp');
		$this->db->from(NEWSCOMMENT);
		$this->db->join(USER, USER.'.id ='.NEWSCOMMENT.'.comment_user_id');	
			
		if($status != ''){
		$this->db->where('comment_status',$status);
		}
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$countall = $query->result_array(); 
		
			//print_r($countall); die;
		return $countall;
	
		
		}

}
 ?>
