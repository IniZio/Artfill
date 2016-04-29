<?php  $this->load->view('site/templates/header.php'); ?>
<?php  $this->load->view('site/community/templates/css_js_files.php'); ?>
<!-- css -->
<link href='//fonts.googleapis.com/css?family=Ubuntu:300,400,700,400italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/default/site/base.css" />
<link rel="stylesheet" href="css/default/site/style-menu.css" />
    
<?php if(isset($active_theme) && $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Community-Page.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>header.css" rel="stylesheet">
<link href="./theme/themecss_<?php echo $active_theme->row()->id;  ?>footer.css" rel="stylesheet">
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
            <li> <?php if($this->lang->line('com_news') != '') { echo stripslashes($this->lang->line('com_news')); } else echo "News"; ?></li>
        </ul>
     <div class="clear"></div>
     <div class="hole_content">
      <div class="heading"><?php if($this->lang->line('com_news') != '') { echo stripslashes($this->lang->line('com_news')); } else echo "News"; ?></div>
        	<?php  $this->load->view('site/community/community/community_control/blog_leftside.php'); ?>
             <form name="seekerActionForm" id="seekerActionForm" method="post" enctype="multipart/form-data" action="site/community/productActiveInactiveDeleteFunction" >	
            <input type="hidden" name="statusMode" id="statusMode" />	
            <input type="hidden" name="pagename" id="pagename" value="<?php echo $product_id = $this->uri->segment(1); ?>" />	
            <div class="right_split">
                	<div class="full_detail">
                    <div id="activeInactiveTop" class="act-ina-del-common">
                    <a class="btn btn-success see_more" style="float:left" href="community-new-post" ><i class="icon-ok"></i> <?php if($this->lang->line('com_addnews') != '') { echo stripslashes($this->lang->line('com_addnews')); } else echo "Add News"; ?></a>
                       <a class="btn btn-success see_more" href="javascript:void(0);" onClick="return checkBoxValidationUser('active','123')" ><i class="icon-ok"></i> <?php if($this->lang->line('com_active') != '') { echo stripslashes($this->lang->line('com_active')); } else echo "Active"; ?> </a>
                       <a class="btn btn-warning inact see_more" href="javascript:void(0);" onClick="return checkBoxValidationUser('inactive','123')" ><i class="icon-ban-circle"></i> <?php if($this->lang->line('com_inactive') != '') { echo stripslashes($this->lang->line('com_inactive')); } else echo "Inactive"; ?></a>
                       <a class="btn btn-danger see_more" href="javascript:void(0);" onClick="return checkBoxValidationUser('delete','123')"><i class="icon-trash icon-white"></i> <?php if($this->lang->line('com_delete') != '') { echo stripslashes($this->lang->line('com_delete')); } else echo "Delete"; ?></a>     
                            
                    </div>
					
					<div class="news-table">
                     <table width="99%" border="0" cellspacing="0" cellpadding="0" class="property_table" id="property_table">
                     <thead>
  <tr style="background:#f4f4f4;">
   <td width="5%"><input type="checkbox" name ="seekerCheckbox[]" id="seekerCheckbox"  onclick="return checkBoxController(this.form,'seekerCheckbox[]',this.checked);"/> </td>
   <td width="20%" ><strong><?php if($this->lang->line('user_title') != '') { echo stripslashes($this->lang->line('user_title')); } else echo "Title"; ?></strong></td>
<!--    <td width="20%" ><strong><?php if($this->lang->line('com_eventtype') != '') { echo stripslashes($this->lang->line('com_eventtype')); } else echo "Event Type"; ?></strong></td>
  <td width="20%" ><strong>Comments Count</strong></td>-->
   <td width="20%" ><strong><?php if($this->lang->line('blog_date') != '') { echo stripslashes($this->lang->line('blog_date')); } else echo "Date"; ?></strong></td>
   <td width="20%" ><strong><?php if($this->lang->line('blog_time') != '') { echo stripslashes($this->lang->line('blog_time')); } else echo "Time"; ?></td>
   <td width="20%" ><strong><?php if($this->lang->line('com_rsponseto') != '') { echo stripslashes($this->lang->line('com_rsponseto')); } else echo "In Response To"; ?></strong></td>
 </tr>
 <thead>
 <tbody>
 <?php foreach($postData as $details){?>
 <?php if($details['post_status']!='Unpublish'){ ?>
 <tr>
 <td><input type="checkbox" class="caseSeeker" name="seekerCheckbox[]" value="<?php echo $details['post_id']; ?>" /></td>
   <td><a href="<?php echo $details['post_id']?>/news-details"><?php echo stripslashes($details['post_title']);?></a></td>
 <!--    <td><?php echo stripslashes($details['user_name']);?></td>
 <td><?php echo stripslashes($details['comment_date']);?></td>-->
   <td><?php echo date('M-d,Y',strtotime($details['posted_date']));?></td>
   <td><?php echo date('H:i:s',strtotime($details['posted_date']));?></td>
   <td><div class="edit">
   <?php if($details['post_status'] == 'active') { ?>
        <a  href="site/community/update_posts/<?php echo stripslashes($details['post_id']);?>/<?php echo stripslashes($details['post_status']);?>" onclick="return changeStatusCommon('<?php echo $details['post_status']; ?>');"><img src="images/active.png" title="<?php echo ucfirst($details['post_status']); ?>"  /></a>
   <?php } else { ?>
		 <a  href="site/community/update_posts/<?php echo stripslashes($details['post_id']);?>/<?php echo stripslashes($details['post_status']);?>" onclick="return changeStatusCommon('<?php echo $details['post_status']; ?>');"><img src="images/inactive.png" title="<?php echo ucfirst($details['post_status']); ?>"  /></a>
    <?php } ?>
   <?php /*?><a href="site/community/blogpublishsingleview/<?php echo stripslashes($details['post_id']);?>" style="padding-left:0px;"><img src="images/view.png" title="View"/></a><?php */?>
    <a href="site/community/blogeditpost/<?php echo stripslashes($details['post_id']);?>" style="padding-left:0px;"><img src="images/edit.png" title="Edit"   /></a>
   <a href="site/community/delete_posts/<?php echo stripslashes($details['post_id']);?>" onclick="return changeStatusCommon('delete');"><img src="images/delete.png" title="Delete"  /></a>

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
</div>
<!--selection-->
<?php 
        $this->load->view('site/templates/footer.php'); 
?>