<?php 
$this->load->view('site/templates/header');
$this->load->model('product_model');
$this->load->model('user_model');
?>
		<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>User-Profile-page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php }?>
<div class="add_steps shop-menu-list">
			<div class="main">		
				<?php $this->load->view('site/user/sidebar'); ?>
			</div>
		</div>
<div id="profile_div">
	<section class="container">
    	<div class="main">
        	<ul id="breadcrumbs" class="clear">
            	<li><a href="<?php echo base_url(); ?>"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo 'Home'; ?></a></a></li>
                <span>›</span>
                <li><a href="view-profile/<?php echo $this->session->userdata['shopsy_session_user_name']; ?>"><?php if($this->lang->line('user_profile') != '') { echo stripslashes($this->lang->line('user_profile')); } else echo 'Profile'; ?></a></li>
                <span>›</span>
                <li><a ><?php if($this->lang->line('conversation') != '') { echo stripslashes($this->lang->line('conversation')); } else echo 'Conversation'; ?></a></li>
            </ul>
			
            <div class="community_page">
			<div class="community_div">
                    <div class="community_right">
            <div class="convers">   
                <div class="conversation_container">
                    <?php /* <div class="conversation_container_left">
                        <div class="side_bar">
                            <ul>
                                <li <?php if($viewfolder=='inbox'){ echo 'class="active"'; }?> style="background-color:green;">
                                    <a href="people/<?php echo $this->session->userdata['shopsy_session_user_name'];?>/conversations"><i class="fa fa-comments" style="color: white;"></i>  <span style="color:white;">Conversation</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>     */ ?>
                    <div class="conversation_container_right" >     
                        <div>
                            <center><img id="MessageStatus" src="images/ajax-loader/ajax-loader(6).gif" alt="Loading" style="display:none;" /></center>
                        </div>  
                        <?php if ($conversations->num_rows() > 0){ ?> 
                        <ul class="message-box message-box-1">
           					<li style=" border-right: 1px solid #D9D9D9;">
                            	<input id="checkbox-id" type="checkbox" class="select-all-msg">
                            </li>  
                			<li style=" border-right: 1px solid #D9D9D9;">
                            	<a href="javascript:void(0);" onclick="javascript:markmessage('read');"><?php if($this->lang->line('mark_all_read') != '') { echo stripslashes($this->lang->line('mark_all_read')); } else echo 'Mark all Read'; ?></a>
                            </li>
                  			<li style=" border-right: 1px solid #D9D9D9;">
                            	<a href="javascript:void(0);" onclick="javascript:markmessage('unread');"><?php if($this->lang->line('mark_all_unread') != '') { echo stripslashes($this->lang->line('mark_all_unread')); } else echo 'Mark all Unread'; ?></a>
                            </li>
                       		<li class="lastli" >
								<a href="javascript:void(0);" onclick="javascript:confirmTrashMsg('<?php echo $this->session->userdata['shopsy_session_user_id'];?>','<?php echo $viewfolder; ?>','Trash');" ><?php if($this->lang->line('com_delete') != '') { echo stripslashes($this->lang->line('com_delete')); } else echo 'Delete'; ?></a>
                            </li>
           				</ul>

                         <?php 
						 $tmpArr=array();
						 #$tmpArr[]=$conversations->row()->tid;		
						 foreach ($conversations->result() as $row){
							if(!in_array($row->tid,$tmpArr)){
								$tmpArr[]=$row->tid;
								if($this->session->userdata['shopsy_session_user_id']==$row->receiver_id){
									$chkC=$this->user_model->chk_conersation($this->session->userdata['shopsy_session_user_id'],$row->tid,$row->sender_id);
								}else if($this->session->userdata['shopsy_session_user_id']==$row->sender_id){
									$chkC=$this->user_model->chk_conersation($this->session->userdata['shopsy_session_user_id'],$row->tid,$row->receiver_id);
								}
								$label='';
								if($this->session->userdata['shopsy_session_user_id']==$row->receiver_id){
									if($row->thumbnail!=''){ $profile_pic='users/thumb/'.$row->thumbnail; } else { $profile_pic='default_avat.png';}
									$shopname=$row->shopname;
									$shopurl=$row->shopurl;
									$username=$row->user_name;
									$status='receiver_status';
								}else if($this->session->userdata['shopsy_session_user_id']==$row->sender_id){
									if($row->senderthumbnail!=''){ $profile_pic='users/thumb/'.$row->senderthumbnail; } else { $profile_pic='default_avat.png';}
									$shopname=$row->sendershopname;
									$shopurl=$row->sendershopurl;
									$username=$row->sender_name;
									$status='sender_status';
								}
							
							?>

                        <ul <?php if($row->$status!='Read'){ echo 'style="background:#EBF6F9"'; } ?> class="message-box" id="Msg_<?php echo $row->id;?>">
                        	<li style=" border-right: 1px solid #D9D9D9;">
                            	<input id="checkbox-id" type="checkbox" class="chkMsg" value="<?php echo $row->id;?>" <?php if($row->$status!='Read'){ echo 'data-mode="unread"'; }else { echo 'data-mode="read"';} ?> >
                            </li>
                            <li>
                                <div class="avatar_view" style="border-radius:50%;"> 
                                    <img width="40px" src="images/<?php echo $profile_pic;?>" style="border-radius:50%;">
                                </div>
                                <div class="avater_split">
									<strong class="new-buton"><?php echo $chkC->num_rows(); ?></strong>
                                    <span>                        
                                    	<a href="view-profile/<?php echo $username; ?>">            
                                        	<label class="sort_link_1"><?php echo $username; ?></label>
                                        </a>
                                    </span>
                                    <?php if($shopname!=''){ ?>
                                    <div class="sub_cut">
                                        <a href="shop-section/<?php echo $shopurl;?>">
                                            <p style="line-height: 14px;">
                                                <img src="images/flow.png">
                                                <label class="sort_link_1"><?php echo $shopname; ?> </label>
                                            </p>
                                        </a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </li>
                            <li>
                                <span class="re-order">
                                    <a href="people/<?php echo $this->session->userdata['shopsy_session_user_name'];?>/conversations/<?php echo $viewfolder; ?>/<?php echo $row->tid;?>"><?php echo $row->subject;?></a>
                                </span>
                                <br />
                                <label class="text_lines"><?php echo $row->message;?></label>
                            </li>
                            <li style="float:right">
                                <span>
								<?php 
									$datediff = time()-strtotime($row->dataAdded); 
									$diffdate=floor($datediff/(60*60*24));
									if($diffdate!=0){
										if($diffdate<4){
											echo $diffdate.' days ago';
										}else{
											echo date('m/d/y',strtotime($row->dataAdded));
										}
									}else{
										if(floor($datediff/(60*60))<1){
											if(floor($datediff/(60))>0){
												
												
												$mins= floor($datediff/(60));
												
												if($this->lang->line('mins_ago') != '') { echo $mins.stripslashes($this->lang->line('mins_ago')); } else echo $mins.' mins ago';
												
											}else{
												if($this->lang->line('just_now') != '') { echo stripslashes($this->lang->line('just_now')); } else echo ' just now';
											}
										}else{
										$hours = floor($datediff/(60*60));
											if($this->lang->line('hours_ago') != '') { echo $hours.stripslashes($this->lang->line('hours_ago')); } else echo $hours.' hours ago';
										}
									}
								?>
                                </span>								
                            </li>
                        </ul>
                        <?php 
								} 
							}
						}else{ 
                        if($this->lang->line('no_conversation') != '') { echo stripslashes($this->lang->line('no_conversation')); } else echo 'No Conversation Found';
                        } ?>
           			</div>
                </div>
			</div>
		</div>
		</div>
		</div>
		</div>
	</section>
</div>
<style>
.convers .conversation_container {
	border:none;
}
.convers .conversation_container_right {
    width: 100%;
}
</style>
<?php $this->load->view('site/templates/footer'); ?>