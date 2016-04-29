<?php  $this->load->view('site/templates/header.php'); 
$this->load->model('community_model');
$commentData=$commentData->result_array();  ?>
<?php  $this->load->view('site/community/templates/css_js_files.php'); ?>

<section class="container">
    	<div class="main">
        <div class="wrapper">
        <ul class="bread_crumbs">
        	<li> <a href="" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
            <li> <a href="settings/my-account/<?php echo $this->session->userdata['shopsy_session_user_name']; ?>" class="a_links"><?php if($this->lang->line('comm_account') != '') { echo stripslashes($this->lang->line('comm_account')); } else echo "Your Account"; ?></a></li>
            <span>&rsaquo;</span>
            <li> <a href="manage-discussions" class="a_links"><?php if($this->lang->line('com_discussions') != '') { echo stripslashes($this->lang->line('com_discussions')); } else echo "Discussions"; ?></a></li>
            <span>&rsaquo;</span>
            <li> <a href="javascript:void(0);" class="a_links"><?php if($this->lang->line('com_discussionthread') != '') { echo stripslashes($this->lang->line('com_discussionthread')); } else echo "Discussion Thread"; ?></a></li>
        </ul>
     <div class="clear"></div>
     <div class="hole_content">
      <div class="heading"><?php if($this->lang->line('com_discussionthread') != '') { echo stripslashes($this->lang->line('com_discussionthread')); } else echo "Discussion Thread"; ?></div>
        	<?php  $this->load->view('site/community/community/community_control/blog_leftside.php'); ?>
            <form name="seekerActionForm" id="seekerActionForm" method="post" enctype="multipart/form-data" action="site/community/discussionInactiveDeleteFunction" >	
             <input type="hidden" name="statusMode" id="statusMode" />	
            <input type="hidden" name="pagename" id="pagename" value="<?php echo $product_id = $this->uri->segment(1); ?>" />	
             <input type="hidden" name="pagenameId" id="pagenameId" value="<?php echo $product_id = $this->uri->segment(2); ?>" />	
            <div class="right_split">
                	<div class="full_detail">
                    <div id="activeInactiveTop" class="act-ina-del-common">
                    
                       <a class="btn btn-success see_more" href="javascript:void(0);" onclick="return checkBoxValidationUser('Active','123')"><i class="icon-ok"></i> <?php if($this->lang->line('com_active') != '') { echo stripslashes($this->lang->line('com_active')); } else echo "Active"; ?></a>
                       <a class="btn btn-warning inact inact see_more" href="javascript:void(0);" onclick="return checkBoxValidationUser('Inactive','123')"><i class="icon-ban-circle"></i> <?php if($this->lang->line('com_inactive') != '') { echo stripslashes($this->lang->line('com_inactive')); } else echo "Inactive"; ?></a>
                       <a class="btn btn-danger see_more" href="javascript:void(0);" onclick="return checkBoxValidationUser('delete','123')"><i class="icon-trash icon-white"></i> <?php if($this->lang->line('com_delete') != '') { echo stripslashes($this->lang->line('com_delete')); } else echo "Delete"; ?></a>     
                            
                    </div>
   <table width="99%" border="0" cellspacing="0" cellpadding="0" class="property_table" id="comment_table">
                     <thead>
  <tr style="background:#f4f4f4;">
  <td><input type="checkbox" name ="seekerCheckbox[]" id="seekerCheckbox"  onclick="return checkBoxController(this.form,'seekerCheckbox[]',this.checked);"/></td>
   <td width="20%" ><strong><?php if($this->lang->line('com_username') != '') { echo stripslashes($this->lang->line('com_username')); } else echo "User Name"; ?></strong></td>
   <td width="20%" ><strong><?php if($this->lang->line('com_teamname') != '') { echo stripslashes($this->lang->line('com_teamname')); } else echo "Team Name"; ?></strong></td>
   <td width="20%" ><strong><?php if($this->lang->line('com_discussionthread') != '') { echo stripslashes($this->lang->line('com_discussionthread')); } else echo "Discussion Thread"; ?></strong></td>
   <td width="20%" ><strong><?php if($this->lang->line('com_datetime') != '') { echo stripslashes($this->lang->line('com_datetime')); } else echo "Date & Time"; ?></strong></td>
   <td width="35%" ><strong><?php if($this->lang->line('com_response') != '') { echo stripslashes($this->lang->line('com_response')); } else echo "In Response to"; ?></strong></td>
 </tr>
 <thead>
 <tbody>
 <?php  foreach($commentData as $details){?>
  <?php if($details['status']!= 'Unpublish') { ?>
 <tr>
  <td><input type="checkbox" class="caseSeeker" name="seekerCheckbox[]" value="<?php echo $details['id']; ?>" /></td>
  <td><a href="view-profile/<?php echo $details['user_name'];?>"><?php echo stripslashes($details['fullName']);?></a></td>
   <td><a href="team/<?php echo $details['teamId'].'/'.$details['teamSeourl'];?> "><?php echo stripslashes($details['teamName']);?></a></td>
   <td><?php echo character_limiter(stripslashes($details['post']), 30); ?></td>	
   
   <td><?php echo stripslashes($details['postDate']);?></td>
   <td><div class="edit">
   <!--<a href="#" style="padding-left:0px;"><img src="images/reply.png"  /></a>-->
   <a href="site/community/delete_discussionThrd/<?php echo stripslashes($details['id']);?>/<?php echo stripslashes($details['rootId']);?>" onclick="return changeStatusCommon('delete');"><img src="images/delete.png"  /></a>
   <?php if($details['status'] == 'Active') { ?>
        <a  href="site/community/update_discussionThrd/<?php echo stripslashes($details['id']);?>/<?php echo stripslashes($details['status']);?>/<?php echo stripslashes($details['rootId']);?>" onclick="return changeStatusCommon('<?php echo $details['status']; ?>');"><img src="images/active.png"  /></a>
   <?php } else { ?>
		 <a  href="site/community/update_discussionThrd/<?php echo stripslashes($details['id']);?>/<?php echo stripslashes($details['status']);?>/<?php echo stripslashes($details['rootId']);?>" onclick="return changeStatusCommon('<?php echo $details['status']; ?>');"><img src="images/inactive.png"  /></a>
    <?php } ?>
   </div>
   </td>
 </tr>
 <?php } ?>
<?php } ?>
</tbody>
</table>
                        
      </div>                   
  </div>
   </form>
            </div>
            </div>
        </div>
         </div>
    
 
	
</section>
<!--selection-->
<?php $this->load->view('site/templates/footer.php'); ?>