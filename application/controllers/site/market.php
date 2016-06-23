<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * User related functions
 * @author Teamtweaks
 *
 */

class Market extends MY_Controller {
	function __construct(){
        parent::__construct();
		//error_reporting(-1);
		$this->load->helper(array('cookie','date','form','email','text'));
		$this->load->library(array('encrypt','form_validation'));		
		$this->load->model(array('product_model','user_model','seller_model'));
		
		$this->data['loginCheck'] = $this->checkLogin('U');
		$this->data['likedProducts'] = array();	 	
    }
	
	/** 
	 * 
	 * Displaying the related items
	 *
	 */
	public function index(){
		$this->data['searchTag'] =$searchTag=$this->uri->segment(2);
		#view_product_details
		$condition = " where p.status='Publish' and p.tag LIKE '%".$searchTag."%' and u.group='Seller' and u.status='Active' or p.status='Publish' and p.user_id=0 group by p.id order by p.created desc";
		$this->data['popularItems']=$popularItems= $this->product_model->view_product_details($condition)->result_array();
		#echo "<pre>"; print_r($popularItems); die;
		$this->load->view('site/market/relateditems',$this->data);
    }
   
	/** 
	 * 
	 * Insert the spam report for shop owner
	 *
	 */
	public function spam_report(){
		if($this->checkLogin('U') != ''){
			$p_id=$this->input->post('p_id');
			$s_id=$this->input->post('s_id');
			$spam_title=$this->input->post('spam_title'); 
			$complaint=$this->input->post('complaint');	
			$datestring = "%Y-%m-%d %H:%i:%s";
			$time = time(); 
			$createdTime = mdate($datestring,$time);
				$datArr=array('product_id' => $p_id,'user_id' => $this->checkLogin('U'),'spam_title'=> $spam_title,'complaint' => $complaint,'complaint_date'=>$createdTime);
			$activity="report-item";
			$activity_id=$p_id;
			if($s_id!=""){
				$datArr=array('seller_id' => $s_id,'user_id' => $this->checkLogin('U'),'spam_title'=> $spam_title,'complaint' => $complaint,'complaint_date'=>$createdTime);
				$activity="report-shop";
				$activity_id=$s_id;
			}
			
			$this->product_model->simple_insert(SPAM_REPORT,$datArr);
			
			$lastIid=$this->db->insert_id(); 
			$actArr = array('activity'=>$activity,
									'activity_id'=>$activity_id,
									'user_id'	=>$this->checkLogin('U'),
									'activity_ip'=>$this->input->ip_address(),
									'created'=>date("Y-m-d H:i:s"),
									'comment_id'=>$lastIid);
			$this->user_model->simple_insert(NOTIFICATIONS,$actArr);
			
			
			$this->setErrorMessage('success','Thank You! Your Spam Report Sent Successfully.');  //echo $this->input->post('s_seourl'); die;
			if($this->input->post('p_seourl')!=''){
				redirect('products/'.$this->input->post('p_seourl'));
			}   else if($this->input->post('s_seourl')!='')
			$this->setErrorMessage('success','Thank You! Your Spam Report Sent Successfully.');
			redirect('shop-section/'.$this->input->post('s_seourl'));
		} else {
		   $this->setErrorMessage('error','You Must Login First');
		   redirect('');
		}
	}
	/** 
	 * 
	 * This function loads the Registry view file
	 *
	 */
	public function loadRegistry(){
			if($this->checkLogin('U') != ''){
			$checkRigis=$this->product_model->get_all_details(REGISTRY,array('user_id' => $this->checkLogin('U')));
				if($checkRigis->num_rows() != 0){
				$this->data['registryMainList']=$this->product_model->get_all_details(CATEGORY,array('rootID' => '62'));
				$this->data['registryVals']=$checkRigis->row();
				
				 $Sql="select shopsy_registry_listings.id as lid,shopsy_category.id as cid,shopsy_registry_listings.*, shopsy_product.* from shopsy_registry_listings left join shopsy_product on shopsy_product.id=shopsy_registry_listings.listing_id left join shopsy_category on shopsy_category.id in(select category_id from shopsy_product where shopsy_product.id=shopsy_registry_listings.listing_id) where shopsy_registry_listings.collection_id='".$this->checkLogin('U')."'"; 
 				$this->data['resultrc']=$this->category_model->ExecuteQuery($Sql);		
				$condition="where reg.collection_id ='".$this->checkLogin('U')."' and p.status='Publish' and (a.pricing IS NOT NULL or p.price IS NOT NULL) group by p.id order by p.created desc";
				$this->data['registryProductList']=$this->product_model->view_registry_product_details($condition);
				$this->data['heading'] =$this->config->item('email_title').' - Registry';
		        $this->data['meta_title'] =$this->config->item('email_title').' - Registry';
				$this->load->view('site/registry/registry_manage',$this->data);
				} else {
			    $this->data['registryBannerList']=$this->product_model->get_all_details(SELLER,array('seller_banner !=' => ''));
				$this->data['heading'] =$this->config->item('email_title').' - Registry';
		        $this->data['meta_title'] =$this->config->item('email_title').' - Registry';
			    $this->load->view('site/registry/registry_index',$this->data); 
				} 
		   } else {
			   
			  $this->data['heading'] =$this->config->item('email_title').' - Registry';
		      $this->data['meta_title'] =$this->config->item('email_title').' - Registry';
			  $this->data['registryBannerList']=$this->product_model->get_all_details(SELLER,array('seller_banner !=' => ''));
			  $this->load->view('site/registry/registry_index',$this->data); 
		  }
	}
	
	
	/** 
	 * 
	 * This function inserts the Registry view file
	 *
	 */
	public function insertRegistry(){
			if($this->checkLogin('U') != ''){ 
			 if($this->input->post('registryDate') == ''){
				  $wedding_date=date('Y-m-d',time());
				  } else { $wedding_date=$this->input->post('registryDate'); }
			$this->product_model->simple_insert(REGISTRY,array('wedding_date' => $wedding_date,'user_id' => $this->checkLogin('U')));
			$wedding_reg=addslashes(artfill_lg('lg_wedding_reg','Your Wedding Registry Added Successfully'));
			$this->setErrorMessage('success',$wedding_reg);
			redirect('registry');
		  } else {
		  $this->setErrorMessage('error','You Must Login First');
		  redirect('');
		  }
	}
	
	
	/** 
	 * 
	 * This function updates the Registry date
	 *
	 */
	
