<?php  $this->load->view('site/templates/header.php'); 
$this->load->model('community_model');
$commentData=$commentData->result_array();  ?>
<?php  $this->load->view('site/community/templates/css_js_files.php'); ?>

<!-- css -->
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,700,400italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="css/default/site/style-menu.css" />
    
<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Community-Page.css" rel="stylesheet">
//<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
//<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
<?php }?>
<script>
    $(document).ready(function(){
        $("#nav-mobile").html($("#nav-main").html());
        $("#nav-trigger span").click(function(){
            if ($("nav#nav-mobile ul").hasClass("expanded")) {
                $("nav#nav-mobile ul.expanded").removeClass("expanded").slideUp(250);
                $(this).removeClass("open");
            } else {
                $("nav#nav-mobile ul").addClass("expanded").slideDown(250);
                $(this).addClass("open");
            }
        });
    });
</script>



<div class="add_steps shop-menu-list">

			<div class="main">
			<div id="nav-trigger">
					<span>Menu</span>
				</div>
				<nav id="nav-main">
					<ul id="panel" class="add_steps" style="background:none; box-shadow:none;">
				<li <?php if($this->uri->segment(1) == 'manage-community'){?> class="active" <?php }?>><a href="manage-community" ><?php if($this->lang->line('com_allnews') != '') { echo stripslashes($this->lang->line('com_allnews')); } else echo "All News"; ?></a></li>
<?php /*?><li <?php if($this->uri->segment(1) == 'community-new-post'){?> class="active" <?php }?>><a href="community-new-post">Add News</a></li><?php */?> 
       <li <?php if($this->uri->segment(1) == 'community-post-comments'){?> class="active" <?php }?>><a href="community-post-comments" ><?php if($this->lang->line('com_comments') != '') { echo stripslashes($this->lang->line('com_comments')); } else echo "Comments"; ?></a></li>
        <li <?php if($this->uri->segment(1) == 'manage-events'){?> class="active" <?php }?>><a href="manage-events"><?php if($this->lang->line('com_allevents') != '') { echo stripslashes($this->lang->line('com_allevents')); } else echo "All Events"; ?></a></li>
        <?php /*?><li <?php if($this->uri->segment(1) == 'add-event'){?> class="active" <?php }?>><a href="add-event">Add Event</a></li><?php */?>
        <li <?php if($this->uri->segment(1) == 'manage-teams'){?> class="active" <?php }?>><a href="manage-teams" ><?php if($this->lang->line('com_allteams') != '') { echo stripslashes($this->lang->line('com_allteams')); } else echo "All Teams"; ?></a></li>
        <?php /*?><li <?php if($this->uri->segment(1) == 'add-team'){?> class="active" <?php }?>><a href="add-team">Add Team</a></li><?php */?>
        <li <?php if($this->uri->segment(1) == 'manage-discussions'){?> class="active" <?php }?>><a href="manage-discussions"><?php if($this->lang->line('com_discussions') != '') { echo stripslashes($this->lang->line('com_discussions')); } else echo "Discussions"; ?></a></li>  
				</ul>

</nav>
				
				<nav id="nav-mobile"></nav>
			</div>
			
			</div>
