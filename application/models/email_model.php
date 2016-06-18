<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * This model contains all db functions related to user management
 * @author Teamtweaks
 *
 */
class Email_model extends My_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	/*
    * 
    * Getting Mails
    * @param String $type 
	* @param Integer $userId 
	* @param Integer $userId 
    */
	public function get_conversation_details($userId='',$type='inbox'){
		$this->db->select('c.*,u1.user_name as sender_name,u1.email as sender_email,u1.thumbnail as senderthumbnail,s1.seller_businessname as sendershopname,s1.seourl as sendershopurl,u.user_name,u.email,u.full_name,u.thumbnail,s.seller_businessname as shopname,s.seourl as shopurl');
		$this->db->from(CONTACTPEOPLE.' as c');		
		if($type=='inbox'){
			$this->db->join(USERS.' as u' , 'c.receiver_id = u.id','left');
			$this->db->join(USERS.' as u1' , 'c.sender_id = u1.id','left');
			$this->db->join(SELLER.' as s' , 's.seller_id = u.id','left');
			$this->db->join(SELLER.' as s1' , 's1.seller_id = u1.id','left');
			$condition='c.receiver_id ='.$userId.' AND (c.receiver_status ="Read" OR c.receiver_status ="Unread")';
			$this->db->where($condition);	
		}else if($type=='sent'){
			$this->db->join(USERS.' as u1' , 'c.sender_id = u1.id','left');
			$this->db->join(USERS.' as u' , 'c.receiver_id = u.id','left');
			$this->db->join(SELLER.' as s' , 's.seller_id = u.id','left');
			$this->db->join(SELLER.' as s1' , 's1.seller_id = u.id','left');
			$condition='c.sender_id ='.$userId.' AND (c.sender_status ="Read" OR c.sender_status ="Unread")';
			$this->db->where($condition);	
		}else if($type=='all'){
			$this->db->join(USERS.' as u' , 'c.sender_id = u.id','left');
			$this->db->join(USERS.' as u1' , 'c.receiver_id = u1.id','left');
			$this->db->join(SELLER.' as s' , 's.seller_id = u.id','left');
			$this->db->join(SELLER.' as s1' , 's1.seller_id = u.id','left');
			$condition='(c.sender_id ='.$userId.' AND (c.sender_status ="Read" OR c.sender_status ="Unread")) OR (c.receiver_id ='.$userId.' AND (c.receiver_status ="Read" OR c.receiver_status ="Unread"))';
			$this->db->where($condition); 	
		}else if($type=='trash'){
			$this->db->join(USERS.' as u' , 'c.sender_id = u.id','left');
			$this->db->join(USERS.' as u1' , 'c.receiver_id = u1.id','left');
			$this->db->join(SELLER.' as s' , 's.seller_id = u.id','left');
			$this->db->join(SELLER.' as s1' , 's1.seller_id = u.id','left');
			$condition='(c.sender_id ='.$userId.' AND c.sender_status ="Trash") OR (c.receiver_id ='.$userId.' AND c.receiver_status ="Trash")';
			$this->db->where($condition); 	
		}
		$this->db->group_by('c.tid');
		$this->db->order_by('c.dataAdded','desc');
		$conversationlist= $this->db->get();
		#echo $this->db->last_query(); die;
		return $conversationlist;
	}
	/*
    * 
    * Getting Conversation
	* @param Integer $userId
    * @param String $type  
	* @param Integer $perPage
	* @param Integer $Page
    */
	public function get_conversation_details_page($userId='',$type='inbox',$perpage=10,$page=1){
		$this->db->select('c.*,u1.user_name as sender_name,u1.email as sender_email,u1.thumbnail as senderthumbnail,s1.seller_businessname as sendershopname,s1.seourl as sendershopurl,u.user_name,u.email,u.full_name,u.thumbnail,s.seller_businessname as shopname,s.seourl as shopurl');
		$this->db->from(CONTACTPEOPLE.' as c');		
		if($type=='inbox'){
			$this->db->join(USERS.' as u' , 'c.receiver_id = u.id');
			$this->db->join(USERS.' as u1' , 'c.sender_id = u1.id');
			$this->db->join(SELLER.' as s' , 's.seller_id = u.id','left');
			$this->db->join(SELLER.' as s1' , 's1.seller_id = u1.id','left');
			#$condition='c.receiver_id ='.$userId.' AND (c.receiver_status ="Read" OR c.receiver_status ="Unread") ';
			$condition='(c.sender_id ='.$userId.' AND (c.sender_status ="Read" OR c.sender_status ="Unread")) OR (c.receiver_id ='.$userId.' AND (c.receiver_status ="Read" OR c.receiver_status ="Unread"))';
			$this->db->where($condition);	
		}else if($type=='sent'){
			$this->db->join(USERS.' as u1' , 'c.sender_id = u1.id');
			$this->db->join(USERS.' as u' , 'c.receiver_id = u.id');
			$this->db->join(SELLER.' as s' , 's.seller_id = u.id','left');
			$this->db->join(SELLER.' as s1' , 's1.seller_id = u.id','left');
			$condition='c.sender_id ='.$userId.' AND (c.sender_status ="Read" OR c.sender_status ="Unread")';
			$this->db->where($condition);	
		}else if($type=='all'){
			$this->db->join(USERS.' as u' , 'c.sender_id = u.id');
			$this->db->join(USERS.' as u1' , 'c.receiver_id = u1.id');
			$this->db->join(SELLER.' as s' , 's.seller_id = u.id','left');
			$this->db->join(SELLER.' as s1' , 's1.seller_id = u.id','left');
			$condition='(c.sender_id ='.$userId.' AND (c.sender_status ="Read" OR c.sender_status ="Unread")) OR (c.receiver_id ='.$userId.' AND (c.receiver_status ="Read" OR c.receiver_status ="Unread"))';
			$this->db->where($condition); 	
		}else if($type=='trash'){
			$this->db->join(USERS.' as u' , 'c.sender_id = u.id');
			$this->db->join(USERS.' as u1' , 'c.receiver_id = u1.id');
			$this->db->join(SELLER.' as s' , 's.seller_id = u.id','left');
			$this->db->join(SELLER.' as s1' , 's1.seller_id = u.id','left');
			$condition='(c.sender_id ='.$userId.' AND c.sender_status ="Trash") OR (c.receiver_id ='.$userId.' AND c.receiver_status ="Trash")';
			$this->db->where($condition); 	
		}
		$this->db->order_by('c.dataAdded','desc');
		$this->db->limit($perpage,($page*$perpage)-$perpage);
		$conversationlist= $this->db->get();
		#echo $this->db->last_query(); die;
		return $conversationlist;
	}
	/*
    * 
    * Getting Message
	* @param Integer $msgId
    */
	public function get_message_details($msgId=''){
		$this->db->select('c.*,u1.user_name as sender_name,u1.email as sender_email,u1.thumbnail as senderthumbnail,u.user_name as receiver_name,u.email,u.full_name,u.thumbnail,s.seller_businessname as shopname,s.seourl as shopurl');
		$this->db->from(CONTACTPEOPLE.' as c');		
		$this->db->join(USERS.' as u' , 'c.receiver_id = u.id','left');
		$this->db->join(USERS.' as u1' , 'c.sender_id = u1.id','left');
		$this->db->join(SELLER.' as s' , 's.seller_id = u.id','left');
		$this->db->where('c.tid ='.$msgId);
		$this->db->where('c.receiver_id ='.$this->checkLogin('U'));
		

		#$this->db->where('(c.sender_id ='.$this->checkLogin('U').' OR c.receiver_id ='.$this->checkLogin('U').')');	
		
		$this->db->group_by("c.tid");
	#echo $this->db->last_query(); die;

		$messageDetails= $this->db->get();
		
		#print_r ($messageDetails->result()); die;
		return $messageDetails;
	}
	/*
    * 
    * Getting Email List
    */
	public function getEmailList(){
		$this->db->select('email');
		$this->db->from(USERS);
		$this->db->where('status','Active');
		$this->db->where('is_verified','Yes');
		$mailList= $this->db->get();
		return $mailList->result_array();
	}
	/*
    * 
    * Getting trash email
	* @param Integer $userId
	* @param Integer $tId
    * @param Integer $sender id  
    * @param Integer $receiver id  
    */
	public function get_my_trashes($user_id,$tid,$sender_id,$receiver_id){
		$this->db->select('sender_id,receiver_id');
		$this->db->from(CONTACTPEOPLE);
		if($user_id==$sender_id)
		$this->db->where('sender_status != "Trash" AND sender_id='.$user_id);
		if($user_id==$receiver_id)
		$this->db->where('receiver_status != "Trash" AND receiver_id='.$user_id);
		$this->db->where('tid',$tid);
		$mailList= $this->db->get();
		#echo $this->db->last_query(); die;
		return $mailList;
	}

}