	public function updateRegistry(){
		  if($this->checkLogin('U') != ''){    
			$this->product_model->update_details(REGISTRY,array('wedding_date' => $this->input->post('registryDate')),array('user_id' => $this->checkLogin('U')));
				$wedding_reg_updated=addslashes(artfill_lg('lg_wedding_reg','Your Wedding Registry updated Successfully'));
			$this->setErrorMessage('success',$wedding_reg_updated);
			redirect('registry');
		  }  else {
		  $this->setErrorMessage('error','You Must Login First');
		  redirect('');
		  }
	}
	
	
	/** 
	 * 
	 * This function deletes the Registry details
	 *
	 */
	
	public function deleteRegistry(){
		  if($this->checkLogin('U') != ''){ 
			$this->product_model->commonDelete(REGISTRY,array('user_id' => $this->checkLogin('U')));
			$this->product_model->commonDelete(REGISTRY_LISTINGS,array('collection_id'=>$this->checkLogin('U')));
			redirect('registry');
			$wedding_reg_deleted=addslashes(artfill_lg('lg_wedding_reg','Your Wedding Registry Deleted Successfully'));
			$this->setErrorMessage('success',$wedding_reg_deleted);
		  }  else {
		  $this->setErrorMessage('error','You Must Login First');
		  redirect('');
		  }
	}
	
	/** 
	 * 
	 * This function deletes the Registry Listing details
	 * param int $listingid
	 *
	 */
	public function deleteRegistryListing($listingid){
		  if($this->checkLogin('U') != '')
		  { 
			$listingid=$this->input->get("listingid");
			$this->product_model->commonDelete(REGISTRY_LISTINGS,array('collection_id'=>$this->checkLogin('U'),'listing_id'=>$listingid));
			$this->product_model->commonDelete(REGISTRY_REQUEST,array('collection_id'=>$this->checkLogin('U'),'listing_id'=>$listingid));
		
			echo "Success";
		   }
		   else {
		   $this->setErrorMessage('error','You Must Login First');
		   redirect('');
		  }
	}
	