<div id="community_tag">
<section class="container">
    	<div class="main">
        <div class="wrapper">
        <ul class="bread_crumbs">
        	<li> <a href="" class="a_links"><?php if($this->lang->line('user_home') != '') { echo stripslashes($this->lang->line('user_home')); } else echo "Home"; ?></a></li>
            <span>&rsaquo;</span>
            <li> <a href="settings/my-account/<?php echo $this->session->userdata['shopsy_session_user_name']; ?>" class="a_links"><?php if($this->lang->line('comm_account') != '') { echo stripslashes($this->lang->line('comm_account')); } else echo "Your Account"; ?></a></li>
            <span>&rsaquo;</span>
            <li style="cursor:default;"> <?php if($this->lang->line('com_discussions') != '') { echo stripslashes($this->lang->line('com_discussions')); } else echo "Discussions"; ?></li>
        </ul>
     <div class="clear"></div>
     <div class="hole_content">
      <div class="heading"><?php if($this->lang->line('com_discussions') != '') { echo stripslashes($this->lang->line('com_discussions')); } else echo "Discussions"; ?></div>
        	<?php  $this->load->view('site/community/community/community_control/blog_leftside.php'); ?>
            <form name="seekerActionForm" id="seekerActionForm" method="post" enctype="multipart/form-data" action="site/community/discussionInactiveDeleteFunction" >	
             <input type="hidden" name="statusMode" id="statusMode" />	
            <input type="hidden" name="pagename" id="pagename" value="<?php echo $product_id = $this->uri->segment(1); ?>" />	
            <div class="right_split">
                	<div class="full_detail">
                    <div id="activeInactiveTop" class="act-ina-del-common">
                    
                       <a class="btn btn-success see_more" href="javascript:void(0);" onclick="return checkBoxValidationUser('Active','123')"><i class="icon-ok"></i> <?php if($this->lang->line('com_active') != '') { echo stripslashes($this->lang->line('com_active')); } else echo "Active"; ?></a>
                       <a class="btn btn-warning inact inact see_more" href="javascript:void(0);" onclick="return checkBoxValidationUser('Inactive','123')"><i class="icon-ban-circle"></i> <?php if($this->lang->line('com_inactive') != '') { echo stripslashes($this->lang->line('com_inactive')); } else echo "Inactive"; ?></a>
                       <a class="btn btn-danger see_more" href="javascript:void(0);" onclick="return checkBoxValidationUser('delete','123')"><i class="icon-trash icon-white"></i> <?php if($this->lang->line('com_delete') != '') { echo stripslashes($this->lang->line('com_delete')); } else echo "Delete"; ?></a>     
                            
                    </div>
					<div class="news-table">
   <table width="99%" border="0" cellspacing="0" cellpadding="0" class="property_table" id="comment_table">
                     <thead>
  <tr style="background:#f4f4f4;">
  <td><input type="checkbox" name ="seekerCheckbox[]" id="seekerCheckbox"  onclick="return checkBoxController(this.form,'seekerCheckbox[]',this.checked);"/></td>
   <td width="19%" ><strong><?php if($this->lang->line('com_teamname') != '') { echo stripslashes($this->lang->line('com_teamname')); } else echo "Team Name"; ?></strong></td>
   <td width="19%" ><strong><?php if($this->lang->line('com_discussiontitle') != '') { echo stripslashes($this->lang->line('com_discussiontitle')); } else echo "Discussion Title"; ?></strong></td>
   <td width="19%" ><strong><?php if($this->lang->line('com_discussionthread') != '') { echo stripslashes($this->lang->line('com_discussionthread')); } else echo "Discussion Thread"; ?></strong></td>
   <td width="18%" ><strong><?php if($this->lang->line('com_datetime') != '') { echo stripslashes($this->lang->line('com_datetime')); } else echo "Date & Time"; ?></strong></td>
   <td width="40%" ><strong><?php if($this->lang->line('com_rsponseto') != '') { echo stripslashes($this->lang->line('com_rsponseto')); } else echo "In Response to"; ?></strong></td>
 </tr>
 <thead>
 <tbody>
 <?php  #echo '<pre>'; print_r($commentData); 
 foreach($commentData as $details){?>
  <?php if($details['status']!= 'Unpublish') { ?>
 <tr>
  <td><input type="checkbox" class="caseSeeker" name="seekerCheckbox[]" value="<?php echo $details['id']; ?>" /></td>
   <td><a href="team/<?php echo $details['teamId'].'/'.$details['teamSeourl'];?> "><?php echo stripslashes($details['teamName']);?></a></td>
   <td><a href="discuss/<?php echo $details['teamId'].'/'.$details['teamSeourl'].'/'.$details['id'];?>"><?php echo character_limiter(stripslashes($details['post_title']), 30); ?></a></td>
   <?php  $condition= array('rootId'=>$details['id']); $dissThrd = $this->community_model->get_all_TeamDiscussionwithMemberinfo($condition); ?>
   <td align="center"><?php if($dissThrd->num_rows()>0){ ?> <a href="manage-discussions-thread/<?php echo $details['id']; ?>">View ( <?php  echo $dissThrd->num_rows(); ?> ) </a><?php } else{  echo $dissThrd->num_rows().' Comment'; }?></td>
   <td><?php echo stripslashes($details['postDate']);?></td>
   <td><div class="edit">
   <!--<a href="#" style="padding-left:0px;"><img src="images/reply.png"  /></a>-->
   <a href="site/community/delete_discussion/<?php echo stripslashes($details['id']);?>" onclick="return changeStatusCommon('delete');"><img src="images/delete.png"  /></a>
   <?php if($details['status'] == 'Active') { ?>
        <a  href="site/community/update_discussion/<?php echo stripslashes($details['id']);?>/<?php echo stripslashes($details['status']);?>" onclick="return changeStatusCommon('<?php echo $details['status']; ?>');"><img src="images/active.png"  /></a>
   <?php } else { ?>
		 <a  href="site/community/update_discussion/<?php echo stripslashes($details['id']);?>" onclick="return changeStatusCommon('<?php echo $details['status']; ?>');"><img src="images/inactive.png"  /></a>
		 
    <?php } ?>
	<button style="background: rgb(151, 229, 167);" ><a  href="create-thread/<?php echo $details['teamId'].'/'.$details['teamSeourl'];?>">Create New</a></button>
   </div>
   </td>
 </tr>
 <?php } ?>
<?php } ?>
</tbody>
</table>
          </div>              
      </div>                   
  </div>
   </form>
            </div>
            </div>
        </div>
         </div>
    
 
	
</section>
</tag>
<!--selection-->
<?php $this->load->view('site/templates/footer.php'); ?>