	/** 
	 * 
	 * This function insert the Registry Listing details
	 *
	 */
	public function insertRegistryListing(){
	$listingid=$this->input->get("listingid");
	$count=$this->input->get("count");
			if($this->checkLogin('U') != ''){ 
		       $result=$this->product_model->get_all_details(REGISTRY_LISTINGS,array('listing_id' =>$listingid,"collection_id"=>$this->checkLogin('U')));
//		    $Sql="select * from ".REGISTRY_LISTINGS." where listing_id='".$listingid."' and collection_id='".$this->checkLogin('U')."'";
	//		$result=$this->category_model->ExecuteQuery($Sql);			
			$count1=$result->num_rows();
			
            if($count==$count1)
			echo "no";
			else if($count<$count1)
			{
			   $this->db->where(array('collection_id'=>$this->checkLogin('U'),'listing_id' =>$listingid));
			   $this->db->limit($count1-$count);
			   $this->db->delete(REGISTRY_LISTINGS);
			   $result=$this->product_model->get_all_details(REGISTRY_LISTINGS,array('listing_id' =>$listingid,"collection_id"=>$this->checkLogin('U')));
			   $count2=$result->num_rows();
			   $dataArr1 = array('requested'=>$count2);
			   $condition1 = array('collection_id' =>$this->checkLogin('U'), 'listing_id'=> $listingid);
				$this->user_model->update_details(REGISTRY_REQUEST,$dataArr1,$condition1);			
			echo "affected";		
			}
			else 
			{
			  for($d=$count1;$d<$count;$d++)
			  {
			  
			   	$this->product_model->simple_insert(REGISTRY_LISTINGS,array('listing_id' => $listingid,'collection_id' => $this->checkLogin('U')));
				
				$registryProduct1 = $this->user_model->get_all_details(REGISTRY_REQUEST,array('collection_id'=>$this->checkLogin('U'),'listing_id'=>$listingid));
				if($registryProduct1->num_rows()>0)
				{    $newCnt = $registryProduct1->row()->requested + 1;
				   	$dataArr1 = array('requested'=>$newCnt);
					$condition1 = array('collection_id' =>$this->checkLogin('U'), 'listing_id'=> $listingid);
					$this->user_model->update_details(REGISTRY_REQUEST,$dataArr1,$condition1);			
				}
				else
				{
				   $this->product_model->simple_insert(REGISTRY_REQUEST,array('listing_id' => $listingid,'collection_id' => $this->checkLogin('U')));
			    }
				
				 
			  }
			  echo "success";
			}
			
			
		
			$this->setErrorMessage('success','Your  Registry  Listings updated Successfully');
			
		  } else {
		  $this->setErrorMessage('error','You Must Login First');
		  redirect('');
		  }
	}
	
	
	/** 
	 * 
	 * This function displaying the notification list details
	 *
	 */
	public function display_notifications_list(){
		if($this->checkLogin('U') != ''){		
			$perPage=100;
			$checkNotifications=$this->user_model->get_notification_list($this->checkLogin('U'),$this->data["ownProductList"],$this->data["ownOrderList"],$this->data["participatedOrdersList"],0,$perPage);
			
			$notificationList=array();
			if($checkNotifications->num_rows()>0){
				foreach($checkNotifications->result() as $notification){
					$type=$notification->activity;
					$actId=$notification->id;
					$activity_id=$notification->activity_id;
					$user_id=$notification->user_id;
					$nText="";
					switch($type){
						case "follow":
							$notificationArr=$this->user_model->get_activity_follow($user_id);
							if($this->lang->line('foll_you') != '') { $nText= stripslashes($this->lang->line('foll_you')); } else $nText= "following you.";
						break;
						case "Make offer":
							$notificationArr=$this->user_model->get_activity_favorite_item($actId);
							
							if($this->lang->line('make_offer') != '') { $nText= stripslashes($this->lang->line('make_offer')); } else $nText= "Makes an Offer in your shop.";
						break;
						case "Edit offer":
							$notificationArr=$this->user_model->get_activity_favorite_item($actId);
							
							if($this->lang->line('make_offer') != '') { $nText= stripslashes($this->lang->line('make_offer')); } else $nText= "Edit an Offer.";
						break;
						case "Decline offer":
							$notificationArr=$this->user_model->get_activity_offer_item($actId,$this->checkLogin('U'));
							
							if($this->lang->line('make_offer') != '') { $nText= stripslashes($this->lang->line('make_offer')); } else $nText= " has declined your offer.";
						break;
						case "Accept offer":
							$notificationArr=$this->user_model->get_activity_offer_item($actId,$this->checkLogin('U'));
							
							if($this->lang->line('make_offer') != '') { $nText= stripslashes($this->lang->line('make_offer')); } else $nText= " has accepted your Offer.";
						break;
						case "Reject offer":
							$notificationArr=$this->user_model->get_activity_offer_item($actId,$this->checkLogin('U'));
							
							if($this->lang->line('make_offer') != '') { $nText= stripslashes($this->lang->line('make_offer')); } else $nText= "has reject your offer.";
						break;						
						case "favorite item":
							$notificationArr=$this->user_model->get_activity_favorite_item($actId);
							if($this->lang->line('fav_your_item') != '') { $nText= stripslashes($this->lang->line('fav_your_item')).$notificationArr->product_name; } else $nText= "favorited your item '".$notificationArr->product_name."'.";
							//$nText="favorited your item '".$notificationArr->product_name."'.";
						break;
						case "favorite shop":
							$notificationArr=$this->user_model->get_activity_favorite_shop($actId);
							if($this->lang->line('fav_your_shop') != '') { $nText= stripslashes($this->lang->line('fav_your_shop')); } else $nText= "favorited your shop.";
							//$nText="favorited your shop.";
						break;
						case "question":
							$notificationArr=$this->user_model->get_activity_message($actId);
							if($this->lang->line('ask_question_item') != '') { $nText= stripslashes($this->lang->line('ask_question_item')).$notificationArr->product_name; } else $nText="ask a question about your item '".$notificationArr->product_name."'.";
							
							//$nText="ask a question about your item '".$notificationArr->product_name."'.";
						break;
						case "message":
							$notificationArr=$this->user_model->get_activity_message($actId);
							if($this->lang->line('left_msg') != '') { $nText= stripslashes($this->lang->line('left_msg')); } else $nText= "left a message.";
							//$nText="left a message.";
						break;
						case "discussion":
							$notificationArr=$this->user_model->get_activity_discussion($actId);
							if($this->lang->line('post_comment') != '') { $nText= stripslashes($this->lang->line('post_comment')).$activity_id; } else $nText="has post a comment on this order : #".$activity_id;
							//$nText="has post a comment on this order : #".$activity_id;
						break;
						case "order":
							$notificationArr=$this->user_model->get_activity_order($actId);
							if($this->lang->line('make_order') != '') { $nText= stripslashes($this->lang->line('make_order')); } else $nText= "made an order from your shop.";
						break;
							//$nText="make an order in your shop.";
						break;
						case "review":
							$notificationArr=$this->user_model->get_activity_review($actId);
							if($this->lang->line('review_ur_item') != '') { $nText= stripslashes($this->lang->line('review_ur_item')).$notificationArr->product_name; } else $nText="has wrote a review about your item '".$notificationArr->product_name."'.";
							//$nText="has wrote a review about your item '".$notificationArr->product_name."'.";
						break;
						case "review-update":
							$notificationArr=$this->user_model->get_activity_review($actId);
							if($this->lang->line('update_review_ur_item') != '') { $nText= stripslashes($this->lang->line('update_review_ur_item')).$notificationArr->product_name; } else $nText="has updated his review about your item '".$notificationArr->product_name."'.";
							//$nText="has updated his review about your item '".$notificationArr->product_name."'.";
						break;
						case "own-order-discussion":
							$notificationArr=$this->user_model->get_activity_discussion($actId);
							if($this->lang->line('cmt_order') != '') { $nText= stripslashes($this->lang->line('cmt_order')).$activity_id; } else $nText="has post a comment on this order : #".$activity_id;
							//$nText="has post a comment on this order : #".$activity_id;
						break;
					}
					
					$userName="";
					$userImage="";
					$productId="";
					$productName="";
					$productUrl="";
					$productImage="";
					$message="";
					$rating="";
					$comment_id="";
					
					if($notificationArr->thumbnail!=""){
						$userImage="images/users/thumb/".$notificationArr->thumbnail;
					}else{
						$userImage="images/default_avat.png";
					}
					if($notificationArr->user_name!=""){
						$userName=$notificationArr->user_name;
					}
					if($notificationArr->product_id!=""){
						$productId=$notificationArr->product_id;
					}
					if($notificationArr->product_name!=""){
						$productName=$notificationArr->product_name;
					}
					if($notificationArr->productUrl!=""){
						$productUrl=$notificationArr->productUrl;
					}
					if($notificationArr->image!=""){
						$img=@explode(',',$notificationArr->image);
						$productImage="images/product/list-image/".$img[0];
					}
					if($notificationArr->message!=""){
						$message=$notificationArr->message;
					}
					if($notificationArr->rating!=""){
						$rating=$notificationArr->rating;
					}
					if($notification->comment_id>0){
						$comment_id=$notification->comment_id;
					}
					
					$noteTIme=date("Y-m-d",strtotime($notification->created));
					
					
					$notificationList[]=array("type"=>(string)$type,
															"textDis"=>(string)$nText,
															"userId"=>(string)$user_id,
															"userName"=>(string)$userName,
															"userImage"=>(string)$userImage,
															"productId"=>(string)$productId,
															"productName"=>(string)$productName,
															"productUrl"=>(string)$productUrl,
															"productImage"=>(string)$productImage,
															"message"=>(string)$message,
															"rating"=>(string)$rating,
															"comment_id"=>(string)$comment_id,
															"activity_id"=>(string)$activity_id,
															"notifyTime"=>(string)$noteTIme
															); 
					$this->user_model->update_details(NOTIFICATIONS,array('view_mode'=>'No'),array('id'=>$actId));
														
				}
				
				//echo $this->db->last_query();
			}
			$this->data["notificationList"]=$notificationList;
			$this->load->view('site/notification/display_notification',$this->data);
		}else {
		   $this->setErrorMessage('error','You Must Login First');
		   redirect('login');
		}
	}
	
	/** 
	 * 
	 * Loads the list of activity
	 */
	public function activityList($userName=""){
		$totalActivity=0;
		$activityArr=array();			
		$pagePos ='';
		$takeCol="`id`,`followers_count`,`followers`,`following`,`following_count`";
		$userDetails = $this->mobile_model->get_column_details(USERS,array( 'user_name' => $userName),$takeCol);
		if($userDetails->num_rows()>0){
			$commonId=$userDetails->row()->id;	
			$followingIds=trim($userDetails->row()->following,',');
			$followersIds=trim($userDetails->row()->followers,',');
			$ownProductList = $this->mobile_model->getuserProductsList($commonId);
			$ownPrds=array();
			foreach($ownProductList->result() as $oPrd){
				$ownPrds[]=$oPrd->seller_product_id;
			}
			$ownPrdsList=@implode($ownPrds,',');
			$userParticipatedIds = $this->mobile_model->get_my_notification_list($commonId,$ownPrdsList)->row()->ids;
			$userParticipatedArr=@explode(',',$userParticipatedIds);
			$totalNotificationList = $this->mobile_model->get_all_notification_list($commonId,$followersIds,$followingIds,$ownPrdsList,$userParticipatedIds);
			$totalActivity= $totalNotificationList->num_rows();		
			
			$perpage=10;
			$page=intval($_GET['pageId']);
			if($page>0){
				$indexval=($page*$perpage)-$perpage;	
			}else{
				$page++;
				$indexval=0;
			}
		
			$notificationList=$this->mobile_model->get_notification_list($commonId,$followersIds,$followingIds,$ownPrdsList,$userParticipatedIds,$indexval,$perpage);
			$currentActivity= $notificationList->num_rows();		
			if($currentActivity>0){
				foreach($notificationList->result() as $notifications){				
					$activityType=$notifications->activity;
					$text="";
					switch($activityType){
						case 'follow':
							$activityVal=$this->mobile_model->get_activity_follow($notifications->user_id);								
						break;
						case 'like':
							$activityVal=$this->mobile_model->get_activity_like($notifications->id);
						break;
						case 'comment':
							$activityVal=$this->mobile_model->get_activity_comment($notifications->id);
						break;
						case 'feedback':
							$activityVal=$this->mobile_model->get_activity_feedback($notifications->id);
						break;
					}
					
					$userName=$activityVal->user_name;
					if($activityVal->thumbnail!=''){
						$userImage = $activityVal->thumbnail;
					}else{
						$userImage = 'no-image.png';
					}
					
					$activityImage="";
					if($activityVal->image){
						$img=explode(',',$activityVal->image);		
						$activityImage=base_url().'images/product/thumb_mobile/'.$img[0];
					}
					$noteId=$notifications->activity_id;
					$userId=$notifications->user_id;
					$relativeTime=$this->mobile_model->getrelativeTimes(strtotime($notifications->created));;
					$activityLink=$activityVal->product_id;
					
					switch($activityType){
						case 'follow':
							$type="follow";			
							$text="started following you.";							
						break;
						case 'like':
							$type="like";								
							if(in_array($noteId,$userParticipatedArr)){
								$text="also liked this item.";	
							}else{
								$text="liked your item.";
							}
						break;
						case 'comment':
							$type="comment";															
							if(in_array($noteId,$userParticipatedArr)){
								$text="also left a comment on the item:".$activityVal->commentMsg;
							}else{
								$text="left a comment on the item:".$activityVal->commentMsg;
							}
						break;
						case 'feedback':
							$type="feedback";
							if(in_array($noteId,$userParticipatedArr)){
								$text="also left ".$activityVal->feedType." feedback for ".$activityVal->feedUser;
							}else{
								$text="left you ".$activityVal->feedType." feedback";
							}
						break;
					}
					
					$activityArr[]=array("type"=>(string)$type,
													"userImage"=>(string)base_url().'images/users/thumb_mobile/'.$userImage,
													"userName"=>(string)$userName,
													"userId"=>(string)$userId,
													"text"=>(string)$text,
													"time"=>(string)$relativeTime,
													"activityImage"=>(string)$activityImage,
													"activityLink"=>(string)$activityLink,
													);
				}
			}
			if($currentActivity>0){
				$pagePos = $page+1;
			}else{
				$pagePos ='';
			}
		
			$json_encode = json_encode(array("status"=>(string)1,"totalActivity"=>(string)$totalActivity,"pagePos"=>(string)$pagePos,"activity"=>$activityArr));
		}else{
			$json_encode = json_encode(array("status"=>(string)0,"totalActivity"=>(string)$totalActivity,"pagePos"=>(string)$pagePos,"activity"=>$activityArr));	
		}
		echo $json_encode;
	}
		public function submitfeedBackform()
	{		 
	
		/* $uid = $userDetails['shopsy_session_user_id'];
		$email = $userDetails['shopsy_session_user_email'];
		$name = $userDetails['shopsy_session_full_name']; */
		
		/* $randStr = $this->get_rand_str('10');
		$condition = array('id'=>$uid);
		$dataArr = array('verify_code'=>$randStr);
		$this->user_model->update_details(USERS,$dataArr,$condition); */
		
		
		
		if($this->input->post('user_name') !='' && $this->input->post('msg_subject') !='' && $this->input->post('user_email') !='' && $this->input->post('msg_content')!=''){
		$newsid='26';
		$template_values=$this->user_model->get_newsletter_template_details($newsid);
		
		$cfmurl = base_url().'admin/shop/display_shop';
		$subject = 'From: '.$this->config->item('email_title').' - '.$template_values['news_subject'];
		$adminnewstemplateArr=array('email_title'=> 'Comments','logo'=> $this->data['logo'],'$name'=>$this->input->post('user_name'),'footer_content'=> $this->config->item('footer_content'),'email'=>$this->input->post('user_email'),'subject'=>$this->input->post('msg_subject'),'question'=>$this->input->post('msg_content'));
		extract($adminnewstemplateArr);
		//$ddd =htmlentities($template_values['news_descrip'],null,'UTF-8');
		$header .="Content-Type: text/plain; charset=ISO-8859-1\r\n";
		
		$message .= '<!DOCTYPE HTML>
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width"/><body>';
		include('./newsletter/registeration'.$newsid.'.php');	
		
		$message .= '</body>
			</html>';
		
		/* if($template_values['sender_name']=='' && $template_values['sender_email']==''){
			$sender_email=$this->data['siteContactMail'];
			$sender_name=$this->data['siteTitle'];
		}else{
			$sender_name=$template_values['sender_name'];
			$sender_email=$template_values['sender_email'];
		} */

		$email_values = array('mail_type'=>'html',
							'from_mail_id'=>$this->input->post('user_email'),
							'mail_name'=>$this->input->post('user_name'),
							'to_mail_id'=>$this->config->item('email'),
							'subject_message'=>$template_values['news_subject'],
							'body_messages'=>$message
							);
		#echo "<pre>"; print_r($email_values);				die;
		$email_send_to_common = $this->user_model->common_email_send($email_values);
		$this->setErrorMessage('success','Email Sent Successfully');
		redirect('pages/contact-us');
		}else{
		$email = $this->input->post('user_email');
		if($this->input->post('user_name') ==''){
			$this->setErrorMessage('error','User Name Required');
		}else if($this->input->post('user_email') ==''){
			$this->setErrorMessage('error','User Email Required');
		}else if (valid_email($email)){
			$this->setErrorMessage('error','Invalide Email Id');
		}else if($this->input->post('msg_subject') ==''){
			$this->setErrorMessage('error','Subject Required');
		}else if($this->input->post('msg_content') ==''){
			$this->setErrorMessage('error','Comments Required');
		}	
		redirect('pages/contact-us');
		}
		
	}
	
}
/*End of file market.php */
/* Location: ./application/controllers/site/market.php */